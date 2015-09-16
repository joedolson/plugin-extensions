<?php
/*
Plugin Name: My Calendar Custom Admin Time Format
Plugin URI: http://www.joedolson.com
Description: Use an alternate time format in the admin when adding events.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_time_format', 'my_time_format', 10, 1 );
/**
 * Default time format is 'h:i A' (standard US time format).
 * Pass any string using the pickadate.time formatting rules: http://amsul.ca/pickadate.js/time/#formatting-rules
 */
function my_time_format( $format ) {
	return 'H:i U!hr'; // German format
}