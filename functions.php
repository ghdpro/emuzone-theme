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

if ( ! function_exists( 'emuzone_widgets_init' ) ) :
	function emuzone_widgets_init() {
		register_sidebar(
			array(
				'name'          => __( 'Navbar', 'emuzone' ),
				'id'            => 'navbar',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Sidebar', 'emuzone' ),
				'id'            => 'sidebar',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Footer', 'emuzone' ),
				'id'            => 'footer',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);
	}
endif;
add_action( 'widgets_init', 'emuzone_widgets_init' );

/**
 * Template Tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Remove WordPress update notifications
 */
add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );
