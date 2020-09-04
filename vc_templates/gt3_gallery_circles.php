<?php
$defaults = array(
	'images' => '',
	'lightbox' => 'on',
	'title_state' => 'on',
	'module_height' => '100%',
	'el_class' => '',
	'autoplay' => 'on',
	'interval' => '4000',
	'transition_time' => '1000',
	'border_width' => '15px',
	'border_color' => gt3_get_theme_option('body_bg'),
	'dec_cont' => '',
	'slider_top_cont' => '',
	'dec_px' => '',
	'slider_top_px' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$title_tag = 'h3';
$caption_tag = 'div';

if ($autoplay == 'on') {
	$autoplay_class = 'autoplay';
} else {
	$autoplay_class = 'no_autoplay';
}

$compile = '';

$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );

wp_enqueue_script('gt3_circles_gallery_js', get_template_directory_uri() . '/js/circles_gallery.js', array(), false, true);
if ($lightbox == 'on') {
	wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
}

if (is_array($images_ids)) {
	$uniqid = mt_rand(0, 9999);

	?>
    <div class="circles_slider_wrapper <?php echo esc_attr($el_class); ?> fadeOnLoad 
        circles_gal_<?php echo esc_attr($uniqid); ?>"
         
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
        data-interval = "<?php echo esc_attr($interval); ?>" 
    	data-transition = "<?php echo esc_attr($transition_time); ?>" 
        data-height="<?php echo esc_attr($module_height); ?>" 
        data-toppx = "<?php echo esc_attr($slider_top_px); ?>" 
        data-topcont = "<?php echo esc_attr($slider_top_cont); ?>" 
        data-deccont = "<?php echo esc_attr($dec_cont); ?>" 
        data-decpx = "<?php echo esc_attr($dec_px); ?>">
        
        <div class="circles_gallery_container circles_slider wait4load
			<?php echo esc_attr($autoplay_class); ?>" 
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
				class="circles_slide circles_block2preload gt3_js_transition circles_slide<?php echo esc_attr($count); ?>" 
                data-bWidth="<?php echo esc_attr($border_width); ?>" 
                data-bColor="<?php echo esc_attr($border_color); ?>" 
				data-count="<?php echo esc_attr($count); ?>" 
                data-transition = "<?php echo esc_attr($transition_time); ?>"
                data-title = "<?php echo esc_attr($photoTitle); ?>" 
                data-descr = "<?php echo esc_attr($photoCaption); ?>" >
                <img alt="<?php echo esc_attr($photoTitle); ?>" src="<?php echo aq_resize(esc_url(wp_get_attachment_url($image)), '1200', '1200', true, true, true); ?>"/>                
				<?php 
				if ($lightbox == 'on') {
					$featured_image = wp_get_attachment_url($image);
					echo '<a class="swipebox" data-rel="circles_swipebox_'. esc_attr($uniqid) .'" href="'. esc_url($featured_image) .'" title="'. esc_attr($photoTitle) .'" data-description="'. esc_attr($photoCaption) .'"></a>';
				}
				?>                
			</div>
            
        <?php
		$count++;
		}	?>
		</div><!-- .circles_gallery_container -->
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="circles_prevSlide sohopro_slider_button sohopro_slider_prev"><span class="sohopro_slider_button_inner"><span></span></span></a>
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="circles_nextSlide sohopro_slider_button sohopro_slider_next"><span class="sohopro_slider_button_inner"><span></span></span></a>
        <?php if ($title_state == 'on') { ?>
        <div class="circles_title_content">
            <?php echo '<' . esc_attr($title_tag); ?> class="circles_title">&nbsp;<?php echo '</' . esc_attr($title_tag) . '>'; ?>
            <?php echo '<' . esc_attr($caption_tag); ?> class="circles_descr">&nbsp;<?php echo '</' . esc_attr($caption_tag) . '>'; ?>
        </div>
        <?php } ?>
		<div class="circles_gallery_trigger personal_preloader"></div>
	</div><!-- .circles_slider_wrapper -->
    <?php
}
?>