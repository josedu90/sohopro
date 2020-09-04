<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Message Box", "sohopro"),
        "base" => "gt3_message_box",
        "class" => "gt3_message_box",
        "category" => esc_html__('GT3 Modules', 'sohopro'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Message Box","sohopro"),
        "params" => array(
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'sohopro' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'sohopro' ),
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Text", "sohopro"),
                "param_name" => "text",
                "description" => esc_html__("Enter text.", "sohopro")
            ),            
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Closable?', 'sohopro' ),
                "param_name"    => "closable",
                'save_always' => true,
                'std' => 'yes',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
            ),
            vc_map_add_css_animation( true ),
            // Styling
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Background Color', 'sohopro' ),
                "param_name"    => "background",
                "group"         => esc_html__( "Styling", 'sohopro' ),
                "value"         => esc_attr(gt3_get_theme_option('theme_color2')),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Text Color', 'sohopro' ),
                "param_name"    => "text_color",
                "group"         => esc_html__( "Styling", 'sohopro' ),
                "value"         => '#ffffff',
                'save_always' => true,
            ),                
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_message_box extends WPBakeryShortCode {
            
        }
    } 
}
