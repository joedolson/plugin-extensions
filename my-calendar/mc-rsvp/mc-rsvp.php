<?php
/*
Plugin Name: My Calendar - RSVP
Plugin URI: http://www.joedolson.com
Description: Simple member RSVP for My Calendar events
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
*/

/**
 * Generate RSVP form.
 *
 * @param array  $e Array of template values.
 * @param object $event Event object.
 *
 * @return array
 */
function mc_rsvp( $e, $event ) {
	$user         = wp_get_current_user();
	$post_ID      = $event->event_post;
	$guests       = get_post_meta( $post_ID, '_event_rsvp' );
	$guest_list   = '';
	$num_guests   = 0;
	$total        = 0;
	$current_user = '';

	if ( is_user_logged_in() ) {
		foreach ( $guests as $guest ) {
			if ( ! $guest ) { continue; }
			$attendee    = get_user_by( 'ID', $guest );
			$count       = intval( get_post_meta( $post_ID, "_event_guests_$guest", true ) );
			if ( $guest == $user->ID ) {
				$num_guests   = $count;
				$current_user = ' class="current-user"';
			} else {
				$current_user = '';
			}
			$total       = $total + ( $count + 1 );
			$name        = ( '' == $attendee->display_name ) ? $attendee->username : $attendee->display_name;
			$guest_list .= "<li$current_user>" . sprintf( _n( '%1$s + %2$s guest', '%1$s + %2$s guests', $count, 'my-calendar-submissions' ), $name, "<span class='guest-count'>$count</span>" ) . '</li>';
		}

		if ( '' != $guest_list ) {
			$guest_list = "<div class='guestlist'><h4>Attendees</h4><ul>$guest_list</ul><p class='total-rsvp'>" . sprintf( _n( '%s guest attending', '%s guests attending', $total, 'my-calendar-submissions' ), "<span class='total-count'>$total</span>" ) . '</p></div>';
		}

		if ( in_array( $user->ID, $guests ) ) {
			$checked = 'checked="checked"';
			$text    = 'Update RSVP';
		} else {
			$checked = '';
			$text    = 'Save RSVP';
		}

		if ( current_time( 'timestamp' ) < strtotime( $e['dtstart'] ) ) {
			$update = "<div class='rsvp-notice'>" . mc_update_rsvp( $post_ID, $_POST ) . '</div>';
			$wpnonce = wp_nonce_field( 'mc-save-rsvp', '_wpnonce', true, false );
			$form = "<div class='rsvp-form body-copy'>
				$update
				<form action='' method='POST' />
					<div><input type='hidden' name='event_post' value='$post_ID' />$wpnonce</div>
					<p class='rsvp'><input type='checkbox' name='mc_rsvp' value='true' id='mc_rsvp' $checked /> <label for='mc_rsvp'>I'm attending!</label></p>
					<p class='guests'><label for='mc_guests'>Bringing any guests?</label> <input type='number' name='mc_guests' value='$num_guests' min='0' max='20' id='mc_guests'></p>
					<p><input type='submit' name='save_rsvp' value='$text' /></p>
				</form>
			</div>";
		} else {
			$form = "<p>RSVP's are closed for this event.</p>";
		}
		
		$e['rsvp'] = "
		$guest_list
		$form";

	} else { 
		$e['rsvp'] = "<a href='" . wp_login_url( get_permalink() ) . "' class='login more'>Log in to view the attendee list and to RSVP!</a>";
	}

	return $e;
}
add_filter( 'mc_filter_shortcodes', 'mc_rsvp', 10, 2 );

/**
 * Update RSVP.
 *
 * @param int    $post_ID Post ID for event.
 * @param object $post Post object.
 *
 * @return string
 */
function mc_update_rsvp( $post_ID, $post ) {
	if ( isset( $post['save_rsvp'] ) && $post_ID == $post['event_post'] ) {
		if ( ! wp_verify_nonce( $post['_wpnonce'], 'mc-save-rsvp' ) ) {
			return;
		}
		$user = wp_get_current_user();
		$meta = get_post_meta( $post_ID, '_event_rsvp' );
		if ( ( isset( $post['mc_rsvp'] ) && $post['mc_rsvp'] != 'false' ) && !in_array( $user->ID, $meta ) ) {
			// add User ID to meta data
			add_post_meta( $post_ID, '_event_rsvp', $user->ID );
			add_post_meta( $post_ID, "_event_guests_$user->ID", intval( $post['mc_guests'] ) );
			$return = 'RSVP added';
			
		} elseif ( ( ! isset( $post['mc_rsvp'] ) || 'false' === $post['mc_rsvp'] ) && in_array( $user->ID, $meta ) ) {
			// remove User ID from meta data
			delete_post_meta( $post_ID, '_event_rsvp', $user->ID );
			delete_post_meta( $post_ID, "_event_guests_$user->ID" );
			$return = 'RSVP removed';

		} elseif ( ( isset( $post['mc_rsvp'] ) && $post['mc_rsvp'] != 'false' ) && in_array( $user->ID, $meta ) ) {
			update_post_meta( $post_ID, "_event_guests_$user->ID", intval( $post['mc_guests'] ) );
			$return = 'RSVP updated';

		} else {
			$return = 'No change to RSVP';
		}

		return "<p class='update'>$return</p>";
	}
}

/**
 * Enqueue RSVP scripts.
 */
function mc_rsvp_scripts() {
	if ( ! is_admin() ) {
		wp_enqueue_style( 'rsvp.styles', plugins_url( 'css/rsvp.css', __FILE__ ) );
		wp_enqueue_script( 'rsvp.update', plugins_url( 'js/rsvp.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_localize_script(
			'rsvp.update',
			'mcrsvp',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'security' => wp_create_nonce( 'mc-save-rsvp' ),
				'action' => 'mc_rsvp_ajax'
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'mc_rsvp_scripts' );

/**
 * Handle RSVP.
 */
function mc_rsvp_ajax() {
	if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'mc_rsvp_ajax' ) {
		$data     = $_REQUEST['data'];
		$post_id  = $data['post_id'];
		$rsvp     = $data['rsvp'];
		if ( 'false' === $rsvp ) {
			$guests = 0;
		} else {
			$guests = $data['guests'];
		}
		$security = $_REQUEST['security'];
		$name     = wp_get_current_user()->display_name;
		
		$response = mc_update_rsvp(
			$post_id,
			array(
				'mc_rsvp'    => $rsvp,
				'mc_guests'  => $guests,
				'event_post' => $post_id,
				'_wpnonce'   => $security,
				'save_rsvp'  => 'true',
			)
		);
		wp_send_json(
			array( 
				'success' => 1,
				'rsvp'    => $rsvp,
				'guests'  => $guests,
				'name'    => $name,
				'response'=> $response,
			) 
		);
	}
}
add_action( 'wp_ajax_mc_rsvp_ajax', 'mc_rsvp_ajax' );
add_action( 'wp_ajax_nopriv_mc_rsvp_ajax', 'mc_rsvp_ajax' );