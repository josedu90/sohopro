<?php

$defaults = array(
    'item_el_class' => '',
    'css' => '',
    'css_animation' => '',
    'autoplay_carousel' => 'yes',
    'auto_play_time' => '3000',
    'use_pagination_carousel' => 'yes',
    'crop_img_size_for_iphone' => 'yes',
    'images' => '',
    'onclick' => '',
    'custom_links' => '',
    'slider_style' => '',
    'margin_between_slides' => '0',
    'custom_links_target' => '',
    'img_size' => 'thumbnail'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

if ($onclick == 'link_image') {
    wp_enqueue_script('gt3_swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
}

if ($slider_style == 'iphone_view') {
    $default_src = get_template_directory_uri() . '/img/modules/iphone_type_no_image.png';
} else {
    $default_src = vc_asset_url( 'vc/no_image.png' );
}

$gal_images = '';
$link_start = '';
$link_end = '';
$el_start = '<div class="slider_item_thumb"><div class="slider_item_inner">';
$el_end = '</div></div>';

$iphone_visibility_status = $crop_for_iphone = '';

if ($slider_style == 'iphone_view') {
    $iphone_visibility_status = 'iphone_visible';
}

if ($crop_img_size_for_iphone == 'yes' && $slider_style == 'iphone_view') {
    $crop_for_iphone = 'crop_for_iphone_enable';
}

$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

// Animation
if (! empty($atts['css_animation'])) {
    $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
} else {
    $animation_class = '';
}

$carousel_parent = 'gt3_module_carousel';

$auto_play_time = (int)$auto_play_time;

wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

$slick_settings = '';

$slick_settings .= '"slidesToShow": 1,';

$slick_settings .= '"centerMode": true,';

$slick_settings .= '"variableWidth": true,';

$slick_settings .= '"speed": 400,';

if ($autoplay_carousel == 'yes') {
    $slick_settings .= '"autoplay": true,';
} else {
    $slick_settings .= '"autoplay": false,';
}

$slick_settings .= isset($auto_play_time) ? '"autoplaySpeed": '.esc_attr($auto_play_time).',' : '"autoplaySpeed": 3000,';

$slick_settings .= '"infinite": true,';

$slick_settings .= '"focusOnSelect": true,';

$slick_settings .= '"arrows": false,';

if ($use_pagination_carousel == 'yes') {
    $slick_settings .= '"dots": false';
} else {
    $slick_settings .= '"dots": true';
}

if ('' === $images ) {
    $images = '-1,-2,-3';
}

if ( 'custom_link' === $onclick ) {
    $custom_links = vc_value_from_safe( $custom_links );
    $custom_links = explode( ',', $custom_links );
}

$images = explode( ',', $images );

if (gt3_get_theme_option("color_scheme") == 'light') {
    $skin_style = 'light';
} else {
    $skin_style = 'dark';
}

?>
<div class="vc_row">
    <div class="vc_col-sm-12 gt3_module_image_slider gt3_skin_style_<?php echo esc_attr($skin_style); ?> margin_between_slides_<?php echo esc_attr($margin_between_slides); ?> <?php echo esc_attr($iphone_visibility_status); ?> <?php echo esc_attr($crop_for_iphone); ?> <?php echo esc_attr($carousel_parent); ?> <?php echo esc_attr($animation_class); ?> <?php echo esc_attr($css_class); ?>">
        <div class="gt3_carousel_list" data-slick="{<?php echo esc_attr($slick_settings); ?>}">
        <?php
            foreach ( $images as $i => $image ) {
                if ( $image > 0 ) {
                    $img = wpb_getImageBySize( array(
                        'attach_id' => $image,
                        'thumb_size' => $img_size,
                    ));
                    if ($crop_img_size_for_iphone == 'yes' && $slider_style == 'iphone_view') {
                        $img = wpb_getImageBySize( array(
                            'attach_id' => $image,
                            'thumb_size' => '276x490',
                        ));
                    }
                    $thumbnail = $img['thumbnail'];
                    $large_img_src = $img['p_img_large'][0];
                } else {
                    $large_img_src = $default_src;
                    $thumbnail = '<img src="' . $default_src . '" />';
                }

                switch ( $onclick ) {
                    case 'link_image':
                        $link_start = '<a class="swipebox" href="' . $large_img_src . '">';
                        $link_end = '</a>';
                        break;

                    case 'custom_link':
                        if ( ! empty( $custom_links[ $i ] ) ) {
                            $link_start = '<a href="' . $custom_links[ $i ] . '"' . ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) . '>';
                            $link_end = '</a>';
                        }
                        break;
                }
                $gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
            }

            $compile .= $gal_images;

            echo (($compile));
        ?>
        </div>
        <?php
            if ($slider_style == 'iphone_view') {
                echo '<div class="gt3_module_iphone_left"></div><div class="gt3_module_iphone_top"></div><div class="gt3_module_iphone_right"></div><div class="gt3_module_iphone_bottom"></div>';
            }
        ?>
    </div>
</div>