<?php
/*
 * Plugin Name: Tags as Cashtags
 * Plugin URI: http://www.joedolson.com/articles/wp-tweets-pro/
 * Plugin Description: Sends tags as cashtags by default instead of as hashtags.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'wpt_tag_default', 'my_custom_cashtag' );
function my_custom_cashtag( $hash ) {
      return '$';
}