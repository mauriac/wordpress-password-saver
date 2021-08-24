<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Pasav
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Password Saver
 * Plugin URI:        #
 * Description:       Plugin that allow you to save password.
 * Version:           1.0.0
 * Author:            Mauriac Azoua
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pasav
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
define( 'PASAV_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pasav-activator.php
 */
function activate_pasav() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pasav-activator.php';
	Pasav_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pasav-deactivator.php
 */
function deactivate_pasav() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pasav-deactivator.php';
	Pasav_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pasav' );
register_deactivation_hook( __FILE__, 'deactivate_pasav' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pasav.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pasav() {

	$plugin = new Pasav();
	$plugin->run();

}
run_pasav();
