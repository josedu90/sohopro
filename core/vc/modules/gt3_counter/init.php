<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    // Add list item
    vc_map(array(
        "name" => esc_html__("Counter", "sohopro"),
        "base" => "gt3_counter",
        "class" => "gt3_counter",
        "category" => esc_html__('GT3 Modules', 'sohopro'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Adds your milestones, achievements, etc.","sohopro"),
        "params" => array(
            // Icon Type
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Icon Type", "sohopro"),
                "param_name" => "icon_type",
                "value" => array(
                    esc_html__("Font","sohopro") => "font",
                    esc_html__("Image","sohopro") => "image",
                    esc_html__("None","sohopro") => "none",
                ),
                "description" => esc_html__("Use an existing font icon or upload a custom image.", "sohopro")
            ),
            // Icon
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'sohopro'),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                "dependency" => Array("element" => "icon_type","value" => array("font")),
                'description' => esc_html__( 'Select icon from library.', 'sohopro' ),
            ),
            // Image
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'sohopro'),
                'param_name' => 'image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'sohopro' ),
                "dependency" => Array("element" => "icon_type","value" => array("image")),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Width', 'sohopro'),
                'param_name' => 'img_width',
                'value' => '50',
                'description' => esc_html__( 'Enter image width in pixels.', 'sohopro' ),
                "dependency" => Array("element" => "icon_type","value" => array("image")),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Image Proportions', 'sohopro'),
                'param_name' => 'image_proportions',
                'value' => array(
                    esc_html__("Original", "sohopro") => 'original',
                    esc_html__("Square", "sohopro") => 'square',
                    esc_html__("Circle", "sohopro") => 'circle',
                ),
                "dependency" => Array("element" => "img_width", "not_empty" => true),
            ),
            // General Params
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon Position', 'sohopro'),
                'param_name' => 'icon_position',
                'value' => array(
                    esc_html__("Top", "sohopro") => 'top',
                    esc_html__("Left", "sohopro") => 'left',
                    esc_html__("Right", "sohopro") => 'right',
                    esc_html__("Bottom", "sohopro") => 'bottom',
                ),
                "dependency" => Array("element" => "icon_type","value" => array("image", "font")),
            ),
            // Content alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content alignment', 'sohopro' ),
                'param_name' => 'content_alignment',
                "value"         => array(
                    esc_html__( 'Center', 'sohopro' ) => 'center',
                    esc_html__( 'Left', 'sohopro' ) => 'left',
                    esc_html__( 'Right', 'sohopro' ) => 'right'
                ),
                "description" => esc_html__("Select content alignment.", "sohopro"),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array( 'none' ),
                ),
            ),
            array(
                "type" => "textarea",
                "class" => "",
                "heading" => esc_html__("Counter Title ", "sohopro"),
                "param_name" => "counter_title",
                "admin_label" => true,
                "value" => "",
                "description" => esc_html__("Enter title for stats counter block", "sohopro")
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Counter Value", "sohopro"),
                "param_name" => "counter_value",
                "value" => "241",
                "description" => esc_html__("Enter number for counter without any special character. You may enter a decimal number. Eg 12.76", "sohopro")
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Counter Value Prefix", "sohopro"),
                "param_name" => "counter_prefix",
                "value" => "",
                "description" => esc_html__("Enter prefix for counter value", "sohopro")
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Counter Value Suffix", "sohopro"),
                "param_name" => "counter_suffix",
                "value" => "",
                "description" => esc_html__("Enter suffix for counter value", "sohopro")
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "sohopro"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "sohopro")
            ),
            // Counter Title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Counter Title Font Size', 'sohopro'),
                'param_name' => 'counter_title_size',
                'value' => '16',
                'description' => esc_html__( 'Enter counter title font-size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Counter Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for counter title?', 'sohopro' ),
                'param_name' => 'use_theme_fonts_counter_title',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_counter_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'sohopro' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'sohopro' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_counter_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'sohopro' ),
            ),
            // Counter Value Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Counter Value Font Size', 'sohopro'),
                'param_name' => 'counter_value_size',
                'value' => '48',
                'description' => esc_html__( 'Enter counter value font-size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Counter Value Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for counter value?', 'sohopro' ),
                'param_name' => 'use_theme_fonts_counter_value',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_counter_value',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'sohopro' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'sohopro' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_counter_value',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'sohopro' ),
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Icon Color", "sohopro"),
                "param_name" => "icon_color",
                "value" => esc_attr(gt3_get_theme_option('theme_color')),
                "description" => esc_html__("Select color for this item.", "sohopro"),
                "dependency" => Array("element" => "icon_type","value" => array("font")),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon Size', 'sohopro' ),
                'param_name' => 'icon_size',
                "value"         => array(
                    esc_html__( 'Normal', 'sohopro' )   => 'normal',
                    esc_html__( 'Mini', 'sohopro' )      => 'mini',
                    esc_html__( 'Small', 'sohopro' )     => 'small',
                    esc_html__( 'Large', 'sohopro' )     => 'large',
                    esc_html__( 'Extra Large', 'sohopro' )      => 'extralarge'
                ),
                "dependency" => Array("element" => "icon_type","value" => array("font")),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'save_always' => true,
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Counter Value Color", "sohopro"),
                "param_name" => "counter_value_color",
                "value" => esc_attr(gt3_get_theme_option('theme_color')),
                "description" => esc_html__("Select color for this item.", "sohopro"),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Title Color", "sohopro"),
                "param_name" => "title_color",
                "value" => esc_attr(gt3_get_theme_option('text_color2')),
                "description" => esc_html__("Select color for this item.", "sohopro"),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Counter extends WPBakeryShortCode {
        }
    }
}