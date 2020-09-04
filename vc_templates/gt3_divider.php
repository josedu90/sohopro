<?php
$defaults = array(
	'divider_width' => '100px',
	'divider_height' => '1px',
	'divider_color' => '',
	'divider_align' => '',
	'custom_class' => '',
	'custom_css' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);

?> 
<div class="gt3_divider_wrapper gt3_divider_align_<?php echo esc_attr($divider_align); ?>">
    <div class="gt3_divider gt3_js_bg_color gt3_js_width gt3_js_height <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?>" 
        data-width="<?php echo esc_attr($divider_width); ?>"
        data-height="<?php echo esc_attr($divider_height); ?>"
        data-bgcolor="<?php echo esc_attr($divider_color); ?>">
    </div>
</div>
<?php
?>