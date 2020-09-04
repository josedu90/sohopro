<?php
$defaults = array(
	'post_to_show' => '2',
	'orderby' => 'rand',
	'set_pad' => '30px',
	'custom_class' => '',
	'custom_css' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);

?>
<div class="gt3_related_posts_module <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?>">
	<?php
		gt3_get_featured_posts(array(
			'orderby' => $orderby,
			'set_pad' => $set_pad,
			'numberposts' => $post_to_show,
			'title' => ''
		));
	?>	
</div>
<?php
?>