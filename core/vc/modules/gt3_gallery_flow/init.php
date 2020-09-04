<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery_flow',
        'name' => esc_html__('Gallery Flow', 'sohopro'),
        "description" => esc_html__("Gallery Flow", "sohopro"),
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
                "type" => "textfield",
                "heading" => esc_html__("Image Width in PX", "sohopro"),
                "param_name" => "img_width",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '1383'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Image Height in PX", "sohopro"),
                "param_name" => "img_height",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '1000'
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
                'heading' => esc_html__('Show Title', 'sohopro'),
                'param_name' => 'title_state',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF titles on slide', 'sohopro'),
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
            ),
        )
    ));

    class WPBakeryShortCode_Gt3_Gallery_Flow extends WPBakeryShortCode
    {
    }
}