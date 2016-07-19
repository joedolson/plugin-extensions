<?php
/*
Plugin Name: My Calendar: Hide Days
Plugin URI: http://www.joedolson.com
Description: Hides additional days of any event crossing more than one date.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_hide_additional_days', 'my_hide_additional_days', 10, 2 );
/**
 * Return 'true' to hide subsequent days of this event.
 *
 * @param {boolean} $hide true to hide days
 * @param {object} $event Event object
 *
 * @return boolean
 */
function my_hide_additional_days( $hide, $event ) {
	// this example maps the setting for hiding end times to the characteristic of hiding additional dates
	if ( $event->event_hide_end == 1 ) {
		$return = true;
	}

	return $hide;
}