<?php

$gt3_tabs_admin_theme = new Tabs_admin_theme();

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'General',
    'icon' => 'fa fa-cogs'
), array(
    new image_admin_theme(array(
        'name' => 'Header logo',
        'id' => 'logo',
        'button_caption' => 'Add Image',
        'desc' => '<span class="gt3_help_block">Retina Default: 194px x 158px</span>',
        'default' => THEMEROOTURL . '/img/logo.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Header logo width',
        'id' => 'header_logo_standart_width',
        'not_empty' => true,
        'default' => '79',
        'min' => '10',
        'max' => '500',
        'step' => '1',
		'unit' => 'px',
        'desc' => '<span class="gt3_help_block">Default: 186px</span>',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-right: 10px;'
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Header logo height',
        'id' => 'header_logo_standart_height',
        'not_empty' => true,
        'default' => '19',
        'min' => '10',
        'max' => '200',
        'step' => '1',
		'unit' => 'px',
        'desc' => '<span class="gt3_help_block">Default: 37px</span>',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-left: 10px;'
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Favicon',
        'id' => 'favicon',
        'desc' => '<span class="gt3_help_block">Icon must be 16x16px or 32x32px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.</span>',
        'default' => THEMEROOTURL . '/img/fav.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (57px)',
        'id' => 'apple_touch_57',
        'desc' => '<span class="gt3_help_block">Icon must be 57x57px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.</span>',
        'default' => THEMEROOTURL . '/img/apple_icons_57x57.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (72px)',
        'id' => 'apple_touch_72',
        'desc' => '<span class="gt3_help_block">Icon must be 72x72px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.</span>',
        'default' => THEMEROOTURL . '/img/apple_icons_72x72.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (114px)',
        'id' => 'apple_touch_114',
        'desc' => '<span class="gt3_help_block">Icon must be 114x114px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.</span>',
        'default' => THEMEROOTURL . '/img/apple_icons_114x114.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Any other code (before &lt;/head&gt;)',
        'id' => 'code_before_head',
		'desc' => '',
        'default' => '',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Any code (before &lt;/body&gt;)',
        'id' => 'code_before_body',
		'desc' => '<span class="gt3_help_block">You can use any code on the page which is required to be placed before &lt;/body&gt;.</span>',
        'default' => '',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Sidebars',
    'icon' => 'fa fa-trello'
), array(
    new SelectOption_admin_theme(array(
        'name' => 'Default sidebar layout',
        'id' => 'default_sidebar_layout',
        'default' => 'no-sidebar',
        'options' => array(
            'left-sidebar' => 'Left sidebar',
            'right-sidebar' => 'Right sidebar',
            'no-sidebar' => 'Without sidebar'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SidebarManager_admin_theme(array(
        'name' => 'Sidebar manager',
        'id' => 'sidebar_manager',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Fonts',
    'icon' => 'fa fa-font'
), array(
    new FontSelector_admin_theme(array(
        'name' => 'Main font',
        'id' => 'main_font',
        'default' => 'Montserrat',
        'options' => get_fonts_array_only_key_name(),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Main font parameters',
        'id' => 'google_font_parameters_main_font',
        'not_empty' => true,
        'default' => ':300,300italic,400,700',
        'width' => '100%',
        'textalign' => 'left',
        'desc' => '<span class="gt3_help_block">Google font. Click <a href="https://developers.google.com/webfonts/docs/getting_started" target="_blank">here</a> for help.</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),

    new FontSelector_admin_theme(array(
        'name' => 'Headings font',
        'id' => 'headings_font',
        'default' => 'Montserrat',
        'options' => get_fonts_array_only_key_name(),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Headings font parameters',
        'id' => 'google_font_parameters_headings_font',
        'not_empty' => true,
        'default' => ':700',
        'width' => '100%',
        'textalign' => 'left',
        'desc' => '<span class="gt3_help_block">Google font. Click <a href="https://developers.google.com/webfonts/docs/getting_started" target="_blank">here</a> for help.</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new textOption_admin_theme(array(
        'name' => 'Headings font-weight',
        'id' => 'headings_font_weight',
        'not_empty' => true,
        'default' => '700',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),	
    new textOption_admin_theme(array(
        'name' => 'H1 font-size',
        'id' => 'h1_font_size',
        'not_empty' => true,
        'default' => '72px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H1 line-height',
        'id' => 'h1_line_height',
        'not_empty' => true,
        'default' => '74px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H2 font-size',
        'id' => 'h2_font_size',
        'not_empty' => true,
        'default' => '36px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H2 line-height',
        'id' => 'h2_line_height',
        'not_empty' => true,
        'default' => '38px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H3 font-size',
        'id' => 'h3_font_size',
        'not_empty' => true,
        'default' => '24px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H3 line-height',
        'id' => 'h3_line_height',
        'not_empty' => true,
        'default' => '26px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H4 font-size',
        'id' => 'h4_font_size',
        'not_empty' => true,
        'default' => '18px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H4 line-height',
        'id' => 'h4_line_height',
        'not_empty' => true,
        'default' => '20px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H5 font-size',
        'id' => 'h5_font_size',
        'not_empty' => true,
        'default' => '16px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H5 line-height',
        'id' => 'h5_line_height',
        'not_empty' => true,
        'default' => '18px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H6 font-size',
        'id' => 'h6_font_size',
        'not_empty' => true,
        'default' => '13px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H6 line-height',
        'id' => 'h6_line_height',
        'not_empty' => true,
        'default' => '15px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new textOption_admin_theme(array(
        'name' => 'Main menu font size',
        'id' => 'main_menu_font_size',
        'not_empty' => true,
        'default' => '18px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Main menu font size',
        'id' => 'main_menu_font_weight',
        'not_empty' => true,
        'default' => '300',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new textOption_admin_theme(array(
        'name' => 'Sub-menu font size',
        'id' => 'sub_menu_font_size',
        'not_empty' => true,
        'default' => '14px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),

	new textOption_admin_theme(array(
        'name' => 'Content font-size',
        'id' => 'content_font_size',
        'not_empty' => true,
        'default' => '16px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new textOption_admin_theme(array(
        'name' => 'Content line-height',
        'id' => 'content_line_height',
        'not_empty' => true,
        'default' => '30px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new textOption_admin_theme(array(
        'name' => 'Content font-weight',
        'id' => 'content_font_weight',
        'not_empty' => true,
        'default' => '300',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Default <P> bottom margin',
        'id' => 'p_bottom_margin',
        'not_empty' => true,
        'default' => '27px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))	
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Socials',
    'icon' => 'fa fa-users'
), array(
    new TextOption_admin_theme(array(
        'name' => 'Flickr',
        'id' => 'social_flickr',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Pinterest',
        'id' => 'social_pinterest',
        'default' => 'https://pinterest.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'YouTube',
        'id' => 'social_youtube',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Instagram',
        'id' => 'social_instagram',
        'default' => 'https://instagram.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Dribbble',
        'id' => 'social_dribbble',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Facebook',
        'id' => 'social_facebook',
        'default' => 'http://facebook.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Twitter',
        'id' => 'social_twitter',
        'default' => 'http://twitter.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'LinkedIn',
        'id' => 'social_linked_in',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Tumblr',
        'id' => 'social_tumblr',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Google Plus',
        'id' => 'social_gplus',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Custom Social Icons',
        'id' => 'custom_social_icons',
        'desc' => '<span class="gt3_help_block">You can use the standard set of social icons or fill the box below in an arbitrary form.<br>Example:<br> &lt;ul&gt;&lt;li&gt;&lt;a target="_blank" href="http://twitter.com" title="Twitter"&gt;Twitter&lt;span class="bullet" style="background: #28b8dc"&gt;&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt;</span>',
        'default' => '',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'View Options',
    'icon' => 'fa fa-file-image-o'
), array(
    new SelectOption_admin_theme(array(
        'name' => 'Responsive',
        'id' => 'responsive',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Color Scheme',
        'id' => 'color_scheme',
        'default' => 'dark',
        'options' => array(
            'dark' => 'Dark',
            'light' => 'Light'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Title Area',
        'id' => 'show_title_area',
        'default' => 'yes',
        'options' => array(
            'yes' => 'Show',
            'no' => 'Hide'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Related Posts',
        'id' => 'related_posts',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Post comments',
        'id' => 'post_comments',
        'default' => 'enabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),	
    new SelectOption_admin_theme(array(
        'name' => 'Post likes button',
        'id' => 'post_likes',
        'default' => 'show',
        'options' => array(
            'hide' => 'Hide',
            'show' => 'Show'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Portfolio comments',
        'id' => 'port_comments',
        'default' => 'disabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),	
    new SelectOption_admin_theme(array(
        'name' => 'Page comments',
        'id' => 'page_comments',
        'default' => 'enabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Trackbacks and Pingbacks',
        'id' => 'post_pingbacks',
        'default' => 'disabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),

    new image_admin_theme(array(
        'type' => 'upload',
        'name' => '404 Page Background Image',
        'id' => 'bg_img_404',
        'default' => get_template_directory_uri() . '/img/bgs/bg_404.jpg',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Coming Soon Background Image',
        'id' => 'bg_img_cs',
        'default' => get_template_directory_uri() . '/img/bgs/bg_cs.jpg',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Password Protected Background Image',
        'id' => 'bg_img_pp',
        'default' => get_template_directory_uri() . '/img/bgs/bg_pp.jpg',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Pre-Footer Shortcode',
        'id' => 'prefooter_shortcode_status',
        'default' => 'enabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Header Search Icon (Form)',
        'id' => 'header_search_icon_status',
        'default' => 'enabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Color Options Dark',
    'icon' => 'fa fa-paint-brush'
), array(
    new ColorOption_admin_theme(array(
        'name' => 'Theme Color 1',
        'id' => 'theme_color',
        'not_empty' => 'true',
        'default' => '#e56e6e',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Body Background',
        'id' => 'body_bg',
        'not_empty' => 'true',
        'default' => '#11151b',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Header Background',
        'id' => 'header_bg',
        'not_empty' => 'true',
        'default' => '#11151b',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Header Text Color',
        'id' => 'header_color',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Social Icons Color',
        'id' => 'header_socials',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Main Menu Color',
        'id' => 'menu_color',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Main Menu Hover',
        'id' => 'menu_hover',
        'not_empty' => 'true',
        'default' => '#e56e6e',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Background',
        'id' => 'submenu_bg',
        'not_empty' => 'true',
        'default' => '#232933',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Color',
        'id' => 'submenu_color',
        'not_empty' => 'true',
        'default' => '#a0acba',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Hover',
        'id' => 'submenu_hover',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'H1-H3 Color',
        'id' => 'h1h3_color',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'H4-H6 Color',
        'id' => 'h4h6_color',
        'not_empty' => 'true',
        'default' => '#a0acba',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Main Text Color',
        'id' => 'text_color',
        'not_empty' => 'true',
        'default' => '#a0acba',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Additional Text Color',
        'id' => 'additional_text_color',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Links Color',
        'id' => 'links_color',
        'not_empty' => 'true',
        'default' => '#e56e6e',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Hovered Links Color',
        'id' => 'links_color2',
        'not_empty' => 'true',
        'default' => '#a0acba',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	
    new ColorOption_admin_theme(array(
        'name' => 'Footer Background',
        'id' => 'footer_bg',
        'not_empty' => 'true',
        'default' => '#0b0f14',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Footer Text Color',
        'id' => 'footer_text_color',
        'not_empty' => 'true',
        'default' => '#909aa3',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Footer Headings Color',
        'id' => 'footer_headings_color',
        'not_empty' => 'true',
        'default' => '#a0acba',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
)));

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Color Options Light',
    'icon' => 'fa fa-paint-brush'
), array(
    new ColorOption_admin_theme(array(
        'name' => 'Theme Color 1',
        'id' => 'theme_color_light',
        'not_empty' => 'true',
        'default' => '#e56e6e',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Body Background',
        'id' => 'body_bg_light',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Header Background',
        'id' => 'header_bg_light',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Header Text Color',
        'id' => 'header_color_light',
        'not_empty' => 'true',
        'default' => '#28313f',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Social Icons Color',
        'id' => 'header_socials_light',
        'not_empty' => 'true',
        'default' => '#28313f',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Main Menu Color',
        'id' => 'menu_color_light',
        'not_empty' => 'true',
        'default' => '#28313f',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Main Menu Hover',
        'id' => 'menu_hover_light',
        'not_empty' => 'true',
        'default' => '#e56e6e',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Background',
        'id' => 'submenu_bg_light',
        'not_empty' => 'true',
        'default' => '#f7f7f7',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Color',
        'id' => 'submenu_color_light',
        'not_empty' => 'true',
        'default' => '#858b94',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Hover',
        'id' => 'submenu_hover_light',
        'not_empty' => 'true',
        'default' => '#28313f',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'H1-H3 Color',
        'id' => 'h1h3_color_light',
        'not_empty' => 'true',
        'default' => '#28313f',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'H4-H6 Color',
        'id' => 'h4h6_color_light',
        'not_empty' => 'true',
        'default' => '#28313f',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Main Text Color',
        'id' => 'text_color_light',
        'not_empty' => 'true',
        'default' => '#858b94',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Additional Text Color',
        'id' => 'additional_text_color_light',
        'not_empty' => 'true',
        'default' => '#28313f',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Links Color',
        'id' => 'links_color_light',
        'not_empty' => 'true',
        'default' => '#e56e6e',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Hovered Links Color',
        'id' => 'links_color2_light',
        'not_empty' => 'true',
        'default' => '#858b94',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	
    new ColorOption_admin_theme(array(
        'name' => 'Footer Background',
        'id' => 'footer_bg_light',
        'not_empty' => 'true',
        'default' => '#f7f7f7',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Footer Text Color',
        'id' => 'footer_text_color_light',
        'not_empty' => 'true',
        'default' => '#868c95',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Footer Headings Color',
        'id' => 'footer_headings_color_light',
        'not_empty' => 'true',
        'default' => '#868c95',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))
)));

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Woocommerce',
    'icon' => 'fa fa-shopping-cart'
), array(
    new SelectOption_admin_theme(array(
        'name' => 'Single Product Sidebar Layout',
        'id' => 'shop_sidebar_layout',
        'default' => 'left-sidebar',
        'options' => array(
            'left-sidebar' => 'Left sidebar',
            'right-sidebar' => 'Right sidebar',
            'no-sidebar' => 'Without sidebar'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Products Page Listing Title Area',
        'id' => 'shop_title_area',
        'default' => 'yes',
        'options' => array(
            'yes' => 'Show',
            'no' => 'Hide'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Shop items per page',
        'id' => 'shop_items_per_page',
        'not_empty' => true,
        'default' => '8',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Shop items per line',
        'id' => 'shop_items_per_line',
        'not_empty' => true,
        'default' => '3',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Show Next and Previous link on Songle Product',
        'id' => 'next_prev_product',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    
)));