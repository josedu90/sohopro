<?php
$defaults = array(
	'images' => '',
	'module_height' => '100%',
	'el_class' => '',
	'interval' => '4000',
	'transition_time' => '1000',
	'overlay_state' => 'on',
	'overlay_bg' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$compile = '';

$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );

wp_enqueue_script('gt3_kenburns_js', get_template_directory_uri() . '/js/kenburns.js', array(), false, true);

if (is_array($images_ids)) {
	$uniqid = mt_rand(0, 9999);
	?>
    <div class="kenburns_wrapper <?php echo esc_attr($el_class); ?> fadeOnLoad"
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-interval = "<?php echo esc_attr($interval); ?>" 
    	data-transition = "<?php echo esc_attr($transition_time); ?>"
        data-height="<?php echo esc_attr($module_height); ?>">
        
        <div class="kenburns_container">            
        	<?php
		$array_compile = "";
		foreach ($images_ids as $key => $image) {			
			$array_compile .= esc_url(wp_get_attachment_url($image)) . ', ';
		} ?>
		</div><!-- .kenburns_container -->
		<?php if ($overlay_state == 'on') {
			echo '<div class="kenburns_overlay gt3_js_bg_color" data-bgcolor="'. esc_attr($overlay_bg) .'"></div>';
		}
		?>
        <div class="kenburns_data_keeper" data-array="<?php echo esc_attr($array_compile); ?>"></div>
	</div><!-- .fs_gallery_wrapper -->
    
    <?php
}
?>