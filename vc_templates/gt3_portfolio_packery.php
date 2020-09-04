<?php
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$defaults = array(
	'gt3_category' => '',
	'fitler_state' => 'on',
	'ajax' => 'on',
	'packery_layout' => '',
	'layouts_on_start' => '1',
	'layouts_per_load' => '1',
	'overlay_bg' => '',
	'items_padding' => '15px',
	'button_title' => esc_html__("Load More", "sohopro"),
	'custom_css' => '',
	'custom_class' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);
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

$compile = '';
wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
wp_enqueue_script('isotope_sorting_packery_portfolio', get_template_directory_uri() . '/js/sorting_packery_portfolio.js', array(), false, true);

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
			$this_categ = get_term_by('slug', $cat, 'portcat');
			$this_categ_id = $this_categ->term_id;
			array_push($filter_categ_array, $this_categ_id);
		}
	}
	$post_type_terms = $categ_array;
	$post_type_field = 'slug';
	
	$gt3_wp_query_in_shortcodes = new WP_Query();
	$args = array(
		'post_type' => 'port',
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
				'taxonomy' => 'portcat',
				'field' => $post_type_field,
				'terms' => $post_type_terms
			)
		);
	}	
	
	?>
    <div class="packery_portfolio_wrapper <?php echo esc_attr($custom_class); ?> personal_preloader packery_<?php echo esc_attr($uniqid) .' '. esc_attr($css_class) . ' ' . $custom_class; ?>"
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-pad="<?php echo esc_attr($items_padding); ?>" 
        data-categs="<?php echo esc_attr($gt3_category); ?>" 
        data-perload="<?php echo esc_attr($items_per_load); ?>" 
        data-onstart="<?php echo esc_attr($items_on_start); ?>" 
        data-showed = "<?php echo esc_attr($items_on_start); ?>"
        data-imgwidth = "<?php echo esc_attr($width); ?>" 
        data-imgheight = "<?php echo esc_attr($height); ?>" 
        data-layout="<?php echo esc_attr($item_in_row); ?>"> 

        <?php 
			if ($fitler_state == 'on') {
				if ($ajax == 'on') {
					echo gt3_showPortfolioCats($filter_categ_array);
				} else {
					echo gt3_showPortfolioCats($filter_categ_array);
				}
			}
		?>

        <div class="packery_portfolio personal_preloader packery_columns<?php echo esc_attr($item_in_row); ?>" 
	        data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        	data-pad="<?php echo esc_attr($items_padding); ?>" 
            data-perload="<?php echo esc_attr($items_per_load); ?>" 
            data-showed = "<?php echo esc_attr($items_on_start); ?>"
            data-overlay="<?php echo esc_attr($overlay_bg); ?>" 
            data-layout="<?php echo esc_attr($item_in_row); ?>">
            <?php
			$gt3_wp_query_in_shortcodes->query($args);			
			$imgCounter = 0;
			while ($gt3_wp_query_in_shortcodes->have_posts()) : $gt3_wp_query_in_shortcodes->the_post();				
				$gt3_theme_post = gt3_get_theme_pagebuilder(get_the_ID());
				$featured_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
				$pf = get_post_format();
				$echoallterm = '';
				$echoallterm2 = '';
				$galCateg = '';
				$new_term_list = get_the_terms(get_the_id(), "portcat");
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
				if ($imgCounter > $items_in_layout) {
					$imgCounter = 1;
				}			

                $post = get_post();

				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image[0]), $width, $height, true, true, true);
				} else {
					$featured_image_url = THEMEROOTURL . '/img/placeholder/800_800.jpg';
				}

				if (isset($gt3_theme_post['page_settings']['port']['work_link']) && strlen($gt3_theme_post['page_settings']['port']['work_link']) > 0) {
					$linkToTheWork = esc_url($gt3_theme_post['page_settings']['port']['work_link']);
				} else {
					$linkToTheWork = get_permalink();
				}

				?>
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
			<?php
			endwhile;			
			wp_reset_postdata();	
		?>
		</div><!-- .packery_portfolio -->
	<?php
		if ($ajax == 'off') {
			echo gt3_get_theme_pagination("10", "show_in_shortcodes");
		}
		if ($ajax == 'on') {
			echo '
			<div class="gt3_grid_module_button gt3_portfolio_packery_button">
				<a class="gt3_soho_button port_packery_load_more" href="'. esc_js("javascript:void(0)") .'"><span>' . esc_attr($button_title) . '</span></a>
			</div>';
		}
	?>
	</div><!-- .packery_portfolio_wrapper -->
<?php 
} 
?>