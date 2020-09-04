<?php

if (function_exists('register_sidebar')) {
    function gt3_register_sidebar(){
        $all_sidebars = gt3_get_theme_sidebars_for_admin();
        #default values
        $register_sidebar_attr = array(
            'description' => esc_html__('Add the widgets appearance for Custom Sidebar. Drag the widget from the available list on the left, configure widgets options and click Save button. Select the sidebar on the posts or pages in just few clicks.', 'sohopro'),
            'before_widget' => '<div class="sidepanel %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>'
        );

        $register_footer_sidebar_attr = array(
            'description' => esc_html__('Display and style the footer area with multiple widgets. Simply drag the widgets from the left, make the adjustments to the widget according the needs. Preview the front end.', 'sohopro'),
            'before_widget' => '<div class="vc_column_container vc_col-sm-3"><div class="vc_column-inner sidepanel %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<h4 class="widget_title">',
            'after_title' => '</h4>'
        );

        #REGISTER DEFAULT SIDEBARS
        $register_sidebar_attr['name'] = "Default";
        $register_sidebar_attr['id'] = 'page-sidebar-1';
        register_sidebar($register_sidebar_attr);

        $register_footer_sidebar_attr['name'] = "Footer";
        $register_footer_sidebar_attr['id'] = 'page-sidebar-2';
        register_sidebar($register_footer_sidebar_attr);

        if (class_exists('WooCommerce')) {
            $register_sidebar_attr['name'] = "WooCommerce";
            $register_sidebar_attr['id'] = 'page-sidebar-99';
            register_sidebar($register_sidebar_attr);

            $register_sidebar_attr['name'] = "Filter sidebar for Shop";
            $register_sidebar_attr['id'] = 'page-sidebar-100';
            register_sidebar($register_sidebar_attr);
        }

        $sidebar_id = 100;
        if (is_array($all_sidebars)) {
            foreach ($all_sidebars as $sidebarName) {
                $register_sidebar_attr['name'] = $sidebarName;
                $register_sidebar_attr['id'] = 'page-sidebar-' . $sidebar_id++;
                register_sidebar($register_sidebar_attr);
                $sidebar_id++;
            }
        }
    }
    add_action( 'widgets_init', 'gt3_register_sidebar' );
}

?>