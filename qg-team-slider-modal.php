<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dannysunday.vercel.app
 * @since             1.0.0
 * @package           Qg_Team_Slider_Modal
 *
 * @wordpress-plugin
 * Plugin Name:       QG Team Slider-Modal
 * Plugin URI:        https://dannysunday.vercel.app
 * Description:       A modal-popup slider for team members.
 * Version:           1.0.0
 * Author:            Quantum Devs
 * Author URI:        https://dannysunday.vercel.app
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       qg-team-slider-modal
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
define( 'QG_TEAM_SLIDER_MODAL_VERSION', '1.0.0' );

/**
 * Plugin Database table version and table name.
 * Change version when initial table structure changes
 */
define('QG_TEAM_SLIDER_MODAL_DB_VERSION', '1.0.0');
define('QG_TEAM_SLIDER_MODAL_TABLE_NAME', 'qg_team_slider_modal');


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-qg-team-slider-modal-activator.php
 */
function activate_qg_team_slider_modal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qg-team-slider-modal-activator.php';
	$activate_plugin = new Qg_Team_Slider_Modal_Activator();
	$activate_plugin->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-qg-team-slider-modal-deactivator.php
 */
function deactivate_qg_team_slider_modal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qg-team-slider-modal-deactivator.php';
	Qg_Team_Slider_Modal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_qg_team_slider_modal' );
register_deactivation_hook( __FILE__, 'deactivate_qg_team_slider_modal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-qg-team-slider-modal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_qg_team_slider_modal() {

	$plugin = new Qg_Team_Slider_Modal();
	$plugin->run();

}
run_qg_team_slider_modal();
