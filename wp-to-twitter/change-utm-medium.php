<?php
/*
 * Plugin Name: Change UTM Medium
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: Modify the default UTM medium analytics string
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

 
add_filter( 'wpt_utm_medium', 'my_utm_medium', 10, 1 );
/**
 * Switch default medium parameter to your own custom parameter.
 *
 * @param string $default Default string 'twitter'
 *
 * @return string
 */
function my_utm_medium( $default ) {
	return 'social';
}
