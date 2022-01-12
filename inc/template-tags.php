<?php

if ( ! function_exists( 'emuzone_entry_posted_on' ) ) :
	function emuzone_entry_posted_on() {
		$time_format = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_format = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_format,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		return sprintf(
			'<small class="posted-on">%1$s by %2$s</small>',
			$time_string, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			get_the_author()
		);
	}
endif;

if ( ! function_exists( 'emuzone_entry_footer' ) ) :
	function emuzone_entry_footer() {
	}
endif;

if ( ! function_exists( 'emuzone_post_nav' ) ) {
	function emuzone_post_nav() {
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
        <nav class="navigation post-navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'emuzone' ); ?></h2>
            <div class="nav-links d-flex flex-row justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fas fa-angle-left"></i>%title', 'Previous post link', 'emuzone' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title<i class="fas fa-angle-right"></i>', 'Next post link', 'emuzone' ) );
				}
				?>
            </div>
        </nav>
		<?php
	}
}

if ( ! function_exists( 'emuzone_pagination' ) ) {
	function emuzone_pagination( $args = array(), $class = 'pagination' ) {
		if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'  => 2,
				'prev_next' => true,
				'prev_text' => '<i class="fas fa-angle-double-left"></i>',
				'next_text' => '<i class="fas fa-angle-double-right"></i>',
				'type'      => 'array',
				'current'   => max( 1, get_query_var( 'paged' ) ),
			)
		);

		$links = paginate_links( $args );
		?>
		<nav aria-label="<?php echo __( 'Posts navigation', 'emuzone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
			<ul class="pagination justify-content-center">
				<?php
				foreach ( $links as $key => $link ) {
					?>
					<li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php echo str_replace( 'page-numbers', 'page-link', $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</li>
					<?php
				}
				?>
			</ul>
		</nav>
		<?php		
	}
}
