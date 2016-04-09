<?php
/*
 * Plugin Name: My Content Management: Custom Field
 * Plugin URI: http://www.joedolson.com/my-content-management/
 * Plugin Description: Create a custom template tag to manipulate an existing template tag.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'mcm_extend_posts', 'mcm_custom_field', 10, 2 );
/**
 * Assumes the existence of a custom field with the label "URL", generating a standard template tag {_url}
 * Usage: Creates a new template tag {link} that returns the output defined.
*/
function mcm_custom_field( $p, $custom ) {
	// get the meta field value
	$url = $p['_url'];
	// get the post data.
	$link = ( $p['_url'] != '' ) ? $p['_url'] : false;
	// remove any white space in the string.
	$link = trim( $link );
	if ( $link ) {
		$proper = esc_url( $link );
		if ( $proper ) {
			// the link is already properly formatted, so wrap it in HTML.
			$p['link'] == "<a href='$proper' class='mcm_link'>$proper</a>";
		} else {
			// There are many ways a URL can be improperly formatted, but by far the most common is omitting 'http://'. 
			// I'm only going to handle that case.
			$link = ( strpos( $link, 'http' ) === false ) ? 'http://' . $link : false;
			// check if the new link is proper
			$proper = esc_url( $link );
			if ( $proper ) {
				$p['link' == "<a href='$proper' class='mcm_link'>$proper</a>";
			} else {
				// if the URL is improper, return an error message.
				$p['link'] == 'Improperly formatted URL';
			}
		}
	} else {
		$p['link'] == '';
	}

	return $p;
}