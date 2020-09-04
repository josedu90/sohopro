<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action('init', 'my_get_woo_catss');

function my_get_woo_catss() {
    $product_categories = array();
    $product_cat = array();
    if(class_exists( 'WooCommerce' )){
        $product_categories = get_terms('product_cat', 'orderby=count&hide_empty=0');
        if ( is_array( $product_categories ) ) {
            foreach ( $product_categories as $cat ) {
                $product_cat[$cat->name.' ('.$cat->slug.')'] = $cat->slug;
            }
        }
    }
    if (function_exists('vc_map')) {
        // Add list item
        vc_map(array(
            "name" => esc_html__("GT3 Shop List", 'sohopro'),
            "base" => "gt3_shop_list",
            "class" => "gt3_shop_list",
            "category" => esc_html__('GT3 Modules', 'sohopro'),
            "icon" => 'gt3_icon',
            "content_element" => true,
            "description" => esc_html__("GT3 Shop List",'sohopro'),
            "params" => array(
                array(
                    'type' => 'gt3-multi-select',
                    'heading' => esc_html__('Product Category', 'sohopro' ),
                    'param_name' => 'category',
                    'options' => $product_cat,
                    'description' => 'Leave an empty select if you want to display all categories..',
                    'edit_field_class' => 'vc_col-sm-6 pt-15',
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Items Per Page", 'sohopro'),
                    "param_name" => "per_page",
                    "value"       => '8',
                    "description" => esc_html__("How much items per page to show.", 'sohopro'),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type'        => 'dropdown',
                    "heading" => esc_html__("Columns", 'sohopro'),
                    "param_name" => "columns",
                    'value'       => array( 
                        esc_html__('2', 'sohopro' ) => '2',
                        esc_html__('3', 'sohopro' ) => '3',
                        esc_html__('4', 'sohopro' ) => '4',
                        esc_html__('5', 'sohopro' ) => '5',
                        esc_html__('6', 'sohopro' ) => '6',
                    ),
                    "description" => esc_html__("How much columns grid.", 'sohopro'),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order by', 'sohopro' ),
                    'param_name'  => 'orderby',
                    'value'       => array( esc_html__('Date', 'sohopro' ) => 'date', esc_html__('ID', 'sohopro' ) => 'ID',
                        esc_html__('Author', 'sohopro' ) => 'author', esc_html__('Modified', 'sohopro' ) => 'modified',
                        esc_html__('Random', 'sohopro' ) => 'rand', esc_html__('Comment count', 'sohopro' ) => 'comment_count',
                        esc_html__('Menu Order', 'sohopro' ) => 'menu_order'
                    ),
                    'description' => esc_html__('Select how to sort retrieved products.', 'sohopro' ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order way', 'sohopro' ),
                    'param_name'  => 'order',
                    'value'       => array( esc_html__('Descending', 'sohopro' ) => 'DESC', esc_html__('Ascending', 'sohopro' ) => 'ASC'),
                    'description' => esc_html__('Designates the ascending or descending orde.', 'sohopro' ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Grid Gap', 'sohopro'),
                    'param_name' => 'grid_gap',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Default", 'sohopro') => 'gap_default',
                        esc_html__("Without Gap", 'sohopro') => 'gap_no_margin',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Grid Style', 'sohopro'),
                    'param_name' => 'grid_style',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Default", 'sohopro') => 'grid_default',
                        esc_html__("Packery", 'sohopro') => 'grid_packery',
                        esc_html__("Masonry", 'sohopro') => 'grid_masonry',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Hover Style', 'sohopro'),
                    'param_name' => 'hover_style',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Default", 'sohopro') => 'hover_default',
                        esc_html__("Bottom Title Overlay", 'sohopro') => 'hover_bottom',
                        esc_html__("Center Title Overlay", 'sohopro') => 'hover_center',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency' => array(
                        'element' => 'grid_style',
                        'value' => array("grid_default", "grid_masonry"),
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Hover Style', 'sohopro'),
                    'param_name' => 'hover_style_2',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Bottom Title Overlay", 'sohopro') => 'hover_bottom',
                        esc_html__("Center Title Overlay", 'sohopro') => 'hover_center',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency' => array(
                        'element' => 'grid_style',
                        'value' => array("grid_packery"),
                    ),
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( 'Hide Products Header?', 'sohopro' ),
                    "param_name"    => "hide_products_header",
                    'save_always' => true,
                    'std' => '',
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( 'Show OrderBy?', 'sohopro' ),
                    "param_name"    => "filter",
                    'save_always' => true,
                    'std' => 'true',
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( 'Select Box', 'sohopro' ),
                    "param_name"    => "filter_number",
                    'save_always' => true,
                    'std' => 'true',
                    'description' => 'Show select box for modifying the number of items displayed per page.',
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Pagination', 'sohopro'),
                    'param_name' => 'pagination',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__("Bottom", 'sohopro') => 'bottom',
                        esc_html__("Bottom and Top", 'sohopro') => 'bottom_top',
                        esc_html__("Off", 'sohopro') => 'off',
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( 'Use Scroll Animation?', 'sohopro' ),
                    "param_name"    => "scroll_anim",
                    'save_always' => true,
                    'std' => '',
                    'edit_field_class' => 'vc_col-sm-6',
                ),
                
            )
        ));
        
        if (class_exists('WPBakeryShortCode')) {
            class WPBakeryShortCode_Gt3_shop_list extends WPBakeryShortCode {
                
            }
        } 
    }
}
