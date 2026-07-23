<?php
/**
 * Functions that shape template behaviour.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Is the given (or current) page built with Elementor?
 *
 * Used so the coded homepage in front-page.php politely steps aside when the
 * client rebuilds the front page in Elementor.
 *
 * @param int|null $post_id Optional post ID. Defaults to the queried object.
 * @return bool
 */
function voltalux_is_elementor_page( $post_id = null ) {
	if ( ! did_action( 'elementor/loaded' ) || ! class_exists( '\Elementor\Plugin' ) ) {
		return false;
	}
	if ( null === $post_id ) {
		$post_id = get_queried_object_id();
	}
	if ( ! $post_id ) {
		return false;
	}
	$document = \Elementor\Plugin::$instance->documents->get( $post_id );
	return $document && $document->is_built_with_elementor();
}

/**
 * Should the coded (PHP) homepage render?
 *
 * True only when the front page is NOT an Elementor document, so the two never
 * fight over the same screen.
 *
 * @return bool
 */
function voltalux_use_coded_homepage() {
	if ( voltalux_is_elementor_page() ) {
		return false;
	}
	return (bool) apply_filters( 'voltalux_use_coded_homepage', true );
}

/**
 * A short, safe helper to fetch a theme mod with a filterable default.
 *
 * @param string $key     Theme mod key (without the voltalux_ prefix).
 * @param mixed  $default Default value.
 * @return mixed
 */
function voltalux_option( $key, $default = '' ) {
	$value = get_theme_mod( 'voltalux_' . $key, $default );
	return apply_filters( 'voltalux_option_' . $key, $value );
}

/**
 * Pretty reading-time estimate for articles.
 *
 * @param int|null $post_id Post ID.
 * @return string e.g. "4 min lezen"
 */
function voltalux_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( $content ) );
	$minutes = max( 1, (int) round( $words / 200 ) );
	/* translators: %d: number of minutes. */
	return sprintf( _n( '%d min lezen', '%d min lezen', $minutes, 'voltalux' ), $minutes );
}

/**
 * Turn text wrapped in [mark]…[/mark] into the signature green highlight.
 * Lets the client add the marker effect straight from Elementor/Gutenberg text.
 *
 * @param string $content Content.
 * @return string
 */
function voltalux_mark_shortcode_content( $content ) {
	return preg_replace(
		'/\[mark\](.*?)\[\/mark\]/is',
		'<span class="vlx-mark">$1</span>',
		$content
	);
}
add_filter( 'the_content', 'voltalux_mark_shortcode_content', 9 );

add_shortcode(
	'mark',
	function ( $atts, $content = '' ) {
		return '<span class="vlx-mark">' . do_shortcode( $content ) . '</span>';
	}
);

/**
 * Products used across the site (mega-menu, mobile menu, products section).
 * Filter `voltalux_products` to change them without touching templates.
 *
 * @return array[] each: name, desc, tag, image, url
 */
function voltalux_products() {
	$img_battery = VOLTALUX_URI . 'assets/images/battery.svg';
	$img_solar   = VOLTALUX_URI . 'assets/images/solar-battery.svg';

	return apply_filters(
		'voltalux_products',
		array(
			array( 'name' => 'AEG',          'desc' => __( 'Duits kwaliteitsmerk', 'voltalux' ), 'tag' => __( 'Thuisbatterij', 'voltalux' ), 'image' => $img_battery, 'url' => '#aeg' ),
			array( 'name' => 'HyxiPower',    'desc' => __( 'All-in-one systeem', 'voltalux' ),   'tag' => __( 'Thuisbatterij', 'voltalux' ), 'image' => $img_battery, 'url' => '#hyxipower' ),
			array( 'name' => 'AlphaESS',     'desc' => __( 'Modulair & slim', 'voltalux' ),      'tag' => __( 'Thuisbatterij', 'voltalux' ), 'image' => $img_battery, 'url' => '#alphaess' ),
			array( 'name' => __( '+ Zonnepanelen', 'voltalux' ), 'desc' => __( 'Compleet pakket', 'voltalux' ), 'tag' => __( 'Pakket', 'voltalux' ), 'image' => $img_solar, 'url' => '#zonnepanelen' ),
		)
	);
}

/**
 * Default primary-nav links used when no WordPress menu is assigned.
 *
 * @return array[] each: label, url
 */
function voltalux_fallback_nav() {
	return apply_filters(
		'voltalux_fallback_nav',
		array(
			array( 'label' => __( 'Zonnepanelen', 'voltalux' ), 'url' => '#zonnepanelen' ),
			array( 'label' => __( 'Werkwijze', 'voltalux' ),    'url' => '#werkwijze' ),
			array( 'label' => __( 'Kennisbank', 'voltalux' ),   'url' => '#kennisbank' ),
			array( 'label' => __( 'Over ons', 'voltalux' ),     'url' => '#over-ons' ),
		)
	);
}
