<?php
/*
Plugin Name: My Calendar: Custom display of event titles in list view
Plugin URI: http://www.joedolson.com
Description: Formatting for event titles defaults to comma separated list.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_titles_format', 'my_titles_format', 10, 2 );
/**
 * Filters the location access choices.
 *
 * @param string $output Output string to display.
 * @param array  $titles Array of titles to be shown.
 */
function my_titles_format( $output, $titles ) {
	if ( ! empty( $titles ) ) {
		foreach ( $titles as $title ) {
			$output .= '<li>' . $title . '</li>';
		}
	}

	return ( $output ) ? '<ul>' . $output . '</ul>' : $output;
} 