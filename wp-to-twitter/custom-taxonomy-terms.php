<?php
/*
 * Plugin Name: WP Tweets PRO: Custom taxonomy terms
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
  * @return the value to be passed into the Tweet. This example returns a space-separated list of all terms in the provided taxonomy on this post.
  */
add_filter( 'wpt_custom_shortcode', 'my_custom_taxonomy_terms', 10, 3 );
function my_custom_author_field( $value, $post_ID, $field ) {
	if ( $field == 'terms' ) {
		$terms = get_the_terms( $post_ID, 'your-custom-taxonomy' );
		foreach ( $terms as $term ) {
			$names[] = $term->name;
		}
		$value = implode( ' ', $names );
	}
	
	return $value;
}