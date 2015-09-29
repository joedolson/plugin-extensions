<?php
/*
Plugin Name: My Tickets: Custom Cart Fields
Plugin URI: http://www.joedolson.com
Description: Add a custom field to the shopping cart
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

/*
 * Create custom field added to My Tickets shopping cart.
 *
 * @param $custom_fields array Any other existing fields.
 * @param $cart array Data currently existing in cart.
 * @param $gateway string Current gateway identifier.
 *
 * @return array New array of custom fields.
**/

add_filter( 'mt_cart_custom_fields', 'my_custom_fields', 10, 3 );
function my_custom_fields( $custom_fields, $cart, $gateway ) {

	// this includes the 'required' parameter; but this example does not include any 
	// server-side or client-side verification.
	$custom_fields['code_of_conduct'] = '<p class="code_of_conduct"><label for="code_of_conduct">Agree to our code of conducct</label> <input type="checkbox" required name="code_of_conduct" id="code_of_conduct" /></p>';

	return $custom_fields;
}

/*
 * Save checked value into payment record.
 *
 * @param $payment integer post ID for payment
 * @param $post $_POST 
 *
 * @return null
 */
add_filter( 'mt_handle_custom_cart_data', 'my_save_custom_field', 10, 2 );
function my_save_custom_field( $payment, $post ) {
	if ( isset( $_POST['code_of_conduct'] ) ) {
		update_post_meta( $payment, '_coc', 'Agreed to code of conduct' );
	} else {
		update_post_meta( $payment, '_coc', 'Did not agree to code of conduct' );
	}
}

/*
 * Display information on payments page.
 *
 * @param $output string. Any other custom output.
 * @param $post_ID Payment ID
 *
 * @return string Output string plus new output.
 */
add_filter( 'mt_show_in_payment_fields', 'my_show_custom_field', 10, 2 );
function my_show_custom_field( $output, $post_ID ) {
	$coc = get_post_meta( $post_ID, '_coc', true );
	return $output . $coc;
}


/*
 * Add confirmation value to notifications output.
 */
add_filter( 'mt_notifications_data', 'my_custom_notification', 10, 2 );
function my_custom_notification( $data, $details ) {
	$coc = get_post_meta( $details['id'], '_coc', true );
	if ( $coc ) {
		$data['coc'] = $coc;
	} else {
		$data['coc'] = __( 'No code of conduct information available.', 'yourtextdomain' );
	}
	
	return $data;
}