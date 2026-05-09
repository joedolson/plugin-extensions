<?php
/*
Plugin Name: Disable Akismet in My Calendar
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Turn off spam filtering in My Calendar events.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2026  Joseph C Dolson  (email : plugins@joedolson.com)

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

add_filter( 'mc_disable_spam_checking', 'my_disabled_spam_checking', 10, 2 );
/**
 * @param boolean $return True to disable spam checking.
 * @param array   $event  Submitted event data.
 *
 * @return bool
 */
function my_disabled_spam_checking( $return, $event ) {
	// Could examine $event for custom spam filtering here.

	return true;
}
