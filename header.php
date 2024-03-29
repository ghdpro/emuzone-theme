<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="container-fluid logo">
    <div class="container-xxl d-flex justify-content-center">
        <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>"><img src="<?php echo get_theme_file_uri( 'assets/emuzone-logo-v3b.png' ); ?>" alt="The Emulator Zone"></a>
    </div>
</div>

<nav class="navbar navbar-expand-md navbar-dark topbar">
    <div class="container-xxl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'menu-top',
                'depth'           => 2,
                'container'       => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'navbarSupportedContent',
                'menu_class'      => 'nav navbar-nav me-auto',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
            )
        );
        dynamic_sidebar( 'navbar' )
        ?>
    </div>
</nav>
