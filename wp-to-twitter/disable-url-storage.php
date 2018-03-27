<?php
/*
Plugin Name: Disable URL Storage
Plugin URI: http://www.joedolson.com/wp-to-twitter/
Description: Disable storage of tweeted URLs
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
}

/**
 * Don't store URLs in WP to Twitter.
 *
 * @param boolean Current status.
 *
 * @return boolean false if not storing
 */
add_filter( 'wpt_store_url', 'my_store_url', 10, 1 );
function my_store_url( $store ) {
	// Returns true to store.
	return false;
}
