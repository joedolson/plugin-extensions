<?php
/*
 * Plugin Name: Custom Hashtag Source Taxonomy
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Use an alternate taxonomy as the source for Hashtags.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

// Use in source:
// $tags = apply_filters( 'wpt_hash_source', $tags, $post_ID );


/**
 * Use alternate data source for term conversion to tags. @since WP to Twitter 3.3.0
 *
 * @argument $tags original array of term objects
 * @argument $post_ID integer: ID of post being Tweeted
 *
 * @return new array of term objects
 */
add_filter( 'wpt_hash_source', 'my_hash_source', 10, 2 );
function my_hash_source( $tags, $post_ID ) {
	if ( get_post_type( $post_ID ) == 'mcm_people' ) {
		// If Tweeting a post of post-type "relevant-post-type", use 'your-taxonoy-name' as the source for hashtags.
		$taxonomy = 'mcm_category_people';
		$terms = wp_get_post_terms( $post_ID, $taxonomy );
	} else {
		$terms = $tags;
	}

	return $terms;
}

/**
 * Add WP Tweets PRO custom tag controls into term editor
 * 
 * @argument mixed array/boolean Array of taxonomy slugs or false
 */
add_filter( 'wpt_hash_tag_sources', 'my_hash_tag_sources' );
function my_hash_tag_sources( $sources ) {
	// return array of taxonomy names or false
	return array( 'mcm_category_people' );
}