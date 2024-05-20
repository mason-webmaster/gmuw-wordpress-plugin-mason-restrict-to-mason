<?php

/**
 * Summary: php file which sets up plugin settings
 */


/**
 * Register plugin settings
 */
add_action('admin_init', 'gmuw_rtm_register_settings');
function gmuw_rtm_register_settings() {
	
	/*
	Code reference:

	register_setting( 
		string   $option_group, // name of option group - should match the parameter used in the settings_fields function in the display_settings_page function
		string   $option_name, // name of the particular option
		callable $sanitize_callback = '' // function used to validate settings
	);

	add_settings_section( 
		string   $id, // section id
		string   $title, // title/heading of section
		callable $callback, // function that displays section
		string   $page // admin page (slug) on which this section should be displayed
	);

	add_settings_field(
    	string   $id, // setting id
		string   $title, // title of setting
		callable $callback, // outputs markup required to display the setting
		string   $page, // page on which setting should be displayed, same as menu slug of the menu item
		string   $section = 'default', // section id in which this setting is placed
		array    $args = [] // array the contains data to be passed to the callback function. by convention I pass back the setting id and label to make things easier
	);
	*/

	// Register serialized options setting to store this plugin's options
	register_setting(
		'gmuw_rtm_options',
		'gmuw_rtm_options',
		'gmuw_rtm_callback_validate_options'
	);

	// Add section: general settings
	add_settings_section(
		'gmuw_rtm_section_settings_general',
		'General',
		'gmuw_rtm_callback_section_settings_general',
		'gmuw_rtm'
	);

	// Add field: gmu_rtm_setting_list_of_restriction_criteria
	add_settings_field(
		'gmu_rtm_setting_list_of_restriction_criteria',
		'URLs to Restrict',
		'gmuw_rtm_callback_field_textarea',
		'gmuw_rtm',
		'gmuw_rtm_section_settings_general',
		['id' => 'gmu_rtm_setting_list_of_restriction_criteria', 'label' => 'list of criteria to check page URL against to see if a page should be restricted.']
	);

	// Add field: gmu_rtm_setting_redirect_url
	add_settings_field(
		'gmu_rtm_setting_redirect_url',
		'Redirect URL',
		'gmuw_rtm_callback_field_text',
		'gmuw_rtm',
		'gmuw_rtm_section_settings_general',
		['id' => 'gmu_rtm_setting_redirect_url', 'label' => 'URL to redirect users who access a restricted page from outside of the Mason network.']
	);

} 

/**
 * Generates text field for plugin settings option
 */
function gmuw_rtm_callback_field_text($args) {
	
	//Get array of options. If the specified option does not exist, get default options from a function
	$options = get_option('gmuw_rtm_options', gmuw_rtm_options_default());
	
	//Extract field id and label from arguments array
	$id    = isset($args['id'])    ? $args['id']    : '';
	$label = isset($args['label']) ? $args['label'] : '';
	
	//Get setting value
	$value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';
	
	//Output field markup
	echo '<input id="gmuw_rtm_options_'. $id .'" name="gmuw_rtm_options['. $id .']" type="text" size="40" value="'. $value .'">';
	echo "<br />";
	echo '<label for="gmuw_rtm_options_'. $id .'">'. $label .'</label>';
	
}

/**
 * Generates text field for plugin settings option
 */
function gmuw_rtm_callback_field_textarea($args) {
	
	//Get array of options. If the specified option does not exist, get default options from a function
	$options = get_option('gmuw_rtm_options', gmuw_rtm_options_default());
	
	//Extract field id and label from arguments array
	$id    = isset($args['id'])    ? $args['id']    : '';
	$label = isset($args['label']) ? $args['label'] : '';
	
	//Get setting value
	$value = isset($options[$id]) ? sanitize_textarea_field($options[$id]) : '';
	
	//Output field markup
	echo '<textarea id="gmuw_rtm_options_'. $id .'" name="gmuw_rtm_options['. $id .']">'. $value .'</textarea>';
	echo "<br />";
	echo '<label for="gmuw_rtm_options_'. $id .'">'. $label .'</label>';
	
}

/**
 * Sets default plugin options
 */
function gmuw_rtm_options_default() {

	return array(
		'gmu_rtm_setting_list_of_restriction_criteria' => '',
		'gmu_rtm_setting_redirect_url' => '',
	);

}

/**
 * Validate plugin options
 */
function gmuw_rtm_callback_validate_options($input) {
	
	// setting_one

	// Filter the resulting value as a clean URL
	//$input['cache_clear_url'] = filter_var($input['cache_clear_url'], FILTER_SANITIZE_URL);

	// Return value
	return $input;
	
}
