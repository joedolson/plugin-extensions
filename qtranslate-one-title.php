<?php
/*
 * Plugin Name: qTranslate: Just one Title
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: qTranslate mashes both language titles into one field. This removes the extra title so that only the primary title is Tweeted.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_post_info','wpt_qtranslate_title', 10, 2 );
/*
* @string Post Title
* @id $post ID
* @context 'title' or 'post'
*
* Filters the title text, applies regex to detect matches with qTranslate, pulls out primary.
*/
function wpt_qtranslate_title( $values, $id ) {
	// qTranslate filters get_the_title to get primary.
	$title = get_the_title( $id );
	$title = stripcslashes( strip_tags( $title ) );
	$values['postTitle'] = $title;
	return $values;
}