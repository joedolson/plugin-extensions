<?php
/**
 * PHP Tester - Plugins
 *
 * @package     PHP Tester
 * @author      Joe Dolson
 * @copyright   2021 PHP Tester
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: PHP Tester
 * Plugin URI:  http://localhost
 * Description: Convenient way to quickly run arbitrary PHP.
 * Author:      Joseph C Dolson
 * Author URI:  https://www.joedolson.com
 * Text Domain: localhost
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/license/gpl-2.0.txt
 * Domain Path: lang
 * Version:     1.0.0
 */

/*
	Copyright 2020-2024  Localhost Tester

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

if ( ! defined( 'SCRIPT_DEBUG' ) ) {
	define( 'SCRIPT_DEBUG', true );
}

add_action( 'admin_notices', 'debugging_processor' );
function debugging_processor() {
	if ( isset( $_GET['debug'] ) ) {
		$result = mc_upgrade_db();

		wp_admin_notice( print_r( $result, 1 ) );
	}
}
