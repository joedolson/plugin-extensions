<?php
/*
Plugin Name: Use a select list for ticket ordering
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Default is a number input field; switch to select list
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Use of all passed values is very important.
 * 
 * @param string $input_type default input type used by My Tickets for this event
 * @param string $type current ticket type (e.g. adult, child, etc.)
 * @param integer $value Number of tickets selected
 * @param string $attributes min max values & readonly values if no tickets remaining
 * @param string $disable disabled input if no tickets remaining
 * @param integer $max maximum number of tickets available 
 * @param mixed integer/string $available Number of tickets available currently or 'inherit'.
 *
 * If using a <select> element, you'll need to define what options are available.
 */
add_filter( 'mt_add_to_cart_input', 'my_add_to_cart_input', 10, 8 );
function my_add_to_cart_input( $default, $input_type, $type, $value, $attributes, $disable, $max, $available ) {
	$return = "<select name='mt_tickets[$type]' id='mt_tickets_$type' class='tickets_field' $attributes aria-labelledby='mt_tickets_label_$type mt_tickets_data_$type'$disable />";
	for( $i=0;$i<$max;$i++ ) {
		$return .= "<option value='$i'>$i</option>";
	}
	$return .= "</select>";
	
	return $return;
}