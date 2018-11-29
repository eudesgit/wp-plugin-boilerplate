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
	 * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $plugin_version    The version of the plugin.
	 */
	public function __construct ( ) {

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles ( ) {

		wp_enqueue_style(PN_PREFIX . '-admin-styles', plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), PN_VERSION, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts ( ) {

		wp_enqueue_script(PN_PREFIX . '-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), PN_VERSION, false);

	}

}
