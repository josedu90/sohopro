<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register()
    {
        $wp_upload_dir = wp_upload_dir();

        #CSS
        wp_enqueue_style('gt3_default_style', get_bloginfo('stylesheet_url'));
		wp_enqueue_style("gt3_font_awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
		wp_enqueue_style("gt3_photo_modules", get_template_directory_uri() . '/css/photo_modules.css');
		wp_enqueue_style("gt3_theme", get_template_directory_uri() . '/css/theme.css');
		wp_enqueue_style("gt3_vc_modules", get_template_directory_uri() . '/css/vc_modules.css');
		wp_enqueue_style("gt3_responsive", get_template_directory_uri() . '/css/responsive.css');
    	wp_enqueue_style('woo_icon_fonts', get_template_directory_uri() . '/fonts/woocommerce-icon-fonts/woo_icon_fonts.css');

		if (gt3_get_theme_option("color_scheme") == 'light') {
			wp_enqueue_style("gt3_theme_light", get_template_directory_uri() . '/css/light.css');
		}
		
		wp_enqueue_style("gt3_custom", add_query_arg('gt3_show_only_css', '1', esc_url(home_url('/'))));
		if (class_exists('Vc_Manager')) {
			wp_enqueue_style( 'js_composer_front' );
		}
		
        #JS
		wp_enqueue_script('gt3_waypoint_js', get_template_directory_uri() . '/js/waypoint.js', array('jquery'), false, false);
        wp_enqueue_script("jquery");
		wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
		wp_enqueue_script('gt3_mousewheel_js', get_template_directory_uri() . '/js/jquery.mousewheel.js', array(), false, true);		
        wp_enqueue_script('gt3_theme_js', get_template_directory_uri() . '/js/theme.js', array(), false, true);
    }
}
add_action('wp_enqueue_scripts', 'css_js_register');

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register()
{
    $protocol = is_ssl() ? 'https' : 'http';

    #CSS (MAIN)
    wp_enqueue_style('font_awesome', get_template_directory_uri() . '/core/admin/css/font-awesome.min.css');
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/core/admin/css/admin.css');
    wp_enqueue_style("admin_font", "$protocol://fonts.googleapis.com/css?family=Roboto:400,700,300");
	wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('admin-colorbox', get_template_directory_uri() . '/core/admin/css/colorbox.css');
	wp_enqueue_style('selectBox_css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
	wp_enqueue_style('select2', get_template_directory_uri() . '/core/admin/css/select2.min.css');

    #JS (MAIN)
    wp_enqueue_script('admin_js', get_template_directory_uri() . '/core/admin/js/admin.js');
    wp_enqueue_script(array("jquery"));
    wp_enqueue_media();
    wp_enqueue_script('admin-colorbox', get_template_directory_uri() . '/core/admin/js/jquery.colorbox-min.js', array(), false, true);
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('selectBox_js', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');
    wp_enqueue_script('select2', get_template_directory_uri() . '/core/admin/js/select2.min.js', array( 'jquery' ), false, true);
}

#Custom CSS and JS
add_filter('query_vars', 'gt3_register_custom_query_vars');
function gt3_register_custom_query_vars($vars)
{
    $vars[] = 'gt3_show_only_css';
    $vars[] = 'gt3_show_only_js';
    return $vars;
}

add_action('template_redirect', 'gt3_trigger_check');
function gt3_trigger_check()
{
    #Show CSS
    if (intval(get_query_var('gt3_show_only_css')) == 1) {
        header("Content-type: text/css");
	
		$h1_font_size = esc_attr(gt3_get_theme_option("h1_font_size"));
		$h1_line_height = esc_attr(gt3_get_theme_option("h1_line_height"));
		
		$h2_font_size = esc_attr(gt3_get_theme_option("h2_font_size"));
		$h2_line_height = esc_attr(gt3_get_theme_option("h2_line_height"));
		
		$h3_font_size = esc_attr(gt3_get_theme_option("h3_font_size"));
		$h3_line_height = esc_attr(gt3_get_theme_option("h3_line_height"));
		
		$h4_font_size = esc_attr(gt3_get_theme_option("h4_font_size"));
		$h4_line_height = esc_attr(gt3_get_theme_option("h4_line_height"));
		
		$h5_font_size = esc_attr(gt3_get_theme_option("h5_font_size"));
		$h5_line_height = esc_attr(gt3_get_theme_option("h5_line_height"));
		
		$h6_font_size = esc_attr(gt3_get_theme_option("h6_font_size"));
		$h6_line_height = esc_attr(gt3_get_theme_option("h6_line_height"));

		if (wp_get_attachment_url(gt3_get_theme_option("bg_img_404"))) {
			$bg404_url = esc_url(wp_get_attachment_url(gt3_get_theme_option("bg_img_404")));
		} else {
			$bg404_url = esc_url(gt3_get_theme_option("bg_img_404"));
		}
		
		if (wp_get_attachment_url(gt3_get_theme_option("bg_img_pp"))) {
			$bg_pp_url = esc_url(wp_get_attachment_url(gt3_get_theme_option("bg_img_pp")));
		} else {
			$bg_pp_url = esc_url(gt3_get_theme_option("bg_img_pp"));
		}
		
		$sub_menu_font_size = esc_attr(gt3_get_theme_option("sub_menu_font_size"));
		$sub_menu_line_height = substr(gt3_get_theme_option("sub_menu_font_size"), 0, -2);
		$sub_menu_line_height = (int)$sub_menu_line_height + 2;
		$sub_menu_line_height = $sub_menu_line_height . "px";

		$color_scheme = esc_attr(gt3_get_theme_option("color_scheme"));
		
		if ($color_scheme == 'light') {
			$theme_color = esc_attr(gt3_get_theme_option("theme_color_light"));
			$body_bg = esc_attr(gt3_get_theme_option("body_bg_light"));
			$header_bg = esc_attr(gt3_get_theme_option("header_bg_light"));
			$header_color = esc_attr(gt3_get_theme_option("header_color_light"));
			$header_socials = esc_attr(gt3_get_theme_option("header_socials_light"));
			$menu_color = esc_attr(gt3_get_theme_option("menu_color_light"));
			$menu_hover = esc_attr(gt3_get_theme_option("menu_hover_light"));
			$submenu_bg = esc_attr(gt3_get_theme_option("submenu_bg_light"));
			$submenu_color = esc_attr(gt3_get_theme_option("submenu_color_light"));
			$submenu_hover = esc_attr(gt3_get_theme_option("submenu_hover_light"));
			$h1h3_color = esc_attr(gt3_get_theme_option("h1h3_color_light"));
			$h4h6_color = esc_attr(gt3_get_theme_option("h4h6_color_light"));
			$text_color = esc_attr(gt3_get_theme_option("text_color_light"));
			$additional_text_color = esc_attr(gt3_get_theme_option("additional_text_color_light"));
			$links_color = esc_attr(gt3_get_theme_option("links_color_light"));
			$links_color2 = esc_attr(gt3_get_theme_option("links_color2_light"));
			$footer_bg = esc_attr(gt3_get_theme_option("footer_bg_light"));
			$footer_text_color = esc_attr(gt3_get_theme_option("footer_text_color_light"));
			$footer_headings_color = esc_attr(gt3_get_theme_option("footer_headings_color_light"));
		} else {
			$theme_color = esc_attr(gt3_get_theme_option("theme_color"));
			$body_bg = esc_attr(gt3_get_theme_option("body_bg"));
			$header_bg = esc_attr(gt3_get_theme_option("header_bg"));
			$header_color = esc_attr(gt3_get_theme_option("header_color"));
			$header_socials = esc_attr(gt3_get_theme_option("header_socials"));
			$menu_color = esc_attr(gt3_get_theme_option("menu_color"));
			$menu_hover = esc_attr(gt3_get_theme_option("menu_hover"));
			$submenu_bg = esc_attr(gt3_get_theme_option("submenu_bg"));
			$submenu_color = esc_attr(gt3_get_theme_option("submenu_color"));
			$submenu_hover = esc_attr(gt3_get_theme_option("submenu_hover"));
			$h1h3_color = esc_attr(gt3_get_theme_option("h1h3_color"));
			$h4h6_color = esc_attr(gt3_get_theme_option("h4h6_color"));
			$text_color = esc_attr(gt3_get_theme_option("text_color"));
			$additional_text_color = esc_attr(gt3_get_theme_option("additional_text_color"));
			$links_color = esc_attr(gt3_get_theme_option("links_color"));
			$links_color2 = esc_attr(gt3_get_theme_option("links_color2"));
			$footer_bg = esc_attr(gt3_get_theme_option("footer_bg"));
			$footer_text_color = esc_attr(gt3_get_theme_option("footer_text_color"));
			$footer_headings = esc_attr(gt3_get_theme_option("footer_headings_color"));
		}

			
		$gt3_pb_for_css = gt3_get_theme_pagebuilder(get_the_ID());
		echo '
			/* Custom Classes */
			::selection {
				color:#ffffff;
				background:rgba('. gt3_HexToRGB($theme_color) .',0.99);				
			}
			::-moz-selection {
				color:#ffffff;
				background:'. $theme_color .';
				opacity:0;
			}
			body {
				background:'. $body_bg .';
			}

			h1, h1 a, h1 span {
				font-size:' . $h1_font_size . ';
				line-height:' . $h1_line_height . ';
				font-weight:'. esc_attr(gt3_get_theme_option("headings_font_weight")) .';
			}			
			h2, h2 a, h2 span {
				font-size:' . $h2_font_size . ';
				line-height:' . $h2_line_height . ';
				font-weight:'. esc_attr(gt3_get_theme_option("headings_font_weight")) .';
			}
			h3, h3 a, h3 span {
				font-size:' . $h3_font_size . ';
				line-height:' . $h3_line_height . ';
				font-weight:'. esc_attr(gt3_get_theme_option("headings_font_weight")) .';
			}
			h4, h4 a, h4 span {
				font-size:' . $h4_font_size . ';
				line-height:' . $h4_line_height . ';
				font-weight:'. esc_attr(gt3_get_theme_option("headings_font_weight")) .';
			}
			h5, h5 a, h5 span {
				font-size:' . $h5_font_size . ';
				line-height:' . $h5_line_height . ';
				font-weight:'. esc_attr(gt3_get_theme_option("headings_font_weight")) .';
			}
			h6, h6 a, h6 span {
				font-size:' . $h6_font_size . ';
				line-height:' . $h6_line_height . ';
				font-weight:'. esc_attr(gt3_get_theme_option("headings_font_weight")) .';
			}
			h1, h2, h3,
			h1 span, h2 span, h3 span,
			h1 small, h2 small, h3 small,
			h1 a, h2 a, h3 a,
			.port_simple_categs,
			.port_simple_top_categs {
				color:'. $h1h3_color .';
				font-family:' . esc_attr(gt3_get_theme_option("headings_font")) . ';
				-moz-osx-font-smoothing:grayscale;
				-webkit-font-smoothing:antialiased;				
			}
			h4, h5, h6,
			h4 span, h5 span, h6 span,
			h4 small, h5 small, h6 small,
			h4 a, h5 a, h6 a {
				color:'. $h4h6_color .';
				font-family:' . esc_attr(gt3_get_theme_option("headings_font")) . ';
				-moz-osx-font-smoothing:grayscale;
				-webkit-font-smoothing:antialiased;			
			}

			* {
				font-family:' . esc_attr(gt3_get_theme_option("main_font")) . ';
			}	
			p, td, div {
				color:' . $text_color . ';
				font-size: '. esc_attr(gt3_get_theme_option("content_font_size")) . ';
				font-weight:' . esc_attr(gt3_get_theme_option("content_font_weight")) . ';
				line-height:' . esc_attr(gt3_get_theme_option("content_line_height")) . ';
			}
			input, textarea {
				font-weight:' . esc_attr(gt3_get_theme_option("content_font_weight")) . ';
			}
			p {
				margin:0 0 ' . esc_attr(gt3_get_theme_option("p_bottom_margin")) . ' 0
			}
			a {
				color:'. $links_color .';
			}
			a:hover {
				color:'. $links_color2 .';
			}

			.big_arrow_wrapper span,
			.big_arrow_wrapper span:after,
			.big_arrow_wrapper span:before {
				background:'. $theme_color .';
			}

			input[type="button"],
			input[type="reset"],
			input[type="submit"] {
				color:'. $additional_text_color .';
				background:'. $theme_color .';
			}
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover {
				color:'. $theme_color .';
				background:'. $additional_text_color .';
			}

			select,
			input[type="date"],
			input[type="tel"],
			input[type="text"],
			input[type="email"],
			input[type="password"],
			textarea {
				color:'. $text_color .';
			}

			input[type="text"]::-webkit-input-placeholder,
			input[type="email"]::-webkit-input-placeholder,
			input[type="password"]::-webkit-input-placeholder,
			textarea::-webkit-input-placeholder {
				color:'. $text_color .';
			}
			input[type="text"]::-moz-placeholder {
				color:'. $text_color .';
			}
			input[type="email"]::-moz-placeholder {
				color:'. $text_color .';
			}
			input[type="password"]::-moz-placeholder {
				color:'. $text_color .';
			}
			textarea::-moz-placeholder {
				color:'. $text_color .';
			}
			
			/* Header */
			header.main_header {
				background:'. $header_bg .';
			}
			.main_header_left_part {
				width:'. esc_attr(gt3_get_theme_option("header_logo_standart_width")) .'px;
			}
			.main_header_right_part {
				width:calc(100% - '. esc_attr(gt3_get_theme_option("header_logo_standart_width")) .'px);
			}
			
			header.main_header div,
			header.main_header p,
			header.main_header a {
				color:'. $header_color .';
			}
			header.main_header a:hover {
				color:'. $theme_color .';
			}
			
			header.main_header nav.main_nav > ul.menu > li > a {
				font-size:'. esc_attr(gt3_get_theme_option("main_menu_font_size")) . ';
				line-height:'. esc_attr(gt3_get_theme_option("main_menu_font_size")) . ';
				font-weight:'. esc_attr(gt3_get_theme_option("main_menu_font_weight")) . ';
			}
			header.main_header nav.main_nav > ul.menu > li > a,
			header.main_header nav.main_nav > ul.menu > li > a:hover {
				color:'. $menu_color .';
			}
				
			header.main_header nav.main_nav > ul.menu > li:before {
				background:'. $menu_hover .';
			}
			header.main_header ul.sub-menu li,
			.header_search_form,
			.site-header-cart .widget_shopping_cart,
			.woocommerce select,
			.woocommerce .gt3_top_sidebar_products,
			.gt3_top_sidebar_products .sidebar:after{
				background:'. $submenu_bg .';
			}
			header.main_header ul.menu > li > ul.sub-menu > li:first-child:before,
			.site-header-cart .widget_shopping_cart:before,
			.header_search_form:before {
				border-color: transparent transparent '. $submenu_bg .' transparent;
			}
			header.main_header ul.sub-menu a {
				font-size:'. $sub_menu_font_size .';
				line-height:'. $sub_menu_line_height .';
				color:'. $submenu_color .';
			}

			nav.main_nav ul.sub-menu > li.current-menu-ancestor > a,
			nav.main_nav ul.sub-menu > li.current-menu-item > a,
			nav.main_nav ul.sub-menu > li.current-menu-parent > a,
			nav.main_nav ul.sub-menu > li:hover > a {
				color:'. $submenu_hover .';
			}
			.main_header ul.sub-menu > li.menu-item-has-children > a:after {
				border-color: transparent transparent transparent '. $submenu_color .';
			}
			.main_header ul.sub-menu > li.menu-item-has-children:hover > a:after {
				border-color: transparent transparent transparent '. $submenu_hover .';
			}
			.main_header ul.sub-menu > li.menu-item-has-children > a:before {
				border-color: transparent transparent transparent '. $submenu_bg .';
			}
			.mobile_menu_wrapper {
				background:'. $submenu_bg .';
			}
			.mobile_menu_wrapper ul > li > a {
				color:'. $submenu_color .';
			}
			.mobile_menu_wrapper ul.menu > li > a {
				color:'. $submenu_hover .';
			}

			.mobile_menu_wrapper ul > li.current-menu-ancestor > a,
			.mobile_menu_wrapper ul > li.current-menu-item > a,
			.mobile_menu_wrapper ul > li.current-menu-parent > a {
				color:'. $theme_color .';
			}
			
			/* Content Borders */
			.gt3_left_bar,
			.gt3_right_bar {
				background:'. $body_bg .';
			}
			.gt3_socials_inner ul li a {
				color:'. $header_socials .';
			}
						
			/* Footer Area */
			.footer_area,
			.blog_post_preview.audio_post,
			.blog_post_preview.quote_post,
			.blog_post_preview.link_post,
			.blog_post_preview.standard_post.no-post-thumbnail,
			.single_content .pf_tag_quote,
			.single_content .pf_tag_audio,
			.single_content .pf_tag_link,
			.blog_post_preview.no_image .preview_content {
				background:'. $footer_bg .';
			}
			.footer_area div,
			.footer_area td,
			.footer_area p {
				color:'. $footer_text_color .';
			}
			.footer_area h1,
			.footer_area h2,
			.footer_area h3,
			.footer_area h4,
			.footer_area h5,
			.footer_area h6 {
				color:'. $footer_text_color .';
			}
			
			/* Blog Listing */
			.blog_listing_title a:hover {
				color:'. $theme_color .';
			}
			.meta-item {
				color:'. $additional_text_color .';
			}
			.meta-item a {
				color:'. $text_color .';
			}
			.meta-item a:hover {
				color:'. $links_color .';
			}
			.pf_link_wrapper .pf_link_text:before {
				color:'. $theme_color .';
			}
			.pf_link {
				color:'. $text_color .';
			}
			.pf_link:hover {
				color:'. $theme_color .';
			}
			.pf_quote_text,
			.pf_link_text {
				color:'. $text_color .';
			}
			.pagerblock li a.prev_page span,
			.pagerblock li a.next_page span,
			.pagerblock li a.prev_page span:after,
			.pagerblock li a.next_page span:after,
			.pagerblock li a.prev_page span:before,
			.pagerblock li a.next_page span:before {
				background:'. $theme_color .';
			}
			.pagerblock li a {
				color:'. $text_color .';
			}
			.pagerblock li.current a {
				color:'. $additional_text_color .';
				border-color:'. $additional_text_color .';
			}
			.pagerblock li a:hover {
				color:'. $theme_color .';
			}

			.nivo-directionNav a span,
			.nivo-directionNav a span:before,
			.nivo-directionNav a span:after {
				background:'. $theme_color .';
			}
			.nivo-directionNav a:hover span,
			.nivo-directionNav a:hover span:before,
			.nivo-directionNav a:hover span:after {
				background:'. $additional_text_color .';
			}
			.nivo-directionNav a {
				background:'. $additional_text_color .';
			}
			.nivo-directionNav a:hover {
				background:'. $theme_color .';
			}

			.fw_pf_slide_prev span,
			.fw_pf_slide_next span,
			.fw_pf_slide_prev span:before,
			.fw_pf_slide_next span:before,
			.fw_pf_slide_prev span:after,
			.fw_pf_slide_next span:after {
				background:'. $theme_color .';
			}

			.fw_pf_slide_prev,
			.fw_pf_slide_next,
			.fw_pf_slide_prev:hover span,
			.fw_pf_slide_next:hover span,
			.fw_pf_slide_prev:hover span:before,
			.fw_pf_slide_next:hover span:before,
			.fw_pf_slide_prev:hover span:after,
			.fw_pf_slide_next:hover span:after {
				background:'. $additional_text_color .';
			}
			.fw_pf_slide_prev:hover,
			.fw_pf_slide_next:hover {
				background:'. $theme_color .';
			}
			/* Related Posts */
			h4.gt3_related_title {
				color:'. $h1h3_color .';
			}
			h4.gt3_related_title:hover {
				color:'. $theme_color .';
			}
			.meta-item span {
				color:'. $additional_text_color .';
			}
			.meta-item,
			.meta-item a {
				color:'. $text_color .';
			}
			.meta-item a:hover {
				color:'. $theme_color .';
			}
			.single_tags a {
				color:'. $text_color .';
			}
			.single_tags a:hover {
				color:'. $additional_text_color .';
				background:'. $theme_color .';
			}
			.spg_rp .post_likes_add i {
				color:'. $theme_color .';
			}
			.single_post_share_block a {
				color:'. $text_color .';
			}
			.single_post_share_block a:before {
				background:'. $text_color .';
			}
			.single_prev_next_posts a {
				color:'. $additional_text_color .';
			}
			.single_prev_next_posts a:hover {
				color:'. $theme_color .';
			}
			
			/* Comments */
			h4.author,
			h4.author span,
			h4.author a {
				color:'. $h1h3_color .';
			}
			.comment_top_line .comment-reply-link {
				color:'. $text_color .';
			}
			.comment_top_line .comment-reply-link:before {
				background:'. $text_color .';
			}
			.comment_top_line .comment-reply-link:hover {
				color:'. $additional_text_color .';
			}
			.comment_top_line .comment-reply-link:hover:before {
				background:'. $additional_text_color .';
			}
			#reply-title {
				font-size:'. $h2_font_size .';
				line-height:'. $h2_line_height .';
			}
			#respond {
				background:'. $body_bg .';
			}

			.gt3_pp_page_bg {
				background-image:url('. $bg_pp_url .');
			}

			/* Widgets */
			.sidepanel select,
			.sidepanel input[type="text"],
			.sidepanel input[type="email"],
			.sidepanel input[type="password"],
			.sidepanel textarea,
			.wrapper_404 input[type="text"],
			.shortcode_subscribe input[type="text"],
			.shortcode_subscribe input[type="email"],
			.shortcode_subscribe input[type="password"] {
				color:' . $text_color . ';
				font-weight:' . esc_attr(gt3_get_theme_option("content_font_weight")) . ';
				line-height:' . esc_attr(gt3_get_theme_option("content_line_height")) . ';
			}
			.widget_product_categories ul > li:before,
			.widget_nav_menu ul > li:before,
			.widget_archive ul > li:before,
			.widget_pages ul > li:before,
			.widget_categories ul > li:before,
			.widget_recent_entries ul > li:before,
			.widget_meta ul > li:before,
			.widget_recent_comments ul > li:before {
				background: '. $h1h3_color .';
			}
			.widget_product_categories ul > li.active_list_item > a,
			.widget_product_categories ul > li.active_list_item > span,
			.widget_nav_menu ul > li.active_list_item > a,
			.widget_archive ul > li.active_list_item > a,
			.widget_pages ul > li.active_list_item > a,
			.widget_categories ul > li.active_list_item > a,
			.widget_categories ul > li.current-cat > a,
			.widget_recent_entries ul > li.active_list_item > a,
			.widget_meta ul > li.active_list_item > a,
			.active_list_item:hover > a,
			.widget_categories ul > li.current-cat,
			.recent_posts_title,
			.recent_posts_info span {
				color: '. $h1h3_color .';
			}
			.recent_posts_title:hover {
				color: ' . $theme_color .';
			}
			.widget_recent_comments #recentcomments * {
				color:' . $text_color . ';
			}
			.widget_recent_comments #recentcomments a {
				color:' . $theme_color . ';
			}
			.widget_recent_comments #recentcomments a:hover {
				color:' . $h1h3_color . ';
			}
			.gt3_services_box_content {
				background: '.$theme_color.';
				font-size:'. esc_attr(gt3_get_theme_option("content_font_size")) . ';
				line-height:' . esc_attr(gt3_get_theme_option("content_line_height")) . ';
				font-family:' . esc_attr(gt3_get_theme_option("main_font")) . ';
				font-weight:' . esc_attr(gt3_get_theme_option("content_font_weight")) . ';
			}
			.gt3_services_img_bg {
				background-color: '.$theme_color.';
			}
			.fs_bullets .bullet_slide.current_bullet,
			.slick-dots li.slick-active button {
				background: '.$theme_color.';
			}

			.vc_tta-style-gt3_standard .vc_tta-title-text:after,
			.vc_toggle_gt3_standard .vc_toggle_title h4:after {
				background: '.$theme_color.';
			}

			.vc_general.vc_tta.vc_tta-accordion.vc_tta-style-gt3_alternative .vc_active .vc_tta-panel-heading,
			.vc_general.vc_tta.vc_tta-accordion.vc_tta-style-gt3_alternative .vc_tta-panel-heading:hover,
			.vc_toggle.vc_toggle_gt3_alternative.vc_toggle_active .vc_toggle_title,
			.vc_toggle.vc_toggle_gt3_alternative .vc_toggle_title:hover {
				background: '.$theme_color.' !important;
				border-color: '.$theme_color.' !important;
			}
			
			/* Photo Modules */
			.thumbs_grid_gallery .thumbs_gallery_wrapper:before,
			.thumbs_grid_gallery .thumbs_gallery_wrapper:after,
			.stripe_gallery_wrapper .stripe_slide .stripe_overlay:before,
			.stripe_gallery_wrapper .stripe_slide .stripe_overlay:after,
			.gt3_stripe .gt3_plus_icon:before,
			.gt3_stripe .gt3_plus_icon:after,
			.gt3_blog_grid .blog_grid_item .grid_overlay:before,
			.gt3_blog_grid .blog_grid_item .grid_overlay:after,
			.gt3_portfolio_grid .portfolio_grid_item .grid_overlay:before,
			.gt3_portfolio_grid .portfolio_grid_item .grid_overlay:after,
			.packery_portfolio .packery-item .grid_overlay:before,
			.packery_portfolio .packery-item .grid_overlay:after,
			.gt3_albums_grid .albums_grid_item .grid_overlay:before,
			.gt3_albums_grid .albums_grid_item .grid_overlay:after,
			.packery_overlay:before,
			.packery_overlay:after,
			.grid_gallery_wrapper .grid-item .grid_overlay:before,
			.grid_gallery_wrapper .grid-item .grid_overlay:after {
				background:'. $theme_color .';
			}
			.portfolio_grid_title_link:hover .portfolio_grid_title {
				color:'. $theme_color .';
			}
			.portfolio_grid_item.title_layout_always .portfolio_grid_meta {
				color:'. $text_color .';
			}
			.title_always.stripe_gallery_wrapper .stripe_slide .stripe_title {
				color:'. $text_color .';
			}
			.title_always.stripe_gallery_wrapper .stripe_slide.current-slide .stripe_title {
				color:'. $additional_text_color .';
			}
			.title_always.stripe_gallery_wrapper .stripe_slide .stripe_title_wrapper {
				background:'. $body_bg .';
			}
			.gt3_soho_button {
				background:'. $theme_color .';
			}
			.gt3_soho_button:hover {
				color:'. $theme_color .';
				background:'. $additional_text_color .';
			}
			.portfolio_grid_content .portfolio_grid_meta,
			.albums_grid_content .albums_grid_meta {
				color:'. $theme_color .';
			}
			.gt3_portfolio_filter_wrapper li a,
			.gt3_albums_filter_wrapper li a {
				color:'. $additional_text_color .'
			}
			.gt3_portfolio_filter_wrapper li a:hover,
			.gt3_portfolio_filter_wrapper li.selected a,
			.gt3_albums_filter_wrapper li a:hover,
			.gt3_albums_filter_wrapper li.selected a {
				color:'. $theme_color .';
			}
			.gt3_stripe:hover .gt3_stripe_content .gts_stripe_descr {
				color:'. $theme_color .';
			}
			.sohopro_slider_button {
				background:'. $additional_text_color .';
			}
			.sohopro_slider_button .sohopro_slider_button_inner span,
			.sohopro_slider_button .sohopro_slider_button_inner span:after,
			.sohopro_slider_button .sohopro_slider_button_inner span:before {
				background:'. $theme_color .';
			}

			.sohopro_slider_button:hover {
				background:'. $theme_color .';
			}
			.sohopro_slider_button:hover .sohopro_slider_button_inner span,
			.sohopro_slider_button:hover .sohopro_slider_button_inner span:after,
			.sohopro_slider_button:hover .sohopro_slider_button_inner span:before {
				background:'. $additional_text_color .';
			}
			
			.fs_state_play.fs_play_pause:before,
			.fs_state_play.fs_play_pause:after {
				border-color:'. $additional_text_color .';
			}
			.fs_state_play.fs_play_pause:hover:before,
			.fs_state_play.fs_play_pause:hover:after {
				border-color:'. $theme_color .';
			}
			.fs_play_pause:before {
				border-color: transparent transparent transparent '. $additional_text_color .';
			}
			.fs_play_pause:hover:before {
				border-color: transparent transparent transparent '. $theme_color .';
			}
			.fs_slider_controls i {
				color:'. $additional_text_color .';
			}
			.fs_slider_controls:hover i {
				color:'. $theme_color .';
			}
			.vc_row .vc_progress_bar .vc_single_bar .vc_label,
			.vc_row .vc_progress_bar .vc_single_bar .vc_label .vc_label_units {
				font-family:' . esc_attr(gt3_get_theme_option("main_font")) . ';
			}
			.vc_row .vc_progress_bar .vc_single_bar .vc_bar {
				background:'. $theme_color .';
			}
			.vc_row .vc_progress_bar .vc_single_bar .vc_label .vc_label_units,
			.vc_row .vc_progress_bar .vc_single_bar .vc_bar:after {
				color: ' . $text_color . ';
			}
			.vc_row .vc_progress_bar .vc_single_bar .vc_label {
				color: ' . $h1h3_color . ';
			}
			.gt3_meta_values_wrapper .gt3_meta_values_item {
				color:'. $text_color .';
			}
			.gt3_meta_values_wrapper .gt3_meta_values_item span {
				color:'. $additional_text_color .';
			}

			body .vc_pie_chart .vc_pie_chart_value {
				font-family:' . esc_attr(gt3_get_theme_option("main_font")) . ';
				font-weight:' . esc_attr(gt3_get_theme_option("content_font_weight")) . ';
				color: ' . $h1h3_color . ';
			}
			body .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab > a {
				color:' . $text_color . ';
			}
			body .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab > a {
				border-color: '. $body_bg .';
			}
			body .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab.vc_active:after,
			body .vc_tta.vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab.vc_active:after,
			body .vc_tta.vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab.vc_active:after {
				background: '. $body_bg .';
			}
			.vc_tta.vc_general.vc_tta-tabs .vc_tta-tab .vc_tta-title-text:before {
				background:'. $theme_color .';
			}
			.price_content span {
				color:'. $theme_color .';
			}
			.gt3_module_button a,
			.shortcode_button,
			.gt3_btn_reverse .shortcode_button:hover,
			.price_item.most_popular .item_cost_wrapper {
				background:'. $theme_color .';
			}
			.gt3_module_button a:hover,
			.shortcode_button:hover,
			.gt3_btn_reverse .shortcode_button,
			.team_position {
				color: '. $theme_color .';
			}
			.module_testimonial.type1 .testimonials_title {
				color:'. $additional_text_color .';
			}
			.gt3_team_info ul li a {
				color:' . $text_color . ';
			}
			.gt3_team_info ul li a:hover {
				color:' . $theme_color . ';
			}
			
			.port_prev_next_posts a .port_prev_post_title,
			.port_prev_next_posts a .port_next_post_title,
			.gt3_sharing_module a {
				color:'. $text_color .';
			}
			.port_prev_next_posts a:hover .port_prev_post_title,
			.port_prev_next_posts a:hover .port_next_post_title {
				color:'. $theme_color .';
			}
			.port_back2grid span {
				border:1px solid '. $theme_color .';
			}
			.port_back2grid:hover span {
				border:1px solid '. $additional_text_color .';
			}
			.port_prev_next_posts a:hover .big_arrow_wrapper span,
			.port_prev_next_posts a:hover .big_arrow_wrapper span:before,
			.port_prev_next_posts a:hover .big_arrow_wrapper span:after {
				background:'. $additional_text_color .';
			}

			/* 404 */
			.gt3_404_page_bg {
				background-image:url('. $bg404_url .');
			}
			.wrapper_404 .title_404,
			.count_title,
			.countdown-amount,
			.countdown-period,
			.gt3_contact_label {
				color:'. $h1h3_color .';
			}
			.gt3_meta_values_item {
				font-weight:' . esc_attr(gt3_get_theme_option("content_font_weight")) . ';
			}
			a.widget_social  {
				color:'. $footer_text_color .';
			}
			a.widget_social:hover,
			.comment_top_line .author a:hover {
				color:'. $theme_color .';
			}
			.tagcloud a:hover {
				background:'. $theme_color .';
			}
			.btn_menu_ico span {
				background:'. $h1h3_color .';
			}
			@media only screen and (max-width: 760px) {
				#wp'.'adminbar {top:-46px!important;}
			}
			';
		if (class_exists('WooCommerce')) {
			echo '
				.woocommerce-page div.woocommerce_container > ul.products > li.product{
					width:' . round( 100 / esc_attr(gt3_get_theme_option("shop_items_per_line")), 2 ) . '%;
				}
				div.product .summary del, 
				div.product .summary del .amount,
				div.product .summary ins, 
				div.product .summary ins .amount,
				.site-header-cart .cart-contents.full,
				.woocommerce div.product p.price,
				.woocommerce div.product span.price,
				.woocommerce ul.products li.product .price,
				.single-product .product_meta > span a:hover,
				.woocommerce div.product .woocommerce-tabs .panel li,
				.woocommerce ul.cart_list li:hover a:not(.remove),
				.woocommerce ul.product_list_widget li:hover a:not(.remove),
				.woocommerce ul.cart_list li img, .woocommerce ul.product_list_widget li ins,
				.site-header-cart .woo_icon-commerce .count,
				.main_wrapper .gt3_product_list_nav li a:hover .nav_text,
				.widget_layered_nav ul li.chosen > a,
				.widget_layered_nav ul li.active_list_item > a,
				.widget_product_categories ul.product-categories ul > li.active_list_item > a {
					color:'. $theme_color .'!important;
				}
				
				.woocommerce a.button,
				.woocommerce button.button,
				.woocommerce input.button,
				.woocommerce #respond input#submit,
				.woocommerce #content input.button,
				.woocommerce a.edit,
				.woocommerce #commentform #submit,
				.woocommerce-page input.button,
				.woocommerce .wrapper input[type="reset"],
				.woocommerce .wrapper input[type="submit"],
				.woocommerce form.login input.button,
				.woocommerce form.lost_reset_password input.button,
				.return-to-shop a.button,
				#payment input.button,
				.woocommerce p input.button,
				.woocommerce p button.button,
				.woocommerce .checkout_coupon p input.button,
				.woocommerce .checkout_coupon p button.button,
				.woocommerce .woocommerce-shipping-calculator p button.button,
				.woocommerce #respond input#submit.alt,
				.woocommerce a.button.alt,
				.woocommerce button.button.alt,
				.woocommerce input.button.alt,
				.woocommerce #review_form #respond .form-submit input,
				.woocommerce .widget_price_filter .price_slider_amount .button,
				.woocommerce ul.products li.product .button:before,
				.woocommerce ul.products li.product .button:hover,
				.woocommerce ul.products li.product .add_to_wishlist:before,
				.woocommerce ul.products li.product .add_to_wishlist:hover,
				.woocommerce ul.products li.product .yith-wcwl-wishlistaddedbrowse a:before,
				.woocommerce ul.products li.product .yith-wcwl-wishlistaddedbrowse a:hover,
				.woocommerce ul.products li.product .yith-wcwl-wishlistexistsbrowse a:before,
				.woocommerce ul.products li.product .yith-wcwl-wishlistexistsbrowse a:hover,
				.gt3_woocommerce_top_filter_button span {
					color:'. $additional_text_color .'!important;
					background:'. $theme_color .'!important;
				}

				.woocommerce a.button:hover,
				.woocommerce button.button:hover,
				.woocommerce input.button:hover,
				.woocommerce #respond input#submit:hover,
				.woocommerce #content input.button:hover,
				.woocommerce a.edit:hover,
				.woocommerce #commentform #submit:hover,
				.woocommerce-page input.button:hover,
				.woocommerce .wrapper input[type="reset"]:hover,
				.woocommerce .wrapper input[type="submit"]:hover,
				.woocommerce form.login input.button:hover,
				.woocommerce form.lost_reset_password input.button:hover,
				.return-to-shop a.button:hover,
				#payment input.button:hover,
				.woocommerce p input.button:hover,
				.woocommerce p button.button:hover,
				.woocommerce .checkout_coupon p input.button:hover,
				.woocommerce .checkout_coupon p button.button:hover,
				.woocommerce .woocommerce-shipping-calculator p button.button:hover,
				.woocommerce #respond input#submit.alt:hover,
				.woocommerce a.button.alt:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce input.button.alt:hover,
				.woocommerce #review_form #respond .form-submit input:hover,
				.woocommerce .widget_price_filter .price_slider_amount .button:hover,
				.woocommerce ul.products li.product .button:hover:before,
				.woocommerce ul.products li.product .add_to_wishlist:hover:before,
				.woocommerce ul.products li.product .yith-wcwl-wishlistaddedbrowse a:hover:before,
				.woocommerce ul.products li.product .yith-wcwl-wishlistexistsbrowse a:hover:before {
					background:'. $additional_text_color .'!important;
					color:'. $theme_color .'!important;
				}
				.woocommerce #respond input#submit.alt.disabled,
				.woocommerce #respond input#submit.alt.disabled:hover,
				.woocommerce #respond input#submit.alt:disabled,
				.woocommerce #respond input#submit.alt:disabled:hover,
				.woocommerce #respond input#submit.alt:disabled[disabled],
				.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
				.woocommerce a.button.alt.disabled,
				.woocommerce a.button.alt.disabled:hover,
				.woocommerce a.button.alt:disabled,
				.woocommerce a.button.alt:disabled:hover,
				.woocommerce a.button.alt:disabled[disabled],
				.woocommerce a.button.alt:disabled[disabled]:hover,
				.woocommerce button.button.alt.disabled,
				.woocommerce button.button.alt.disabled:hover,
				.woocommerce button.button.alt:disabled,
				.woocommerce button.button.alt:disabled:hover,
				.woocommerce button.button.alt:disabled[disabled],
				.woocommerce button.button.alt:disabled[disabled]:hover,
				.woocommerce input.button.alt.disabled,
				.woocommerce input.button.alt.disabled:hover,
				.woocommerce input.button.alt:disabled,
				.woocommerce input.button.alt:disabled:hover,
				.woocommerce input.button.alt:disabled[disabled],
				.woocommerce input.button.alt:disabled[disabled]:hover{
					background:'. $theme_color .'!important;
					color:'. $additional_text_color .'!important;
				}
				.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover span:before,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active span:before{
					background:'. $theme_color .'!important;
				}
				.woocommerce .quantity input.qty,
				.woocommerce #content .quantity input.qty,
				.woocommerce div.product .woocommerce-tabs ul.tabs li::after {
					background:'. $body_bg .';
				}
				.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active{
					border-right-color:'. $body_bg .';
				}
				
				.woocommerce .product_meta .sku_wrapper,
				.woocommerce .posted_in,
				.woocommerce .tagged_as,
				.single-product .product_meta > span,
				.woocommerce div.product form.cart .variations label,
				.woocommerce .quantity input.qty[type="number"],
				.woocommerce .quantity:before,
				.woocommerce .quantity:after,
				.woocommerce span.onsale,
				.woocommerce div.product span.out-of-stock,
				.woocommerce .widget_price_filter .price_slider_amount .price_label span,
				.woocommerce ul.products li.product a h6,
				.woocommerce ul.cart_list li a,
				.woocommerce ul.product_list_widget li a,
				.woocommerce .widget_shopping_cart .total, 
				.woocommerce.widget_shopping_cart .total,
				.woocommerce ul.cart_list li dd p,
				.woocommerce ul.cart_list li dl dt,
				.woocommerce ul.product_list_widget li dl dt,
				.widget_layered_nav ul li *,
				.widget_product_categories ul ul *{
					color:'. $additional_text_color .';
				}
				.site-header-cart .woo_icon-commerce .count,
				.woocommerce div.product div.images .flex-control-thumbs li{
					background:'. $additional_text_color .';
				}
				.woocommerce .product_meta .sku_wrapper span,
				.summary .product_meta span a,
				.woocommerce .posted_in a,
				.woocommerce-error, .woocommerce-info, .woocommerce-message {
					color:'. $text_color .';
				}
				.summary .product_meta span a:hover,
				.woocommerce .posted_in a:hover,
				.woocommerce #respond input#submit.alt.disabled:hover,
				.woocommerce #respond input#submit.alt:disabled:hover,
				.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
				.woocommerce a.button.alt.disabled:hover,
				.woocommerce a.button.alt:disabled:hover,
				.woocommerce a.button.alt:disabled[disabled]:hover,
				.woocommerce button.button.alt.disabled:hover,
				.woocommerce button.button.alt:disabled:hover,
				.woocommerce button.button.alt:disabled[disabled]:hover,
				.woocommerce input.button.alt.disabled:hover,
				.woocommerce input.button.alt:disabled:hover,
				.woocommerce input.button.alt:disabled[disabled]:hover {
					color:'. $additional_text_color .';
				}
				.woocommerce .woocommerce-tabs.wc-tabs-wrapper .tabs.wc-tabs li a,
				.woocommerce div.product .woocommerce-tabs .panel li>span,
				.woocommerce div.product .woocommerce-tabs .panel h2 span,
				.woocommerce ul.products li.product .price del,
				.single-product .product_meta > span span,
				.single-product .product_meta > span a {
					color:'. $text_color .'!important;
				}
				.woocommerce .woocommerce-tabs.wc-tabs-wrapper .tabs.wc-tabs li.active a,
				.woocommerce .woocommerce-tabs.wc-tabs-wrapper .tabs.wc-tabs li a:hover {
					color:'. $additional_text_color .'!important;
				}
				.woocommerce .woocommerce-tabs.wc-tabs-wrapper .tabs.wc-tabs li.active:before {
					background:'. $body_bg .'!important;
				}
				.woocommerce .woocommerce-tabs.wc-tabs-wrapper .tabs.wc-tabs li.active a:before,
				.woocommerce .woocommerce-tabs.wc-tabs-wrapper .tabs.wc-tabs li a:hover:before,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
					background:'. $theme_color .'!important	;
				}
				.woocommerce span.onsale::after,
				.woocommerce ul.products li.product .button:hover:after,
				.woocommerce ul.products li.product .add_to_wishlist:hover:after,
				.woocommerce ul.products li.product .yith-wcwl-wishlistaddedbrowse a:hover:after,
				.woocommerce ul.products li.product .yith-wcwl-wishlistexistsbrowse a:hover:after{
					border-bottom-color:'. $theme_color .';
				}
				.woocommerce-pagination ul.page-numbers li a.next span,
				.woocommerce-pagination ul.page-numbers li a.prev span,
				.woocommerce-pagination ul.page-numbers li a.next span:after,
				.woocommerce-pagination ul.page-numbers li a.prev span:after,
				.woocommerce-pagination ul.page-numbers li a.next span:before,
				.woocommerce-pagination ul.page-numbers li a.prev span:before{
					background:'. $theme_color .';
				}
				.woocommerce .woocommerce-pagination ul.page-numbers li a,
				.woocommerce-page .woocommerce-pagination ul.page-numbers li a {
					color:'. $text_color .';
				}
				.woocommerce .woocommerce-pagination ul.page-numbers li span,
				.woocommerce-page .woocommerce-pagination ul.page-numbers li span,
				.woocommerce nav.woocommerce-pagination ul li span.current{
					color:'. $additional_text_color .';
					border-color:'. $additional_text_color .';
				}
				.woocommerce nav.woocommerce-pagination ul li a:focus,
				.woocommerce nav.woocommerce-pagination ul li a:hover{
					color:'. $theme_color .';
				}
			';
		}

        exit;
    }
}