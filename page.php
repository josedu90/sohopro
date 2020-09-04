<?php
if ( !post_password_required() ) {
	get_header();
	the_post();
	$gt3_theme_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
	$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
?>
<div class="site_wrapper fadeOnLoad">
	<div class="main_wrapper">
        <div class="container">
            <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
				<?php 
                if (!isset($gt3_theme_pagebuilder['settings']['show_title_area']) || $gt3_theme_pagebuilder['settings']['show_title_area'] !== "no") { ?>
                    <div class="container title_block_wrapper">
                        <div class="page_title_block">
                            <h1 class="title"><?php esc_html(the_title()); ?></h1>
							<?php 
								if (isset($gt3_theme_pagebuilder['page_settings']['subtitle']) &&  $gt3_theme_pagebuilder['page_settings']['subtitle'] !== '') {
									echo '<div class="sub-title">' . $gt3_theme_pagebuilder['page_settings']['subtitle'] . '</div>';
								}
							?></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                    <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "<div class='row'>" : ""); ?>
                        <div class="posts-block <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "hasLS" : ""); ?>">
                            <div class="contentarea">
                                <?php
                                the_content(esc_html__('Read more!', 'sohopro'));
                                wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'sohopro') . ': ', 'after' => '</div>'));
    
                                if (gt3_get_theme_option("page_comments") == "enabled") {
                                    echo '<div class="clea_r"></div>';
                                    comments_template();
                                } ?>
                                <div class="clea_r"></div>
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
<?php
	if (isset($gt3_theme_pagebuilder['page_settings']['footer_state']) && $gt3_theme_pagebuilder['page_settings']['footer_state'] == 'hide') {
		get_footer('none');
	} else {
		get_footer();
	}
} else {
	get_header();
?>
	<div class="gt3_pp_page_bg"></div>
	<div class="wrapper_pp fadeOnLoad">
		<div class="title_pp">
			<?php echo esc_html__('Password Protected', 'sohopro'); ?>
		</div>
		<div class="content_pp">
			<?php the_content(); ?>
        </div>
	</div>
<?php 
	get_footer('none');
} ?>