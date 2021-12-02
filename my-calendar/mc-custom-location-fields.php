<?php
/**
 * Add Custom location fields to My Calendar locations.
 *
 * @package     MyCalendarLocations
 * @author      Joe Dolson
 * @copyright   2012-2021 Joe Dolson
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: My Calendar - Location Fields
 * Plugin URI:  http://www.joedolson.com/my-calendar/
 * Description: Add custom fields to locations.
 * Author:      Joseph C Dolson
 * Author URI:  http://www.joedolson.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/license/gpl-2.0.txt
 * Domain Path: lang
 */

/*
	Copyright 2009-2021  Joe Dolson (email : joe@joedolson.com)

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
}

/**
 * Declare custom location fields.
 *
 * @param array $fields All existing custom location fields.
 *
 * @return array
 */
function my_add_custom_field( $fields ) {
	$fields['email']           = array(
		'title'             => 'Venue Email', // Label value for input field.
		'sanitize_callback' => 'sanitize_email', // How this value should be sanitized.
		'display_callback'  => 'esc_html', // How this value should be escaped.
		'input_type'        => 'email', // Type of input.
	);
	$fields['location_type']   = array(
		'title'             => 'Location Type',
		'sanitize_callback' => 'sanitize_text_field',
		'display_callback'  => 'esc_html',
		'input_type'        => 'select',
		'input_values'      => array( 'Virtual', 'Private Home', 'Concert Hall', 'Outdoor Venue' ),
	);

	return $fields;
}
add_filter( 'mc_location_fields', 'my_add_custom_field', 10, 1 );

/**
 * This display callback is used to format the saved data.
 *
 * @param mixed $data Value of saved data.
 * @param array $field Array of data about this field (as created in create_custom_fields()).
 *
 * @return data passed.
 */
function my_custom_display_callback( $data, $field ) {
	$value = ( $data ) ? $data : '';
	// If the field currently being displayed is titled 'Job Title', make bold.
	if ( 'Job Title' === $field['title'] ) {
		$value = ( '' !== $value ) ? '<strong>' . $value . '</strong>' : '';
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
function my_custom_sanitize_callback( $data ) {
	return ( $data ) ? sanitize_text_field( $data ) : '';
}
