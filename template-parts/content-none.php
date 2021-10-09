<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'emuzone' ); ?></h1>
	</header>

	<div class="page-content">
		<?php
		if ( is_search() ) :
			?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'emuzone' ); ?></p>
			<?php
			get_search_form();
		else :
			?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'emuzone' ); ?></p>
			<?php
			get_search_form();

			the_widget( 'WP_Widget_Recent_Posts' );

			if ( ! is_active_sidebar( 'sidebar' ) ) :
				the_widget( 'WP_Widget_Tag_Cloud' );
			endif;
		endif;
		?>
	</div>
</section>
