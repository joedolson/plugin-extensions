<?php
/*
Plugin Name: Alter number of events listed in event reports dropdown
Plugin URI: http://www.joedolson.com/my-tickets/
Description: By default, list shows maximum of 50 events with sales. 
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Set a maximum number of events to show
 *
 * By default, the reports dropdowns shows the most recent 50 events with sold tickets.
 */
add_filter( 'mt_select_events_count', 'my_select_events_count', 10, 1 );
function my_select_events_count( $default ) {
	return 80; // list most recent 80 events with sales.
}