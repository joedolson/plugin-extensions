<?php
/*
Plugin Name: My Tickets: Custom Fields
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Custom Fields in My Tickets
Version: 1.2.1
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2014-2022  Joseph C Dolson  (email : plugins@joedolson.com)

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

add_filter( 'mt_custom_fields', 'create_custom_fields', 10, 1 );
/**
 * Add custom fields to each add to cart form.
 *
 * @param array $array All custom fields.
 *
 * @return array New array of custom fields.
 */
function create_custom_fields( $array ) {
	$array['test_event_data'] = array(
		'title'             => 'Job Title',
		'sanitize_callback' => 'custom_sanitize_callback',
		'display_callback'  => 'custom_display_callback',
		'input_type'        => 'select',
		'input_values'      => array(
			'Web Developer',
			'Consultant',
			'Marketer'
		),
		'context'           => 'custom', // Can be an event ID to restrict to that event.
		'required'          => 'true',
	);
	/**
	 * Add a second custom field by adding more values to the array
	 */
	$array['choose_seats'] = array(
		'title'             => 'Seat(s) Selection:',
		'sanitize_callback' => 'custom_sanitize_callback',
		'display_callback'  => 'custom_display_callback',
		'input_type'        => 'text',
		'context'           => 'global'
	);

	return $array;
}

/**
 * This display callback is used to format the saved data.
 *
 * @param mixed  $data Value of saved data.
 * @param string $context Where data is being displayed: either 'payment' or 'cart'.
 * @param array  $field Array of data about this field (as created in create_custom_fields()).
 *
 * @return data passed.
 */
function custom_display_callback( $data, $context='payment', $field ) {
	$value = ( $data ) ? urldecode( $data ) : '';
	// If the field currently being displayed is titled 'Job Title', make bold.
	if ( 'Job Title' == $field['title'] ) {
		$value = '<strong>' . $value . '</strong>';
	}

	return $value;
}

/**
 * This sanitize callback is used to sanitize the data before it's saved to the DB
 *
 * @param mixed $data Data supplied by user.
 *
 * @return sanitized value
 */
function custom_sanitize_callback( $data ) {
	return ( $data ) ? esc_html( $data ) : '';
}

add_filter( 'mt_apply_custom_field_rules', 'my_custom_field_rules', 10, 3 );
/**
 * Use a custom rule set to determine when a field should be displayed.
 *
 * @param bool  $return Should this field display.
 * @param array $field Field characteristics.
 * @param int   $event_id Event being displayed.
 *
 * @return boolean
 */
function my_custom_field_rules( $return, $field, $event_id ) {
	if ( 'custom' == $field['context'] ) {
		// Display this field based on your custom rules.
		// Example: restrict by post type.
		if ( is_page( $event_id ) ) {
			return true;
		}
	}

	return $return;
}