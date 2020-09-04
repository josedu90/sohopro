<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_thumbs_grid',
        'name' => esc_html__('Thumbs Grid', 'sohopro'),
        "description" => esc_html__("Show Thumbs Gallery", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select the Source', 'sohopro'),
                'param_name' => 'select_source',
                'admin_label' => true,
				'std' => 'gallery_post',
                'value' => array(
					esc_html__("Use Gallery Post", "sohopro") => 'gallery_post',
					esc_html__("Use Module Images", "sohopro") => 'module_images'
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
				'type' => 'checkbox',
				'heading' => esc_html__('Use Custom Title?', 'sohopro'),
				'param_name' => 'custom_title',
				'description' => esc_html__( 'Enable slider autoplay.', 'sohopro' ),
				'value' => esc_html__('Yes', 'sohopro')
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "sohopro"),
				"param_name" => "title",
				"value" => '',
                'dependency' => array(
                    'element' => 'custom_title',
                    'value' => 'true'
                )
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Show pictures count', 'sohopro'),
				'param_name' => 'pictures_count',
				'description' => esc_html__( 'Enable slider autoplay.', 'sohopro' ),
				'value' => esc_html__('Yes', 'sohopro')
			),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Thumbs Width", "sohopro"),
                "param_name" => "thumbs_width",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '100px'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Thumbs Height", "sohopro"),
                "param_name" => "thumbs_height",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '100px'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Paddings around the images", "sohopro"),
                "param_name" => "items_padding",
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

    class WPBakeryShortCode_Gt3_Thumbs_Grid extends WPBakeryShortCode
    {
    }
}