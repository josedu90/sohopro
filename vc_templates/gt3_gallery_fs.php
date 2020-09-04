<?php
$defaults = array(
	'select_source' => 'module_images',
	'select_gallery_post' => '',
	'images' => '',
	'anim_style' => 'fade',
	'fit_style' => 'no_fit',
	'controls' => 'on',
	'nav_type' => 'thumbs',
	'module_height' => '100%',
	'el_class' => '',
	'autoplay' => 'on',
	'interval' => '4000',
	'transition_time' => '1000',
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

$set_video_cover = "video_cover";
$set_video_controls = '0';

$compile = '';
$title_tag = 'h2';
$caption_tag = 'div';


$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );

wp_enqueue_script('vimeo_api', 'https://player.vimeo.com/api/player.js', array(), false, true);
wp_enqueue_script('gt3_fs_gallery_js', get_template_directory_uri() . '/js/fs_gallery.js', array(), false, true);

if (($select_source == 'module_images' && is_array($images_ids)) || ($select_source == 'gallery_post' && $select_gallery_post !== '')) { 
	$uniqid = mt_rand(0, 9999);
	?>
    <div class="fs_gallery_wrapper <?php echo esc_attr($el_class); ?> fadeOnLoad 
    	controls_<?php echo esc_attr($controls); ?> 
        fs_gal_<?php echo esc_attr($uniqid); ?>
        nav_<?php echo esc_attr($nav_type); ?>"
        
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
        data-interval = "<?php echo esc_attr($interval); ?>" 
    	data-transition = "<?php echo esc_attr($transition_time); ?>"
        data-height="<?php echo esc_attr($module_height); ?>"
        
        data-toppx = "<?php echo esc_attr($slider_top_px); ?>"
        data-topcont = "<?php echo esc_attr($slider_top_cont); ?>"
        data-deccont = "<?php echo esc_attr($dec_cont); ?>"
        data-decpx = "<?php echo esc_attr($dec_px); ?>">
        
        <div class="fs_gallery_container fs_slider 
			<?php echo esc_attr($fit_style); ?> 
			<?php echo esc_attr($autoplay_class); ?> 
			<?php echo esc_attr($anim_style); ?> 
			<?php echo esc_attr($set_video_cover); ?> 
			controls_<?php echo esc_attr($controls); ?>" 
            data-video="<?php echo esc_attr($set_video_controls); ?>" 
            data-interval="<?php echo esc_attr($interval); ?>" 
            data-autoplay="<?php echo esc_attr($autoplay); ?>">
            
        	<?php
		$count = 1;
		$thmb_compile = '';
		$bullet_compile = '';
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
					class="fs_slide gt3_js_transition slide_image fs_block2preload fs_slide<?php echo esc_attr($count); ?>" 
					data-count="<?php echo esc_attr($count); ?>" 
					data-src="<?php echo esc_url(wp_get_attachment_url($image)); ?>" 
					data-title="<?php echo esc_attr($photoTitle); ?>"
					data-descr="<?php echo esc_attr($photoCaption); ?>"
					data-type="image"
					data-transition = "<?php echo esc_attr($transition_time); ?>">
				</div>
			<?php
				if ($nav_type == 'thumbs') {
					$thumb_url = '';
					if (isset($image) && strlen($image)>0) {
						$thumb_url = esc_url(aq_resize(wp_get_attachment_url($image), "200", "200", true, true, true));
					} else {
						$thumb_url = GT3_IMGURL .'/placeholder/spacer.png';
					}
					$thmb_compile .= '<div class="thmb_slide thmb_slide'. esc_attr($count) .'" data-count="'. esc_attr($count) .'"><img alt="'. esc_attr($photoTitle) .'" src="'. esc_url($thumb_url) .'"></div>';
				}
				if ($nav_type == 'bullets') {
					$bullet_compile .= '<div class="bullet_slide bullet_slide'. esc_attr($count) .'" data-count="'. esc_attr($count) .'"></div>';
				}
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
				
				$preloader_class = "fs_block2preload";
				$slide_type = "image";

				?>
				<div 
					class="fs_slide gt3_js_transition slide_image <?php echo esc_attr($preloader_class); ?> fs_slide<?php echo esc_attr($count); ?>"
					data-count="<?php echo esc_attr($count); ?>" 
					<?php if ($image['slide_type'] == 'video') {
						echo 'data-src="'. esc_url(wp_get_attachment_url($image['attach_id'])) .'" ';
					} else {
						echo 'data-src="'. esc_url(wp_get_attachment_url($image['attach_id'])) .'" ';
					}
					?>
					data-title="<?php echo esc_attr($photoTitle); ?>"
					data-descr="<?php echo esc_attr($photoCaption); ?>"
					data-type="image"
					data-transition = "<?php echo esc_attr($transition_time); ?>">
				</div>
				<?php
				if ($nav_type == 'thumbs') {
					$thumb_url = '';
					if (isset($image['attach_id']) && strlen($image['attach_id'])>0) {
						$thumb_url = esc_url(aq_resize(wp_get_attachment_url($image['attach_id']), "200", "200", true, true, true));
					} else {
						$thumb_url = GT3_IMGURL .'/placeholder/spacer.png';
					}
					$thmb_compile .= '<div class="thmb_slide thmb_slide'. esc_attr($count) .'" data-count="'. esc_attr($count) .'"><img alt="'. esc_attr($photoTitle) .'" src="'. esc_url($thumb_url) .'"></div>';
				}
				if ($nav_type == 'bullets') {
					$bullet_compile .= '<div class="bullet_slide bullet_slide'. esc_attr($count) .'" data-count="'. esc_attr($count) .'"></div>';
				}				
				$count++;	
			}
		}
		?>
		</div><!-- .fs_slider -->
            <div class="fs_title_wrapper">
                <div class="fs_title_padding">
                    <?php echo '<' . esc_attr($title_tag); ?> class="fs_title">&nbsp;<?php echo '</' . esc_attr($title_tag) . '>'; ?>
                </div>
            </div>
            <?php
			if ($nav_type == 'bullets') {
			?>
            	<div class="fs_bullet_wrapper">
                	<div class="fs_bullets">
                	<?php echo (($bullet_compile)); ?>
                    </div>
                </div>
			<?php
			}
            if ($nav_type == 'thumbs') { ?>
                <div class="fs_thmb_viewport">
                    <div class="fs_thmb_wrapper">
                        <div class="fs_thmb_list fs_thumbs">
                            <?php echo (($thmb_compile)); ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        <?php if ($controls == 'on') { ?>
        <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="fs_slider_controls"><i class="fa fa-expand"></i><i class="fa fa-compress"></i></a>
        <?php } ?>
        <div class="fs_controls fadeOnLoad">
            <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="fs_play_pause"><span></span></a>
        </div>
        <div class="fs_gallery_trigger personal_preloader"></div>
	</div><!-- .fs_gallery_wrapper -->
    <?php
}
?>