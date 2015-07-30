<?php
/*
 * Plugin Name: WP Tweets PRO: Editor Power
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Grant editors permission to see all WP Tweets PRO screens.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

/* Grant access to main WP Tweets PRO settings */
add_filter( 'wpt_main_settings', 'my_custom_main_perms' );
function my_custom_main_perms( $capability ) {
      return 'edit_others_posts';
}

/* Grant access to WP Tweets PRO Scheduled Tweets */
add_filter( 'wpt_scheduled_tweets_capability', 'my_custom_scheduling_perms' );
function my_custom_scheduling_perms( $capability ) {
      return 'edit_others_posts';
}

/* Grant access to WP Tweets PRO Past Tweets */
add_filter( 'wpt_past_tweets_capability', 'my_custom_past_perms' );
function my_custom_past_perms( $capability ) {
      return 'edit_others_posts';
}

/* Grant access to WP Tweets PRO Failed Tweets */
add_filter( 'wpt_error_tweets_capability', 'my_custom_error_perms' );
function my_custom_error_perms( $capability ) {
      return 'edit_others_posts';
}