<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery_grid',
        'name' => esc_html__('Gallery Grid', 'sohopro'),
        "description" => esc_html__("Gallery Grid/Masonry", "sohopro"),
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
                'type' => 'gt3_on_off',
                'heading' => esc_html__('Masonry Layout', 'sohopro'),
                'param_name' => 'masonry',
                'admin_label' => true,
                'description' => esc_html__('Turn ON or OFF masonry layout.', 'sohopro'),
				'value' => ''
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items in Row', 'sohopro'),
                'param_name' => 'items_in_row',
                'admin_label' => true,
                'value' => array(
					esc_html__("1 Item", "sohopro") => '1',
					esc_html__("2 Items", "sohopro") => '2',
					esc_html__("3 Items", "sohopro") => '3',
					esc_html__("4 Items", "sohopro") => '4',
					esc_html__("5 Items", "sohopro") => '5',
					esc_html__("6 Items", "sohopro") => '6'
                )
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Items on First Load", "sohopro"),
                "param_name" => "items_on_start",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '12'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Items on Load More", "sohopro"),
                "param_name" => "items_per_load",
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '4'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Paddings around the images", "sohopro"),
                "param_name" => "items_padding",
				'edit_field_class' => 'vc_col-sm-6',
				'description' => esc_html__('Please use this option to add paddings around the images. Recommended size in pixels 0-50. (Ex.: 15px):', 'sohopro'),
				'value' => '15px'
            ),
			
			array(
                "type" => "textfield",
                "heading" => esc_html__("Text", "sohopro"),
                "param_name" => "button_title",
                "value" => esc_html__("Load More", "sohopro")
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

    class WPBakeryShortCode_Gt3_Gallery_Grid extends WPBakeryShortCode
    {
    }
}