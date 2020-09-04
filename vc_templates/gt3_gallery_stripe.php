<?php
$defaults = array(
	'images' => '',
	'expandeble' => 'on',
	'title_state' => 'title_always',
	'module_height' => '100%',
	'el_class' => '',
	'autoplay' => 'on',
	'interval' => '4000',
	'transition_time' => '600'
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

$compile = '';

$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );

wp_enqueue_script('gt3_stripe_gallery_js', get_template_directory_uri() . '/js/stripe_gallery.js', array(), false, true);

if (is_array($images_ids)) {
	$uniqid = mt_rand(0, 9999);
	?>
    <div class="stripe_gallery_wrapper <?php echo esc_attr($el_class); ?> fadeOnLoad 
    	<?php echo esc_attr($title_state); ?> 
        stripe_gal_<?php echo esc_attr($uniqid); ?>"
        
        data-expandeble = "<?php echo esc_attr($expandeble); ?>"
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
        data-interval = "<?php echo esc_attr($interval); ?>" 
    	data-transition = "<?php echo esc_attr($transition_time); ?>"
        data-height="<?php echo esc_attr($module_height); ?>"
        
        data-toppx = ""
        data-topcont = ""
        data-deccont = ""
        data-decpx = "">
        
        <div class="stripe_gallery_container stripe_slider 
			<?php echo esc_attr($autoplay_class); ?> " 
            data-interval="<?php echo esc_attr($interval); ?>" 
            data-autoplay="<?php echo esc_attr($autoplay); ?>">
            
        	<?php
		$count = 1;
		$thmb_compile = '';
		foreach ($images_ids as $key => $image) {
			$photoTitle = get_the_title($image);
			$photoCaption = '';
			$attach_meta = gt3_get_attachment($image);
			$photoCaption = $attach_meta['caption'];
			$PCREpattern = '/\r\n|\r|\n/u';
			$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));

			$slide_meta = wp_get_attachment_metadata($image);
			$slide_ratio = $slide_meta['width']/$slide_meta['height'];
			$slide_width = round($slide_meta['width']/10);
			$slide_height = round($slide_width/$slide_ratio);
			
			?>
			<div 
				class="stripe_slide gt3_js_transition slide_image stripe_block2preload stripe_slide<?php echo esc_attr($count); ?>" 
				data-count="<?php echo esc_attr($count); ?>" 
				data-src="<?php echo esc_url(wp_get_attachment_url($image)); ?>" 
				data-title="<?php echo esc_attr($photoTitle); ?>"
                data-descr="<?php echo esc_attr($photoCaption); ?>"
				data-type="image" 
                data-transition = "<?php echo esc_attr($transition_time); ?>">
                
                <div class="stripe_overlay"></div>
                <?php if($expandeble == 'on') {
                 echo '<span class="gt3_plus_icon"></span>';
				} ?>
                <div class="stripe_title_wrapper">
                    <div class="stripe_title_padding">
						<?php echo '<' . esc_attr($title_tag); ?> class="stripe_title"><?php echo esc_attr($photoTitle); ?><?php echo '</' . esc_attr($title_tag) . '>'; ?>
					</div>
				</div>
			</div>
		<?php
			$count++;	
		?>
            
        <?php }	?>
		</div><!-- .stripe_slider -->
        <div class="stripe_controls fadeOnLoad">
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="stripe_slider_prev sohopro_slider_button sohopro_slider_prev"><span class="sohopro_slider_button_inner"><span></span></span></a>
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="stripe_slider_next sohopro_slider_button sohopro_slider_next"><span class="sohopro_slider_button_inner"><span></span></span></a>
        </div>
		<div class="stripe_gallery_trigger personal_preloader"></div>
	</div><!-- .stripe_gallery_wrapper -->
    <?php
}
?>