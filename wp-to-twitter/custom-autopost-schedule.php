<?php
/*
 * Plugin Name: Custom AutoPost Schedule
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Add an additional schedule to pick from when creating your autopost schedule.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */
 
add_filter( 'cron_schedules', 'my_custom_schedules' );
/*
* @param array $schedules Array of existing schedules
* @return array $schedules Modified array of schedules
*	
*/
function my_custom_schedules( $schedules ) {
 	$schedules['every-hour'] = array(
 		'interval' => 3600,
 		'display' => __( 'Every hour', 'my-textdomain' )
 	);

	return $schedules;
}