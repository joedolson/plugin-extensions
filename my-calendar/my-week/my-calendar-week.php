<?php
/*
Plugin Name: My Calendar: Coming Week
Plugin URI: http://www.joedolson.com/
Description: Generates a list of event links for the next week of events, starting from today.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/


/**
 * Create list of links
**/ 
function mc_create_week_list() {
	$list = '';
	$today = date( 'Y-m-d', current_time( 'timestamp' ) );
	$url = ( get_option( 'mc_uri' ) != '' ) ? get_option( 'mc_uri' ) : home_url();
	$date = explode( '-', $today );
	$name = date( 'l', current_time( 'timestamp' ) );	
	$links[$name] = add_query_arg( array( 
					'yr'=>$date[0], 
					'month' => $date[1],
					'dy' => $date[2],
					'time' => 'day'
				), $url );
						
	for ( $i = 1; $i<8; $i++ ) {
		$day = date( 'Y-m-d', strtotime( $today . " + $i day" ) );
		$date = explode( '-', $day );
		$name = date( 'l', strtotime( $day ) );
		$links[$name] = add_query_arg( array( 
						'yr'=>$date[0], 
						'month' => $date[1],
						'dy' => $date[2],
						'time' => 'day'
					), $url ); 
	}
	
	foreach( $links as $day => $link ) {
		if ( isset( $_GET['yr'] ) ) {
			$current = date( 'l', strtotime( $_GET['month'] . '-' . $_GET['dy'] . '-' . $_GET['yr'] ) );
		} else {
			$current = date( 'l', current_time( 'timestamp' ) );
		}
		$class = sanitize_title( $day );
		$link = esc_url( $link );
		if ( $day == $current ) {
			$class .= ' current-day';
		}
		$list .= "<li class='$class'><a href='$link'>$day</a></li>";
	}
	
	return "<div class='mc-week'><ul class='mc-week-list'>$list</ul></div>";
}

// add shortcode

add_shortcode( 'my_week', 'mc_show_week_list' );
function mc_show_week_list() {
	return mc_create_week_list();
}

// add styles
add_action( 'wp_enqueue_scripts', 'my_enqueued_styles' );
function my_enqueued_styles() {
	wp_enqueue_style( 'my.weeklist', plugins_url( 'css/style.css', __FILE__ ) );
}

add_filter( 'mc_heading', 'my_custom_week_heading', 10, 3 );
function my_custom_week_heading( $content, $format, $time ) {
	echo "$content, $format, $time";
	if ( $time == 'day' ) {
		return "Events for " . $content;
	}
	
	return $content;
}