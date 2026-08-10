<?php
/**
 * Editable Gutenberg blocks (self-contained — no plugin required).
 *
 * These "Voltalux" blocks are dynamic (server-rendered): each one calls the
 * exact same PHP renderer the page template uses, so the front-end markup —
 * and therefore the look and the SEO — is identical whether a section is coded
 * or edited in Gutenberg. The block editor merely exposes the text/image
 * fields so the site owner can change content visually.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Map stored block attributes onto the $sec data array the renderer expects.
 *
 * Text areas are stored as plain multi-line strings (one paragraph / list item
 * per line) — friendlier to edit than repeaters — and expanded here. Structured
 * data (compare columns, cards, price chips) is stored as JSON.
 *
 * @param array $a Block attributes.
 * @return array Section data for voltalux_render_service_section().
 */
function voltalux_block_attrs_to_section( $a ) {
	$lines = function ( $str ) {
		$out = array();
		foreach ( preg_split( '/\r\n|\r|\n/', (string) $str ) as $l ) {
			$l = trim( $l );
			if ( '' !== $l ) {
				$out[] = $l;
			}
		}
		return $out;
	};
	$json = function ( $str ) {
		$str = trim( (string) $str );
		if ( '' === $str ) {
			return array();
		}
		$data = json_decode( $str, true );
		return is_array( $data ) ? $data : array();
	};

	$sec = array(
		'type'    => ! empty( $a['type'] ) ? sanitize_key( $a['type'] ) : 'text',
		'eyebrow' => isset( $a['eyebrow'] ) ? $a['eyebrow'] : '',
		'title'   => isset( $a['title'] ) ? $a['title'] : '',
		'lead'    => isset( $a['lead'] ) ? $a['lead'] : '',
		'id'      => isset( $a['sid'] ) ? sanitize_title( $a['sid'] ) : '',
		'icon'    => isset( $a['icon'] ) ? sanitize_key( $a['icon'] ) : '',
		'cta'     => ! empty( $a['cta'] ),
	);
	if ( ! empty( $a['paras'] ) ) {
		$sec['paras'] = $lines( $a['paras'] );
	}
	if ( ! empty( $a['list'] ) ) {
		$sec['list'] = $lines( $a['list'] );
	}
	if ( ! empty( $a['cols'] ) ) {
		$sec['cols'] = $json( $a['cols'] );
	}
	if ( ! empty( $a['items'] ) ) {
		$sec['items'] = $json( $a['items'] );
	}
	if ( ! empty( $a['price'] ) ) {
		$sec['price'] = $json( $a['price'] );
	}
	if ( isset( $a['alt'] ) && '' !== $a['alt'] && null !== $a['alt'] ) {
		$sec['alt'] = (bool) $a['alt'];
	}
	return $sec;
}

/**
 * Render callback for voltalux/section — reuses the shared page renderer.
 *
 * @param array $attributes Block attributes.
 * @return string HTML.
 */
function voltalux_block_section_render( $attributes ) {
	$sec = voltalux_block_attrs_to_section( $attributes );
	ob_start();
	voltalux_render_service_section( $sec );
	return ob_get_clean();
}

/**
 * Register the editable Voltalux blocks + editor assets.
 */
function voltalux_register_editable_blocks() {
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	register_block_type(
		'voltalux/section',
		array(
			'api_version'     => 2,
			'title'           => __( 'Voltalux — Sectie', 'voltalux' ),
			'category'        => 'voltalux',
			'icon'            => 'layout',
			'description'     => __( 'Bewerkbare pagina-sectie (tekst, vergelijking, kaarten, accent-band).', 'voltalux' ),
			'render_callback' => 'voltalux_block_section_render',
			'supports'        => array( 'html' => false, 'reusable' => false ),
			'attributes'      => array(
				'type'    => array( 'type' => 'string', 'default' => 'text' ),
				'eyebrow' => array( 'type' => 'string', 'default' => '' ),
				'title'   => array( 'type' => 'string', 'default' => '' ),
				'lead'    => array( 'type' => 'string', 'default' => '' ),
				'paras'   => array( 'type' => 'string', 'default' => '' ),
				'list'    => array( 'type' => 'string', 'default' => '' ),
				'cols'    => array( 'type' => 'string', 'default' => '' ),
				'items'   => array( 'type' => 'string', 'default' => '' ),
				'price'   => array( 'type' => 'string', 'default' => '' ),
				'sid'     => array( 'type' => 'string', 'default' => '' ),
				'icon'    => array( 'type' => 'string', 'default' => '' ),
				'cta'     => array( 'type' => 'boolean', 'default' => false ),
				'alt'     => array( 'type' => 'string', 'default' => '' ),
			),
		)
	);
}
add_action( 'init', 'voltalux_register_editable_blocks' );

/**
 * A dedicated "Voltalux" block category so the blocks are easy to find.
 */
add_filter(
	'block_categories_all',
	function ( $categories ) {
		return array_merge(
			array(
				array(
					'slug'  => 'voltalux',
					'title' => __( 'Voltalux', 'voltalux' ),
					'icon'  => null,
				),
			),
			$categories
		);
	}
);

/**
 * Editor script + front-end brand styles inside the editor iframe.
 */
add_action(
	'enqueue_block_editor_assets',
	function () {
		wp_enqueue_script(
			'voltalux-blocks',
			VOLTALUX_URI . 'assets/js/blocks-editor.js',
			array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n', 'wp-server-side-render' ),
			VOLTALUX_VERSION,
			true
		);
	}
);

/* -------------------------------------------------------------------------
 * Seeding helper — turn service-data sections into editable block markup.
 * Used by inc/setup.php to pre-fill pages so they open as editable blocks
 * with the real content already in place.
 * ---------------------------------------------------------------------- */

/**
 * Build the block markup for one section (dynamic block → self-closing comment).
 *
 * @param array $sec   Section data from voltalux_service().
 * @param int   $index 1-based position (for the alternating background).
 * @return string Block comment markup.
 */
function voltalux_section_to_block_markup( $sec, $index ) {
	$type = isset( $sec['type'] ) ? $sec['type'] : 'text';
	$alt  = array_key_exists( 'alt', $sec ) ? (bool) $sec['alt'] : ( 1 === $index % 2 );
	if ( 'feature' === $type ) {
		$alt = false;
	}

	$attrs = array(
		'type'    => $type,
		'eyebrow' => isset( $sec['eyebrow'] ) ? $sec['eyebrow'] : '',
		'title'   => isset( $sec['title'] ) ? $sec['title'] : '',
		'lead'    => isset( $sec['lead'] ) ? $sec['lead'] : '',
		'paras'   => ! empty( $sec['paras'] ) ? implode( "\n", (array) $sec['paras'] ) : '',
		'list'    => ! empty( $sec['list'] ) ? implode( "\n", (array) $sec['list'] ) : '',
		'cols'    => ! empty( $sec['cols'] ) ? wp_json_encode( $sec['cols'] ) : '',
		'items'   => ! empty( $sec['items'] ) ? wp_json_encode( $sec['items'] ) : '',
		'price'   => ! empty( $sec['price'] ) ? wp_json_encode( $sec['price'] ) : '',
		'sid'     => isset( $sec['id'] ) ? $sec['id'] : '',
		'icon'    => isset( $sec['icon'] ) ? $sec['icon'] : '',
		'cta'     => ! empty( $sec['cta'] ),
		'alt'     => $alt ? '1' : '0',
	);
	// Drop empty strings/false to keep the markup lean.
	$attrs = array_filter(
		$attrs,
		function ( $v ) {
			return ! ( '' === $v || false === $v );
		}
	);

	return '<!-- wp:voltalux/section ' . wp_json_encode( $attrs ) . ' /-->';
}

/**
 * Build the full block content string for a service page's sections.
 *
 * @param string $slug Service slug.
 * @return string Block markup (empty if the service has no sections).
 */
function voltalux_service_sections_block_content( $slug ) {
	if ( ! function_exists( 'voltalux_service' ) ) {
		return '';
	}
	$svc = voltalux_service( $slug );
	if ( ! $svc || empty( $svc['sections'] ) ) {
		return '';
	}
	$out = array();
	$i   = 0;
	foreach ( $svc['sections'] as $sec ) {
		$i++;
		$out[] = voltalux_section_to_block_markup( $sec, $i );
	}
	return implode( "\n\n", $out );
}
