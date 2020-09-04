<?php
	include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
	$defaults = array(
		'icon_type' => '',
		'icon_fontawesome' => '',
		'thumbnail' => '',
		'icon_position' => '',
		'heading' => '',
		'text' => '',
		'url' => '',
		'url_text' => '',
		'new_tab' => '',
		'icon_size' => '',
		'custom_icon_size' => '42',
		'icon_color' => esc_attr(gt3_get_theme_option('theme_color')),
		'icon_circle' => '',
		'circle_bg' => '#212125',
		'title_tag' => 'h3',
		'title_color' => '',
		'link_color' => '',
		'link_hover_color' => '',
 		'iconbox_title_size' => '',
		'iconbox_content_size' => '',
		'text_color' => '',
		'divider_color' => '',
		'animation_class' => '',
		"add_divider" => '',
		'content_alignment' => 'center'
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = '';

	$blank = $new_tab == 'true' ? ' target="_blank"' : '';

	$icon = $space_icon = $space_icon_end = '';

	// Icon Color
	if ($icon_color != '') {
		$icon_color_style = 'color: ' . esc_attr($icon_color) . '; ';
	} else {
		$icon_color_style = ' ';
	}

	$custom_icon_size_space = $icon_size == 'custom' ? $custom_icon_size : '';
	$custom_icon_size_space = (bool) $icon_circle ? $custom_icon_size * 2 : $custom_icon_size;
	$space_icon = ($icon_size == 'custom' && ($icon_position == 'left' || $icon_position == 'right')) ? "<div class='block_center_icon' style='width:". ($custom_icon_size_space + 30) ."px'>" : "";
	$space_icon_end = ($icon_size == 'custom' && ($icon_position == 'left' || $icon_position == 'right')) ? "</div>" : "";

	if ($icon_type == 'font' && !empty($icon_fontawesome)) {
		wp_enqueue_style("font_awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
		$icon_style = $icon_size == 'custom' ? 'font-size:'.esc_attr($custom_icon_size).'px' : '';
		$icon = ''.$space_icon.'<i class="gt3_icon_box__icon '.esc_attr($icon_fontawesome).'" style="' . $icon_color_style . ' '.esc_attr($icon_style).'">'.((bool) $icon_circle ? '<span class="gt3_icon_box__icon-bg" style="background-color:'.esc_attr($circle_bg).'"></span>' : '').'</i>'.$space_icon_end.'';
	}

	if ($icon_type == 'image' && !empty($thumbnail)) {
		$icon_style = $icon_size == 'custom' ? ' style="width:'.esc_attr($custom_icon_size).'px; font-size:'.esc_attr($custom_icon_size).'px"' : '';
		$thumbnail = !empty($thumbnail) ? wp_get_attachment_image( $thumbnail , 'full') : '';
		$icon = ''.$space_icon.'<i class="gt3_icon_box__icon" '.$icon_style.'>'.((bool) $icon_circle ? '<span class="gt3_icon_box__icon-bg" style="background-color:'.esc_attr($circle_bg).'"></span>' : '').$thumbnail.'</i>'.$space_icon_end.'';
	}

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_iconbox_title', 'google_fonts_iconbox_content') ) );

	if ( ! empty( $styles_google_fonts_iconbox_title ) ) {
		$iconbox_title_font = '' . esc_attr( $styles_google_fonts_iconbox_title ) . ';';
	} else {
		$iconbox_title_font = '';
	}

	if ( ! empty( $styles_google_fonts_iconbox_content ) ) {
		$iconbox_content_font = '' . esc_attr( $styles_google_fonts_iconbox_content ) . ';';
	} else {
		$iconbox_content_font = '';
	}

	// Font Size of Title
	if ($iconbox_title_size != '') {
		$iconbox_title_line = $iconbox_title_size * 1.125;
		$iconbox_title_css = 'font-size: ' . $iconbox_title_size . 'px; line-height: ' . $iconbox_title_line . 'px; ';
	} else {
		$iconbox_title_css = ' ';
	}

	// Font Size of Content
	if ($iconbox_content_size != '') {
		$iconbox_content_line = $iconbox_content_size * 1.875;
		$iconbox_content_css = 'font-size: ' . $iconbox_content_size . 'px; line-height: ' . $iconbox_content_line . 'px; ';
	} else {
		$iconbox_content_css = ' ';
	}

	// Animation
	if (! empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	} else {
		$animation_class = '';
	}

	if (!empty($heading)) {
		$heading_cont = '<div class="gt3_icon_box__title">'.($icon_position == "inline_title" ? $icon : '').'<'.esc_html($title_tag).' style="color:'.esc_attr($title_color).';'. esc_attr($iconbox_title_font) . esc_attr($iconbox_title_css) .'">';
			$heading_cont .= !empty($url) ? '<a href="'.esc_url($url).'"'.$blank.'>' : '';
				$heading_cont .= esc_html($heading);
			$heading_cont .= !empty($url) ? '</a>' : '';
		$heading_cont .= '</'.esc_html($title_tag).'></div>';

	}else{
		$heading_cont = '';
	}

	if (!empty($text) || !empty($heading_cont) || !empty($url_text)) {
		$custom_icon_size = $icon_size == 'custom' ? $custom_icon_size : '';
		$custom_icon_size = (bool) $icon_circle ? $custom_icon_size * 2 : $custom_icon_size;
		$space = ($icon_size == 'custom' && ($icon_position == 'left' || $icon_position == 'right')) ? 'style=margin-'.$icon_position.':'. ($custom_icon_size + 30) .'px' : '';
		$content = '<div class="gt3_icon_box-content-wrapper" '.esc_attr($space).' >';
			$content .= $heading_cont;
			$content .= (bool) $add_divider ? '<div class="gt3_icon_box-divider" '.(!empty($divider_color) ? 'style="border-bottom-color:'.esc_attr($divider_color).'"' : '' ).' ></div>' : '';
			$content .= !empty($text) ?'<div class="gt3_icon_box__text" style="color:'.esc_attr($text_color).';'.esc_attr($iconbox_content_font) . esc_attr($iconbox_content_css).'">'.$text.'</div>' : '';
			$content .= !empty($url_text) ?'<div class="gt3_icon_box__link" style="color:'.(!empty($link_hover_color) ? esc_attr($link_hover_color) : esc_attr($title_color)) .';'.esc_attr($iconbox_content_font).'">'.(!empty($url) ? '<a class="learn_more" href="'.esc_url($url).'" style="color:'.esc_attr($link_color) .';'.esc_attr($iconbox_content_css).'"'.$blank.'>'.esc_html($url_text).'<span></span></a>' : '').'</div>' : '';

		$content .= '</div>';
	}else{
		$content .= '';
	}

	$module_class = '';
	$module_class .= ' gt3_icon_box_icon-position_'.$icon_position;
	$module_class .= ' gt3_content_alignment_'.$content_alignment;
	$module_class .= ' gt3_icon_box__icon_icon_size_'.$icon_size;
	$module_class .= ' '.$animation_class;
	$module_class .= (bool) $icon_circle ? ' icon-bg' : '';
	$module_class .= $icon_type == 'image' && !empty($thumbnail) ? ' gt3-box-image' : '';

	$compile .= '<div class="gt3_icon_box '.esc_attr($module_class).'">';
		$compile .= $icon_position !== "inline_title" ? $icon : '';
		$compile .= $content;
	$compile .= '</div>';
	
	echo (($compile));

?>  
