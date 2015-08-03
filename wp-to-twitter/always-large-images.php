<?php
/*
Plugin Name: WP Tweets PRO Twitter Cards: Always use Large Image
Plugin URI: http://www.joedolson.com/wp-to-twitter/
Description: Always use the summary_large_image format of Twitter Card when using any summary card.
Version: 1.0
Author: Joe Dolson
Author URI: http://www.joedolson.com
*/


add_action( 'wpt_summary_large_image_excerpt', 'my_toggle_large_image_excerpt', 10, 1 );
/**
 * @arg integer $chars Any content excerpt below this number of characters will toggle to a large image excerpt.
 */
function my_toggle_large_image_excerpt( $chars ) {
	$chars = 1500; // set to a number high enough that it will trigger on your site.
	return $chars;
}