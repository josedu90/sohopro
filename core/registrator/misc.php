<?php
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails', array('post', 'page', 'port', 'team', 'testimonials', 'partners', 'product'));
    add_theme_support('automatic-feed-links');
    add_theme_support('revisions');
}

function gt3_adjust_post_formats() {
    $post_type = 'post';
    if (isset($_GET['post'])) {
        $post = get_post($_GET['post']);
        if ($post)
            $post_type = $post->post_type;
    } elseif ( !isset($_GET['post_type']) )
        $post_type = 'post';
    elseif ( in_array( $_GET['post_type'], get_post_types( array('show_ui' => true ) ) ) )
        $post_type = $_GET['post_type'];
    else
        return;

    if ( 'port' == $post_type )
        add_theme_support('post-formats', array('image', 'video'));
    elseif ( 'post' == $post_type )
        add_theme_support('post-formats', array('image', 'video', 'quote', 'link', 'audio'));

}
add_action( 'load-post.php','gt3_adjust_post_formats' );
add_action( 'load-post-new.php','gt3_adjust_post_formats' );

#Support menus
add_action('init', 'register_my_menus');
function register_my_menus()
{
    register_nav_menus(
        array(
            'main_menu' => 'Main menu'
        )
    );
}

#Enable shortcodes in sidebar
add_filter('widget_text', 'do_shortcode');

#ADD localization folder
add_action('init', 'enable_pomo_translation');
function enable_pomo_translation()
{
    load_theme_textdomain('sohopro', get_template_directory() . '/core/languages/');
}

add_action('admin_head', 'reg_font_js');
function reg_font_js()
{
    global $gt3_themeconfig;
    ?>
    <script type="text/javascript">
        <?php
            $compile = array();
            echo "var fontsarray = '';";
        ?>
    </script>
<?php
}

function side_sidebar_settings_meta_box_cb($post)
{
    $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder($post->ID, array("not_prepare_sidebars" => "true"));

    $available_sidebars = array("default" => "Default", "no-sidebar" => "None", "left-sidebar" => "Left", "right-sidebar" => "Right");

    echo '<div class="select_sidebar_layout sidebar_option sidebar_no_border"><span class="htitle">' . esc_html__('Sidebar layout:', 'sohopro') . '</span><select name="pagebuilder[settings][layout-sidebars]" class="sidebar_layout admin_newselect">';
    foreach ($available_sidebars as $sidebar_id => $sidebar_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['layout-sidebars']) && $gt3_theme_pagebuilder['settings']['layout-sidebars'] == $sidebar_id) ? 'selected="selected"' : '') . " value='$sidebar_id'>$sidebar_caption</option>";
    }
    echo '</select></div>';

    $all_available_sidebars = array("Default");
    $theme_sidebars = gt3_get_theme_option("theme_sidebars");
    if (!is_array($theme_sidebars)) {
        $theme_sidebars = array();
    }

    $i = 1;
    foreach ($theme_sidebars as $theme_sidebar) {
        $all_available_sidebars[$i] = $theme_sidebar;
        $i++;
    }

    if (class_exists('WooCommerce')) {
        $all_available_sidebars[$i] = "WooCommerce";
        $i++;
    }

    echo '<div class="select_sidebar sidebar_option last sidebar_with_border ' . (gt3_get_theme_option("default_sidebar_layout") == "no-sidebar" ? "sidebar_none" : "") . '"><span class="htitle">' . esc_html__('Select sidebar:', 'sohopro') . '</span><select name="pagebuilder[settings][selected-sidebar-name]" class="sidebar_name admin_newselect">';
    foreach ($all_available_sidebars as $sidebar_id => $sidebar_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['selected-sidebar-name']) && $gt3_theme_pagebuilder['settings']['selected-sidebar-name'] == $sidebar_caption) ? 'selected="selected"' : '') . " value='$sidebar_caption'>$sidebar_caption</option>";
    }
    echo '</select></div>';
}

#Work with Custom background
function side_bg_settings_meta_box_cb($post)
{
    $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder($post->ID);
	$now_post_type = get_post_type();
	if ($now_post_type !== "port") {
		echo '<div class="custom_select_bcarea last">';
		echo '<span class="htitle">' . esc_html__('Title:', 'sohopro') . '</span><select name="pagebuilder[settings][show_title_area]" class="admin_newselect">';
		$available_variants = array("yes" => "Show", "no" => "Hide");
		foreach ($available_variants as $var_id => $var_caption) {
			echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['show_title_area']) && $gt3_theme_pagebuilder['settings']['show_title_area'] == $var_id) ? 'selected="selected"' : '') . " value='$var_id'>$var_caption</option>";
		}
		echo '</select></div><div class="clear"></div>';
	}
}


if (!defined("GT3PBVERSION")) {
    function gt3_update_theme_pagebuilder_without_plugin($post_id, $variableName, $gt3_theme_pagebuilderArray)
    {
        update_post_meta($post_id, $variableName, $gt3_theme_pagebuilderArray);
        return true;
    }

    add_action('save_post', 'save_postdata_in_theme');
    function save_postdata_in_theme($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        #CHECK PERMISSIONS
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        #START SAVING
        if (!isset($_POST['pagebuilder'])) {
            $pbsavedata = array();
        } else {
            $pbsavedata = $_POST['pagebuilder'];
            gt3_update_theme_pagebuilder_without_plugin($post_id, "pagebuilder", $pbsavedata);
        }
    }
}

#Only demo stuff
#gt3_update_theme_option("demo_server", "true");
#gt3_delete_theme_option("demo_server");