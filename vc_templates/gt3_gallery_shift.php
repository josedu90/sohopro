<?php
$defaults = array(
	'images' => '',
	'controls' => 'on',
	'infinity_scroll' => 'on',
	'descr_type' => 'always',
	'expandeble' => 'on',
	'autoplay' => 'on',
	'interval' => '4000',
	'transition_time' => '600',
	'module_height' => '100%',
	'el_class' => ''
);


$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$title_tag = 'h2';
$caption_tag = 'div';

if ($autoplay == 'on') {
	$autoplay_class = 'autoplay';
} else {
	$autoplay_class = 'no_autoplay';
}
if ($infinity_scroll == 'off') {
	$autoplay_class = 'no_autoplay';
	$autoplay = 'off';
}
$compile = '';

$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );

wp_enqueue_script('gt3_shift_gallery_js', get_template_directory_uri() . '/js/shift_gallery.js', array(), false, true);
wp_enqueue_script('mousewheel_js', get_template_directory_uri() . '/js/jquery.mousewheel.js', array('jquery'), false, true);

if (is_array($images_ids)) {
	$base_count = 1;
	$even_count = 1;
	$odd_count = 1;	
	$uniqid = mt_rand(0, 9999);
	?>
    <div class="shift_gallery_wrapper <?php echo esc_attr($el_class); ?> personal_preloader controls_<?php echo esc_attr($controls); ?> shift_gal_<?php echo esc_attr($uniqid); ?>" 
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
        data-interval = "<?php echo esc_attr($interval); ?>" 
        data-expand = "<?php echo esc_attr($expandeble); ?>" 
        data-infinity = "<?php echo esc_attr($infinity_scroll); ?>" 
        data-transition = "<?php echo esc_attr($transition_time); ?>">
        
        <div class="shift_gallery wait4load expandeble_<?php echo esc_attr($expandeble); ?> title_state_<?php echo esc_attr($descr_type); ?>" 
			data-controls = "<?php echo esc_attr($controls); ?>" 
            data-title = "<?php echo esc_attr($descr_type); ?>" 
            data-height = "<?php echo esc_attr($module_height); ?>">
        	<?php
		foreach ($images_ids as $key => $value) {
			$photoTitle = get_the_title($value);
			$photoCaption = '';
			$attach_meta = gt3_get_attachment($value);
			$photoCaption = $attach_meta['caption'];
			$PCREpattern = '/\r\n|\r|\n/u';
			$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));
	
			if(($base_count % 2) == 0){
				$slide_class = 'even_slide'.$even_count;
				$slide_style = 'even_slide';
				$slide_data_count = $even_count;
				$even_count++;
			} else {
				$slide_class = 'odd_slide'.$odd_count;
				$slide_style = 'odd_slide';
				$slide_data_count = $odd_count;
				$odd_count++;
			}
			$base_count++;
			?>
            <div class="shift_slide gt3_js_transition shift_block2preload <?php echo esc_attr($slide_class) . ' ' . esc_attr($slide_style); ?> gt3_js_bg_img" data-transition = "<?php echo esc_attr($transition_time); ?>ms" data-count="<?php echo esc_attr($slide_data_count); ?>" data-src="<?php echo esc_url(wp_get_attachment_url($value)); ?>">
                <div class="shift_title_wrapper">
                    <?php echo '<' . esc_attr($title_tag); ?> class="shift_title"><?php echo esc_attr($photoTitle); ?><?php echo '</' . esc_attr($title_tag) . '>'; ?>
                </div>
                <div class="shift_preloader"></div>
                <div class="shift_hidder"></div>
            </div>            
        <?php }	?>
		</div><!-- .shift_gallery -->
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="shift_btn_prev sohopro_slider_button sohopro_slider_prev"><span class="sohopro_slider_button_inner"><span></span></span></a>
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="shift_btn_next sohopro_slider_button sohopro_slider_next"><span class="sohopro_slider_button_inner"><span></span></span></a>        
	</div><!-- .shift_gallery_wrapper -->
    <?php
}
?>