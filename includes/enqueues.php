<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies

function load_custom_admin_stylesheet() {

    wp_enqueue_style('custom-admin-stylesheet', get_template_directory_uri() . '/css/admin.min.css', array(),  _S_VERSION );

}
add_action('admin_enqueue_scripts', 'load_custom_admin_stylesheet');

function wmd_enqueue_custom_styles() {

    wp_enqueue_style('wmd-main-style', get_stylesheet_directory_uri() . '/css/main.min.css', array(), _S_VERSION, 'all');

    wp_enqueue_script('adinplay-script', get_stylesheet_directory_uri() . '/js/adinplay.min.js', array(), _S_VERSION, false);

    wp_enqueue_script('adinplay-tag', '//api.adinplay.com/libs/aiptag/pub/PKP/clicktheredbutton.com/tag.min.js', array('adinplay-script'), _S_VERSION, array('in_footer' => false, 'strategy' => 'async'));

  
}
add_action('wp_enqueue_scripts', 'wmd_enqueue_custom_styles');