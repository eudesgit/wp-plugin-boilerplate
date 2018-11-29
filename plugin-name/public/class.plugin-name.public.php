<?php
/**
 * The public-facing class of the plugin.
 *
 * @author     Eudes
 */

namespace Plugin_Name\Public_Side;

class Public_Side {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
    //private $plugin_name;
    
	/**
	 * The current version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_version   Plugin's version.
	 */
    //private $plugin_version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $plugin_version    The version of the plugin.
	 */
	public function __construct ( ) {

        //$this->plugin_name = $plugin_name;
        //$this->plugin_version = $plugin_version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles ( ) {

		wp_enqueue_style(PN_PREFIX . '-public-styles', plugin_dir_url(__FILE__) . 'css/public.css', [], PN_VERSION, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts ( ) {

		wp_enqueue_script(PN_PREFIX . '-public-scripts', plugin_dir_url(__FILE__) . 'js/public.js', ['jquery'], PN_VERSION, false );

	}

}
