<?php
/*
 * Plugin Name: WP Accessibility Custom Fontsize Styles
 * Plugin URI: http://www.joedolson.com/wp-accessibility
 * Plugin Description: Disable or pass custom stylesheet for Accessibility toolbar fontsize tool
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

/**
 * Filter the CSS file for the WP Accessibility font size styles.
 * This example returns the URL for a file named 'fontsize.css' and placed in your theme or child theme directory.
 * 
 * @param string URL to default stylesheet
 * 
 * @return mixed boolean/string Return false to disable the stylesheet; return a URL resolving to your custom styles to replace it.
 */
add_filter( 'wpa_fontsize_css', 'my_fontsize_css' );
function my_fontsize_css( $url ) {
   // return false; // disable CSS
   return get_stylesheet_directory_uri() . '/fontsize.css';
}