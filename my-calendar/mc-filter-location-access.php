<?php
/*
Plugin Name: My Calendar: Add location access criteria.
Plugin URI: http://www.joedolson.com
Description: Add an additional accessibility criteria for venues.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_location_access_choices', 'my_location_access_choices', 10, 1 );
/**
 * Filters the location access choices.
 *
 * @param array $choices Array of selection choices for location accessibility.
 */
function my_location_access_choices( $choices ) {
	/**
	 * Note: the key values are the data saved in location records. They should not be changed.
	 * As of version 3.3.0, there are 12 default choices. This can also be used to change the labels on existing options.
	 */
	$choices['10'] = 'Braille and Audio Signage'; // Changes a default value.
	$choices['13'] = 'Service Animal Restrooms'; // Adds a new option.

	return $choices;
}