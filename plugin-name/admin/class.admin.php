<?php
/**
 * The class for admin features.
 *
 * @author     Eudes
 */

namespace Plugin_Name\Admin_Side;

class Admin_Main {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 */
	public function __construct ( ) {

	}

	/**
	 * Register the stylesheets.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles ( ) {

		wp_enqueue_style(PN_PREFIX . '-admin-styles', plugin_dir_url( __FILE__ ) . 'css/admin.css', [], PN_VERSION, 'all');

	}

	/**
	 * Register the JavaScript.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts ( ) {

		wp_enqueue_script(PN_PREFIX . '-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/admin.js', ['jquery'], PN_VERSION, false);

	}

}
