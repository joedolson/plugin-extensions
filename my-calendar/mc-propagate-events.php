<?php
/*
Plugin Name: Generate individual events
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Generate individual events instead of generating recurring events
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2017  Joseph C Dolson  (email : plugins@joedolson.com)

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
 * Filter primary sort criteria
 * 
 * @param string database column to sort by
 * 
 * @return string new database column to sort by
 */
add_filter( 'mc_insert_recurring', 'my_insert_recurring', 10, 5 );
function my_insert_recurring( $stop, $data, $format, $event_id, $period ) {
	// extract all recurring events and convert into single events
	// need to add 'isset( $_POST['convert_to_individual'] )' check
	if ( $period != 'single' && isset( $_POST['convert_to_individual'] ) && $_POST['convert_to_individual'] == 'propagate' ) {
		// delete the original event
		$message = mc_delete_event( $event_id );
		$insert  = mc_check_data( 'add', $_POST, 0 );
		if ( $insert[0] ) {
			
			$new_data = $insert[2];
			$new_data['event_begin']   = date( 'Y-m-d', strtotime( $data['occur_begin'] ) );
			$new_data['event_end']     = date( 'Y-m-d', strtotime( $data['occur_end'] ) );
			$new_data['event_recur']   = 'S1';
			$new_data['event_repeats'] = '0';
			$insert[2] = $new_data;
			$response  = my_calendar_save( 'add', $insert );	
		}
		// return true to prevent propagation of default recurring event
		$stop = true;
	}
	
	return $stop;
}
//	$return = apply_filters( 'mc_show_block', $return, $data, $field );

add_filter( 'mc_show_block', 'my_recurring_option', 10, 3 );
function my_recurring_option( $return, $data, $field ) {

	if ( $field == 'event_recurs' ) {
		$return = str_replace( "</div></div>", "<div class='inside'><p><input type='checkbox' name='convert_to_individual' id='convert_to_individual' value='propagate' /> <label for='convert_to_individual'>" . __( 'Propagate as individual events', 'yourtextdomain' ) . "</label> </p></div></div></div>", $return );
	}
	
	return $return;
}
