<?php get_header();
$gt3_theme_pagebuilder = gt3_get_default_pb_settings();
$gt3_current_page_sidebar = gt3_get_theme_option("default_sidebar_layout");
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$all_likes = gt3pb_get_option("likes");
wp_enqueue_script('jquery_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
?>
<div class="site_wrapper fadeOnLoad">
	<div class="main_wrapper">
        <div class="container">
            <div class="content_block row <?php echo esc_attr($gt3_current_page_sidebar) ?>">
                <div class="fl-container <?php echo(($gt3_current_page_sidebar == "right-sidebar") ? "hasRS" : ""); ?>">
                    <?php echo("left-sidebar" == $gt3_current_page_sidebar ? "<div class='gt3_row'>" : ""); ?>
                        <div class="posts-block <?php echo("left-sidebar" == $gt3_current_page_sidebar ? "hasLS" : ""); ?>">
                                <div class="contentarea">
                                    <div class="gt3_blog_listing">
                                        <div class="search_wrapper search_found">
                                            <?php get_search_form(true); ?>
                                        </div>
                                    <?php
                                        $foundSomething = false;
                                        while ( have_posts() ) : the_post();
                                            $foundSomething = true;
                                    ?>
                                    <div <?php post_class('blog_post_preview search_post_preview '); ?>>
                                        <div class="preview_content">
                                            <div class="preview_top_wrapper">
                                                <div class="post_title">
                                                    <h2 class="blog_listing_title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h2>
                                                </div><!-- .page_title -->
                                                <div class="post_meta">
                                                    <div class="meta-item"><span><?php echo esc_html__('Date', 'sohopro') .':&nbsp;&nbsp;</span>' . esc_html(get_the_time(get_option('date_format'))); ?></div>
                                                    <div class="meta-item"><span><?php echo esc_html__('Author', 'sohopro'); ?>:&nbsp;&nbsp;</span><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID'))); ?>"><?php echo get_the_author_meta('display_name'); ?></a></div>
                                                </div><!-- .post_meta -->
                                            </div>
                                            <div class="post_footer">
                                                <a href="<?php echo esc_url(get_permalink()); ?>" class="preview_read_more"><?php echo esc_html__('Read More', 'sohopro'); ?></a>
                                            </div><!-- .post_footer -->
                                        </div>
                                    </div><!--.blog_post_preview -->
                                    <?php
                                        // End the loop.
                                        endwhile;
                                        echo gt3_get_theme_pagination();
    
                                        if ($foundSomething == false) { ?>
    
                                            <div class="search_wrapper search_not_found">
                                                <h1><?php echo esc_html__('Oops!', 'sohopro'); ?> <?php echo esc_html__('Not Found!', 'sohopro'); ?></h1>
                                                <span class="text_search"><?php echo esc_html__('Apologies, but we were unable to find what you were looking for.', 'sohopro'); ?></span>
                                            </div>
                                        <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        <?php get_sidebar('left'); ?>
                    <?php echo("left-sidebar" == $gt3_current_page_sidebar ? "</div>" : ""); ?>
                </div>
                <?php get_sidebar('right'); ?>
                <div class="clear"></div>
            </div>    	    
        </div>
	</div>
</div>
<?php get_footer(); ?>