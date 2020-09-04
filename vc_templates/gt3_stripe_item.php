<?php
$defaults = array(
	'image' => '',
	'stripe_title' => '',
	'stripe_descr' => '',
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
	$set_target = 'target="' . esc_attr($target) . '"';
} else {
	$set_target = '';
}

	?>
    <div class="gt3_stripe gt3_js_height_child gt3_js_bg_img <?php echo esc_attr($custom_class); ?>" data-src="<?php echo esc_url($featured_image); ?>">
        <div class="gt3_stripe_content">
            <h2 class="gts_stripe_title"><?php echo esc_attr($stripe_title); ?></h2>
            <div class="gts_stripe_descr"><?php echo esc_attr($stripe_descr); ?></div>
        </div>
        <span class="gt3_plus_icon"></span>
        <div class="gt3_stripe_overlay"></div>
        <a href="<?php echo (($url)); ?>" class="gt3_stripe_link" <?php echo (($set_target)); ?>></a>
    </div><!-- .gt3_stripe -->
    <?php
?>