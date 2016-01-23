<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */

$theme_version = '';
	    
if( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}

	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');
}


define( 'HT_FRAMEWORK_VERSION', '1.1.0' );
define( 'ADMIN_PATH', get_template_directory()  . '/admin/' );
define( 'ADMIN_DIR', get_template_directory_uri() . '/admin/' );
define( 'LAYOUT_PATH', ADMIN_PATH . '/layouts/' );
define( 'THEMENAME', $theme_name );
define( 'THEMEVERSION', $theme_version );
define( 'THEMEURI', $theme_uri );
define( 'THEMEAUTHORURI', $author_uri );



define('HT_JS_PATH', get_template_directory_uri() . '/scripts/' );
define('HT_LIB_PATH', get_template_directory()  . '/includes/lib/' );
define('HT_INCLUDES_PATH', get_template_directory()  . '/includes/' );
define('HT_TEMPLATES_PATH', get_template_directory()  . '/includes/templates/' );





define( 'OPTIONS', $theme_name.'_options' );
define( 'BACKUPS',$theme_name.'_backups' );

/**
 * Required action filters
 *
 * @uses add_action()
 *
 */
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) add_action('admin_head','of_option_setup');
add_action('admin_head', 'optionsframework_admin_message');
add_action('admin_init','optionsframework_admin_init');
add_action('admin_menu', 'optionsframework_add_admin');
add_action( 'init', 'optionsframework_mlu_init');

/**
 * Required Files
 *
 */
require_once ( ADMIN_PATH . 'functions/functions.load.php' );
require_once ( ADMIN_PATH . 'classes/class.options_machine.php' );

/**
 * AJAX Saving Options
 *
 */
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');
?>