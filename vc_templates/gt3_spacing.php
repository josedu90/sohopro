<?php
	$defaults = array(
		'height' => '',
		'responsive_es' => '',
		'height_size_sm_desctop' => '',
		'height_tablet' => '',
		'height_mobile' => '',

	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$classes = '';
	if ($responsive_es == 'true') {
		$classes .= !empty($height_size_sm_desctop) ? ' gt3_spacing-height_size_sm_desctop-on' : '';
		$classes .= !empty($height_tablet) ? ' gt3_spacing-height_tablet-on' : '';
		$classes .= !empty($height_mobile) ? ' gt3_spacing-height_mobile-on' : '';
	}

	$compile = '';
	if (!empty($height)) {
		$compile .= '<div class="gt3_spacing'.esc_attr($classes).'">';
		$compile .= '<div class="gt3_spacing-height gt3_spacing-height_default" style="height:'.(int)$height.'px;"></div>';
		if ($responsive_es == 'true') {
			$compile .= !empty($height_size_sm_desctop) ? ' <div class="gt3_spacing-height gt3_spacing-height_size_sm_desctop" style="height:'.(int)$height_size_sm_desctop.'px;"></div>' : '';
			$compile .= !empty($height_tablet) ? ' <div class="gt3_spacing-height gt3_spacing-height_tablet" style="height:'.(int)$height_tablet.'px;"></div>' : '';
			$compile .= !empty($height_mobile) ? ' <div class="gt3_spacing-height gt3_spacing-height_mobile" style="height:'.(int)$height_mobile.'px;"></div>' : '';
		}
		$compile .= '</div>';
	}	
	echo (($compile));

?>  
