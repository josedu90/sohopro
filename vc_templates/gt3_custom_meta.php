<?php
$defaults = array(
	'select_layout' => 'horizontal',
	'select_alignment' => 'align_left',
	'custom_colors' => '',
	'label_color' => '',
	'value_color' => '',
	'custom_class' => '',
	'custom_css' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);

$gt3_meta_values = vc_param_group_parse_atts($atts['gt3_meta_values']);

echo '<div class="gt3_meta_values_wrapper '. esc_attr($custom_class) .' '. esc_attr($css_class) . ' ' . $select_layout . ' ' . $select_alignment . '">';
foreach ( $gt3_meta_values as $value ) {
	if ($custom_colors == true) {
	?>
        <div class="gt3_meta_values_item gt3_js_color" data-color="<?php echo (($value_color)); ?>">
            <span class="gt3_meta_values_title gt3_js_color" data-color="<?php echo (($label_color)); ?>"><?php echo (($value['label'])); ?></span>
            <?php echo (($value['value'])); ?>
        </div>    
    <?php
	} else {
	?>
        <div class="gt3_meta_values_item">
            <span class="gt3_meta_values_title"><?php echo (($value['label'])); ?></span>
            <?php echo (($value['value'])); ?>
        </div>
    <?php
	}
}
echo '</div>';
?>