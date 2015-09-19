<?php
/*
 * Plugin Name: Allow Editors
 * Plugin URI: http://www.joedolson.com/articles/access-monitor/
 * Plugin Description: Grant editors permission to view and manage Access Monitor settings
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

 
add_filter( 'am_use_monitor', 'am_allow_editors', 10, 1 );
/* 
* 	$capability 'manage_options'
*/
function am_allow_editors( $capability ) {
	$capability = 'delete_others_posts'; // use a capability available to the user role you want to allow

	return $capability;
}