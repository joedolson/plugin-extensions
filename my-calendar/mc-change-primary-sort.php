<?php
/*
Plugin Name: Change primary sort
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Change default sorting from date/time to time only
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
add_filter( 'mc_primary_sort', 'my_custom_sort', 10, 1 );
function my_custom_sort( $cats, $data, $option ) {
	// return any legitimate database column name
	return 'event_time';
}
