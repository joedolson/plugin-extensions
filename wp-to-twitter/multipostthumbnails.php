<?php
/*
 * Plugin Name: MultiPostThumbnails upload
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Upload a custom attachment to Twitter using MultiPostThumbnails
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_post_attachment', 'my_mpt_attachment', 10, 2 );
function my_mpt_attachment( $return, $post_ID ) {
	$posttype = get_post_type( $post_ID ); 
	if ( class_exists( 'MultiPostThumbnails' ) && MultiPostThumbnails::has_post_thumbnail( 'post', 'twitter-image', $post_ID ) ) {
		$return = true;
	} else {
		$return = false;
	}
	return $return;

}

add_filter( 'wpt_image_path', 'custom_image_directory', 10, 2 );
/*
* Pull the path for an image from MultiPostThumbnails to use with Twitter
*/
function custom_image_directory( $path, $args ) {
	if ( class_exists( 'MultiPostThumbnails' ) && MultiPostThumbnails::has_post_thumbnail( 'post', 'twitter-image', $args['id'] ) ) {					
		// get the image for Twitter
		$imgid = MultiPostThumbnails::get_post_thumbnail_id('post','twitter-image',$args['id']); 
		$path = wp_get_attachment_url( $imgid );
		
		// Using amazon S3? Replace your S3 path with local path
		$path = str_replace( 'http://brewbound-images.s3.amazonaws.com/', 'c:\\inetpub\\wp-brewbound\\', $path );
		$path = str_replace( '/', '\\', $path );
	} 
	
	return $path;
}

// Add this code to your theme's functions.php file:

/*
new MultiPostThumbnails( array(
		'label' => 'Twitter',
		'id' => 'twitter-image',
		'post_type' => 'post'
	)
);
*/