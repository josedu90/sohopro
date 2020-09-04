<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_price_block',
        'name' => esc_html__('Price Block', 'sohopro'),
        "description" => esc_html__("Create price table", "sohopro"),
        'category' => esc_html__('GT3 Modules', 'sohopro'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Name", "sohopro"),
                "param_name" => "title",
                "description" => esc_html__("Enter title of price block.", "sohopro")
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Active package', 'sohopro'),
                'param_name' => 'package_is_active',
                'admin_label' => true,
                'value' => array(
                    esc_html__("No", "sohopro") => 'no',
                    esc_html__("Yes", "sohopro") => 'yes',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Price", "sohopro"),
                "param_name" => "price",
                "description" => esc_html__("Enter the price for this package. e.g. '157'", "sohopro")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Price Prefix", "sohopro"),
                "param_name" => "price_prefix",
                "description" => esc_html__("Enter the price prefix for this package. e.g. '$'", "sohopro")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Price Suffix", "sohopro"),
                "param_name" => "price_suffix",
                "description" => esc_html__("Enter the price suffix for this package. e.g. '$'", "sohopro")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package description", "sohopro"),
                "param_name" => "price_description",
                "description" => esc_html__("Enter the package short description", "sohopro")
            ),
            array(
                "type" => "vc_link",
                "heading" => esc_html__("Link", "sohopro"),
                "param_name" => "button_link",
            ),
            array(
                "type" => "textarea_html",
                "heading" => esc_html__("Price field", "sohopro"),
                "param_name" => "content",
            ),
            // General Params
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "sohopro"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "sohopro")
            ),

        ),

    ));

    class WPBakeryShortCode_Gt3_Price_block extends WPBakeryShortCode { }

}