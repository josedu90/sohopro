<?php
	$defaults = array(
		'tstm_author' => '',
		'tstm_position' => '',
		'image' => '',
		'img_width' => '80',
		'img_height' => '80',
		'round_imgs' => true,
		'item_el_class' => '',
		'testimonilas_text_size' => '18',
		'testimonilas_author_size' => '14',
		'testimonilas_position_size' => '12',
		'css' => ''
	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);
	$compile = '';
	extract($_POST['gt3_testimonials_opts']);

	$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

	$img_id = preg_replace( '/[^\d]/', '', $image );
	$featured_image = wp_get_attachment_image_src($img_id, 'single-post-thumbnail');
	if (strlen($featured_image[0]) > 0) {
	  $featured_image_url = $featured_image[0];
	} else {
	  $featured_image_url = "";
	}

	$text_size_html = $text_color_html = $text_style_html = $sign_color_html = $position_color_html = $title_color_html = $position_size_html = '';
	if ($text_color != '') {
	    $text_color_html = ' color: '.$text_color.';';
	}
	$text_l_h = '';
	if ($testimonilas_text_size != '') {
		$text_l_h = $testimonilas_text_size*1.67;
	    $text_size_html = ' font-size: '.$testimonilas_text_size.'px;';
	    $text_size_html .= ' line-height: '.$text_l_h.'px;';
	}

	if (($text_color_html != '') || ($testimonilas_text_size != '') ) {
		$text_style_html = ' style="'.esc_attr($text_color_html).esc_attr($text_size_html).'"';
	}
	
	if ($sign_color != '') {
	    $sign_color_html = ' color: '.$sign_color.';';
	}

	if ($position_color != '') {
		$position_color_html = ' color: '.$position_color.';';
	}

	$position_l_h = '';
	if ($testimonilas_position_size != '') {
		$position_l_h = $testimonilas_position_size*1.67;
		$position_size_html = ' font-size: '.$testimonilas_position_size.'px;';
		$position_size_html .= ' line-height: '.$position_l_h.'px;';
	}

	$position_styles = $position_color_html . $position_size_html;

	if (strlen($position_styles) > 0) {
		$position_styles_css = 'style="'.esc_attr($position_color_html) . esc_attr($position_size_html).'"';
	} else {
		$position_styles_css = '';
	}

	$testimonilas_author_lh = $testimonilas_author_lh_var = '';
	$testimonilas_author_lh_var = $testimonilas_author_size*1.43;
	$testimonilas_author_size = !empty($testimonilas_author_size) ? ' font-size: '.$testimonilas_author_size.'px;' : '';
	$testimonilas_author_lh = !empty($testimonilas_author_size) ? ' line-height: '.$testimonilas_author_lh_var.'px;' : '';
	
	$star_rate = '';
	if ( !empty($select_rate) && $select_rate != "none" ) {
		$star_rate = '<p class="testimonials-rate-wrap">';
		for ($i = 1; $i <= $select_rate; $i++) {
			$star_rate .= '<i class="fa fa-star"></i>';
		}
		for ($i; $i <= 5; $i++) {
			$star_rate .= '<i class="fa fa-star grey"></i>';
		}
		$star_rate .= '</p>';
	}
	$round_imgs = $round_imgs ? 'class=testimonials_round_img ' : '';

	$sign_styles = !empty($sign_color) || !empty($testimonilas_author_size) ? ' style="' . esc_attr($sign_color_html) . esc_attr($testimonilas_author_size) . esc_attr($testimonilas_author_lh) . '"' : '';
	$compile .= '
        <div class="testimonials_item">
            <div class="testimonial_item_wrapper">
                <div class="testimonials_content">
                    <div class="testimonials-text" ' . $text_style_html . '>'. wpb_js_remove_wpautop( $content, true ) .'</div>
                    '. (!empty($featured_image_url) ? '<div class="testimonials_photo"><img '.esc_attr($round_imgs).' src="' . aq_resize($featured_image_url, $img_width*2, $img_height*2, true, true, true) . '" alt="' . esc_html__('featured image', 'sohopro') . '" style="width:' . esc_attr($img_width) . 'px; height:' . esc_attr($img_height) . 'px;" /></div>' : '' ) .'
                    '.$star_rate.'
                    <div class="testimonials_title"' . $sign_styles . '>' . esc_html($tstm_author) . '</div>
                    ' . (strlen($tstm_position) ? '<div class="testimonials_position" ' . $position_styles_css . '>' . esc_html($tstm_position) . '</div>' : '') . '
                </div>
            </div>
        </div>';
	
	echo (($compile));
?>
    
