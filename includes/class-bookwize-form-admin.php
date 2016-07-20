<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.bookwize.com/
 * @since      1.0.0
 *
 * @package    Bookwize_Form
 * @subpackage Bookwize_Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bookwize_Form
 * @subpackage Bookwize_Form/admin
 * @author     Bookwize
 */
class Bookwize_Form_Admin {

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
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $bookwize_form The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $bookwize_form, $version ) {

		$this->bookwize_form = $bookwize_form;
		$this->version     = $version;
	}

	public function admin_init() {
		// add_action( 'admin_head', [ &$this, 'admin_head' ], 10, 2 );
	}
	public function getBasePublicUrl() {
		return preg_replace('/' . basename(__DIR__) .'\/$/i', '', plugin_dir_url( __FILE__ )) . 'admin';
	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->bookwize_form, $this->getBasePublicUrl() .  '/admin/css/bookwize-form-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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
		wp_enqueue_script('wp-color-picker', plugins_url('wp-color-picker-script.js', __FILE__ ), array( 'farbtastic' ), false, true );
		wp_enqueue_script( $this->bookwize_form, $this->getBasePublicUrl() . '/js/bookwize-form-admin.js', array( ), $this->version, true );

	}

//add_action( 'admin_enqueue_scripts', 'color_picker_assets' );
	public function admin_head() {
		add_action( 'admin_enqueue_scripts', function () {
			wp_enqueue_script( 'wp-color-picker' );
		} );
		wp_enqueue_style( 'wp-color-picker' );
	}

}
