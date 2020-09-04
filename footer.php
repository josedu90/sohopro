<?php
    // Prefooter Shortcode
	$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(@get_the_ID());
    if (!isset($gt3_theme_pagebuilder['settings']['prefooter_shortcode_status']) || $gt3_theme_pagebuilder['settings']['prefooter_shortcode_status'] == 'default') {
        $prefooter_shortcode_area_status = gt3_get_theme_option("prefooter_shortcode_status");
    } else {
        $prefooter_shortcode_area_status = $gt3_theme_pagebuilder['settings']['prefooter_shortcode_status'];
    }
    if (!isset($gt3_theme_pagebuilder['page_settings']['header_type']) || $gt3_theme_pagebuilder['page_settings']['header_type'] == 'default') {
        $header_type = gt3_get_theme_option("default_header");
    } else {
        $header_type = $gt3_theme_pagebuilder['page_settings']['header_type'];
    }
    if ($prefooter_shortcode_area_status == 'enabled') {
        $space_class = '';
        if ($header_type == 'aside') {
            $space_class = 'pl_100';
        }
        echo '<div class="prefooter_shortcode_area '. esc_attr($space_class) .'">' . do_shortcode(gt3_get_theme_option("prefooter_shortcode")) . '</div>';
    }
?>

    <div class="footer_area fadeOnLoad">
        <div class="container">
            <div class="footer_widgets_wrapper">
            	<div class="vc_row vc_row-fluid">
	                <?php get_sidebar('footer'); ?>
                </div>
            </div>
        </div>
    </div>
    <a href="<?php echo esc_js("javascript:void(0)"); ?>" class="back2top"></a>
    <?php
		echo gt3_get_theme_option("code_before_body");
		wp_footer();
    ?>
</body>
</html>