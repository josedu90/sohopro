<?php
$defaults = array(
	'module_height' => '100%',
	'items_margin' => '100px',
	'custom_css' => '',
	'custom_class' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

wp_enqueue_script('gt3_promo_block', get_template_directory_uri() . '/js/gt3_promo_block.js', array(), false, true);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);
$compile = '';
$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );
$uniqid = mt_rand(0, 9999);
	?>
<div class="gt3_promo_block_wrapper <?php echo esc_attr($el_class); ?> <?php echo esc_attr($css_class) . ' ' . esc_attr($custom_class); ?>" data-margin="<?php echo esc_attr($items_margin); ?>">
    <div class="gt3_promo_block gt3_js_height" data-height="<?php echo esc_attr($module_height); ?>">
        <?php echo do_shortcode($content); ?>
    </div><!-- .gt3_promo_block -->
</div><!-- .gt3_promo_block_wrapper -->
    <?php
?>