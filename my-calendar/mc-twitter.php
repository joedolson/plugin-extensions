<?php
/*
Plugin Name: My Calendar Share to Twitter
Plugin URI: http://www.joedolson.com
Description: Share My Calendar Events to Twitter
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_filter_shortcodes', 'mc_twitter', 10, 2 );
function mc_twitter( $e, $event ) {
	$e['twitter'] = "<a href='https://twitter.com/intent/tweet?text='" . urlencode( $event->event_title . ' ' . mc_event_link( $event ) ) . "'>Tweet this event</a>";
	return $e;
}