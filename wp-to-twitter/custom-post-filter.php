<?php
/*
 * Plugin Name: Custom POST Filter
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Filter Tweets based on custom POST data.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_filter_post_data', 'my_custom_postdata' );
/*
* @filter boolean
* @post $_POST
* Return true to *not* Tweet this post.
*/
function my_custom_postdata( $filter, $post ) {
	// example: using PolyLang, if this is not the English version, do not Tweet.
    if ( isset( $post['post_lang_choice'] ) && $post['post_lang_choice'] != 'en' ) {
		$filter = true;
	}
	return $filter;
}