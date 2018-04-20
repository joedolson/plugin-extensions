<?php
/*
Plugin Name: Filter any text
Plugin URI: http://www.joedolson.com/
Description: Example plug-in demonstrating how to use a GetText filter.
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/


add_filter( 'gettext', 'my_custom_text', 20, 3 );
/**
 * Replace any text in a plug-in that's translatable.
 *
 * @param string $text The text coming from a translation for the plug-in. 
 * @param string $type Original text from plug-in.
 * @param string $domain Text domain in use.
 */
function my_custom_text( $translated, $original, $domain ) {
	// Check whether the domain matches the plug-in you're working with.
	// Check whether the original text matches what you're wanting to change.
	if ( $domain == 'my-tickets' && $original == 'Go to Cart' ) {
		return 'Click here to go to your shopping cart.';
	}

	return $translated;
}