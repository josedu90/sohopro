<?php

// declare woocomerece custom theme stylesheets and js
function css_js_woocomerce() {
    wp_register_style( 'gt3_woo_style', get_template_directory_uri() . '/css/woo_style.css' );
    wp_enqueue_style( 'gt3_woo_style' );
    wp_enqueue_script('gt3_woo_js', get_template_directory_uri() . '/js/theme-woo.js', array(), '1.0', true);
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), '1.5.9', true);
    wp_enqueue_script('gt3_zoom', get_template_directory_uri() . '/js/easyzoom.js', array('jquery'), false, true);

}
add_action('wp_enqueue_scripts', 'css_js_woocomerce');


// Add theme support for single product
function gt3_add_single_product_opts () {
    add_image_size( 'gt3_442x350', 442, 350, true );
    add_image_size( 'gt3_442x730', 442, 730, true );
    add_image_size( 'gt3_912x730', 912, 730, true );

    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-slider');
    /*add_theme_support('wc-product-gallery-lightbox');*/
}
add_action('after_setup_theme','gt3_add_single_product_opts');

// Woocommerce Related Products (3)
function woocommerce_output_related_products() {
    global $post;
    $id = $post->ID;
    $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder( $id );
    if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
        $args = array(
            'posts_per_page' => 3,
            'columns'        => 3
        );
    } else {
        $args = array(
            'posts_per_page' => 2,
            'columns'        => 2
        );
    }
    woocommerce_related_products($args);
}

function gt3_get_template ($tmpl, $extension = NULL) {
    get_template_part( 'woocommerce/gt3-templates/' . $tmpl, $extension );
}

/* Add Attributes to Single Product ( ONLY Simple ) */
function gt3_show_attributes(){
    global $product;
    if(! $product->is_type('simple')) return;
    $attributes = $product->get_attributes();
    foreach ( $attributes as $attribute ) : ?>
        <span class="all_variation">
            <?php echo wc_attribute_label( $attribute->get_name() ).':'; ?>
            <span><?php
                $values = array();
                if ( $attribute->is_taxonomy() ) {
                    $attribute_taxonomy = $attribute->get_taxonomy_object();
                    $attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );
                    foreach ( $attribute_values as $attribute_value ) {
                        $values[] = esc_html( $attribute_value->name );
                    }
                } else {
                    $values = $attribute->get_options();
                    foreach ( $values as &$value ) {
                        $value = esc_html( $value );
                    }
                }
                echo apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values );
            ?></span>
        </span>
    <?php endforeach;
}
add_action('woocommerce_product_meta_end', 'gt3_show_attributes', 12);

/* Replace meta on single-product */
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 25);

/* Remove title on WooCommerce pages */
add_filter( 'woocommerce_show_page_title' , function(){return false;} );



// Woocommerce products per page (9)
add_filter( 'loop_shop_per_page', function ($cols) { return esc_attr(gt3_get_theme_option("shop_items_per_page"));}, 20 );

// Custom Shop Pagination
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action('woocommerce_after_shop_loop', 'gt3_get_shop_pagination', 10);

function gt3_get_shop_pagination() {
    echo gt3_get_theme_pagination();
}

// Woocommerce remove rating, price, add_to_cart button and title from template loop
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

add_action('woocommerce_before_shop_loop_item','gt3_open_wrap_to_thumbnail', 7 );
add_action('woocommerce_after_shop_loop_item','gt3_close_wrap_to_thumbnail', 3 );
function gt3_open_wrap_to_thumbnail(){
    echo "<div class='gt3_woocommerce-LoopProduct-link'>";
        echo "<div class='gt3_woocommerce-LoopProduct-link-hover'>";
            echo "<div class='gt3_add_to_cart_button'>";
                woocommerce_template_loop_add_to_cart();
            echo "</div>";
            if ( function_exists('gt3_output_wishlist_button') && class_exists( 'YITH_WCWL_Shortcode' )  && get_option('yith_wcwl_enabled') == true ) {
                gt3_output_wishlist_button();
            }
            if ( class_exists('YITH_WCQV_Frontend') && get_option('yith-wcqv-enable') ) {
                global $product;
                echo do_shortcode( '[yith_quick_view product_id="'.$product->get_id().'"]' );
            }
        echo "</div>";
}
function gt3_close_wrap_to_thumbnail(){
    echo "</div><!-- gt3_woocommerce-LoopProduct-link -->";
}

// WooCommerce Product Item Content (start)
add_action('woocommerce_after_shop_loop_item', 'gt3_after_shop_loop_item',5);
if (! function_exists('gt3_after_shop_loop_item')) {
    function gt3_after_shop_loop_item() {
        global $woocommerce, $product;
        ?>
        <div class="product_listing_item">
            <a href="<?php the_permalink()?>"><h6 class="product_grid_title"><?php the_title(); ?></h6></a>
            <div class="product_info">
                <?php if ($price_html = $product->get_price_html()) : ?>
                    <span class="price"><?php echo (($price_html)); ?></span>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>
    <?php
    }
}

add_filter( 'woocommerce_pagination_args', 'gt3_change_pagination');
function gt3_change_pagination($args) {
    $args['prev_text'] = '<span></span>'.esc_html__('Prev', 'sohopro');    
    $args['next_text'] = esc_html__('Next', 'sohopro').'<span></span>'; 
    return $args;
}

// Wishlist button moving
if ( !function_exists('gt3_output_wishlist_button') 
     && class_exists( 'YITH_WCWL_Shortcode' ) 
     && get_option('yith_wcwl_enabled') == true 
     && get_option('yith_wcwl_button_position') == 'add-to-cart' ) {
    function gt3_output_wishlist_button() {
        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
    }
    add_action('woocommerce_single_product_summary', 'gt3_output_wishlist_button', 25);
}

/* YITH Quick View */ 
function gt3_add_thumb_wcqv () {
    add_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 2);
}
add_action( 'wp_ajax_yith_load_product_quick_view', "gt3_add_thumb_wcqv", 1);
add_action( 'wp_ajax_nopriv_yith_load_product_quick_view', 'gt3_add_thumb_wcqv',1 );

add_action( 'template_redirect', 'yith_wcqv_remove_from_wishlist' );
function yith_wcqv_remove_from_wishlist(){
    if( function_exists( 'YITH_WCQV_Frontend' ) && defined('YITH_WCQV_FREE_INIT') ) {
        remove_action( 'yith_wcwl_table_after_product_name', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
        remove_action( 'woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
    }
}

// Add Hot/New label for product
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_field' );
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );
function woo_add_custom_general_field() {
    global $woocommerce, $post;

    echo '<div class="options_group">';
    woocommerce_wp_checkbox( array( 
        'id'            => '_checkbox_hot',  
        'label'         => esc_html__( 'Hot Product', 'sohopro' ),
        'description'   => esc_html__( 'Check for Hot Product', 'sohopro' )
    ) );
    woocommerce_wp_checkbox( array( 
        'id'            => '_checkbox_new',  
        'label'         => esc_html__( 'New Product', 'sohopro' ),
        'description'   => esc_html__( 'Check for New Product', 'sohopro' )
    ) );
    echo '</div>';

    echo '<div class="options_group">';
    woocommerce_wp_select( array( 
        'id'            => '_select_masonry',  
        'options'       => array(
            'default'       => __( 'Default', 'sohopro' ),
            'large'         => __( 'Large', 'sohopro' ),
            'large_vertical'=> __( 'Large Vertical', 'sohopro' )
        ),
        'label'         => esc_html__( 'Masonry style', 'sohopro' )
    ) );
    echo '</div>';
}
function woo_add_custom_general_fields_save( $post_id ){
    $woocommerce_checkbox = isset( $_POST['_checkbox_hot'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_checkbox_hot', $woocommerce_checkbox );

    $woocommerce_checkbox = isset( $_POST['_checkbox_new'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_checkbox_new', $woocommerce_checkbox );

    $woocommerce_checkbox = $_POST['_select_masonry'];
    update_post_meta( $post_id, '_select_masonry', $woocommerce_checkbox );
}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 5);
add_action('woocommerce_before_shop_loop_item_title', 'gt3_hot_new_product', 7);
add_action('yith_wcqv_product_image', 'gt3_hot_new_product', 10 );
add_action('gt3_hot_new_label_product','gt3_hot_new_product', 10);
add_action('woocommerce_before_single_product_summary','gt3_hot_new_product', 12);
function gt3_hot_new_product(){
    global $product;

    $is_hot = get_post_meta( $product->get_id(), '_checkbox_hot', true );
    if ( 'yes' == $is_hot ) {
        echo '<span class="onsale hot-product">'.esc_html__('Hot','sohopro').'</span>';
    }

    $is_new = get_post_meta( $product->get_id(), '_checkbox_new', true );
    if ( 'yes' == $is_new ) {
        echo '<span class="onsale new-product">'.esc_html__('New','sohopro').'</span>';
    }
}

// display an 'Out of Stock' label on archive pages
add_action('woocommerce_before_shop_loop_item_title', 'gt3_out_of_stock_product', 7);
add_action('yith_wcqv_product_image', 'gt3_out_of_stock_product', 10 );
add_action('gt3_hot_new_label_product','gt3_out_of_stock_product', 10);
function gt3_out_of_stock_product(){
    global $product;
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
        echo '<span class="onsale out-of-stock">'.esc_html__('Out of stock','sohopro').'</span>';
    }
}


// Add next/prev buttons on single product
if ( gt3_get_theme_option('next_prev_product') === 'on' ) {
    add_action( 'woocommerce_after_single_product_summary', 'wizestore_prev_next_product', 17 );
    function wizestore_prev_next_product(){
        function ShowLinkToProduct($post_id, $categories_as_array, $label) {
            $orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
            // get post according post id
            $query_args = array( 'orderby' => $orderby, 'post__in' => array($post_id), 'posts_per_page' => 1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $categories_as_array
                )));
            $r_single = new WP_Query($query_args);
            if ($r_single->have_posts()) {
                $r_single->the_post();
                global $product;
            ?>
                <li>
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                        <?php 
                        echo '<div class="product_list_nav_thumbnail">';
                        if (has_post_thumbnail()) the_post_thumbnail('shop_thumbnail'); else echo '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_thumbnail_image_width').'" height="'.$woocommerce->get_image_size('shop_thumbnail_image_height').'" />'; 
                        echo '</div>';
                        echo '<div class="product_list_nav_text">';
                            echo '<span class="nav_title">';
                                if ( get_the_title() ) the_title(); else the_ID(); 
                            echo '</span>';
                            echo '<span class="nav_text">'.$label.'</span>';
                            echo (($product->get_price_html()));
                        echo '</div>';
                        ?>
                    </a>
                </li>
            <?php
                wp_reset_query();
            }
        }

        global $post;
        $orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        // get categories
        $terms = wp_get_post_terms( $post->ID, 'product_cat' );
        $cats_array[] = '';
        foreach ( $terms as $term ) $cats_array[] = $term->term_id;
        // get all posts in current categories
        $query_args = array( 'posts_per_page' => -1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $cats_array
            )));
        $r = new WP_Query($query_args);
        // show next and prev only if we have 3 or more
        if ($r->post_count > 2) {
            echo "<ul class='gt3_product_list_nav'>";
            $prev_product_id = -1;
            $next_product_id = -1;
            $found_product = false;
            $i = 0;
            $current_product_index = $i;
            $current_product_id = get_the_ID();
            if ($r->have_posts()) {
                while ($r->have_posts()) {
                    $r->the_post();
                    $current_id = get_the_ID();
                    if ($current_id == $current_product_id) {
                        $found_product = true;
                        $current_product_index = $i;
                    }
                    $first_product_index = $i == $r->post_count - 1 ? $i : 0;
                    $is_first = ($current_product_index == $first_product_index);
                    if ($is_first) {
                        $prev_product_id = get_the_ID(); // if product is first then 'prev' = last product
                    } else {
                        if (!$found_product && $current_id != $current_product_id) {
                            $prev_product_id = get_the_ID();
                        }
                    }
                    if ($i == 0) { // if product is last then 'next' = first product
                        $next_product_id = get_the_ID();
                    }
                    if ($found_product && $i == $current_product_index + 1) {
                        $next_product_id = get_the_ID();
                    }
                    $i++;
                }
                if ($prev_product_id != -1) { ShowLinkToProduct($prev_product_id, $cats_array, esc_html__("PREVIOUS","sohopro")); }
                if ($next_product_id != -1) { ShowLinkToProduct($next_product_id, $cats_array, esc_html__("NEXT","sohopro")); }
            }
            wp_reset_query();
            echo "</ul>";
        }
    }
}

// add filter sidebar on Shop page
function gt3_woo_header_products_sidebar_top(){
    echo   '<div class="gt3-products-header">';
    if ( is_shop() && is_active_sidebar( 'page-sidebar-100' ) ) {
        echo   '<div class="gt3_woocommerce_top_filter_button"><span>'.esc_html__('Filter', 'sohopro').'</span></div>';
    }
}
add_action('woocommerce_before_shop_loop', 'gt3_woo_header_products_sidebar_top', 10);
function gt3_woo_header_products_sidebar_top_sidebar(){
    if ( is_shop() && is_active_sidebar( 'page-sidebar-100' ) ) {
        echo   '<div class="sidebar-container span12 gt3_top_sidebar_products">';
            echo   '<aside class="sidebar">';
                dynamic_sidebar( 'page-sidebar-100' );
            echo   '</aside>';
        echo '</div>';
    }
    echo "</div><!-- gt3-products-header -->";
}
add_action('woocommerce_before_shop_loop', 'gt3_woo_header_products_sidebar_top_sidebar', 32);
