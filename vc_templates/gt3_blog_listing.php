<?php
$defaults = array(
	'items_per_page' => '7',
	'custom_class' => '',
	'custom_css' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);

global $gt3_wp_query_in_shortcodes, $paged;

if (empty($paged)) {
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

$gt3_wp_query_in_shortcodes = new WP_Query();
$args = array(
	'post_type' => 'post',
	'paged' => $paged,
	'posts_per_page' => $items_per_page,
);

wp_enqueue_script('jquery_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
?>
<div class="gt3_blog_listing <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?>">
	<?php
		$gt3_wp_query_in_shortcodes->query($args);			
		while ($gt3_wp_query_in_shortcodes->have_posts()) : $gt3_wp_query_in_shortcodes->the_post();				
			$gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "pagebuilder", true);
			if(get_the_category()) $categories = get_the_category();
			$post_categ = '';
			$separator = ', ';
			if ($categories) {
				foreach($categories as $category) {
					$post_categ = $post_categ .'<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$separator;
				}
			}
			$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
			$pft = get_post_format();
			if ($pft !== "image" && $pft !== "video" && $pft !== "quote" && $pft !== "link" && $pft !== "audio") {
				$pft = "standart";
			}			
			$post_categ = substr($post_categ, 0, -2);
			if ($pft == "standart" && strlen($featured_image[0]) < 1) {
				$post_class = 'no_image';
			} else {
				$post_class = '';
			}
			$comments_number = get_comments_number(get_the_ID());
			if ($comments_number < 10 && $comments_number > 0) {
				$comments_number = '0' . $comments_number;
			}
			?>
			<div class="blog_post_preview blog_post_listing <?php echo esc_attr($pft); ?>_post <?php echo esc_attr($post_class); ?>">
                <div class="preview_content">
                    <?php 
                        if ($pft !== 'quote' && $pft !== 'audio' && $pft !== 'link') {
                            echo gt3_get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "listing" => true)); 
                        }
                    ?>
                    <div class="preview_top_wrapper">
                        <div class="post_title">
                            <h2 class="blog_listing_title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h2>
                        </div><!-- .page_title -->
                        <div class="post_meta">
                            <div class="meta-item"><span><?php echo esc_html__('Date', 'sohopro') .':&nbsp;&nbsp;</span>' . esc_html(get_the_time(get_option('date_format'))); ?></div>
                            <div class="meta-item"><span><?php echo esc_html__('Author', 'sohopro'); ?>:&nbsp;&nbsp;</span><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID'))); ?>"><?php echo get_the_author_meta('display_name'); ?></a></div>
                            <div class="meta-item"><span><?php echo esc_html__('Category', 'sohopro'); ?>:&nbsp;&nbsp;</span><?php echo (($post_categ)); ?></div>
                            <div class="meta-item"><span><?php echo esc_html__('Comments', 'sohopro') . ':&nbsp;&nbsp;</span><a href="' . esc_url(get_comments_link()) . '">'. $comments_number .'</a>'; ?></div>
                        </div><!-- .post_meta -->
                    </div>
                    <?php 
                        if ($pft == 'quote' || $pft == 'audio' || $pft == 'link') {
                            echo '<div class="inside_post_pf">' . gt3_get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "listing" => true)) . '</div>'; 
                        }
                    ?>
                    <article class="contentarea">
						<h6 class="hidden_title"><?php echo esc_html(get_the_title()); ?></h6>
                        <?php echo ((strlen(get_the_excerpt()) > 0) ? get_the_excerpt() : get_the_content()); ?>
                    </article>
                    <div class="post_footer">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="preview_read_more"><?php echo esc_html__('Read More', 'sohopro'); ?></a>
                    </div><!-- .post_footer -->
                </div>
			</div><!--.blog_post_preview -->
		<?php
		endwhile;

		echo gt3_get_theme_pagination("10", "show_in_shortcodes");
		
		wp_reset_postdata();	
	?>	
</div>
<?php
?>