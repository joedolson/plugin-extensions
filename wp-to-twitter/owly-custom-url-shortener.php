<?php
/*
Plugin Name: Custom URL Shortener (Ow.ly)
Plugin URI: http://www.wptweetspro.com/wp-tweets-pro
Description: Adds support for Ow.ly as a URL shortener in WP to Twitter
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/

/**
 * Add Ow.ly as a selectable option.
 */
add_filter( 'wpt_choose_shortener', 'my_choose_shortener', 10, 2 );
function my_choose_shortener( $output, $shortener ) {
	// use only lowercase alphanumerics, dashes, and underscores.
	// Value will be sanitized using sanitize_key.
	$output .= '<option value="owly"' . selected( $shortener, 'owly', false ) . '>Ow.ly</option>';
	
	return $output;
}

add_filter( 'wpt_shortener_settings', 'my_shortener_settings', 10, 4 );
function my_shortener_settings( $output, $selected ) {
	if ( $selected == 'owly' ) {
		$output .= '<p>
					<label for="owly_api_key">' . __( "Ow.ly API Key", 'textdomain' ) . '</label>
					<input type="text" name="owly_api_key" id="owly_api_key" size="40" value="' . esc_attr( get_option( 'owly_api_key' ) ) . '" />
				</p>';
	}
				
	return $output;
}

add_filter( 'wpt_save_shortener_settings', 'my_save_shortener_settings' );
function my_save_shortener_settings( $message ) {
	if ( isset( $_POST['owly_api_key'] ) ) {
		$api_key  = sanitize_text_field( $_POST['owly_api_key'] );
		update_option( 'owly_api_key', $api_key );
		$message .= __( 'Your Ow.ly API key has been updated.', 'textdomain' );
	}
	
	return $message;
}

add_filter( 'wpt_do_shortening', 'my_do_shortening', 10, 6 );
function my_do_shortening( $shrink, $shortener, $url, $post_title, $post_ID, $testmode ) {
	// ensure that $shrink is always defined as a valid URL
	$shrink = $url;
	if ( $shortener == 'owly' ) {
		// URL is not encoded when passed to this filter
		$url      = urlencode( $url );
		// jd_remote_json returns an array decoded from the JSON response
		$apiKey   = get_option( 'owly_api_key' );
		$response = wpt_remote_json( add_query_arg( array( 'apiKey' => $apiKey, 'longUrl'=>$url ), 'http://ow.ly/api/1.1/url/shorten' ) );
		// if the response is a string, then this was an error. 
		// Ignore error and continue with default plug-in shortening.
		if ( !is_string( $response ) ) {
			$shrink   = $response['results']['shortUrl'];			
		}
	}
	
	return $shrink;
}