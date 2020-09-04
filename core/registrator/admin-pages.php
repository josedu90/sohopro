<?php

function theme_add_admin()
{
    #Settings page
    #add_menu_page(GT3_THEMENAME, GT3_THEMENAME, 'administrator', GT3_THEMESHORT . 'options', 'theme_options', false, '210');
    add_theme_page( GT3_THEMENAME, GT3_THEMENAME, 'administrator', GT3_THEMESHORT . 'options', 'theme_options' );
}

add_action('admin_menu', 'theme_add_admin');