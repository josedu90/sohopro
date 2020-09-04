<?php
	$defaults = array(
		'button_title' => 'GT3 Button',
		'link' => '',
		'button_size' => 'normal',
		'button_alignment' => 'inline',
		'css_animation' => '',
		'item_el_class' => '',
		'css' => '',
		'use_reverse_button' => 'yes'
	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = '';

	$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

	// Link Settings
	$link_temp = vc_build_link($link);
	$url = $link_temp['url'];
	$btn_title = $link_temp['title'];
	$target = $link_temp['target'];
	if($url !== '') {
		$url = $url;
	} else {
		$url = '#';
	}
	if($btn_title !== '') {
		$title_for_button = 'title="' . $btn_title . '"' ;
	} else {
		$title_for_button = '';
	}
	if($target !== '') {
		$button_target = 'target="' . $target . '"' ;
	} else {
		$button_target = '';
	}

	// Animation
	if (! empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	} else {
		$animation_class = '';
	}

	$btn_custom_class = '';
	if ($use_reverse_button == 'yes') {
		$btn_custom_class = 'gt3_btn_reverse';
	}

	$compile .= '<div class="gt3_module_button ' . esc_attr($btn_custom_class) . ' button_alignment_' . esc_attr($button_alignment) . ' ' . esc_attr($animation_class) . ' ' . esc_attr($item_el_class) . '">';

	$compile .= '<a class="shortcode_button button_size_'. esc_attr($button_size) .' ' . esc_attr($css_class) . '" href="'.esc_attr($url).'" '.$title_for_button.' '.$button_target.'><span>' . (strlen($button_title) ? esc_attr($button_title) : '') . '</span></a>';

	$compile .= '</div>';
	
	echo (($compile));

?>
    
