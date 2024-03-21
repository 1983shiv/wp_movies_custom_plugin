<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/1983shiv
 * @since             1.0.0
 * @package           Movies
 *
 * @wordpress-plugin
 * Plugin Name:       Movies
 * Plugin URI:        https://https://github.com/1983shiv/wp_movies_custom_plugin
 * Description:       Movies database with custom post types with rest API capabilities
 * Version:           1.0.0
 * Author:            Shiv Srivastava
 * Author URI:        https://https://github.com/1983shiv/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       movies
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
define( 'MOVIES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-movies-activator.php
 */
function activate_movies() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-movies-activator.php';
	Movies_Activator::activate();


}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-movies-deactivator.php
 */
function deactivate_movies() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-movies-deactivator.php';
	Movies_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_movies' );
register_deactivation_hook( __FILE__, 'deactivate_movies' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-movies.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_movies() {

	$plugin = new Movies();
	$plugin->run();

}
run_movies();
