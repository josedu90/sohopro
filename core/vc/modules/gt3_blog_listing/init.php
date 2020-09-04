<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_blog_listing',
        'name' => esc_html__('Blog Listing', 'sohopro'),
        "description" => esc_html__("Displays blog posts with additional options", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Items per page", "sohopro"),
                "param_name" => "items_per_page",
				'value' => '7'
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

    class WPBakeryShortCode_GT3_Blog_Listing extends WPBakeryShortCode
    {
    }
}