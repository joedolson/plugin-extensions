<?php
/*
Plugin Name: Disable Date Picker
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Remove the date picker so dates and times are entered fully manually.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2017 Joseph C Dolson  (email : plugins@joedolson.com)

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
 * Add dequeuing action to remove script in admin
 * 
 */
add_action( 'admin_enqueue_scripts', 'my_dequeue_scripts', 100 );
function my_dequeue_scripts() {
	wp_dequeue_script( 'pickadate' );
	wp_deregister_script( 'pickadate' );
}
