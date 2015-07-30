<?php
/*
 * Plugin Name: Randomized Delay
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Randomizes the amount of time between posting and Tweeting. 
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_schedule_delay', 'my_retweet_delay', 10, 2 );
function my_retweet_delay( $time, $acct ) {
	$min = 60; // 1 minute
	$max = 1800; // 30 minutes
	$time = mt_rand( $min, $max );
	return $time;
}