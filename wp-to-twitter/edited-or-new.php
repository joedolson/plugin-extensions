<?php
/*
 * Plugin Name: Modify how a post is determined to be edited or new.
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: One of the methods that WP to Twitter uses to determine edit status is the time stamps. Plug-in modifies how close the timestamps need to be.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

 
add_filter( 'wpt_edit_sensitivity', 'my_edit_sensitivity', 10, 1 );
/*
 * Receives: $default (0) 
 * Returns: new allowed difference in seconds
 * 
 * By default, posts must have identical modified and created datetimes in order to be identified as new.
 * This value is the amount of difference between modified and created date times allowed to still id as new.
 * e.g., a value of 30 means that the times can be up to 30 seconds apart and still be treated as a new post. 
 * This also means that an edit of a post less than 30 seconds after it is published will attempt to Tweet a second time.
 *	
*/
function my_edit_sensitivity( $default ) {
	// set difference allowed to 30 seconds
	return 30;
}
