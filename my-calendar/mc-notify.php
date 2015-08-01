<?php
/*
Plugin Name: Notifications on edit & delete
Plugin URI: http://www.joedolson.com/my-calendar/
Description: Send the admin a notification when an event is edited or deleted.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2015  Joseph C Dolson  (email : plugins@joedolson.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * When an event is edited, send the admin a notification.
 */
add_action( 'mc_save_event', 'my_event_notification', 10, 4 );
function my_event_notification( $action, $data, $event_id, $result ) {
	$title = $data['event_title'];
	$start = $data['event_begin'];	
	if ( $action == 'edit' ) {
		wp_mail( get_option( 'admin_email' ), "Event edited: $start", "$title has been edited." );
	}
}

/**
 * This function needs to run *after* the event is deleted from My Calendar, but *before* the event post is deleted.
 */
add_action( 'mc_delete_event', 'my_event_deleted_notification', 5, 2 );
function my_event_deleted_notification( $event_id, $post_id ) {
	// get the post for this event.
	$event = get_post( $post_id );
	$title = $event->post_title;
	// get the event data saved with the post
	$data = get_post_meta( $post_id, '_mc_event_data', true );
	$start = $data['event_begin'];
	wp_mail( get_option( 'admin_email' ), "Event deleted: $start", "$title has been deleted." );
}
