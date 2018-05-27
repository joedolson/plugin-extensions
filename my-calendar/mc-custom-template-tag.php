<?php
/*
Plugin Name: My Calendar Custom Template Tag
Plugin URI: http://www.joedolson.com
Description: Add a custom template tag to My Calendar
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_filter_shortcodes', 'my_custom_tag', 10, 2 );
/**
 * This plug-in demonstates adding a custom template tag. 
 *
 * Usage: {custom_tag}
 *
 * @param array $e Array of existing template tags.
 * @param object $event Source event object.
 *
 * @return array $e
 */
function my_custom_tag( $e, $event ) {
	// The array key is the template tag.
	$e['custom_tag'] = "Your Content generated from source event $event->ID.";

	return $e;
}