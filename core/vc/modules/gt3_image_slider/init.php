<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_image_slider',
        'name' => __('Image Slider', 'sohopro'),
        "description" => __("Display the image_slider", "sohopro"),
        'category' => __('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'attach_images',
                'heading' => __( 'Images', 'sohopro' ),
                'param_name' => 'images',
                'value' => '',
                'description' => __( 'Select images from media library.', 'sohopro' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Style', 'sohopro' ),
                'param_name' => 'slider_style',
                'value' => array(
                    __( 'Regular', 'sohopro' ) => '',
                    __( 'iPhone View', 'sohopro' ) => 'iphone_view',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Image size', 'sohopro' ),
                'param_name' => 'img_size',
                'value' => 'thumbnail',
                'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'sohopro' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable crop image for recommended size?', 'sohopro' ),
                'param_name' => 'crop_img_size_for_iphone',
                'value' => array( __( 'Yes', 'sohopro' ) => 'yes' ),
                'std' => 'yes',
                'description' => __( 'Recommended image size is 276x490 pixels.', 'sohopro' ),
                'dependency' => array(
                    'element' => 'slider_style',
                    'value' => array( 'iphone_view' ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Margin between slides', 'sohopro' ),
                'param_name' => 'margin_between_slides',
                "value"         => array(
                    __( '0px', 'sohopro' )   => '0',
                    __( '5px', 'sohopro' )   => '5',
                    __( '10px', 'sohopro' )  => '10',
                    __( '15px', 'sohopro' )  => '15',
                    __( '20px', 'sohopro' )  => '20',
                    __( '25px', 'sohopro' )  => '25',
                    __( '30px', 'sohopro' )  => '30',
                    __( '35px', 'sohopro' )  => '35',
                    __( '40px', 'sohopro' )  => '40',
                    __( '45px', 'sohopro' )  => '45',
                    __( '50px', 'sohopro' )  => '50',
                    __( '55px', 'sohopro' )  => '55',
                    __( '60px', 'sohopro' )  => '60'
                ),
                "description" => __("Select margin between slides.", "sohopro")
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'On click action', 'sohopro' ),
                'param_name' => 'onclick',
                'value' => array(
                    __( 'None', 'sohopro' ) => '',
                    __( 'Open popup', 'sohopro' ) => 'link_image',
                    __( 'Open custom link', 'sohopro' ) => 'custom_link',
                ),
                'description' => __( 'Select action for click action.', 'sohopro' ),
            ),
            array(
                'type' => 'exploded_textarea_safe',
                'heading' => __( 'Custom links', 'sohopro' ),
                'param_name' => 'custom_links',
                'description' => __( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'sohopro' ),
                'dependency' => array(
                    'element' => 'onclick',
                    'value' => array( 'custom_link' ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Custom link target', 'sohopro' ),
                'param_name' => 'custom_links_target',
                'description' => __( 'Select where to open  custom links.', 'sohopro' ),
                'dependency' => array(
                    'element' => 'onclick',
                    'value' => array( 'custom_link' ),
                ),
                'value' => array(
                    __( 'Same window', 'sohopro' ) => '',
                    __( 'New window', 'sohopro' ) => '_blank',
                ),
            ),
            // --- CAROUSEL --- //
            array(
                'type' => 'checkbox',
                'heading' => __( 'Autoplay carousel', 'sohopro' ),
                'param_name' => 'autoplay_carousel',
                'value' => array( __( 'Yes', 'sohopro' ) => 'yes' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Autoplay time.', 'sohopro' ),
                'param_name' => 'auto_play_time',
                'value' => '3000',
                'description' => __( 'Enter autoplay time in milliseconds.', 'sohopro' ),
                'dependency' => array(
                    'element' => 'autoplay_carousel',
                    'value' => array("yes"),
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Hide Pagination control', 'sohopro' ),
                'param_name' => 'use_pagination_carousel',
                'value' => array( __( 'Yes', 'sohopro' ) => 'yes' ),
                'std' => 'yes',
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => __("Extra Class", "sohopro"),
                "param_name" => "item_el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "sohopro")
            ),
        ),

    ));

    class WPBakeryShortCode_Gt3_Image_Slider extends WPBakeryShortCode {
    }
}