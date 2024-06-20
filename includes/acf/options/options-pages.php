<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Options',
        'menu_title'    => 'Theme Options',
        'menu_slug'     => 'options',
        'capability'    => 'manage_options',
        'position'      => 30,
        'icon_url'      => 'dashicons-admin-generic',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Code',
        'menu_title'    => 'Code',
        'parent_slug'   => 'options',
    ));


    // acf_add_options_sub_page(array(
    //     'page_title'    => 'Design',
    //     'menu_title'    => 'Design',
    //     'parent_slug'   => 'options',
    // ));

    // acf_add_options_sub_page(array(
    //     'page_title'    => 'Footer',
    //     'menu_title'    => 'Footer',
    //     'parent_slug'   => 'options',
    // ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Video Ads',
        'menu_title'    => 'Video Ads',
        'parent_slug'   => 'options',
    ));

}

