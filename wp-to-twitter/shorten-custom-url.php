<?php
/*
 * Plugin Name: WP Tweets PRO: Shorten custom URL
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Use WP to Twitter's URL shortening on a URL provided in a custom field
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */
 
 /*
  * You'll need to define the name of the custom field that holds your URL on line 17. Otherwise, this is good to go.
  *
  */
add_filter( 'wpt_custom_shortcode', 'custom_url_shortening', 10, 3 );
function custom_url_shortening( $value, $post_ID, $field ) {
	if ( $field == 'name_of_your_custom_field' && esc_url( $value ) ) {
		$value = apply_filters( 'wpt_shorten_link', $value, $post_ID );
	}
	return $value;
}