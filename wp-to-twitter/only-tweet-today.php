<?php
/*
Plugin Name: Only Tweet Today
Plugin URI: http://www.joedolson.com/wp-to-twitter/
Description: Only Tweet posts that were published on the current day.
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

add_filter( 'wpt_do_tweet', 'my_custom_filter', 10, 3 );
/**
 * Cancel any Tweet not for a post done today. Example of a custom end-stage filter, * executed only after all other filters are completed.
 *
 * @since WP to Twitter 3.3.9
 *
 * @param boolean $do_tweet True to send Tweet, false to cancel.
 * @param int     $auth Author ID.
 * @param int     $post_ID Post ID being Tweeted.
 *
 * @return boolean true to Tweet
 */
function my_custom_filter( $do_tweet, $auth, $post_ID ) {
	// Returns true to Tweet.
	$post     = get_post( $post_ID );
	$do_tweet = false;
	if ( $post ) {
		$date  = date( 'Y-m-d', strtotime( $post->post_date ) );
		$today = date( 'Y-m-d', current_time( 'timestamp' ) );
		if ( $date == $today ) {
			$do_tweet = true;
		}
	}

	return $do_tweet;
}
