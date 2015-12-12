<?php
/*
 * Plugin Name: My Content Management: Related Post output
 * Plugin URI: http://www.joedolson.com/my-content-management/
 * Plugin Description: Output custom data for related posts.
 * Version: 1.0
 * Author: Joe Dolson
 * Author URI: http://www.joedolson.com
 */

add_filter( 'mcm_extend_posts', 'mcm_demo_related_post', 10, 2 );
/**
 * Assumes the existence of a custom field with the label "Related Post"
 * Usage: Creates a new template tag {related} that returns the output defined.
*/
function mcm_demo_related_posts( $p, $custom ) {
      // get the meta field value
	$related_post = $p['_related-post'];
	// get the post data.
	$post = get_post( $related_post );
	// get the post title.
	$post_title = apply_filters( 'the_title', $post->post_title );
	// get the post title.
	$post_content = apply_filters( 'the_content', $post->post_content );
	
	if ( $related_post ) {
		$p['related'] = "
			<div class='related-post related-post-$related_post'>
				<h2>$post_title</h2>
				<div class='post-content'>
					$post_content
				</div>
			</div>";
	} else {
		$p['related'] = '';
	}	 

	// get the meta field value
	$related_user = $p['_related-user'];
	// get the user object.
	$user = get_user( $related_user );
	// get the user name (display name if set, otherwise login)
	$user_name = ( $user->display_name == '' ) ? $user->user_login : $user->display_name;

	if ( $related_user ) {
		$p['user'] = "
			<div class='related-user related-user-$related_user'>
				<h2>Contributed by $user_name</h2>
			</div>";
	} else {
		$p['user'] == '';
	}
	return $p;
}