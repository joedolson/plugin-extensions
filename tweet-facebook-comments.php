<?php
/*
 * Plugin Name: Bridge: Tweet Facebook Comments with Ultimate Facebook
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Allows comments imported from Facebook using Ultimate Facebook to be Tweeted automatically.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

/* 
 * Tests whether comment is both approved and has a facebook.com author URL, and sets & publishes Tweet if so.
 *
*/
add_action( 'wp_insert_comment', 'wpt_facebook_comment_tweet', 10, 2 );
function wpt_facebook_comment_tweet( $id, $comment ) {
	$approved = $comment->comment_approved;
	$url = $comment->comment_author_url;
	if ( $approved == 1 && strpos( $url, '//www.facebook.com' ) !== false ) {
		wpt_set_comment_tweet( $id, 1 );
	}
}
