<?php

/*

HighThemes.com
Twitter: theHighThemes

*/

/*
 * change the default.po file with poedit to create .mo file
 * The .mo file must be named based on the locale exactly.
 */
load_theme_textdomain('highthemes');
/*
 * include the framework
 */

require_once (get_template_directory() . '/admin/index.php');
require_once (ADMIN_PATH     . 'functions/functions.metaboxes.php');

/*
 * redirect the user to admin page
 */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
      // Now redirect to portfolio
    wp_redirect(admin_url("admin.php?page=optionsframework"));

}
?>