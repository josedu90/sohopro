<?php
add_gt3_code( 'gt3_select_gallery' , 'gt3_select_gallery_function', '');
function gt3_select_gallery_function($settings, $value) {
	$gt3_return = '';
	$default = isset($settings['default']) ? $settings['default'] : 'on';

	$args = array(
		'post_type' => 'gallery',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'paged' => -1
	);
	
	$gt3_return .= '<select class="gt3_gallery_select wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . '">';
	query_posts($args);
	
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			$current_id = get_the_id();
			if ($current_id == $value) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			$gt3_return .= '<option '. $selected .' value="'. $current_id .'">'. get_the_title() .'</option>';
		}
		wp_reset_query();
	}
			
	$gt3_return .= '
	</select>
	';
	return $gt3_return;
	
}
?>