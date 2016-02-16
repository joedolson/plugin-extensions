<?php
/*
Plugin Name: Custom URL Shortener (Readability)
Plugin URI: http://www.joedolson.com/wp-tweets-pro
Description: Adds support for Readability as a URL shortener in WP to Twitter
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Add Readability as a selectable option.
 */
add_filter( 'wpt_choose_shortener', 'my_choose_shortener', 10, 2 );
function my_choose_shortener( $output, $shortener ) {
	// use only lowercase alphanumerics, dashes, and underscores.
	// Value will be sanitized using sanitize_key.
	$output .= '<option value="readability"' . selected( $shortener, 'readability', false ) . '>Readability</option>';
	
	return $output;
}

add_filter( 'wpt_shortener_settings', 'my_shortener_settings', 10, 4 );
function my_shortener_settings( $output, $selected ) {
	if ( $selected == 'readability' ) {
		$output .= 'No settings are required for your chosen URL shortener.';
	}
				
	return $output;
}

// This is an example of how you would do this if it were required.
/*
add_filter( 'wpt_save_shortener_settings', 'my_save_shortener_settings' );
function my_save_shortener_settings( $message ) {
	if ( isset( $_POST['readability_api_key'] ) ) {
		$api_key  = sanitize_text_field( $_POST['readability_api_key'] );
		update_option( 'readability_api_key', $api_key );
		$message .= __( 'Your Readability API key has been updated.', 'textdomain' );
	}
	
	return $message;
}
*/

add_filter( 'wpt_do_shortening', 'my_do_shortening', 10, 6 );
function my_do_shortening( $shrink, $shortener, $url, $post_title, $post_ID, $testmode ) {
	// ensure that the return value is always defined as a valid URL.
	$shrink = $url;
	if ( $shortener == 'readability' ) {
		// if you needed an API key, you'd fetch it now.
		//$apiKey   = get_option( 'readability_api_key' );
		$response = wp_remote_post( add_query_arg( 'url', $url, 'http://readability.com/api/shortener/v1/urls' ), array( 'body' => array( 'url' => $url ) ) );
		
		if ( !is_wp_error( $response ) ) {
			$json = json_decode( $response['body'] );
			$meta = $json->meta;		
			// Ignore error and continue with default plug-in shortening.
			if ( ! empty( $meta ) ) {
				$shrink   = $meta->rdd_url;			
			} else {
				// this was an error
			}
		}
	}
	
	return $shrink;
}