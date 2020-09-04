<?php get_header(); ?>
	<div class="gt3_404_page_bg"></div>
	<div class="wrapper_404 fadeOnLoad">
		<div class="title_404">
			<div><?php echo esc_html__('404', 'sohopro'); ?></div>
			<?php echo esc_html__('Oops! Page not found!', 'sohopro'); ?>
		</div>
		<div class="content_404"><?php echo esc_html__("Either Something Get Wrong or the Page Doesn't Exist Anymore.", "sohopro"); ?></div>
		<?php get_search_form(); ?>
        <div class="gt3_module_button button_alignment_center">
			<a class="shortcode_button button_size_large" href="<?php echo esc_url(home_url('/')); ?>"><span><?php echo esc_html__('take me home', 'sohopro'); ?></span></a>
        </div>
	</div>
<?php get_footer('none'); ?>