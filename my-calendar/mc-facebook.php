<?php
/*
Plugin Name: My Calendar Share to Facebook
Plugin URI: http://www.joedolson.com
Description: Share My Calendar Events to Facebook
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_filter_shortcodes', 'mc_facebook', 10, 2 );
function mc_facebook( $e, $event ) {
	$e['facebook'] = "<a href='https://www.facebook.com/sharer.php?u='" . urlencode( mc_get_details_link( $event ) ) . "'>Share on Facebook</a>";
	return $e;
}
