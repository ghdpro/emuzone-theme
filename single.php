<?php
    get_header();
    $wc = 0;
?>

<main class="container-xxl">
	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	<div class="row">
		<div class="col-md-10 content">

			<?php
			endif;

			if ( have_posts() ) :

				while ( have_posts() ) :

					the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					$wc += str_word_count_utf8( get_the_content() );

				endwhile;

				emuzone_post_nav();

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endif;

			if ( is_active_sidebar( 'sidebar' ) ) :
			?>

		</div>

		<aside class="col-md-2 sidebar">

			<?php dynamic_sidebar( 'sidebar' ); ?>

		</aside>
	</div>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
