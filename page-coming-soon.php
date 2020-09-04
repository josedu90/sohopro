<?php
/*
Template Name: Countdown Template
*/
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
the_post();
wp_enqueue_script('gt3_countdown_js', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), false, true);
if (isset($gt3_theme_pagebuilder['countdown']['year'])) $year = esc_attr($gt3_theme_pagebuilder['countdown']['year']);
if (isset($gt3_theme_pagebuilder['countdown']['day'])) $day = esc_attr($gt3_theme_pagebuilder['countdown']['day']);
if (isset($gt3_theme_pagebuilder['countdown']['month'])) $month = esc_attr($gt3_theme_pagebuilder['countdown']['month']);
if (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'])) $img_attachment = wp_get_attachment_image_src($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'], "full");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php echo((gt3_get_theme_option("responsive") == "on") ? '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' : ''); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<?php gt3_has_site_icon(); ?>
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php 
		if (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']) && $gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'] !== '') {
			$bg_src = wp_get_attachment_url($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']);
		} else {
			if (wp_get_attachment_url(gt3_get_theme_option("bg_img_cs"))) {
				$bg_src = wp_get_attachment_url(gt3_get_theme_option("bg_img_cs"));
			} else {
				$bg_src = gt3_get_theme_option("bg_img_cs");
			}
		}
		echo "<div class='bg_commingsoon gt3_js_bg_img' data-src='". esc_url($bg_src) ."'></div>";		
	?>
    <div class="cs_logo">
        <?php if (wp_get_attachment_url(gt3_get_theme_option("logo"))) { ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img
                    src="<?php echo esc_url(wp_get_attachment_url(gt3_get_theme_option("logo"))); ?>" alt="<?php echo esc_html__('logo', 'sohopro'); ?>"
                    width="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_width")); ?>"
                    height="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_height")); ?>" class="logo_img"></a>
        <?php } else { ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img
                    src="<?php echo esc_url(gt3_get_theme_option("logo")); ?>" alt="<?php echo esc_html__('logo', 'sohopro'); ?>"
                    width="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_width")); ?>"
                    height="<?php echo esc_attr(gt3_get_theme_option("header_logo_standart_height")); ?>" class="logo_img"></a>
        <?php } ?>
    </div><!-- .logo -->
    <div class="global_count_wrapper">
    	<?php if (isset($gt3_theme_pagebuilder['countdown']['count_title']) && $gt3_theme_pagebuilder['countdown']['count_title'] !== '') {
			echo '<div class="count_title">'. esc_attr($gt3_theme_pagebuilder['countdown']['count_title']) .'</div>';
        } else {
			echo '<div class="count_title">'. esc_html(get_the_title()) .'</div>';
		} ?>
        					
        <?php if (isset($year) && isset($day) && isset($month) && $year !== "" && $day !== "" && $month !== "") { 
			$label_years = esc_html__('Years', 'sohopro');
			$label_months = esc_html__('Months', 'sohopro');
			$label_weeks = esc_html__('Weeks', 'sohopro');
			$label_days = esc_html__('Days', 'sohopro');
			$label_hours = esc_html__('Hours', 'sohopro');
			$label_minutes = esc_html__('Minutes', 'sohopro');
			$label_seconds = esc_html__('Seconds', 'sohopro');

			$label_year = esc_html__('Year', 'sohopro');
			$label_month = esc_html__('Month', 'sohopro');
			$label_week = esc_html__('Week', 'sohopro');
			$label_day = esc_html__('Day', 'sohopro');
			$label_hour = esc_html__('Hour', 'sohopro');
			$label_minute = esc_html__('Minute', 'sohopro');
			$label_second = esc_html__('Second', 'sohopro');
		?>
			<div class="countdown_wrapper">
                <div id="countdown">
                </div>                
            </div>
            <script>
			   jQuery(function () {
					var austDay = new Date(<?php echo (($year)) ?>, <?php echo (($month)) ?>-1, <?php echo (($day)) ?>); //year, month-1, day
					jQuery('#countdown').countdown({
						until: austDay,
						labels: ['<?php echo (($label_years)); ?>','<?php echo (($label_months)); ?>','<?php echo (($label_weeks)); ?>','<?php echo (($label_days)); ?>','<?php echo (($label_hours)); ?>','<?php echo (($label_minutes)); ?>','<?php echo (($label_seconds)); ?>'],
						labels1:['<?php echo (($label_year)); ?>','<?php echo (($label_month)); ?>','<?php echo (($label_week)); ?>','<?php echo (($label_day)); ?>','<?php echo (($label_hour)); ?>','<?php echo (($label_minute)); ?>','<?php echo (($label_second)); ?>'],
						padZeroes: true
					});
				});
			</script>
        <?php } else { ?>
            <div class="countdown_wrapper">
                <h1 class="count_error light"><?php esc_html_e('Date has not been entered', 'sohopro'); ?></h1>
            </div>
        <?php } ?>
            
		<div class="count_container_wrapper">
            <div class="container">
            	<div class="shortcode_subscribe">
                    <div class="shortcode_title"><?php echo esc_attr($gt3_theme_pagebuilder['countdown']['shortcode_title']); ?></div>
                    <?php if (isset($gt3_theme_pagebuilder['countdown']['shortcode']) && $gt3_theme_pagebuilder['countdown']['shortcode'] !== '') { ?>
                        <?php echo do_shortcode($gt3_theme_pagebuilder['countdown']['shortcode']) ?>
                    <?php } ?>
                </div>                     
            </div>
        </div><!-- .count_container_wrapper -->
    </div>
    <div class="gt3_socials_wrapper">
        <div class="gt3_socials_inner">
            <?php
            if (strlen(gt3_get_theme_option("custom_social_icons")) > 0) {
                echo '<div class="gt3_custom_socials">';
                echo gt3_get_theme_option("custom_social_icons");
                echo '</div>';
            } else {
                echo '<ul class="gt3_socials">';
                echo gt3_show_social_icons(array(
                    array(
                        "uniqid" => "social_twitter",
                        "class" => "twitter",
                        "title" => esc_html__('Twitter', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_facebook",
                        "class" => "facebook",
                        "title" => esc_html__('Facebook', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_gplus",
                        "class" => "gplus",
                        "title" => esc_html__('Google+', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_instagram",
                        "class" => "instagram",
                        "title" => esc_html__('Instagram', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_dribbble",
                        "class" => "dribbble",
                        "title" => esc_html__('Dribbble', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_pinterest",
                        "class" => "pinterest",
                        "title" => esc_html__('Pinterest', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_youtube",
                        "class" => "youtube",
                        "title" => esc_html__('Youtube', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_tumblr",
                        "class" => "tumblr",
                        "title" => esc_html__('Tumblr', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_linked_in",
                        "class" => "linkedin",
                        "title" => esc_html__('Linked In', 'sohopro'),
                        "target" => "_blank",
                    ),
                    array(
                        "uniqid" => "social_flickr",
                        "class" => "flickr",
                        "title" => esc_html__('Flickr', 'sohopro'),
                        "target" => "_blank",
                    )
                ));
                echo '</ul>';
            }
            ?>
        </div>
    </div>
<?php
    wp_footer();
?>
	</body>
</html>