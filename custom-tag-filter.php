<?php
/*
 * Plugin Name: Custom Tag Filter
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: If you have more than 500 terms in any taxonomy, the UI is disabled. This is a demo plug-in for filtering terms that are in a taxonomy that's had the UI disabled.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */
 
add_filter( 'wpt_filter_terms', 'wpt_filter_a_term', 10, 2 );
/*
*	Receives: $continue (boolean) and $args array containing post type, post info, and post ID.
* 	Returns: $continue (true to Tweet, false to skip).
*	
*/
function wpt_filter_a_term( $continue, $args ) {
	$id = $args['id'];
	// 1,2,3 are term IDs that should not be Tweeted.
	$terms = array( 1,2,3 );
	if ( has_term( $terms, 'post_tags', $id ) ) {
		return false;
	}
	return $continue;
}