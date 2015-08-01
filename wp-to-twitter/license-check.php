<?php
/*
 * Plugin Name: License Check
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Check licensing issues.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

 /**
  * This is a plugin for testing the response of licensing queries from WP Tweets PRO. 
  * It's for running a test to see what data the license is returning if it's getting invalid data.
  */
  
add_action( 'admin_init', 'jd_test_license' );
function jd_test_license() {
	if ( is_admin() && isset( $_GET['test_license'] ) && $_GET['test_license'] == 'true' ) {
		check_jd_license();
	}
}
 
function check_jd_license() {
	$key = 'abcdefgh';
	define('WPT_PRO_PLUGIN_LICENSE_URL', "https://www.joedolson.com/wp-content/plugins/files/license.php" );
	$response = wp_remote_post( WPT_PRO_PLUGIN_LICENSE_URL, 
		array (
			'user-agent' => 'WordPress/WP Tweets PRO Test; ' . get_bloginfo( 'url' ), 
			'body'=>array ('key'=>$key, 'site'=>urlencode(home_url()) ),
			'timeout' 	=> 120
		) );
	wp_mail( get_option( 'admin_email' ), 'License Response', "Response: " . print_r( $response, 1 ) );
	if ( ! is_wp_error( $response ) || is_array( $response ) ) {
		$data = $response['body'];
		if ( !in_array( $data, array( 'false', 'inuse', 'true', 'unconfirmed' ) ) ) {
			$data = @gzinflate(substr($response['body'],2));
		}
		return $data;
	}
	wp_mail( get_option( 'admin_email' ), 'License Data', "Licensing Tested: $data" );
		
}