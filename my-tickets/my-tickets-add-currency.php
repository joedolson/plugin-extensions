<?php
/*
Plugin Name: Add currency to offline payments
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Add your own currency to offline payment gateway
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Insert a custom currency into offline payments
 *
 */
add_filter( 'mt_currencies', 'my_currencies', 10, 1 );
function my_select_events_count( $currencies ) {
	$new =  array( 
			'symbol'      => '₹',
			'description' => 'Indian Rupees (₹)',
			// 'zerodecimal' => true // If your currency does not use decimals, include this parameter as true
		);

	$currencies['INR'] = $new;
	
	return $currencies;	
}