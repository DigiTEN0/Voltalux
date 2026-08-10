<?php
/**
 * Editable page content.
 *
 * The service pillars render from structured data (inc/services-content.php) so
 * every page keeps its polished, consistent layout. That data is the *default*
 * only — this file lets the site owner override the headline and intro of any
 * page straight from the WordPress editor, and adds an editable body region so
 * the classic editor is never empty. Anything the owner types wins; anything
 * left blank falls back to the designed default.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return an owner-edited value for the current page, or the supplied default.
 *
 * @param string $key     Field key (without the _vlx_ prefix).
 * @param string $default Designed fallback value.
 * @param int    $post_id Optional post ID (defaults to current).
 * @return string
 */
function voltalux_editable( $key, $default = '', $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return $default;
	}
	$val = get_post_meta( $post_id, '_vlx_' . $key, true );
	return ( '' !== $val && null !== $val ) ? $val : $default;
}

/* -------------------------------------------------------------------------
 * Meta box: Voltalux — Pagina-inhoud
 * ---------------------------------------------------------------------- */

add_action(
	'add_meta_boxes',
	function () {
		add_meta_box(
			'voltalux_page_content',
			__( 'Voltalux — Pagina-inhoud', 'voltalux' ),
			'voltalux_page_content_metabox',
			'page',
			'normal',
			'high'
		);
	}
);

/**
 * Look up the designed defaults for a page (by slug), if it's a service pillar.
 *
 * @param WP_Post $post Post object.
 * @return array{h1:string,lead:string} Current designed headline + intro.
 */
function voltalux_page_designed_defaults( $post ) {
	$out = array( 'h1' => '', 'lead' => '' );
	if ( function_exists( 'voltalux_service' ) && $post instanceof WP_Post ) {
		$svc = voltalux_service( $post->post_name );
		if ( $svc ) {
			$out['h1']   = isset( $svc['h1'] ) ? $svc['h1'] : '';
			$out['lead'] = isset( $svc['lead'] ) ? $svc['lead'] : '';
		}
	}
	return $out;
}

/**
 * Render the meta box.
 *
 * @param WP_Post $post Current post.
 */
function voltalux_page_content_metabox( $post ) {
	wp_nonce_field( 'voltalux_page_content_save', 'voltalux_page_content_nonce' );

	$def   = voltalux_page_designed_defaults( $post );
	$h1    = get_post_meta( $post->ID, '_vlx_h1', true );
	$lead  = get_post_meta( $post->ID, '_vlx_lead', true );

	$h1_hint   = $def['h1'] ? $def['h1'] : __( 'Standaard: de paginatitel hierboven', 'voltalux' );
	$lead_hint = $def['lead'] ? $def['lead'] : __( 'Laat leeg voor de standaard intro', 'voltalux' );
	?>
	<p style="margin:.2em 0 1em;color:#646970;font-size:13px;">
		<?php esc_html_e( 'Pas hier de kop en introtekst van deze pagina aan. Laat een veld leeg om de standaardtekst te behouden. Extra tekst voeg je toe in de grote editor onderaan deze pagina.', 'voltalux' ); ?>
	</p>

	<p>
		<label for="vlx_h1" style="display:block;font-weight:600;margin-bottom:4px;">
			<?php esc_html_e( 'Kop (H1)', 'voltalux' ); ?>
		</label>
		<input type="text" id="vlx_h1" name="vlx_h1" class="widefat"
			value="<?php echo esc_attr( $h1 ); ?>"
			placeholder="<?php echo esc_attr( $h1_hint ); ?>">
	</p>

	<p>
		<label for="vlx_lead" style="display:block;font-weight:600;margin-bottom:4px;">
			<?php esc_html_e( 'Introtekst', 'voltalux' ); ?>
		</label>
		<textarea id="vlx_lead" name="vlx_lead" class="widefat" rows="4"
			placeholder="<?php echo esc_attr( $lead_hint ); ?>"><?php echo esc_textarea( $lead ); ?></textarea>
	</p>

	<?php if ( $def['lead'] ) : ?>
		<details style="margin-top:.4em;">
			<summary style="cursor:pointer;color:#2271b1;font-size:13px;"><?php esc_html_e( 'Toon de huidige introtekst', 'voltalux' ); ?></summary>
			<p style="background:#f6f7f7;border:1px solid #e0e0e0;border-radius:6px;padding:10px 12px;margin-top:8px;font-size:13px;color:#3c434a;line-height:1.6;">
				<?php echo esc_html( $def['lead'] ); ?>
			</p>
		</details>
	<?php endif; ?>
	<?php
}

/**
 * Save the meta box fields.
 *
 * @param int $post_id Post being saved.
 */
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

		$h1 = isset( $_POST['vlx_h1'] ) ? sanitize_text_field( wp_unslash( $_POST['vlx_h1'] ) ) : '';
		if ( '' !== $h1 ) {
			update_post_meta( $post_id, '_vlx_h1', $h1 );
		} else {
			delete_post_meta( $post_id, '_vlx_h1' );
		}

		$lead = isset( $_POST['vlx_lead'] ) ? sanitize_textarea_field( wp_unslash( $_POST['vlx_lead'] ) ) : '';
		if ( '' !== $lead ) {
			update_post_meta( $post_id, '_vlx_lead', $lead );
		} else {
			delete_post_meta( $post_id, '_vlx_lead' );
		}
	}
);
