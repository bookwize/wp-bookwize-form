<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.bookwize.com/
 * @since      1.0.0
 *
 * @package    Bookwize_Form
 * @subpackage Bookwize_Form/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Bookwize_Form
 * @subpackage Bookwize_Form/includes
 * @author     https://www.bookwize.com/ - support@bookwize.com
 */
class Bookwize_Form
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Bookwize_Form_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $bookwize_form The string used to uniquely identify this plugin.
     */
    protected $bookwize_form;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {

        $this->bookwize_form = 'bookwize-form';
        $this->version = '1.4';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

        //new Bookwize_Form_Cpt();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_bookwize_form()
    {
        return $this->bookwize_form;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Bookwize_Form_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Bookwize_Form_Loader. Orchestrates the hooks of the plugin.
     * - Bookwize_Form_i18n. Defines internationalization functionality.
     * - Bookwize_Form_Admin. Defines all hooks for the admin area.
     * - Bookwize_Form_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'functions.php';
        require_once plugin_dir_path(dirname(__FILE__)) . '/includes/class-bookwize-form-widget.php';

        spl_autoload_register(function ($class) {
            $prefix = 'Bookwize_Form_';

            if (substr($class, 0, strlen($prefix)) == $prefix) {
                $class = substr($class, strlen($prefix));
            } else {
                return;
            }
            $class = strtolower($class);
            $class = str_replace('_', '-', $class);
            include plugin_dir_path(dirname(__FILE__))  . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'class-bookwize-form-'.$class . '.php';
        });

        require_once plugin_dir_path(dirname(__FILE__)) . '/admin/class-bookwize-form-admin.php';
        require_once plugin_dir_path(dirname(__FILE__)) . '/public/class-bookwize-form-public.php';
        
        $this->loader = new Bookwize_Form_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Bookwize_Form_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Bookwize_Form_i18n();
        $plugin_i18n->set_domain($this->get_bookwize_form());

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        if (current_user_can('manage_options')) {
            $plugin_admin = new Bookwize_Form_Admin($this->get_bookwize_form(), $this->get_version());
            $bookwize_form_settings = new Bookwize_Form_Settings();
            //$bookwize_form_meta = new Bookwize_Form_Meta();

            $this->loader->add_action('admin_init', $plugin_admin, 'admin_init');
            $this->loader->add_action('admin_init', $bookwize_form_settings, 'admin_init');
            $this->loader->add_action('admin_menu', $bookwize_form_settings, 'admin_menu');

            $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
            $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
            
        }
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new Bookwize_Form_Public($this->get_bookwize_form(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

        if (is_admin() === false || defined('DOING_AJAX')) {
            $this->loader->add_action('init', $plugin_public, 'init', 999);

            new Bookwize_Form_Shortcodes();
            new Bookwize_Form_Widget();
        }
    }

}
