<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies
function wmd_create_custom_tables() {

    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $current_version = get_site_option('wmd_db_version');

    // Check if the site option wmd_db_version is set
    if ( !$current_version ) {
        
        // The setup has never run...

        // add_site_option('wmd_db_version', '1.0');

    }

    return get_site_option('wmd_db_version');
}

add_action('after_switch_theme', 'wmd_create_custom_tables');
