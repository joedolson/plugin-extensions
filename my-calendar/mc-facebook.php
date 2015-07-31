<?php
/*
Plugin Name: My Calendar Share to Facebook
Plugin URI: http://www.joedolson.com
Description: Share My Calendar Events to Facebook
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

/**
 * This plug-in adds a template tag to the library of My Calendar template tags to add a 'share' link for the event. 
 *
 * Usage: {facebook}
 *
 * @param array $e Array of template tags.
 * @param object $event Event Object.
 *
 * @return array $e
 */
add_filter( 'mc_filter_shortcodes', 'mc_facebook', 10, 2 );
function mc_facebook( $e, $event ) {
	$e['facebook'] = "<a href='https://www.facebook.com/sharer.php?u='" . urlencode( mc_get_details_link( $event ) ) . "'>Share on Facebook</a>";
	return $e;
}
