<?php
/*
Plugin Name: My Calendar: Change close icon
Plugin URI: http://www.joedolson.com
Description: Change the HTML output for the close icon
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_close_button', 'mc_close_button', 10, 1 );
/**
 * Replaces the HTML inside the close toggle for event details pop-ups.
 */
function mc_close_button( $html ) {
	/**
	 * Example using WordPress dashicons
	 */
	$return = '<span class="dashicons dashicons-close" aria-hidden="true"></span><span class="screen-reader-text">Close</span>';
	/**
	 * Example using custom image
	 */
	$return = '<img src="/path/to/my/custom-icon.png" alt="Close" />';
	
	return $return;
}