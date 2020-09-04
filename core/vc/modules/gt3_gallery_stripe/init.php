<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery_stripe',
        'name' => esc_html__('Gallery Striped', 'sohopro'),
        "description" => esc_html__("Striped Gallery Module", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'attach_images',
                'heading' => esc_html__('Add Images', 'sohopro'),
                'param_name' => 'images',
                'admin_label' => true,
                'description' => esc_html__('Select images from media library.', 'sohopro'),				
                'value' => ''
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__('Expandable slides', 'sohopro'),
                'param_name' => 'expandeble',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF expandable slides.', 'sohopro'),
				'value' => 'on'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Title State', 'sohopro'),
                'param_name' => 'title_state',
                'admin_label' => true,
                'value' => array(
					esc_html__("Always Show", "sohopro") => 'title_always',
					esc_html__("Show on Hover", "sohopro") => 'title_on_hover',
					esc_html__("Show on Expanded Slide", "sohopro") => 'title_exp',
					esc_html__("Always Hide", "sohopro") => 'title_hide'
                )
            ),			
            array(
                "type" => "textfield",
                "heading" => esc_html__("Module Height", "sohopro"),
                "param_name" => "module_height",
				"value" => '100%',
                "description" => esc_html__("Sets module height in px. Enter '100%' for fullheight mode.", "sohopro")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "sohopro"),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "sohopro")
            ),

            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__('Autoplay', 'sohopro'),
                'param_name' => 'autoplay',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF slider autoplay.', 'sohopro'),
				'group' => __( 'Autoplay Options', 'sohopro' ),
				'value' => ''
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Display Time", "sohopro"),
                "param_name" => "interval",
				'group' => __( 'Autoplay Options', 'sohopro' ),
                "description" => esc_html__("Sets time before change the slide in milliseconds", "sohopro"),
				'value' => '4000'
            ),			
            array(
                "type" => "textfield",
                "heading" => esc_html__("Transition Time", "sohopro"),
                "param_name" => "transition_time",
				'group' => __( 'Autoplay Options', 'sohopro' ),
                "description" => esc_html__("Sets Transition animation time", "sohopro"),
				'value' => '600'
            )
        )
    ));

    class WPBakeryShortCode_Gt3_Gallery_Stripe extends WPBakeryShortCode
    {
    }
}