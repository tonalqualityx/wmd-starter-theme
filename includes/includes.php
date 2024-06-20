<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies
$files = [

    // #TODO add or uncomment files as necessary 

    // Setup
    '/includes/enqueues',
    '/includes/utilities',
    
    //Database
    // '/database/tables',


    // Options
    '/includes/acf/options/options-pages',
    '/includes/acf/options/code', 
    '/includes/acf/options/video-ads',



    // Endpoints
    '/api/test',



];

foreach ($files as $file) {
    // Your code here
    require_once( WMD_ROOT_PATH . $file . '.php' );
}