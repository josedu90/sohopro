<?php

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!class_exists('Vc_Manager')) {
    return;
}

require_once get_template_directory() . '/core/vc/custom_types/gt3_categories.php';
require_once get_template_directory() . '/core/vc/custom_types/gt3_element_pos.php';
require_once get_template_directory() . '/core/vc/custom_types/gt3_multi_select.php';
require_once get_template_directory() . '/core/vc/custom_types/gt3_on_off.php';
require_once get_template_directory() . '/core/vc/custom_types/gt3_packery_layout_select.php';	
require_once get_template_directory() . '/core/vc/custom_types/gt3_select_gallery.php';
require_once get_template_directory() . '/core/vc/custom_types/image_select.php';

add_action('vc_before_init', 'gt3_vcSetAsTheme');
function gt3_vcSetAsTheme()
{
    vc_set_as_theme($disable_updater = true);
}

/* List of Active VC Modules */
$gt3_vc_modules = array(
	'gt3_albums_grid',
	'gt3_blog_related',
    'gt3_blog_listing',
	'gt3_blog_grid',
	'gt3_divider',
	'gt3_gallery_circles',
	'gt3_gallery_flow',
	'gt3_gallery_fs',
	'gt3_gallery_grid',
	'gt3_gallery_kenburns',
	'gt3_gallery_packery',
	'gt3_gallery_ribbon',
	'gt3_gallery_shift',
	'gt3_gallery_stripe',
	'gt3_promo_block',	
	'gt3_stripes',
	'gt3_thumbs_gallery',
	'gt3_counter',
	'gt3_icon_box',
	'gt3_price_block',
	'gt3_message_box',
	'gt3_testimonials',
	'gt3_portfolio_grid',
	'gt3_portfolio_packery',
	'gt3_button',
	'gt3_video_popup',
	'gt3_services',
	'gt3_image_slider',
	'gt3_spacing',
	'gt3_sharing',
	'gt3_custom_meta',
	'gt3_team',
);

if (class_exists('WooCommerce')) {
    array_push($gt3_vc_modules, 'gt3_shop_list');
}

foreach ($gt3_vc_modules as $gt3_vc_module) {
    require_once get_template_directory() . '/core/vc/modules/' . $gt3_vc_module . '/init.php';
}

/* Accordion */
vc_remove_param( 'vc_tta_accordion', 'color' );
vc_remove_param( 'vc_tta_accordion', 'spacing' );
vc_remove_param( 'vc_tta_accordion', 'gap' );
vc_remove_param( 'vc_tta_accordion', 'shape' );
vc_remove_param( 'vc_tta_accordion', 'no_fill' );
vc_remove_param( 'vc_tta_accordion', 'c_icon' );
vc_remove_param( 'vc_tta_accordion', 'c_position' );
vc_remove_param( 'vc_tta_accordion', 'c_align' );
vc_add_param( 'vc_tta_accordion' , array(
	'type' => 'dropdown',
	'heading' => __( 'Accordion Style', 'sohopro' ),
	'param_name' => 'style',
	'value' => array(
		esc_html__( 'Standard', 'sohopro' ) => "gt3_standard",
		esc_html__( 'Alternative', 'sohopro' ) => "gt3_alternative",
	)
));

/* Toggle */
vc_remove_param( 'vc_toggle', 'use_custom_heading' );
vc_remove_param( 'vc_toggle', 'custom_font_container' );
vc_remove_param( 'vc_toggle', 'custom_use_theme_fonts' );
vc_remove_param( 'vc_toggle', 'custom_google_fonts' );
vc_remove_param( 'vc_toggle', 'custom_css_animation' );
vc_remove_param( 'vc_toggle', 'custom_el_class' );
vc_remove_param( 'vc_toggle', 'color' );
vc_remove_param( 'vc_toggle', 'size' );

vc_add_param( 'vc_toggle' , array(
	'type' => 'dropdown',
	'heading' => __( 'Style', 'sohopro' ),
	'param_name' => 'style',
	'value' => array(
		esc_html__( 'Standard', 'sohopro' ) => "gt3_standard",
		esc_html__( 'Alternative', 'sohopro' ) => "gt3_alternative",
	)
));

/* Progress Bar */
vc_remove_param( 'vc_progress_bar', 'options' );
vc_add_param( 'vc_progress_bar' , array(
	'type' => 'dropdown',
	'heading' => __( 'Style', 'sohopro' ),
	'param_name' => 'bgcolor',
	'value' => array(
		esc_html__( 'Standard', 'sohopro' ) => "gt3_standard",
		esc_html__( 'Alternative', 'sohopro' ) => "gt3_alternative",
	)
));
vc_add_param( 'vc_progress_bar' , array(
	'type' => 'param_group',
	'heading' => __( 'Values', 'sohopro' ),
	'param_name' => 'values',
	'description' => __( 'Enter values for graph - value and title.', 'sohopro' ),
	'value' => urlencode(json_encode( array(
		array(
			'label' => __( 'Development', 'sohopro' ),
			'value' => '90',
		),
		array(
			'label' => __( 'Design', 'sohopro' ),
			'value' => '80',
		),
		array(
			'label' => __( 'Marketing', 'sohopro' ),
			'value' => '70',
		),
	))),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Label', 'sohopro' ),
			'param_name' => 'label',
			'description' => __( 'Enter text used as title of bar.', 'sohopro' ),
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Value', 'sohopro' ),
			'param_name' => 'value',
			'description' => __( 'Enter value of bar.', 'sohopro' ),
			'admin_label' => true,
		),
	)
));


/* Tabs */
vc_remove_param( 'vc_tta_tabs', 'shape' );
vc_remove_param( 'vc_tta_tabs', 'color' );
vc_remove_param( 'vc_tta_tabs', 'spacing' );
vc_remove_param( 'vc_tta_tabs', 'gap' );
vc_remove_param( 'vc_tta_tabs', 'pagination_style' );
vc_remove_param( 'vc_tta_tabs', 'pagination_color' );
vc_remove_param( 'vc_tta_tabs', 'no_fill_content_area' );
vc_remove_param( 'vc_tta_tabs', 'style' );

/* Tour (Vertical Tabs) */
vc_remove_param( 'vc_tta_tour', 'style' );
vc_remove_param( 'vc_tta_tour', 'shape' );
vc_remove_param( 'vc_tta_tour', 'color' );
vc_remove_param( 'vc_tta_tour', 'spacing' );
vc_remove_param( 'vc_tta_tour', 'gap' );
vc_remove_param( 'vc_tta_tour', 'pagination_style' );
vc_remove_param( 'vc_tta_tour', 'pagination_color' );
vc_remove_param( 'vc_tta_tour', 'no_fill_content_area' );
vc_remove_param( 'vc_tta_tour', 'alignment' );
vc_remove_param( 'vc_tta_tour', 'controls_size' );

if(class_exists('Vc_Manager')) {
	$list = array(
		'port',
		'post',
		'page'
	);
	vc_set_default_editor_post_types( $list );
}
