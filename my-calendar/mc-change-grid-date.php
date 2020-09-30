<?php
/*
Plugin Name: My Calendar: Change grid date
Plugin URI: http://www.joedolson.com
Description: Adjust the format for a grid date
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_grid_date', 'my_grid_date', 10, 2 );
/**
 * Replaces the HTML inside the close toggle for event details pop-ups.
 *
 * @param string $format Date format; default 'j'.
 * @param array  $params Current calendar view parameters.
 *
 * @return string
 */
function my_grid_date( $format, $params ) {
	/**
	 * Example returning 0-padded date, e.g. 07.
	 */

	return 'd';
}