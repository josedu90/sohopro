<?php
	$defaults = array(
		'thumbnail' => '',
		'name' => '',
		'position' => '',
		'text' => ''
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = '';

	$icon = '';

	$content = rawurldecode( gt3_string_decoding( strip_tags( $content ) ) );

	$img_id = preg_replace( '/[^\d]/', '', $thumbnail );
	$featured_image = wp_get_attachment_image_src($img_id, 'single-post-thumbnail');
	if (strlen($featured_image[0]) > 0) {
		$icon = '<div class="gt3_team_avatar"><img src="' . esc_url($featured_image[0]) . '" alt="' . esc_html__('avatar', 'sohopro') . '" /></div>';
	}

	$compile .= '<div class="gt3_team_module">
		'.$icon.'
		<div class="gt3_team_info">
			' . (strlen($name) ? '<h3>' . esc_attr($name) . '</h3>' : '') . '
			' . (strlen($position) ? '<div class="team_position">' . esc_attr($position) . '</div>' : '') . '
			' . (strlen($text) ? '<p>' . $text . '</p>' : '') . '
			' . $content . '
		</div>
	</div>';
	
	echo (($compile));

?>  
