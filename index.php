
<?php
get_header();
#Emulate default settings for page without personal ID
$gt3_theme_pagebuilder = gt3_get_default_pb_settings();
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];
?>
<div class="site_wrapper fadeOnLoad">
	<div class="main_wrapper">
		<div class="container">
			<div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
				<div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
					<?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "<div class='row'>" : ""); ?>
						<div class="posts-block <?php echo("left-sidebar" == $gt3_theme_pagebuilder['settings']['layout-sidebars'] ? "hasLS" : ""); ?>">
							<div class="contentarea">
								<?php
									echo '<div class="row"><div class="col-sm-12 gt3_blog_listing">';
									while (have_posts()) : the_post();
										get_template_part("bloglisting");
									endwhile;
									wp_reset_postdata();
									echo "<div class='default_pager'>" . gt3_get_theme_pagination() ."</div>";
									echo '</div><div class="clear"></div></div>';
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
	</div>
</div>
<?php get_footer(); ?>