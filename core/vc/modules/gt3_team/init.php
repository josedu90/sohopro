<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        "name" => esc_html__("Team", "sohopro"),
        "base" => "gt3_team",
        "category" => esc_html__('GT3 Modules', 'sohopro'),
        "icon" => 'gt3_icon',
        "description" => esc_html__("Display team members","sohopro"),
        "params" => array(
            // Avatar
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'sohopro' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'sohopro' ),
            ),
            // Name
            array(
                "type" => "textfield",
                "heading" => esc_html__("Name", "sohopro"),
                "param_name" => "name",
                "description" => esc_html__("Enter text for team name.", "sohopro")
            ),
            // Position
            array(
                "type" => "textfield",
                "heading" => esc_html__("Position", "sohopro"),
                "param_name" => "position",
                "description" => esc_html__("Enter text for team position.", "sohopro")
            ),
            // Text
            array(
                "type" => "textarea",
                "heading" => esc_html__("Text", "sohopro"),
                "param_name" => "text",
                "description" => esc_html__("Enter text.", "sohopro")
            ),
            // Custom Html
            array(
                'type' => 'textarea_raw_html',
                'holder' => '',
                'heading' => esc_html__("Custom HTML (Socials)", "sohopro"),
                'param_name' => 'content',
                'value' => '<ul><li><a href="#"><i class="fa fa-dribbble"></i></a></li><li><a href="#"><i class="fa fa-skype"></i></a></li><li><a href="#"><i class="fa fa-facebook-square"></i></a></li><li><a href="#"><i class="fa fa-twitter"></i></a></li></ul>',
                'description' => __( 'Enter your HTML content.', 'sohopro' ),
            ),
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_team extends WPBakeryShortCode {
        }
    } 
}
