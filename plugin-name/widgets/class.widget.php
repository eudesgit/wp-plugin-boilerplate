<?php
/**
 * The widget register class of the plugin.
 *
 * @author     Eudes
 */

namespace Plugin_Name\Widgets;

class Widget_Main {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 */
	public function __construct ( ) {

	}

	/**
	 * Register the stylesheets
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles ( ) {

		wp_enqueue_style(PN_PREFIX . '-widget-styles', plugin_dir_url(__FILE__) . 'css/styles.css', [], PN_VERSION, 'all');

	}

	/**
	 * Register the JavaScript
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts ( ) {

		wp_enqueue_script(PN_PREFIX . '-widget-scripts', plugin_dir_url(__FILE__) . 'js/scripts.js', ['jquery'], PN_VERSION, false);

	}

}