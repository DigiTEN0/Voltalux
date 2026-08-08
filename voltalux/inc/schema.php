<?php
/**
 * Structured data (JSON-LD).
 *
 * - LocalBusiness / Organization site-wide (name, address, work area, reviews).
 * - FAQPage, built automatically from any FAQ rendered via voltalux_faq_block().
 * - Product, emitted by the product-detail template per brand page.
 *
 * Per the briefing: "FAQ-blokken voorzien van FAQPage-schema en productpagina's
 * van Product-schema."
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Collect FAQ pairs during the render so they can be emitted once in the footer.
 *
 * @param array $faq array( array( question, answer ), ... )
 */
function voltalux_register_faq( $faq ) {
	if ( empty( $faq ) || ! is_array( $faq ) ) {
		return;
	}
	if ( ! isset( $GLOBALS['voltalux_faq_schema'] ) ) {
		$GLOBALS['voltalux_faq_schema'] = array();
	}
	foreach ( $faq as $item ) {
		if ( ! empty( $item[0] ) && ! empty( $item[1] ) ) {
			$GLOBALS['voltalux_faq_schema'][] = array( (string) $item[0], (string) $item[1] );
		}
	}
}

/**
 * The work area (areaServed) — filterable, shown site-wide too.
 *
 * @return string[]
 */
function voltalux_work_area() {
	return apply_filters(
		'voltalux_work_area',
		array( 'Noord-Brabant', 'Zuid-Holland', 'Utrecht', 'Gelderland', 'Limburg' )
	);
}

/**
 * Parse the multi-line address constant into parts.
 *
 * @return array street, postal, city
 */
function voltalux_address_parts() {
	$raw   = voltalux_option( 'footer_address', VOLTALUX_ADDRESS );
	$lines = array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $raw ) ) ) );
	$street = isset( $lines[0] ) ? $lines[0] : '';
	$postal = '';
	$city   = '';
	if ( isset( $lines[1] ) ) {
		if ( preg_match( '/^\s*(\d{4}\s?[A-Za-z]{2})\s+(.+)$/', $lines[1], $m ) ) {
			$postal = trim( $m[1] );
			$city   = trim( $m[2] );
		} else {
			$city = $lines[1];
		}
	}
	return array( $street, $postal, $city );
}

/**
 * Emit the LocalBusiness graph in the <head>.
 */
function voltalux_schema_localbusiness() {
	list( $street, $postal, $city ) = voltalux_address_parts();

	$phone  = voltalux_option( 'phone', VOLTALUX_PHONE );
	$email  = voltalux_option( 'footer_email', VOLTALUX_EMAIL );
	$rating = str_replace( ',', '.', (string) voltalux_option( 'google_rating', VOLTALUX_GOOGLE_RATING ) );
	$count  = preg_replace( '/[^0-9]/', '', (string) voltalux_option( 'google_count', VOLTALUX_GOOGLE_COUNT ) );

	$logo = voltalux_option( 'logo_url', VOLTALUX_DEFAULT_LOGO );

	$sameas = array_values(
		array_filter(
			array(
				voltalux_option( 'social_facebook', VOLTALUX_FB ),
				voltalux_option( 'social_instagram', VOLTALUX_IG ),
				voltalux_option( 'social_linkedin', '' ),
				voltalux_option( 'social_youtube', '' ),
			)
		)
	);

	$data = array(
		'@context' => 'https://schema.org',
		'@type'    => array( 'LocalBusiness', 'Electrician', 'HVACBusiness' ),
		'name'     => get_bloginfo( 'name' ),
		'url'      => home_url( '/' ),
		'image'    => $logo ? set_url_scheme( $logo ) : '',
		'logo'     => $logo ? set_url_scheme( $logo ) : '',
		'telephone' => $phone,
		'email'    => $email,
		'address'  => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $street,
			'postalCode'      => $postal,
			'addressLocality' => $city,
			'addressCountry'  => 'NL',
		),
		'areaServed' => array_map(
			function ( $a ) {
				return array( '@type' => 'AdministrativeArea', 'name' => $a );
			},
			voltalux_work_area()
		),
	);

	if ( $sameas ) {
		$data['sameAs'] = $sameas;
	}
	if ( is_numeric( $rating ) && $count ) {
		$data['aggregateRating'] = array(
			'@type'       => 'AggregateRating',
			'ratingValue' => $rating,
			'reviewCount' => (int) $count,
			'bestRating'  => '5',
		);
	}

	voltalux_print_jsonld( $data );
}
add_action( 'wp_head', 'voltalux_schema_localbusiness', 20 );

/**
 * Emit the collected FAQPage schema in the footer (after all FAQs rendered).
 */
function voltalux_schema_faqpage() {
	if ( empty( $GLOBALS['voltalux_faq_schema'] ) ) {
		return;
	}
	$items = array();
	foreach ( $GLOBALS['voltalux_faq_schema'] as $pair ) {
		$items[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $pair[0] ),
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $pair[1] ),
			),
		);
	}
	voltalux_print_jsonld(
		array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $items,
		)
	);
}
add_action( 'wp_footer', 'voltalux_schema_faqpage', 99 );

/**
 * SEO: meta description + Open Graph for singular pages/posts.
 *
 * Steps aside automatically when a dedicated SEO plugin (Yoast, Rank Math, SEOPress,
 * AIOSEO) is active, so we never output duplicate tags.
 */
/**
 * Is a dedicated SEO plugin managing titles/meta? If so we step aside.
 *
 * @return bool
 */
function voltalux_seo_plugin_active() {
	return (
		defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ||
		defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' )
	);
}

/**
 * Exact per-page SEO titles + meta descriptions from the briefing (PDF 2).
 * Keyed by page slug: array( title, description ). Filterable.
 *
 * @return array[]
 */
function voltalux_seo_overrides() {
	return apply_filters(
		'voltalux_seo_overrides',
		array(
			// Keys = live voltalux.nl slugs. Titles/meta kept in line with the old Yoast values.
			'zonnepanelen'    => array( __( 'Zonnepanelen laten installeren', 'voltalux' ), __( 'Zonnepanelen van A-merken, all-in geïnstalleerd door eigen erkende monteurs. Binnen 3 weken geplaatst — vraag vrijblijvend een offerte aan.', 'voltalux' ) ),
			'thuisbatterij'   => array( __( 'Thuisbatterij kopen', 'voltalux' ), __( 'Merken, prijzen en eerlijk advies — Fox ESS, AlphaESS en Sigenergy naast elkaar.', 'voltalux' ) ),
			'fox-ess'         => array( __( 'Fox ESS thuisbatterij', 'voltalux' ), __( 'Modellen, capaciteit en prijs van de Fox ESS thuisbatterij — all-in geïnstalleerd.', 'voltalux' ) ),
			'alphaess'        => array( __( 'AlphaESS thuisbatterij', 'voltalux' ), __( 'SMILE-G3 modellen en prijs — de thuisbatterij die met je verbruik meegroeit.', 'voltalux' ) ),
			'sigenergy'       => array( __( 'Sigenergy SigenStor', 'voltalux' ), __( '5-in-1 thuisbatterij met EV-lader, omvormer en noodstroom — modellen en prijs.', 'voltalux' ) ),
			'aircos'          => array( __( 'Airco laten installeren', 'voltalux' ), __( 'Daikin en LG, all-in prijs. Koelen én verwarmen, F-gassen-gecertificeerd gemonteerd.', 'voltalux' ) ),
			'daikin'          => array( __( 'Daikin airco', 'voltalux' ), __( 'Perfera, Stylish, Emura en Sensira — hoogste rendement, all-in geïnstalleerd.', 'voltalux' ) ),
			'lg'              => array( __( 'LG airco', 'voltalux' ), __( 'Standard Plus, Artcool en Prestige — sterke luchtreiniging en prijs-kwaliteit.', 'voltalux' ) ),
			'warmtepompen'    => array( __( 'Warmtepomp laten installeren', 'voltalux' ), __( 'Hybride en volledige warmtepompen, all-in geïnstalleerd door erkende monteurs. Lagere energiekosten en meer comfort — vraag vrijblijvend advies.', 'voltalux' ) ),
			'dakdekker'       => array( __( 'Dakrenovatie door dakdekkersbedrijf Voltalux', 'voltalux' ), __( 'Professionele dakrenovatie door ervaren en erkende dakdekkers tegen scherpe tarieven. Bespreek de mogelijkheden tijdens een gratis adviesgesprek.', 'voltalux' ) ),
				// Dakdekker-subpagina's — exacte live titels/meta (Yoast) zodat de SEO 1-op-1 behouden blijft.
				'bitumen-dak-vervangen' => array( __( 'Bitumen dak vervangen? Professioneel vanaf € 40 per m²', 'voltalux' ), __( 'Laat je bitumen dak vervangen door Voltalux. Vanaf € 40 per m² voor nieuwe dakbedekking of € 55 per m² voor vervanging. Plan een gratis adviesgesprek!', 'voltalux' ) ),
				'dak-reparatie'   => array( __( 'Dakreparatie door betrouwbare dakdekkers - Voltalux', 'voltalux' ), __( 'Laat je dak snel en vakkundig repareren door Voltalux. Van lekkages tot beschadigde daken en complete renovaties. Vraag nu een gratis adviesgesprek aan!', 'voltalux' ) ),
				'dakisolatie'     => array( __( 'Dakisolatie door Voltalux voor lagere energiekosten', 'voltalux' ), __( 'Kies voor dakisolatie van Voltalux en geniet van lagere energiekosten en een comfortabeler huis. Gratis adviesgesprek met erkende dakdekkers.', 'voltalux' ) ),
				'dakkapel-plaatsen' => array( __( 'Dakkapel plaatsen kosten en afmetingen - Voltalux', 'voltalux' ), __( 'Kies voor een duurzame dakkapel van Voltalux. Meer licht en ruimte in huis, vakkundige plaatsing door ervaren dakdekkers. Plan een gratis adviesgesprek!', 'voltalux' ) ),
				'dakpannen-vervangen' => array( __( 'Dakpannen vervangen – dakdekkersbedrijf Voltalux', 'voltalux' ), __( 'Dakpannen laten vervangen of een pannendak vernieuwen? Ontdek de kosten, levensduur en mogelijkheden bij Voltalux. Vraag een gratis adviesgesprek aan!', 'voltalux' ) ),
				'kunststof-kozijnen' => array( __( 'Kunststof kozijnen laten plaatsen - Voltalux', 'voltalux' ), __( 'Kunststof kozijnen aanschaffen? Uitstekende isolatie, lange levensduur en een stijlvolle uitstraling. Vraag nu een offerte aan en ontdek de mogelijkheden!', 'voltalux' ) ),
			'zakelijk'        => array( __( 'Zakelijke batterijopslag en containerbatterijen', 'voltalux' ), __( 'Groeien ondanks netcongestie. Peak shaving en batterijopslag van 30 kWh tot meerdere MWh, met doorgerekende businesscase.', 'voltalux' ) ),
			'werkwijze'       => array( __( 'Zo werken wij', 'voltalux' ), __( 'Van vrijblijvend adviesgesprek tot oplevering — en de nazorg daarna.', 'voltalux' ) ),
			'onze-projecten'  => array( __( 'Uitgevoerde projecten', 'voltalux' ), __( 'Onze recent uitgevoerde installaties door heel Nederland: thuisbatterijen, zonnepanelen en airco.', 'voltalux' ) ),
				'over-ons'        => array( __( 'Over Voltalux — jouw partner in verduurzaming', 'voltalux' ), __( 'Maak kennis met Voltalux: eigen erkende installateurs, A-merken en één aanspreekpunt voor zonnepanelen, thuisbatterijen, airco, warmtepompen en dakrenovatie.', 'voltalux' ) ),
				'contact'         => array( __( 'Contact opnemen met Voltalux', 'voltalux' ), __( 'Vragen of een gratis adviesgesprek? Bel 085-0600106 of laat je gegevens achter — we nemen zo snel mogelijk contact met je op.', 'voltalux' ) ),
				'veelgestelde-vragen' => array( __( 'Veelgestelde vragen over zonnepanelen - Voltalux', 'voltalux' ), __( 'Antwoord op de meestgestelde vragen over zonnepanelen, salderen, onderhoud en rendement. Staat je vraag er niet bij? Neem contact op met Voltalux.', 'voltalux' ) ),
				'privacybeleid'   => array( __( 'Privacybeleid - Voltalux', 'voltalux' ), __( 'Lees hoe Voltalux omgaat met je persoonsgegevens en privacy op deze website.', 'voltalux' ) ),

				// Lokale landingspagina's — stads-specifieke titels/meta (fallback als er geen SEO-plugin actief is).
				// Let op: de eigen tekst van deze pagina's blijft staan; alleen de <title>/meta wordt hier ingevuld.
				'zonnepanelen-vught'     => array( __( 'Zonnepanelen laten installeren in Vught - Voltalux', 'voltalux' ), __( 'Zonnepanelen laten installeren in Vught? Voltalux plaatst A-merken all-in met eigen erkende monteurs. Vraag vrijblijvend een offerte aan.', 'voltalux' ) ),
				'zonnepanelen-eindhoven' => array( __( 'Zonnepanelen laten installeren in Eindhoven - Voltalux', 'voltalux' ), __( 'Zonnepanelen laten installeren in Eindhoven? Voltalux plaatst A-merken all-in met eigen erkende monteurs. Vraag vrijblijvend een offerte aan.', 'voltalux' ) ),
				'zonnepanelen-den-bosch' => array( __( 'Zonnepanelen laten installeren in Den Bosch - Voltalux', 'voltalux' ), __( 'Zonnepanelen laten installeren in Den Bosch? Voltalux plaatst A-merken all-in met eigen erkende monteurs. Vraag vrijblijvend een offerte aan.', 'voltalux' ) ),
				'airco-breda'            => array( __( 'Airco laten installeren in Breda - Voltalux', 'voltalux' ), __( 'Airco laten installeren in Breda? Daikin en LG all-in geïnstalleerd door Voltalux — koelen én verwarmen. Vraag een vrijblijvende offerte aan.', 'voltalux' ) ),
				'airco-den-bosch'        => array( __( 'Airco laten installeren in Den Bosch - Voltalux', 'voltalux' ), __( 'Airco laten installeren in Den Bosch? Daikin en LG all-in geïnstalleerd door Voltalux — koelen én verwarmen. Vraag een vrijblijvende offerte aan.', 'voltalux' ) ),
				'airco-vught'            => array( __( 'Airco laten installeren in Vught - Voltalux', 'voltalux' ), __( 'Airco laten installeren in Vught? Daikin en LG all-in geïnstalleerd door Voltalux — koelen én verwarmen. Vraag een vrijblijvende offerte aan.', 'voltalux' ) ),
				'dakrenovatie-den-bosch' => array( __( 'Dakrenovatie in Den Bosch — dakdekker Voltalux', 'voltalux' ), __( 'Dakrenovatie in Den Bosch door de erkende dakdekkers van Voltalux. Scherpe tarieven en een gratis dakinspectie. Plan een vrijblijvend adviesgesprek.', 'voltalux' ) ),
				'dakrenovatie-tilburg'   => array( __( 'Dakrenovatie in Tilburg — dakdekker Voltalux', 'voltalux' ), __( 'Dakrenovatie in Tilburg door de erkende dakdekkers van Voltalux. Scherpe tarieven en een gratis dakinspectie. Plan een vrijblijvend adviesgesprek.', 'voltalux' ) ),
				'dakrenovatie-vught'     => array( __( 'Dakrenovatie in Vught — dakdekker Voltalux', 'voltalux' ), __( 'Dakrenovatie in Vught door de erkende dakdekkers van Voltalux. Scherpe tarieven en een gratis dakinspectie. Plan een vrijblijvend adviesgesprek.', 'voltalux' ) ),
				'warmtepomp-breda'       => array( __( 'Warmtepomp laten installeren in Breda - Voltalux', 'voltalux' ), __( 'Warmtepomp laten installeren in Breda? Voltalux installeert hybride en volledige warmtepompen, vaak met ISDE-subsidie. Vraag vrijblijvend advies aan.', 'voltalux' ) ),
				'warmtepomp-eindhoven'   => array( __( 'Warmtepomp laten installeren in Eindhoven - Voltalux', 'voltalux' ), __( 'Warmtepomp laten installeren in Eindhoven? Voltalux installeert hybride en volledige warmtepompen, vaak met ISDE-subsidie. Vraag vrijblijvend advies aan.', 'voltalux' ) ),
				'warmtepomp-tilburg'     => array( __( 'Warmtepomp laten installeren in Tilburg - Voltalux', 'voltalux' ), __( 'Warmtepomp laten installeren in Tilburg? Voltalux installeert hybride en volledige warmtepompen, vaak met ISDE-subsidie. Vraag vrijblijvend advies aan.', 'voltalux' ) ),
		)
	);
}

/**
 * Apply the exact SEO title to the document <title> for matching pages.
 *
 * @param array $parts
 * @return array
 */
function voltalux_seo_document_title( $parts ) {
	if ( voltalux_seo_plugin_active() || ! is_singular() ) {
		return $parts;
	}
	$slug = get_post_field( 'post_name', get_queried_object_id() );
	$map  = voltalux_seo_overrides();
	if ( isset( $map[ $slug ][0] ) && $map[ $slug ][0] ) {
		$parts['title'] = $map[ $slug ][0];
	}
	return $parts;
}
add_filter( 'document_title_parts', 'voltalux_seo_document_title' );

function voltalux_seo_meta() {
	if ( voltalux_seo_plugin_active() || ! is_singular() ) {
		return;
	}

	$slug = get_post_field( 'post_name', get_queried_object_id() );
	$bat  = function_exists( 'voltalux_batteries' ) ? voltalux_batteries() : array();
	$air  = function_exists( 'voltalux_aircos' ) ? voltalux_aircos() : array();
	$over = voltalux_seo_overrides();

	$desc = '';
	if ( isset( $over[ $slug ][1] ) && $over[ $slug ][1] ) {
		$desc = $over[ $slug ][1];
	} elseif ( isset( $bat[ $slug ] ) ) {
		$desc = $bat[ $slug ]['oneliner'] . ' ' . $bat[ $slug ]['intro'];
	} elseif ( isset( $air[ $slug ] ) ) {
		$desc = $air[ $slug ]['oneliner'] . ' ' . $air[ $slug ]['intro'];
	} else {
		$desc = get_the_excerpt();
	}

	$desc = trim( wp_strip_all_tags( (string) $desc ) );
	if ( '' === $desc ) {
		return;
	}
	if ( function_exists( 'mb_substr' ) && mb_strlen( $desc ) > 158 ) {
		$desc = rtrim( mb_substr( $desc, 0, 155 ) ) . '…';
	}

	$title = ( isset( $over[ $slug ][0] ) && $over[ $slug ][0] ) ? $over[ $slug ][0] : get_the_title();
	$logo  = voltalux_option( 'logo_url', VOLTALUX_DEFAULT_LOGO );

	echo "\n";
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	echo '<meta property="og:type" content="website">' . "\n";
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( get_permalink() ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	if ( $logo ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( set_url_scheme( $logo ) ) );
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action( 'wp_head', 'voltalux_seo_meta', 1 );

/**
 * Emit Product schema for a brand (called from the product-detail template).
 *
 * @param array $brand One entry from voltalux_batteries()/voltalux_aircos().
 */
function voltalux_schema_product( $brand ) {
	if ( empty( $brand['name'] ) ) {
		return;
	}
	$rating = str_replace( ',', '.', (string) voltalux_option( 'google_rating', VOLTALUX_GOOGLE_RATING ) );
	$count  = preg_replace( '/[^0-9]/', '', (string) voltalux_option( 'google_count', VOLTALUX_GOOGLE_COUNT ) );

	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Product',
		'name'        => $brand['name'],
		'description' => isset( $brand['oneliner'] ) ? wp_strip_all_tags( $brand['oneliner'] ) : '',
		'category'    => 'batterij' === $brand['kind'] ? 'Thuisbatterij' : 'Airconditioning',
		'brand'       => array( '@type' => 'Brand', 'name' => $brand['name'] ),
		'url'         => get_permalink(),
	);
	if ( is_numeric( $rating ) && $count ) {
		$data['aggregateRating'] = array(
			'@type'       => 'AggregateRating',
			'ratingValue' => $rating,
			'reviewCount' => (int) $count,
			'bestRating'  => '5',
		);
	}
	voltalux_print_jsonld( $data );
}

/**
 * Print a JSON-LD script tag from an array (recursively cleaned of empties).
 *
 * @param array $data
 */
function voltalux_print_jsonld( $data ) {
	$clean = voltalux_array_filter_deep( $data );
	echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $clean, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Recursively remove empty strings/arrays but keep 0 and "0".
 *
 * @param mixed $value
 * @return mixed
 */
function voltalux_array_filter_deep( $value ) {
	if ( ! is_array( $value ) ) {
		return $value;
	}
	$out = array();
	foreach ( $value as $k => $v ) {
		$v = voltalux_array_filter_deep( $v );
		if ( '' === $v || ( is_array( $v ) && empty( $v ) ) ) {
			continue;
		}
		$out[ $k ] = $v;
	}
	return $out;
}
