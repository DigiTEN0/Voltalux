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
