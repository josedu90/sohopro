<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_blog_related',
        'name' => esc_html__('Blog Related Posts', 'sohopro'),
        "description" => esc_html__("Displays related blog posts", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items to Show', 'sohopro' ),
                'param_name' => 'post_to_show',
                "value" => array(
					esc_html__('2 Items', 'sohopro') => '2',
                    esc_html__('3 Items', 'sohopro') => '3',
                    esc_html__('4 Items', 'sohopro') => '4'
                ),
			),
			array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Order By', 'sohopro' ),
                'param_name' => 'orderby',
                "value" => array(
					esc_html__('Random', 'sohopro') => 'rand',
                    esc_html__('Date', 'sohopro') => 'date',
                    esc_html__('Name', 'sohopro') => 'name'
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Space between items", "sohopro"),
                "param_name" => "set_pad",
				'value' => '30px'
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

    class WPBakeryShortCode_gt3_blog_Related extends WPBakeryShortCode
    {
    }
}