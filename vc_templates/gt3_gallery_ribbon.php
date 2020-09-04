<?php
$defaults = array(
	'select_source' => 'module_images',
	'select_gallery_post' => '',
	'images' => '',
	'items_padding' => '',
	'title_state' => 'on',
	'module_height' => '100%',
	'el_class' => '',
	'autoplay' => 'on',
	'interval' => '4000',
	'transition_time' => '1000',
	'image_crop' => '',
	'image_crop_width' => '',
	'image_crop_height' => ''
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

wp_enqueue_script('gt3_ribbon_gallery_js', get_template_directory_uri() . '/js/ribbon_gallery.js', array(), false, true);

if (($select_source == 'module_images' && is_array($images_ids)) || ($select_source == 'gallery_post' && $select_gallery_post !== '')) { 
	$uniqid = mt_rand(0, 9999);

	?>
    <div class="ribbon_slider_wrapper <?php echo esc_attr($el_class); ?> fadeOnLoad 
        ribbon_gal_<?php echo esc_attr($uniqid); ?>"
         
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-pad="<?php echo esc_attr($items_padding); ?>" 
        data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
        data-interval = "<?php echo esc_attr($interval); ?>" 
    	data-transition = "<?php echo esc_attr($transition_time); ?>" 
        data-height="<?php echo esc_attr($module_height); ?>" 
        data-toppx = "" 
        data-topcont = "" 
        data-deccont = "" 
        data-decpx = "">
        
        <div class="ribbon_gallery_container ribbon_slider
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

				if ($image_crop == true) {
					$slide_ratio = $image_crop_width/$image_crop_height;
					$slide_width = round($image_crop_width/10);
					$slide_height = round($slide_width/$slide_ratio);
					$featured_image = aq_resize(esc_url(wp_get_attachment_url($image)), $image_crop_width, $image_crop_height, true, true, true);
				} else {
					$slide_ratio = $slide_meta['width']/$slide_meta['height'];
					$slide_width = round($slide_meta['width']/10);
					$slide_height = round($slide_width/$slide_ratio);

					$featured_image = wp_get_attachment_url($image);
				}
				?>
				<div 
					class="ribbon_slide ribbon_block2preload gt3_js_transition ribbon_slide<?php echo esc_attr($count); ?>" 
					data-count="<?php echo esc_attr($count); ?>" 
					data-title="<?php echo esc_attr($photoTitle); ?>"
					data-descr="<?php echo esc_attr($photoCaption); ?>"
					data-ratio="<?php echo esc_attr($slide_ratio); ?>"
					data-transition = "<?php echo esc_attr($transition_time); ?>">
					<img alt="<?php echo esc_attr($photoTitle); ?>" src="<?php echo esc_url($featured_image); ?>"/>
					<div class="ribbon_overlay"></div>
					<?php
					if ($title_state == 'on') { ?>
						<div class="ribbon_title_content">
							<?php echo '<' . esc_attr($title_tag); ?> class="ribbon_title"><?php echo esc_attr($photoTitle); ?><?php echo '</' . esc_attr($title_tag) . '>'; ?>
                            <?php echo '<' . esc_attr($caption_tag); ?> class="ribbon_descr"><?php echo esc_attr($photoCaption); ?><?php echo '</' . esc_attr($caption_tag) . '>'; ?>
						</div>
					<?php } ?>
				</div>
				
			<?php
			$count++;
			}	//End of Foreach 
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
				if ($image['slide_type'] == 'image') {
					$preload_class = "ribbon_block2preload";
				} else {
					$preload_class = "block_loaded";
				}

				if ($image_crop == true) {
					$slide_ratio = $image_crop_width/$image_crop_height;
					$slide_width = round($image_crop_width/10);
					$slide_height = round($slide_width/$slide_ratio);
					$featured_image = aq_resize(esc_url(wp_get_attachment_url($image['attach_id'])), $image_crop_width, $image_crop_height, true, true, true);
				} else {
					$slide_ratio = $slide_meta['width']/$slide_meta['height'];
					$slide_width = round($slide_meta['width']/10);
					$slide_height = round($slide_width/$slide_ratio);

					$featured_image = esc_url(wp_get_attachment_url($image['attach_id']));
				}

				?>
                
				<div 
					class="ribbon_slide <?php echo esc_attr($preload_class); ?> gt3_js_transition ribbon_slide<?php echo esc_attr($count); ?>"
					data-count="<?php echo esc_attr($count); ?>" 
                    data-type="<?php echo esc_attr($image['slide_type']); ?>" 
					data-title="<?php echo esc_attr($photoTitle); ?>"
					data-descr="<?php echo esc_attr($photoCaption); ?>"
					data-ratio="<?php echo esc_attr($slide_ratio); ?>"
					data-transition = "<?php echo esc_attr($transition_time); ?>">
                    <?php if ($image['slide_type'] == 'image') { ?>
                    	<img alt="<?php echo esc_attr($photoTitle); ?>" src="<?php echo esc_url($featured_image); ?>"/>
					<?php } else { 
						#YOUTUBE
						$is_youtube = substr_count($image['src'], "youtu");
						if ($is_youtube > 0) {
							$videoid = substr(strstr($image['src'], "="), 1);
							echo '<iframe width="1920" height="1080" src="http://www.youtube.com/embed/' . esc_attr($videoid) . '?controls=1&autoplay=0&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1" allowfullscreen></iframe>';
							
						}
						#VIMEO
						$is_vimeo = substr_count($image['src'], "vimeo");
						if ($is_vimeo > 0) {
							$videoid = substr(strstr($image['src'], "m/"), 2);
							echo '<iframe width="1920" height="1080" src="http://player.vimeo.com/video/' . esc_attr($videoid) . '?api=1&amp;title=0&amp;quality=1080p&amp;byline=0&amp;portrait=0&autoplay=0&loop=0&controls=1" webkitAllowFullScreen allowFullScreen></iframe>';
						}					
					} ?>
					<div class="ribbon_overlay"></div>
					<?php if ($title_state == 'on') { ?>
                    <div class="ribbon_title_content">
                        <?php echo '<' . esc_attr($title_tag); ?> class="ribbon_title"><?php echo esc_attr($photoTitle); ?><?php echo '</' . esc_attr($title_tag) . '>'; ?>
                        <?php echo '<' . esc_attr($caption_tag); ?> class="ribbon_descr"><?php echo esc_attr($photoCaption); ?><?php echo '</' . esc_attr($caption_tag) . '>'; ?>
                    </div>
                    <?php } ?>
				</div>	
                <?php
				$count++;
			}
		}
		?>
		</div><!-- .ribbon_gallery_container -->
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="ribbon_prevSlide sohopro_slider_button sohopro_slider_prev"><span class="sohopro_slider_button_inner"><span></span></span></a>
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="ribbon_nextSlide sohopro_slider_button sohopro_slider_next"><span class="sohopro_slider_button_inner"><span></span></span></a>
		<div class="ribbon_gallery_trigger personal_preloader"></div>
	</div><!-- .ribbon_slider_wrapper -->
    <?php
}
?>