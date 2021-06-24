<?php
/*
 * Plugin Name: Change Replacement Character in Tags
 * Plugin URI: http://www.joedolson.com/wp-tweets-pro/
 * Plugin Description: By default, WP to Twitter changes multi word tags to capitalize each word and removes spaces. This replaces spaces with an alternate character.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

 
add_filter( 'option_jd_replace_character', 'replace_spaces' );
/*
 * Replace default character (usually blank) with an underscore.
 *
 * @param string $option Default value.
 *
 * @return string
 */
function replace_spaces( $option ) {
	return '_';
}
