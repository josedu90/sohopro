<?php
if (!post_password_required()) {
    get_header();
    the_post();
    $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
    $pf = get_post_format();

	if (strlen($featured_image[0])>0) {
		$pinterest_img = esc_url($featured_image[0]);
	} else {
		if (wp_get_attachment_url(gt3_get_theme_option("logo"))) {
			$pinterest_img = esc_url(wp_get_attachment_url(gt3_get_theme_option("logo")));
		} else {
			$pinterest_img = esc_url(gt3_get_theme_option("logo"));
		}
	}
	
    $sliderCompile = "";
	$count = 1;
	$gallery_type = "fs_slider";
	if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slider_type'])) {
		$gallery_type = $gt3_theme_pagebuilder['sliders']['fullscreen']['slider_type'];
	}
    if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {		
		if ($gallery_type == "fs_slider") {
			//Fullscreen Slider
			$images = $gt3_theme_pagebuilder['sliders']['fullscreen']['slides'];
			$fs_style = 'on';
			$anim_style = $gt3_theme_pagebuilder['sliders']['fullscreen']['anim_style'];
			$fit_style = $gt3_theme_pagebuilder['sliders']['fullscreen']['fit_style'];
			$video_cover = $gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover'];
			$controls = $gt3_theme_pagebuilder['sliders']['fullscreen']['controls'];
			$thumbs = $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs'];
			$autoplay = $gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay'];
			if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['interval']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['interval'] > 0) {
				$interval = $gt3_theme_pagebuilder['sliders']['fullscreen']['interval'];
			} else {
				$interval = 4000;
			}
			if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['transition_time']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['transition_time'] > 0) {
				$transition_time = $gt3_theme_pagebuilder['sliders']['fullscreen']['transition_time'];
			} else {
				$transition_time = 1000;
			}
			$dec_cont = '';
			$slider_top_cont = '';
			$dec_px = '';
			$slider_top_px = '';
			$title_tag = 'h2';
			$caption_tag = 'div';
			if ($video_cover == 'on') {
				$set_video_cover = "video_cover";
				$set_video_controls = '1';
			} else {
				$set_video_cover = "video_fit";
				$set_video_controls = '0';
			}			
			wp_enqueue_script('vimeo_api', 'https://player.vimeo.com/api/player.js', array(), false, true);
			wp_enqueue_script('gt3_fs_gallery_js', get_template_directory_uri() . '/js/fs_gallery.js', array(), false, true);
			
			$uniqid = mt_rand(0, 9999);
			?>
			<div class="fs_gallery_wrapper gallery_single fadeOnLoad 
				controls_<?php echo esc_attr($controls); ?> 
				fs_gal_<?php echo esc_attr($uniqid); ?> 
				fs_style_<?php echo esc_attr($fs_style); ?> 
				thumbs_<?php echo esc_attr($thumbs); ?>"
				
				data-uniqid="<?php echo esc_attr($uniqid); ?>" 
				data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
				data-interval = "<?php echo esc_attr($interval); ?>" 

                data-toppx = "<?php echo esc_attr($slider_top_px); ?>"
                data-topcont = "<?php echo esc_attr($slider_top_cont); ?>"
                data-deccont = "<?php echo esc_attr($dec_cont); ?>"
                data-decpx = "<?php echo esc_attr($dec_px); ?>" 
				data-transition = "<?php echo esc_attr($transition_time); ?>">
				
				<div class="fs_gallery_container fs_gallery_template fs_slider 
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
				foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
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
					
					if ($image['slide_type'] == 'video') {
						$preloader_class = "";
						$is_youtube = substr_count($image['src'], "youtu");
						if ($is_youtube > 0) {
							$slide_type = "youtube";
							$videoid = substr(strstr($image['src'], "="), 1);
						}
						$is_vimeo = substr_count($image['src'], "vimeo");
						if ($is_vimeo > 0) {
							$slide_type = "vimeo";
							$videoid = substr(strstr($image['src'], "m/"), 2);
						}
					} else {
						$preloader_class = "fs_block2preload";
						$slide_type = "image";
					}
					?>
					<div 
						class="fs_slide gt3_js_transition slide_image <?php echo esc_attr($preloader_class); ?> fs_slide<?php echo esc_attr($count); ?>"
						data-count="<?php echo esc_attr($count); ?>" 
                        <?php if ($image['slide_type'] == 'video') {
							echo 'data-src="'. esc_attr($videoid) .'" ';
							echo 'data-bg="'. esc_url(wp_get_attachment_url($image['attach_id'])) .'" ';
						} else {
							echo 'data-src="'. esc_url(wp_get_attachment_url($image['attach_id'])) .'" ';
						}
						?>
						data-title="<?php echo esc_attr($photoTitle); ?>"
						data-descr="<?php echo esc_attr($photoCaption); ?>"
						data-type="<?php echo esc_attr($slide_type); ?>"
						data-transition = "<?php echo esc_attr($transition_time); ?>ms">
					</div>
				<?php
					if ($thumbs == 'on') {
						$thumb_url = '';
						if (isset($image['attach_id']) && strlen($image['attach_id'])>0) {
							$thumb_url = esc_url(aq_resize(wp_get_attachment_url($image['attach_id']), "200", "200", true, true, true));
						} else {
							$thumb_url = GT3_IMGURL .'/placeholder/spacer.png';
						}
						$thmb_compile .= '<div class="thmb_slide thmb_slide'. $count .'" data-count="'. $count .'"><img alt="'. $photoTitle .'" src="'. $thumb_url .'"></div>';
					}
					$count++;	
				?>
					
				<?php }	?>
				</div><!-- .fs_slider -->
                <div class="fs_title_wrapper">
                    <div class="fs_title_padding">
                        <?php echo '<' . esc_attr($title_tag); ?> class="fs_title gt3_js_color" data-color="<?php echo esc_attr($titles_color); ?>">&nbsp;<?php echo '</' . esc_attr($title_tag) . '>'; ?>
                    </div>
                </div>
				<?php
                if ($thumbs == 'on') { ?>
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
                <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="fs_slider_controls"><i class="fa fa-expand"></i><i class="fa fa-compress"></i></a>
                <div class="fs_controls fadeOnLoad">
                    <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="fs_play_pause"><span></span></a>
                </div>
				<div class="fs_gallery_trigger personal_preloader"></div>
			</div><!-- .fs_gallery_wrapper -->
            <div class="gt3_content_holder"></div>
			<?php
		}
		if ($gallery_type == "grid") {
			//Grid Gallery
			$images = $gt3_theme_pagebuilder['sliders']['fullscreen']['slides'];
			$fs_style = 'on';

			$items_in_row = $gt3_theme_pagebuilder['sliders']['grid']['items_in_row'];
			$masonry = $gt3_theme_pagebuilder['sliders']['grid']['masonry'];
			$items_on_start = $gt3_theme_pagebuilder['sliders']['grid']['items_on_start'];
			$items_per_load = $gt3_theme_pagebuilder['sliders']['grid']['items_per_load'];
			$items_padding = $gt3_theme_pagebuilder['sliders']['grid']['items_padding'];
			$button_title = $gt3_theme_pagebuilder['sliders']['grid']['button_title'];
			$uniqid = mt_rand(0, 9999);
			if ($masonry == 'on') {
				$width = '800';
				$height = '';
			} else {
				$width = '800';
				$height = '800';
			}
			wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
			wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
			wp_enqueue_script('isotope_sorting_gallery', get_template_directory_uri() . '/js/sorting_gallery.js', array(), false, true);
			?>
			<div class="grid_gallery_wrapper gallery_single personal_preloader grid_<?php echo esc_attr($uniqid); ?>" data-uniqid="<?php echo esc_attr($uniqid); ?>" data-perload="<?php echo esc_attr($items_per_load); ?>">
				<div class="grid_gallery personal_preloader masonry_is_<?php echo esc_attr($masonry); ?> grid_columns<?php echo esc_attr($items_in_row); ?>" data-pad="<?php echo esc_attr($items_padding); ?>" data-perload="<?php echo esc_attr($items_per_load); ?>" data-overlay="<?php echo esc_attr($overlay_bg); ?>">
			<?php
			$list_array = array();
			$post_array = array();
			$post_num = 0;
				
			$imgCounter = 0;			
			foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
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
				$photoTitle = $list_array[$i]['title'];
				if (isset($photoTitle) && $photoTitle !== '') {
					$photoTitle = str_replace('"', "'", $photoTitle);
				}
				$photoCaption = $list_array[$i]['caption'];
				$photoAlt = get_post_meta($list_array[$i]['attach_id'], '_wp_attachment_image_alt', true);
				if (!isset($photoAlt) || $photoAlt = '') {
					$photoAlt = $photoTitle;
				}
				$imgCounter = $list_array[$i]['count'];
				$featured_image = $list_array[$i]['url'];
				$img_thmb = $list_array[$i]['thmb'];
			?>
				<div class="grid-item element anim_el anim_el2 loading grid_block2preload" data-type="<?php echo (($list_array[$i]['slide_type'])); ?>">
					<div class="grid_item_inner">
						<?php 
						if ($list_array[$i]['slide_type'] == 'image') {
							 echo '<a class="swipebox" data-rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['url']) .'" title="'. esc_attr($photoTitle) .'" data-description="'. $photoCaption .'"></a>';
						} else if ($list_array[$i]['slide_type'] == 'video') {
							#YOUTUBE
							$is_youtube = substr_count($featured_image, "youtu");
							if ($is_youtube > 0) {
								echo '<a class="swipebox" data-rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['url']) .'" title="'. esc_attr($photoTitle) .'" data-description="'. $photoCaption .'"></a>';
							}
							#VIMEO
							$is_vimeo = substr_count($featured_image, "vimeo");
							if ($is_vimeo > 0) {
								echo '<a class="swipebox" data-rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['url']) .'" title="'. esc_attr($photoTitle).'" data-description="'. $photoCaption .'"></a>';
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
				$compile .= '<a class="gt3_soho_button grid_load_more" href="'. esc_js("javascript:void(0)") .'"><span>' . $button_title . '</span></a>';
				$compile .= '</div>';
				echo (($compile));
			}
		?>
		</div><!-- .grid_gallery_wrapper -->
		<?php			
		}
		if ($gallery_type == "packery") {
			//Packery Gallery
			$packery_layout = $gt3_theme_pagebuilder['sliders']['packery']['layout'];
			$layouts_on_start = $gt3_theme_pagebuilder['sliders']['packery']['on_start'];
			$layouts_per_load = $gt3_theme_pagebuilder['sliders']['packery']['per_load'];
			$items_padding = $gt3_theme_pagebuilder['sliders']['packery']['items_padding'];
			$button_title = $gt3_theme_pagebuilder['sliders']['packery']['button_title'];

			wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
			wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
			wp_enqueue_script('isotope_sorting_packery', get_template_directory_uri() . '/js/sorting_packery.js', array(), false, true);

			$item_in_row = 3;
			$items_per_load = 6;
			$items_on_start = 6;
			if ($packery_layout == 'pls_3items') {
				$item_in_row = 3;
				$items_in_layout = 6;
				$items_per_load = $layouts_per_load * $items_in_layout;
				$items_on_start = $layouts_on_start * $items_in_layout;
			}
			if ($packery_layout == 'pls_4items') {
				$item_in_row = 4;
				$items_in_layout = 8;
				$items_per_load = $layouts_per_load * $items_in_layout;
				$items_on_start = $layouts_on_start * $items_in_layout;
			}
			if ($packery_layout == 'pls_5items') {
				$item_in_row = 5;
				$items_in_layout = 10;
				$items_per_load = $layouts_per_load * $items_in_layout;
				$items_on_start = $layouts_on_start * $items_in_layout;
			}
			if ($packery_layout == 'pls_6items') {
				$item_in_row = 6;
				$items_in_layout = 12;
				$items_per_load = $layouts_per_load * $items_in_layout;
				$items_on_start = $layouts_on_start * $items_in_layout;
			}
			
			$width = '1000';
			$height = '1000';
						
			$count++;
			?>
			<div class="packery_gallery_wrapper gallery_single personal_preloader packery_<?php echo esc_attr($uniqid); ?>" 
				data-uniqid="<?php echo esc_attr($uniqid); ?>" 
				data-pad="<?php echo esc_attr($items_padding); ?>" 
				data-perload="<?php echo esc_attr($items_per_load); ?>" 
				data-onstart="<?php echo esc_attr($items_on_start); ?>" 
				data-layout="<?php echo esc_attr($item_in_row); ?>">
				
				<div class="packery_gallery personal_preloader packery_columns<?php echo esc_attr($item_in_row); ?>" 
					data-pad="<?php echo esc_attr($items_padding); ?>" 
					data-perload="<?php echo esc_attr($items_per_load); ?>" 
					data-overlay="<?php echo esc_attr($overlay_bg); ?>" 
					data-layout="<?php echo esc_attr($item_in_row); ?>">
					<?php
				$list_array = array();
				$post_array = array();
				$post_num = 0;
					
				$imgCounter = 0;
				foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
					$imgCounter++;
					if ($imgCounter > $items_in_layout) {
						$imgCounter = 1;
					}			
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
						$featured_image_url = GT3_IMGURL.'/packery_holder.png';
					}

		
					$post_array['attach_id'] = $image;
					if ($image['slide_type'] == 'video') {
						$post_array['slide_type'] = 'video';
						$post_array['url'] = $image['src'];
					} else {
						$post_array['slide_type'] = 'image';
						$post_array['url'] = esc_url($featured_image);
					}
					$post_array['slide_type'] = 'image';
					$post_array['title'] = $photoTitle;
					$post_array['caption'] = $photoCaption;
					$post_array['thmb'] = $featured_image_url;
					$post_array['count'] = $imgCounter;
					array_push($list_array, $post_array);
				}//EoForeach	
		
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
					$photoTitle = $list_array[$i]['title'];
					if (isset($photoTitle) && $photoTitle !== '') {
						$photoTitle = str_replace('"', "'", $photoTitle);
					}
					$photoAlt = get_post_meta($list_array[$i]['attach_id'], '_wp_attachment_image_alt', true);
					if (!isset($photoAlt) || $photoAlt = '') {
						$photoAlt = $photoTitle;
					}
					$imgCounter = $list_array[$i]['count'];
					$featured_image = $list_array[$i]['url'];
					$img_thmb = $list_array[$i]['thmb'];
				?>
					<div class="packery-item element anim_el anim_el2 loading packery_block2preload packery-item<?php echo esc_attr($imgCounter); ?>" data-count="<?php echo esc_attr($imgCounter); ?>">
						<div class="packery_item_inner gt3_js_bg_img" data-src="<?php echo esc_url($img_thmb); ?>">
							<?php 
							if ($list_array[$i]['slide_type'] == 'image') {
								 echo '<a class="swipebox" data-rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($featured_image) .'" title="'. esc_attr($photoTitle) .'" data-description="'. $photoCaption .'"></a>';
							} else if ($list_array[$i]['slide_type'] == 'video') {
								#YOUTUBE
								$is_youtube = substr_count($list_array[$i]['src'], "youtu");
								if ($is_youtube > 0) {
									echo '<a class="swipebox" data-rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['src']) .'" title="'. esc_attr($photoTitle) .'" data-description="'. $photoCaption .'"></a>';
								}
								#VIMEO
								$is_vimeo = substr_count($list_array[$i]['src'], "vimeo");
								if ($is_vimeo > 0) {
									echo '<a class="swipebox" data-rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['src']) .'" title="'. esc_attr($photoTitle).'" data-description="'. $photoCaption .'"></a>';
								}
							}
							?>
							<div class="packery_overlay"></div>
							<div class="img-preloader"></div>
						</div>
					</div><!-- .packery-item -->
				<?php
					unset($list_array[$i]);
					$i++;
				} //EoWhile First Load					
			?>
				</div><!-- .packery_gallery -->
			<?php
				if (isset($list_array) && count($list_array) > 0) {
					gt3_gallery_array2js($list_array, $uniqid);
					$compile .= '<div class="gt3_grid_module_button">';
					$compile .= '<a class="gt3_soho_button packery_load_more" href="'. esc_js("javascript:void(0)") .'"><span>' . $button_title . '</span></a>';
					$compile .= '</div>';
					echo (($compile));
				}
			?>
			</div><!-- .packery_gallery_wrapper -->
			<?php
		}
		if ($gallery_type == "ribbon") {
			//Ribbon Gallery
			$images = $gt3_theme_pagebuilder['sliders']['fullscreen']['slides'];
			$fs_style = 'on';
			$items_padding = $gt3_theme_pagebuilder['sliders']['ribbon']['items_padding'];
			$title_state = $gt3_theme_pagebuilder['sliders']['ribbon']['title_state'];
			$autoplay = $gt3_theme_pagebuilder['sliders']['ribbon']['autoplay'];
			if (isset($gt3_theme_pagebuilder['sliders']['ribbon']['interval']) && $gt3_theme_pagebuilder['sliders']['ribbon']['interval'] > 0) {
				$interval = $gt3_theme_pagebuilder['sliders']['ribbon']['interval'];
			} else {
				$interval = 4000;
			}
			if (isset($gt3_theme_pagebuilder['sliders']['ribbon']['transition_time']) && $gt3_theme_pagebuilder['sliders']['ribbon']['transition_time'] > 0) {
				$transition_time = $gt3_theme_pagebuilder['sliders']['ribbon']['transition_time'];
			} else {
				$transition_time = 1000;
			}
			$uniqid = mt_rand(0, 9999);
			$slider_top_px = '0';
			$slider_top_cont = '';
			$dec_cont = '';
			$dec_px = '0';
			$title_tag = 'h2';
			$caption_tag = 'div';
			$overlay_state = 'on';
			$overlay_bg = "rgba(0,0,0,0.6)";
			
			wp_enqueue_script('gt3_ribbon_gallery_js', get_template_directory_uri() . '/js/ribbon_gallery.js', array(), false, true);
			
			?>
            <div class="ribbon_slider_wrapper gallery_single fadeOnLoad 
                ribbon_gal_<?php echo esc_attr($uniqid); ?> 
                ribbon_fs_<?php echo esc_attr($fs_style); ?>"
                
                data-pad = "<?php echo (($gt3_theme_pagebuilder['sliders']['ribbon']['items_padding'])); ?>"
                data-uniqid="<?php echo esc_attr($uniqid); ?>" 
                data-autoplay = "<?php echo esc_attr($autoplay); ?>" 
                data-interval = "<?php echo esc_attr($interval); ?>" 
                
                data-toppx = "<?php echo esc_attr($slider_top_px); ?>"
                data-topcont = "<?php echo esc_attr($slider_top_cont); ?>"
                data-deccont = "<?php echo esc_attr($dec_cont); ?>"
                data-decpx = "<?php echo esc_attr($dec_px); ?>" 
                                
                data-transition = "<?php echo esc_attr($transition_time); ?>">
                
                <div class="ribbon_gallery_container ribbon_slider
                    <?php echo esc_attr($autoplay_class); ?>" 
                    data-interval="<?php echo esc_attr($interval); ?>" 
                    data-autoplay="<?php echo esc_attr($autoplay); ?>">
                    
        	<?php
			foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
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
				if ($image['slide_type'] == 'image') {
					$preload_class = "ribbon_block2preload";
				} else {
					$preload_class = "block_loaded";
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
                    	<img alt="<?php echo esc_attr($photoTitle); ?>" src="<?php echo esc_url(wp_get_attachment_url($image['attach_id'])); ?>"/>
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
					<?php
					if ($overlay_state == 'on') {
						echo '<div class="ribbon_overlay"></div>';
					}
					?>                
					<?php if ($title_state == 'on') { ?>
                    <div class="ribbon_title_content">
                        <?php echo '<' . esc_attr($title_tag); ?> class="ribbon_title gt3_js_color" data-color="<?php echo esc_attr($titles_color); ?>"><?php echo esc_attr($photoTitle); ?><?php echo '</' . esc_attr($title_tag) . '>'; ?>
                    </div>
                    <?php } ?>
				</div>	
                <?php
				$count++;
			}
			?>
                </div><!-- .ribbon_gallery_container -->
                <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="ribbon_prevSlide sohopro_slider_button sohopro_slider_prev"><span class="sohopro_slider_button_inner"><span></span></span></a>
                <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="ribbon_nextSlide sohopro_slider_button sohopro_slider_next"><span class="sohopro_slider_button_inner"><span></span></span></a>
                <div class="ribbon_gallery_trigger personal_preloader"></div>
            </div><!-- .ribbon_slider_wrapper -->            
            <div class="gt3_content_holder"></div>
            <?php
		}
		if ($gallery_type == "flow") {
			//Flow Gallery
			$uniqid = mt_rand(0, 9999);
			$fs_style = 'on';
			$lightbox = $gt3_theme_pagebuilder['sliders']['flow']['lightbox'];
			$title_state = $gt3_theme_pagebuilder['sliders']['flow']['title_state'];
			$autoplay = $gt3_theme_pagebuilder['sliders']['flow']['autoplay'];
			if (isset($gt3_theme_pagebuilder['sliders']['flow']['interval']) && $gt3_theme_pagebuilder['sliders']['flow']['interval'] > 0) {
				$interval = $gt3_theme_pagebuilder['sliders']['flow']['interval'];
			} else {
				$interval = 4000;
			}
			if (isset($gt3_theme_pagebuilder['sliders']['flow']['transition_time']) && $gt3_theme_pagebuilder['sliders']['flow']['transition_time'] > 0) {
				$transition_time = $gt3_theme_pagebuilder['sliders']['flow']['transition_time'];
			} else {
				$transition_time = 600;
			}
			$slider_top_px = '0';
			$slider_top_cont = '';
			$dec_cont = '';
			$dec_px = '0';
			$title_tag = 'h2';
			$caption_tag = 'div';
			$img_width = $gt3_theme_pagebuilder['sliders']['flow']['img_width'];
			$img_height = $gt3_theme_pagebuilder['sliders']['flow']['img_height'];


			wp_enqueue_script('gt3_flow_gallery_js', get_template_directory_uri() . '/js/flow_gallery.js', array(), false, true);
			if ($lightbox == 'on') {
				wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
			}
			?>            
			<div class="flow_slider_wrapper gallery_single fadeOnLoad 
				flow_gal_<?php echo esc_attr($uniqid); ?> 
				flow_fs_<?php echo esc_attr($fs_style); ?>"
				 
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
					foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
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
							<?php 
							if ($overlay_state == 'on') {
								echo '<div class="flow_overlay gt3_js_bg_color" data-bgcolor="'. esc_attr($overlay_bg) .'"></div>';
							}
							if ($lightbox == 'on') {
								if ($image['slide_type'] == 'image') {
									 echo '<a class="swipebox" data-rel="flow_swipebox_'. esc_attr($uniqid) .'" href="'. esc_url(wp_get_attachment_url($image['attach_id'])) .'" title="'. esc_attr($photoTitle) .'" data-description="'. $photoCaption .'"></a>';
								} else if ($image['slide_type'] == 'video') {
									#YOUTUBE
									$is_youtube = substr_count($image['src'], "youtu");
									if ($is_youtube > 0) {
										echo '<a class="swipebox flow_video" data-rel="flow_swipebox_'. esc_attr($uniqid) .'" href="'. esc_url($image['src']) .'" title="'. esc_attr($photoTitle) .'" data-description="'. $photoCaption .'"></a>';
									}
									#VIMEO
									$is_vimeo = substr_count($image['src'], "vimeo");
									if ($is_vimeo > 0) {
										echo '<a class="swipebox flow_video" data-rel="flow_swipebox_'. esc_attr($uniqid) .'" href="'. esc_url($image['src']) .'" title="'. esc_attr($photoTitle).'" data-description="'. $photoCaption .'"></a>';
									}
								}
							}
							?>                
						</div>				
						<?php
						$count++;
					}
				?>
                </div>
                <?php 
					if ($title_state == 'on') { ?>
					<div class="flow_title_content">
						<?php echo '<' . esc_attr($title_tag); ?> class="flow_title" ><?php echo esc_attr($photoTitle); ?><?php echo '</' . esc_attr($title_tag) . '>'; ?>
					</div>
					<?php 
					}				
				?>
                <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="flow_prevSlide sohopro_slider_button sohopro_slider_prev"><span class="sohopro_slider_button_inner"><span></span></span></a>
                <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="flow_nextSlide sohopro_slider_button sohopro_slider_next"><span class="sohopro_slider_button_inner"><span></span></span></a>        
                <div class="personal_preloader flow_gallery_trigger"></div>
			</div>
            <div class="gt3_content_holder"></div>
            <?php
		}
	}
	get_footer();
} else {
	get_header();
?>
	<div class="gt3_pp_page_bg"></div>
	<div class="wrapper_pp fadeOnLoad">
		<div class="title_pp">
			<?php echo esc_html__('Password Protected', 'sohopro'); ?>
		</div>
		<div class="content_pp">
			<?php the_content(); ?>
        </div>
	</div>
<?php 
	get_footer('none');
} ?>