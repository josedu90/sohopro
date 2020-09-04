<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_portfolio_packery',
        'name' => esc_html__('Portfolio Packery', 'sohopro'),
        "description" => esc_html__("Portfolio with Packery layout", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'gt3_categories',
                'heading' => esc_html__('Select Categories', 'sohopro'),
				'taxonomy' => 'portcat',
                'param_name' => 'gt3_category',
                'admin_label' => true,
                'description' => esc_html__('Select Categories to Display', 'sohopro'),
				'value' => ''
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Filter State', 'sohopro'),
                'param_name' => 'fitler_state',
                'admin_label' => true,
				'std' => 'on',
				'edit_field_class' => 'vc_col-sm-6',
                'value' => array(
					esc_html__("On", "sohopro") => 'on',
					esc_html__("Off", "sohopro") => 'off'
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Ajax', 'sohopro'),
                'param_name' => 'ajax',
                'admin_label' => true,
				'std' => 'on',
				'edit_field_class' => 'vc_col-sm-6',
                'value' => array(
					esc_html__("On", "sohopro") => 'on',
					esc_html__("Off", "sohopro") => 'off'
                )
            ),
            array(
                "type" => "gt3_packery_layout_select",
                "heading" => esc_html__("Select Layout", "sohopro"),
                "param_name" => "packery_layout",
				"val" => ''
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Layouts on First Load", "sohopro"),
                "param_name" => "layouts_on_start",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '1'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Layouts on Load More", "sohopro"),
                "param_name" => "layouts_per_load",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '1'
            ),
			array(
                "type" => "textfield",
                "heading" => esc_html__("Button Title", "sohopro"),
                "param_name" => "button_title",
				'edit_field_class' => 'vc_col-sm-6',
                "value" => esc_html__("Load More", "sohopro")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Paddings around the images", "sohopro"),
                "param_name" => "items_padding",
				'edit_field_class' => 'vc_col-sm-6',
				'description' => esc_html__('Please use this option to add paddings around the images. Recommended size in pixels 0-50. (Ex.: 15px):', 'sohopro'),
				'value' => '15px'
            ),
			array(
				'param_name' => 'custom_class',
				'heading' => esc_html__('Custom Class', 'sohopro'),
				'description' => '',
				'type' => 'textfield',
				'value' => '',
				'admin_label' => false,
				'weight' => 0,
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__('CSS', 'sohopro'),
				'param_name' => 'custom_css',
				'group' => esc_html__('Design options', 'sohopro'),
			)
			
        )
    ));

    class WPBakeryShortCode_Gt3_Portfolio_Packery extends WPBakeryShortCode
    {
    }
}