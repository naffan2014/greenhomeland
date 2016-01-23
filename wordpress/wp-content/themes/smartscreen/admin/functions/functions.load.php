<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */
require_once(ADMIN_PATH     . 'functions/slideshow.php');
require_once(ADMIN_PATH     . 'functions/portfolio.php');

require_once(ADMIN_PATH     . 'functions/functions.php');
require_once(ADMIN_PATH     . 'functions/functions.interface.php');
require_once(ADMIN_PATH     . 'functions/functions.options.php');
require_once(ADMIN_PATH     . 'functions/functions.admin.php');
require_once(ADMIN_PATH     . 'functions/functions.mediauploader.php');
require_once(ADMIN_PATH     . 'functions/widgets.php');
require_once(HT_LIB_PATH    . 'sidebar_generator.php');
require_once(ADMIN_PATH     . 'functions/sidebars.php');
require_once(ADMIN_PATH     . 'functions/shortcodes.php');
require_once(HT_LIB_PATH    . 'sort_query.php');
require_once(HT_LIB_PATH    . 'breadcrumb.php');
require_once(ADMIN_PATH     . 'tinymce/tinymce.php');


if(is_woocommerce_activated()){
    require_once(ADMIN_PATH     . 'functions/woocommerce.php');

}


if (!function_exists('wp_pagenavi')) {
    require_once (HT_LIB_PATH . 'wp_pagenavi.php');
}
