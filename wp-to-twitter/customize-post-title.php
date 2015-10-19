<?php
/*
 * Plugin Name: Customize Post Titles
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Make a modification to post titles before Tweeting
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_post_info', 'my_custom_title', 10, 2 );
/*
* @values Array of info about the post
* @id $post ID 
*
* The values array is an array containing information about the post for use in template tag replacements. 
* Changing these values will change their use in template tags.
* Any value that's used in character counting will no longer be accurate, since this change will *not* be accounted for there.
*
*/
function my_custom_title( $values, $id ) {
	$title = $values['postTitle'];
	/** 
	 * Example: remove spaces from title
	 */
	$title = str_replace( ' ', '', $title ); // remove spaces in title
	
	return $values;
}