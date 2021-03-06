<?php
/*
 * Plugin Name: Bypass Authors in post meta
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Author assignment is dependent on post meta. Bypasses this for use in apps that don't pass meta data.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

 
add_filter( 'wpt_filter_users', 'include_main_account', 10, 2 );
/*
*	Passes post author and main account into authors array regardless of settings. 
* 	$authors = array of user IDs to Tweet to
*   Despite appearances, using 'main'=>false adds the Main account into the array. 
*/
function include_main_account( $authors, $post_info ) {
	if ( wtt_oauth_test( $post_info['authId'], 'verify' ) ) {
		// $authors = array( 14, 'main'=>false ); 	// if you want a specific Author ID
		$authors = array( $post_info['authId'], 'main'=>false ); // if you want the author of the post being published
	} else {
		$authors = array( 'main'=>false );
	}
	return $authors;
}