<?php
/*
Plugin Name: Mark an event as open or closed.
Plugin URI: http://www.joedolson.com/
Description: Replaces 'Event Open' field removed in My Calendar 3.0.
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
add_filter( 'mc_event_details', 'my_event_open', 10, 4 );
function my_event_open( $form, $has_data, $event, $context ) {
	if ( $has_data ) {
		$post_id = $event->event_post;
		/* Any custom fields are saved as custom post meta */
		$checked = ( get_post_meta( $post_id, '_mc_event_open', true ) == 'true' ) ? 'checked="checked"' : '';
	} else {
		$checked = '';
	}
	$form .= "<p><label for='event_open'>" . __( 'Event Open for Registration?', 'yourtextdomain' ) . "</label> <input type='checkbox' name='event_open' id='event_open' value='true' $checked /></p>";
	
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
	if ( isset( $post['event_open'] ) ) {
		$open = $post['event_open'];
		update_post_meta( $post_id, '_mc_event_open', 'true' );	
	} else {
		delete_post_meta( $post_id, '_mc_event_open' );
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
	$details['event_open'] = ( get_post_meta( $post_id, '_mc_event_open', true ) == 'true' ) ? 'This event is open for registration.' : 'This event is closed for registration.';
	
	return $details;
}

