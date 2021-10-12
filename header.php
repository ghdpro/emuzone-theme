<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<nav class="navbar">
	<div class="container">
		<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
			<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
		</a>
		<?php
		?>
	</div>
</nav>
