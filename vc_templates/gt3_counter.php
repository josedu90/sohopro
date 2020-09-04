<?php
	include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
	$defaults = array(
		'icon_type' => 'font',
		'icon_fontawesome' => 'fa fa-adjust',
		'image' => '',
		'img_width' => '50',
		'icon_position' => 'top',
		'image_proportions' => 'original',
		'counter_title' => '',
		'counter_value' => '241',
		'counter_prefix' => '',
		'counter_suffix' => '',
		'item_el_class' => '',
		'css' => '',
		'icon_color' => esc_attr(gt3_get_theme_option('theme_color')),
		'icon_size' => 'normal',
		'counter_title_size' => '',
		'counter_value_size' => '',
		'title_color' => esc_attr(gt3_get_theme_option('text_color2')),
		'counter_value_color' => esc_attr(gt3_get_theme_option('theme_color')),
		'css_animation' => '',
		'content_alignment' => 'center'
	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = '';

	wp_enqueue_script('gt3_waypoint_js', get_template_directory_uri() . '/js/waypoint.js', array(), false, false);

	$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

	// Counter Title and Value Google Fonts

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	$shortc = $this->shortcode;
	extract( $obj->getAttributes( $atts, $this, $shortc, array('google_fonts_counter_title', 'google_fonts_counter_value') ) );

	if ( ! empty( $styles_google_fonts_counter_title ) ) {
		$counter_title_font = '' . esc_attr( $styles_google_fonts_counter_title ) . ' ';
	} else {
		$counter_title_font = '';
	}

	if ( ! empty( $styles_google_fonts_counter_value ) ) {
		$counter_value_font = '' . esc_attr( $styles_google_fonts_counter_value ) . ' ';
	} else {
		$counter_value_font = '';
	}

	if ($icon_type == 'font') {
		// Enqueue needed icon font.
		vc_icon_element_fonts_enqueue( 'fontawesome' );
	} else {
		$img_id = preg_replace( '/[^\d]/', '', $image );
		$featured_image = wp_get_attachment_image_src($img_id, 'single-post-thumbnail');
		if (strlen($featured_image[0]) > 0) {
		  $featured_image_url = $featured_image[0];
		} else {
		  $featured_image_url = "";
		}
	}

	// Icon block
	if ($icon_color != '') {
		$icon_color_style = 'style="color: ' . esc_attr($icon_color) . '; "';
	} else {
		$icon_color_style = '';
	}
	$imageblock_content = '';
	if ($icon_type == 'image') {
		if (strlen($featured_image_url))
			$img_height = '';
			if ($img_width != '') {
				if ($image_proportions == 'original') {
					$img_height = '';
				} else {
					$img_height = $img_width*2;
				}
				$imageblock_content .= '<div class="icon_container icon_proportions_' . esc_attr($image_proportions) . '"><img src="' . aq_resize($featured_image_url, $img_width*2, $img_height, true, true, true) . '" alt="' . esc_html__('icon', 'sohopro') . '" style="width:' . esc_attr($img_width) . 'px;" /></div>';
			} else {
				$imageblock_content .= '<div class="icon_container"><img src="' . esc_url($featured_image_url) . '" alt="' . esc_html__('icon', 'sohopro') . '" /></div>';
			}
	} else if ($icon_type == 'font') {
		$imageblock_content .= '<div class="icon_container"><span class="gt3_counter_icon counter_icon_size_' . esc_attr($icon_size) . ' ' . esc_attr($icon_fontawesome) . '" ' . $icon_color_style . '></span></div>';
	}

	// Counter Value
	if ($counter_value_color != '') {
		$counter_value_color_style = 'color: ' . esc_attr($counter_value_color) . '; ';
	} else {
		$counter_value_color_style = ' ';
	}
	if ($counter_value_size != '') {
		$counter_value_line = $counter_value_size;
		$counter_value_css = 'font-size: ' . esc_attr($counter_value_size) . 'px; line-height: ' . esc_attr($counter_value_line) . 'px; ';
	} else {
		$counter_value_css = ' ';
	}

	// Counter Title
	if ($title_color != '') {
		$title_color_style = 'color: ' . esc_attr($title_color) . '; ';
	} else {
		$title_color_style = ' ';
	}
	if ($counter_title_size != '') {
		$counter_title_line = $counter_title_size + 10;
		$counter_title_css = 'font-size: ' . esc_attr($counter_title_size) . 'px; line-height: ' . esc_attr($counter_title_line) . 'px; ';
	} else {
		$counter_title_css = ' ';
	}

	// Animation
	if (! empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	} else {
		$animation_class = '';
	}

	if ($icon_type == 'none') {
		$gt3_content_alignment = 'gt3_content_alignment_'.esc_attr($content_alignment);
	} else {
		$gt3_content_alignment = '';
	}

	$compile .= '<div class="gt3_module_counter '.$animation_class.' ' . (strlen($icon_position) ? 'icon-position-' . esc_attr($icon_position) . ' ' : ''). 'counter_icon_type_' . esc_attr($icon_type) . ' ' . $gt3_content_alignment . ' ' . esc_attr($css_class) . '">';
	if ($icon_position !== 'bottom') {
		$compile .= $imageblock_content;
	}

	$compile .= '<div class="stat_count_wrapper">';
		if($counter_value !== '') {
			$compile .= '<div class="stat_count" data-suffix="' . esc_html($counter_suffix) . '" data-prefix="' . esc_html($counter_prefix) . '" data-value="' . esc_html($counter_value) . '" style="' . $counter_value_color_style . $counter_value_font . $counter_value_css .'">' . esc_html($counter_prefix) . esc_html($counter_value) . esc_html($counter_suffix) . '</div>';
		}

		if($counter_title !== '') {
			$compile .= '<div class="cont_info" style="' . $title_color_style . $counter_title_font . $counter_title_css .'">' . $counter_title . '</div>';
		}
		$compile .= '<div class="stat_temp"></div></div>';

		if ($icon_position == 'bottom') {
			$compile .= $imageblock_content;
		}
	$compile .= '<div class="clear"></div></div>';
	
	echo (($compile));

?>
    
