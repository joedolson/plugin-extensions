<?php
/*
Plugin Name: Make QR Code rendering compatible with Nimble Builder
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Nimble Builder overrides the template replacement done by My Tickets. This plug-in fixes that.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Repeat mt_verify function attached to nimble template path filter
 */
add_filter( 'nimble_get_locale_template_path', 'mt_verify', 10, 2 );