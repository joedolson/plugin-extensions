<?php
/*
 * Plugin Name: Change Tweet Repeat Limit
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: By default, WP Tweets PRO only provides 3 repeats. Change the allowed count and selector.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */
 
 
/**
 * Default value of $count is 4, which produces options from 0-3. Change to 5 to allow retweets. 
 * These are two separate filters for the selector drop down in settings (wpt_tweet_repeat_count) and for the limit, which dictates the max number allowed. 
 * The second filter can also take a second argument, $post_ID; if used, these must be two separate functions.
 *
 * @param $count integer
 * @return integer
 */
add_filter( 'wpt_tweet_repeat_count', 'my_tweet_repeat', 10 );
add_filter( 'wpt_tweet_repeat_limit', 'my_tweet_repeat', 10 );
function my_tweet_repeat( $count ) {
	return 6; 
}