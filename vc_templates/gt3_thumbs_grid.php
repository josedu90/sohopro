<?php
$defaults = array(
	'select_source' => 'gallery_post',
	'select_gallery_post' => '',
	'images' => '',
	'custom_title' => '',
	'title' => '',
	'pictures_count' => '',
	'thumbs_width' => '100px',
	'thumbs_height' => '100px',
	'items_padding' => '15px',
	'custom_css' => '',
	'custom_class' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);
$compile = '';
$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );
$uniqid = mt_rand(0, 9999);

wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);

if (($select_source == 'module_images' && is_array($images_ids)) || ($select_source == 'gallery_post' && $select_gallery_post !== '')) { 
	?>
    <div class="thumbs_grid_gallery_wrapper <?php echo esc_attr($el_class) . ' ' . esc_attr($css_class) . ' ' . esc_attr($custom_class); ?>">
    	<?php 
		if ($select_source == 'gallery_post' && $select_gallery_post !== '' && $custom_title == false) {
			
			echo '<h2 class="thumbs_grid_title">'. get_the_title($select_gallery_post) .'</h2>';
		}
		if ($custom_title == true && $title !== '') {
			echo '<h2 class="thumbs_grid_title">'. esc_attr($title) .'</h2>';
		}
		$set_count = 0;
		if ($select_source == 'module_images' && is_array($images_ids)) {
			$set_count = count($images_ids);
		}
		if ($select_source == 'gallery_post' && $select_gallery_post !== '') {
			$gallery_post = gt3_get_theme_pagebuilder($select_gallery_post);			
			$set_count = count($gallery_post['sliders']['fullscreen']['slides']);
		}
		if ($set_count == 1) {
			$set_count_text = esc_html__("Photo", "sohopro");
		} else {
			$set_count_text = esc_html__("Photos", "sohopro");
		}
		
		if ($pictures_count == true) {
			echo '<div class="thumbs_grid_counts">'. esc_attr($set_count) .' ' . esc_attr($set_count_text) .'</div>';
		}
		?>
        <div class="thumbs_grid_gallery" data-pad="<?php echo esc_attr($items_padding); ?>">
        	<?php
		if ($select_source == 'module_images' && is_array($images_ids)) {
			foreach ($images_ids as $key => $image) {
				$photoTitle = get_the_title($image);
				$photoCaption = '';
				$attach_meta = gt3_get_attachment($image);
				$photoCaption = $attach_meta['caption'];
				$PCREpattern = '/\r\n|\r|\n/u';
				$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));
				
				$featured_image = wp_get_attachment_url($image);
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image), $thumbs_width, $thumbs_height, true, true, true);
				} else {
					$featured_image_url = GT3_IMGURL.'/grid_holder.png';
				}
				?>
                <div class="thumbs_grid_item">
                	<div class="thumbs_grid_item_wrapper">
						<?php 
							echo '<a class="swipebox" rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($featured_image) .'" title="'. esc_attr($photoTitle) .'"  data-description="'. esc_attr($photoCaption) .'"></a>';
                        ?>
                    	<img src="<?php echo (($featured_image_url)); ?>" width="<?php echo esc_attr($thumbs_width); ?>" height="<?php echo esc_attr($thumbs_height); ?>" alt="<?php echo (($attach_meta['alt'])); ?>"/>
                        <div class="thumbs_gallery_wrapper"></div>
                    </div>
                </div>
                <?php
			}//EoForeach
		}	

		if ($select_source == 'gallery_post' && $select_gallery_post !== '')	{
			$gallery_post = gt3_get_theme_pagebuilder($select_gallery_post);
			$post_images = $gallery_post['sliders']['fullscreen']['slides'];
			foreach ($post_images as $imageid => $image) {
				$photoTitle = get_the_title($image['attach_id']);
				$photoCaption = '';
				$attach_meta = gt3_get_attachment($image['attach_id']);
				$photoCaption = $attach_meta['caption'];
				$PCREpattern = '/\r\n|\r|\n/u';
				$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));
				
				$featured_image = wp_get_attachment_url($image['attach_id']);
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image), $thumbs_width, $thumbs_height, true, true, true);
				} else {
					$featured_image_url = GT3_IMGURL.'/grid_holder.png';
				}
				?>
                <div class="thumbs_grid_item">
                	<div class="thumbs_grid_item_wrapper" data-type="<?php echo esc_attr($image['slide_type']); ?>">
						<?php 
                        if ($image['slide_type'] == 'image') {
                             echo '<a class="swipebox" rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($featured_image) .'" title="'. esc_attr($photoTitle) .'" data-description="'. esc_attr($photoCaption) .'"></a>';
                        } else if ($image['slide_type'] == 'video') {
                            #YOUTUBE
                            $is_youtube = substr_count($image['src'], "youtu");
                            if ($is_youtube > 0) {
                                echo '<a class="swipebox" rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($image['src']) .'" title="'. esc_attr($photoTitle) .'" data-description="'. esc_attr($photoCaption) .'"></a>';
                            }
                            #VIMEO
                            $is_vimeo = substr_count($image['src'], "vimeo");
                            if ($is_vimeo > 0) {
                                echo '<a class="swipebox" rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($image['src']) .'" title="'. esc_attr($photoTitle).'" data-description="'. esc_attr($photoCaption) .'"></a>';
                            }
                        }
                        ?>
                    	<img src="<?php echo (($featured_image_url)); ?>" width="<?php echo esc_attr($thumbs_width); ?>" height="<?php echo esc_attr($thumbs_height); ?>" alt="<?php echo (($attach_meta['alt'])); ?>"/>
                        <div class="thumbs_gallery_wrapper"></div>
                    </div>
                </div>
                <?php
			}
		}				
	?>
		</div><!-- .thumbs_grid_gallery -->
	</div><!-- .thumbs_grid_gallery_wrapper -->
    <?php
}
?>