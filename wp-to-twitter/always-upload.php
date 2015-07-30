<?php
/*
 * Plugin Name: - OBSOLETE - Always Upload Images
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: By default, WP Tweets PRO only uploads image attachments on the first Tweet. This switches to upload on every Tweet that has media.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

 
add_filter( 'wpt_upload_media_count', 'always_upload_media', 10, 2 );
/*
*	Receives: $default (0) and $current retweet number (0-3).
* 	Returns: $current retweet number.
* 
* 	How it works: the upload media has a check that verifies whether this value equals the current retweet value. 
*	By default, if it's '0' (the initial Tweet value), then the media is uploaded. Return a specific value to do 
*	uploads on a specific Tweet or return the $current retweet value to always upload.
*	
*/
function always_upload_media( $default, $current ) {
	return $current;
}
