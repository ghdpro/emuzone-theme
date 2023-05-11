<?php

/**
 * Callback for the Play Store block. Displays Play Store button.
 *
 * @param $block
 * @param $content
 * @param $is_preview
 * @param $post_id
 *
 * @return void
 */
function emuzone_playstore_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {
	// Get URL
	$url = get_field('url');
	if ( !empty( $url ) )
		emuzone_playstore_template( $url );
	else
		echo '<div class="alert alert-danger" role="alert">No URL defined</div>';
}

/**
 * Displays Play Store button.
 *
 * @param string $url
 *
 * @return void
 */
function emuzone_playstore_template( string $url ) {
	?>
	<div class="row justify-content-center">
		<a target="_blank" href="<?php echo esc_url( $url ); ?>"><img src="<?php echo get_theme_file_uri( 'assets/google-play-badge.png' ); ?>" alt="Google Play Store button" width="180" height="70" class="d-block mx-auto"></a>
		<small class="text-muted text-center">Google Play and the Google Play logo are trademarks of Google LLC.</small>
	</div>
	<?php
}
