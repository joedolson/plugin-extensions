<?php
/*
Plugin Name: My Calendar: Multiple sites
Plugin URI: http://www.joedolson.com
Description: Access the events from multiple subsites in a single calendar. (Multisite only)
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_get_events_site', 'my_custom_sites', 10, 2 );
/**
 * Filters the default value of $site to return an array.
 *
 * @since 3.1.15
 *
 * @param string $site Original value of $site.
 * @param array  $args All arguments passed to calendar.
 *
 * @return array $site
 */
function my_custom_sites( $site, $args ) {
	return array( 1, 2, 3 ); // Array of IDs representing sites in your network.

	return $return;
}