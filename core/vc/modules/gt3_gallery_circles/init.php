<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery_circles',
        'name' => esc_html__('Gallery Circles', 'sohopro'),
        "description" => esc_html__("Displays Circles Gallery", "sohopro"),
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
                'heading' => esc_html__('Lightbox', 'sohopro'),
                'param_name' => 'lightbox',
                'admin_label' => true,
                'description' => esc_html__("If it's turned ON you can open active slide image in lightbox", "sohopro"),
				'value' => ''
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__('Show Title & Caption', 'sohopro'),
                'param_name' => 'title_state',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF titles and captions', 'sohopro'),
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
                "heading" => esc_html__("Image border width", "sohopro"),
                "param_name" => "border_width",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '15px',
                "description" => esc_html__("Example: 15px", "sohopro")
            ),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Image border color", "sohopro"),
                "param_name" => "border_color",
                "value" => gt3_get_theme_option('body_bg'),
                "description" => esc_html__("Select color for border.", "sohopro"),
                'edit_field_class' => 'vc_col-sm-6',
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

    class WPBakeryShortCode_Gt3_Gallery_Circles extends WPBakeryShortCode
    {
    }
}