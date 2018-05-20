<?php
/*
Plugin Name: My Calendar Pro: Post-submission redirect
Plugin URI: http://www.joedolson.com
Description: Redirect to custom thank you page.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mcs_run_processor_completed', 'mcs_run_processor_completed', 10, 2 );
/**
 * Redirect after submitting form.
 */
function mcs_run_processor_completed( $state, $response ) {
	// Prevent resubmitting the same form.
	unset( $_POST );
	// Redirect to a page that contains your post-submission message.
	wp_safe_redirect( 'https://dev.josephdolson.com/?response=thanks' );
}