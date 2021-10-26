<?php

class ShareWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'share',
			'Share',
			array( 'description' => __( 'Share buttons widget', 'emuzone' ), )
		);
	}

	public function widget( $args, $instance ) {
		global $wp;
		$permalink = home_url(add_query_arg(array($_GET), $wp->request . '/'));
		echo $permalink;
	}
}
