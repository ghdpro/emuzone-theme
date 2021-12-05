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

if ( ! function_exists( 'emuzone_theme_scripts' ) ) :
	function emuzone_theme_scripts() {
		$theme = wp_get_theme();
		wp_enqueue_style(
			'emuzone-theme',
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
add_action( 'wp_enqueue_scripts', 'emuzone_theme_scripts' );

require_once( get_template_directory() . '/classes/class-fieldwidget.php' );
require_once( get_template_directory() . '/classes/class-sharewidget.php');

if ( ! function_exists( 'emuzone_theme_widgets_init' ) ) :
	function emuzone_theme_widgets_init() {
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
		for ( $i = 1; $i <= 4; $i++ ) {
			register_sidebar(
				array(
					'name'          => __( 'Footer' . $i, 'emuzone' ),
					'id'            => 'footer' . $i,
					'before_widget' => '',
					'after_widget'  => '',
					'before_title'  => '',
					'after_title'   => '',
				)
			);
		}
		register_sidebar(
			array(
				'name'          => __( 'Copyright', 'emuzone' ),
				'id'            => 'copyright',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);
		register_widget( 'FieldWidget' );
		register_widget( 'ShareWidget' );
	}
endif;
add_action( 'widgets_init', 'emuzone_theme_widgets_init' );

function year_shortcode () {
	return date_i18n ('Y');
}
add_shortcode ('year', 'year_shortcode');

/**
 * NavWalker (for menu's)
 */

function emuzone_nav_menu_item_title( $title ) {
	// For menu title, process shortcodes
	return do_shortcode( html_entity_decode( $title ) );
}
add_filter( 'nav_menu_item_title', 'emuzone_nav_menu_item_title' );

function emuzone_nav_menu_link_attributes ( $atts ) {
	// For tooltip title, process shortcodes then strip them out
	if (isset($atts['title']))
		$atts['title'] = trim( strip_tags( do_shortcode( html_entity_decode( $atts['title'] ) ) ) );
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'emuzone_nav_menu_link_attributes' );

if ( ! function_exists( 'emuzone_register_navwalker' ) ) :
	function emuzone_register_navwalker() {
		require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
	}
endif;
add_action( 'after_setup_theme', 'emuzone_register_navwalker' );

function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
	if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
		if ( array_key_exists( 'data-toggle', $atts ) ) {
			unset( $atts['data-toggle'] );
			$atts['data-bs-toggle'] = 'dropdown';
		}
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );

/**
 * Template Tags
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Remove WordPress update notifications
 */
add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );
