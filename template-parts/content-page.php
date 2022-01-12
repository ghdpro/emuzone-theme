<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_singular() || ! has_post_thumbnail() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					'Continue reading<i class="fas fa-angle-right"></i><span class="screen-reader-text"> "%s"</span>',
					array(
						'i'    => array(
							'class' => array(),
						),
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'emuzone' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="entry-footer">
		<?php emuzone_entry_footer(); ?>
	</footer>

</article>
