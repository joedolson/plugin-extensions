<?php
/*
Plugin Name: My Calendar: Custom Event Accessibility Options
Plugin URI: http://www.joedolson.com
Description: Change the default accessibility options for events.
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

add_filter( 'mc_event_access_choices', 'my_event_access_choices', 10, 1 );
/**
 * Change the default accessibility options for events.
 *
 * @param array $choices Array of default options.
 *
 * @return array $e
 */
function my_event_access_choices( $choices ) {
	/*
	 * The default $choices array:
	array(
		'1'  => __( 'Audio Description', 'my-calendar' ),
		'2'  => __( 'ASL Interpretation', 'my-calendar' ),
		'3'  => __( 'ASL Interpretation with voicing', 'my-calendar' ),
		'4'  => __( 'Deaf-Blind ASL', 'my-calendar' ),
		'5'  => __( 'Real-time Captioning', 'my-calendar' ),
		'6'  => __( 'Scripted Captioning', 'my-calendar' ),
		'7'  => __( 'Assisted Listening Devices', 'my-calendar' ),
		'8'  => __( 'Tactile/Touch Tour', 'my-calendar' ),
		'9'  => __( 'Braille Playbill', 'my-calendar' ),
		'10' => __( 'Large Print Playbill', 'my-calendar' ),
		'11' => __( 'Sensory Friendly', 'my-calendar' ),
		'12' => __( 'Other', 'my-calendar' ),
	) );
	*/

	// Change the language for 'playbill'.
	$choices[9]  = 'Braille Program';
	$choices[10] = 'Large Print Program';
	// Add another option.
	$choices[13] = 'An additional option';

	return $choices;
}
