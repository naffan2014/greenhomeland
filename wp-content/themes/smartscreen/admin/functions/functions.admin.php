<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */

/**
 * Head Hook
 *
 */
function of_head() { do_action( 'of_head' ); }

/**
 * Add default options upon activation else DB does not exist
 *
 */
function of_option_setup()	
{
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);
		
	if (!get_option(OPTIONS))
	{
		update_option(OPTIONS,$options_machine->Defaults);
	}
}

/**
 * Change activation message
 *
 */
function optionsframework_admin_message() {
}

/**
 * Get header classes
 *
 */
function of_get_header_classes_array() 
{
	global $of_options;
	
	foreach ($of_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}


/**
 * For use in themes
 *
 */
$data = get_option(OPTIONS);