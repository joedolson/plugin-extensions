<?php
/*
Plugin Name: Customize Ticket Type Notification Text
Plugin URI: http://www.joedolson.com/
Description: Example plug-in demonstrating how to replace text using filters in My Tickets.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Replace add to cart text using the mt_render_ticket_type_message filter
 *
 * @param string $text The default text, wrapped in a paragraph with class 'ticket-type-message'
 * @param string $type The type of ticket being bought; either 'eticket', 'printable', 'postal', or 'willcall'
 * This is an example using the 'mt_render_ticket_type_message' filter, 
 * which replaces the text for all ticket type notifications
 */
add_filter( 'mt_render_ticket_type_message', 'my_ticket_type_text', 10, 2 );
function my_ticket_type_text( $text, $type ) {
	if ( $type == 'willcall' ) {
		$text = "Your ticket will be available under your name at the box office 30 minutes before the show."; 
	}
	if ( $type == 'eticket' ) {
		$text = "You will receive a link to view your ticket once payment is completed.";
	}
	
	return $text;
}