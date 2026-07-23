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
 * The four Voltalux services (mega-menu, mobile menu, diensten section).
 * Filter `voltalux_services` to change them without touching templates.
 *
 * @return array[] each: name, desc, icon, url
 */
function voltalux_services() {
	return apply_filters(
		'voltalux_services',
		array(
			array( 'name' => __( 'Zonnepanelen', 'voltalux' ),  'desc' => __( 'Wek je eigen stroom op met A-merk panelen.', 'voltalux' ),      'icon' => 'sun',     'url' => 'https://www.voltalux.nl/zonnepanelen/' ),
			array( 'name' => __( 'Thuisbatterij', 'voltalux' ), 'desc' => __( "Sla je stroom op en gebruik 'm wanneer je wilt.", 'voltalux' ),  'icon' => 'battery', 'url' => 'https://www.voltalux.nl/thuisbatterij/' ),
			array( 'name' => "Airco's",                          'desc' => __( 'Koelen én verwarmen — stil en energiezuinig.', 'voltalux' ),     'icon' => 'snow',    'url' => 'https://www.voltalux.nl/aircos/' ),
			array( 'name' => __( 'Dakrenovaties', 'voltalux' ),  'desc' => __( 'Een nieuw, goed geïsoleerd dak dat jaren meegaat.', 'voltalux' ),'icon' => 'roof',    'url' => 'https://www.voltalux.nl/dakdekker/' ),
		)
	);
}

/**
 * Popular home-battery products (shown inside the mega-menu).
 *
 * @return array[] each: name, spec, url
 */
function voltalux_battery_products() {
	return apply_filters(
		'voltalux_battery_products',
		array(
			array( 'name' => 'AEG', 'spec' => __( 'Duits A-merk', 'voltalux' ), 'desc' => __( 'Betrouwbare opslag van een gerenommeerd merk.', 'voltalux' ), 'url' => 'https://www.voltalux.nl/thuisbatterij/' ),
			array( 'name' => 'HyxiPower', 'spec' => __( 'All-in-one', 'voltalux' ), 'desc' => __( 'Batterij en omvormer in één compact systeem.', 'voltalux' ), 'url' => 'https://www.voltalux.nl/thuisbatterij/' ),
			array( 'name' => 'AlphaESS', 'spec' => __( 'Modulair', 'voltalux' ), 'desc' => __( 'Breid eenvoudig uit met extra capaciteit.', 'voltalux' ), 'url' => 'https://www.voltalux.nl/thuisbatterij/' ),
			array( 'name' => 'Fox ESS', 'spec' => __( 'Compact & slim', 'voltalux' ), 'desc' => __( 'Krachtige opslag in een klein formaat.', 'voltalux' ), 'url' => 'https://www.voltalux.nl/thuisbatterij/' ),
		)
	);
}

/**
 * Recent projects (projecten section).
 *
 * @return array[] each: cat, title, location, url
 */
function voltalux_projects() {
	return apply_filters(
		'voltalux_projects',
		array(
			array( 'cat' => "Airco's",       'title' => __( '2× 5.0 kWh airco-systemen', 'voltalux' ),      'location' => 'Den Haag',  'url' => 'https://www.voltalux.nl/project/2x-5-0-kwh-airco-systemen-den-haag/', 'icon' => 'snow' ),
			array( 'cat' => __( 'Dakrenovaties', 'voltalux' ), 'title' => __( 'Dakrenovatie incl. 2 lichtkoepels', 'voltalux' ), 'location' => 'Venlo', 'url' => 'https://www.voltalux.nl/project/dakrenovatie-incl-2-lichtkoepels-venlo/', 'icon' => 'roof' ),
			array( 'cat' => __( 'Zonnepanelen', 'voltalux' ),  'title' => __( '8 Black Frame zonnepanelen', 'voltalux' ),      'location' => 'Waalwijk',  'url' => 'https://www.voltalux.nl/project/8-black-frame-zonnepanelen-waalwijk/', 'icon' => 'sun' ),
			array( 'cat' => __( 'Zonnepanelen', 'voltalux' ),  'title' => __( '2× 6 Full Black zonnepanelen', 'voltalux' ),    'location' => 'Odijk',     'url' => 'https://www.voltalux.nl/project/2x-6-full-black-zonnepanelen-odijk/', 'icon' => 'sun' ),
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
			array( 'label' => __( 'Projecten', 'voltalux' ), 'url' => '#projecten' ),
			array( 'label' => __( 'Werkwijze', 'voltalux' ), 'url' => '#werkwijze' ),
			array( 'label' => __( 'Reviews', 'voltalux' ),   'url' => '#reviews' ),
			array( 'label' => __( 'Contact', 'voltalux' ),   'url' => '#contact' ),
		)
	);
}
