<?php
/**
 * Plugin Name:       Accordion for WordPress - Accordion, FAQ, Tabs Shortcode and Widgets
 * Plugin URI:        http://themeegg.com/plugins/accordion-for-wp/
 * Description:       Accordion for wordpress widgets and shortcode plugin with multiple templates.
 * Version:           1.3.4
 * Author:            ThemeEgg
 * Author URI:        http://themeegg.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       accordion-for-wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!defined('AFWP_PLUGIN_NAME')){
	define('AFWP_PLUGIN_NAME', 'afwp-accordion');
}
if(!defined('AFWP_PLUGIN_VERSION')){
	define('AFWP_PLUGIN_VERSION', '1.3.4');
}

require plugin_dir_path( __FILE__ ) . 'includes/function-afwp-core.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-afwp-accordion-activator.php
 */
function activate_afwp_accordion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-afwp-accordion-activator.php';
	Accordion_For_WP_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-afwp-accordion-deactivator.php
 */
function deactivate_afwp_accordion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-afwp-accordion-deactivator.php';
	Accordion_For_WP_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_afwp_accordion' );
register_deactivation_hook( __FILE__, 'deactivate_afwp_accordion' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-afwp-accordion.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_afwp_accordion() {

	$plugin = new Accordion_For_WP();
	$plugin->run();

}

run_afwp_accordion();
