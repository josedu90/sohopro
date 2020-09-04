<?php
$defaults = array(
	'module_height' => '100%',
	'custom_css' => '',
	'custom_class' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$width = '800';
$height = '800';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);
$compile = '';
$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );
$uniqid = mt_rand(0, 9999);
	?>
<div class="gt3_stripes_wrapper <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class) . ' ' . $custom_class; ?>">
    <div class="gt3_stripes gt3_js_height" data-height="<?php echo esc_attr($module_height); ?>">
        <?php echo do_shortcode($content); ?>
    </div><!-- .gt3_stripes -->
</div><!-- .gt3_stripes_wrapper -->
    <?php
?>