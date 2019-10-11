<?php
/*
Plugin Name: My Calendar: Custom List Title
Plugin URI: http://www.joedolson.com
Description: Manipulate the title hint provided in List view.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_list_title_title', 'my_custom_list_title', 10, 2 );
/**
 * Change the list title used on the button toggle.
 *
 * @since 3.1.16
 *
 * @param string $title Title of event passed.
 * @param object $event Event object.
 *
 * @return array $site
 */
function my_custom_list_title( $title, $event ) {
	// Display the event time with the title.
	$event_time = date( 'g:i a', strtotime( $event->occur_begin ) );
	$title      = "<span class='event-time'>$event_time</span>: $title";

	return $title;
}