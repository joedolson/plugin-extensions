<?php
/*
Plugin Name: Limit categories
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Limit categories available to select from dropdown
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2015  Joseph C Dolson  (email : plugins@joedolson.com)

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
 * Filter available categories for selection
 * 
 * @param array $cats Array of all categories
 * @param mixed (object, array, boolean) $data current information passed to select list
 * @param string $option format of output: standard select or multiple select
 * 
 * @return array $cats 
 */
add_filter( 'mc_category_list', 'my_category_list', 10, 3 );
function my_category_list( $cats, $data, $option ) {
	// only filter if not in the admin
	if ( !is_admin() ) {
		$output = array();
		// you can add a specific category to the array
		$output[] = (object) array( 'category_id' => 1, 'category_name' => 'General' );
		foreach ( $cats as $key => $cat ) {
			// if $cat meets your criteria, include
			if ( we_want_to_use( $cat->category_id ) ) {
				$output[] = $cat;
			}
		}
		
		return $output;
	}
	
	return $cats;
}

/**
 * This is totally arbitrary; you'd have to determine your own rules for inclusion.
 */
function we_want_to_use( $cat_id ) {
	return true;
}
