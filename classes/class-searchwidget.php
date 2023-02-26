<?php

/**
 * Search widget
 *
 * Bootstrap styled search box
 */

class SearchWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'ezsearch',
			'EZ Search',
			array( 'description' => __( 'Search widget', 'emuzone' ), )
		);
	}

	/**
	 * Displays widget output
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		?>
        <h2 class="widget-title">Search</h2>
        <form action="/" method="get" class="form-inline m-2 pb-2">
            <div class="input-group">
                <input class="form-control" type="search" name="s" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit"><span class="fas fa-search"></span></button>
            </div>
        </form>
		<?php
	}
}
