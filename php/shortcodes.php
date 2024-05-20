<?php

/**
 * Summary: php file which implements the custom shortcodes
 */


// Add shortcodes on init
add_action('init', function(){

    // Add shortcodes. Add additional shortcodes here as needed.

    // mason network status?
        add_shortcode('gmuw_rtm_mason_network_status_message', 'gmuw_rtm_mason_network_status_message');

});

// Define shortcode callback functions. Add additional shortcode functions here as needed.

function gmuw_rtm_mason_network_status_message(){

  // are we in the Mason IP range?
  if (gmuw_rtm_ip_in_mason_range($_SERVER['REMOTE_ADDR'])) {
    $content='<p>You are on the Mason network.</p>';
  } else {
    $content='<p>You are not on the Mason network.</p>';
  }

  // Return value
  return $content;

}

