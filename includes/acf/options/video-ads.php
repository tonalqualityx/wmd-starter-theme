<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies

if( function_exists('acf_add_local_field_group') ) {

    $args = array(
        'key' => 'group_video_ads',
        'title' => 'Video Ad Settings',
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
                    'value' => 'acf-options-video-ads',
                ),
            ),
        ),
        'fields' => array(

            // Textarea called Video Ad Code
            // array(
            //     'key' => 'field_video_ad_code',
            //     'label' => 'Video Ad Code',
            //     'name' => 'video_ad_code',
            //     'type' => 'textarea',
            // ),

            // Group called Global Settings
            array(
                'key' => 'group_global_settings',
                'label' => 'Global Settings',
                'name' => 'global_settings',
                'type' => 'group',
                'sub_fields' => array(

                    // Inside Global Settings a number field called Clicks with the instruction "The number of clicks required to show a video ad"
                    array(
                        'key' => 'field_global_clicks',
                        'label' => 'Clicks',
                        'name' => 'clicks',
                        'type' => 'number',
                        'instructions' => 'The number of clicks required to show a video ad',
                        'wrapper' => array(
                            'width' => '25',
                        ),     
                    ),

                    // Inside the Global Settings a number field called Likelihood that is a percentage field with the instruction "The likelihood that a video ad will be shown"
                    array(
                        'key' => 'field_global_likelihood',
                        'label' => 'Likelihood',
                        'name' => 'likelihood',
                        'type' => 'number',
                        'instructions' => 'The likelihood that a video ad will be shown',
                        'append' => '%',
                        'wrapper' => array(
                            'width' => '25',
                        ),  
                    ),
                ),
            ),

            array(
                'key' => 'group_categories',
                'label' => 'Overrides',
                'name' => 'group_categories',
                'type' => 'group',
                'sub_fields' => array(

                    array(
                        'key' => 'group_red_button',
                        'label' => 'Red Button',
                        'name' => 'red_button',
                        'type' => 'group',
                        'sub_fields' => array(

                            array(
                                'key' => 'field_red_button_override',
                                'label' => 'Override',
                                'name' => 'override_red_button',
                                'type' => 'true_false',
                                'ui' => 1,
                                'instructions' => 'Override the global settings for this category',
                                'wrapper' => array(
                                    'width' => '25',
                                ),
                            ),

                            // Inside the group a number field called Clicks with the instruction "The number of clicks required to show a video ad"
                            array(
                                'key' => 'field_red_button_clicks',
                                'label' => 'Clicks',
                                'name' => 'clicks_red_button',
                                'type' => 'number',
                                'instructions' => 'The number of clicks required to show a video ad',
                                'wrapper' => array(
                                    'width' => '25',
                                ),   
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_red_button_override',
                                            'operator' => '==',
                                            'value' => '1',
                                        ),
                                    ),
                                ),  
                            ),

                            // Inside the group a number field called Likelihood that is a percentage field with the instruction "The likelihood that a video ad will be shown"
                            array(
                                'key' => 'field_red_button_likelihood',
                                'label' => 'Likelihood',
                                'name' => 'likelihood_red_button',
                                'type' => 'number',
                                'instructions' => 'The likelihood that a video ad will be shown',
                                'append' => '%',
                                'wrapper' => array(
                                    'width' => '25',
                                ),  
                                'conditional_logic' => array(
                                    array(
                                        array(
                                            'field' => 'field_red_button_override',
                                            'operator' => '==',
                                            'value' => '1',
                                        ),
                                    ),
                                ), 
                            ),
                        ),
                    ),
                    
                ),
            )
        ),
    );
    
    $cats = ctrb_get_all_categories();

    $cat_fields = array();

    foreach( $cats as $cat ) {
        // Group called $cat->category_name

        $new_field = array(
            'key' => 'group_' . $cat->category_name,
            'label' => $cat->category_name,
            'name' => 'cat_' . $cat->id,
            'type' => 'group',
            'sub_fields' => array(

                array(
                    'key' => 'field_' . $cat->category_name . '_override',
                    'label' => 'Override',
                    'name' => 'override_' . $cat->id,
                    'type' => 'true_false',
                    'ui' => 1,
                    'instructions' => 'Override the global settings for this category',
                    'wrapper' => array(
                        'width' => '25',
                    ),
                ),

                // Inside the group a number field called Clicks with the instruction "The number of clicks required to show a video ad"
                array(
                    'key' => 'field_' . $cat->category_name . '_clicks',
                    'label' => 'Clicks',
                    'name' => 'clicks_' . $cat->id,
                    'type' => 'number',
                    'instructions' => 'The number of clicks required to show a video ad',
                    'wrapper' => array(
                        'width' => '25',
                    ),   
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $cat->id . '_override',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),  
                ),

                // Inside the group a number field called Likelihood that is a percentage field with the instruction "The likelihood that a video ad will be shown"
                array(
                    'key' => 'field_' . $cat->category_name . '_likelihood',
                    'label' => 'Likelihood',
                    'name' => 'likelihood_' . $cat->id,
                    'type' => 'number',
                    'instructions' => 'The likelihood that a video ad will be shown',
                    'append' => '%',
                    'wrapper' => array(
                        'width' => '25',
                    ),  
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_' . $cat->id . '_override',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ), 
                ),
            ),
        );

        $group_categories_index = array_search('group_categories', array_column($args['fields'], 'key'));


        $args['fields'][$group_categories_index]['sub_fields'][] = $new_field;
    }



    acf_add_local_field_group( $args );
}