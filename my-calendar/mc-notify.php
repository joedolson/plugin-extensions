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


function my_event_notification( $action, $data, $event_id, $result ) {
	$title = $data['event_title'];
	$start = $data['event_begin'];	
	if ( $action == 'edit' ) {
		wp_mail( get_option( 'admin_email' ), "Event edited: $start", "$title has been edited." );
	}
	if ( $action == 'delete' ) {
		wp_mail( get_option( 'admin_email' ), "Event deleted: $start", "$title has been deleted." );
	}
}
add_action( 'mc_save_event', 'my_event_notification', 10, 4 );