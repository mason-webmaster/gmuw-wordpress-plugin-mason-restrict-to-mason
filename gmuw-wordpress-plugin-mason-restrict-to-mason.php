<?php

/**
 * Main plugin file for the Mason WordPress: Restrict to Mason
 */

/**
 * Plugin Name:       Mason WordPress: Restrict to Mason
 * Author:            Mason Webmaster
 * Plugin URI:        https://github.com/mason-webmaster/gmuw-wordpress-plugin-mason-restrict-to-mason
 * Description:       Mason WordPress plugin which allows you to restrict certain pages to only allow access to users accessing the website from within the Mason IP address range.
 * Version:           0.9
 */


// Exit if this file is not called directly.
	if (!defined('WPINC')) {
		die;
	}

// Set up auto-updates
	require 'plugin-update-checker/plugin-update-checker.php';
	$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/mason-webmaster/gmuw-wordpress-plugin-mason-restrict-to-mason/',
	__FILE__,
	'gmuw-wordpress-plugin-mason-restrict-to-mason'
	);

// Branding
include('php/fnsBranding.php');

// Admin menu
include('php/admin-menu.php');

// Admin page
include('php/admin-page.php');

// Plugin settings
include('php/settings.php');

// Shortcodes
include('php/shortcodes.php');

// ip addresses
require('php/ip-addresses.php');

// restricted urls
require('php/restricted-urls.php');
