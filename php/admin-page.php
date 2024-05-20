<?php

/**
 * Summary: php file which implements the plugin WP admin page interface
 */


/**
 * Generates the plugin settings page
 */
function gmuw_rtm_display_settings_page() {
	
	// Only continue if this user has the 'manage options' capability
	if (!current_user_can('manage_options')) return;

	// Begin HTML output
	echo "<div class='wrap'>";

	// Page title
	echo "<h1>" . esc_html(get_admin_page_title()) . "</h1>";

	// Output basic plugin info
	echo "<p>This plugin provides the ability to restrict certain pages to only be accessed within the Mason IP address range.</p>";

	// Begin form
	echo "<form action='options.php' method='post'>";

	// output settings fields - outputs required security fields - parameter specifes name of settings group
	settings_fields('gmuw_rtm_options');

	// output setting sections - parameter specifies name of menu slug
	do_settings_sections('gmuw_rtm');

	// submit button
	submit_button();

	// Close form
	echo "</form>";

	// Finish HTML output
	echo "</div>";
	
}

/**
 * Generates content for general settings section
 */
function gmuw_rtm_callback_section_settings_general() {

	// Get plugin options
	$gmuw_rtm_options = get_option('gmuw_rtm_options');

	// Provide section introductory information
	echo '<p>This section contains general settings.</p>';

}
