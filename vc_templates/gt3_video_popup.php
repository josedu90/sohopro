<?php 
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$defaults = array(
    'video_title' => '',
    'bg_image' => '',
    'video_link' => '#',
    'title_color' => esc_attr(gt3_get_theme_option("theme_color")),
    'btn_color' => '#ffffff',
    'title_size' => ''
);

wp_enqueue_script('gt3_swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

// Render Google Fonts
$obj = new GoogleFontsRender();
extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_vpopup_title') ) );

if ( ! empty( $styles_google_fonts_vpopup_title ) ) {
	$vpopup_title_font = '' . esc_attr( $styles_google_fonts_vpopup_title ) . ';';
} else {
	$vpopup_title_font = '';
}

// Font Size of Title
if ($title_size != '') {
	$title_size = 'font-size: ' . $title_size . 'px;line-height:'.$title_size * 1.5.'px;';
} else {
	$title_size = ' ';
}

$title_color = !empty($title_color) ? 'color: '.$title_color.';' : '';
$title_style = !empty($title_color) || !empty($title_size) || !empty($vpopup_title_font) ? 'style="'.esc_attr($title_color).$vpopup_title_font.esc_attr($title_size).'"' : '';
$video_title = !empty($video_title) ? '<h2 class="video-popup__title" '.$title_style.' >'.$video_title.'</h2>' : '';

if ( empty($bg_image) ):
	?>
	<div class="video-popup-wrapper">
		<?php echo (($video_title)); ?>
		<a class="video-popup__link swipebox-video" href="<?php echo esc_url($video_link); ?>" style="color: <?php echo esc_attr($btn_color)?>;"></a>
	</div>
	<?php 
else:
	?>
	<div class="video-popup-wrapper">
		<div class="video-popup__responsive-title"><?php echo (($video_title)); ?></div>
		<a href="<?php echo esc_url($video_link); ?>" class="video-popup__wrapper-link with-img swipebox-video">
			<?php echo wp_get_attachment_image( $bg_image , 'full');?>
			<div class="video-popup__content">
				<?php echo (($video_title)); ?>
				<span class="video-popup__link" style="color: <?php echo esc_attr($btn_color)?>;"></span>
			</div>
			
		</a>
	</div>
<?php
endif;