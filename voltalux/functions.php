<?php
/**
 * Voltalux theme functions and definitions.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

if ( ! defined( 'VOLTALUX_VERSION' ) ) {
	define( 'VOLTALUX_VERSION', '3.14.0' );
}
define( 'VOLTALUX_DIR', trailingslashit( get_template_directory() ) );
define( 'VOLTALUX_URI', trailingslashit( get_template_directory_uri() ) );

/*
 * Hard-coded brand defaults (supplied by the client).
 * These are ONLY defaults — every one of them is editable without code via
 * Appearance > Customize, and the homepage hero/logo are also editable in
 * Elementor once the Voltalux homepage template is imported.
 */
if ( ! defined( 'VOLTALUX_DEFAULT_LOGO' ) ) {
	define( 'VOLTALUX_DEFAULT_LOGO', 'http://voltalux.digiten.nl/wp-content/uploads/2026/07/voltalux__4_-removebg-preview-e1705574376130.webp' );
}
if ( ! defined( 'VOLTALUX_DEFAULT_HERO_VIDEO' ) ) {
	define( 'VOLTALUX_DEFAULT_HERO_VIDEO', 'http://voltalux.digiten.nl/wp-content/uploads/2026/07/5-UUR-VOLTALUX-Sterling-Fpv-1080p.mp4' );
}
/* Temporary filler product photo — swap per product in the `voltalux_battery_products` filter or via media once real photos are shot. */
if ( ! defined( 'VOLTALUX_PRODUCT_IMG' ) ) {
	define( 'VOLTALUX_PRODUCT_IMG', 'https://www.domogo.nl/content/uploads/2026/05/AEG-thuisbatterij-e1779797821426-360x640.png' );
}
/* Welkom-sectie afbeelding (naast de intro-tekst). Vervangbaar via de `voltalux_home_welkom_image` filter. */
if ( ! defined( 'VOLTALUX_WELKOM_IMG' ) ) {
	define( 'VOLTALUX_WELKOM_IMG', 'http://voltalux.digiten.nl/wp-content/uploads/2026/07/IMG_6353.jpg' );
}

/* Real Voltalux contact defaults (client can change all of these in the Customizer). */
if ( ! defined( 'VOLTALUX_PHONE' ) )   { define( 'VOLTALUX_PHONE', '085-0600106' ); }
if ( ! defined( 'VOLTALUX_EMAIL' ) )   { define( 'VOLTALUX_EMAIL', 'info@voltalux.nl' ); }
if ( ! defined( 'VOLTALUX_ADDRESS' ) ) { define( 'VOLTALUX_ADDRESS', "Professor Eykmanweg 29\n5144 ND Waalwijk" ); }
if ( ! defined( 'VOLTALUX_KVK' ) )     { define( 'VOLTALUX_KVK', 'KvK 87951681' ); }
if ( ! defined( 'VOLTALUX_FB' ) )      { define( 'VOLTALUX_FB', 'https://www.facebook.com/p/Voltalux-NL-100087523061118/' ); }
if ( ! defined( 'VOLTALUX_IG' ) )      { define( 'VOLTALUX_IG', 'https://www.instagram.com/voltalux.nl/' ); }

/* Google reviews badge (footer). Editable in the Customizer → Footer. */
if ( ! defined( 'VOLTALUX_GOOGLE_URL' ) )    { define( 'VOLTALUX_GOOGLE_URL', 'https://share.google/hMebBVh8pLYfXjEdE' ); }
if ( ! defined( 'VOLTALUX_GOOGLE_RATING' ) ) { define( 'VOLTALUX_GOOGLE_RATING', '4,7' ); }
if ( ! defined( 'VOLTALUX_GOOGLE_COUNT' ) )  { define( 'VOLTALUX_GOOGLE_COUNT', '130+' ); }

/* -------------------------------------------------------------------------
 *  Theme setup
 * ---------------------------------------------------------------------- */
if ( ! function_exists( 'voltalux_setup' ) ) {
	function voltalux_setup() {

		load_theme_textdomain( 'voltalux', VOLTALUX_DIR . 'languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );

		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
		);

		// Logo — default is the Voltalux logo; the client can swap it in Appearance > Customize.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 64,
				'width'       => 220,
				'flex-height' => true,
				'flex-width'  => true,
				'unlink-homepage-logo' => false,
			)
		);

		// Editor styling so Gutenberg matches the front-end brand.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor.css' );

		// Curated brand palette for the block editor.
		add_theme_support(
			'editor-color-palette',
			array(
				array( 'name' => __( 'Voltalux groen', 'voltalux' ), 'slug' => 'vlx-green', 'color' => '#15DD6E' ),
				array( 'name' => __( 'Zwart', 'voltalux' ),         'slug' => 'vlx-black', 'color' => '#0A0B0D' ),
				array( 'name' => __( 'Wit', 'voltalux' ),           'slug' => 'vlx-white', 'color' => '#FFFFFF' ),
				array( 'name' => __( 'Papier', 'voltalux' ),        'slug' => 'vlx-paper', 'color' => '#F5F5F1' ),
				array( 'name' => __( 'Groen tint', 'voltalux' ),    'slug' => 'vlx-green-soft', 'color' => '#E9FBF1' ),
			)
		);

		register_nav_menus(
			array(
				'primary' => __( 'Hoofdmenu', 'voltalux' ),
				'footer'  => __( 'Footermenu', 'voltalux' ),
				'legal'   => __( 'Juridisch (footer onderkant)', 'voltalux' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'voltalux_setup' );

/**
 * Content width.
 */
function voltalux_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'voltalux_content_width', 1240 );
}
add_action( 'after_setup_theme', 'voltalux_content_width', 0 );

/* -------------------------------------------------------------------------
 *  Assets (styles + self-hosted fonts + scripts)
 * ---------------------------------------------------------------------- */
function voltalux_assets() {

	// Self-hosted variable fonts (GDPR/AVG-safe — no Google CDN calls).
	wp_enqueue_style( 'voltalux-fonts', VOLTALUX_URI . 'assets/fonts/fonts.css', array(), VOLTALUX_VERSION );

	// Foundation (theme header + tokens + reset).
	wp_enqueue_style( 'voltalux-style', get_stylesheet_uri(), array( 'voltalux-fonts' ), VOLTALUX_VERSION );

	// Components (header, footer, cards, sections, homepage).
	wp_enqueue_style( 'voltalux-theme', VOLTALUX_URI . 'assets/css/theme.css', array( 'voltalux-style' ), VOLTALUX_VERSION );

	// Inline the brand accent so a Customizer colour change is instant.
	$accent = sanitize_hex_color( get_theme_mod( 'voltalux_accent', '#15DD6E' ) );
	if ( $accent ) {
		$hover   = voltalux_adjust_brightness( $accent, -12 );
		$strong  = voltalux_adjust_brightness( $accent, -38 );
		wp_add_inline_style( 'voltalux-theme', ":root{--green:{$accent};--green-600:{$hover};--green-strong:{$strong};}" );
	}

	// Scripts.
	wp_enqueue_script( 'voltalux-theme', VOLTALUX_URI . 'assets/js/theme.js', array(), VOLTALUX_VERSION, true );
	wp_localize_script(
		'voltalux-theme',
		'voltaluxData',
		array( 'reduceMotion' => false )
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'voltalux_assets' );

/**
 * Darken/lighten a hex colour by a percentage (used for hover states).
 */
function voltalux_adjust_brightness( $hex, $percent ) {
	$hex = ltrim( $hex, '#' );
	if ( strlen( $hex ) === 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	$r = hexdec( substr( $hex, 0, 2 ) );
	$g = hexdec( substr( $hex, 2, 2 ) );
	$b = hexdec( substr( $hex, 4, 2 ) );
	$adjust = function ( $c ) use ( $percent ) {
		$c = round( $c * ( 100 + $percent ) / 100 );
		return max( 0, min( 255, $c ) );
	};
	return sprintf( '#%02x%02x%02x', $adjust( $r ), $adjust( $g ), $adjust( $b ) );
}

/* -------------------------------------------------------------------------
 *  Widget areas
 * ---------------------------------------------------------------------- */
function voltalux_widgets_init() {
	$defaults = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget__title">',
		'after_title'   => '</h4>',
	);

	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar(
			array_merge(
				$defaults,
				array(
					/* translators: %d: footer column number. */
					'name'        => sprintf( __( 'Footer kolom %d', 'voltalux' ), $i ),
					'id'          => 'footer-' . $i,
					'description' => __( 'Widgets voor de footer.', 'voltalux' ),
				)
			)
		);
	}

	register_sidebar(
		array_merge(
			$defaults,
			array(
				'name'        => __( 'Zijbalk (blog)', 'voltalux' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Verschijnt naast blogberichten en archieven.', 'voltalux' ),
			)
		)
	);
}
add_action( 'widgets_init', 'voltalux_widgets_init' );

/* -------------------------------------------------------------------------
 *  Includes
 * ---------------------------------------------------------------------- */
require VOLTALUX_DIR . 'inc/template-tags.php';
require VOLTALUX_DIR . 'inc/template-functions.php';
require VOLTALUX_DIR . 'inc/customizer.php';
require VOLTALUX_DIR . 'inc/elementor.php';
require VOLTALUX_DIR . 'inc/setup.php';
require VOLTALUX_DIR . 'inc/huisscan.php';

/* -------------------------------------------------------------------------
 *  Small quality-of-life tweaks
 * ---------------------------------------------------------------------- */

// Larger, brand-styled excerpt.
function voltalux_excerpt_length( $length ) {
	return 26;
}
add_filter( 'excerpt_length', 'voltalux_excerpt_length' );

function voltalux_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'voltalux_excerpt_more' );

// Add helpful body classes.
function voltalux_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'vlx-archive';
	}
	if ( is_front_page() ) {
		$classes[] = 'vlx-front';
	}
	if ( voltalux_is_elementor_page() ) {
		$classes[] = 'vlx-elementor-page';
	}
	return $classes;
}
add_filter( 'body_class', 'voltalux_body_classes' );

// Remove clutter from <head>.
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
