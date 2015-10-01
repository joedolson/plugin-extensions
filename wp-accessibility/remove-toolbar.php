<?php
/*
Plugin Name: Remove toolbar on a page
Plugin URI: http://www.joedolson.com
Description: Disable the accessibility toolbar on a specific post or page
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_action( 'init', 'my_deregister_scripts' );
function my_deregister_scripts() {
	if ( is_page( 'sign-in' ) ) {
		wp_dequeue_script( 'ui-a11y.js' );
	}
}

add_action( 'wp_enqueue_scripts', 'my_remove_toolbar', 1000 );
function my_remove_toolbar() {
	if ( is_page( 'sign-in' ) ) {
		remove_action( 'wp_footer', 'wpa_toolbar_js' );
	}
}