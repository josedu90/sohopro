<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        "name" => esc_html__("GT3 Button", "sohopro"),
        "base" => "gt3_button",
        "class" => "gt3_button",
        "category" => esc_html__('GT3 Modules', 'sohopro'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Add custom button","sohopro"),
        "params" => array(
            // Text
            array(
                "type" => "textfield",
                "heading" => esc_html__("Text", "sohopro"),
                "param_name" => "button_title",
                "value" => esc_html__("GT3 Button", "sohopro")
            ),
            // Link
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'sohopro' ),
                'param_name' => 'link',
                "description" => esc_html__("Add link to button.", "sohopro")
            ),
            // Size
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Size', 'sohopro' ),
                'param_name' => 'button_size',
                "value"         => array(
                    esc_html__( 'Normal', 'sohopro' )   => 'normal',
                    esc_html__( 'Large', 'sohopro' )     => 'large'
                ),
                "description" => esc_html__("Select button display size.", "sohopro")
            ),
            // Alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'sohopro' ),
                'param_name' => 'button_alignment',
                "value"         => array(
                    esc_html__( 'Inline', 'sohopro' )      => 'inline',
                    esc_html__( 'Left', 'sohopro' )     => 'left',
                    esc_html__( 'Right', 'sohopro' )   => 'right',
                    esc_html__( 'Center', 'sohopro' )     => 'center',
                    esc_html__( 'Block', 'sohopro' )      => 'block'
                ),
                "description" => esc_html__("Select button alignment.", "sohopro")
            ),
            // --- SPACING GROUP --- //
            array(
                'type' => 'css_editor',
                'param_name' => 'css',
                'group' => esc_html__( 'Spacing', 'sohopro' ),
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "sohopro"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "sohopro")
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use reverse button?', 'sohopro' ),
                'param_name' => 'use_reverse_button',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
                'description' => esc_html__( 'Use button reverse.', 'sohopro' ),
                'std' => 'yes'
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Button extends WPBakeryShortCode {
        }
    }
}