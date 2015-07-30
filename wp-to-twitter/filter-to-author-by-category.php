<?php
/*
 * Plugin Name: Filter to Authors by Category
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Creates a Twitter account targeting filter based on a combination of author & category 
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */


add_filter( 'wpt_filter_users', 'send_to_user_account_by_category', 10, 2 );
/*
*	Example: if post is in either the 'wordpress' category or the 'plugins' category, Tweet to authors with ID 5
*	Uses: WP core is_object_in_term() http://codex.wordpress.org/Function_Reference/is_object_in_term
*/
function send_to_user_account_by_category( $authors, $post_info ) {
	/* 
	 * Define an array with the slugs of all categories you want sent to this set of authors 
	 * You can repeat this pattern to send different categories to different authors
	 */
	$categories = array( 'wordpress', 'plugins' );
	if ( is_object_in_term( $post_info['id'], 'category', $categories ) ) {
		/* Define array of author IDs that this set of categories are sent to */
		$authors = array( 5 );
	}
	$categories = array( 'drupal', 'core' );
	if ( is_object_in_term( $post_info['id'], 'category', $categories ) ) {
		/* Define array of author IDs that this set of categories are sent to */
		$authors = array( 4 );
	}	
	return $authors;
}