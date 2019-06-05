<?php
/**
 * The public-facing class of the plugin.
 *
 * @author     Eudes
 */

namespace Plugin_Name\Public_Side;

class Public_Main {

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

		wp_enqueue_style(PN_PREFIX . '-public-styles', plugin_dir_url(__FILE__) . 'css/public.css', [], PN_VERSION, 'all' );

	}

	/**
	 * Register the JavaScript.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts ( ) {

		wp_enqueue_script(PN_PREFIX . '-public-scripts', plugin_dir_url(__FILE__) . 'js/public.js', ['jquery'], PN_VERSION, false );

	}

}
