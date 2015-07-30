<?php
/*
 * Plugin Name: Bridge: Tweet Disqus Comments
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Allows comments processed through Disqus Comment System to be Tweeted automatically.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

/* 
 * Tests whether comment is both approved and has a Disqus user agent, and sets & publishes Tweet if so.
 *
*/
add_action( 'wp_insert_comment', 'wpt_disqus_comment_tweet', 10, 2 );
function wpt_disqus_comment_tweet( $id, $comment ) {
	$approved = $comment->comment_approved;
	$agent = $comment->comment_agent;
	if ( $approved == 1 && strpos( $agent, 'Disqus' ) !== false ) {
		wpt_set_comment_tweet( $id, 1 );
	}
}
