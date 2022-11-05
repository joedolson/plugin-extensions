<?php
/*
Plugin Name: Add one ticket by default
Plugin URI: http://www.joedolson.com/my-tickets/
Description: By default, My Tickets requires you to check a box or select a number of tickets before adding to cart. This makes the default to be checked/one ticket.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Set the default number of tickets to add to cart to 1
 */
add_filter( 'mt_cart_default_value', 'my_cart_default_value', 10, 1 );
function my_cart_default_value( $default ) {
	return 1; // Default one ticket. Will set as checked for checkboxes.
}
