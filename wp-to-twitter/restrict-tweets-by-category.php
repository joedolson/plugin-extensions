<?php
/*
 * Plugin Name: Restrict Tweets Category
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Automatically enable or disable Tweets if in specific category
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_restrict_terms', 'my_custom_filters', 10, 2 );
/*
*	Example: if post is in either the 'wordpress' category or the 'plugins' category, Tweet; otherwise, don't.
*	Uses: WP core is_object_in_term() http://codex.wordpress.org/Function_Reference/is_object_in_term
*/
function my_custom_filters( $continue, $args ) {
	if ( is_object_in_term( $args['info']['id'], 'category', array( 'wordpress', 'plugins' ) ) ) {
		$continue = true;
	} else {
		$continue = false;
	}
	
	return $continue;
}