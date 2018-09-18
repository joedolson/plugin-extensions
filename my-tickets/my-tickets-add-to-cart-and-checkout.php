<?php
/*
Plugin Name: Redirect to checkout after Add to Cart
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Redirect to checkout after Add to Cart
Version: 1.0.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/


add_filter( 'mt_redirect', 'my_redirect', 10, 1 );
/**
 * Return truthy value to redirect to checkout. Default is false.
 *
 * @param boolean $redirect Redirect or not.
 *
 * @return boolean
 */
function my_redirect( $redirect ) {

	return true;
}