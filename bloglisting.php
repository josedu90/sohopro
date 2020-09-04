<?php
$gt3_theme_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());

$post_categories = wp_get_post_categories(get_the_ID());
$cats = array();

$pf = get_post_format();
if (empty($pf)) $pf = "standard";

$post_class = '';
if (empty($gt3_theme_featured_image)) $post_class = 'no-post-thumbnail';

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

global $more;
$more = 0;

	$pf_class = '';

	if ( is_sticky() ) {
		$pf_class = 'sticky_post';
	}
	$comments_number = get_comments_number(get_the_ID());
	if ($comments_number < 10 && $comments_number > 0) {
		$comments_number = '0' . $comments_number;
	}
	?>
	<div class="blog_post_preview blog_post_listing <?php echo esc_attr($pf).'_post '.esc_attr($post_class).' '.esc_attr($pf_class); ?>">
        <div class="preview_content">
            <?php 
                if ($pf !== 'quote' && $pf !== 'audio' && $pf !== 'link') {
                    echo gt3_get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "listing" => true)); 
                }
            ?>
            <div class="preview_top_wrapper">
                <div class="post_title">
                    <h2 class="blog_listing_title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h2>
                </div><!-- .page_title -->
                <div class="post_meta">
                <?php 
					if ( is_sticky() ) { ?>
                     <div class="meta-item sticky_post_marker"><span><i class="fa fa-thumb-tack"></i></span></div>
                <?php
					}
				?>
                    <div class="meta-item"><span><?php echo esc_html__('Date', 'sohopro') .':&nbsp;&nbsp;</span>' . esc_html(get_the_time(get_option('date_format'))); ?></div>
                    <div class="meta-item"><span><?php echo esc_html__('Author', 'sohopro'); ?>:&nbsp;&nbsp;</span><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID'))); ?>"><?php echo get_the_author_meta('display_name'); ?></a></div>
                    <div class="meta-item"><span><?php echo esc_html__('Category', 'sohopro'); ?>:&nbsp;&nbsp;</span><?php echo (($post_categ)); ?></div>
                    <div class="meta-item"><span><?php echo esc_html__('Comments', 'sohopro') . ':&nbsp;&nbsp;</span><a href="' . esc_url(get_comments_link()) . '">'. $comments_number .'</a>'; ?></div>
                </div><!-- .post_meta -->
            </div>
            <?php
                if ($pf == 'quote' || $pf == 'audio' || $pf == 'link') {
                    echo '<div class="inside_post_pf">' . gt3_get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "listing" => true)) . '</div>';
                }
            ?>
            <article class="contentarea">
                <h6 class="hidden_title"><?php echo esc_html(get_the_title()); ?></h6>
			<?php
					if (has_excerpt()) {
						the_excerpt();
					} else {
						the_content('');
					}
			?>
            </article>
            <div class="post_footer">
                <a href="<?php echo esc_url(get_permalink()); ?>" class="preview_read_more"><?php echo esc_html__('Read More', 'sohopro'); ?></a>
            </div><!-- .post_footer -->
        </div>
	</div>