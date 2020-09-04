<?php

#main config
require_once(get_template_directory() . "/core/config.php");
require_once(get_template_directory() . "/core/vc/init.php");
require_once(get_template_directory() . "/core/aq_resizer.php");
require_once(get_template_directory() . "/core/page-settings.php");
#classes
require_once(get_template_directory() . "/core/classes/admin-tabs-controls.php");
require_once(get_template_directory() . "/core/classes/admin-tabs-option-types.php");
require_once(get_template_directory() . "/core/classes/admin-tabs-list.php");
require_once(get_template_directory() . "/core/classes/menu-walker.php");

#all registration
require_once(get_template_directory() . "/core/registrator/admin-pages.php");
require_once(get_template_directory() . "/core/registrator/css-js.php");
require_once(get_template_directory() . "/core/registrator/ajax-handlers.php");
require_once(get_template_directory() . "/core/registrator/sidebars.php");
require_once(get_template_directory() . "/core/registrator/fonts.php");
require_once(get_template_directory() . "/core/registrator/misc.php");

#license verification
require_once("license_verification/license_verification.php");

#admin
require_once(get_template_directory() . "/core/admin/options.php");
require_once(get_template_directory() . "/core/admin/theme-settings-page.php");

#widgets
if (function_exists('gt3_add_widget_to_theme')) {
    gt3_add_widget_to_theme();
}

#TGM init
require_once(get_template_directory() . "/core/tgm/gt3-tgm.php");

#Image srcset
require_once(get_template_directory() . '/core/wize-content-image-size.php');
