<?php
/*
Plugin Name: Video Importer + WP to Twitter
Plugin URI: http://www.joedolson.com/wp-to-twitter/
Description: Delay publishing of videos. Set video imports to import as Drafts.
Version: 1.0
Author: Joe Dolson
Author URI: http://www.joedolson.com
*/


add_action( 'refactored_video_importer/single_video_imported', 'wp_to_twitter_post_publish', 15, 3 );
/**
 * Uses video imported action to publish post, so that all post meta is already available when the post is published.
 */
function wp_to_twitter_post_publish( $post_id, $provider, $video_array ) {
	wp_publish_post( $post_id );
}