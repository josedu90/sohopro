<?php
$defaults = array(
	'select_source' => 'module_images',
	'select_gallery_post' => '',
	'images' => '',
	'items_in_row' => '1',
	'masonry' => 'on',
	'items_on_start' => '12',
	'items_per_load' => '4',
	'overlay_bg' => '',
	'items_padding' => '15px',
	'button_title' => esc_html__("Load More", "sohopro"),
	'custom_css' => '',
	'custom_class' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

if ($masonry == 'on') {
	$width = '800';
	$height = '';
} else {
	$width = '800';
	$height = '800';
}
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);
$compile = '';
$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );
$uniqid = mt_rand(0, 9999);

wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
wp_enqueue_script('isotope_sorting_gallery', get_template_directory_uri() . '/js/sorting_gallery.js', array(), false, true);

if (($select_source == 'module_images' && is_array($images_ids)) || ($select_source == 'gallery_post' && $select_gallery_post !== '')) { 
	?>
    <div class="grid_gallery_wrapper <?php echo esc_attr($custom_class); ?> personal_preloader grid_<?php echo esc_attr($uniqid) .' '. esc_attr($css_class) . ' ' . $custom_class; ?>" data-uniqid="<?php echo esc_attr($uniqid); ?>" data-perload="<?php echo esc_attr($items_per_load); ?>">
        <div class="grid_gallery personal_preloader masonry_is_<?php echo esc_attr($masonry); ?> grid_columns<?php echo esc_attr($items_in_row); ?>" data-pad="<?php echo esc_attr($items_padding); ?>" data-perload="<?php echo esc_attr($items_per_load); ?>" data-overlay="<?php echo esc_attr($overlay_bg); ?>">
        	<?php
		$list_array = array();
		$post_array = array();
		$post_num = 0;
			
		$imgCounter = 0;
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
					$featured_image_url = aq_resize(esc_url($featured_image), $width, $height, true, true, true);
				} else {
					$featured_image_url = GT3_IMGURL.'/grid_holder.png';
				}
				
				$featured_image = wp_get_attachment_image_src($image, 'original');
	
				$post_array['attach_id'] = $image;
				$post_array['slide_type'] = 'image';
				$post_array['title'] = $photoTitle;
				$post_array['caption'] = $photoCaption;
				$post_array['thmb'] = $featured_image_url;
				$post_array['url'] = $featured_image[0];
				$post_array['count'] = $imgCounter;
				array_push($list_array, $post_array);
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
					$featured_image_url = aq_resize(esc_url($featured_image), $width, $height, true, true, true);
				} else {
					$featured_image_url = GT3_IMGURL.'/grid_holder.png';
				}
	
				$post_array['attach_id'] = $image;
				if ($image['slide_type'] == 'video') {
					$post_array['slide_type'] = 'video';
					$post_array['url'] = $image['src'];
				} else {
					$post_array['slide_type'] = 'image';
					$post_array['url'] = esc_url($featured_image);
				}
				$post_array['title'] = $photoTitle;
				$post_array['caption'] = $photoCaption;
				$post_array['thmb'] = $featured_image_url;
				$post_array['count'] = $imgCounter;
				array_push($list_array, $post_array);
			}
		}

		$post_per_page = $items_on_start;
		if ($post_per_page > count($list_array)) {
			$post_per_page = count($list_array);
		}

		$i = 0;
		while ($i < $post_per_page) {
			if ($list_array[$i]['slide_type'] == 'image') {
				$thishref = wp_get_attachment_url($list_array[$i]['attach_id']);
				$thisvideoclass = '';
			} else if ($list_array[$i]['slide_type'] == 'video') {
				$thishref = $list_array[$i]['src'];
				$thisvideoclass = 'video_zoom';
			}
			$photoTitle = '';
			$photoCaption = '';
			$photoTitle = $list_array[$i]['title'];
			$photoCaption = $list_array[$i]['caption'];
			if (isset($photoTitle) && $photoTitle !== '') {
				$photoTitle = str_replace('"', "'", $photoTitle);
			}
			if (isset($photoCaption) && $photoCaption !== '') {
				$photoCaption = str_replace('"', "'", $photoCaption);
			}
			$photoAlt = get_post_meta($list_array[$i]['attach_id'], '_wp_attachment_image_alt', true);
			if (!isset($photoAlt) || $photoAlt = '') {
				$photoAlt = $photoTitle;
			}
			$imgCounter = $list_array[$i]['count'];
			$featured_image = $list_array[$i]['url'];
			$img_thmb = $list_array[$i]['thmb'];
		?>
			<div class="grid-item element anim_el anim_el2 loading grid_block2preload">
				<div class="grid_item_inner">
					<?php 
					if ($list_array[$i]['slide_type'] == 'image') {
						 echo '<a class="swipebox" href="'. esc_url($featured_image) .'" title="'. esc_attr($photoTitle) .'" data-description="'. esc_attr($photoCaption) .'"></a>';
					} else if ($list_array[$i]['slide_type'] == 'video') {
						#YOUTUBE
						$is_youtube = substr_count($list_array[$i]['src'], "youtu");
						if ($is_youtube > 0) {
							echo '<a class="swipebox" rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['src']) .'" title="'. esc_attr($photoTitle) .'" data-description="'. esc_attr($photoCaption) .'"></a>';
						}
						#VIMEO
						$is_vimeo = substr_count($list_array[$i]['src'], "vimeo");
						if ($is_vimeo > 0) {
							echo '<a class="swipebox" rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['src']) .'" title="'. esc_attr($photoTitle).'" data-description="'. esc_attr($photoCaption) .'"></a>';
						}
					}
					?>
					<img src="<?php echo esc_url($img_thmb); ?>" alt="<?php echo esc_attr($photoTitle); ?>"  class="grid_gallery_thmb"/>
                    <div class="grid_overlay"></div>
					<div class="img-preloader"></div>
				</div>
			</div><!-- .grid-item -->
		<?php
			unset($list_array[$i]);
			$i++;
		} //EoWhile First Load					
	?>
		</div><!-- .grid_gallery -->
	<?php
		if (isset($list_array) && count($list_array) > 0) {
			gt3_gallery_array2js($list_array, $uniqid);
			
			$compile .= '<div class="gt3_grid_module_button">';		
			$compile .= '<a class="grid_load_more gt3_soho_button" href="'. esc_js("javascript:void(0)") .'"><span>' . esc_attr($button_title) . '</span></a>';
			$compile .= '</div>';
			echo (($compile));
		}
	?>
	</div><!-- .grid_gallery_wrapper -->
    <?php
}
?>