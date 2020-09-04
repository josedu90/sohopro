<?php

#Get last slide ID
add_action('wp_ajax_get_unused_id_ajax', 'get_unused_id_ajax');
if (!function_exists('get_unused_id_ajax')) {
    function get_unused_id_ajax()
    {
        if (current_user_can('manage_options')) {
            $lastid = gt3_get_theme_option("last_slide_id");
            if ($lastid < 3) {
                $lastid = 2;
            }
            $lastid++;

            $mystring = esc_url(home_url('/'));
            $findme = 'gt3themes';
            $pos = strpos($mystring, $findme);

            if ($pos === false) {
                echo (($lastid));
            } else {
                echo str_replace(array("/", "-", "_"), "", substr(wp_get_theme()->get('ThemeURI'), -4, 3)) . date("d") . date("m") . $lastid;
            }

            gt3_update_theme_option("last_slide_id", $lastid);
        }

        die();
    }
}

add_action('wp_ajax_gt3_save_admin_options', 'gt3_save_admin_options');
function gt3_save_admin_options()
{
    if (current_user_can('manage_options')) {
        $response = array();
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options", array());
        $serialize_string = stripslashes($_POST['serialize_string']);

        $theme_sidebars = array();

        foreach (json_decode($serialize_string, true) as $key => $value) {
            $gt3_options[$value['name']] = $value['value'];
            $pos = strpos($value['name'], 'theme_sidebars');
            if ($pos === false) {
            } else {
                $theme_sidebars[] = $value['value'];
            }
        };

        if (update_option(GT3_THEMESHORT . "gt3_options", $gt3_options)) {
            $response['save_status'] = "saved";
        } else {
            $response['save_status'] = "nothing_changed";
        }

        gt3_delete_theme_option("theme_sidebars");
        gt3_update_theme_option("theme_sidebars", $theme_sidebars);

        echo json_encode($response);
    }

    die();
}

add_action('wp_ajax_gt3_reset_admin_settings', 'gt3_reset_admin_settings');
function gt3_reset_admin_settings()
{
    if (current_user_can('manage_options')) {
        delete_option(GT3_THEMESHORT . "gt3_options");

        echo '<div>Done!</div>';
    }

    die();
}

add_action('wp_ajax_gt3_edit_menu_settings', 'gt3_edit_menu_settings');
function gt3_edit_menu_settings()
{
    if (current_user_can('manage_options')) {
        $gt3_menu_edited_id = absint($_POST['gt3_menu_edited_id']);
        $gt3_menu_edited_depth = absint($_POST['gt3_menu_edited_depth']);
        $gt3_select_icon_ultimate = get_post_meta($gt3_menu_edited_id, 'gt3_select_icon_ultimate', true);
        $gt3_megamenu_status = get_post_meta($gt3_menu_edited_id, 'gt3_megamenu_status', true);
        $gt3_megamenu_columns = get_post_meta($gt3_menu_edited_id, 'gt3_megamenu_columns', true);

        echo '<div class="gt3_edit_menu_settings_popup">';
        echo '
    <input type="hidden" name="gt3_menu_edited_id" class="gt3_menu_edited_id" value="' . $gt3_menu_edited_id . '">
    <input type="hidden" name="gt3_menu_edited_depth" class="gt3_menu_edited_depth" value="' . $gt3_menu_edited_depth . '">
    ';

        $temp_mt_rand = mt_rand(1000, 2000);

        echo '
        <div class="gt3_select_menu_icon_container" style="' . ($gt3_menu_edited_depth > 0 ? '' : 'display:none;') . '">
            <div>Icon: <span class="gt3_remove_this_icon">[clear]</span></div>
            <div style="margin-top: 5px; position: relative;">
                <input type="text" class="gt3_input gt3_select_icon_ultimate" value="'.((isset($gt3_select_icon_ultimate) && strlen($gt3_select_icon_ultimate) > 0) ? $gt3_select_icon_ultimate : '').'">
                <i class="gt3_preview_icon '.((isset($gt3_select_icon_ultimate) && strlen($gt3_select_icon_ultimate) > 0) ? $gt3_select_icon_ultimate : '').'"></i>
            </div>
        </div>
        ';

        echo '
        <div class="" style="' . ($gt3_menu_edited_depth == 0 ? '' : 'display:none;') . '">
            <div style="margin-top: 5px;">
                <input id="idrand_'.$temp_mt_rand.'" type="checkbox" class="gt3_megamenu_status" '.((isset($gt3_megamenu_status) && $gt3_megamenu_status == 'enabled') ? 'checked' : '').'>
                <label for="idrand_'.$temp_mt_rand.'">' . esc_html__('Mega Menu', 'sohopro') . '</label>
            </div>
        </div>
        ';

        echo '
        <div style="' . ($gt3_menu_edited_depth == 0 ? '' : 'display:none;') . 'margin-top: 10px;">
            <div>Columns:</div>
            <div style="margin-top:5px;">
                <select class="gt3_megamenu_columns" name="gt3_megamenu_columns">
                    <option value="3" '.((isset($gt3_megamenu_columns) && $gt3_megamenu_columns == '3') ? 'selected' : '').'>3</option>
                    <option value="4" '.((isset($gt3_megamenu_columns) && $gt3_megamenu_columns == '4') ? 'selected' : '').'>4</option>
                    <option value="5" '.((isset($gt3_megamenu_columns) && $gt3_megamenu_columns == '5') ? 'selected' : '').'>5</option>
                </select>
            </div>
        </div>
        ';

        echo '
        <input type="button" style="margin-top:15px;" class="button gt3_save_menu_settings" name="gt3_save_menu_settings" value="' . esc_html__('Save Settings', 'sohopro') . '">
    ';

        echo '</div>';
    }

    die();
}

add_action('wp_ajax_gt3_save_menu_settings', 'gt3_save_menu_settings');
function gt3_save_menu_settings()
{
    if (current_user_can('manage_options')) {
        $gt3_menu_edited_id = absint($_POST['gt3_menu_edited_id']);
        $gt3_menu_edited_depth = absint($_POST['gt3_menu_edited_depth']);
        $gt3_megamenu_columns = absint($_POST['gt3_megamenu_columns']);
        $gt3_select_icon_ultimate = esc_attr($_POST['gt3_select_icon_ultimate']);
        $gt3_megamenu_status = (isset($_POST['gt3_megamenu_status']) && esc_attr($_POST['gt3_megamenu_status']) == "checked" ? "enabled" : 'disabled');

        update_post_meta($gt3_menu_edited_id, 'gt3_select_icon_ultimate', $gt3_select_icon_ultimate);
        update_post_meta($gt3_menu_edited_id, 'gt3_megamenu_status', $gt3_megamenu_status);
        update_post_meta($gt3_menu_edited_id, 'gt3_megamenu_columns', $gt3_megamenu_columns);
    }

    die();
}

// Likes
add_action('wp_ajax_add_like_post', 'gt3_add_like_post');
add_action('wp_ajax_nopriv_add_like_post', 'gt3_add_like_post');
function gt3_add_like_post()
{
    $post_id = absint($_POST['post_id']);
    $post_likes = (get_post_meta($post_id, "post_likes", true) > 0 ? get_post_meta($post_id, "post_likes", true) : "0");
    $new_likes = absint($post_likes) + 1;
    update_post_meta($post_id, "post_likes", $new_likes);
    echo (($new_likes));
    die();
}

add_action( 'wp_ajax_add_like_attachment', 'gt3_add_like' );
add_action( 'wp_ajax_nopriv_add_like_attachment', 'gt3_add_like' );
function gt3_add_like() {
    $all_likes = gt3pb_get_option("likes");
    $attach_id = absint($_POST['attach_id']);
    $all_likes[$attach_id] = (isset($all_likes[$attach_id]) ? $all_likes[$attach_id] : 0)+1;
    gt3pb_update_option("likes", $all_likes);
    echo absint($all_likes[$attach_id]);
    die();
}


#Load works
add_action('wp_ajax_gt3_get_ajax_works', 'gt3_get_ajax_works');
add_action('wp_ajax_nopriv_gt3_get_ajax_works', 'gt3_get_ajax_works');
if (!function_exists('gt3_get_ajax_works')) {
    function gt3_get_ajax_works()
    {
		$post_type = esc_attr($_POST['post_type']);
		$post_taxonomy = esc_attr($_POST['post_taxonomy']);
		$posts_count = esc_attr($_POST['posts_count']);
		$posts_already_showed = esc_attr($_POST['posts_already_showed']);
		$gt3_category = esc_attr($_POST['categs']);
		$hoverType = esc_attr($_POST['hoverType']);
		$imgWidth = esc_attr($_POST['imgWidth']);
		$imgHeight = esc_attr($_POST['imgHeight']);
		if ($post_type == 'port') {
			$module_type = esc_attr($_POST['module_type']);
			if ($module_type == 'packery') {
				$layoutType = esc_attr($_POST['layoutType']);
			}
		}
		
		if ($post_type == 'post') {
			$gt3_wp_query_in_shortcodes = new WP_Query();
			$categ_array = explode(" ", $gt3_category);
		
			$post_type_terms = '';
			if (is_array($categ_array) && count($categ_array) > 0) {
				foreach ($categ_array as $cat) {
					$this_categ = get_category_by_slug($cat);
					$this_categ_id = $this_categ->term_id;
					$post_type_terms .= $this_categ_id . ',';
				}
			}
			$post_type_terms = substr($post_type_terms, 0, -1);
			
			$gt3_wp_query_in_shortcodes = new WP_Query();
			$args = array(
				'post_type' => 'post',
				'paged' => $paged,
				'offset' => $posts_already_showed,
				'posts_per_page' => $posts_count,
			);
		
			if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
				$post_type_terms = esc_attr($_GET['slug']);
				$selected_categories = esc_attr($_GET['slug']);
				$this_categ = get_term_by('slug', $selected_categories);
		
			}
			if (count($post_type_terms) > 0) {
				$args['cat'] = $post_type_terms;
			}	
			
			$gt3_wp_query_in_shortcodes->query($args);			
			while ($gt3_wp_query_in_shortcodes->have_posts()) : $gt3_wp_query_in_shortcodes->the_post();				
				$gt3_theme_post = gt3_get_theme_pagebuilder(get_the_ID());
				$featured_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
				$pf = get_post_format();
				$photoTitle = get_the_title();	

				$post = get_post();

				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image[0]), $imgWidth, $imgHeight, true, true, true);
				} else {
					$featured_image_url = THEMEROOTURL . '/img/placeholder/800_800.jpg';
				}
				?>
				<div class="blog_grid_item anim_el anim_el2 loading blog_grid_block2preload element">
					<div class="blog_grid_item_inner">
						<img class="img2preload" width="1000" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_attr($featured_alt); ?>">
						<a href="<?php echo get_permalink(); ?>"></a>
						<div class="grid_overlay"></div>
							<div class="blog_grid_content">
								<h2 class="blog_grid_title"><?php esc_html(the_title()); ?></h2>
							</div>
						<div class="img-preloader"></div>
					</div>
				</div><!-- .blog_grid_item -->
			<?php
			endwhile;	
			wp_reset_postdata();
			die();		
		} else {
			$categ_array = explode(" ", $gt3_category);
			$post_type_terms = $categ_array;
			$post_type_field = 'slug';
			
			$gt3_wp_query_in_shortcodes = new WP_Query();
			$args = array(
				'post_type' => $post_type,
				'paged' => $paged,
				'offset' => $posts_already_showed,
				'posts_per_page' => $posts_count,
			);
		
			if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
				$post_type_terms = esc_attr($_GET['slug']);
				$selected_categories = esc_attr($_GET['slug']);
				$post_type_field = "slug";
			}
			if (count($post_type_terms) > 0) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $post_taxonomy,
						'field' => $post_type_field,
						'terms' => $post_type_terms
					)
				);
			}
			
			$gt3_wp_query_in_shortcodes->query($args);			
			while ($gt3_wp_query_in_shortcodes->have_posts()) : $gt3_wp_query_in_shortcodes->the_post();
				$gt3_theme_post = gt3_get_theme_pagebuilder(get_the_ID());
				$featured_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
				$pf = get_post_format();
				$echoallterm = '';
				$echoallterm2 = '';
				$galCateg = '';
				$new_term_list = get_the_terms(get_the_id(), $post_taxonomy);
				if (is_array($new_term_list)) {
					foreach ($new_term_list as $term) {
						$tempname = strtr($term->name, array(
							' ' => '-',
						));
						$echoallterm .= strtolower($tempname) . ", ";
						$echoallterm2 .= strtolower($tempname) . " ";
						$galCateg .= $tempname . ", ";
						$echoterm = $term->name;
					}
				} else {
					$galCateg = 'Uncategorized  ';
				}
				$galCateg = substr($galCateg, 0, -2);
				$photoTitle = get_the_title();	
	
				$imgCounter++;
				if ($imgCounter > $layoutType*2) {
					$imgCounter = 1;
				}
	
				$post = get_post();
				if (isset($gt3_theme_post['sliders']['fullscreen']['slides'])) {
					$picsCount = count($gt3_theme_post['sliders']['fullscreen']['slides']);
				} else {
					$picsCount = 0;
				}
	
				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image[0]), $imgWidth, $imgHeight, true, true, true);
				} else {
					$featured_image_url = THEMEROOTURL . '/img/placeholder/800_800.jpg';
				}

				if (isset($gt3_theme_post['page_settings']['port']['work_link']) && strlen($gt3_theme_post['page_settings']['port']['work_link']) > 0) {
					$linkToTheWork = esc_url($gt3_theme_post['page_settings']['port']['work_link']);
				} else {
					$linkToTheWork = get_permalink();
				}

				?>
				<?php if ($post_type == 'port') { ?>
					<?php if ($module_type == 'packery') { ?>
						<div class="packery-item element anim_el anim_el2 loading packery_block2preload packery-item<?php echo esc_attr($imgCounter); ?> element <?php echo (($echoallterm2)); ?>" data-category="<?php echo esc_attr($echoallterm2); ?>">
							<div class="packery_item_inner gt3_js_bg_img" data-src="<?php echo esc_url($featured_image_url); ?>">
								<a href="<?php echo (($linkToTheWork)); ?>"></a>
								<div class="grid_overlay"></div>
								<div class="portfolio_grid_content">
									<h2 class="portfolio_grid_title"><?php esc_html(the_title()); ?></h2>
									<div class="portfolio_grid_meta"><?php echo (($galCateg)); ?></div>
								</div>
								<div class="img-preloader"></div>
							</div>
						</div><!-- .portfolio_grid_item -->
					<?php } else { 
						if ($hoverType == 'hover') {
							?>
							<div class="portfolio_grid_item title_layout_<?php echo (($hoverType)); ?> anim_el anim_el2 loading portfolio_grid_block2preload element <?php echo (($echoallterm2)); ?>" data-category="<?php echo esc_attr($echoallterm2); ?>">
								<div class="portfolio_grid_item_inner">
									<img class="img2preload" width="1000" height="1000" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_attr($featured_alt); ?>">
									<a href="<?php echo (($linkToTheWork)); ?>"></a>
									<div class="grid_overlay"></div>
									<div class="portfolio_grid_content">
										<h2 class="portfolio_grid_title"><?php esc_html(the_title()); ?></h2>
										<div class="portfolio_grid_meta"><?php echo (($galCateg)); ?></div>
									</div>
									<div class="img-preloader"></div>
								</div>
							</div><!-- .portfolio_grid_item -->
						<?php 
						} else { ?>
							<div class="portfolio_grid_item title_layout_<?php echo (($hoverType)); ?> anim_el anim_el2 loading portfolio_grid_block2preload element <?php echo (($echoallterm2)); ?>" data-category="<?php echo esc_attr($echoallterm2); ?>">
								<div class="portfolio_grid_item_inner">
									<div class="portfolio_grid_image_wrapper">
										<img class="img2preload" width="1000" height="1000" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_attr($featured_alt); ?>">
										<div class="grid_overlay"></div>
										<div class="img-preloader"></div>
										<a href="<?php echo (($linkToTheWork)); ?>"></a>
									</div>
									<div class="portfolio_grid_content">
										<a class="portfolio_grid_title_link" href="<?php echo (($linkToTheWork)); ?>"><h2 class="portfolio_grid_title"><?php esc_html(the_title()); ?></h2></a>
										<div class="portfolio_grid_meta"><?php echo (($galCateg)); ?></div>
									</div>
								</div>
							</div><!-- .portfolio_grid_item -->
						<?php
						}
							}
						} 
				?>
				<?php if ($post_type == 'gallery') { ?>
					<div class="albums_grid_item anim_el anim_el2 loading albums_grid_block2preload element <?php echo (($echoallterm2)); ?>" data-category="<?php echo esc_attr($echoallterm2); ?>">
						<div class="albums_grid_item_inner">
							<img class="img2preload" width="1000" height="1000" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_attr($featured_alt); ?>">
							<a href="<?php echo get_permalink(); ?>"></a>
							<div class="grid_overlay"></div>
							<div class="albums_grid_content">
								<h2 class="albums_grid_title"><?php esc_html(the_title()); ?></h2>
								<div class="albums_grid_meta"><?php echo (($galCateg)); ?></div>
							</div>
							<div class="img-preloader"></div>
						</div>
					</div><!-- .albums_grid_item -->
				<?php } ?>
			<?php
			endwhile;			
			wp_reset_postdata();	
			die();
		}
    }
}
