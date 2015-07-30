<?php
/*
 * Plugin Name: Alternate Tweet Schedule
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Sets a separate delay between each retweet. Default: 12 hours, 48 hours, and 7 days.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_schedule_retweet', 'my_retweet_schedule', 10, 4 );
function my_retweet_schedule( $time, $acct, $rt, $post ) {
     $hour = 60 * 60;
     $rt1 = 12 * $hour; // first re-Tweet out 12 hours
     $rt2 = 48 * $hour; // second re-Tweet out 48 hours
     $rt3 = 168 * $hour; // third re-Tweet out 168 hours
     switch ( $rt ) {
          case 1: return $rt1; break;
          case 2: return $rt2; break;
          case 3: return $rt3; break;
     }
     return $time;
}