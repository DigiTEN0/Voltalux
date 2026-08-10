<?php
/**
 * Editable page content — a full "edit everything" panel on the page screen.
 *
 * Service pages render from structured data (inc/services-content.php). This
 * file lets the site owner override EVERY text on the page straight from the
 * WordPress edit screen: it walks the service data and prints a field for each
 * text, stores the edits as one nested meta value, and merges those edits over
 * the defaults at render time. The page template renders from the merged data,
 * so the markup — the look and the SEO — stays identical; only the words change.
 *
 * Images are edited with the normal "Uitgelichte afbeelding" (featured image)
 * box on the same screen.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Keys that are structural (not editable copy) — never shown as fields. */
function voltalux_content_skip_keys() {
	return array( 'icon', 'id', 'type', 'nav', 'slug', 'url', 'alt', 'cta', 'kind', 'target', 'style', 'img', 'image' );
}

/**
 * Get the owner's saved content overrides for a page.
 *
 * @param int $post_id Post ID.
 * @return array Nested overrides (empty if none).
 */
function voltalux_content_overrides( $post_id ) {
	$ov = get_post_meta( $post_id, '_vlx_content', true );
	return is_array( $ov ) ? $ov : array();
}

/**
 * Service data for a page with the owner's text edits merged in.
 *
 * @param string $slug    Service slug.
 * @param int    $post_id Post ID.
 * @return array|null Merged service data (or null if not a service).
 */
function voltalux_service_merged( $slug, $post_id ) {
	if ( ! function_exists( 'voltalux_service' ) ) {
		return null;
	}
	$svc = voltalux_service( $slug );
	if ( ! $svc ) {
		return null;
	}
	$ov = voltalux_content_overrides( $post_id );
	if ( ! empty( $ov ) ) {
		$svc = array_replace_recursive( $svc, $ov );
	}
	return $svc;
}

/* -------------------------------------------------------------------------
 * Backwards-compatible scalar override helper (used by dienst.php fallback).
 * ---------------------------------------------------------------------- */
function voltalux_editable( $key, $default = '', $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return $default;
	}
	$ov = voltalux_content_overrides( $post_id );
	if ( isset( $ov[ $key ] ) && is_string( $ov[ $key ] ) && '' !== $ov[ $key ] ) {
		return $ov[ $key ];
	}
	$val = get_post_meta( $post_id, '_vlx_' . $key, true );
	return ( '' !== $val && null !== $val ) ? $val : $default;
}

/* -------------------------------------------------------------------------
 * Meta box
 * ---------------------------------------------------------------------- */

add_action(
	'add_meta_boxes',
	function () {
		$screen_slug = '';
		$post        = get_post();
		if ( $post ) {
			$screen_slug = get_page_template_slug( $post->ID );
		}
		// Only for service pillar pages (the data-driven template).
		if ( 'page-templates/dienst.php' !== $screen_slug ) {
			return;
		}
		add_meta_box(
			'voltalux_page_content',
			__( 'Voltalux — Pagina-inhoud (alle teksten)', 'voltalux' ),
			'voltalux_page_content_metabox',
			'page',
			'normal',
			'high'
		);
	}
);

/** Humanise a data key into a field label. */
function voltalux_content_label( $key ) {
	$map = array(
		'eyebrow' => __( 'Bovenkopje', 'voltalux' ),
		'h1'      => __( 'Titel (H1)', 'voltalux' ),
		'title'   => __( 'Kop', 'voltalux' ),
		'lead'    => __( 'Introtekst', 'voltalux' ),
		'text'    => __( 'Tekst', 'voltalux' ),
		'paras'   => __( 'Alinea’s', 'voltalux' ),
		'list'    => __( 'Opsomming', 'voltalux' ),
		'label'   => __( 'Label', 'voltalux' ),
		'name'    => __( 'Naam', 'voltalux' ),
		'tag'     => __( 'Subtitel', 'voltalux' ),
		'desc'    => __( 'Omschrijving', 'voltalux' ),
		'h'       => __( 'Kolomkop', 'voltalux' ),
		'k'       => __( 'Kenmerk', 'voltalux' ),
		'v'       => __( 'Waarde', 'voltalux' ),
		'u'       => __( 'Eenheid', 'voltalux' ),
		'l'       => __( 'Bijschrift', 'voltalux' ),
		'usps'    => __( 'USP’s', 'voltalux' ),
		'how'     => __( 'Hoe werkt het', 'voltalux' ),
		'steps'   => __( 'Stappen', 'voltalux' ),
		'sections' => __( 'Secties', 'voltalux' ),
		'cols'    => __( 'Kolommen', 'voltalux' ),
		'rows'    => __( 'Rijen', 'voltalux' ),
		'items'   => __( 'Onderdelen', 'voltalux' ),
		'links'   => __( 'Specialismen', 'voltalux' ),
		'brands'  => __( 'Merken', 'voltalux' ),
		'price'   => __( 'Prijzen', 'voltalux' ),
	);
	if ( isset( $map[ $key ] ) ) {
		return $map[ $key ];
	}
	if ( is_numeric( $key ) ) {
		return '#' . ( (int) $key + 1 );
	}
	return ucfirst( str_replace( array( '_', '-' ), ' ', (string) $key ) );
}

/**
 * Recursively print fields for every editable text leaf in $data.
 *
 * @param mixed  $data  Data node.
 * @param string $name  Field name path so far (e.g. vlx_content[usps][0]).
 * @param int    $depth Nesting depth (for indentation).
 */
function voltalux_content_fields( $data, $name, $depth = 0 ) {
	if ( ! is_array( $data ) ) {
		return;
	}
	$skip = voltalux_content_skip_keys();
	foreach ( $data as $key => $value ) {
		if ( in_array( $key, $skip, true ) ) {
			continue;
		}
		$field_name = $name . '[' . esc_attr( $key ) . ']';

		if ( is_array( $value ) ) {
			echo '<div style="margin:.6em 0 .6em ' . ( $depth ? '14px' : '0' ) . ';padding-left:' . ( $depth ? '12px' : '0' ) . ';' . ( $depth ? 'border-left:2px solid #e4e6e8;' : '' ) . '">';
			echo '<p style="margin:.2em 0;font-weight:600;color:#1d2327;">' . esc_html( voltalux_content_label( $key ) ) . '</p>';
			voltalux_content_fields( $value, $field_name, $depth + 1 );
			echo '</div>';
			continue;
		}
		if ( ! is_string( $value ) || is_bool( $value ) ) {
			continue;
		}

		$id        = 'vlx_' . substr( md5( $field_name ), 0, 10 );
		$multiline = ( strlen( $value ) > 70 ) || in_array( $key, array( 'lead', 'text', 'paras', 'desc' ), true );
		echo '<p style="margin:.35em 0;">';
		echo '<label for="' . esc_attr( $id ) . '" style="display:block;font-size:12px;color:#646970;margin-bottom:2px;">' . esc_html( voltalux_content_label( $key ) ) . '</label>';
		if ( $multiline ) {
			echo '<textarea id="' . esc_attr( $id ) . '" name="' . $field_name . '" rows="2" class="widefat">' . esc_textarea( $value ) . '</textarea>';
		} else {
			echo '<input type="text" id="' . esc_attr( $id ) . '" name="' . $field_name . '" value="' . esc_attr( $value ) . '" class="widefat">';
		}
		echo '</p>';
	}
}

/**
 * Render the meta box.
 *
 * @param WP_Post $post Current post.
 */
function voltalux_page_content_metabox( $post ) {
	wp_nonce_field( 'voltalux_page_content_save', 'voltalux_page_content_nonce' );

	$slug = $post->post_name;
	$svc  = voltalux_service_merged( $slug, $post->ID );
	if ( ! $svc ) {
		echo '<p>' . esc_html__( 'Deze pagina heeft geen bewerkbare service-inhoud.', 'voltalux' ) . '</p>';
		return;
	}
	?>
	<p style="margin:.2em 0 1em;color:#646970;font-size:13px;">
		<?php esc_html_e( 'Pas hier elke tekst van deze pagina aan. Wat je leeg laat, blijft de standaardtekst. De afbeelding bovenaan (hero) stel je in via “Uitgelichte afbeelding” rechts. Klik daarna op “Bijwerken”.', 'voltalux' ); ?>
	</p>
	<div style="max-height:640px;overflow:auto;padding-right:6px;border:1px solid #e0e0e0;border-radius:6px;padding:12px;">
		<?php voltalux_content_fields( $svc, 'vlx_content', 0 ); ?>
	</div>
	<?php
}

/**
 * Recursively sanitise the posted content array.
 *
 * @param mixed $data Raw posted node.
 * @return array|string Cleaned node.
 */
function voltalux_sanitize_content( $data ) {
	if ( is_array( $data ) ) {
		$out = array();
		foreach ( $data as $k => $v ) {
			$key         = is_numeric( $k ) ? (int) $k : sanitize_key( $k );
			$out[ $key ] = voltalux_sanitize_content( $v );
		}
		return $out;
	}
	// Preserve line breaks + [mark] shortcodes; strip tags.
	return sanitize_textarea_field( (string) $data );
}

add_action(
	'save_post_page',
	function ( $post_id ) {
		if ( ! isset( $_POST['voltalux_page_content_nonce'] )
			|| ! wp_verify_nonce( sanitize_key( $_POST['voltalux_page_content_nonce'] ), 'voltalux_page_content_save' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
		if ( empty( $_POST['vlx_content'] ) || ! is_array( $_POST['vlx_content'] ) ) {
			return;
		}
		$clean = voltalux_sanitize_content( wp_unslash( $_POST['vlx_content'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		update_post_meta( $post_id, '_vlx_content', $clean );
	}
);
