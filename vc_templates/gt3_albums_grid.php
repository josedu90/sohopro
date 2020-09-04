<?php
$defaults = array(
	'gt3_category' => '',
	'masonry' => '',
	'items_in_row' => '4',
	'fitler_state' => 'on',
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
	$width = '800';
	$height = '';
} else {
	$width = '800';
	$height = '800';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);

wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
wp_enqueue_script('albums_grid_gallery', get_template_directory_uri() . '/js/albums_gallery.js', array(), false, true);

global $gt3_wp_query_in_shortcodes, $paged;

if (empty($paged)) {
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
if ($gt3_category !== '') {
	$gt3_category = substr($gt3_category, 0, strlen($gt3_category)-1);
	$filter_categ_array = array();
	$categ_array = explode(" ", $gt3_category);

	if (is_array($categ_array) && count($categ_array) > 0) {
		foreach ($categ_array as $cat) {
			$this_categ = get_term_by('slug', $cat, 'gallerycat');
			$this_categ_id = $this_categ->term_id;
			array_push($filter_categ_array, $this_categ_id);
		}
	}
	$post_type_terms = $categ_array;
	$post_type_field = 'slug';
	
	$gt3_wp_query_in_shortcodes = new WP_Query();
	$args = array(
		'post_type' => 'gallery',
		'paged' => $paged,
		'posts_per_page' => $items_on_start,
	);

	if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
		$post_type_terms = esc_attr($_GET['slug']);
		$selected_categories = esc_attr($_GET['slug']);
		$post_type_field = "slug";
	}
	if (count($post_type_terms) > 0) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'gallerycat',
				'field' => $post_type_field,
				'terms' => $post_type_terms
			)
		);
	}	
	
	?> 
	<div class="gt3_albums_grid <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?>" 
        data-perload="<?php echo esc_attr($items_per_load); ?>" 
        data-showed="<?php echo esc_attr($items_on_start); ?>" 
        data-categs="<?php echo esc_attr($gt3_category); ?>" 
        data-imgwidth = "<?php echo esc_attr($width); ?>" 
        data-imgheight = "<?php echo esc_attr($height); ?>" 
        data-pad="<?php echo esc_attr($items_padding); ?>">
        
        <?php 
			if ($fitler_state == 'on') {
				if ($ajax == 'on') {
					echo gt3_showGalleryCats($filter_categ_array);
				} else {
					echo gt3_showGalleryCats($filter_categ_array);
				}
			}
		?>
        
	    <div class="gt3_albums_grid_inner <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($css_class); ?> masonry_is_<?php echo esc_attr($masonry); ?> albums_grid_columns<?php echo esc_attr($items_in_row); ?>" 
	        data-pad="<?php echo esc_attr($items_padding); ?>" 
            data-perload="<?php echo esc_attr($items_per_load); ?>">
		<?php
			$gt3_wp_query_in_shortcodes->query($args);			
			while ($gt3_wp_query_in_shortcodes->have_posts()) : $gt3_wp_query_in_shortcodes->the_post();				
				$gt3_theme_post = gt3_get_theme_pagebuilder(get_the_ID());
				$featured_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
				$pf = get_post_format();
				$echoallterm = '';
				$echoallterm2 = '';
				$galCateg = '';
				$new_term_list = get_the_terms(get_the_id(), "gallerycat");
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

                $post = get_post();
				if (isset($gt3_theme_post['sliders']['fullscreen']['slides'])) {
					$picsCount = count($gt3_theme_post['sliders']['fullscreen']['slides']);
				} else {
					$picsCount = 0;
				}

				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image[0]), $width, $height, true, true, true);
				} else {
					$featured_image_url = THEMEROOTURL . '/img/placeholder/800_800.jpg';
				}
				?>
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
					<div class='gt3_grid_module_button gt3_albums_grid_module_button'>
						<a class='albums_grid_load_more gt3_soho_button' href='". esc_js("javascript:void(0)") ."'><span>" . esc_attr($button_title) . "</span></a>
					</div>";
			}
		?>
	</div>
<?php
}
?>