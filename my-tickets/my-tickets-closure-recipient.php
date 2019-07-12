<?php
/*
Plugin Name: My Tickets Custom Closure Recipient
Plugin URI: http://www.joedolson.com
Description: Send notices about ticketing closures to an alternate address.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mt_closure_recipient', 'my_custom_recipient', 10, 1 );
/**
 * Plug-in demonstrates sending notifications that happen when an event is closed to a different person.
 *
 * @param $email string Recipient email address.
 *
 * @return $email string
 */
function my_custom_recipient( $email ) {

	return 'you@yourexample.com';
}