<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_testimonials',
        'name' => esc_html__('Testimonials', 'sohopro'),
        'description' => esc_html__('Display testimonials', 'sohopro'),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'js_view' => 'VcColumnView',
        "as_parent" => array('only' => 'gt3_testimonial_item'),
        "content_element" => true,
        'show_settings_on_create' => false,
        'params' => array(
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use testimonials carousel?', 'sohopro' ),
                'param_name' => 'use_carousel',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay time.', 'sohopro' ),
                'param_name' => 'auto_play_time',
                'value' => '3000',
                'description' => esc_html__( 'Enter autoplay time in milliseconds.', 'sohopro' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'sohopro'),
                'param_name' => 'posts_per_line',
                'value' => array(
                    esc_html__("1", "sohopro") => '1',
                    esc_html__("2", "sohopro") => '2',
                    esc_html__("3", "sohopro") => '3',
                    esc_html__("4", "sohopro") => '4',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "sohopro"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "sohopro")
            ),
            // Testimonials Text Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Testimonials Text Font Size', 'sohopro'),
                'param_name' => 'testimonilas_text_size',
                'value' => '18',
                'description' => esc_html__( 'Enter testimonials text font-size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Testimonials Text Fonts
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Text Color", "sohopro"),
                "param_name" => "text_color",
                "value" => esc_attr(gt3_get_theme_option('text_color')),
                "description" => esc_html__("Select text color for this item.", "sohopro"),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Testimonials Author Font Size', 'sohopro'),
                'param_name' => 'testimonilas_author_size',
                'value' => '14',
                'description' => esc_html__( 'Enter testimonials author font-size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Sign Color", "sohopro"),
                "param_name" => "sign_color",
                "value" => esc_attr(gt3_get_theme_option('additional_text_color')),
                "description" => esc_html__("Select sign color for this item.", "sohopro"),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Testimonials Position Font Size', 'sohopro'),
                'param_name' => 'testimonilas_position_size',
                'value' => '12',
                'description' => esc_html__( 'Enter testimonials author font-size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Testimonials Position", "sohopro"),
                "param_name" => "position_color",
                "value" => esc_attr(gt3_get_theme_option('text_color')),
                "description" => esc_html__("Select sign color for this item.", "sohopro"),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Image setting section
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Width', 'sohopro' ),
                'param_name' => 'img_width',
                'value' => '80',
                'description' => esc_html__( 'Enter image width in pixels.', 'sohopro' ),
                "group" => "Styling",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Height', 'sohopro' ),
                'param_name' => 'img_height',
                'value' => '80',
                'description' => esc_html__( 'Enter image height in pixels.', 'sohopro' ),
                "group" => "Styling",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Circular Images?', 'sohopro' ),
                'param_name' => 'round_imgs',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
                'std' => 'yes',
                "group" => "Styling",
            ),
        )
    ));
    
    // Testimonial item options
    vc_map(array(
        "name" => esc_html__("Testimonial item", "sohopro"),
        "base" => "gt3_testimonial_item",
        "class" => "gt3_info_list",
        "category" => esc_html__('GT3 Modules', 'sohopro'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "as_child" => array('only' => 'gt3_testimonials'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Author name", "sohopro"),
                "param_name" => "tstm_author",
                "value" => "",
                "description" => esc_html__("Provide a title for this list item.", "sohopro"),
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Position", "sohopro"),
                "param_name" => "tstm_position",
                "value" => "",
                "description" => esc_html__("Provide a position for this list item.", "sohopro"),
            ),
            // Image Section
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'sohopro' ),
                'param_name' => 'image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'sohopro' ),
                'admin_label' => true,
            ),
            array(
                "type" => "textarea_html",
                "class" => "",
                "heading" => esc_html__("Description", "sohopro"),
                "param_name" => "content",
                "value" => "",
                "description" => esc_html__("Description about this list item", "sohopro")
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select Rate', 'sohopro'),
                'param_name' => 'select_rate',
                'value' => array(
                    esc_html__("none", "sohopro") => 'none',
                    esc_html__("1", "sohopro") => '1',
                    esc_html__("2", "sohopro") => '2',
                    esc_html__("3", "sohopro") => '3',
                    esc_html__("4", "sohopro") => '4',
                    esc_html__("5", "sohopro") => '5',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "sohopro"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "sohopro")
            )
        )
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Testimonials extends WPBakeryShortCodesContainer
        {
        }
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Testimonial_Item extends WPBakeryShortCode
        {
        }
    }
}