<?php
get_header();

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_option( 'woocommerce_shop_page_id' ));
if (is_product()) {
    global $post;
    $id = $post->ID;
    $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder( $id );
}
$gt3_subtitle = (
		is_array($gt3_theme_pagebuilder) &&
		key_exists('page_settings', $gt3_theme_pagebuilder) &&
		is_array($gt3_theme_pagebuilder['page_settings']) &&
		isset($gt3_theme_pagebuilder['page_settings']['subtitle']) &&
		!empty($gt3_theme_pagebuilder['page_settings']['subtitle'])
) ? $gt3_theme_pagebuilder['page_settings']['subtitle'] : '';


$has_subtitle = !empty($gt3_subtitle) ? true : false;
$has_title = gt3_get_theme_option("shop_title_area") !== "no" ? true : false;
?>
<div class="site_wrapper fadeOnLoad">
	<div class="main_wrapper">
        <div class="container">
            <div class="page_title_block">
                <?php
                if ($has_title) : ?>
                    <div class="page_title"><h1 class="title"><?php woocommerce_page_title(); ?></h1></div>
                <?php endif;
                if ($has_subtitle) : ?>
                    <div class="page_subtitle"><?php echo (($gt3_subtitle)); ?></div>
                <?php endif;?>
            </div>
            <div class="content_block woo_wrap row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
                <div class="fl-container <?php echo esc_attr((($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : "")); ?>">
                    <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo esc_attr(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : "")); ?>">
                        <div class="contentarea woocommerce_container woocommerce_boxed">
                            <?php
                                woocommerce_content();
                                wp_link_pages(array('before' => '<div class="page-link">' . __('Pages', 'sohopro') . ': ', 'after' => '</div>'));
                            ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                    <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "</div>" : ""); ?>
                </div>
                <?php get_sidebar('right'); ?>
                <div class="clear"></div>
            </div>
        </div>
	</div>
</div>
<?php get_footer(); ?>
