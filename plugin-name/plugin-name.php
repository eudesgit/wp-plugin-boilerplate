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
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Name
 * Plugin URI:        http://www.website.com
 * Description:       A short description right here
 * Version:           0.0.1
 * Author:            Eudes
 * Author URI:        http://www.website.com
 * License:           Apache 2
 * Text Domain:       plugin_name
 */

namespace Plugin_Name;

// If this file is called directly, abort.
if ( ! defined('WPINC') ) die;

require_once plugin_dir_path(__FILE__) . 'class.main.php';

// Title: Plugin Name
define('PN_TITLE', 'Plugin Name');
define('PN_SLUG', 'plugin-name');
define('PN_PREFIX', 'pn');
define('PN_VERSION',  '0.0.1');

plugin_name_run();