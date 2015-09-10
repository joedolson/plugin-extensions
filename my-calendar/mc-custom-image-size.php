<?php
/*
Plugin Name: Custom default image size.
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Change the default image size used on My Calendar events.
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
 * When an event is edited, send the admin a notification.
 */
add_filter( 'mc_default_image_size', 'my_custom_image_size', 10, 1 );
function my_custom_image_size( $size ) {
	return 'large'; // can be any defined image size value in your system. These can be variable. 
}