<?php 
if ( !post_password_required() ) {
/* LOAD PAGE BUILDER ARRAY */
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
if (strlen($featured_image[0])>0) {
	$pinterest_img = esc_url($featured_image[0]);
} else {
	if (wp_get_attachment_url(gt3_get_theme_option("logo"))) {
		$pinterest_img = esc_url(wp_get_attachment_url(gt3_get_theme_option("logo")));
	} else {
		$pinterest_img = esc_url(gt3_get_theme_option("logo"));
	}
}
$pf = get_post_format();
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];

get_header();

the_post();
$all_likes = gt3pb_get_option("likes");
$show_likes = gt3_get_theme_option("post_likes");
wp_enqueue_script('jquery_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);

$pft = get_post_format();
$post_pft_height = 560;
$post_pft_layout = 'simple';
$pft = get_post_format();
if (isset($gt3_theme_pagebuilder['page_settings']['post_layout']) && $gt3_theme_pagebuilder['page_settings']['post_layout'] == 'fullwidth') {
	$post_pft_layout = 'fullwidth';
}
if (isset($gt3_theme_pagebuilder['page_settings']['post_pft_height']) && $gt3_theme_pagebuilder['page_settings']['post_pft_height'] !== '') {
	$post_pft_height = $gt3_theme_pagebuilder['page_settings']['post_pft_height'];
}
if ($post_pft_layout == 'fullwidth') {
	echo '<div class="fw_pf_global_wrapper gt3_js_height" data-height="'. $post_pft_height .'">'. gt3_get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => "1920", "height" => $post_pft_height, "fw_post" => true)) . '</div>';
}

$comments_number = get_comments_number(get_the_ID());
if ($comments_number < 10 && $comments_number > 0) {
	$comments_number = '0' . $comments_number;
}

$categories = '';
if(get_the_category()) $categories = get_the_category();
$post_categ = '';
$separator = ', ';
if ($categories) {
	foreach($categories as $category) {
		$post_categ = $post_categ .'<a href="'.esc_url(get_category_link( $category->term_id )).'">'.$category->cat_name.'</a>'.$separator;
	}
	$post_categ_compile = trim($post_categ, ', ');
}
$post_categ = substr($post_categ, 0, -2);

?>
<div class="site_wrapper fadeOnLoad">
	<div class="main_wrapper">
        <div class="content_wrapper">
            <div class="container single_page is_page <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">    
                <div class="content_block row">
                    <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                        <div class="row">
                            <div class="posts-block <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "hasLS" : ""); ?>">
                                <div class="contentarea single_content single_page single_post">
                                	<?php if ($post_pft_layout == 'simple') {
                                        if ( $pft !== "audio" && $pft !== "quote" && $pft !== "link") {
											echo gt3_get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => "1170", "height" => ""));
										}
									} ?>
                                    <div class="preview_top_wrapper single_top_wrapper">
                                        <h2 class="blog_post_title"><?php esc_html(the_title()); ?></h2>
                                        <div class="post_meta">
                                            <div class="meta-item"><span><?php echo esc_html__('Date', 'sohopro') .':&nbsp;&nbsp;</span>' . esc_html(get_the_time(get_option('date_format'))); ?></div>
                                            <div class="meta-item"><span><?php echo esc_html__('Author', 'sohopro'); ?>:&nbsp;&nbsp;</span><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID'))); ?>"><?php echo get_the_author_meta('display_name'); ?></a></div>
                                            <div class="meta-item"><span><?php echo esc_html__('Category', 'sohopro'); ?>:&nbsp;&nbsp;</span><?php echo (($post_categ)); ?></div>
                                            <div class="meta-item"><span><?php echo esc_html__('Comments', 'sohopro') . ':&nbsp;&nbsp;</span><a href="' . esc_url(get_comments_link()) . '">'. $comments_number .'</a>'; ?></div>
                                        </div><!-- .post_meta -->
                                    </div><!-- .preview_top_wrapper -->
                                    <?php
                                        if ( $pft == "audio" || $pft == "quote" || $pft == "link") {
                                            echo gt3_get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => "1170", "height" => ""));
                                        }
                                    ?>
									<?php global $gt3_contentAlreadyPrinted;
                                    if ($gt3_contentAlreadyPrinted !== true) {
                                        echo "<article class='contentarea single_contentarea'><h6 class='hidden_title'>".esc_html(get_the_title())."</h6>";
                                        the_content();
                                    }
                                    echo "<div class='clear'></div>";
                                    echo "</article>";													
                                    wp_link_pages(array('before' => '<div class="page-link post-page-nav"><span class="pagger_info_text">' . esc_html__('Pages', 'sohopro') . ': </span>', 'after' => '</div>', 'separator' => '<span class="page_nav_sep"></span>'));
                                    ?>                                
                                    <div class="dn"><?php posts_nav_link(); ?></div>
									
                                    <div class="single_post_ground">
                                        <div class="spg_lp">
                                            <div class="spg_lp_wrapper">
                                                <div class="single_tags">
                                                    <?php the_tags('', ''); ?>
                                                </div>
                                            </div>
                                        </div>
										<?php if (gt3_get_theme_option("post_likes") == 'show') { ?>
                                        <div class="spg_rp">
                                            <div class="spg_rp_wrapper">
                                                <div class="gb_meta_item post_likes post_likes_add <?php echo (isset($_COOKIE['like_post'.get_the_ID()]) ? "already_liked" : "") ?>" data-attachid="<?php echo esc_attr(get_the_ID()); ?>" data-modify="like_post">
                                                    <i class="fa <?php echo (isset($_COOKIE['like_post'.get_the_ID()]) ? "fa-heart" : "fa-heart-o") ?>"></i>
                                                    <span class="post_likes_text"><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0) ?></span>
                                                </div><!-- .post_likes -->
                                            </div>
                                        </div>
										<?php } ?>
                                    </div><!-- .single_post_ground -->
                                    
                                    <div class="single_post_share_block">
                                        <div class="preview_share_block">
                                            <a target="_blank"
                                               href="<?php echo esc_url('https://www.facebook.com/share.php?u='. get_permalink()); ?>" class="share_facebook"><?php echo esc_html__('Facebook', 'sohopro'); ?></a>
                                            <a target="_blank"
                                               href="<?php echo esc_url('https://twitter.com/intent/tweet?text='. get_the_title() .'>&amp;url='. get_permalink()); ?>" class="share_twitter"><?php echo esc_html__('Twitter', 'sohopro'); ?></a>
                                            <a target="_blank"
                                               href="<?php echo esc_url('https://plus.google.com/share?url='. get_permalink()); ?>" class="share_gplus"><?php echo esc_html__('Google', 'sohopro'); ?></a>
                                            <a target="_blank"
                                               href="<?php echo esc_url('https://pinterest.com/pin/create/button/?url='. get_permalink() .'>&media='. $pinterest_img); ?>" class="share_pinterest"><?php echo esc_html__('Pinterest', 'sohopro'); ?></a>
                                        </div>
                                    </div><!-- .single_post_share_block -->
                                    
                                    <div class="single_prev_next_posts">
										<?php previous_post_link('<div class="fleft">%link</div>', '<span class="big_arrow_wrapper big_arrow_prev"><span></span></span>' . esc_html__('Prev (P)', 'sohopro')); ?>
                                        <?php next_post_link('<div class="fright">%link</div>', esc_html__('Next (N)', 'sohopro') . '<span class="big_arrow_wrapper big_arrow_next"><span></span></span>'); ?>
                                    </div>

									<?php
                                        if (gt3_get_theme_option("related_posts") == "on") {
                                            if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
                                                $posts_per_line = 3;
                                            } else {
                                                $posts_per_line = 2;
                                            }
                                            // Get Cats_ID
                                            if (get_the_category()) $categories = get_the_category();
                                            if ($categories) {
                                                $post_categ = '';
                                                $post_category_compile = '';
                                                foreach ($categories as $category) {
                                                    $post_categ = $post_categ . $category->cat_ID . ',';
                                                }
                                                $post_category_compile .= '' . trim($post_categ, ',') . '';
                                            }
                                            gt3_get_featured_posts(array(
                                                'orderby' => 'rand',
                                                'set_pad' => '30px',
                                                'numberposts' => $posts_per_line,
                                                'title' => esc_html__('Recent Posts', 'sohopro'),
                                                'ignore_sticky_posts' => 1,
                                                'post_category_compile' => $post_category_compile
                                            ));												
                                        }
                                    ?>                                
                                    <?php if (gt3_get_theme_option('post_comments') == "enabled") {?>
                                    <div class="row">
                                        <div class="span12">
                                            <?php comments_template(); ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                </div><!-- .contentarea -->
                            </div>
                            <?php get_sidebar('left'); ?>
                        </div>
                    </div><!-- .fl-container -->
                    <?php get_sidebar('right'); ?>
                </div>
            </div>
        </div>
	</div>
</div>
<?php
	get_footer();

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