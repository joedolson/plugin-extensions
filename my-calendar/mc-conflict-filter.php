<?php
/*
Plugin Name: Custom conflict checking
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Use custom arguments to reject events as conflicts.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2018  Joseph C Dolson  (email : plugins@joedolson.com)

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

add_action( 'mcs_check_conflicts', 'my_conflict_check', 10, 2 );
/**
 * @param array|boolean $check Array of objects returned by default conflict checking.
 * @param array         $post POST data from submission.
 *
 * @return array
 */
function my_conflict_check( $check, $post ) {
	// If $check is false, then no conflict was identified using default arguments.
	if ( ! $check ) {
		
	}
	return $check;
}
