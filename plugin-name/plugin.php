<?php
/**
 * The plugin main file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.website.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Name
 * Plugin URI:        http://www.website.com
 * Description:       A short description right here
 * Version:           0.0.1
 * Author:            Eudes
 * Author URI:        http://www.website.com
 * License:           Apache 2
 * Text Domain:       plugin-name
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('PLUGIN_NAME', 'plugin-name');
define('PLUGIN_VERSION', '1.0.0');

require_once plugin_dir_path( __FILE__ ) . 'class.plugin.php';

plugin_run();