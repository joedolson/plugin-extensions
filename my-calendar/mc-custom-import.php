<?php
/*
Plugin Name: My Calendar Custom Template
Plugin URI: http://www.joedolson.com
Description: Add a custom template to My Calendar
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mcs_imported_event', 'my_custom_event', 10, 1 );
add_filter( 'mcs_updated_event', 'my_custom_event', 10, 1 );
/**
 * This plug-in demonstrates customizing an event at the time it is imported.
 *
 * @param $event Array of event data
 *
 * @return $event array
 */
function my_custom_event( $event ) {
	// This example checks whether the only content of the 'description' field is a link.
	// If it is, it inserts the link value as an event_link and empties the description field.
	$description = trim( $event['event_desc'] );
	$event_link  = isset( $event['event_link'] ) ? esc_url( $event['event_link'] ) : '';
	// If the description is a valid URL & there's no existing link, swap them. 
	if ( esc_url( $description ) && ! $event_link ) {
		$event['event_link'] = $description;
		$event['event_desc'] = '';
	}

	return $event;
}