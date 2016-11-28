<?php
/*
Plugin Name: My Tickets: send notification on ticket usage
Plugin URI: http://www.joedolson.com
Description: Sends email notification to admin & purchaser when ticket is scanned.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_action( 'mt_ticket_verified', 'my_ticket_verified', 10, 4 );
/**
 * Send an email notification when ticket is scanned if ticket is valid and has not already been verified. 
 * Note that ticket will only register as verified if the verification was saved, which only happens if the 
 * app scanning the QR code is logged into WordPress with appropriate permissions.
 *
 * @param boolean $verified True if ticket validates.
 * @param boolean $is_used True if ticket has already been verified.
 * @param int $purchase_id Post ID for purchase record associated with ticket.
 * @param string $ticket_id ID code for this specific ticket.
 * 
 * @return void
 */
function my_ticket_verified( $verified, $is_used, $purchase_id, $ticket_id ) {
	if ( $verified && !$is_used ) {
		$email = get_post_meta( $purchase_id, '_email', true );
		$last  = get_post_meta( $purchase_id, '_last_name', true );
		$name  = get_the_title( $purchase_id );
		// if no last name has been saved, fallback to full name
		$last  = ( $last == '' ) ? $name : $last;
		$site  = get_bloginfo( 'name' );
		
		$subject = "$site: $last/$ticket_id used";
		$body    = "Ticket #$ticket_id has been used, purchased by $name from $site.";
		
		echo "$subject, $body";
		
		// Notificaton sent to admin
		wp_mail( get_option( 'admin_email' ), $subject, $body );
		// Notification sent to purchaser
		wp_mail( $email, $subject, $body );
	}
}