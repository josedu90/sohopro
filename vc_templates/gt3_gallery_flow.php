<?php
$defaults = array(
	'select_source' => 'module_images',
	'select_gallery_post' => '',
	'images' => '',
	'img_width' => '1383',
	'img_height' => '1000',
	'lightbox' => 'on',
	'title_state' => 'on',
	'module_height' => '100%',
	'el_class' => '',
	'autoplay' => 'on',
	'interval' => '4000',
	'transition_time' => '600',
	'dec_cont' => '',
	'slider_top_cont' => '',
	'dec_px' => '',
	'slider_top_px' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

if ($autoplay == 'on') {
	$autoplay_class = 'autoplay';
} else {
	$autoplay_class = 'no_autoplay';
}

$title_tag = 'h2';
$caption_tag = 'div';
$compile = '';

$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );

wp_enqueue_script('gt3_flow_gallery_js', get_template_directory_uri() . '/js/flow_gallery.js', array(), false, true);
if ($lightbox == 'on') {
	wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
}

if (($select_source == 'module_images' && is_array($images_ids)) || ($select_source == 'gallery_post' && $select_gallery_post !== '')) { 
	$uniqid = mt_rand(0, 9999);
	?>
    <div class="flow_slider_wrapper <?php echo esc_attr($el_class); ?> fadeOnLoad title_is_<?php echo esc_attr($title_state); ?> 
        flow_gal_<?php echo esc_attr($uniqid); ?>"
         
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
        data-interval = "<?php echo esc_attr($interval); ?>" 
    	data-transition = "<?php echo esc_attr($transition_time); ?>" 
        data-height="<?php echo esc_attr($module_height); ?>" 
        data-toppx = "<?php echo esc_attr($slider_top_px); ?>" 
        data-topcont = "<?php echo esc_attr($slider_top_cont); ?>" 
        data-deccont = "<?php echo esc_attr($dec_cont); ?>" 
        data-decpx = "<?php echo esc_attr($dec_px); ?>">
        
        <div class="flow_gallery_container flow_slider wait4load wait4load2
			<?php echo esc_attr($autoplay_class); ?>" 
            data-interval="<?php echo esc_attr($interval); ?>" 
            data-autoplay="<?php echo esc_attr($autoplay); ?>">
            
        	<?php
		$count = 1;
		$thmb_compile = '';
		if ($select_source == 'module_images' && is_array($images_ids)) {
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
					class="flow_slide flow_block2preload gt3_js_transition flow_slide<?php echo esc_attr($count); ?>" 
					data-count="<?php echo esc_attr($count); ?>" 
					data-title="<?php echo esc_attr($photoTitle); ?>" 
					data-descr="<?php echo esc_attr($photoCaption); ?>" 
					data-transition = "<?php echo esc_attr($transition_time); ?>">
					<img alt="<?php echo esc_attr($photoTitle); ?>" src="<?php echo aq_resize(esc_url(wp_get_attachment_url($image)), $img_width, $img_height, true, true, true); ?>"/>
                    <?php if ($title_state == 'on') { ?>
						<div class="flow_title_content">
							<?php echo '<' . esc_attr($title_tag); ?> class="flow_title" ><?php echo esc_attr($photoTitle); ?><?php echo '</' . esc_attr($title_tag) . '>'; ?>
						</div>
                    <?php 
					}
					if ($lightbox == 'on') {
						$featured_image = wp_get_attachment_url($image);
						echo '<a class="swipebox" data-rel="flow_swipebox_'. esc_attr($uniqid) .'" href="'. esc_url($featured_image) .'" title="'. esc_attr($photoTitle) .'" data-description="'. esc_attr($photoCaption) .'"></a>';
					}
					?>                
				</div>
				
			<?php
			$count++;
			}	
		}
		if ($select_source == 'gallery_post' && $select_gallery_post !== '') {
			$gallery_post = gt3_get_theme_pagebuilder($select_gallery_post);
			$post_images = $gallery_post['sliders']['fullscreen']['slides'];
			foreach ($post_images as $imageid => $image) {
				$photoTitle = get_the_title($image['attach_id']);
				$photoCaption = '';
				$attach_meta = gt3_get_attachment($image['attach_id']);
				$photoCaption = $attach_meta['caption'];
				$PCREpattern = '/\r\n|\r|\n/u';
				$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));
	
				$slide_meta = wp_get_attachment_metadata($image['attach_id']);
				$slide_ratio = $slide_meta['width']/$slide_meta['height'];
				$slide_width = round($slide_meta['width']/10);
				$slide_height = round($slide_width/$slide_ratio);
				
				?>
				<div 
					class="flow_slide flow_block2preload gt3_js_transition flow_slide<?php echo esc_attr($count); ?>" 
					data-count="<?php echo esc_attr($count); ?>" 
					data-title="<?php echo esc_attr($photoTitle); ?>" 
					data-descr="<?php echo esc_attr($photoCaption); ?>" 
					data-transition = "<?php echo esc_attr($transition_time); ?>">
					<img alt="<?php echo esc_attr($photoTitle); ?>" src="<?php echo aq_resize(esc_url(wp_get_attachment_url($image['attach_id'])), $img_width, $img_height, true, true, true); ?>"/>
                    <?php if ($title_state == 'on') { ?>
						<div class="flow_title_content">
							<?php echo '<' . esc_attr($title_tag); ?> class="flow_title" ><?php echo esc_attr($photoTitle); ?><?php echo '</' . esc_attr($title_tag) . '>'; ?>
						</div>
                    <?php 
                    }
					if (isset($overlay_state) && $overlay_state == 'on') {
						echo '<div class="flow_overlay gt3_js_bg_color" data-bgcolor="'. esc_attr($overlay_bg) .'"></div>';
					}
					if ($lightbox == 'on') {
						if ($image['slide_type'] == 'image') {
							 echo '<a class="swipebox" data-rel="flow_swipebox_'. esc_attr($uniqid) .'" href="'. esc_url(wp_get_attachment_url($image['attach_id'])) .'" title="'. esc_attr($photoTitle) .'" data-description="'. esc_attr($photoCaption) .'"></a>';
						} else if ($image['slide_type'] == 'video') {
							#YOUTUBE
							$is_youtube = substr_count($image['src'], "youtu");
							if ($is_youtube > 0) {
								echo '<a class="swipebox flow_video" data-rel="flow_swipebox_'. esc_attr($uniqid) .'" href="'. esc_url($image['src']) .'" title="'. esc_attr($photoTitle) .'" data-description="'. esc_attr($photoCaption) .'"></a>';
							}
							#VIMEO
							$is_vimeo = substr_count($image['src'], "vimeo");
							if ($is_vimeo > 0) {
								echo '<a class="swipebox flow_video" data-rel="flow_swipebox_'. esc_attr($uniqid) .'" href="'. esc_url($image['src']) .'" title="'. esc_attr($photoTitle).'" data-description="'. esc_attr($photoCaption) .'"></a>';
							}
						}
					}
					?>                
				</div>				
				<?php
				$count++;
			}
		}
		?>
		</div><!-- .flow_gallery_container -->
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="flow_prevSlide sohopro_slider_button sohopro_slider_prev"><span class="sohopro_slider_button_inner"><span></span></span></a>
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="flow_nextSlide sohopro_slider_button sohopro_slider_next"><span class="sohopro_slider_button_inner"><span></span></span></a>        
        <div class="personal_preloader flow_gallery_trigger"></div>
	</div><!-- .flow_slider_wrapper -->
    <?php
}
?>