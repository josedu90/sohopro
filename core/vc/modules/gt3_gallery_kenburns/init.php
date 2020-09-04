<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery_kenburns',
        'name' => esc_html__('Gallery Kenburns', 'sohopro'),
        "description" => esc_html__("Gallery with Kenburns Effect", "sohopro"),
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
                "type" => "textfield",
                "heading" => esc_html__("Module Height", "sohopro"),
                "param_name" => "module_height",
				"value" => '100%',
                "description" => esc_html__("Sets module height in px. Enter '100%' for fullheight mode.", "sohopro")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Display Time", "sohopro"),
                "param_name" => "interval",
                "description" => esc_html__("Sets time before change the slide in milliseconds", "sohopro"),
				'value' => '4000'
            ),			
            array(
                "type" => "textfield",
                "heading" => esc_html__("Transition Time", "sohopro"),
                "param_name" => "transition_time",
                "description" => esc_html__("Sets Transition animation time", "sohopro"),
				'value' => '1000'
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__('Overlay', 'sohopro'),
                'param_name' => 'overlay_state',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF slides color overlay.', 'sohopro'),
				'edit_field_class' => 'vc_col-sm-6',
				'value' => ''
            ),			
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Overlay Background Color", "sohopro"),
                "param_name" => "overlay_bg",
                "value" => "",
                "description" => esc_html__("Select overlay color.", "sohopro"),
                'edit_field_class' => 'vc_col-sm-6',
            ),			
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "sohopro"),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "sohopro")
            )
        )
    ));

    class WPBakeryShortCode_Gt3_Gallery_Kenburns extends WPBakeryShortCode
    {
    }
}