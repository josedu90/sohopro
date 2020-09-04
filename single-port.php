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
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];

get_header();
the_post();

$pft = get_post_format();

$categories = '';
if(get_the_category()) $categories = get_the_category();

$echoallterm = '';
$echoallterm2 = '';
$post_categ = '';
$new_term_list = get_the_terms(get_the_id(), "portcat");
if (is_array($new_term_list)) {
	foreach ($new_term_list as $term) {
		$tempname = strtr($term->name, array(
			' ' => '-',
		));
		$echoallterm .= strtolower($tempname) . " / ";
		$echoallterm2 .= strtolower($tempname) . " ";
		$post_categ .= $tempname . " / ";
		$echoterm = $term->name;
	}
} else {
	$post_categ = 'Uncategorized   ';
}
$post_categ = substr($post_categ, 0, -3);

$layout = 'simple';
$media_state = 'show';
$title_state = 'show';
$categs_state = 'show';
$title_align = 'align_left';
$pft = get_post_format();
$media_height = 555;
$content_position = 'right';

if (isset($gt3_theme_pagebuilder['port']['layout'])) {
	$layout = $gt3_theme_pagebuilder['port']['layout'];
}
if (isset($gt3_theme_pagebuilder['port']['media_state'])) {
	$media_state = $gt3_theme_pagebuilder['port']['media_state'];
}
if (isset($gt3_theme_pagebuilder['port']['title_state'])) {
	$title_state = $gt3_theme_pagebuilder['port']['title_state'];
}
if (isset($gt3_theme_pagebuilder['port']['categs_state'])) {
	$categs_state = $gt3_theme_pagebuilder['port']['categs_state'];
}
if (isset($gt3_theme_pagebuilder['port']['title_align'])) {
	$title_align = $gt3_theme_pagebuilder['port']['title_align'];
}
if (isset($gt3_theme_pagebuilder['port']['media_height'])) {
	$media_height = (int)$gt3_theme_pagebuilder['port']['media_height'];
}
if (isset($gt3_theme_pagebuilder['port']['content_position'])) {
	$content_position = $gt3_theme_pagebuilder['port']['content_position'];
}
$wrapper_class = '';
if ($media_state == 'show') {
	$wrapper_class = 'port_main_wrapper';
}
?>
<div class="site_wrapper fadeOnLoad">
	<div class="main_wrapper <?php echo (($wrapper_class)); ?>">
		<?php if ($layout == 'simple') { ?>
		<div class="port_simple_single_wrapper content_wrapper">
        	<?php 
			if ($media_state == 'show') {
				echo '<div class="port_simple_top '. esc_attr($title_align) .'">';
					if ($title_state == 'show' || $categs_state == 'show') {
						echo '<div class="port_simple_top_content">';
							if ($title_state == 'show') {
								echo '<h1 class="port_simple_top_title">'. get_the_title() .'</h1>';
							}
							if ($categs_state == 'show') {
								echo '<div class="port_simple_top_categs">'. $post_categ .'</div>';
							}
						echo '</div>';
						echo gt3_get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => "1920", "height" => $media_height, "isPort" => true));
					}
				echo '</div>';
			} 
			?>
            <div class="container single_page is_page <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">    
                <div class="content_block row">
                    <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                        <div class="row">
                            <div class="posts-block <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "hasLS" : ""); ?>">
                                <div class="contentarea single_content single_page single_post">
									<?php 
									if ($media_state == 'hide') {
										if ($title_state == 'show' || $categs_state == 'show') {
											echo '<div class="port_simple_title_wrapper '. esc_attr($title_align) .'">';
											if ($title_state == 'show') {
												echo '<h1 class="port_simple_title">'. get_the_title() .'</h1>';
											}
											if ($categs_state == 'show') {
												echo '<div class="port_simple_categs">'. $post_categ .'</div>';
											}
											echo '</div>';
										}
									}
									
									global $gt3_contentAlreadyPrinted;
                                    if ($gt3_contentAlreadyPrinted !== true) {
                                        echo "<article class='contentarea single_contentarea'><h6 class='hidden_title'>".esc_html(get_the_title())."</h6>";
                                        the_content();
                                    }
                                    echo "<div class='clear'></div>";
                                    echo "</article>";													
                                    wp_link_pages(array('before' => '<div class="page-link post-page-nav"><span class="pagger_info_text">' . esc_html__('Pages', 'sohopro') . ': </span>', 'after' => '</div>', 'separator' => '<span class="page_nav_sep"></span>'));
                                    ?>                                
                                    <div class="dn"><?php posts_nav_link(); ?></div>
                                    
                                    <?php if (gt3_get_theme_option('port_comments') == "enabled") {?>
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
		<?php } 
		if ($layout == 'half') { 
			if ($content_position == 'right') {
			?>
			<div class="port_half_single_wrapper content_wrapper">
				<div class="port_half_single_left">
					<div class="port_half_single_left_inner">
						<?php 
						if ($media_state == 'show') {
							echo gt3_get_port_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => "1000", "height" => "1000", "categs_state" => $categs_state, "title_state" => $title_state, "title_align" => $title_align, "categ_text" => $post_categ));
						} else {
							if ($title_state == 'show' || $categs_state == 'show') {
								$compile .=  '<div class="port_half_title_wrapper><div class="port_half_title '. esc_attr($title_align) .'">';
								if ($title_state == 'show') {
									$compile .=  '<h1 class="port_simple_top_title">'. get_the_title() .'</h1>';
								}
								if ($categs_state == 'show') {
									$compile .=  '<div class="port_simple_top_categs">'. $post_categ .'</div>';
								}
								$compile .=  '</div></div>';
							}
						}
						?>
					</div>
				</div>
				<div class="port_half_single_right">
					<div class="port_half_single_right_inner single_page is_page no-sidebar">    
						<div class="content_block row">
							<div class="fl-container">
								<div class="row">
									<div class="posts-block">
										<div class="contentarea single_content single_page single_post">
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
											
											<?php if (gt3_get_theme_option('port_comments') == "enabled") {?>
											<div class="row">
												<div class="span12">
													<?php comments_template(); ?>
												</div>
											</div>
											<?php } ?>
											
										</div><!-- .contentarea -->
									</div>
								</div>
							</div><!-- .fl-container -->
						</div>
					</div>
				</div>
			</div>
        <?php 
			} else {
		?>
	        <div class="port_half_single_wrapper content_wrapper">
				<div class="port_half_single_left">
					<div class="port_half_single_left_inner single_page is_page no-sidebar">    
						<div class="content_block row">
							<div class="fl-container">
								<div class="row">
									<div class="posts-block">
										<div class="contentarea single_content single_page single_post">
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
											
											<?php if (gt3_get_theme_option('port_comments') == "enabled") {?>
											<div class="row">
												<div class="span12">
													<?php comments_template(); ?>
												</div>
											</div>
											<?php } ?>
											
										</div><!-- .contentarea -->
									</div>
								</div>
							</div><!-- .fl-container -->
						</div>
					</div>
				</div>
				<div class="port_half_single_right">
					<div class="port_half_single_right_inner">
						<?php 
						if ($media_state == 'show') {
							echo gt3_get_port_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => "1000", "height" => "1000", "categs_state" => $categs_state, "title_state" => $title_state, "title_align" => $title_align, "categ_text" => $post_categ));
						} else {
							if ($title_state == 'show' || $categs_state == 'show') {
								$compile .=  '<div class="port_half_title_wrapper><div class="port_half_title '. esc_attr($title_align) .'">';
								if ($title_state == 'show') {
									$compile .=  '<h1 class="port_simple_top_title">'. get_the_title() .'</h1>';
								}
								if ($categs_state == 'show') {
									$compile .=  '<div class="port_simple_top_categs">'. $post_categ .'</div>';
								}
								$compile .=  '</div></div>';
							}
						}
						?>
					</div>
				</div>
			</div>
		<?php	
			}
		} ?>

		<div class="single_prev_next_posts port_prev_next_posts">
        	<div class="container">
				<?php 
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                if (!empty($prev_post)) {
                    previous_post_link('<div class="fleft">%link</div>', '<span class="big_arrow_wrapper big_arrow_prev"><span></span></span>' . esc_html__('Prev (P)', 'sohopro') . '<br><span class="port_prev_post_title">'. get_the_title($prev_post->ID) .'</span>');
                }
                echo '<a href="'. esc_js("javascript:history.back()") .'" class="port_back2grid"><span class="port_back2grid_box1"></span><span class="port_back2grid_box2"></span><span class="port_back2grid_box3"></span><span class="port_back2grid_box4"></span></a>';
                if (!empty($next_post)) {
                    next_post_link('<div class="fright">%link</div>', esc_html__('Next (N)', 'sohopro') . '<span class="big_arrow_wrapper big_arrow_next"><span></span></span><br><span class="port_next_post_title">'. get_the_title($next_post->ID) .'</span>');
                }
                ?>
            </div>
        </div><!-- .port_prev_next_posts -->
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