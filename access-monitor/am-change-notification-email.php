<?php
/*
 * Plugin Name: Change Notification Email
 * Plugin URI: http://www.joedolson.com/articles/access-monitor/
 * Plugin Description: Send scheduled test notifications to an address other than the site admin.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

 
add_filter( 'am_cron_notification_email', 'am_change_notification', 10, 2 );
/* 
* 	$email string get_option( 'admin_email' )
*   $name  string name of the test being run as saved when created
*/
function am_change_notification( $email, $name ) {
	$email = "accessibility@yourdomain.com";

	return $email;
}