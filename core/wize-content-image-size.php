<?php
/* Special filters to enhance responsive images */

function wize_content_image_sizes_attr($sizes, $size) {
	$width = $size[0];
	if ( class_exists('Woocommerce') && is_woocommerce()) { // SHOP page
		$store_columns = gt3_get_theme_option('shop_sidebar_layout');
		if (gt3_get_theme_option('shop_sidebar_layout') == 'no-sidebar') {
    		$sizes = '50vw';
		} else {
    		$sizes = '(max-width: 768px) 50vw, (max-width: 1200px) 34vw, 400px';
		}
	}

	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'wize_content_image_sizes_attr', 10 , 2);

?>