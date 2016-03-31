<?php
/*
 * Plugin Name: WP Tweets PRO: Custom Field Content
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Use the WP to Twitter custom field template tags for advanced content
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */
 
 /*
  * The $field variable is the string between [[ and ]] in your template tag. 
  * By default, the [[template_tag]] pattern pulls from a custom field. However, it can pull any content, defined here.
  *
  * @param $value the value of the custom field (will be empty in this example)
  * @param $post_ID the post ID of the post being Tweeted
  * @param $field the name of the field in the template tag
  * 
  * @return the value to be passed into the Tweet. This examples returns the first name of the post author.
  */
add_filter( 'wpt_custom_shortcode', 'my_custom_author_field', 10, 3 );
function my_custom_author_field( $value, $post_ID, $field ) {
	if ( $field == 'author_name' ) {
		$post = get_post( $post_ID );
		$author = $post->post_author;
		$value = get_the_author_meta( 'first_name', $author );
	}
	
	return $value;
}