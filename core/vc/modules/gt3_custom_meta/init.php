<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    // Add list item
    vc_map(array(
        "name" => esc_html__("Custom Meta", "sohopro"),
        "base" => "gt3_custom_meta",
        "class" => "gt3_custom_meta",
        "category" => esc_html__('GT3 Modules', 'sohopro'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Adds custom meta fields","sohopro"),
        "params" => array(
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Values', 'sohopro' ),
				'param_name' => 'gt3_meta_values',
				'description' => esc_html__( 'Enter values for meta - value and title', 'sohopro' ),
				'value' => '',
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Label', 'sohopro' ),
						'param_name' => 'label',
						'description' => esc_html__( 'Enter text used as title of meta.', 'sohopro' ),
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Value', 'sohopro' ),
						'param_name' => 'value',
						'description' => esc_html__( 'Enter value of meta.', 'sohopro' ),
						'admin_label' => true,
					),
				),
			),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select Layout', 'sohopro'),
                'param_name' => 'select_layout',
                'admin_label' => true,
				'std' => 'horizontal',
                'value' => array(
					esc_html__("Horizontal", "sohopro") => 'horizontal',
					esc_html__("Vertical", "sohopro") => 'vertical'
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select Alignment', 'sohopro'),
                'param_name' => 'select_alignment',
                'admin_label' => true,
				'std' => 'align_left',
                'value' => array(
					esc_html__("Left", "sohopro") => 'align_left',
					esc_html__("Center", "sohopro") => 'align_center',
					esc_html__("Right", "sohopro") => 'align_right'
                )
            ),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Customize Colors?', 'sohopro'),
				'param_name' => 'custom_colors',
				'description' => esc_html__( 'Enable crop image.', 'sohopro' ),
				'value' => esc_html__('Yes', 'sohopro')
			),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Label Color", "sohopro"),
                "param_name" => "label_color",
                "value" => '',
                "description" => esc_html__("Select color for border.", "sohopro"),
                'dependency' => array(
                    'element' => 'custom_colors',
                    'value' => 'true'
                )
            ),	
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Value Color", "sohopro"),
                "param_name" => "value_color",
                "value" => '',
                "description" => esc_html__("Select color for border.", "sohopro"),
                'dependency' => array(
                    'element' => 'custom_colors',
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
        class WPBakeryShortCode_GT3_Custom_Meta extends WPBakeryShortCode {
        }
    }
}