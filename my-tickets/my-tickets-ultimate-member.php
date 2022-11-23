<?php
/*
Plugin Name: Member purchases view in Ultimate Member.
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Add a tab in Ultimate Member where members can view their purchased tickets.
Version: 1.0.0
Author: Johan Hulsmans
Author URI: n/a
*/

/**
 * Set up a custom tab in Ultimate Member.
 *
 * @param array $tabs Array of existing member tabs.
 *
 * @return array
 */
function my_custom_tab_in_um( $tabs ) {
	$tabs[800]['mytab']['icon']        = 'um-faicon-ticket';
	$tabs[800]['mytab']['title']       = 'Orders';
	$tabs[800]['mytab']['show_button'] = false;
	$tabs[800]['mytab']['custom']      = true;

	return $tabs;
}
add_filter( 'um_account_page_default_tabs_hook', 'my_custom_tab_in_um', 100 );

/**
 * Make our new tab hookable.
 */
function um_account_tab__mytab( $info ) {
	global $ultimatemember;
	extract( $info );

	$output = $ultimatemember->account->get_tab_output('mytab');
	if ( $output ) {
		echo $output;
	}
}
add_action( 'um_account_tab__mytab', 'um_account_tab__mytab' );

/**
 * Finally we add some content in the tab.
 *
 * @param string $output Default tab output.
 *
 * @return string
 */
function um_account_content_hook_mytab( $output ){
	ob_start();
	?>
	<div class="um-field">
		<!-- Here goes your custom content -->
		<?php echo do_shortcode( '[my-payments]' ); ?>
	</div>
	<?php
	$output .= ob_get_contents();
	ob_end_clean();

	return $output;
}
add_filter( 'um_account_content_hook_mytab', 'um_account_content_hook_mytab' );
