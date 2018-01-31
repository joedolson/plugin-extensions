<?php
/*
Plugin Name: Refresh after Event Submission
Plugin URI: http://www.joedolson.com/my-calendar-pro/
Description: Automatically refresh page after user submits event [PRO only]
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


/**
 * Auto refresh after submission (if you want it.)
 *
 */
add_filter( 'mcs_after_submissions', 'my_after_successful_submission', 10, 2 );
function my_after_successful_submission( $return, $response ) {
	// $response[2] == true restricts this to only successful submissions
	if ( $response[2] == true ) {
		$_POST = array();
		$reload = "<script>var current = window.location.href; setTimeout('window.location = current', 4000);</script>";
	} else {
		$reload = '';
	}
	
	return $return . $reload;
}