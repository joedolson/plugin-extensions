<?php
/**
 * Add custom navigation elements
 *
 * @package     My Calendar custom navigation
 * @author      Joe Dolson
 * @copyright   2022 Joe Dolson
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: My Calendar custom navigation
 * Plugin URI:  http://localhost
 * Description: Demonstrates how to render custom information in the calendar header or footer.
 * Author:      Joseph C Dolson
 * Author URI:  https://www.joedolson.com
 * Text Domain: localhost
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/license/gpl-2.0.txt
 * Domain Path: lang
 * Version:     1.0.0
 */

/*
	Copyright 2022 Joe Dolson

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create your custom navigation item using the current view's parameters. All this example does is print the current parameters in the menu. 
 *
 * @param array $params Parameters for the current view.
 *
 * @return string HTML for navigation item.
 */
function my_custom_nav_item( $params ) {
	return '<pre>' . print_r( $params, 1 ) . '</pre>';
}

/**
 * Return a custom navigation item in the header. (Can do same thing with filter `mc_footer_navigation`).
 *
 * @param array $in Array of currently selected navigation parameters.
 * @param array $used Array of all navigation parameters currently in use for this calendar view.
 * @param array $params Parameters specifying this view.
 *
 * @return array
 */
function mc_add_custom_nav( $in, $used, $params ) {
	$in[] = 'my_custom_nav_item';

	return $in;
}
add_filter( 'mc_header_navigation', 'mc_add_custom_nav', 10, 3 );