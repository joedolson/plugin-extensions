<?php
/*
 * Plugin Name: Remove Meta Box for User Roles
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Completely remove the WP to Twitter Meta Box based on role
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_action( 'admin_menu', 'my_remove_wpt_meta' );
/**
 * Iterate over enabled post types and remove meta box if user cannot Tweet.
 */
function my_remove_wpt_meta() {
	if ( ! current_user_can( 'wpt_can_tweet' ) ) {
		$wpt_post_types = get_option( 'wpt_post_types' );
		if ( is_array( $wpt_post_types ) ) {
			foreach ( $wpt_post_types as $key => $value ) {
				if ( '1' === $value['post-published-update'] || '1' === $value['post-edited-update'] ) {
					remove_meta_box( 'wp2t', $key, 'side' );
				}
			}
		}
	}
}
