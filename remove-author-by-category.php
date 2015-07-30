<?php
/*
 * Plugin Name: Remove account by category
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Creates a Twitter account targeting filter based on a combination of author & category 
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_filter_users', 'remove_main_account_by_category', 10, 2 );
/*
*	Example: if post is in either the 'wordpress' category or the 'plugins' category, remove 'main' account from author array. (E.g., send only to author account)
*	Uses: WP core is_object_in_term() http://codex.wordpress.org/Function_Reference/is_object_in_term
* 	$authors = array of user IDs to Tweet to
*/
function remove_main_account_by_category( $authors, $post_info ) {
	$categories = array( 'wordpress', 'plugins' );
	if ( is_object_in_term( $post_info['id'], 'category', $categories ) ) {
		unset( $authors['main'] );
	}
	return $authors;
}