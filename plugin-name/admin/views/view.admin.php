<?php
/**
 * Provide a admin area view for the plugin
 *
 * @link       http://www.website.com
 * @since      1.0.0
 *
 */
?>

<div class="wrap">
   
    <h1><?php _e(get_admin_page_title()); ?></h1>

    <form action="options.php" method="post">
        <?php
        // Rendering the settings
        settings_errors();
        settings_fields(PN_SLUG . '-admin-page-settings');
        do_settings_sections(PN_SLUG . '-admin-page-settings');
        submit_button('Save');
        ?>
    </form>
    
</div><!-- END wrap -->