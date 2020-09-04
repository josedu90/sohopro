<?php
$defaults = array(
	'gt3_category' => '',
	'masonry' => '',
	'items_in_row' => '4',
	'ajax' => 'on',
	'items_on_start' => '12',
	'items_per_load' => '4',
	'items_padding' => '15px',
	'button_title' => 'Load More',
	'custom_class' => '',
	'custom_css' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

if ($masonry == 'on') {
	$width = '1170';
	$height = '';
} else {
	$width = '1170';
	$height = '1170';
}


$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);

wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
wp_enqueue_script('blog_grid_gallery', get_template_directory_uri() . '/js/blog_gallery.js', array(), false, true);

global $gt3_wp_query_in_shortcodes, $paged;

if (empty($paged)) {
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
if ($gt3_category !== '') {
	$gt3_category = substr($gt3_category, 0, strlen($gt3_category)-1);
	$filter_categ_array = array();
	$categ_array = explode(" ", $gt3_category);

	$post_type_terms = '';
	if (is_array($categ_array) && count($categ_array) > 0) {
		foreach ($categ_array as $cat) {
			$this_categ = get_category_by_slug($cat);
			$this_categ_id = $this_categ->term_id;
			$post_type_terms .= $this_categ_id . ',';
			array_push($filter_categ_array, $this_categ_id);
		}
	}
	$post_type_terms = substr($post_type_terms, 0, -1);
	$gt3_wp_query_in_shortcodes = new WP_Query();
	$args = array(
		'post_type' => 'post',
		'paged' => $paged,
		'posts_per_page' => $items_on_start,
	);

	if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
		$post_type_terms = esc_attr($_GET['slug']);
		$selected_categories = esc_attr($_GET['slug']);
		$this_categ = get_term_by('slug', $selected_categories);
		$filter_categ_array = $this_categ['term_id'];

	}
	//if (count($post_type_terms) > 0) {
	if (is_array($post_type_terms) && count($post_type_terms) > 0) {
		$args['cat'] = $post_type_terms;
	}
	
	?> 
	<div class="gt3_blog_grid <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?>" 
        data-perload="<?php echo esc_attr($items_per_load); ?>" 
        data-showed="<?php echo esc_attr($items_on_start); ?>" 
        data-categs="<?php echo esc_attr($gt3_category); ?>" 
        data-imgwidth = "<?php echo esc_attr($width); ?>" 
        data-imgheight = "<?php echo esc_attr($height); ?>" 
        data-pad="<?php echo esc_attr($items_padding); ?>">
        
	    <div class="gt3_blog_grid_inner masonry_is_<?php echo esc_attr($masonry); ?> <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?> blog_grid_columns<?php echo esc_attr($items_in_row); ?>" 
	        data-pad="<?php echo esc_attr($items_padding); ?>" 
            data-perload="<?php echo esc_attr($items_per_load); ?>">
		<?php
			$gt3_wp_query_in_shortcodes->query($args);			
			while ($gt3_wp_query_in_shortcodes->have_posts()) : $gt3_wp_query_in_shortcodes->the_post();				
				$gt3_theme_post = gt3_get_theme_pagebuilder(get_the_ID());
				$featured_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
				$pf = get_post_format();
				$photoTitle = get_the_title();	

                $post = get_post();

				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image[0]), $width, $height, true, true, true);
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
		?>
        </div>
		<?php 
			if ($ajax == 'off') {
				echo gt3_get_theme_pagination("10", "show_in_shortcodes");
			}
			if ($ajax == 'on') {
				echo "
					<div class='gt3_grid_module_button gt3_blog_grid_module_button'>
						<a class='blog_grid_load_more gt3_soho_button' href='". esc_js("javascript:void(0)") ."'><span>" . esc_attr($button_title) . "</span></a>
					</div>";
			}
		?>
	</div>
<?php
}
?>