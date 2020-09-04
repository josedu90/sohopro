<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Icon Box", "sohopro"),
        "base" => "gt3_icon_box",
        "class" => "gt3_icon_box",
        "category" => esc_html__('GT3 Modules', 'sohopro'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Icon Box","sohopro"),
        "params" => array(
            // Icon Section
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Type', 'sohopro' ),
                "param_name"    => "icon_type",
                "value"         => array(
                    esc_html__( 'None', 'sohopro' )      => 'none',
                    esc_html__( 'Font', 'sohopro' )      => 'font',
                    esc_html__( 'Image', 'sohopro' )     => 'image',
                ),
                'save_always' => true,
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'sohopro' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'sohopro' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'sohopro' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'sohopro' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array( 'image' ),
                ),
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Position', 'sohopro' ),
                "param_name"    => "icon_position",
                "value"         => array(
                    esc_html__( 'Top', 'sohopro' )               => 'top',
                    esc_html__( 'Left', 'sohopro' )              => 'left',
                    esc_html__( 'Right', 'sohopro' )             => 'right',
                    esc_html__('Inline with Title', 'sohopro')   => 'inline_title'
                ),
                'save_always' => true,
            ),
            // Content alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content alignment', 'sohopro' ),
                'param_name' => 'content_alignment',
                "value"         => array(
                    esc_html__( 'Center', 'sohopro' ) => 'center',
                    esc_html__( 'Left', 'sohopro' ) => 'left',
                    esc_html__( 'Right', 'sohopro' ) => 'right',
                    esc_html__( 'Justify', 'sohopro' ) => 'justify'
                ),
                "description" => esc_html__("Select content alignment.", "sohopro"),
                'dependency' => array(
                    'element' => 'icon_position',
                    'value' => array( 'top' ),
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Heading", "sohopro"),
                "param_name" => "heading",
                "description" => esc_html__("Enter text for heading line.", "sohopro")
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Text", "sohopro"),
                "param_name" => "text",
                "description" => esc_html__("Enter text.", "sohopro")
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Link', 'sohopro' ),
                "param_name"    => "url",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Link Text', 'sohopro' ),
                "param_name"    => "url_text",
            ),            
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Open in New Tab', 'sohopro' ),
                "param_name"    => "new_tab",
                'save_always' => true,
            ),
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Icon in circle', 'sohopro' ),
                "param_name"    => "icon_circle",
                'save_always' => true,
            ),
             array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Circle Color', 'sohopro' ),
                "param_name"    => "circle_bg",
                "value"         => '#212125',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_circle',
                    'value' => "true",
                ),
            ),
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Add divider after Heading', 'sohopro' ),
                "param_name"    => "add_divider",
                'std' => '',
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Divider Color', 'sohopro' ),
                "param_name"    => "divider_color",
                "value"         => esc_attr(gt3_get_theme_option('theme_color')),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'add_divider',
                    'value' => "true",
                ),
            ),
            vc_map_add_css_animation( true ),
            // Styling
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Size', 'sohopro' ),
                "param_name"    => "icon_size",
                "value"         => array(
                    esc_html__( 'Regular', 'sohopro' )   => 'regular',
                    esc_html__( 'Mini', 'sohopro' )      => 'mini',
                    esc_html__( 'Small', 'sohopro' )     => 'small',
                    esc_html__( 'Large', 'sohopro' )     => 'large',
                    esc_html__( 'Huge', 'sohopro' )      => 'huge',
                    esc_html__( 'Custom', 'sohopro')     => 'custom'
                ),              
                "group"         => esc_html__( "Styling", 'sohopro' ),
                'save_always' => true,
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'sohopro'),
                'param_name' => 'custom_icon_size',
                'value' => '42',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'dependency' => array(
                    'element' => 'icon_size',
                    'value' => 'custom',
                ),
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Color', 'sohopro' ),
                "param_name"    => "icon_color",
                "group"         => esc_html__( "Styling", 'sohopro' ),
                "value"         => esc_attr(gt3_get_theme_option('theme_color')),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'edit_field_class' => 'vc_col-sm-6',
                "description" => esc_html__("Select color for this item.", "sohopro"),
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Title Tag', 'sohopro' ),
                "param_name"    => "title_tag",
                "value"         => array(
                    esc_html__( 'H3', 'sohopro' )    => 'h3',
                    esc_html__( 'H2', 'sohopro' )    => 'h2',
                    esc_html__( 'H4', 'sohopro' )    => 'h4',
                    esc_html__( 'H5', 'sohopro' )    => 'h5',
                    esc_html__( 'H6', 'sohopro' )    => 'h6',
                ),
                'save_always' => true,
                "group"         => esc_html__( "Styling", 'sohopro' ),
            ),
            // Icon Box title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Box Title Font Size', 'sohopro'),
                'param_name' => 'iconbox_title_size',
                'value' => '24',
                'description' => esc_html__( 'Enter Icon Box title font-size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for iconbox title?', 'sohopro' ),
                'param_name' => 'use_theme_fonts_iconbox_title',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'sohopro' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'sohopro' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_iconbox_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'sohopro' ),
            ),
            // Icon Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Box Content Font Size', 'sohopro'),
                'param_name' => 'iconbox_content_size',
                'value' => esc_attr(gt3_get_theme_option('content_font_size')),
                'description' => esc_html__( 'Enter Icon Box content font-size in pixels.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox content Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for iconbox content?', 'sohopro' ),
                'param_name' => 'use_theme_fonts_iconbox_content',
                'value' => array( esc_html__( 'Yes', 'sohopro' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'sohopro' ),
                "group" => esc_html__( "Styling", 'sohopro' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'sohopro' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'sohopro' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_iconbox_content',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'sohopro' ),
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Title Color', 'sohopro' ),
                "param_name"    => "title_color",
                "group"         => esc_html__( "Styling", 'sohopro' ),
                "value"         => esc_attr(gt3_get_theme_option('h1h3_color')),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Text Color', 'sohopro' ),
                "param_name"    => "text_color",
                "group"         => esc_html__( "Styling", 'sohopro' ),
                "value"         => esc_attr(gt3_get_theme_option('text_color')),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Link Color', 'sohopro' ),
                "param_name"    => "link_color",
                "group"         => esc_html__( "Styling", 'sohopro' ),
                "value"         => esc_attr(gt3_get_theme_option('theme_color')),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Link Hover Color', 'sohopro' ),
                "param_name"    => "link_hover_color",
                "group"         => esc_html__( "Styling", 'sohopro' ),
                "value"         => esc_attr(gt3_get_theme_option('text_color')),
                'save_always' => true,
            ),                
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_icon_box extends WPBakeryShortCode {
        }
    } 
}
