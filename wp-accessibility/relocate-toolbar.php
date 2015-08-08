<?php
/*
 * Plugin Name: Relocate Toolbar
 * Plugin URI: http://www.joedolson.com/wp-accessibility
 * Plugin Description: Attach the toolbar to an element other than the HTML body element.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

/**
 * By default, the A11y toolbar is attached to the body element. Use this filter to attach to some other element.
 * 
 * @param string default attachment element: body
 * 
 * @return string HTML selector string valid for use in jQuery
 */
add_filter( 'wpa_move_toolbar', 'my_toolbar_location' );
function my_toolbar_location( $selector ) {
   return '#content'; // attach to your theme's #content div
}