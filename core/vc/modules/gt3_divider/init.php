<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_divider',
        'name' => esc_html__('Divider', 'sohopro'),
        "description" => esc_html__("Displays divider with additional options", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Divider Align', 'sohopro' ),
                'param_name' => 'divider_align',
                "value" => array(
					esc_html__('Left', 'sohopro') => 'left',
                    esc_html__('Center', 'sohopro') => 'center',
					esc_html__('Right', 'sohopro') => 'right'
                ),
			),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Divider Width", "sohopro"),
				"edit_field_class" => "vc_col-sm-6",
                "param_name" => "divider_width",
                "description" => esc_html__("Sets divider width in px or '100%' for fullwidth mode.", "sohopro"),
				"value" => "100px"
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Divider Height", "sohopro"),
				"edit_field_class" => "vc_col-sm-6",
                "param_name" => "divider_height",
                "description" => esc_html__("Sets divider width in px or '100%' for fullwidth mode.", "sohopro"),
				"value" => "1px"
            ),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Divider Color", "sohopro"),
                "param_name" => "divider_color",
                "value" => "",
                "description" => esc_html__("Select divider color.", "sohopro")
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

    class WPBakeryShortCode_GT3_Divider extends WPBakeryShortCode
    {
    }
}