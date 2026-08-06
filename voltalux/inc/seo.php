<?php
/**
 * Voltalux SEO — meta tags, Open Graph, Twitter cards, canonical and rich
 * structured data (JSON-LD). Built to strengthen ranking out of the box.
 *
 * IMPORTANT: this module steps aside automatically when a dedicated SEO plugin
 * (Yoast, Rank Math, SEOPress, AIOSEO) is active, so there are never duplicate
 * tags. Migrating from an existing site keeps its SEO intact — URLs, titles and
 * content are untouched; this only adds the machine-readable layer search
 * engines reward.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Should the theme output its own SEO tags? (No if an SEO plugin owns them.)
 */
function voltalux_seo_enabled() {
	$plugin_active = defined( 'WPSEO_VERSION' )        // Yoast.
		|| defined( 'RANK_MATH_VERSION' )               // Rank Math.
		|| defined( 'SEOPRESS_VERSION' )                // SEOPress.
		|| defined( 'AIOSEO_VERSION' )                  // All in One SEO.
		|| class_exists( 'RankMath' );
	return (bool) apply_filters( 'voltalux_seo_enabled', ! $plugin_active );
}

/* -------------------------------------------------------------------------
 *  Helpers
 * ---------------------------------------------------------------------- */

/**
 * A clean meta description for the current view (max ~160 chars).
 */
function voltalux_meta_description() {
	$desc = '';

	if ( is_front_page() ) {
		$desc = voltalux_option( 'seo_home_desc', '' );
		if ( ! $desc ) {
			$desc = get_bloginfo( 'description' );
		}
	} elseif ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : $post->post_content;
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$desc = term_description();
	} elseif ( is_home() ) {
		$desc = get_bloginfo( 'description' );
	} else {
		$desc = get_bloginfo( 'description' );
	}

	$desc = wp_strip_all_tags( strip_shortcodes( (string) $desc ) );
	$desc = trim( preg_replace( '/\s+/', ' ', $desc ) );
	if ( function_exists( 'mb_substr' ) && mb_strlen( $desc ) > 160 ) {
		$desc = rtrim( mb_substr( $desc, 0, 157 ) ) . '…';
	}
	return apply_filters( 'voltalux_meta_description', $desc );
}

/**
 * Canonical URL for the current view.
 */
function voltalux_canonical_url() {
	$url = '';
	if ( is_front_page() ) {
		$url = home_url( '/' );
	} elseif ( is_singular() ) {
		$url = get_permalink();
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$term = get_queried_object();
		if ( $term && ! is_wp_error( $term ) ) {
			$url = get_term_link( $term );
		}
	} elseif ( is_home() && ( $pid = get_option( 'page_for_posts' ) ) ) {
		$url = get_permalink( $pid );
	} else {
		global $wp;
		$url = home_url( add_query_arg( array(), $wp->request ) );
	}
	return is_wp_error( $url ) ? home_url( '/' ) : $url;
}

/**
 * The best share image for the current view (featured → Customizer → logo).
 */
function voltalux_share_image() {
	$img = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$img = get_the_post_thumbnail_url( get_queried_object_id(), 'full' );
	}
	if ( ! $img ) {
		$img = voltalux_option( 'seo_share_image', '' );
	}
	if ( ! $img ) {
		$img = voltalux_option( 'logo_url', defined( 'VOLTALUX_DEFAULT_LOGO' ) ? VOLTALUX_DEFAULT_LOGO : '' );
	}
	return $img ? set_url_scheme( $img ) : '';
}

/**
 * Parse the multi-line address constant into structured parts.
 */
function voltalux_address_parts() {
	$raw   = voltalux_option( 'footer_address', defined( 'VOLTALUX_ADDRESS' ) ? VOLTALUX_ADDRESS : '' );
	$lines = array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $raw ) ) ) );
	$street = isset( $lines[0] ) ? $lines[0] : '';
	$pc     = '';
	$city   = '';
	if ( isset( $lines[1] ) && preg_match( '/^\s*(\d{4}\s?[A-Za-z]{2})\s+(.+)$/', $lines[1], $m ) ) {
		$pc   = strtoupper( str_replace( ' ', '', $m[1] ) );
		$pc   = substr( $pc, 0, 4 ) . ' ' . substr( $pc, 4 );
		$city = $m[2];
	} elseif ( isset( $lines[1] ) ) {
		$city = $lines[1];
	}
	return array( 'street' => $street, 'postal' => $pc, 'city' => $city );
}

/* -------------------------------------------------------------------------
 *  <head> meta output
 * ---------------------------------------------------------------------- */
function voltalux_seo_head() {
	if ( ! voltalux_seo_enabled() ) {
		return;
	}

	$desc  = voltalux_meta_description();
	$url   = voltalux_canonical_url();
	$image = voltalux_share_image();
	$name  = get_bloginfo( 'name' );
	$title = wp_get_document_title();

	$og_type = is_singular( 'post' ) ? 'article' : 'website';

	echo "\n<!-- Voltalux SEO -->\n";
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( $url ) {
		echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	}

	/* Open Graph */
	echo '<meta property="og:locale" content="nl_NL">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $name ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $desc ) {
		echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( $url ) {
		echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	}
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
		echo '<meta property="og:image:alt" content="' . esc_attr( $name ) . '">' . "\n";
	}
	if ( 'article' === $og_type ) {
		echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . "\n";
		echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( DATE_W3C ) ) . '">' . "\n";
	}

	/* Twitter */
	echo '<meta name="twitter:card" content="' . ( $image ? 'summary_large_image' : 'summary' ) . '">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $desc ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( $image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
	}

	/* JSON-LD graph */
	$graph = voltalux_seo_jsonld();
	if ( $graph ) {
		echo '<script type="application/ld+json">' . wp_json_encode( $graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}
	echo "<!-- /Voltalux SEO -->\n";
}
add_action( 'wp_head', 'voltalux_seo_head', 1 );

// Avoid a duplicate canonical — we output our own for every context.
function voltalux_seo_dedupe() {
	if ( voltalux_seo_enabled() ) {
		remove_action( 'wp_head', 'rel_canonical' );
	}
}
add_action( 'wp', 'voltalux_seo_dedupe' );

/* -------------------------------------------------------------------------
 *  JSON-LD structured data (Organization + WebSite + page context)
 * ---------------------------------------------------------------------- */
function voltalux_seo_jsonld() {
	$home    = home_url( '/' );
	$name    = get_bloginfo( 'name' );
	$logo    = voltalux_option( 'logo_url', defined( 'VOLTALUX_DEFAULT_LOGO' ) ? VOLTALUX_DEFAULT_LOGO : '' );
	$logo    = $logo ? set_url_scheme( $logo ) : '';
	$org_id  = $home . '#business';
	$site_id = $home . '#website';

	$addr = voltalux_address_parts();

	/* ---- LocalBusiness (the money node — can earn review stars) ---- */
	$business = array(
		'@type'    => apply_filters( 'voltalux_seo_business_type', array( 'LocalBusiness', 'HomeAndConstructionBusiness' ) ),
		'@id'      => $org_id,
		'name'     => $name,
		'url'      => $home,
		'description' => get_bloginfo( 'description' ),
	);
	if ( $logo ) {
		$business['logo']  = $logo;
		$business['image'] = $logo;
	}
	$phone = voltalux_option( 'phone', defined( 'VOLTALUX_PHONE' ) ? VOLTALUX_PHONE : '' );
	if ( $phone ) {
		$business['telephone'] = $phone;
	}
	$email = voltalux_option( 'footer_email', defined( 'VOLTALUX_EMAIL' ) ? VOLTALUX_EMAIL : '' );
	if ( $email ) {
		$business['email'] = $email;
	}
	if ( $addr['street'] || $addr['city'] ) {
		$business['address'] = array_filter(
			array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $addr['street'],
				'postalCode'      => $addr['postal'],
				'addressLocality' => $addr['city'],
				'addressCountry'  => 'NL',
			)
		);
	}
	$business['areaServed'] = array( '@type' => 'Country', 'name' => 'Nederland' );
	$business['priceRange']  = '€€';

	// sameAs — social profiles.
	$sameas = array();
	foreach ( array( 'instagram', 'facebook', 'linkedin', 'youtube' ) as $key ) {
		$v = voltalux_option( 'social_' . $key, '' );
		if ( $v ) {
			$sameas[] = $v;
		}
	}
	if ( $sameas ) {
		$business['sameAs'] = array_values( array_unique( $sameas ) );
	}

	// aggregateRating — real Google reviews (drives star rich results).
	$rating = voltalux_option( 'google_rating', defined( 'VOLTALUX_GOOGLE_RATING' ) ? VOLTALUX_GOOGLE_RATING : '' );
	$count  = voltalux_option( 'google_count', defined( 'VOLTALUX_GOOGLE_COUNT' ) ? VOLTALUX_GOOGLE_COUNT : '' );
	$rating_num = (float) str_replace( ',', '.', $rating );
	$count_num  = (int) preg_replace( '/[^0-9]/', '', $count );
	if ( apply_filters( 'voltalux_seo_aggregate_rating', true ) && $rating_num > 0 && $count_num > 0 ) {
		$business['aggregateRating'] = array(
			'@type'       => 'AggregateRating',
			'ratingValue' => $rating_num,
			'reviewCount' => $count_num,
			'bestRating'  => 5,
			'worstRating' => 1,
		);
	}

	/* ---- WebSite (sitelinks search box) ---- */
	$website = array(
		'@type'     => 'WebSite',
		'@id'       => $site_id,
		'url'       => $home,
		'name'      => $name,
		'publisher' => array( '@id' => $org_id ),
		'inLanguage' => 'nl-NL',
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => $home . '?s={search_term_string}',
			),
			'query-input' => 'required name=search_term_string',
		),
	);

	$graph = array( $business, $website );

	/* ---- Page-specific ---- */
	if ( is_singular( 'post' ) ) {
		$pid = get_queried_object_id();
		$graph[] = array(
			'@type'            => 'BlogPosting',
			'@id'              => get_permalink() . '#article',
			'mainEntityOfPage' => get_permalink(),
			'headline'         => wp_strip_all_tags( get_the_title() ),
			'description'      => voltalux_meta_description(),
			'datePublished'    => get_the_date( DATE_W3C ),
			'dateModified'     => get_the_modified_date( DATE_W3C ),
			'author'           => array( '@type' => 'Person', 'name' => get_the_author() ),
			'publisher'        => array( '@id' => $org_id ),
			'image'            => has_post_thumbnail( $pid ) ? get_the_post_thumbnail_url( $pid, 'full' ) : $logo,
			'inLanguage'       => 'nl-NL',
		);
		$graph[] = voltalux_seo_breadcrumbs();
	} elseif ( is_page() && ! is_front_page() ) {
		$graph[] = voltalux_seo_breadcrumbs();
	}

	$graph = array_values( array_filter( $graph ) );
	return array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);
}

/**
 * BreadcrumbList for the current page/post.
 */
function voltalux_seo_breadcrumbs() {
	$items = array();
	$pos   = 1;
	$items[] = array(
		'@type'    => 'ListItem',
		'position' => $pos++,
		'name'     => __( 'Home', 'voltalux' ),
		'item'     => home_url( '/' ),
	);

	if ( is_singular( 'post' ) ) {
		$blog_id = (int) get_option( 'page_for_posts' );
		if ( $blog_id ) {
			$items[] = array( '@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title( $blog_id ), 'item' => get_permalink( $blog_id ) );
		}
		$items[] = array( '@type' => 'ListItem', 'position' => $pos++, 'name' => wp_strip_all_tags( get_the_title() ) );
	} elseif ( is_page() ) {
		$ancestors = array_reverse( get_post_ancestors( get_queried_object_id() ) );
		foreach ( $ancestors as $aid ) {
			$items[] = array( '@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title( $aid ), 'item' => get_permalink( $aid ) );
		}
		$items[] = array( '@type' => 'ListItem', 'position' => $pos++, 'name' => wp_strip_all_tags( get_the_title() ) );
	}

	return array(
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);
}

/* -------------------------------------------------------------------------
 *  Small ranking boosters
 * ---------------------------------------------------------------------- */

// Let Google show large image previews / rich results.
function voltalux_seo_robots( $robots ) {
	$robots['max-image-preview'] = 'large';
	$robots['max-snippet']       = -1;
	$robots['max-video-preview']  = -1;
	return $robots;
}
add_filter( 'wp_robots', 'voltalux_seo_robots' );

// Preload the primary webfont so the largest text paints fast (Core Web Vitals).
function voltalux_seo_preload_assets() {
	echo '<link rel="preload" href="' . esc_url( VOLTALUX_URI . 'assets/fonts/manrope.woff2' ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
}
add_action( 'wp_head', 'voltalux_seo_preload_assets', 2 );

/* -------------------------------------------------------------------------
 *  Customizer — SEO & social
 * ---------------------------------------------------------------------- */
function voltalux_seo_customize( $wp_customize ) {
	$wp_customize->add_section(
		'voltalux_seo',
		array(
			'title'       => __( 'SEO & social', 'voltalux' ),
			'description' => __( 'Zoekmachine- en deelinstellingen. Deze worden automatisch uitgeschakeld als je een SEO-plugin (Yoast, Rank Math) gebruikt.', 'voltalux' ),
			'panel'       => 'voltalux_panel',
		)
	);
	voltalux_add_textarea_setting( $wp_customize, 'voltalux_seo_home_desc', '', __( 'Meta-omschrijving homepage', 'voltalux' ), 'voltalux_seo' );
	voltalux_add_url_setting( $wp_customize, 'voltalux_seo_share_image', '', __( 'Deelafbeelding (URL)', 'voltalux' ), __( 'Wordt getoond bij delen op social media (aanbevolen 1200×630).', 'voltalux' ), 'voltalux_seo' );
}
add_action( 'customize_register', 'voltalux_seo_customize', 20 );
