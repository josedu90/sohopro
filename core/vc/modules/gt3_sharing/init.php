<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    // Add list item
    vc_map(array(
        "name" => esc_html__("Sharing", "sohopro"),
        "base" => "gt3_sharing",
        "class" => "gt3_sharing",
        "category" => esc_html__('GT3 Modules', 'sohopro'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Adds share links","sohopro"),
        "params" => array(
            // Text
            array(
                "type" => "textfield",
                "heading" => esc_html__("Sharing Label", "sohopro"),
                "param_name" => "sharing_label",
                "value" => ''
            ),
            // Alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content Alignment', 'sohopro' ),
                'param_name' => 'sharing_alignment',
                "value"         => array(
                    esc_html__( 'Left', 'sohopro' )     => 'left',
                    esc_html__( 'Right', 'sohopro' )   => 'right',
                    esc_html__( 'Center', 'sohopro' )     => 'center'
                ),
                "description" => esc_html__("Select button alignment.", "sohopro")
            ),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Customize Color?', 'sohopro'),
				'param_name' => 'custom_color',
				'description' => esc_html__( 'Enable crop image.', 'sohopro' ),
				'value' => esc_html__('Yes', 'sohopro')
			),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Link Color", "sohopro"),
                "param_name" => "link_color",
                "value" => '',
                "description" => esc_html__("Select color for border.", "sohopro"),
                'dependency' => array(
                    'element' => 'custom_color',
                    'value' => 'true'
                )
            ),
			array(
				'param_name' => 'custom_class',
				'heading' => esc_html__('Custom Class', 'sohopro'),
				'type' => 'textfield',
				'value' => '',
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__('CSS', 'sohopro'),
				'param_name' => 'custom_css',
				'group' => esc_html__('Design options', 'sohopro'),
			)
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Sharing extends WPBakeryShortCode {
        }
    }
}