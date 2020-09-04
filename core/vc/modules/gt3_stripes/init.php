<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_stripes',
        'name' => esc_html__('Stripes', 'sohopro'),
        "description" => esc_html__("Displays stripes with image and custom link", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'as_parent' => array('only' => 'gt3_stripe_item'),
        'content_element' => true,
        'is_container' => true,
        'show_settings_on_create' => true,
        'params' => array(
			array(
                "type" => "textfield",
                "heading" => esc_html__("Module Height", "sohopro"),
                "param_name" => "module_height",
				"value" => '100%',
                "description" => esc_html__("Sets module height in px. Enter '100%' for fullheight mode.", "sohopro")
            ),		
            array(
                'type' => 'css_editor',
                'heading' => esc_html__('CSS', 'sohopro'),
                'param_name' => 'custom_css'
            ),
            array(
                'param_name' => 'custom_class',
                'heading' => esc_html__('Custom Class', 'sohopro'),
                'description' => '',
                'type' => 'textfield',
                'value' => '',
                'admin_label' => false,
                'weight' => 0,
            )
        ),
        'js_view' => 'VcColumnView'
    ));

    class WPBakeryShortCode_GT3_stripes extends WPBakeryShortCodesContainer
    {
    }
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_stripe_item',
        'name' => esc_html__('Stripe Item', 'sohopro'),
        "description" => esc_html__("Stripe Item", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        "as_child" => array('only' => 'gt3_stripes'),
        'is_container' => false,
        'show_settings_on_create' => true,		
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Add Image', 'sohopro'),
                'param_name' => 'image',
                'admin_label' => true,
                'description' => esc_html__('Select images from media library.', 'sohopro'),				
                'value' => ''
            ),
			array(
                "type" => "textfield",
                "heading" => esc_html__("Title", "sohopro"),
                "param_name" => "stripe_title",
				"value" => '',
            ),
			array(
                "type" => "textfield",
                "heading" => esc_html__("Description", "sohopro"),
                "param_name" => "stripe_descr",
				"value" => '',
            ),
            array(
                "type" => "vc_link",
                "heading" => esc_html__("Link", "sohopro"),
                "param_name" => "link",
                'value' => ''
            ),			
            array(
                'param_name' => 'custom_class',
                'heading' => esc_html__('Custom Class', 'sohopro'),
                'description' => '',
                'type' => 'textfield',
                'value' => '',
                'admin_label' => false,
                'weight' => 0,
            )
        )
    ));

    class WPBakeryShortCode_GT3_stripe_item extends WPBakeryShortCode
    {
    }
}