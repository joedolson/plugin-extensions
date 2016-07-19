<?php
/*
Plugin Name: My Tickets: Custom Fields
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Test Custom Fields in My Tickets
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2014-2016  Joseph C Dolson  (email : plugins@joedolson.com)

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

/*
 * Add custom fields to each add to cart form. 
 */
add_filter( 'mt_custom_fields', 'create_custom_fields', 10, 1 );
function create_custom_fields( $array ) {
	// Other fields: sanitize callback; input type; input values; display_callback
	$array['test_event_data'] = array( 
		'title'=>"Test Event Data", 
		'sanitize_callback'=>'sanitize_callback', 
		'display_callback'=>'display_callback',
		'input_type'=>'select',
		'input_values'=>array( 'Test Mode', 'Application Mode', 'Pizza Roll' ),
		'context'=> 'global'
	);
	/**
	 * Add a second custom field by adding more values to the array
	 *
	$array['choose_seats'] = array(
		'title'=>"Seat(s) Selection:",
		'sanitize_callback'=>'sanitize_callback',
		'display_callback'=>'display_callback',
		'input_type'=>'Text',
		'context'=> 'global'
	);
	*/
	return $array;
}

/* This display callback is used to format the saved data. $context is either 'payment' or 'cart', depending on whether it's appearing in an admin payment record or in the user's cart. */
function display_callback( $data, $context='payment' ) {
	return urldecode( $data );
}

/* This sanitize callback is used to sanitize the data before it's saved to the DB */
function sanitize_callback( $data ) {
	return esc_sql( $data );
}