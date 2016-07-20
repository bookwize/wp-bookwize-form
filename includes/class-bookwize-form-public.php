<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.bookwize.com/
 * @since      1.0.0
 *
 * @package    Bookwize_Form
 * @subpackage Bookwize_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bookwize_Form
 * @subpackage Bookwize_Form/public
 * @author     https://www.bookwize.com/ - support@bookwize.com
 */
class Bookwize_Form_Public
{

    public $settings = [];
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param      string $bookwize_form The name of the plugin.
     * @param      string $version The version of this plugin.
     */

    protected $base_slug = 'bookwize-form';
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $bookwize_form The ID of this plugin.
     */
    private $bookwize_form;
    /**
     * The version of this plugin.
     *d
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;
    private $_settings = [

    ];

    public function __construct($bookwize_form = null, $version = null)
    {

        $this->bookwize_form = $bookwize_form;
        $this->version = $version;
    }


    public function init()
    {
        add_action('wp_head', [&$this, 'wp_head'], 10, 2);
    }

    public function getBasePublicUrl() {
        return preg_replace('/' . basename(__DIR__) .'\/$/i', '', plugin_dir_url( __FILE__ )) . 'public';
    }


    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Bookwize_Form_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Bookwize_Form_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        if(get_option('bwf_disable_css') !== '1') {
            wp_enqueue_style($this->bookwize_form, $this->getBasePublicUrl() . '/css/bookwize-form.css', array(), $this->version, 'all');
        }
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Bookwize_Form_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Bookwize_Form_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        $basePublicUrl = $this->getBasePublicUrl();
        wp_enqueue_script('jquery-ui-datepicker' );
        wp_enqueue_script('jquery-ui-i18n');
        wp_enqueue_script($this->bookwize_form . '-app', $basePublicUrl . '/js/bookwize-form-public.js', array(), true, true);
    }

    public function wp_head()
    {
        $this->config();

        ?>
        <?php
    }

    protected function config()
    {
        global $post;

        $this->settings = array_merge($this->_settings, [
            'websiteUrl' => get_home_url(null, '/'),
            'themeUrl' => get_template_directory_uri(),
            'post' => ($post !== null) ? $post : new stdClass(), // if is 404 page $post is NULL,
        ]);
    }
}
