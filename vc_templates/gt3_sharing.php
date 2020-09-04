<?php
$defaults = array(
	'custom_class' => '',
	'custom_css' => '',
	'custom_color' => '',
	'link_color' => '',
    'sharing_label' => '',
    'sharing_alignment' => 'left'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);

$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
if (strlen($featured_image[0])>0) {
	$pinterest_img = esc_url($featured_image[0]);
} else {
	$pinterest_img = esc_url(gt3_get_theme_option("logo"));
}

$sharing_label_start = $sharing_label_end = '';

if ($sharing_label !== '') {
    $sharing_label_start = '<span class="gt3_contact_label">';
    $sharing_label_end = '</span>';
}

if ($custom_color == true) {
?>
    <div class="gt3_sharing_module <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?> sharing_alignment_<?php echo esc_attr($sharing_alignment); ?>">
        <?php echo (($sharing_label_start . esc_html($sharing_label) . $sharing_label_end)) ?>
        <a target="_blank"
           href="<?php echo esc_url('https://www.facebook.com/share.php?u='. get_permalink()); ?>" class="share_facebook gt3_js_color" data-color="<?php echo (($link_color)); ?>"><?php echo esc_html__('Facebook', 'sohopro'); ?></a>
        <a target="_blank"
           href="<?php echo esc_url('https://twitter.com/intent/tweet?text='. get_the_title() .'>&amp;url='. get_permalink()); ?>" class="share_twitter gt3_js_color" data-color="<?php echo (($link_color)); ?>"><?php echo esc_html__('Twitter', 'sohopro'); ?></a>
        <a target="_blank"
           href="<?php echo esc_url('https://plus.google.com/share?url='. get_permalink()); ?>" class="share_gplus gt3_js_color" data-color="<?php echo (($link_color)); ?>"><?php echo esc_html__('Google', 'sohopro'); ?></a>
        <a target="_blank"
           href="<?php echo esc_url('https://pinterest.com/pin/create/button/?url='. get_permalink() .'>&media='. $pinterest_img); ?>" class="share_pinterest gt3_js_color" data-color="<?php echo (($link_color)); ?>"><?php echo esc_html__('Pinterest', 'sohopro'); ?></a>
    </div>
<?php
} else {
?>
    <div class="gt3_sharing_module <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?> sharing_alignment_<?php echo esc_attr($sharing_alignment); ?>">
        <?php echo (($sharing_label_start . esc_html($sharing_label) . $sharing_label_end)) ?>
        <a target="_blank"
           href="<?php echo esc_url('https://www.facebook.com/share.php?u='. get_permalink()); ?>" class="share_facebook"><?php echo esc_html__('Facebook', 'sohopro'); ?></a>
        <a target="_blank"
           href="<?php echo esc_url('https://twitter.com/intent/tweet?text='. get_the_title() .'>&amp;url='. get_permalink()); ?>" class="share_twitter"><?php echo esc_html__('Twitter', 'sohopro'); ?></a>
        <a target="_blank"
           href="<?php echo esc_url('https://plus.google.com/share?url='. get_permalink()); ?>" class="share_gplus"><?php echo esc_html__('Google', 'sohopro'); ?></a>
        <a target="_blank"
           href="<?php echo esc_url('https://pinterest.com/pin/create/button/?url='. get_permalink() .'>&media='. $pinterest_img); ?>" class="share_pinterest"><?php echo esc_html__('Pinterest', 'sohopro'); ?></a>	
    </div>
<?php
}
?>