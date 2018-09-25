<?php
/**
 * Plugin Name: Custom AutoPost Selection
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Customize the WP Query used to select posts for autoposting.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */
 
add_filter( 'wpt_autopost_args', 'my_autopost_args' );
/**
 * @param array $args WP_Query arguments array
 *
 * @return array
 *
 */
function my_autopost_args( $args ) {
	/**
	// The basic query looks like this. It can include a meta_query parameter as well, if the custom Tweet option is enabled.
		$args   = array(
		'post_type'      => $post_types,
		'date_query'     => array(
				'after'     => $after,
				'before'    => $before,
				'inclusive' => true,
			),
		'fields'         => 'ids',
		'post_status'    => 'publish',
		'posts_per_page' => '-1',
	);
	*/
	// Add a custom taxonomy query to the array.
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => 'your-category-slug',
		);
	);


	return $args;
}