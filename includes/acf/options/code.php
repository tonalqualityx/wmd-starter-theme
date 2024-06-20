<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies

if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_code',
        'title' => 'Code',
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => 1,
        'description' => '',
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-code',
                ),
            ),
        ),
        'fields' => array(
            array(
                'key' => 'field_header_code',
                'label' => 'Header',
                'name' => 'header_code',
                'type' => 'textarea',
                'rows' => 10,
            ),
            array(
                'key' => 'field_body_code',
                'label' => 'Body',
                'name' => 'body_code',
                'type' => 'textarea',
                'rows' => 10,
            ),
            array(
                'key' => 'field_footer_code',
                'label' => 'Footer',
                'name' => 'footer_code',
                'type' => 'textarea',
                'rows' => 10,
            ),
            array(
                'key' => 'field_use_side_ads',
                'label' => 'Use Side Ads',
                'name' => 'use_side_ads',
                'type' => 'true_false',
                'message' => 'Enable side ads',
                'ui' => 1,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_use_computer_ad',
                'label' => 'Use Computer Ad',
                'name' => 'use_computer_ad',
                'type' => 'true_false',
                'message' => 'Enable computer ad',
                'ui' => 1,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_ad_snippet_code',
                'label' => 'Ad Snippet',
                'name' => 'ad_snippet_code',
                'type' => 'textarea',
                'rows' => 10,
            ),
        ),
    ));
}
