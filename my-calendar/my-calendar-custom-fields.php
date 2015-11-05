<?php
/*
Plugin Name: Add a custom field to My Calendar events
Plugin URI: http://www.joedolson.com/
Description: Example plug-in demonstrating how to add a custom field to an event in My Calendar
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/


/**
 * Add the input field for your custom field into the main section of My Calendar event details.
 * 
 * @param string $form HTML of any other added custom fields.
 * @param boolean $has_data If true, this is an event being edited or corrected.
 * @param object $event The event object saved.
 * @param string $context 'public' or 'admin', depending on whether this is being rendered in the Pro submissions form or WP Admin.
 *
 * @return string
**/ 
add_filter( 'mc_event_details', 'my_event_email', 10, 4 );
function my_event_email( $form, $has_data, $event, $context ) {
	if ( $has_data ) {
		$post_id = $event->event_post;
		/* Any custom fields are saved as custom post meta */
		$email = esc_attr( get_post_meta( $post_id, '_mc_event_email', true ) );
	} else {
		$email = '';
	}
	$form .= "<p><label for='event_email'>" . __( 'Contact Email', 'yourtextdomain' ) . "</label> <input type='email' name='event_email' id='event_email' value='$email' /></p>";
	
	return $form;
}


/**
 * Save custom fields into post meta.
 *
 * @param int $post_id ID of the post where event meta is saved.
 * @param array $post $_POST array
 * @param array $data Checked array of My Calendar data after processing.
 * @param integer event_id ID of event in my_calendar custom table.
 *
**/
add_action( 'mc_update_event_post', 'my_event_email_save', 10, 4 );
function my_event_email_save( $post_id, $post, $data, $event_id ) {
	if ( is_email( $post['event_email'] ) ) {
		$email = $post['event_email'];
		update_post_meta( $post_id, '_mc_event_email', $email );	
	} 
}

/**
 * Add custom field into template tags array.
 *
 * @param array $details Array of template tags as $tag => $value
 * @param object $event Event object as fetched from database.
 *
 * @return array $details
**/
add_filter( 'mc_filter_shortcodes', 'my_event_email_tag', 10, 2 );
function my_event_email_tag( $details, $event ) {
	$post_id = $event->event_post;
	/* This content will be accessible as {contact_email} in templates. */
	$details['contact_email'] = get_post_meta( $post_id, '_mc_event_email', true );
	
	return $details;
}

