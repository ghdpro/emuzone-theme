<?php

/**
 * Setup
 */

if ( ! function_exists( 'emuzone_setup' ) ) :
	function emuzone_setup() {
		load_theme_textdomain( 'emuzone', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support(
			'html5',
			array( 'search-form', 'gallery', 'caption', 'style', 'script' )
		);
		register_nav_menus(
			array(
				'menu-top' => __( 'Top Menu', 'emuzone' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'emuzone_setup' );

if ( ! function_exists( 'emuzone_content_width' ) ) :
	function emuzone_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'emuzone_content_width', 800 );
	}
endif;
add_action( 'after_setup_theme', 'emuzone_content_width', 0 );

if ( ! function_exists( 'emuzone_scripts' ) ) :
	function emuzone_scripts() {
		$theme = wp_get_theme();
		wp_enqueue_style(
			'emuzone',
			get_stylesheet_uri(),
			array(),
			$theme->get( 'Version' )
		);
		// Required for Bootstrap
		wp_enqueue_script(
			'popperjs',
			get_template_directory_uri() . '/assets/js/popper.min.js',
			array(),
			'2.10.2',
			true
		);
		// Bootstrap 5
		wp_enqueue_script(
			'bootstrap',
			get_template_directory_uri() . '/assets/js/bootstrap.min.js',
			array(),
			'5.1.3',
			true
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'emuzone_scripts' );
