<?php
/*
Plugin Name: Limit maximum number of tickets of a type available in one purchase.
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Restrict visitors from buying large quantities of tickets in one go.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Set a maximum number of tickets available
 *
 * By default, the maximum number of tickets that can be added in a purchase is the number of tickets available.
 * Use this filter to reduce that. 
 */
add_filter( 'mt_max_sale_per_event', 'my_limit_max_sales', 10, 1 );
function my_limit_max_sales( $default ) {
	return 6; // limit of 6 tickets of given type can be added to cart.
}