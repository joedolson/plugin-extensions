<?php
/*
Plugin Name: Limit displayed information after event ends
Plugin URI: http://www.joedolson.com/
Description: Example plug-in demonstrating how to change event output after an event has ended.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/


/**
 * @param string $details The block of outputted event HTML
 * @param object $event The event object
 * @param object $type The current view: calendar, mini, list, single, etc. 
 * @param string $time The current time view: month, week, day.
 *
 * @return string
**/ 

		$details = apply_filters( 'mc_event_content', $details, $event, $type, $time );

add_filter( 'mc_event_content', 'my_event_content', 10, 4 );
function my_event_email( $details, $event, $type, $time ) {
	if ( my_calendar_date_xcomp( $event->occur_end, date( 'Y-m-d', current_time( 'timestamp' ) ) ) ) {
		$data = mc_create_tags( $event );
		// this is just a sample template; you'd want to customize it.
		$details = jd_draw_template( $data, '<h2>{title}</h2>{image}' );
	}
	
	return $details;
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

