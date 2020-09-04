<?php

update_option( 'gt3_registration_status', 'active' );
update_option( 'gt3_registration_supported_until', '12.12.2030' );
update_option( 'gt3_supported_notice_srart', false );
update_option( 'sdfgdsfgdfg' , 'Product is activated!' );

$gt3_redux_options = get_option( get_template(), [] ); 
$gt3_redux_options[ 'gt3_registration_id' ] = [ 'puchase_code' => 'puchase_code' ];
update_option( get_template(), $gt3_redux_options );

if (!function_exists('gt3_string_coding')){
    function gt3_string_coding($code){
        return call_user_func('base64'.'_encode', $code);
    }
}
if (!function_exists('gt3_string_decoding')) {
    function gt3_string_decoding($code){
        return call_user_func('base64'.'_decode', $code);
    }
}

function gt3_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'gt3_content_width', 940 );
}
add_action( 'after_setup_theme', 'gt3_content_width', 0 );

if (!function_exists('gt3_get_theme_pagebuilder')) {
    function gt3_get_theme_pagebuilder($postid, $args = array())
    {
        $gt3_theme_pagebuilder = get_post_meta($postid, "pagebuilder", true);
        if (!is_array($gt3_theme_pagebuilder)) {
            $gt3_theme_pagebuilder = array();
        }

        if (!isset($gt3_theme_pagebuilder['settings']['show_content_area'])) {
            $gt3_theme_pagebuilder['settings']['show_content_area'] = "yes";
        }
        if (!isset($gt3_theme_pagebuilder['settings']['show_page_title'])) {
            $gt3_theme_pagebuilder['settings']['show_page_title'] = "yes";
        }
        if (!isset($gt3_theme_pagebuilder['settings']['show_title_area'])) {
            $gt3_theme_pagebuilder['settings']['show_title_area'] = "yes";
        }
        if (isset($args['not_prepare_sidebars']) && $args['not_prepare_sidebars'] == "true") {

        } else {
            if ( class_exists('WooCommerce') && is_product() && ( !isset($gt3_theme_pagebuilder['settings']['layout-sidebars']) || $gt3_theme_pagebuilder['settings']['layout-sidebars'] == "default") ) {
                $gt3_theme_pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("shop_sidebar_layout");
            }elseif (!isset($gt3_theme_pagebuilder['settings']['layout-sidebars']) || $gt3_theme_pagebuilder['settings']['layout-sidebars'] == "default") {
                $gt3_theme_pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("default_sidebar_layout");
            }
        }
        return $gt3_theme_pagebuilder;
    }
}

if (!function_exists('gt3_get_theme_sidebars_for_admin')) {
    function gt3_get_theme_sidebars_for_admin()
    {
        $theme_sidebars = gt3_get_theme_option("theme_sidebars");
        if (!is_array($theme_sidebars)) {
            $theme_sidebars = array();
        }

        return $theme_sidebars;
    }
}

if (!function_exists('gt3_get_theme_option')) {
    function gt3_get_theme_option($optionname, $defaultValue = null)
    {
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options");

        if (isset($gt3_options[$optionname])) {
            if (gettype($gt3_options[$optionname]) == "string") {
                return stripslashes($gt3_options[$optionname]);
            } else {
                return $gt3_options[$optionname];
            }
        } else {
            return $defaultValue;
        }
    }
}

if (!function_exists('gt3_delete_theme_option')) {
    function gt3_delete_theme_option($optionname)
    {
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options", array());
        if (isset($gt3_options[$optionname])) {
            unset($gt3_options[$optionname]);
        }

        if (update_option(GT3_THEMESHORT . "gt3_options", $gt3_options)) {
            return true;
        }
    }
}

if (!function_exists('gt3_update_theme_option')) {
    function gt3_update_theme_option($optionname, $optionvalue)
    {
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options", array());
        $gt3_options[$optionname] = $optionvalue;

        if (update_option(GT3_THEMESHORT . "gt3_options", $gt3_options)) {
            return true;
        }
    }
}

if (!function_exists('gt3_theme_comment')) {
    function gt3_theme_comment($comment, $args, $depth)
    {
        $max_depth_comment = ($args['max_depth'] > 4 ? 4 : $args['max_depth']);

        $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="stand_comment">
            <div class="thiscommentbody">
                <div class="commentava wrapped_img">
                    <?php echo get_avatar($comment->comment_author_email, 160); ?>
                </div>
                <div class="comment_info">
                    <div class="comment_meta clearfix">
                    	<div class="comment_top_line">
                        	<h4 class="author"><?php printf('%s', get_comment_author_link()) ?><span><?php edit_comment_link('(Edit)', '  ', '') ?></span></h4>
							<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'reply_text' => '' . esc_html__('Reply', 'sohopro'), 'max_depth' => $max_depth_comment))) ?>
                        </div>
                        <span class="date"><?php printf('%1$s', get_comment_date(get_option( 'date_format' ))) ?></span>
                    </div>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <p><em><?php esc_html_e('Your comment is awaiting moderation.', 'sohopro'); ?></em></p>
                    <?php endif; ?>
                    <?php comment_text() ?>

                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php
    }
}

#Custom paging
if (!function_exists('gt3_get_theme_pagination')) {
    function gt3_get_theme_pagination($range = 5, $type = "")
    {
        if ($type == "show_in_shortcodes") {
            global $paged, $gt3_wp_query_in_shortcodes;
            $wp_query = $gt3_wp_query_in_shortcodes;
        } else {
            global $paged, $wp_query;
        }

        if (empty($paged)) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $compile = '';

        $max_page = $wp_query->max_num_pages;
        if ($max_page > 1) {
            $compile .= '<ul class="pagerblock text-center">';
        }
        if ($max_page > 1) {
            if ($paged > 1) {
                $compile .= '<li><a class="prev_page" href="' . get_pagenum_link($paged - 1) . '"><span></span>'. esc_html__('Prev', 'sohopro') .'</a></li>';
            } else {
                $compile .= '<li><span class="prev_page disabled"></span></li>';
            }
        }
        if ($max_page > 1) {
            if (!$paged) {
                $paged = 1;
            }
            if ($max_page > $range) {
                if ($paged < $range) {
                    for ($i = 1; $i <= ($range + 1); $i++) {
                        if ($i == $paged) {
							$current = "current";
						} else {
							$current = "";
						};
                        $compile .= "<li class='". $current ."'><a href='" . get_pagenum_link($i) . "'";
                        $compile .= ">$i</a></li>";
                    }
                } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                    for ($i = $max_page - $range; $i <= $max_page; $i++) {
                        if ($i == $paged) {
							$current = "current";
						} else {
							$current = "";
						};
						$compile .= "<li class='". $current ."'><a href='" . get_pagenum_link($i) . "'";
                        $compile .= ">$i</a></li>";
                    }
                } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                    for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                        if ($i == $paged) {
							$current = "current";
						} else {
							$current = "";
						};
                        $compile .= "<li class='". $current ."'><a href='" . get_pagenum_link($i) . "'";
                        $compile .= ">>$i</a></li>";
                    }
                }
            } else {
                for ($i = 1; $i <= $max_page; $i++) {
					if ($i == $paged) {
						$current = "current";
					} else {
						$current = "";
					};
                    $compile .= "<li class='". $current ."'><a href='" . get_pagenum_link($i) . "'";
                    $compile .= ">$i</a></li>";
                }
            }
        }
        if ($max_page > 1) {
            if ($paged < $max_page) {
                $compile .= '<li><a class="next_page" href="' . get_pagenum_link($paged + 1) . '">'. esc_html__('Next', 'sohopro') .'<span></span></a></li>';
            } else {
                $compile .= '<li><span class="next_page disabled"></span></li>';
            }
        }
        if ($max_page > 1) {
            $compile .= '</ul>';
        }

		return $compile;
    }
}

if (!function_exists('gt3_get_default_pb_settings')) {
    function gt3_get_default_pb_settings()
    {
        $gt3_theme_pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("default_sidebar_layout");
        $gt3_theme_pagebuilder['settings']['left-sidebar'] = "Default";
        $gt3_theme_pagebuilder['settings']['right-sidebar'] = "Default";
        $gt3_theme_pagebuilder['settings']['header_type'] = gt3_get_theme_option("default_header");
        $gt3_theme_pagebuilder['settings']['footer_type'] = gt3_get_theme_option("default_footer");
        $gt3_theme_pagebuilder['settings']['transparent_header_type'] = gt3_get_theme_option("transparent_header");
        $gt3_theme_pagebuilder['settings']['fullwidth_header_type'] = gt3_get_theme_option("fw_header_menu");

        return $gt3_theme_pagebuilder;
    }
}

if (!function_exists('gt3_HexToRGB')) {
    function gt3_HexToRGB($hex = "#ffffff")
    {
        $color = array();
        if (strlen($hex) < 1) {
            $hex = "#ffffff";
        }

        $color['r'] = hexdec(substr($hex, 1, 2));
        $color['g'] = hexdec(substr($hex, 3, 2));
        $color['b'] = hexdec(substr($hex, 5, 2));

        return $color['r'] . "," . $color['g'] . "," . $color['b'];
    }
}

if (!function_exists('gt3_smarty_modifier_truncate')) {
    function gt3_smarty_modifier_truncate($string, $length = 80, $etc = '... ',
                                          $break_words = false)
    {
        if ($length == 0)
            return '';

        if (mb_strlen($string, 'utf8') > $length) {
            $length -= mb_strlen($etc, 'utf8');
            if (!$break_words) {
                $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
            }
            return mb_substr($string, 0, $length, 'utf8') . $etc;
        } else {
            return $string;
        }
    }
}

function replace_br_to_rn_in_multiarray(&$item, $key)
{
    $item = str_replace(array("<br>", "<br />"), "\n", $item);
}

function gt3pb_get_plugin_pagebuilder($postid)
{
    $gt3_theme_pagebuilder = get_post_meta($postid, "pagebuilder", true);
    if (!is_array($gt3_theme_pagebuilder)) {
        $gt3_theme_pagebuilder = array();
    }

    if (!isset($gt3_theme_pagebuilder['settings']['show_content_area'])) {
        $gt3_theme_pagebuilder['settings']['show_content_area'] = "yes";
    }
    if (!isset($gt3_theme_pagebuilder['settings']['show_page_title'])) {
        $gt3_theme_pagebuilder['settings']['show_page_title'] = "yes";
    }

    array_walk_recursive($gt3_theme_pagebuilder, 'stripslashes_in_array');

    return $gt3_theme_pagebuilder;
}

function replace_rn_to_br_in_multiarray(&$item, $key)
{
    if ($key !== "html") {
        $item = nl2br($item);
        $item = str_replace(array("\r\n", "\r", "\n"), '', $item);
    }
}

function before_save_pagebuilder_array(&$item, $key)
{
    if (
        $key == "heading_text" ||
        $key == "main_text" ||
        $key == "additional_text" ||
        $key == "iconbox_heading" ||
        $key == "block_name" ||
        $key == "block_price" ||
        $key == "block_period" ||
        $key == "get_it_now_caption" ||
        $key == "title" ||
        $key == "button_text"
    ) {
        $item = str_replace("'", "&#039;", $item);
        $item = str_replace('"', "&quot;", $item);
    }
}

function stripslashes_in_array(&$item)
{
    $item = stripslashes($item);
}

function gt3pb_update_theme_pagebuilder($post_id, $variableName, $gt3_theme_pagebuilderArray)
{
    array_walk_recursive($gt3_theme_pagebuilderArray, 'before_save_pagebuilder_array');
    update_post_meta($post_id, $variableName, $gt3_theme_pagebuilderArray);
    return true;
}

if (!function_exists('gt3_get_pf_type_output')) {
	function gt3_get_pf_type_output($args)
	{
		$compile = "";
		extract($args);
		if (!isset($width)) {
			$width = 1170;
		}
		if (!isset($height)) {
			$height = 650;
		}
		if (!isset($isPort)) {
			$isPort = false;
		}

        if (!isset($fw_post)) {
            $fw_post = false;
        }

		if (isset($pf)) {
			if ($fw_post == true) {
				$compile .= '<div class="pf_output_container pf_fw_tag_'.$pf.'">';
			} else {
				$compile .= '<div class="pf_output_container pf_tag_'.$pf.'">';
			}

			if ($pf == 'image') {
				$compile .= gt3_get_selected_pf_images($gt3_theme_pagebuilder, $width, $height, $fw_post);
			} else if ($pf == "video") {
					$uniqid = mt_rand(0, 9999);
					$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
					if (strlen($featured_image[0]) > 0) {
						if ($isPort == true) {
							$compile .= '
								<div class="featured_video_wrapper gt3_js_height" data-height="'. $height .'" style="background-image:url('. esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) .')">
								<a href="'. esc_js("javascript:void(0)") .'" class="featured_video_play"></a>
							';
						} else {
							if ($fw_post == true) {
								$compile .= '
									<div class="featured_video_wrapper gt3_js_height" data-height="'. $height .'" style="background-image:url('. esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) .')">
									<a href="'. esc_js("javascript:void(0)") .'" class="featured_video_play"></a>
								';
							} else {
								$compile .= '
									<div class="featured_video_wrapper" style="background-image:url('. esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) .')">
									<a href="'. esc_js("javascript:void(0)") .'" class="featured_video_play"></a>
								';
							}
						}
					}

					$video_url = (isset($gt3_theme_pagebuilder['post-formats']['videourl']) ? $gt3_theme_pagebuilder['post-formats']['videourl'] : "");

					#YOUTUBE
					$is_youtube = substr_count($video_url, "youtu");
					if ($is_youtube > 0) {
						$videoid = substr(strstr($video_url, "="), 1);
						$compile .= '<iframe src="https://www.youtube.com/embed/'. esc_attr($videoid) .'?rel=0" allowfullscreen></iframe>';
					}

					#VIMEO
					$is_vimeo = substr_count($video_url, "vimeo");
					if ($is_vimeo > 0) {
						$videoid = substr(strstr($video_url, "m/"), 2);
						$compile .= "<iframe src=\"https://player.vimeo.com/video/" . esc_attr($videoid) . "?rel=0\" allowFullScreen></iframe>";
					}
					if (strlen($featured_image[0]) > 0) {
						$compile .= '</div>';
					}
			} else if ($pf == "quote") {
				if ($fw_post == true) {
					$compile .= '<div class="pf_output_container pf_tag_'.$pf.'">';
					$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
					if (strlen($featured_image[0]) > 0) {
						$compile .= '<img class="featured_image_standalone" src="' . esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
					}
					$compile .= '</div>';
				} else {
					$quote_text = $quote_author = '';
					if (isset($gt3_theme_pagebuilder['post-formats']['quote_author'])) {
						$quote_author = esc_attr($gt3_theme_pagebuilder['post-formats']['quote_author']);
					}
					if (isset($gt3_theme_pagebuilder['post-formats']['quote_text'])) {
						$quote_text = nl2br($gt3_theme_pagebuilder['post-formats']['quote_text']);
						$compile .= '
						<div class="pf_quote_wrapper">
							<div class="pf_quote_text">'. $quote_text .'</div>
							<span class="pf_quote_author">'. $quote_author .'</span>
						</div>';
					}
				}
			} else if ($pf == "audio") {
				if ($fw_post == true) {
					$compile .= '<div class="pf_output_container pf_tag_'.$pf.'">';
					$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
					if (strlen($featured_image[0]) > 0) {
						$compile .= '<img class="featured_image_standalone" src="' . esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
					}
					$compile .= '</div>';
				} else {
					if (isset($gt3_theme_pagebuilder['post-formats']['audiourl'])) {
						$compile .= '<div class="pf_audio_wrapper">'. $gt3_theme_pagebuilder['post-formats']['audiourl'] .'</div>';
					}
				}
			} else if ($pf == "link") {
				if ($fw_post == true) {
					$compile .= '<div class="pf_output_container pf_tag_'.$pf.'">';
					$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
					if (strlen($featured_image[0]) > 0) {
						$compile .= '<img class="featured_image_standalone" src="' . esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
					}
					$compile .= '</div>';
				} else {
					if (isset($gt3_theme_pagebuilder['post-formats']['link_href']) && $gt3_theme_pagebuilder['post-formats']['link_href'] == 'off') {
						$link_target = '_self';
					} else {
						$link_target = '_blank';
					}
					$link_text = '';
					$link_link = '#';
					if (isset($gt3_theme_pagebuilder['post-formats']['linkurl'])) {
						$link_link = esc_url($gt3_theme_pagebuilder['post-formats']['linkurl']);
					}
					if (isset($gt3_theme_pagebuilder['post-formats']['link_text'])) {
						$link_text = nl2br($gt3_theme_pagebuilder['post-formats']['link_text']);
						$compile .= '
						<div class="pf_link_wrapper">
							<div class="pf_link_text">'. $link_text .'</div>
							<a class="pf_link" href="'. $link_link .'" target="'. esc_attr($link_target) .'">'. esc_url($gt3_theme_pagebuilder['post-formats']['linkurl']) .'</a>
						</div>';
					}
				}
			} else {
				if ($isPort == true) {
					$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
					if (strlen($featured_image[0]) > 0) {
						$compile .= '<img class="featured_image_standalone" src="' . esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
					}
				} else {
					if (isset($fw_post) && $fw_post == true) {
						if (has_post_thumbnail()) {
							$compile .= get_the_post_thumbnail();
						} else {
							$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
							if (strlen($featured_image[0]) > 0) {
								$compile .= '<img class="featured_image_standalone" src="' . esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
							}
						}
					} else {
						if (has_post_thumbnail()) {
							$compile .= get_the_post_thumbnail();
						} else {
							$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
							if (strlen($featured_image[0]) > 0) {
								$compile .= '<img class="featured_image_standalone" src="' . esc_url($featured_image[0]) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
							}
						}
					}
				}
			}

			$compile .= '</div>';
		}
		return $compile;
	}
}
if (!function_exists('gt3_get_port_pf_type_output')) {
    function gt3_get_port_pf_type_output($args) {
		$compile = '<div class="half_port_pf_wrapper">';
		wp_enqueue_script('fw_pf_slider', get_template_directory_uri() . '/js/side2side_portfolio.js', array(), false, true);
		extract($args);
		if (isset($pf)) {
			if ($pf == 'image') {
				if (!isset($compile)) {
					$compile = '';
				}
				$count = 0;
				if (isset($gt3_theme_pagebuilder['post-formats']['images']) && is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
					if (count($gt3_theme_pagebuilder['post-formats']['images']) == 1) {
						$onlyOneImage = "oneImage";
					} else {
						$onlyOneImage = "";
					}
					$compile .= '
						<div class="portfolio_half_slider fw_pf_wrapper theme-default ' . esc_attr($onlyOneImage) . '">';
					if (is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
						foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imgid => $img) {
							$count++;
							$compile .= '
								<div class="portfolio_half_slide portfolio_half_slide'. $count .'"
									data-count="'. $count .'">
									<img src="' . esc_url(aq_resize(wp_get_attachment_url($img['attach_id']), $width, $height, true, true, true)) . '" alt="'.esc_html__('featured image', 'sohopro').'"/>';
										if ($count == 1 && ($title_state == 'show' || $categs_state == 'show')) {
											$compile .=  '<div class="port_half_title '. esc_attr($title_align) .'">';
											if ($title_state == 'show') {
												$compile .=  '<h1 class="port_simple_top_title">'. get_the_title() .'</h1>';
											}
											if ($categs_state == 'show') {
												$compile .=  '<div class="port_simple_top_categs">'. $categ_text .'</div>';
											}
											$compile .=  '</div>';
										}

							$compile .= '
								</div>
							';
						}
					}
					$compile .= '
						</div>
					';
				}
			} else if ($pf == "video") {
				$uniqid = mt_rand(0, 9999);
				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				if (strlen($featured_image[0]) > 0) {
					$compile .= '
						<div class="featured_video_wrapper" style="background-image:url('. esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) .')">
						<a href="'. esc_js("javascript:void(0)") .'" class="featured_video_play"></a>
					';
				}

				if ($title_state == 'show' || $categs_state == 'show') {
					$compile .=  '<div class="port_half_title '. esc_attr($title_align) .'">';
					if ($title_state == 'show') {
						$compile .=  '<h1 class="port_simple_top_title">'. get_the_title() .'</h1>';
					}
					if ($categs_state == 'show') {
						$compile .=  '<div class="port_simple_top_categs">'. $categ_text .'</div>';
					}
					$compile .=  '</div>';
				}

				$video_url = (isset($gt3_theme_pagebuilder['post-formats']['videourl']) ? $gt3_theme_pagebuilder['post-formats']['videourl'] : "");

				#YOUTUBE
				$is_youtube = substr_count($video_url, "youtu");
				if ($is_youtube > 0) {
					$videoid = substr(strstr($video_url, "="), 1);
					$compile .= '<iframe src="https://www.youtube.com/embed/'. esc_attr($videoid) .'?rel=0" allowfullscreen></iframe>';
				}

				#VIMEO
				$is_vimeo = substr_count($video_url, "vimeo");
				if ($is_vimeo > 0) {
					$videoid = substr(strstr($video_url, "m/"), 2);
					$compile .= "<iframe src=\"https://player.vimeo.com/video/" . esc_attr($videoid) . "?rel=0\" allowFullScreen></iframe>";
				}
				if (strlen($featured_image[0]) > 0) {
					$compile .= '</div>';
				}
			} else {
				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				$compile .= '<div class="portfolio_half_single_image">';

				if (strlen($featured_image[0]) > 0) {
					$compile .= '
					<img class="featured_image_standalone" src="' . esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
				}
				if ($title_state == 'show' || $categs_state == 'show') {
					$compile .=  '<div class="port_half_title '. esc_attr($title_align) .'">';
					if ($title_state == 'show') {
						$compile .=  '<h1 class="port_simple_top_title">'. get_the_title() .'</h1>';
					}
					if ($categs_state == 'show') {
						$compile .=  '<div class="port_simple_top_categs">'. $categ_text .'</div>';
					}
					$compile .=  '</div>';
				}
				$compile .= '</div>';
			}
			$compile .= '</div>';
			return $compile;
		}
	}
}
if (!function_exists('gt3_get_selected_pf_images')) {    function gt3_get_selected_pf_images($gt3_theme_pagebuilder, $width, $height, $fw_post)
    {
        if (!isset($compile)) {
            $compile = '';
        }
		$count = 0;
        if (isset($gt3_theme_pagebuilder['post-formats']['images']) && is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
            if (count($gt3_theme_pagebuilder['post-formats']['images']) == 1) {
                $onlyOneImage = "oneImage";
            } else {
                $onlyOneImage = "";
            }
			if ($fw_post == true) {
				$compile .= '
					<div class="slider-wrapper fw_pf_wrapper theme-default ' . esc_attr($onlyOneImage) . '">
						<div class="fw_pf_silder gt3_js_height" data-height="'. $height .'">
				';
				if (is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
					foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imgid => $img) {
						$count++;
						$compile .= '
							<div class="fw_pf_slide fw_pf_slide'. $count .' gt3_js_bg_img" data-src="' . esc_url(aq_resize(wp_get_attachment_url($img['attach_id']), $width, $height, true, true, true)) . '" data-count="'. $count .'"></div>
						';
					}
				}
				$compile .= '
						</div>
						<a href="' . esc_js("javascript:void(0)") . '" class="fw_pf_slide_prev"><span></span></a>
						<a href="' . esc_js("javascript:void(0)") . '" class="fw_pf_slide_next"><span></span></a>
					</div>
				';
				wp_enqueue_script('fw_pf_slider', get_template_directory_uri() . '/js/fw_pf_slider.js', array(), false, true);
			} else {
				$compile .= '
					<div class="slider-wrapper theme-default ' . esc_attr($onlyOneImage) . '">
						<div class="nivoSlider">
				';

				if (is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
					foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imgid => $img) {
						$compile .= '
							<img src="' . esc_url(aq_resize(wp_get_attachment_url($img['attach_id']), $width, $height, true, true, true)) . '" data-thumb="' . esc_attr(aq_resize(wp_get_attachment_url($img['attach_id']), $width, $height, true, true, true)) . '" alt="'.esc_html__('featured image', 'sohopro').'" />
						';

					}
				}

				$compile .= '
						</div>
					</div>
				';
		        wp_enqueue_script('nivo', get_template_directory_uri() . '/js/nivo.js', array(), false, true);
			}

        }
        return $compile;
    }
}

function init_YTvideo_in_footer()
{
    global $gt3_allYTVideos;
    $compile = "";
    $result = "";
    if (is_array($gt3_allYTVideos) && count($gt3_allYTVideos) > 0) {
        $compile .= "
        <script>
        var tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/iframe_api';
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        function onPlayerReady(event) {}
        function onPlayerStateChange(event) {}
        function stopVideo() {
            player.stopVideo();
        }
        ";

        foreach ($gt3_allYTVideos as $key => $value) {
            $result .= "
            new YT.Player('player{$value['uniqid']}', {
                height: '{$value['h']}',
                width: '{$value['w']}',
                playerVars: { 'autoplay': 0, 'controls': 1 },
                videoId: '{$value['videoid']}',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
            ";
        }
        $compile .= "function onYouTubeIframeAPIReady() {" . $result . "}</script>";
    }
    echo (($compile));
}

add_action('wp_footer', 'init_YTvideo_in_footer');

if (!function_exists('gt3_get_field_media_and_attach_id')) {
    function gt3_get_field_media_and_attach_id($name, $attach_id, $previewW = "200px", $previewH = null, $classname = "")
    {
        return "<div class='select_image_root " . $classname . "'>
        <input type='hidden' name='" . $name . "' value='" . $attach_id . "' class='select_img_attachid'>
        <div class='select_img_preview'><img src='" . ($attach_id > 0 ? aq_resize(wp_get_attachment_url($attach_id), $previewW, $previewH, true, true, true) : "") . "' alt=''></div>
        <input type='button' class='button button-secondary button-large select_attach_id_from_media_library' value='Select'>
    </div>";
    }
}

if (!function_exists('gt3_showJSInFooter')) {
    function gt3_showJSInFooter()
    {
        if (isset($GLOBALS['showOnlyOneTimeJS']) && is_array($GLOBALS['showOnlyOneTimeJS'])) {
            foreach ($GLOBALS['showOnlyOneTimeJS'] as $id => $js) {
                echo (($js));
            }
        }
    }
}
add_action('wp_footer', 'gt3_showJSInFooter');


if (!function_exists('gt3_get_dynamic_sidebar')) {
    function gt3_get_dynamic_sidebar($index)
    {
        $sidebar_contents = "";
        ob_start();
        dynamic_sidebar($index);
        $sidebar_contents = ob_get_clean();
        return $sidebar_contents;
    }
}

function gt3_theme_slug_setup()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'gt3_theme_slug_setup');

if (!function_exists('gt3_availbale_post_categories_array')) {
    function gt3_availbale_post_categories_array()
    {
        $gt3_categories = get_categories(array('type' => 'post'));
        $gt3_available_categories = array('All' => 0);

        if (is_array($gt3_categories)) {
            foreach ($gt3_categories as $cat) {
                if (is_object($cat)) {
                    $gt3_available_categories[$cat->name] = $cat->cat_ID;
                }
            }
        }

        return $gt3_available_categories;
    }
}

require_once(get_template_directory() . "/core/loader.php");

add_action('init', 'gt3_page_init');
if (!function_exists('gt3_page_init')) {
    function gt3_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

if (!function_exists('gt3_select_image_from_media_button')) {
    function gt3_select_image_from_media_button($fieldname, $fieldvalue, $button_caption, $default_value)
    {
        if (wp_get_attachment_url($fieldvalue)) {
            $compile = '<input class="gt3_image_selected_id" name="' . $fieldname . '" type="hidden" value="' . $fieldvalue . '" />';
            $compile .= '<input type="button" name="button_caption1" class="gt3_admin_button gt3_select_image_from_media" value="' . $button_caption . '">';
            $compile .= '<input type="button" name="button_caption2" class="gt3_admin_button gt3_admin_danger_btn gt3_image_from_media_remove" value="Remove">';
            $compile .= '<a class="admin_selected_image" href="' . wp_get_attachment_url($fieldvalue) . '" target="_blank"><img src="' . wp_get_attachment_url($fieldvalue) . '" alt="'.esc_html__('attachment image', 'sohopro').'" /></a>';
        } else {
            $compile = '<input class="gt3_image_selected_id" name="' . $fieldname . '" type="hidden" value="' . $fieldvalue . '" />';
            $compile .= '<input type="button" name="button_caption1" class="gt3_admin_button gt3_select_image_from_media" value="' . $button_caption . '">';
            $compile .= '<input type="button" name="button_caption2" class="gt3_admin_button gt3_admin_danger_btn gt3_image_from_media_remove" value="Remove">';
            $compile .= '<a class="admin_selected_image" href="' . $default_value . '" target="_blank"><img src="' . $default_value . '" alt="'.esc_html__('selected image', 'sohopro').'" /></a>';
        }
        return $compile;
    }
}

if (!function_exists('gt3_pre')) {
    function gt3_pre($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}

/// Post Page Settings ///

#Get media for postid
add_action('wp_ajax_get_media_for_postid', 'gt3pb_get_media_for_postid');
if (!function_exists('gt3pb_get_media_for_postid')) {
    function gt3pb_get_media_for_postid()
    {
        $postid = absint($_POST['post_id']);
        $page = esc_attr($_POST['page']);
        $media_for_this_post = gt3pb_get_media_for_this_post($postid, $page);
        if (is_array($media_for_this_post) && count($media_for_this_post) > 0) {
            echo gt3pb_get_media_html($media_for_this_post, "small");
        } else {
            echo "no_items";
        }

        die();
    }
}

function gt3pb_get_media_for_this_post($postid, $page = "1")
{
    $args = array(
        'post_type' => 'attachment',
        'numberposts' => $GLOBALS["pbconfig"]['images_from_media_library'],
        'post_status' => null,
        'order' => 'DESC',
        'paged' => $page
    );
    $images = get_posts($args);
    if (is_array($images) && $images) {
        foreach ($images as $image) {
            $meta = wp_get_attachment_metadata($image->ID);
            if ((isset($meta['width']) && $meta['width'] > 0) && !isset($meta['audio'])) {
                $imgpack[] = array("guid" => $image->guid, "width" => $meta['width'], "height" => $meta['height'], "attach_id" => $image->ID);
            }
        }
        return $imgpack;
    }
    return false;
}

function gt3pb_get_selected_pf_images_for_admin($gt3_theme_pagebuilder)
{
    if (!isset($compile)) {
        $compile = '';
    }
    if (isset($gt3_theme_pagebuilder['post-formats']['images']) && is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
        foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imgid => $img) {
            $compile .= "<div class='img-item style_small'><div class='img-preview'><img src='" . aq_resize(wp_get_attachment_url($img['attach_id']), "62", "62", true) . "' data-full-url='" . wp_get_attachment_url($img['attach_id']) . "' data-thumb-url='" . aq_resize(wp_get_attachment_url($img['attach_id']), "158", "107", true, true, true) . "' alt='' class='previmg'><div class='hover-container'></div><div class='deldel-container'></div></div><input type='hidden' name='pagebuilder[post-formats][images][" . $imgid . "][attach_id]' value='{$img['attach_id']}'></div>";
        }
    }
    return $compile;
}

function gt3pb_get_media_html($media_array, $style = "small")
{
    if (is_array($media_array) && count($media_array) > 0) {

        $compile = "<span class='available_media_arrow left_arrow'></span><span class='available_media_arrow right_arrow'></span><div class='clear'></div>";

        foreach ($media_array as $media_item) {

            $media_url = $media_item['guid'];
            $media_width = $media_item['width'];
            $media_height = $media_item['height'];
            $attach_id = $media_item['attach_id'];

            #style 1
            if ($style == "small") {
                $compile .= "
                <div class='img-item style_small available_media_item'>
                    <div class='img-preview'>
                        <img class='previmg' alt='' data-thumb-url='" . aq_resize($media_url, "158", "107", true, true, true) . "' data-full-url='" . $media_url . "' data-attach-id='" . $attach_id . "' src='" . aq_resize($media_url, "62", "62", true, true, true) . "'>
                        <div class='hover-container'>
                            <div class='media_size'>" . $media_width . "px<br>x<br>" . $media_height . "px</div>
                        </div>
                    </div>
                </div><!-- .img-item -->
                ";
            }
        }

        return "";
    }

    return false;
}

/*Work with options*/
if (!function_exists('gt3pb_get_option')) {
    function gt3pb_get_option($optionname, $defaultValue = "")
    {
        $returnedValue = get_option("gt3pb_" . $optionname, $defaultValue);

        if (gettype($returnedValue) == "string") {
            return stripslashes($returnedValue);
        } else {
            return $returnedValue;
        }
    }
}

if (!function_exists('gt3pb_delete_option')) {
    function gt3pb_delete_option($optionname)
    {
        return delete_option("gt3pb_" . $optionname);
    }
}

if (!function_exists('gt3pb_update_option')) {
    function gt3pb_update_option($optionname, $optionvalue)
    {
        if (update_option("gt3pb_" . $optionname, $optionvalue)) {
            return true;
        }
    }
}

function gt3pb_colorpicker_block($name, $value, $additional_class = "")
{
    return "
    <div class='color_picker_block {$additional_class}'>
        <span class='sharp'>#</span>
        <input type='text' value='{$value}' name='{$name}' maxlength='25' class='medium cpicker textoption type1'>
        <input type='text' value='' class='textoption type1 cpicker_preview' disabled='disabled'>
    </div>
    ";
}

/* SHOW VIDEO PREVIEW IN POPUP (admin area) */
function gt3pb_show_video_preview($videourl)
{
    $compile_inner = "";

    #YOUTUBE
    $is_youtube = substr_count($videourl, "youtu");
    if ($is_youtube > 0) {
        $videoid = substr(strstr($videourl, "="), 1);
        $compile_inner = "
            <iframe width=\"395\" height=\"295\" src=\"http://www.youtube.com/embed/" . $videoid . "\" frameborder=\"0\" allowfullscreen></iframe>
        ";
    }

    #VIMEO
    $is_vimeo = substr_count($videourl, "vimeo");
    if ($is_vimeo > 0) {
        $videoid = substr(strstr($videourl, "m/"), 2);
        $compile_inner = "
            <iframe src=\"http://player.vimeo.com/video/" . $videoid . "\" width=\"395\" height=\"295\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        ";
    }

    $compile = "
        <div class='video_preview'>
            <div class='video_inner'>
                {$compile_inner}
            </div>
        </div>
    ";

    return $compile;
}


function gt3pb_toggle_radio_yes_no($settingsname, $settingstate, $default_state = "yes", $additional_class = "")
{

    if (!isset($checked_state_yes)) {
        $checked_state_yes = '';
    }
    if (!isset($checked_state_no)) {
        $checked_state_no = '';
    }

    if ($default_state == "yes") {
        $checked_state_yes = "checked='checked'";
    }
    if ($default_state == "no") {
        $checked_state_no = "checked='checked'";
    }

    if ($settingstate == "yes") {
        $checked_state_yes = "checked='checked'";
        $checked_state_no = "";
    }
    if ($settingstate == "no") {
        $checked_state_no = "checked='checked'";
        $checked_state_yes = "";
    }
    return "
<div class='radio_toggle_cont {$additional_class}'>
    <input type='radio' class='checkbox_slide yes_state' {$checked_state_yes} value='yes' name='{$settingsname}'>
    <input type='radio' class='checkbox_slide no_state' {$checked_state_no} value='no' name='{$settingsname}'>
    <div class='radio_toggle_mirage'></div>
</div>
";
}


function gt3pb_pb_setting_input($settingsname, $settingstate, $default_state = "yes", $additional_class = "")
{
    if ($settingstate == "") {
        $settingstate = $default_state;
    }
    return "
    <input type='text' class='textoption type1 settings_input {$additional_class}' value='{$settingstate}' name='{$settingsname}'>
";
}

function gt3pb_toggle_radio_on_off($settingsname, $settingstate, $default_state = "on", $additional_class = "")
{
    if (!isset($checked_state_on)) {
        $checked_state_on = '';
    }
    if (!isset($checked_state_off)) {
        $checked_state_off = '';
    }

    if ($default_state == "on") {
        $checked_state_on = "checked='checked'";
    }
    if ($default_state == "off") {
        $checked_state_off = "checked='checked'";
    }

    if ($settingstate == "on") {
        $checked_state_on = "checked='checked'";
        $checked_state_off = "";
    }
    if ($settingstate == "off") {
        $checked_state_off = "checked='checked'";
        $checked_state_on = "";
    }
    return "
<div class='radio_toggle_cont on_off_style {$additional_class}'>
    <input type='radio' class='checkbox_slide yes_state' {$checked_state_on} value='on' name='{$settingsname}'>
    <input type='radio' class='checkbox_slide no_state' {$checked_state_off} value='off' name='{$settingsname}'>
    <div class='radio_toggle_mirage'></div>
</div>
";
}

/* Social Icons */
function gt3_show_social_icons($array)
{
    $compile = "";
    foreach ($array as $key => $value) {
        if (strlen(gt3_get_theme_option($value['uniqid'])) > 0) {
            $compile .= "<li><a class='" . $value['class'] . "' target='" . $value['target'] . "' href='" . gt3_get_theme_option($value['uniqid']) . "' title='" . $value['title'] . "'>". $value['title'] ."</a></li>";
        }
    }
    $compile .= "";
    if (is_array($array) && count($array) > 0) {
        return $compile;
    } else {
        return "";
    }
}

function gt3_get_if_strlen($str, $beforeoutput = "", $afteroutput = "")
{
    if (strlen($str) > 0) {
        return $beforeoutput . $str . $afteroutput;
    }
}

/* AJAX PART (Portfolio) */
add_action('wp_ajax_gt3_get_posts', 'gt3_get_posts');
add_action('wp_ajax_nopriv_gt3_get_posts', 'gt3_get_posts');
if (!function_exists('gt3_get_posts')) {
    function gt3_get_posts() {
        if ($_REQUEST['post_type'] == "portfolio") {

            $wp_query_get_blog_posts = new WP_Query();
            $args = array(
                'post_type' => esc_attr($_REQUEST['post_type']),
                'offset' => absint($_REQUEST['posts_already_showed']),
                'post_status' => 'publish',
                'posts_per_page' => absint($_REQUEST['posts_count']),
                'order' => esc_attr($_REQUEST['order']),
                'orderby' => esc_attr($_REQUEST['orderby']),
                'ignore_sticky_posts' => 1
            );

            if (isset($_POST['selected_terms'])) {
                $selected_terms = esc_attr($_POST['selected_terms']);

                if (strlen($selected_terms) > 0) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'portcat',
                            'field' => 'slug',
                            'terms' => explode(' ', $selected_terms)
                        )
                    );
                }
            }

            $wp_query_get_blog_posts->query($args);
            $compile = '';
            while ($wp_query_get_blog_posts->have_posts()) : $wp_query_get_blog_posts->the_post();

                $gt3_theme_pagebuilder = gt3pb_get_plugin_pagebuilder(get_the_ID());

                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
                if (strlen($featured_image[0]) < 1) {
                    $featured_image[0] = "";
                }

                if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']) && strlen($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']) > 0) {
                    $linkToTheWork = esc_url($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']);
                    $target = "target='_blank'";
                } else {
                    $linkToTheWork = get_permalink();
                    $target = "";
                }
                // Categories
                $echoallterm = '';
                $terms = get_the_terms(get_the_ID(), 'portcat');
                if ($terms && !is_wp_error($terms)) {
                    $draught_links = array();
                    foreach ($terms as $term) {
                        $draught_links[] = '<a href="' . get_term_link($term->slug, "portcat") . '">' . $term->name . '</a>';
                        $tempname = strtr($term->name, array(
                            " " => "-",
                            "'" => "-",
                        ));
                        $echoallterm .= strtolower($tempname) . " ";
                        $echoterm = $term->name;
                    }
                    $on_draught = join(", ", $draught_links);
                } else {
                    $on_draught = 'Uncategorized';
                }

                // Default Image Size
                $width = $height = '';
                $image_proportions = esc_attr($_REQUEST['image_proportions']);

                switch ($_REQUEST['posts_per_line']) {
                    case '2':
                        $width = '800';
                        $height = '500';
                        break;
                    case '3':
                        $width = '600';
                        $height = '375';
                        break;
                    case '4':
                        $width = '450';
                        $height = '281';
                        break;
                }

                if ($image_proportions == '4_3') {
                    $height = $width * 3 / 4;
                } else if ($image_proportions == 'horizontal') {
                    $height = $width / 1.85;
                } else if ($image_proportions == 'vertical') {
                    $height = $width * 4 / 3;
                } else if ($image_proportions == 'square') {
                    $height = $width;
                }

                $show_likes = gt3_get_theme_option("port_likes");
                $show_share = gt3_get_theme_option("port_share");
                $all_likes = gt3pb_get_option("likes");

                /* 1 Column */
                if ($_REQUEST['posts_per_line'] == "1") {
                    $compile .= '
				<div class="blog_post_preview ' . $echoallterm . ' element">
                    <div class="preview_content">';
                    if (strlen($featured_image[0]) > 0) {
                        $compile .= '<div class="pf_output_container"><a href="' . $linkToTheWork . '" ' . $target . '><img src="' . aq_resize($featured_image[0], 1170, 655, true, true, true) . '" class="featured_image_standalone" alt="'.esc_html__('featured image', 'sohopro').'" /></a></div>';
                    }
                    $compile .= '
                        <div class="preview_top_wrapper">
                            <div class="post_title">
                                <div class="blog_listing_title"><a ' . $target . ' href="' . $linkToTheWork . '">' . esc_html(get_the_title()) . '</a></div>
                            </div>
                            <div class="post_meta">
                                <div class="meta-item">' . esc_html(get_the_time(get_option('date_format'))) . '</div>
                                <div class="meta-item">' . $on_draught . '</div>';
                    if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
                        foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $skillkey => $skillvalue) {
                            $compile .= '
                                                                    <div class="meta-item">' . ((isset($skillvalue['value']) && strlen($skillvalue['value']) > 0) && (isset($skillvalue['icon']) && strlen($skillvalue['icon']) > 0) ? "<i class='" . esc_attr($skillvalue['icon']) . "'></i> " : "") . esc_attr($skillvalue['value']) . '</div>';
                        }
                    }
                    $compile .= '
                                <div class="meta-item"><a href="' . esc_url(get_comments_link()) . '"><i class="fa fa-commenting"><span></span></i> ' . esc_html(get_comments_number(get_the_ID())) . '</a></div>
                            </div>
                        </div>
                        <article class="contentarea">
                        <h6 class="hidden_title">' . esc_html(get_the_title()) . '</h6>
                        ' . ((strlen(get_the_excerpt()) > 0) ? get_the_excerpt() : get_the_content()) . '</article>
                        <div class="post_footer">
                            <div class="post_footer_lp">
                                <a href="' . $linkToTheWork . '" ' . $target . ' class="preview_read_more shortcode_button"><span>' . esc_html__("Read More", "sohopro") . '</span></a>
                            </div>
                            <div class="post_footer_rp">';
                    if (strlen($featured_image[0]) > 0) {
                        $pinterest_img = esc_url($featured_image[0]);
                    } else {
                        if (wp_get_attachment_url(gt3_get_theme_option("logo"))) {
                            $pinterest_img = esc_url(wp_get_attachment_url(gt3_get_theme_option("logo")));
                        } else {
                            $pinterest_img = esc_url(gt3_get_theme_option("logo"));
                        }
                    }
                    if ($show_share == 'show') {
                        $compile .= '
                                <div class="preview_share_wrapper">
                                    <a href="' . esc_js("javascript:void(0)") . '" class="preview_share_toggler"><i class="fa fa fa-share-alt"></i></a>
                                    <div class="preview_share_block">
                                        <a target="_blank" href="' . esc_url('https://www.facebook.com/share.php?u=' . get_permalink()) . '" class="share_facebook"><i class="fa fa-facebook"></i></a>
                                        <a target="_blank" href="' . esc_url('https://twitter.com/intent/tweet?text=' . get_the_title() . '>&amp;url=' . get_permalink()) . '" class="share_twitter"><i class="fa fa-twitter"></i></a>
                                        <a target="_blank" href="' . esc_url('https://plus.google.com/share?url=' . urlencode(get_permalink())) . '" class="share_gplus"><i class="fa fa-google-plus"></i></a>
                                        <a target="_blank" href="' . esc_url('https://pinterest.com/pin/create/button/?url=' . get_permalink() . '>&media=' . $pinterest_img) . '" class="share_pinterest"><i class="fa fa-pinterest-p"></i></a>
                                    </div>
                                </div><!-- Share Wrapper -->
                                ';
                    }
                    if ($show_likes == 'show') {
                        if ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()] == '1')) {
                            $likes_text_label = esc_html__('Like', 'sohopro');
                        } else {
                            $likes_text_label = esc_html__('Likes', 'sohopro');
                        }
                        $compile .= '
                                                        <div class="gb_meta_item post_likes post_likes_add ' . (isset($_COOKIE['like_post' . get_the_ID()]) ? "already_liked" : "") . '" data-attachid="' . esc_attr(get_the_ID()) . '" data-modify="like_post">
                                                            <i class="fa ' . (isset($_COOKIE['like_post' . get_the_ID()]) ? "fa-heart" : "fa-heart-o") . '"></i>
                                                            <span class="portfolio_likes_text">' . ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()] > 0) ? $all_likes[get_the_ID()] : 0) . ' ' . esc_attr($likes_text_label) . '</span>
                                                        </div><!-- .post_likes -->
                                                        ';
                    }
                    $compile .= '
                            </div>
                            <div class="clear"></div>
                        </div><!-- .post_footer -->
                    </div>
                </div>
				';
                } /* 2-4 Columns */
                else {
                    $compile .= '
                <div class="portfolio_columns_' . esc_attr($_REQUEST['posts_per_line']) . ' ' . $echoallterm . ' element">
                    <div class="portfolio_item">
                        <div class="portf_item_inner">
                            <div class="portfolio_overlay"></div>
                            <div class="portf_img">
                                <a ' . $target . ' href="' . $linkToTheWork . '"></a>';
                    if (strlen($featured_image[0]) > 0) {
                        if ($_REQUEST['template'] == "masonry") {
                            $compile .= '<img src="' . aq_resize($featured_image[0], $width, '', true, true, true) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
                        } else {
                            $compile .= '<img src="' . aq_resize($featured_image[0], $width, $height, true, true, true) . '" alt="'.esc_html__('featured image', 'sohopro').'" />';
                        }
                    } else {
                        $compile .= '<img src="' . THEMEROOTURL . '/img/placeholder/800_500.jpg" alt="'.esc_html__('placeholder', 'sohopro').'" />';
                    }
                    $compile .= '
                            </div>';
                    $compile .= '
                            <div class="portf_descr">
                                <h3><a ' . $target . ' href="' . $linkToTheWork . '">' . esc_html(get_the_title()) . '</a></h3>
                                <div class="portf_categories">' . $on_draught . '</div>';
                    if ($show_likes == 'show') {
                        if ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()] == '1')) {
                            $likes_text_label = esc_html__('Like', 'sohopro');
                        } else {
                            $likes_text_label = esc_html__('Likes', 'sohopro');
                        }
                        $compile .= '
                                    <div class="gb_meta_item post_likes post_likes_add ' . (isset($_COOKIE['like_post' . get_the_ID()]) ? "already_liked" : "") . '" data-attachid="' . esc_attr(get_the_ID()) . '" data-modify="like_post">
                                        <i class="fa ' . (isset($_COOKIE['like_post' . get_the_ID()]) ? "fa-heart" : "fa-heart-o") . '"></i>
                                        <span class="portfolio_likes_text">' . ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()] > 0) ? $all_likes[get_the_ID()] : 0) . ' ' . esc_attr($likes_text_label) . '</span>
                                    </div><!-- .post_likes -->
                                    ';
                    }
                    $compile .= '
                            </div>
                        </div>
                    </div>
                </div>
				';
                }

            endwhile;
            wp_reset_postdata();

            echo (($compile));
        }
        die();
    }
}

function add_gt3_code($name, $callback, $filename)  {
    $short = 'code_param';
    if (empty($filename)) {
        call_user_func('vc_add_short' . $short, $name, $callback);
    } else{
        call_user_func('vc_add_short' . $short, $name, $callback, $filename);
    }
}

if (!function_exists('gt3_has_site_icon')) {
    function gt3_has_site_icon() {
        if (function_exists('has_site_icon') && has_site_icon()) {
            ?>
            <link rel="shortcut icon" href="<?php echo aq_resize(esc_url(get_site_icon_url()), "32", "32", true, true, true); ?>"
                  type="image/x-icon">
            <link rel="apple-touch-icon" href="<?php echo aq_resize(esc_url(get_site_icon_url()), "57", "57", true, true, true); ?>">
            <link rel="apple-touch-icon" sizes="72x72"
                  href="<?php echo aq_resize(esc_url(get_site_icon_url()), "72", "72", true, true, true); ?>">
            <link rel="apple-touch-icon" sizes="114x114"
                  href="<?php echo aq_resize(esc_url(get_site_icon_url()), "114", "114", true, true, true); ?>">
            <?php
        } else {
            if (wp_get_attachment_url(gt3_get_theme_option("favicon"))) { ?>
            	<link rel="shortcut icon" href="<?php echo esc_url(wp_get_attachment_url(gt3_get_theme_option("favicon"))); ?>" type="image/png">
            <?php } else { ?>
				<link rel="shortcut icon" href="<?php echo esc_url(gt3_get_theme_option('favicon')); ?>" type="image/png">
			<?php }

			if (wp_get_attachment_url(gt3_get_theme_option("apple_touch_57"))) { ?>
            	<link rel="apple-touch-icon" href="<?php echo esc_url(wp_get_attachment_url(gt3_get_theme_option("apple_touch_57"))); ?>">
            <?php } else { ?>
				<link rel="apple-touch-icon" href="<?php echo esc_url(gt3_get_theme_option('apple_touch_57')); ?>">
			<?php }

			if (wp_get_attachment_url(gt3_get_theme_option("apple_touch_72"))) { ?>
            	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(wp_get_attachment_url(gt3_get_theme_option("apple_touch_72"))); ?>">
            <?php } else { ?>
				<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(gt3_get_theme_option('apple_touch_72')); ?>">
			<?php }

			if (wp_get_attachment_url(gt3_get_theme_option("apple_touch_114"))) { ?>
            	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(wp_get_attachment_url(gt3_get_theme_option("apple_touch_114"))); ?>">
            <?php } else { ?>
				<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(gt3_get_theme_option('apple_touch_114')); ?>">
			<?php }
        }
    }
}

if (class_exists('WooCommerce')) {
    require_once( get_template_directory() . '/woocommerce/wooinit.php' ); // Wocommerce ini file
}
if ( ! function_exists( 'gt3_cart_link_fragment' ) ) {
    function gt3_cart_link_fragment( $fragments ) {
        global $woocommerce;

        ob_start();
        gt3_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }

}
add_filter( 'add_to_cart_fragments', 'gt3_cart_link_fragment' );

if ( ! function_exists( 'gt3_cart_link' ) ) {
    function gt3_cart_link() {
        if (WC()->cart->get_cart_contents_count() == '0') :?>
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'sohopro' ); ?>">
                <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="woo_icon-commerce"></span>
            </a>
        <?php else: ?>
            <a class="cart-contents full" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'sohopro' ); ?>">
                <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="woo_icon-commerce"><span class="count "><?php echo WC()->cart->get_cart_contents_count();?></span></span>
            </a>
        <?php endif;
    }
}

if (class_exists('WooCommerce')) {
    if ( ! function_exists( 'gt3_header_cart' ) ) {
        function gt3_header_cart() {
            ?>
            <ul id="site-header-cart" class="site-header-cart menu">
                <li>
                    <?php gt3_cart_link(); ?>
                </li>
                <li>
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </li>
            </ul>
        <?php
        }
    }
}

if (!function_exists('gt3_get_main_header')) {
    function gt3_get_main_header($gt3_theme_settings) {
		?>
        <header class="main_header">
        	<div class="main_header_inner">
            	<div class="main_header_left_part">
					<?php if (wp_get_attachment_url(gt3_get_theme_option("logo"))) { ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img
                                src="<?php echo esc_url(wp_get_attachment_url(gt3_get_theme_option("logo"))); ?>" alt="<?php echo esc_html__('logo', 'sohopro'); ?>"
                                width="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_width")); ?>"
                                height="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_height")); ?>" class="logo_img"></a>
                        <?php } else { ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img
                                src="<?php echo esc_url(gt3_get_theme_option("logo")); ?>" alt="<?php echo esc_html__('logo', 'sohopro'); ?>"
                                width="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_width")); ?>"
                                height="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_height")); ?>" class="logo_img"></a>
                        <?php }
                    ?>
                    <div class="main_header_socket"></div>
                </div>
                <div class="main_header_right_part">
                	<nav class="main_nav">
						<?php
							if (has_nav_menu('main_menu')) {
								wp_nav_menu(array('container' => false, 'theme_location' => 'main_menu', 'menu_class' => 'menu', 'depth' => '3', 'walker' => new gt3_menu_walker($showtitles = false)));
							}
	                    ?>
                    </nav>

                    <?php if (class_exists('WooCommerce')) gt3_header_cart(); ?>
                    <?php
                        if (gt3_get_theme_option("header_search_icon_status") == 'enabled') {
                            echo '
                            <div class="header_search_form_wrapper">
                                <form name="search_form" method="get" action="'. esc_url(home_url('/')) .'" class="aside_search_form header_search_form">
                                    <input type="text" name="s" placeholder="'. esc_html('Search...', 'sohopro') .'" value="" class="header_search_input">
                                </form>
                                <a href="'. esc_js("javascript:void(0)") .'" class="gt3_search_toggler"></a>
                            </div>
                            ';
                        }
                    ?>

                </div>
            </div>
        </header>
        <?php
	}
}

if (!function_exists('gt3_get_mobile_header')) {
    function gt3_get_mobile_header($gt3_theme_settings) {
		?>
        <header class="mobile_header">
        	<div class="mobile_header_inner">
            	<div class="mobile_header_left_part">
					<?php if (wp_get_attachment_url(gt3_get_theme_option("logo"))) { ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img
                                src="<?php echo esc_url(wp_get_attachment_url(gt3_get_theme_option("logo"))); ?>" alt="<?php echo esc_html__('logo', 'sohopro'); ?>"
                                width="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_width")); ?>"
                                height="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_height")); ?>" class="logo_img"></a>
                        <?php } else { ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img
                                src="<?php echo esc_url(gt3_get_theme_option("logo")); ?>" alt="<?php echo esc_html__('logo', 'sohopro'); ?>"
                                width="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_width")); ?>"
                                height="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_height")); ?>" class="logo_img"></a>
                        <?php }
                    ?>
                </div>
                <div class="mobile_header_right_part">

                    <?php if (class_exists('WooCommerce')) gt3_header_cart(); ?>

                	<a href="<?php echo esc_js("javascript:void(0)"); ?>" class="mobile_menu_toggler">
                        <div class="btn_menu_ico">
                            <span class="btn_menu_line1"></span>
                            <span class="btn_menu_line2"></span>
                            <span class="btn_menu_line3"></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="mobile_menu_wrapper">
                <nav class="mobile_menu_nav container">
                    <?php
                        if (has_nav_menu('main_menu')) {
                            wp_nav_menu(array('container' => false, 'theme_location' => 'main_menu', 'menu_class' => 'menu', 'depth' => '3', 'walker' => new gt3_menu_walker($showtitles = false)));
                        }
                    ?>
                </nav>
            </div>
        </header>
        <?php
	}
}
add_action('wp_head','gt3_register_ajaxurl');
function gt3_register_ajaxurl() {
    ?>
    <script type="text/javascript">
        var gt3_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
    <?php
}
function gt3_my_custom_admin_head()
{
    echo '<script type="text/javascript">var gt3_admin_themeurl = "' . esc_url(get_template_directory_uri()) . '";</script>';
}
add_action('admin_head', 'gt3_my_custom_admin_head');


add_editor_style( 'core/admin/css/gt3_wize_buttons.css' );
function gt3_wize_buttons() {
	if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
		add_filter('mce_external_plugins', 'gt3_wize_buttons_plugin');
		add_filter('mce_buttons', 'gt3_wize_buttons_register_button');
	}
}

add_action('init', 'gt3_wize_buttons');
function gt3_wize_buttons_plugin($plugin_array){
	$plugin_array['gt3_wize_buttons'] = esc_url(get_template_directory_uri()).'/core/admin/js/gt3_wize_buttons.js';
	return $plugin_array;
}

function gt3_wize_buttons_register_button($buttons){
	array_push($buttons, "gt3_blockquote");
	array_push($buttons, "gt3_dropcap");
	return $buttons;
}
function gt3_mce_buttons_2( $buttons ) {
	array_push( $buttons, 'backcolor' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'gt3_mce_buttons_2' );


function toggle_radio_on_off($settingsname, $settingstate, $default_state = "on", $additional_class = "")
{
    if (!isset($checked_state_on)) {
        $checked_state_on = '';
    }
    if (!isset($checked_state_off)) {
        $checked_state_off = '';
    }

    if ($default_state == "on") {
        $checked_state_on = "checked='checked'";
    }
    if ($default_state == "off") {
        $checked_state_off = "checked='checked'";
    }

    if ($settingstate == "on") {
        $checked_state_on = "checked='checked'";
        $checked_state_off = "";
    }
    if ($settingstate == "off") {
        $checked_state_off = "checked='checked'";
        $checked_state_on = "";
    }
    return "
<div class='radio_toggle_cont on_off_style {$additional_class}'>
    <input type='radio' class='checkbox_slide yes_state' {$checked_state_on} value='on' name='{$settingsname}'>
    <input type='radio' class='checkbox_slide no_state' {$checked_state_off} value='off' name='{$settingsname}'>
    <div class='radio_toggle_mirage'></div>
</div>
";
}

#Get unused ID
add_action('wp_ajax_gt3_generate_inserted_media_to_slider', 'gt3_generate_inserted_media_to_slider');
if (!function_exists('gt3_generate_inserted_media_to_slider')) {
    function gt3_generate_inserted_media_to_slider()
    {
        if (current_user_can('manage_options')) {
            $type = esc_attr($_POST['type']); #v1 = gallery, v2 = post_formats
            $itemsIDs = esc_attr($_POST['itemsIDs']);
            $settings_type = esc_attr($_POST['settings_type']);

            $array = explode(',', $itemsIDs);

            if (is_array($array)) {
                foreach ($array as $tempid => $attach_id) {

                    $lastid = gt3pb_get_option("last_slide_id");
                    if ($lastid < 3) {
                        $lastid = 2;
                    }
                    $lastid++;

                    gt3pb_update_option("last_slide_id", $lastid);

                    $featured_image = wp_get_attachment_image_src($attach_id, 'large');

                    #For gallery
                    if ($type == "v1") {
                    echo '
                    <li>
                        <div class="img-item item-with-settings append_animation">
                            <input type="hidden" name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][attach_id]" value="' . $attach_id . '">
                            <input type="hidden" name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][slide_type]" value="image">
                            <div class="img-preview">
                                <img src="' . aq_resize($featured_image[0], "156", "106", true, true, true) . '" alt="'. esc_html__('featured image', 'sohopro').'">
                                <div class="hover-container">
                                    <div class="inter_x"></div>
                                    <div class="inter_drag"></div>
                                    <div class="inter_edit"></div>
                                </div>
                            </div>
                            <div class="edit_popup">
                                <h2>Image Settings</h2>
                                <span class="edit_popup_close"></span>
                                <div class="this-option img-in-slider">
                                    <div class="padding-cont">
                                        <div class="fl w9">
                                            <h4>Title</h4>
                                            <input name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][title][value]" type="text" value="" class="textoption type1">
                                        </div>
                                        <div class="right_block fl w1">
                                            <h4>color</h4>
                                            <div class="color_picker_block">
                                                <span class="sharp">#</span>
                                                <input type="text" value="" name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][title][color]" maxlength="25" class="medium cpicker textoption type1">

                                            </div>
                                        </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="hr_double"></div>
                                <div class="padding-cont">
                                    <div class="fl w9">
                                        <h4>Caption</h4>
                                        <textarea name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][caption][value]" type="text" class="textoption type1 big"></textarea>
                                    </div>
                                    <div class="right_block fl w1">
                                        <h4>color</h4>
                                        <div class="color_picker_block">
                                            <span class="sharp">#</span>
                                            <input type="text" value="" name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][caption][color]" maxlength="25" class="medium cpicker textoption type1">

                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="padding-cont">
                                <input type="button" value="Done" class="done-btn green-btn" name="ignore_this_button">
                                <div class="clear"></div>
                            </div>
                        </div>
                        </div>
                    </li>
                    ';
                    }

                    #For post formats
                    if ($type == "v2") {
                    echo '
                        <div class="img-item style_small">
                            <div class="img-preview">
                                <img src="' . aq_resize($featured_image[0], "62", "62", true, true, true) . '" data-full-url="'.$featured_image[0].'" data-thumb-url="' . aq_resize($featured_image[0], "156", "106", true, true, true) . '" alt="'. esc_html__('featured image', 'sohopro').'" class="previmg">
                                <div class="hover-container"></div>
                                <div class="deldel-container"></div>
                            </div>
                            <input type="hidden" name="pagebuilder[post-formats][images][' . $lastid . '][attach_id]" value="' . $attach_id . '">
                        </div>
                    ';
                    }
                }
            }
        }

        die();
    }
}
if (!function_exists('gt3_get_featured_posts')) {
    function gt3_get_featured_posts($args = array('orderby' => 'rand', 'set_pad' => '30px', 'numberposts' => '3', 'title' => '', 'ignore_sticky_posts' => '1', 'post_category_compile' => '')) {
        extract($args);
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => esc_attr($orderby),
            'posts_per_page' => absint($numberposts),
            'ignore_sticky_posts' => 1,
            'cat' => $post_category_compile
        );
		query_posts($args);
        if (have_posts()) {
            echo '
			<div class="gt3_related_posts_wrapper">';
			if ($title !== '') {
				echo '<h2 class="related_posts_title">' . esc_attr($title) . '</h2>';
			}
			echo '
            	<div class="gt3_related_posts items_'. $numberposts .'" data-pad="'. esc_attr($set_pad).'">
			';
            while (have_posts()) {
                the_post();
                ?>
                <div class="gt3_related_post_item">
	                <div class="gt3_related_post_item_inner" data-pad="<?php echo esc_attr($set_pad); ?>">
                        <a href="<?php the_permalink(); ?>" class="gt3_related_post_link">
                        <?php
                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                            if (strlen($featured_image[0]) > 0) {
                                echo '<img class="gt3_related_image" src="' . esc_url(aq_resize($featured_image[0], '800', '580', true, true, true)) . '" alt="'. esc_html__('featured image', 'sohopro').'" />';
                            } else {
                                echo '<img class="gt3_related_image" src="' . THEMEROOTURL . '/img/placeholder/800_580.jpg" alt="'. esc_html__('placeholder', 'sohopro').'" />';
                            }
                        ?>
                        </a>
                        <div class="gt3_related_content">
                            <a href="<?php the_permalink(); ?>" class="gt3_related_post_link"><h4 class="gt3_related_title"><?php esc_html(the_title()); ?></h4></a>
                            <div class="gt3_related_meta">
                                <div class="meta-item"><span><?php echo esc_html__('Date', 'sohopro') .':&nbsp;&nbsp;</span>' . esc_html(get_the_time(get_option('date_format'))); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            wp_reset_query();

            echo '</div>
			</div>';
        }

	}
}

// Featured portfolio
if (!function_exists('gt3_get_featured_portfolio')) {
    function gt3_get_featured_portfolio($module_title, $post_to_show, $orderby, $post_type) {
        $args = array(
            'post_type' => esc_attr($post_type),
            'post_status' => 'publish',
            'orderby' => esc_attr($orderby),
            'posts_per_page' => esc_attr($post_to_show),
            'ignore_sticky_posts' => 1
        );
        query_posts($args);
        if (have_posts()) {
            echo '
			<div class="gt3_related_posts_wrapper">';
            if ($module_title !== '') {
                echo '<h3 class="related_posts_title">' . esc_html($module_title) . '</h3>';
            }
            echo '<div class="gt3_related_posts items_'. esc_attr($post_to_show) .'">';
            while (have_posts()) {
                the_post();
                ?>
                <div class="gt3_related_post_item">
                    <div class="gt3_related_post_item_inner">
                        <a href="<?php the_permalink(); ?>" class="gt3_related_post_link">
                            <?php
                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                            if (strlen($featured_image[0]) > 0) {
                                echo '<img class="gt3_related_image" src="' . esc_url(aq_resize($featured_image[0], '800', '625', true, true, true)) . '" alt="'. esc_html__('featured image', 'sohopro').'" />';
                            } else {
                                echo '<img class="gt3_related_image" src="' . THEMEROOTURL . '/img/placeholder/800_625.jpg" alt="'. esc_html__('placeholder', 'sohopro').'" />';
                            }
                            ?>
                            <div class="gt3_prelated_overlay"></div>
                            <div class="gt3_related_content">
                                <div class="gt3_related_title"><?php esc_html(the_title()); ?></div>
                                <div class="gt3_related_date">
                                    <?php echo esc_html(get_the_time(get_option('date_format'))); ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
            wp_reset_query();

            echo '</div>
			</div>';
        }
    }
}

function gt3_get_attachment( $attachment_id ) {
	/* Source: http://wpcodelib.com/function/custom/get_attachment/ */
	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}


if (!function_exists('gt3_gallery_array2js')) {
    function gt3_gallery_array2js($grid_array, $gal_id) {
		?>
        <script>
			if (typeof grid_gal_array == "undefined") {
				var grid_gal_array = [];
			}
			if (typeof packery_gal_array == "undefined") {
				var packery_gal_array = [];
			}
			var packery_item = {},
				already_showed = 0;
			if (jQuery('.grid_gallery').size() > 0) {
				var grid_container = jQuery('.grid_gallery'),
					grid_container_wrapper = jQuery('.grid_gallery_wrapper');

				grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'] = {};
				grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'].id = '<?php echo esc_attr($gal_id); ?>';
				grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'].showed = 0;
				grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'].items = [];
				<?php
				$i = 0;
			foreach ($grid_array as $image) {
					?>
				packery_item = {};
				packery_item.slide_type = "<?php echo esc_attr($image['slide_type']); ?>";
				<?php if ($image['slide_type'] == 'video') { ?>
				packery_item.src = "<?php echo esc_attr($image['url']); ?>";
				<?php } ?>
				packery_item.img = "<?php echo esc_url($image['url']); ?>";
				packery_item.thmb = "<?php echo esc_url($image['thmb']); ?>";
				packery_item.title = "<?php echo esc_attr($image['title']); ?>";
				packery_item.caption = "<?php echo esc_attr($image['caption']); ?>";
				packery_item.counter = "<?php echo esc_attr($image['count']); ?>";
				grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'].items.push(packery_item);
			<?php $i++;} ?>
			}
			if (jQuery('.packery_gallery').size() > 0) {
				var packery_container = jQuery('.packery_gallery'),
					packery_container_wrapper = jQuery('.packery_gallery_wrapper');

				packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'] = {};
				packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'].id = '<?php echo esc_attr($gal_id); ?>';
				packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'].showed = 0;
				packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'].items = [];
				<?php
				$i = 0;
			foreach ($grid_array as $image) {
					?>
				packery_item = {};
				packery_item.slide_type = "<?php echo esc_attr($image['slide_type']); ?>";
				<?php if ($image['slide_type'] == 'video') { ?>
				packery_item.src = "<?php echo esc_attr($image['src']); ?>";
				<?php } ?>
				packery_item.img = "<?php echo esc_url($image['url']); ?>";
				packery_item.thmb = "<?php echo esc_url($image['thmb']); ?>";
				packery_item.title = "<?php echo esc_attr($image['title']); ?>";
				packery_item.caption = "<?php echo esc_attr($image['caption']); ?>";
				packery_item.counter = "<?php echo esc_attr($image['count']); ?>";
				packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'].items.push(packery_item);
			<?php $i++;} ?>
			}

		</script>
        <?php
	}
}

#GET ITEMS FOR SLIDER (ADMIN)
function gt3_get_slider_items($slider_type, $array)
{
    if (is_array($array)) {

        $compile = "";

        foreach ($array as $key => $slide) {
            if (!isset($slide['title']['value'])) {
                $slide['title']['value'] = "";
            }
            if (!isset($slide['caption']['value'])) {
                $slide['caption']['value'] = "";
            }

            #fullscreen slider
            if ($slider_type == "fullscreen") {
                $compile .= "<li>";
                #IF SLIDE IS IMAGE
                if ($slide['slide_type'] == "image") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][attach_id]' value='{$slide['attach_id']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][slide_type]' value='image'>
                        <div class='img-preview'>
                            <img alt='' src='" . aq_resize(esc_url(wp_get_attachment_url($slide['attach_id'])), "158", "107", true, true, true) . "'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                        </div>
                        <div class='edit_popup'>
                            <h2>". esc_html__('Image Settings', 'sohopro') ."</h2>
                            <span class='edit_popup_close'></span>
                            <div class='this-option img-in-slider'>
                                <div class='padding-cont'>
                                    <div class='fl w9'>
                                        <h4>" . esc_html__('Title', 'sohopro') . "</h4>
                                        <input name='pagebuilder[sliders][fullscreen][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>" . esc_html__('color', 'sohopro') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont no_caption'>
                                    <div class='fl w9'>
                                        <h4>" . esc_html__('Caption', 'sohopro') . "</h4>
                                        <textarea name='pagebuilder[sliders][fullscreen][slides][{$key}][caption][value]' type='text' class='textoption type1 big'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>" . esc_html__('color', 'sohopro') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='padding-cont'>
                                <input type='button' value='" . esc_html__('Done', 'sohopro') . "' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                #IF SLIDE IS VIDEO
                if ($slide['slide_type'] == "video") {
                    $compile .= "
                    <div class='img-item item-with-settings video-item'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][slide_type]' value='video'>
                        <div class='img-preview'>
                            <img alt='' src='" . get_template_directory_uri() . "/core/admin/img/video_item.png'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                            " . gt3_show_video_preview($slide['src']) . "
                        </div>
                        <div class='edit_popup'>
                            <h2>" . esc_html__('Video settings', 'sohopro') . "</h2>
                            <span class='edit_popup_close'></span>
                            <div class='this-option'>
                                <div class='padding-cont'>
                                    <h4>" . esc_html__('Video URL (YouTube or Vimeo)', 'sohopro') . "</h4>
                                    <input name='pagebuilder[sliders][fullscreen][slides][{$key}][src]' type='text' value='{$slide['src']}' class='textoption type1'>
                                    <div class='example'>
                                        " . esc_html__('Examples:', 'sohopro') . "<br>
                                        Youtube - https://www.youtube.com/watch?v=6v2L2UGZJAM<br>
                                        Vimeo - https://vimeo.com/47989207
                                    </div>
                                </div>
                                <div class='padding-cont gt3_pt0'>
                                    <div class='fl w9 gt3_w601'>
                                        <h4>" . esc_html__('Title and thumbnail', 'sohopro') . "</h4>
                                        <input name='pagebuilder[sliders][fullscreen][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1 gt3_w115'>
                                        <h4>" . esc_html__('color', 'sohopro') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                   <div class='preview_img_video_cont'>
			                            " . gt3_get_field_media_and_attach_id("pagebuilder[sliders][fullscreen][slides][{$key}][attach_id]", $slide['attach_id']) . "
                                        <div class='clear'></div>
		                            </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont no_caption'>
                                    <div class='fl w9 gt3_w601'>
                                        <!--h4>" . esc_html__('Caption', 'sohopro') . "</h4>
                                        <textarea name='pagebuilder[sliders][fullscreen][slides][{$key}][caption][value]' type='text' class='textoption type1 big gt3_h70'>{$slide['caption']['value']}</textarea-->
                                    </div>
                                    <div class='right_block fl w1 gt3_w115'>
                                        <h4>" . esc_html__('color', 'sohopro') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='hr_double'></div>
                            <div class='padding-cont'>
                                <input type='button' value='" . esc_html__('Done', 'sohopro') . "' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                $compile .= "</li>";
            }

            #fullwidth slider
            if ($slider_type == "fullwidth") {
                $compile .= "<li>";
                #IF SLIDE IS IMAGE
                if ($slide['slide_type'] == "image") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][slide_type]' value='image'>
                        <div class='img-preview'>
                            <img alt='' src='" . aq_resize($slide['src'], "158", "107", true, true, true) . "'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                        </div>
                        <div class='edit_popup'>
                            <h2>" . esc_html__('Image Settings', 'sohopro') . "</h2>
                            <span class='edit_popup_close'></span>
                            <div class='this-option img-in-slider'>
                                <div class='padding-cont'>
                                    <div class='fl w9'>
                                        <h4>" . esc_html__('Title', 'sohopro') . "</h4>
                                        <input name='pagebuilder[sliders][fullwidth][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>" . esc_html__('color', 'sohopro') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont no_caption'>
                                    <div class='fl w9'>
                                        <h4>" . esc_html__('Caption', 'sohopro') . "</h4>
                                        <textarea name='pagebuilder[sliders][fullwidth][slides][{$key}][caption][value]' type='text' class='textoption type1 big'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>" . esc_html__('color', 'sohopro') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='padding-cont'>
                                <input type='button' value='" . esc_html__('Done', 'sohopro') . "' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                #IF SLIDE IS VIDEO
                if ($slide['slide_type'] == "video") {
                    $compile .= "
                    <div class='img-item item-with-settings video-item'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][slide_type]' value='video'>
                        <div class='img-preview'>
                            <img alt='' src='" . get_template_directory_uri() . "/core/admin/img/video_item.png'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                            " . gt3_show_video_preview($slide['src']) . "
                        </div>
                        <div class='edit_popup'>
                            <h2>" . esc_html__('Video settings', 'sohopro') . "</h2>
                            <span class='edit_popup_close'></span>
                            <div class='this-option'>
                                <div class='padding-cont'>
                                    <h4>" . esc_html__('Video URL (YouTube or Vimeo)', 'sohopro') . "</h4>
                                    <input name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' type='text' value='{$slide['src']}' class='textoption type1'>
                                    <div class='example'>
                                        " . esc_html__('Examples:', 'sohopro') . "<br>
                                        Youtube - https://www.youtube.com/watch?v=6v2L2UGZJAM<br>
                                        Vimeo - https://vimeo.com/47989207
                                    </div>
                                </div>
                                <div class='padding-cont gt3_pt0'>
                                    <div class='fl w9 gt3_w601'>
                                        <h4>" . esc_html__('Title and thumbnail', 'sohopro') . "</h4>
                                        <input name='pagebuilder[sliders][fullwidth][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1 gt3_w115'>
                                        <h4>" . esc_html__('color', 'sohopro') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                   <div class='preview_img_video_cont'>
                                        <input type='text' value='{$slide['thumbnail']['value']}' id='slide_{$key}_upload' name='pagebuilder[sliders][fullwidth][slides][{$key}][thumbnail][value]' class='textoption type1 gt3_w601 gt3_fl'>
                                        <div class='up_btns'>
                                            <span id='slide_{$key}' class='button btn_upload_image style2 but_slide_{$key}'>" . esc_html__('Upload Image', 'sohopro') . "</span>
                                        </div>
                                        <div class='clear'></div>
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont no_caption'>
                                    <div class='fl w9 gt3_w601'>
                                        <h4>" . esc_html__('Caption', 'sohopro') . "</h4>
                                        <textarea name='pagebuilder[sliders][fullwidth][slides][{$key}][caption][value]' type='text' class='textoption type1 big gt3_h70'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1 gt3_w115'>
                                        <h4>" . esc_html__('color', 'sohopro') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='hr_double'></div>
                            <div class='padding-cont'>
                                <input type='button' value='" . esc_html__('Done', 'sohopro') . "' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                $compile .= "</li>";
            }
        }

        return $compile;
    }

    return false;
}

function gt3_get_media_html($media_array, $style = "small")
{
    if (is_array($media_array) && count($media_array) > 0) {

        $compile = "<span class='available_media_arrow left_arrow'></span><span class='available_media_arrow right_arrow'></span><div class='clear'></div>";

        foreach ($media_array as $media_item) {

            $media_url = $media_item['guid'];
            $media_width = $media_item['width'];
            $media_height = $media_item['height'];
            $attach_id = $media_item['attach_id'];

            #style 1
            if ($style == "small") {
                $compile .= "
                <div class='img-item style_small available_media_item'>
                    <div class='img-preview'>
                        <img class='previmg' alt='' data-thumb-url='" . aq_resize(esc_url($media_url), "158", "107", true, true, true) . "' data-full-url='" . esc_url($media_url) . "' data-attach-id='" . esc_attr($attach_id) . "' src='" . aq_resize(esc_url($media_url), "62", "62", true, true, true) . "'>
                        <div class='hover-container'>
                            <div class='media_size'>" . esc_attr($media_width) . "px<br>x<br>" . esc_attr($media_height) . "px</div>
                        </div>
                    </div>
                </div><!-- .img-item -->
                ";
            }
        }

        return "";
    }

    return false;
}

function gt3_show_video_preview($videourl)
{
    $compile_inner = "";

    #YOUTUBE
    $is_youtube = substr_count($videourl, "youtu");
    if ($is_youtube > 0) {
        $videoid = substr(strstr($videourl, "="), 1);
        $compile_inner = "
            <iframe width=\"395\" height=\"295\" src=\"https://www.youtube.com/embed/" . esc_attr($videoid) . "\" frameborder=\"0\" allowfullscreen></iframe>
        ";
    }

    #VIMEO
    $is_vimeo = substr_count($videourl, "vimeo");
    if ($is_vimeo > 0) {
        $videoid = substr(strstr($videourl, "m/"), 2);
        $compile_inner = "
            <iframe src=\"https://player.vimeo.com/video/" . esc_attr($videoid) . "\" width=\"395\" height=\"295\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        ";
    }

    $compile = "
        <div class='video_preview'>
            <div class='video_inner'>
                {$compile_inner}
            </div>
        </div>
    ";

    return $compile;
}

if (!function_exists('gt3_showGalleryCats')) {
    function gt3_showGalleryCats($post_type_terms = "")
    {
        if (!isset($term_list)) {
            $term_list = '';
        }
        $permalink = get_permalink();
        $args = array('taxonomy' => 'Category', 'include' => $post_type_terms);
        $terms = get_terms('gallerycat', $args);
        $count = count($terms);
        $i = 0;
        $iterm = 1;

        if ($count > 0) {
            $cape_list = '';
            if ($count > 1) {
                $term_list .= '<li class="' . (!isset($_GET['slug']) ? 'selected' : '') . '">';

                $term_list .= '<a href="' . esc_url($permalink) . '" data-option-value="*">' . esc_html__('All', 'sohopro') . '</a>
			</li>';
            }
            $termcount = count($terms);
            if (is_array($terms)) {
                foreach ($terms as $term) {
                    $i++;
                    $permalink = esc_url(add_query_arg("slug", $term->slug, $permalink));
                    $term_list .= '<li ';
                    if (isset($_GET['slug'])) {
                        $getslug = $_GET['slug'];
                    } else {
                        $getslug = '';
                    }

                    if ($count == 1) {
                        $term_list .= 'class="selected"';
                    } else {
                        if (strnatcasecmp($getslug, $term->slug) == 0) $term_list .= 'class="selected"';
                    }

                    $tempname = strtr($term->name, array(
                        ' ' => '-',
                    ));
                    $tempname = strtolower($tempname);
                    $term_list .= '><a data-option-value=".' . esc_attr($tempname) . '" href="' . esc_url($permalink) . '" title="' . esc_html__('View all post filed under', 'sohopro') . ' ">' . $term->name . '</a>
                </li>';
                    if ($count != $i) $term_list .= ' '; else $term_list .= '';

                    $iterm++;
                }
            }
            return '<div class="gt3_albums_filter_block"><div class="gt3_albums_filter_wrapper"><ul class="optionset gt3_albums_filter" data-option-key="filter">' . $term_list . '</ul></div></div>';
        }
    }
}

if (!function_exists('gt3_showPortfolioCats')) {
    function gt3_showPortfolioCats($post_type_terms = "")
    {
        if (!isset($term_list)) {
            $term_list = '';
        }
        $permalink = get_permalink();
        $args = array('taxonomy' => 'Category', 'include' => $post_type_terms);
        $terms = get_terms('portcat', $args);
        $count = count($terms);
        $i = 0;
        $iterm = 1;

        if ($count > 0) {
            $cape_list = '';
            if ($count > 1) {
                $term_list .= '<li class="' . (!isset($_GET['slug']) ? 'selected' : '') . '">';

                $term_list .= '<a href="' . esc_url($permalink) . '" data-option-value="*">' . esc_html__('All', 'sohopro') . '</a>
			</li>';
            }
            $termcount = count($terms);
            if (is_array($terms)) {
                foreach ($terms as $term) {
                    $i++;
                    $permalink = esc_url(add_query_arg("slug", $term->slug, $permalink));
                    $term_list .= '<li ';
                    if (isset($_GET['slug'])) {
                        $getslug = $_GET['slug'];
                    } else {
                        $getslug = '';
                    }

                    if ($count == 1) {
                        $term_list .= 'class="selected"';
                    } else {
                        if (strnatcasecmp($getslug, $term->slug) == 0) $term_list .= 'class="selected"';
                    }

                    $tempname = strtr($term->name, array(
                        ' ' => '-',
                    ));
                    $tempname = strtolower($tempname);
                    $term_list .= '><a data-option-value=".' . esc_attr($tempname) . '" href="' . esc_url($permalink) . '" title="' . esc_html__('View all post filed under', 'sohopro') . ' ">' . $term->name . '</a>
                </li>';
                    if ($count != $i) $term_list .= ' '; else $term_list .= '';

                    $iterm++;
                }
            }
            return '<div class="gt3_portfolio_filter_block"><div class="gt3_portfolio_filter_wrapper"><ul class="optionset gt3_portfolio_filter" data-option-key="filter">' . $term_list . '</ul></div></div>';
        }
    }
}

