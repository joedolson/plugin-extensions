<?php
/*
 * Plugin Name: Filter Tweets by Author & Category
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Creates a filter based on a combination of author & category 
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_filter_terms', 'my_custom_filters', 10, 2 );
/*
*	Example: if post is in either the 'wordpress' category or the 'plugins' category, don't Tweet, and by author with ID '2', don't Tweet
*	Uses: WP core is_object_in_term() http://codex.wordpress.org/Function_Reference/is_object_in_term
*/
function my_custom_filters( $continue, $args ) {
	if ( is_object_in_term( $args['info']['id'], 'category', array( 'wordpress', 'plugins' ) ) && $args['info']['authId'] == 2 ) {
		$continue = false;
	}
	
	return $continue;
}