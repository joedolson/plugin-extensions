<?php
/*
Plugin Name: My Calendar Contextual Date Format
Plugin URI: http://www.joedolson.com
Description: Use a custom date format
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_date_format', 'my_date_format', 10, 3 );
/**
 * This plug-in demonstrates adding a custom date format.
 *
 * @param string $format Original date format from settings.
 * @param string $calendar_format Current view: grid, mini, list.
 * @param string $time_format Current time view: single, day, week, month.
 *
 * @return string
 */
function my_date_format( $format, $calendar_format, $time_format = '' ) {
	// Only show in grid format.
	if ( 'calendar' === $calendar_format ) {
		// Add class so day of week only shown on mobile, wrapping elements for layout.
		// Escaped for use in date functions.
		$format = '<\s\p\a\n \c\l\a\s\s="\m\c-\c\u\s\t\o\m-\d\a\t\e-\f\o\r\m\a\t"><\s\p\a\n \c\l\a\s\s="\m\o\b\i\l\e-\o\n\l\y">l</\s\p\a\n><\s\t\r\o\n\g>j</\s\t\r\o\n\g><\s\p\a\n>M Y</\s\p\a\n></\s\p\a\n>';
		/**
		 * Renders as:
		 	<span class="mc-custom-date-format">
				<span class="mobile-only">Monday</span>
				<strong>9</strong>
				<span>Nov 2020</span>
			</span>
		*/
	}

	return $format;
}