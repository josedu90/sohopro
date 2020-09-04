<?php
global $products, $woocommerce_loop, $wp_query;
$defaults = array(
    'category' => '',
    'per_page' => '8',
    'columns' => '4',
    'orderby' => 'date',
    'order' => 'DESC',
    'grid_gap' => 'gap_default',
    'grid_style' => 'grid_default',
    'hover_style' => 'hover_default',
    'hover_style_2' => 'hover_bottom',
    'hide_products_header' => '',
    'filter' => '',
    'filter_number' => '',
    'pagination' => 'bottom',
    'scroll_anim' => '',
);



$atts = vc_shortcode_attribute_parse($defaults, $atts);
global $grid_style, $animation_class, $hover_style, $hover_style_2;
extract($atts);

wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
if ( (bool) $scroll_anim) {
    wp_enqueue_script('gt3_appear', get_template_directory_uri() . '/js/jquery.appear.min.js', array(), false, false);
    $animation_class = 'gt3-anim-product';
} else {
    $animation_class = '';
}

// Category render
if (empty($category)) {
    $gt3_tax_query = array();
} else {
    $categories = explode( ',', $category);
    $gt3_tax_query = array(
        array(
            'taxonomy'      => 'product_cat',
            'terms'         => $categories,
            'field'         => 'slug',
            'operator'      => 'IN'
        )
    );
}

$product_visibility_terms  = wc_get_product_visibility_term_ids();
$product_visibility_not_in = $product_visibility_terms['exclude-from-catalog'];
if ( ! empty( $product_visibility_not_in ) ) {
    $gt3_tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'term_taxonomy_id',
        'terms'    => $product_visibility_not_in,
        'operator' => 'NOT IN',
    );
}


// Select filter sortby
if ( isset( $_GET['orderby'] ) ) {
    $orderby_value = explode( '-', $_GET['orderby'] );
    $orderby       = esc_attr( $orderby_value[0] );
    $order         = ! empty( $orderby_value[1] ) ? $orderby_value[1] : $order;
    if ($_GET['orderby'] == 'price') {
        $order = 'ASC';
    }
}

$ordering_args = WC()->query->get_catalog_ordering_args( $orderby, $order );
$meta_query    = WC()->query->get_meta_query();

// Pagination setup
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

// Select how many products to show
if (isset( $_GET['show_prod'])) {
    $per_page = $_GET['show_prod'];
}

if (class_exists('WC_List_Grid')) {
    if ('hover_default' == $hover_style && 'grid_default' == $grid_style ) {
        // Add grid-list buttons
        global $WC_List_Grid;
        add_action( 'gt3_shortcode_before_products_list_loop', array( $WC_List_Grid, 'gridlist_toggle_button' ), 30);
    }
}



$args = array(
    'post_type'				=> 'product',
    'post_status' 			=> 'publish',
    'ignore_sticky_posts'	=> 1,
    'orderby' 				=> $ordering_args['orderby'],
    'order' 				=> $ordering_args['order'],
    'meta_key'              => $ordering_args['meta_key'],
    'posts_per_page' 		=> $per_page,
    'paged'                 => $paged,
    'meta_query' 			=> $meta_query,
    'tax_query'             => $gt3_tax_query
);

$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
$columns                     = absint( $columns );
$woocommerce_loop['columns'] = $columns;

$products_class = '';
$products_class .= !empty($hover_style) && $grid_style !== 'grid_packery' ? ' '.$hover_style : '';
$products_class .= !empty($hover_style_2) && $grid_style === 'grid_packery'  ? ' '.$hover_style_2 : '';
$products_class .= !empty($grid_gap) ? ' '.$grid_gap : '';
$products_class .= 'grid_masonry' == $grid_style ? ' shop_grid_masonry' : '';
$products_class .= 'grid_packery' == $grid_style ? ' shop_grid_masonry shop_grid_packery' : '';

ob_start();
if ( $products->have_posts() ) : ?>
    <?php if ((bool) $hide_products_header == false) : ?>
    <div class="gt3-products-header <?php echo (($products_class)); ?>">
        <?php
        if ((bool) $filter) {
            gt3_get_template('loop/orderby');// Result Count
        }
        if ((bool) $filter_number) {
            gt3_get_template('loop/product-show'); // Result Count
        }
        gt3_get_template('loop/result-count') // Result Count
         ?>
        <?php
        if ("bottom_top" == $pagination) {
            gt3_get_template('pagination'); // Pagination
        } else {
            do_action( 'gt3_shortcode_before_products_list_loop', array( 'products' => $products ) );
        }
        ?>
    </div>
    <?php endif; ?>

    <ul class="products <?php echo (($products_class)); ?>">

    <?php
    global $thumbnail_dim;
    $packery_array = array('gt3_912x730','gt3_442x350','gt3_442x730','gt3_442x350','gt3_442x730','gt3_442x350','gt3_912x730','gt3_442x350');

    while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php
            if ('grid_masonry' == $grid_style) {
                $gt3_masonry_image_size = get_post_meta( get_the_ID(), '_select_masonry', true );
                switch ($gt3_masonry_image_size) {
                    case 'large_vertical':
                        $thumbnail_dim = 'gt3_442x730';
                        break;
                    case 'large':
                        $thumbnail_dim = 'gt3_912x730';
                        break;
                    default:
                        $thumbnail_dim = 'gt3_442x350';
                        break;
                }
            } elseif ('grid_packery' == $grid_style) {
                $number_pos = !isset($number_pos) ? 1 : $number_pos;
                $thumbnail_dim = $packery_array[$number_pos - 1];
                if ($number_pos == 8) {
                    $number_pos = 1;
                } else {
                    $number_pos = ++$number_pos;
                }
            } elseif ('grid_default' == $grid_style && 'hover_default' == $hover_style) {
                $thumbnail_dim = 'gt3_540x600';
            } else {
                $thumbnail_dim = 'gt3_912x730';
            }

        ?>

        <?php do_action( 'woocommerce_shop_loop' ); ?>

        <?php gt3_get_template('gt3-content-product'); // Content output ?>

    <?php endwhile; // end of the loop. ?>
    <li class="product-default-width"></li>

    <?php if ( ('grid_packery' == $grid_style) ): ?>
        <li class="bubblingG">
            <span id="bubblingG_1">
            </span>
            <span id="bubblingG_2">
            </span>
            <span id="bubblingG_3">
            </span>
        </li>
    <?php endif; ?>

    </ul>

    <?php
    if ("bottom_top" == $pagination || "bottom" == $pagination) {
            gt3_get_template('pagination'); // Pagination
        }
    ?>

    <?php
    do_action( 'woocommerce_after_shop_loop' ); ?>

<?php endif;

woocommerce_reset_loop();
wp_reset_postdata();
$columns = !empty($columns) ? $columns : 4;
$list_item_by_cat = '<div class="woocommerce gt3-shop-list columns-'.esc_attr($columns).'">' . ob_get_clean() . '</div>';

echo (($list_item_by_cat));