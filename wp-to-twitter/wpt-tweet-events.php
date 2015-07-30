<?php
/*
 * Plugin Name: Tweet Events
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Filter Tweets based on custom POST data.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_action( 'em_event_save_pre', 'my_custom_postdata' );
/*
* @filter boolean
* @post $_POST
* Return true to *not* Tweet this post.
*/
function my_custom_postdata( $event ) {
	wp_mail( 'joe@joedolson.com', 'EM Event', print_r( $event, 1 ) );
}