<?php
/*
Plugin Name: Remove adminbar links for My Calendar
Plugin URI: http://www.joedolson.com/
Description: Hide the 'add event' and 'view calendar' sections in the adminbar
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/


/**
 * Remove the action that creates My Calendar's adminbar links
**/ 
add_action( 'init', 'my_remove_action', 11 );
function my_remove_action() {
	remove_action( 'admin_bar_menu', 'my_calendar_admin_bar', 200 );
}