<?php
/**
* Plugin Name: Random Image to Twitter
* Plugin URI: http://www.joedolson.com/wp-tweets-pro/
* Description: Sends a random image uploaded to the current post rather than picking the first.
* Version: 1.0 or whatever version of the plugin (pretty self explanatory)
* Author: Joe Dolson
* Author URI: https://www.joedolson.com
* License: A "Slug" license name e.g. GPL12
*/

add_filter( 'wpt_post_attachment', 'my_random_attachment', 10, 2 );
/**
 * Switches the Tweeted image to a random image.
 *
 * @param int $attachment_ID The original attachment ID selected by the plug-in.
 * @param int $post_ID The ID of the post being Tweeted about.
 *
 * @return int
 */
function my_random_attachment( $attachment_ID, $post_ID ) {
	// code to get your random image & get its attachment ID.
	$args          = array(
		'post_type'      => 'attachment',
		'numberposts'    => 1,
		'orderby'        => 'rand',
		'post_parent'    => $post_ID,
		'post_status'    => 'any',
		'post_mime_type' => 'image',
	);
	$posts         = get_posts( $args );
	$attachment_ID = $posts[0]->post_ID;

	return $attachment_ID;
}