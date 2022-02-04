<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://you-agency.com
 * @since             1.0.0
 * @package           You_Agency_Management
 *
 * @wordpress-plugin
 * Plugin Name:       YOU Agency Management
 * Plugin URI:        https://you-agency.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Danny Hearnah
 * Author URI:        https://you-agency.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       you-agency-management
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'YOU_AGENCY_MANAGEMENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-you-agency-management-activator.php
 */
function activate_you_agency_management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-you-agency-management-activator.php';
	You_Agency_Management_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-you-agency-management-deactivator.php
 */
function deactivate_you_agency_management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-you-agency-management-deactivator.php';
	You_Agency_Management_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_you_agency_management' );
register_deactivation_hook( __FILE__, 'deactivate_you_agency_management' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-you-agency-management.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_you_agency_management() {

	$plugin = new You_Agency_Management();
	$plugin->run();

}
run_you_agency_management();
