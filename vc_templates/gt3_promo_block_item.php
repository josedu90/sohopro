<?php
$defaults = array(
	'image' => '',
	'promo_block_title' => '',
	'link' => '',
	'custom_class' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$compile = '';
$uniqid = mt_rand(0, 9999);

$featured_image = wp_get_attachment_url($image);

$btn_link_temp = vc_build_link($link);
$url = $btn_link_temp['url'];
if ($url !== '') {
	$url = esc_url($url);
} else {
	$url = '#';
}
$target = $btn_link_temp['target'];
if ($target !== '') {
	$set_target = esc_attr($target);
} else {
	$set_target = '';
}

	?>
    <div class="gt3_promo_block_item gt3_js_bg_img <?php echo esc_attr($custom_class); ?>"
    	data-link="<?php echo (($url)); ?>"
        data-target="<?php echo (($set_target)); ?>"
		data-src="<?php echo esc_url($featured_image); ?>"
        data-title="<?php echo esc_attr($promo_block_title); ?>">
	</div><!-- .gt3_promo_block_item -->
    <?php
?>