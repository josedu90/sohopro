<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php echo((gt3_get_theme_option("responsive") == "on") ? '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' : ''); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<?php gt3_has_site_icon(); ?>
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
    <?php echo gt3_get_if_strlen(gt3_get_theme_option("code_before_head")); ?>
	<?php wp_head(); ?>
</head>
<?php 
	$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(@get_the_ID()); 		
?>
<body <?php body_class(); ?>>
	<?php gt3_get_main_header($gt3_theme_pagebuilder); ?>
    <?php gt3_get_mobile_header($gt3_theme_pagebuilder); ?>
    <div class="gt3_left_bar">
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
    <div class="gt3_right_bar"></div>