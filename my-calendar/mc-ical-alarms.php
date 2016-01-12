<?php
/*
Plugin Name: Set alarm to the iCAL import for events.
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Add an alarm that will be set on the calendar when ical events are imported.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2016  Joseph C Dolson  (email : plugins@joedolson.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Action runs when an event is being processed into the ICS format. 
 * 
 * @param $alarm array; empty by default - return with values to enable.
 * @param $event_id; event id
 * @param $event_post; post ID associated with event
 *
 * @return array Any values at all will add an alarm. Your values will be merged with the default values
 * 
 * Defaults:
 * 	$defaults = array( 
 *		'TRIGGER' => '-PT30M', 
 *		'REPEAT' => '0', 
 *		'DURATION' => '', 
 *		'ACTION' => 'DISPLAY', 
 *		'DESCRIPTION' => '{title}'
 *	);
 *
 */
add_action( 'mc_event_has_alarm', 'my_event_alarm', 10, 3 );
function my_event_alarm( $alarm, $event_id, $event_post ) {
	// set a trigger to 60 minutes before the start of the event.
	// Use $event_id to pass specific values for different events.
	// Note: Google Calendar does not import alerts correctly. This is a Google Calendar issue.
	$alarm = array( 
		'TRIGGER' => '-PT60M' 
	);
	
	return $alarm;
}