<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_video_popup',
        'name' => esc_html__('Video Popup', 'sohopro'),
        "description" => esc_html__("Video Popup Widget", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", "sohopro"),
                "param_name" => "video_title",
                "description" => esc_html__("Enter title.", "sohopro")
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__("Background Image Video", "sohopro"),
                "param_name" => "bg_image",
                "description" => esc_html__("Select video background image.", "sohopro")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Video Link", "sohopro"),
                "param_name" => "video_link",
                "description" => esc_html__("Enter video link from youtube or vimeo.", "sohopro")
            ),

            /* styling video popup */
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Title color", "sohopro"),
                "param_name" => "title_color",
                "value" => esc_attr(gt3_get_theme_option("theme_color")),
                "description" => esc_html__("Select custom color for title.", "sohopro"),
                "group" => esc_html__( "Styling", 'sohopro' ),
            ),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Button color", "sohopro"),
                "param_name" => "btn_color",
                "value" => esc_attr("#ffffff"),
                "description" => esc_html__("Select custom color for button.", "sohopro"),
                "group" => esc_html__( "Styling", 'sohopro' ),
            ),
            // Video Popup Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for Video Popup title?', 'sohopro' ),
                'param_name' => 'use_theme_fonts_vpopup_title',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_vpopup_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'sohopro' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'sohopro' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_vpopup_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'sohopro' ),
            ),
            // Icon Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Video Popup Content Font Size', 'sohopro'),
                'param_name' => 'title_size',
                'value' => '24',
                'description' => esc_html__( 'Enter Video Popup Title font-size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        ),

    ));

    class WPBakeryShortCode_Gt3_Video_Popup extends WPBakeryShortCode { }

}