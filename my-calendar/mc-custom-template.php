<?php
/*
Plugin Name: My Calendar Custom Template
Plugin URI: http://www.joedolson.com
Description: Add a custom template to My Calendar
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_custom_template', 'my_custom_calendar', 10, 7 );
/**
 * This plug-in demonstrates adding a custom template in PHP. 
 *
 * [my_calendar template='custom_template_name']
 *
 * @param string $body Existing rendered output or false.
 * @param array  $data Array of processed My Calendar template tags.
 * @param object $event Source event object.
 * @param string $type Type of view currently shown. (List, calendar, mini.)
 * @param string $process_date Current date being processed.
 * @param string $time Currently viewed timeframe. (Day, week, month.)
 * @param string $template Template name passed.
 *
 * @return string
 */
function my_custom_calendar( $body = false, $data, $event, $type, $process_date, $time, $template ) {
	// Toggle this template if specifically in shortcode *or* if rendering the 'single' event view.
	if ( 'custom_template_name' == $template || 'single' == $template ) {
		// Using the $data and $event information, source your variables. 
		$details = array( 
			$data['image'],
			$data['access'], 
			$data['title'], 
			$data['shortdesc_raw'],
			$data['hcard'],
			$data['location_access'],
			$data['description'],
			$data['link'],
		);
		// Create your layout, and insert relevant values into it. 
		$body = vsprintf( '
<div class="row">
	<div class="span3">
		%1$s
	</div>
	<div class="span6">
	'.$header.'
	<strong>%4$s</strong>

		<div class="smallertext logistics">
			<div class="row">
				<div class="span3">
					<h4>Location</h4>
					%5$s
					'.$phone2.'
					%6$s
				</div>
			</div>

			<p><a href="%8$s">More Information<span class="screen-reader-text"> about %3$s</span></a></p>

		</div><!--end smallertext-->
	</div>
</div>', $details );
		return $body;
	}

	return $body;
}