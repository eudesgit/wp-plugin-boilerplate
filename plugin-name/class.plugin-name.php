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

class Plugin_Name {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
    private $plugin_name;
    
	/**
	 * The current version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_version   Plugin's version.
	 */
    private $plugin_version;

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
        
        $this->plugin_name = PLUGIN_NAME;
        $this->plugin_version = PLUGIN_VERSION;

        $this->actions = array();
		$this->filters = array();

		$this->load_dependencies(); // Classes and Includes loader
		$this->define_admin_hooks();
		$this->define_public_hooks();

    }
    

    //
    // Getters & Setters
    //

    public function get_plugin_name         ( ) { return $this->plugin_name; }
    public function get_plugin_version      ( ) { return $this->plugin_version; }


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks ( ) {

        // Plugin Admin class
		$plugin_admin = new Admin_Side\Admin_Side($this->get_plugin_name(), $this->get_plugin_version());

		$this->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles'); // plugin_admin->enqueue_styles()
		$this->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts'); // plugin_admin->enqueue_scripts()

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks ( ) {

        // Plugin Public class
		$plugin_public = new Public_Side\Public_Side($this->get_plugin_name(), $this->get_plugin_version());

		$this->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles'); // plugin_public->enqueue_styles()
		$this->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts'); // plugin_public->enqueue_scripts()

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies ( ) {

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'admin/class.plugin-name.admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( __FILE__  ) . 'public/class.plugin-name.public.php';

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
		$this->run_adds ( );
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
    $p = new Plugin_Name();
    $p->run();
}