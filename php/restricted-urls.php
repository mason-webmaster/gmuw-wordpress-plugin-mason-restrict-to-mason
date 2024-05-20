<?php

/**
 * Summary: php file which implements restricted URL functionality
 */


//Custom restricted url feature
add_action('parse_request', 'gmuw_rtm_restricted_url_check');
function gmuw_rtm_restricted_url_check() {

	//are we in the Mason IP range?
	if (gmuw_rtm_ip_in_mason_range($_SERVER['REMOTE_ADDR'])) {
		return;
	} 	

	//Get array of plugin options. If the specified option does not exist, get default options from a function
	$options = get_option('gmuw_rtm_options', gmuw_rtm_options_default());

	//get restricted url patterns setting value
	$restricted_url_patterns = isset($options['gmu_rtm_setting_list_of_restriction_criteria']) ? sanitize_textarea_field($options['gmu_rtm_setting_list_of_restriction_criteria']) : '';

	//do we have a value?
	if (empty($restricted_url_patterns)) {
		return;
	}

	//put patterns into an array
	$restricted_url_patterns_array = explode(PHP_EOL, $restricted_url_patterns);

	//loop through array to see if the current url matches the pattern
	foreach($restricted_url_patterns_array as $restricted_url_pattern){
		
		//echo 'pattern: '.$restricted_url_pattern.PHP_EOL;

		//fix pattern to escape slashes, which would mess with the regex pattern delimiters
		$fixed_pattern=str_replace("/","\/",$restricted_url_pattern);

		//does the server request url match the pattern?
		$pattern = "/".$fixed_pattern."/i";
		if(preg_match($pattern, $_SERVER["REQUEST_URI"])==1) {

			//echo 'this is a restricted url';die();

			//get redirect url
			//if the settings redirect url field exists, and is not empty, and is a valid url, then use it. otherwise use the website home url
			if (isset($options['gmu_rtm_setting_redirect_url']) && !empty($options['gmu_rtm_setting_redirect_url']) && $options['gmu_rtm_setting_redirect_url']==sanitize_url($options['gmu_rtm_setting_redirect_url'])) {
				$redirect_url = sanitize_url($options['gmu_rtm_setting_redirect_url']);
			} else {
				$redirect_url = get_home_url();
			}

			//echo 'you should be redirected to: '.$redirect_url;die();

			//redirect
			wp_redirect($redirect_url);
			exit();

		}

	}

}
