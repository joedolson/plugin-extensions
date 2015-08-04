<?php
/*
 * Plugin Name: Insert custom class in navigation buttons
 * Plugin URI: http://www.joedolson.com/articles/my-calendar/
 * Plugin Description: Insert a button class into navigation for my calendar.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'mc_previous_link', 'mc_add_class' );
add_filter( 'mc_next_link', 'mc_add_class' );
/**
 * Look at existing link code and insert an extra class in the HTML.
 * 
 * @param $link String
 * 
 * @return $link String
 */
function mc_add_class( $link ) {
	$link = str_ireplace( 'my-calendar-', 'button my-calendar-', $link );
	
	return $link;
}