<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery_fs',
        'name' => esc_html__('Gallery Slider', 'sohopro'),
        "description" => esc_html__("Gallery Slider", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select the Source', 'sohopro'),
                'param_name' => 'select_source',
                'admin_label' => true,
				'std' => 'module_images',
                'value' => array(
					esc_html__("Use Module Images", "sohopro") => 'module_images',
					esc_html__("Use Gallery Post", "sohopro") => 'gallery_post'
                )
            ),
            array(
                'type' => 'gt3_select_gallery',
                'heading' => esc_html__('Select Gallery', 'sohopro'),
                'param_name' => 'select_gallery_post',
                'admin_label' => true,
                'description' => esc_html__('Select Gallery Post', 'sohopro'),
                'dependency' => array(
                    'element' => 'select_source',
                    'value' => 'gallery_post'
                ),
				'value' => ''
            ),
            array(
                'type' => 'attach_images',
                'heading' => esc_html__('Add Images', 'sohopro'),
                'param_name' => 'images',
                'admin_label' => true,
                'description' => esc_html__('Select images from media library.', 'sohopro'),
                'dependency' => array(
                    'element' => 'select_source',
                    'value' => 'module_images'
                ),				
                'value' => ''
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Animation Style', 'sohopro'),
                'param_name' => 'anim_style',
                'admin_label' => true,
                'value' => array(
					esc_html__("Fade In/Out", "sohopro") => 'fade',
					esc_html__("Slip in Side", "sohopro") => 'slip'
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Fit Style', 'sohopro'),
                'param_name' => 'fit_style',
                'admin_label' => true,
                'value' => array(
					esc_html__("Cover Slide", "sohopro") => 'no_fit',
					esc_html__("Fit Always", "sohopro") => 'fit_always',
					esc_html__("Fit Horizontal", "sohopro") => 'fit_width',
					esc_html__("Fit Vertical", "sohopro") => 'fit_height'
                )
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__('Show Controls and Titles', 'sohopro'),
                'param_name' => 'controls',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF control buttons, title and caption.', 'sohopro'),
				'value' => ''
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Navigation Type', 'sohopro'),
                'param_name' => 'nav_type',
                'admin_label' => true,
				'std' => 'thumbs',
                'value' => array(
					esc_html__("Thumbs", "sohopro") => 'thumbs',
					esc_html__("Bullets", "sohopro") => 'bullets',
					esc_html__("None", "sohopro") => 'none',
                )
            ),

            /*array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__('Show Thumbs', 'sohopro'),
                'param_name' => 'thumbs',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF slider thumbs.', 'sohopro'),
				'value' => ''
            ),*/
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
				'value' => '1000'
            )
        )
    ));

    class WPBakeryShortCode_Gt3_Gallery_Fs extends WPBakeryShortCode
    {
    }
}