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
	$front_id = (int) get_option( 'page_on_front' );
	if ( ! $front_id ) {
		$front_id = (int) get_queried_object_id();
	}
	// Only step aside when the page actually has its own content — a real Elementor
	// widget or Gutenberg/classic content. An *empty* Elementor page (e.g. just
	// opened in the editor) must NOT blank out the coded homepage.
	if ( $front_id && voltalux_page_has_builder_content( $front_id ) ) {
		return false;
	}
	return (bool) apply_filters( 'voltalux_use_coded_homepage', true );
}

/**
 * Does a page have real, user-authored content (Elementor widgets or Gutenberg/classic)?
 *
 * @param int $post_id Page ID.
 * @return bool
 */
function voltalux_page_has_builder_content( $post_id ) {
	// Elementor — only counts when at least one real widget is saved (ignores empty
	// sections/containers created just by opening the editor).
	$data = get_post_meta( $post_id, '_elementor_data', true );
	if ( is_string( $data ) && '' !== $data ) {
		$decoded = json_decode( $data, true );
		if ( voltalux_elementor_data_has_widgets( $decoded ) ) {
			return true;
		}
	}
	// Gutenberg / classic content.
	$content = get_post_field( 'post_content', $post_id );
	if ( is_string( $content ) && '' !== trim( wp_strip_all_tags( $content ) ) ) {
		return true;
	}
	return false;
}

/**
 * Recursively check Elementor element data for at least one widget.
 *
 * @param mixed $elements Decoded _elementor_data.
 * @return bool
 */
function voltalux_elementor_data_has_widgets( $elements ) {
	if ( ! is_array( $elements ) ) {
		return false;
	}
	foreach ( $elements as $el ) {
		if ( isset( $el['elType'] ) && 'widget' === $el['elType'] ) {
			return true;
		}
		if ( ! empty( $el['elements'] ) && voltalux_elementor_data_has_widgets( $el['elements'] ) ) {
			return true;
		}
	}
	return false;
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
 * Resolve the real URL of a theme page by slug.
 *
 * Returns the page's actual permalink when the page exists — so the menu link
 * always matches the page, whatever slug WordPress ended up using and whatever
 * the permalink structure is (pretty OR plain: it then returns ?page_id=…).
 * Falls back to a pretty /slug/ URL if the page has not been created yet.
 *
 * @param string $slug Page slug (e.g. 'fox-ess').
 * @return string
 */
function voltalux_page_link( $slug ) {
	static $cache = array();
	if ( isset( $cache[ $slug ] ) ) {
		return $cache[ $slug ];
	}
	$url = home_url( '/' . $slug . '/' );
	if ( function_exists( 'get_page_by_path' ) ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			$link = get_permalink( $page );
			if ( $link ) {
				$url = $link;
			}
		}
	}
	$cache[ $slug ] = $url;
	return $url;
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
			array( 'name' => __( 'Zonnepanelen', 'voltalux' ),  'desc' => __( 'Wek je eigen stroom op met A-merk panelen.', 'voltalux' ),      'icon' => 'sun',     'url' => voltalux_page_link( 'zonnepanelen' ) ),
			array( 'name' => __( 'Thuisbatterij', 'voltalux' ), 'desc' => __( "Sla je stroom op en gebruik 'm wanneer je wilt.", 'voltalux' ),  'icon' => 'battery', 'url' => voltalux_page_link( 'thuisbatterij' ) ),
			array( 'name' => "Airco's",                          'desc' => __( 'Koelen én verwarmen — stil en energiezuinig.', 'voltalux' ),     'icon' => 'snow',    'url' => voltalux_page_link( 'aircos' ) ),
			array( 'name' => __( 'Dakrenovaties', 'voltalux' ),  'desc' => __( 'Een nieuw, goed geïsoleerd dak dat jaren meegaat.', 'voltalux' ),'icon' => 'roof',    'url' => voltalux_page_link( 'dakdekker' ) ),
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
			array( 'name' => 'Fox ESS', 'spec' => __( 'Beste prijs per kWh', 'voltalux' ), 'desc' => __( 'Modulaire opslag met de scherpste prijs per bruikbare kilowattuur.', 'voltalux' ), 'img' => VOLTALUX_PRODUCT_IMG, 'url' => voltalux_page_link( 'fox-ess' ) ),
			array( 'name' => 'AlphaESS', 'spec' => __( 'Groeit met je mee', 'voltalux' ), 'desc' => __( 'Bouw op met modules van 3,8 kWh, tot ruim 60 kWh.', 'voltalux' ), 'img' => VOLTALUX_PRODUCT_IMG, 'url' => voltalux_page_link( 'alphaess' ) ),
			array( 'name' => 'Sigenergy', 'spec' => __( 'Slimste alles-in-één', 'voltalux' ), 'desc' => __( 'Batterij, omvormer, EV-lader en noodstroom in één toren.', 'voltalux' ), 'img' => VOLTALUX_PRODUCT_IMG, 'url' => voltalux_page_link( 'sigenergy' ) ),
			array( 'name' => __( 'Meer merken', 'voltalux' ), 'spec' => __( 'Vergelijk alle opties', 'voltalux' ), 'desc' => __( 'Bekijk de volledige vergelijking van de thuisbatterijen die wij voeren.', 'voltalux' ), 'img' => VOLTALUX_PRODUCT_IMG, 'url' => voltalux_page_link( 'thuisbatterij' ) ),
		)
	);
}

/**
 * Recent projects (homepage strip + Projecten page).
 *
 * Each project supports the rich fields from the briefing so every project reads
 * as a small proof point: cat, title, location, url, icon, img — plus optional
 * type, system, situation, quote, result. Leave the optional fields empty to
 * hide them; fill them per project for the strongest effect.
 *
 * @return array[]
 */
function voltalux_projects() {
	// Prefer real, wp-admin-managed projects (the "Projecten" post type) when present.
	$cpt = function_exists( 'voltalux_get_cpt_projects' ) ? voltalux_get_cpt_projects() : array();
	if ( ! empty( $cpt ) ) {
		return apply_filters( 'voltalux_projects', $cpt );
	}
	return apply_filters( 'voltalux_projects', voltalux_default_projects() );
}

/**
 * Built-in sample projects — used as a fallback, and seeded into the "Projecten"
 * post type on first run so they are directly editable in wp-admin.
 *
 * @return array[]
 */
function voltalux_default_projects() {
	$base = 'http://voltalux.digiten.nl/wp-content/uploads/2026/07/';
	return array(
			// Example in the exact format from the briefing — duplicate this per real battery project.
			array(
				'cat' => __( 'Thuisbatterij', 'voltalux' ), 'title' => __( 'Sigenergy SigenStor 24 kWh', 'voltalux' ), 'location' => 'Zoetermeer', 'url' => '', 'icon' => 'battery', 'img' => '',
				'system'    => 'Sigenergy SigenStor, 24 kWh, 10 kW controller',
				'situation' => __( '14 panelen, warmtepomp, elektrische auto, 3-fase', 'voltalux' ),
				'quote'     => __( '"Ik leverde 4.100 kWh per jaar terug en zag dat straks verdampen."', 'voltalux' ),
				'result'    => __( 'Zelfverbruik van 34% naar 79%', 'voltalux' ),
			),
			array( 'cat' => __( 'Dakrenovaties', 'voltalux' ), 'title' => __( 'Dakrenovatie incl. 2 lichtkoepels', 'voltalux' ), 'location' => 'Venlo',     'url' => '', 'icon' => 'roof', 'img' => $base . 'IMG_7086.jpeg' ),
			array( 'cat' => __( 'Zonnepanelen', 'voltalux' ),  'title' => __( '8 Black Frame zonnepanelen', 'voltalux' ),        'location' => 'Waalwijk',  'url' => '',     'icon' => 'sun',  'img' => $base . 'IMG_7057.webp' ),
			array( 'cat' => __( 'Zonnepanelen', 'voltalux' ),  'title' => __( 'Uitbreiding 4 Full Black zonnepanelen', 'voltalux' ), 'location' => 'Amersfoort', 'url' => '',                                'icon' => 'sun',  'img' => $base . 'IMG_7058.jpg' ),
			array( 'cat' => __( 'Zonnepanelen', 'voltalux' ),  'title' => __( '2× 6 Full Black zonnepanelen', 'voltalux' ),      'location' => 'Odijk',     'url' => '',       'icon' => 'sun',  'img' => $base . 'IMG_70591-1.jpg' ),
			array( 'cat' => "Airco's",                          'title' => __( '2× 5.0 kWh airco-systemen', 'voltalux' ),        'location' => 'Den Haag',  'url' => '',      'icon' => 'snow', 'img' => $base . 'IMG_6366-1.webp' ),
			array( 'cat' => "Airco's",                          'title' => __( '3.5 kWh airco-systeem', 'voltalux' ),            'location' => 'Dordrecht', 'url' => '',                                'icon' => 'snow', 'img' => $base . 'IMG_7070.webp' ),
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
			array( 'label' => __( 'Over ons', 'voltalux' ), 'url' => voltalux_page_link( 'over-ons' ) ),
			array( 'label' => __( 'Blog', 'voltalux' ),     'url' => voltalux_page_link( 'blog' ) ),
			array( 'label' => __( 'Contact', 'voltalux' ),  'url' => voltalux_page_link( 'contact' ) ),
		)
	);
}
