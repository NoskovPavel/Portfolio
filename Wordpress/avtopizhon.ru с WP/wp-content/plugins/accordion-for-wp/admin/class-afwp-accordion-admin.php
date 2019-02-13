<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://themeegg.com/plugins/accordion-for-wp//
 * @since      1.0.0
 *
 * @package    Accordion_For_WP
 * @subpackage Accordion_For_WP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Accordion_For_WP
 * @subpackage Accordion_For_WP/admin
 * @author     ThemeEgg <themeeggofficial@gmail.com>
 */
class Accordion_For_WP_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		/*
		 * @since    1.1.0
		 */
		$this->accordion_dependencies();

	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_scripts' );

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
		 * defined in Accordion_For_WP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Accordion_For_WP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'fontawesome', plugin_dir_url( __FILE__ ) . '../public/assets/lib/css/font-awesome.min.css', array(), '4.7.0', 'all' );
		wp_enqueue_style( 'fontawesome-iconpicker', plugin_dir_url( __FILE__ ) . 'lib/css/fontawesome-iconpicker.min.css', array(), '1.3.1', 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/afwp-accordion-admin.css', array(), $this->version, 'all' );

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
		 * defined in Accordion_For_WP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Accordion_For_WP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'fontawesome-iconpicker', plugin_dir_url( __FILE__ ) . 'lib/js/fontawesome-iconpicker.min.js', array( 'jquery' ), '1.3.1', false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/afwp-accordion-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add Dependencies to Admin Area
	 *
	 * @since    1.1.0
	 */
	public function accordion_dependencies() {

		if ( ! is_admin() ) {
			return;
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-afwp-accordion-ajax.php';

	}

}
