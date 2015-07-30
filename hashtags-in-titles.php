<?php
/*
 * Plugin Name: Hashtags in Titles
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Replaced defined list of words with hashtags
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_status', 'my_custom_hashtags', 10, 3 );
/*
* @title Post Title
* @id $post ID
* @context 'title' or 'post'
*
* You can already automatically filter your post tags into titles, but this handles a
* finite list of terms you want to replace that you don't use as tags. It's a little
* more flexible in terms of replacements, since the original term can be radically
* different from the replacement.
*
* Terms are examples, and are expected to be customized. Replacements are not case sensitive.
*/
function my_custom_hashtags( $title, $id, $context ) {
	if ( $context == 'title' ) {
		$replacements = array(
			'ipad'=>'#ipad',
			'ipod'=>'#ipod',
			'apple'=>'#apple',
			'android'=>'#android',
			'follow friday'=>'#ff'
		);
		foreach ( $replacements as $key=>$value ) {
			$title = str_ireplace( $key, $value, $title );
		}
	}
	return $title;
}