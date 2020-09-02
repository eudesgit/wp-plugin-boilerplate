<?php
/**
 * The core plugin class.
 * 
 * Defines all hooks
 * Instantiates Public and Admin classes
 * Stores the unique identifier
 *
 * @link       http://www.website.com
 * @since      1.0.0
 * @author     Eudes
 */

namespace Plugin_Name;

use Plugin_Name\Admin_Side\Admin_Main;
use Plugin_Name\Public_Side\Public_Main;
use Plugin_Name\Widgets\Widget_Main;

class Main {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;    

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct ( ) {

        $this->actions = [];
		$this->filters = [];

		$this->load_dependencies(); // Classes and Includes loader
		$this->define_admin_hooks();
        $this->define_public_hooks();
        $this->define_widgets();

    }


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 */
	private function define_admin_hooks ( ) {

		$plugin_admin = new Admin_Main();

		$this->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles'); // plugin_admin->enqueue_styles()
        $this->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts'); // plugin_admin->enqueue_scripts()
        
        // Settings page
        $this->add_action('admin_menu', $plugin_admin, 'add_menu_page_settings_action'); 
        $this->add_action('admin_init', $plugin_admin, 'add_settings_action');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 */
	private function define_public_hooks ( ) {

		$plugin_public = new Public_Main();

		$this->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles'); // plugin_public->enqueue_styles()
		$this->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts'); // plugin_public->enqueue_scripts()

    }
    
    /**
     * Register widgets
     * 
     * @since 1.0.0
     */
	private function define_widgets ( ) {
    
		$plugin_widget = new Widget_Main();

        $this->add_action('wp_enqueue_scripts', $plugin_widget, 'enqueue_styles');
        $this->add_action('wp_enqueue_scripts', $plugin_widget, 'enqueue_scripts');
        
        // Widgets
        $this->add_action('widgets_init', $plugin_widget, 'init_widgets');
    }

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies ( ) {

		/*
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(__FILE__) . 'admin/class.admin.php';

		/*
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
        require_once plugin_dir_path(__FILE__) . 'public/class.public.php';
        
		/*
		 * The class responsible for defining all widgets
		 */
		require_once plugin_dir_path(__FILE__) . 'widgets/class.widget.php';        

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	protected function add_action ( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	protected function add_filter ( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }
    
	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         The priority at which the function should be fired.
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add ( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}    

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run ( ) {
		$this->run_adds();
    }
    
	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run_adds ( ) {

		foreach ( $this->filters as $hook ) {
			add_filter($hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args']);
		}

		foreach ( $this->actions as $hook ) {
			add_action($hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args']);
		}

	}    

}


/**
 * Begin the plugin
 * 
 * @since    1.0.0
 */
function plugin_name_run ( ) {
    $m = new Main();
    $m->run();
}