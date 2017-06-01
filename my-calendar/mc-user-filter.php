<?php
/*
Plugin Name: Filter users
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Filter users available in My Calendar Pro's submit function based on role
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
add_filter( 'mc_filter_user_arguments', 'my_filter_user_arguments', 10, 2 );
	// Specifically list users with either the 'administrator', 'editor', or 'event_manager' role. 
	// (Event manager is completely made up, and is not a real role.)
	$args['role__in'] = array( 'administrator', 'editor', 'event_manager' );
	
	return $args;
}
