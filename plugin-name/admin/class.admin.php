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
    
    /**
	 * ADD_ACTION CALLBACK
	 * Adding settings page to WP
	 * 
	 * @see https://developer.wordpress.org/reference/functions/add_menu_page/
	 * @since 1.0.0
	 */
	public function add_menu_page_settings_action ( ) {

        $page_slug = PN_SLUG . '-admin-page-settings';

		add_menu_page(
			PN_TITLE, // page_title
			PN_TITLE, // menu_title
			'administrator', // capability
			$page_slug, // menu_slug
		    [$this, 'cb_admin_page_settings_view'], // cb function
			'dashicons-welcome-widgets-menus' // icon
        );
        
	}

	/**
	 * CALLBACK
	 * View of the settings page 
	 * 
	 * @since 1.0.0
	 */
	public function cb_admin_page_settings_view ( ) {
		include_once(plugin_dir_path(__FILE__) . 'views/view.admin.php');
	}

	/**
	 * ADD_ACTION CALLBACK
	 * Creates a settings structure for the admin page
	 * 
	 * @return void
	 * @see https://developer.wordpress.org/reference/functions/register_setting/
	 * @see https://developer.wordpress.org/reference/functions/add_settings_section/
	 * @see https://developer.wordpress.org/reference/functions/add_settings_field/
	 * @since 1.0.0
	 */
	public function add_settings_action ( ) {

        $page_slug = PN_SLUG . '-admin-page-settings';
        $option_name = $page_slug . '-setting-general';
        $section_slug = $page_slug . '-section-general';
        $section_field_slug = $section_slug . 'settings-field-general';

        // Register setting
		register_setting($page_slug, $option_name);
		
		// Registering section
		add_settings_section(
			$section_slug, // id
			__('General settings'), // Title
			[$this, 'cb_add_settings_section'], // callback
			$page_slug // page slug
		);
		
		// Registering field
		add_settings_field(
			$section_field_slug, // id
			__('General field'), // Label Title
			[$this, 'cb_add_settings_field'], // callback
			$page_slug, // page slug
			$section_slug, // section slug
			[ // extra
				'label_for' => $option_name,
            ]
        );       

	}

	/**
	 * CALLBACK
	 * View for the section
	 * 
	 * add_settings_section() callback
	 *
	 * @param array $args Callback args
	 * @return void
	 * @since 1.0.0
	 */
	public function cb_add_settings_section ( $args ) {
		?>
		<p>Those are the general settings</p>
		<?php
    }
    
	/**
	 * CALLBACK
	 * Settings field
	 * 
	 * add_settings_field() callback
	 *
	 * @param array $args Callback args
	 * @return void
	 * @since 1.0.0
	 */
    public function cb_add_settings_field ( $args ) {
        $page_slug = PN_SLUG . '-admin-page-settings';
        $option_name = $page_slug . '-setting-general';
        ?>
            <input name="<?php print $option_name?>" id="<?php print $option_name?>" value="<?php print get_option($option_name); ?>" type="text" /> 
            Explanation text
        <?php
    }    

}
