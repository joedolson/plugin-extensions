<?php
/*
Plugin Name: Redirect single event
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Point your single event views back to the main calendar
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
 * Modify the default image size in My Calendar events
 */
add_action( 'template_redirect', 'redirect_event_single' );
function redirect_event_single() {
	if ( ! is_singular( 'mc-events' ) ) {
		return;
	} else {
		$home_id = get_option( 'mc_uri_id' );
		$calendar = get_permalink( $home_id );
		wp_safe_redirect( $calendar, 301 );
		exit;
	}
}