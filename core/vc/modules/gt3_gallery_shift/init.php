<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery_shift',
        'name' => esc_html__('Gallery Shift', 'sohopro'),
        "description" => esc_html__("Gallery Shift", "sohopro"),
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
                'heading' => esc_html__('Show Control Buttons', 'sohopro'),
                'param_name' => 'controls',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF control buttons.', 'sohopro'),
				'value' => 'on'
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__('Infinite Scroll', 'sohopro'),
                'param_name' => 'infinity_scroll',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF infinite  scrolling. Autoplay will work only on infinite scroll.', 'sohopro'),
				'value' => 'on'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Title State', 'sohopro'),
                'param_name' => 'descr_type',
                'admin_label' => true,
                'value' => array(
					esc_html__("Always Show", "sohopro") => 'always',
					esc_html__("Always Hide", "sohopro") => 'hide',
					esc_html__("Show on Hover", "sohopro") => 'on_hover',
					esc_html__("Show when slide is expanded", "sohopro") => 'expanded',
                )
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
                "type" => "textfield",
                "heading" => esc_html__("Module Height", "sohopro"),
                "param_name" => "module_height",
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
				'value' => 'on'
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

    class WPBakeryShortCode_Gt3_Gallery_Shift extends WPBakeryShortCode
    {
    }
}