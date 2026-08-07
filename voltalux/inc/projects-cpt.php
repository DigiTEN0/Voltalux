<?php
/**
 * Projecten — a real, editable Custom Post Type.
 *
 * Adds a "Projecten" menu in wp-admin where the client manages projects with a
 * featured image + custom fields (plaats, systeem, situatie, citaat, resultaat,
 * categorie, link). The Projecten page, homepage strip and product-page strips
 * all read from here automatically. Until the client adds their own projects,
 * the built-in sample projects (inc/template-functions.php) are shown.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the "Projecten" post type + "Projectcategorie" taxonomy.
 */
function voltalux_register_projects_cpt() {
	register_post_type(
		'vlx_project',
		array(
			'labels'       => array(
				'name'               => __( 'Projecten', 'voltalux' ),
				'singular_name'      => __( 'Project', 'voltalux' ),
				'add_new'            => __( 'Nieuw project', 'voltalux' ),
				'add_new_item'       => __( 'Nieuw project toevoegen', 'voltalux' ),
				'edit_item'          => __( 'Project bewerken', 'voltalux' ),
				'new_item'           => __( 'Nieuw project', 'voltalux' ),
				'view_item'          => __( 'Project bekijken', 'voltalux' ),
				'search_items'       => __( 'Projecten zoeken', 'voltalux' ),
				'not_found'          => __( 'Geen projecten gevonden', 'voltalux' ),
				'menu_name'          => __( 'Projecten', 'voltalux' ),
				'all_items'          => __( 'Alle projecten', 'voltalux' ),
				'featured_image'     => __( 'Projectfoto', 'voltalux' ),
				'set_featured_image' => __( 'Projectfoto kiezen', 'voltalux' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'menu_icon'    => 'dashicons-portfolio',
			'menu_position' => 24,
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite'      => array( 'slug' => 'project', 'with_front' => false ),
			'show_in_rest' => true,
		)
	);

	register_taxonomy(
		'vlx_project_cat',
		'vlx_project',
		array(
			'labels'            => array(
				'name'          => __( 'Projectcategorieën', 'voltalux' ),
				'singular_name' => __( 'Projectcategorie', 'voltalux' ),
				'add_new_item'  => __( 'Nieuwe categorie', 'voltalux' ),
				'menu_name'     => __( 'Categorieën', 'voltalux' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'projectcategorie' ),
		)
	);
}
add_action( 'init', 'voltalux_register_projects_cpt' );

/**
 * Seed the default categories once, so the client has them ready to pick.
 */
function voltalux_seed_project_terms() {
	if ( get_option( 'voltalux_projterms_seeded' ) || ! taxonomy_exists( 'vlx_project_cat' ) ) {
		return;
	}
	foreach ( array( 'Thuisbatterij', 'Zonnepanelen', "Airco's", 'Dakrenovaties' ) as $name ) {
		if ( ! term_exists( $name, 'vlx_project_cat' ) ) {
			wp_insert_term( $name, 'vlx_project_cat' );
		}
	}
	update_option( 'voltalux_projterms_seeded', 1 );
}
add_action( 'admin_init', 'voltalux_seed_project_terms' );

/* -------------------------------------------------------------------------
 *  Meta box — project details
 * ---------------------------------------------------------------------- */
function voltalux_project_fields() {
	return array(
		'_vlx_plaats'    => __( 'Plaats', 'voltalux' ),
		'_vlx_systeem'   => __( 'Systeem (bijv. Sigenergy SigenStor, 24 kWh)', 'voltalux' ),
		'_vlx_situatie'  => __( 'Situatie (bijv. 14 panelen, warmtepomp, 3-fase)', 'voltalux' ),
		'_vlx_resultaat' => __( 'Resultaat (bijv. Zelfverbruik van 34% naar 79%)', 'voltalux' ),
		'_vlx_url'       => __( 'Externe link (optioneel)', 'voltalux' ),
		'_vlx_img_url'   => __( 'Afbeelding-URL (optioneel — gebruik liever de Projectfoto rechts)', 'voltalux' ),
	);
}

function voltalux_project_metabox() {
	add_meta_box( 'vlx_project_details', __( 'Projectdetails', 'voltalux' ), 'voltalux_project_metabox_render', 'vlx_project', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'voltalux_project_metabox' );

function voltalux_project_metabox_render( $post ) {
	wp_nonce_field( 'vlx_project_save', 'vlx_project_nonce' );
	echo '<style>.vlx-mb label{display:block;font-weight:600;margin:12px 0 4px}.vlx-mb input,.vlx-mb textarea{width:100%;padding:8px 10px}</style>';
	echo '<div class="vlx-mb">';
	foreach ( voltalux_project_fields() as $key => $label ) {
		$val = get_post_meta( $post->ID, $key, true );
		printf(
			'<label for="%1$s">%2$s</label><input type="text" id="%1$s" name="%1$s" value="%3$s">',
			esc_attr( $key ),
			esc_html( $label ),
			esc_attr( $val )
		);
	}
	$quote = get_post_meta( $post->ID, '_vlx_quote', true );
	printf(
		'<label for="_vlx_quote">%s</label><textarea id="_vlx_quote" name="_vlx_quote" rows="2">%s</textarea>',
		esc_html__( 'Citaat van de klant (optioneel)', 'voltalux' ),
		esc_textarea( $quote )
	);
	echo '</div>';
}

function voltalux_project_save( $post_id ) {
	if ( ! isset( $_POST['vlx_project_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['vlx_project_nonce'] ) ), 'vlx_project_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array_keys( voltalux_project_fields() ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
			if ( '_vlx_url' === $key || '_vlx_img_url' === $key ) {
				$value = esc_url_raw( $value );
			}
			update_post_meta( $post_id, $key, $value );
		}
	}
	if ( isset( $_POST['_vlx_quote'] ) ) {
		update_post_meta( $post_id, '_vlx_quote', sanitize_textarea_field( wp_unslash( $_POST['_vlx_quote'] ) ) );
	}
}
add_action( 'save_post_vlx_project', 'voltalux_project_save' );

/* -------------------------------------------------------------------------
 *  Read the CPT into the array shape the templates already expect.
 * ---------------------------------------------------------------------- */
function voltalux_get_cpt_projects() {
	if ( ! post_type_exists( 'vlx_project' ) ) {
		return array();
	}
	$q = new WP_Query(
		array(
			'post_type'           => 'vlx_project',
			'posts_per_page'      => 60,
			'post_status'         => 'publish',
			'orderby'             => 'menu_order date',
			'order'               => 'ASC',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	if ( ! $q->have_posts() ) {
		wp_reset_postdata();
		return array();
	}

	$out = array();
	while ( $q->have_posts() ) {
		$q->the_post();
		$id    = get_the_ID();
		$terms = get_the_terms( $id, 'vlx_project_cat' );
		$cat   = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : __( 'Project', 'voltalux' );
		$url   = get_post_meta( $id, '_vlx_url', true );

		$out[] = array(
			'cat'       => $cat,
			'title'     => get_the_title(),
			'location'  => get_post_meta( $id, '_vlx_plaats', true ),
			'url'       => $url, // Only an explicit external link; project cards are display-only otherwise.
			'icon'      => voltalux_project_icon_for( $cat ),
			'img'       => has_post_thumbnail( $id ) ? get_the_post_thumbnail_url( $id, 'large' ) : get_post_meta( $id, '_vlx_img_url', true ),
			'system'    => get_post_meta( $id, '_vlx_systeem', true ),
			'situation' => get_post_meta( $id, '_vlx_situatie', true ),
			'quote'     => get_post_meta( $id, '_vlx_quote', true ),
			'result'    => get_post_meta( $id, '_vlx_resultaat', true ),
		);
	}
	wp_reset_postdata();
	return $out;
}

/**
 * Pick a line icon based on the category name.
 *
 * @param string $cat
 * @return string
 */
function voltalux_project_icon_for( $cat ) {
	$c = strtolower( $cat );
	if ( false !== strpos( $c, 'batter' ) ) { return 'battery'; }
	if ( false !== strpos( $c, 'zonne' ) || false !== strpos( $c, 'solar' ) || false !== strpos( $c, 'paneel' ) ) { return 'sun'; }
	if ( false !== strpos( $c, 'airco' ) ) { return 'snow'; }
	if ( false !== strpos( $c, 'dak' ) ) { return 'roof'; }
	return 'spark';
}

/* -------------------------------------------------------------------------
 *  Seed the built-in sample projects as real, editable posts — once.
 *  After this, they live under Projecten in wp-admin and can be edited/
 *  deleted like any post. Skipped if the client already added projects.
 * ---------------------------------------------------------------------- */
function voltalux_seed_projects() {
	if ( get_option( 'voltalux_projects_seeded' ) ) {
		return;
	}
	if ( ! is_admin() || ! post_type_exists( 'vlx_project' ) || ! function_exists( 'voltalux_default_projects' ) ) {
		return;
	}
	if ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
		return;
	}

	// If the client already has projects, don't seed over them.
	$existing = get_posts( array( 'post_type' => 'vlx_project', 'posts_per_page' => 1, 'post_status' => 'any', 'fields' => 'ids' ) );
	if ( ! empty( $existing ) ) {
		update_option( 'voltalux_projects_seeded', 1 );
		return;
	}

	$order = 0;
	foreach ( voltalux_default_projects() as $p ) {
		$order += 10;
		$pid = wp_insert_post(
			array(
				'post_type'   => 'vlx_project',
				'post_status' => 'publish',
				'post_title'  => isset( $p['title'] ) ? $p['title'] : __( 'Project', 'voltalux' ),
				'menu_order'  => $order,
				'post_author' => get_current_user_id() ? get_current_user_id() : 1,
			)
		);
		if ( ! $pid || is_wp_error( $pid ) ) {
			continue;
		}
		if ( ! empty( $p['cat'] ) && taxonomy_exists( 'vlx_project_cat' ) ) {
			wp_set_object_terms( $pid, $p['cat'], 'vlx_project_cat', false );
		}
		$map = array(
			'_vlx_plaats'    => isset( $p['location'] ) ? $p['location'] : '',
			'_vlx_systeem'   => isset( $p['system'] ) ? $p['system'] : '',
			'_vlx_situatie'  => isset( $p['situation'] ) ? $p['situation'] : '',
			'_vlx_resultaat' => isset( $p['result'] ) ? $p['result'] : '',
			'_vlx_quote'     => isset( $p['quote'] ) ? $p['quote'] : '',
			'_vlx_url'       => isset( $p['url'] ) ? $p['url'] : '',
			'_vlx_img_url'   => isset( $p['img'] ) ? $p['img'] : '',
		);
		foreach ( $map as $k => $v ) {
			if ( '' !== $v ) {
				update_post_meta( $pid, $k, $v );
			}
		}
	}

	update_option( 'voltalux_projects_seeded', 1 );
}
add_action( 'admin_init', 'voltalux_seed_projects', 30 );
