(function ($) {
	$(function() {
		if ( $( '.rsvp-form input[type=checkbox]' ).prop( 'checked' ) == true ) {
			$( '.guests' ).show();
		} else {
			$( '.guests' ).hide();
		}

		$( '.rsvp-form input[type=checkbox]' ).on( 'click', function (e) {
			var is_checked = $( this ).prop( 'checked' ) == true;
			if ( is_checked ) {
				$( '.guests' ).show();
			} else {
				$( '.guests' ).hide();
			}
		});

		$('.rsvp-form input[type=submit]').on('click', function (e) {
			e.preventDefault();
			var rsvp   = $( this ).closest( '.rsvp-form' );
			var post   = rsvp.find( 'input[name=event_post]' );
			var guest  = rsvp.find( 'input[name=mc_rsvp]' );
			var count  = rsvp.find( 'input[name=mc_guests]' );
			var postid = post.attr( 'value' );
			var user   = guest.prop( 'checked' );
			var guests = $( '.current-user .guest-count' ).text();
			var number = count.attr( 'value' );
			var total  = $( '.total-count' ).text();
			total      = parseInt( total );
			var data = {
				'action': mcrsvp.action,
				'data': {post_id: postid, rsvp: user, guests: number},
				'security': mcrsvp.security
			};

			$.post( mcrsvp.ajaxurl, data, function (response) {
				if ( response.success == 1 ) {
					if ( $( '.guestlist .current-user' ).length ) {
						if ( response.rsvp == 'false' ) {
							if ( $( '.current-user' ).is( ':visible' ) ) {
								$( '.current-user' ).hide();
								var newtotal = total - ( parseInt( response.guests ) + 1 );
							} else {
								var newtotal = total;
							}

						} else {
							if ( $( '.current-user' ).is( ':visible' ) ) {
								add = 0;
							} else {
								$( '.current-user' ).show();
								add = 1;
							}
							$( '.current-user' ).html( response.name + ' + <span class="guest-count">' + response.guests + '</span> guests' ).addClass( 'updated' );
							total = total - parseInt( guests );
							var newtotal = total + parseInt( response.guests ) + add;
						}
					} else {
						$( '.guestlist ul' ).append( '<li class="current-user updated">' + response.name + ' + <span class="guest-count">' + response.guests + '</span> guests</li>' );
						var newtotal = total + parseInt( response.guests ) + 1;	
					}

					$( '.total-count' ).text( newtotal ).addClass( 'updated' );
					$('.rsvp-notice').html( response.response ).show( 300 );
				} 
			}, 'json' );
		});

	});

}(jQuery));