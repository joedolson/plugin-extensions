<?php
/*
 * Plugin Name: Custom Image Directory
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Passes an alternate image directory for uploading media to Twitter.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_image_path', 'custom_image_directory', 10, 2 );
/*
*	Example: WP to Twitter can have trouble picking the right URL if you're using a custom path for images. Use this filter to correct the path.
*/
function custom_image_directory( $path, $args ) {
	// Uncomment below and publish a new post with image upload to learn what WP to Twitter is currently using for your image upload path.
	// wp_mail( get_option( 'admin_email' ), 'Check Image Upload Path', $path ); 
	$path = str_replace( '/public/uploads/', '/public/cdn/uploads/', $path );
	return $path;
}