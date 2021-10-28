<?php

/**
 * Share widget
 *
 * Shows social share buttons for Facebook, Twitter & Reddit
 */

class ShareWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'share',
			'Share',
			array( 'description' => __( 'Share buttons widget', 'emuzone' ), )
		);
	}

	/**
	 * Displays wiget output
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        // Get the link for the current page, regardless of what kind of page it is
        // So can't use get_permalink() here, because that doesn't work on category pages
        // $GET is for capturing search page query string
		global $wp;
		$permalink = home_url(add_query_arg(array( $_GET ), $wp->request . '/'));
        // Get the title of the page, which is post/page title or blog title if not a singular post/page
		if ( is_singular() )
			$title = get_the_title();
		else
			$title = get_bloginfo();
        // Escape for inclusion in query string
		$permalink = rawurlencode( esc_url( $permalink ) );
		$title = rawurlencode( $title );
		?>
        <h2 class="widget-title">Share</h2>
			<p class="social">
				<a class="facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $permalink; ?>" target="_blank" title="Post on Facebook"><i class="fa fa-facebook"></i></a>
				<a class="twitter" href="https://twitter.com/intent/tweet?url=<?php echo $permalink; ?>&amp;text=<?php echo $title; ?>" target="_blank" title="Post on Twitter"><i class="fa fa-twitter"></i></a>
				<a class="reddit" href="https://reddit.com/submit?url=<?php echo $permalink; ?>&amp;title=<?php echo $title; ?>" target="_blank" title="Post on Reddit"><i class="fa fa-reddit-alien"></i></a>
			</p>
		<?php
	}
}
