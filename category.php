<?php
get_header();
#Emulate default settings for page without personal ID
$gt3_theme_pagebuilder = gt3_get_default_pb_settings();
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];
?>
	<div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <?php if (gt3_get_theme_option("show_title_area") !== "no") { ?>
                <div class="page_title"><h1><?php echo esc_html__('Welcome to Blog', 'sohopro'); ?></h1></div>
            <?php } ?>
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "hasLS" : ""); ?>">
                        <div class="contentarea"> 
                            <?php
								if (get_post_type() == 'post') {
									//Blog Posts Categories Goes Here
									echo '<div class="row"><div class="col-sm-12 gt3_blog_listing">';
									while (have_posts()) : the_post();
										get_template_part("bloglisting");
									endwhile;
									wp_reset_postdata();
									echo gt3_get_theme_pagination();
									echo '</div><div class="clear"></div></div>';
								}
								if (get_post_type() == 'portfolio') {
									//Portfolio Posts Categories Goes Here
									echo '<div class="row"><div class="col-sm-12 gt3_blog_listing">';
									while (have_posts()) : the_post();
										//Place your code here
									endwhile;
									wp_reset_postdata();
									echo gt3_get_theme_pagination();
									echo '</div><div class="clear"></div></div>';
								}
							?>                           
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "</div>" : ""); ?>
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>    	    
    </div>
    
<?php get_footer(); ?>