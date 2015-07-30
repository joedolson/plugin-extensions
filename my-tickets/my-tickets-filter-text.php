<?php
/*
Plugin Name: Customize Text in My Tickets
Plugin URI: http://www.joedolson.com/
Description: Example plug-in demonstrating how to replace text using filters in My Tickets.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Replace add to cart text using the mt_add_to_cart_text filter
 *
 * This is an example using the 'mt_add_to_cart_text' filter, which replaces the text for the Add to Cart button.
 * There are many text filters available in My Tickets beyond this example.
 */
add_filter( 'mt_add_to_cart_text', 'my_add_to_cart_text', 10, 1 );
function my_add_to_cart_text( $default ) {
	return "Add Tickets to Cart"; // your custom text
}