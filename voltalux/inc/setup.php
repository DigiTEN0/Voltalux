<?php
/**
 * First-run site setup.
 *
 * On theme activation (and the first admin load) this creates every page from
 * the briefing's sitemap as a real, editable Page, assigns the matching page
 * template, sets Home as the static front page and Blog as the posts page, and
 * seeds the twenty blog topics as drafts so the client has a ready content
 * calendar. Guarded by options so it never runs twice or clobbers user changes.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Bump this when the page list changes so setup re-runs and re-flushes URLs. */
if ( ! defined( 'VOLTALUX_PAGES_VERSION' ) ) {
	define( 'VOLTALUX_PAGES_VERSION', 7 );
}

/**
 * Warn the admin when permalinks are set to "Plain" — pretty page URLs such as
 * /fox-ess/ cannot work until a real permalink structure is chosen.
 */
function voltalux_permalink_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( '' === get_option( 'permalink_structure' ) ) {
		echo '<div class="notice notice-warning"><p><strong>Voltalux:</strong> '
			. wp_kses_post( sprintf(
				/* translators: %s: link to the Permalinks settings screen. */
				__( 'Zet je permalinks op bijvoorbeeld &laquo;Berichtnaam&raquo; via %s. Anders geven de product- en informatiepagina&rsquo;s (zoals /fox-ess/) een 404.', 'voltalux' ),
				'<a href="' . esc_url( admin_url( 'options-permalink.php' ) ) . '">' . esc_html__( 'Instellingen &rarr; Permalinks', 'voltalux' ) . '</a>'
			) )
			. '</p></div>';
	}
}
add_action( 'admin_notices', 'voltalux_permalink_notice' );

/**
 * The pages to create: slug => array( title, page-template (relative), parent-slug ).
 *
 * @return array
 */
function voltalux_setup_pages() {
	return array(
		'home'            => array( __( 'Home', 'voltalux' ), '', '' ),
		// Service pillars (real client structure, data-driven via page-templates/dienst.php).
		// Slugs match the LIVE voltalux.nl URLs exactly — never rename these, it breaks SEO.
		'zonnepanelen'    => array( __( 'Zonnepanelen', 'voltalux' ), 'page-templates/dienst.php', '' ),
		'thuisbatterij'   => array( __( 'Thuisbatterij', 'voltalux' ), 'page-templates/overzicht-batterijen.php', '' ),
		'fox-ess'         => array( 'Fox ESS', 'page-templates/product-detail.php', '' ),
		'alphaess'        => array( 'AlphaESS', 'page-templates/product-detail.php', '' ),
		'sigenergy'       => array( 'Sigenergy SigenStor', 'page-templates/product-detail.php', '' ),
		'aircos'          => array( "Airco's", 'page-templates/overzicht-airco.php', '' ),
		'daikin'          => array( 'Daikin', 'page-templates/product-detail.php', '' ),
		'lg'              => array( 'LG', 'page-templates/product-detail.php', '' ),
		'warmtepompen'    => array( __( 'Warmtepompen', 'voltalux' ), 'page-templates/dienst.php', '' ),
		'dakdekker'       => array( __( 'Dakrenovatie', 'voltalux' ), 'page-templates/dienst.php', '' ),
		'zakelijk'        => array( __( 'Zakelijk', 'voltalux' ), 'page-templates/zakelijk.php', '' ),
		'werkwijze'       => array( __( 'Werkwijze', 'voltalux' ), 'page-templates/werkwijze.php', '' ),
		'onze-projecten'  => array( __( 'Projecten', 'voltalux' ), 'page-templates/projecten.php', '' ),
		'over-ons'        => array( __( 'Over ons', 'voltalux' ), '', '' ),
		'contact'         => array( __( 'Contact', 'voltalux' ), '', '' ),
		'veelgestelde-vragen' => array( __( 'Veelgestelde vragen', 'voltalux' ), '', '' ),
		'blog'            => array( __( 'Blog', 'voltalux' ), '', '' ),
	);
}

/**
 * Create the core pages, assign templates and configure reading settings — once.
 */
function voltalux_first_run_setup() {

	// Version-based guard: re-runs (idempotently) whenever the page set changes,
	// so uploading a new theme version creates any missing pages and re-flushes
	// the URL rules. Bump VOLTALUX_PAGES_VERSION when the page list changes.
	if ( (int) get_option( 'voltalux_pages_v', 0 ) >= VOLTALUX_PAGES_VERSION ) {
		return;
	}
	if ( ! function_exists( 'wp_insert_post' ) || ! function_exists( 'get_page_by_path' ) ) {
		return;
	}
	if ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
		return;
	}

	$ids = array();
	foreach ( voltalux_setup_pages() as $slug => $def ) {
		list( $title, $template, $parent ) = $def;

		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$id = (int) $existing->ID;
			// Only add a template if the page has none yet (never overwrite the client).
			if ( $template && ! get_post_meta( $id, '_wp_page_template', true ) ) {
				update_post_meta( $id, '_wp_page_template', $template );
			}
			$ids[ $slug ] = $id;
			continue;
		}

		$new_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
				'post_parent'  => ( $parent && isset( $ids[ $parent ] ) ) ? $ids[ $parent ] : 0,
				'post_author'  => get_current_user_id() ? get_current_user_id() : 1,
			)
		);
		if ( $new_id && ! is_wp_error( $new_id ) ) {
			$ids[ $slug ] = (int) $new_id;
			if ( $template ) {
				update_post_meta( $new_id, '_wp_page_template', $template );
			}
		}
	}

	// Static front page = Home; posts page = Blog (only if not already configured).
	if ( ! empty( $ids['home'] ) && (int) get_option( 'page_on_front' ) < 1 ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}
	if ( ! empty( $ids['blog'] ) && (int) get_option( 'page_for_posts' ) < 1 ) {
		update_option( 'page_for_posts', $ids['blog'] );
	}

	// SEO-friendly URLs: if the site is still on "Plain" permalinks (?page_id=…),
	// switch to /%postname%/ so pages get clean URLs like /thuisbatterijen/.
	// Only when Plain — we never overwrite a structure the site already chose.
	if ( '' === get_option( 'permalink_structure' ) ) {
		global $wp_rewrite;
		update_option( 'permalink_structure', '/%postname%/' );
		if ( isset( $wp_rewrite ) && is_object( $wp_rewrite ) ) {
			$wp_rewrite->set_permalink_structure( '/%postname%/' );
		}
	}

	update_option( 'voltalux_pages_v', VOLTALUX_PAGES_VERSION );
	update_option( 'voltalux_pages_v2', 1 );
	update_option( 'voltalux_setup_complete', 1 );

	// Refresh permalink/rewrite rules so the freshly created page URLs
	// (/thuisbatterijen/, /fox-ess/, …) resolve instead of 404-ing.
	if ( function_exists( 'flush_rewrite_rules' ) ) {
		flush_rewrite_rules( false );
	}
}
add_action( 'after_switch_theme', 'voltalux_first_run_setup' );
add_action( 'admin_init', 'voltalux_first_run_setup' );
// Also run on the front-end: if the very first visit is a page URL (before any
// admin login), this creates the pages + flushes rules so it self-heals. Guarded
// by the version option, so the body runs only once.
add_action( 'wp_loaded', 'voltalux_first_run_setup' );

/**
 * Seed the twenty blog topics as drafts — a ready content calendar. Runs once.
 */
function voltalux_seed_blog_drafts() {
	if ( get_option( 'voltalux_blog_seeded' ) ) {
		return;
	}
	if ( ! function_exists( 'wp_insert_post' ) || ! function_exists( 'voltalux_blog_topics' ) ) {
		return;
	}
	if ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
		return;
	}
	// Only seed in a real admin context.
	if ( ! is_admin() ) {
		return;
	}

	foreach ( voltalux_blog_topics() as $t ) {
		$slug = sanitize_title( $t['title'] );
		if ( get_page_by_path( $slug, OBJECT, 'post' ) ) {
			continue;
		}
		$prio = ! empty( $t['p'] ) ? __( 'Prioriteit: publiceer als eerste.', 'voltalux' ) : '';
		$body = sprintf(
			"<!-- wp:paragraph --><p><strong>%s</strong> %s</p><!-- /wp:paragraph -->\n\n" .
			"<!-- wp:paragraph --><p><em>%s ± %d %s. %s</em></p><!-- /wp:paragraph -->\n\n" .
			"<!-- wp:paragraph --><p>%s</p><!-- /wp:paragraph -->",
			esc_html__( 'Onderwerp:', 'voltalux' ),
			esc_html( $t['kern'] ),
			esc_html__( 'Richtlengte:', 'voltalux' ),
			(int) $t['words'],
			esc_html__( 'woorden', 'voltalux' ),
			esc_html( $prio ),
			esc_html__( 'Sluit af met dezelfde call-to-action en een link naar de bijbehorende productpagina.', 'voltalux' )
		);

		// Assign the matching theme category (created on the fly if needed).
		$cat_ids = array();
		if ( function_exists( 'voltalux_blog_theme' ) ) {
			$cat_name = voltalux_blog_theme( $t['n'] );
			$term     = term_exists( $cat_name, 'category' );
			if ( ! $term ) {
				$term = wp_insert_term( $cat_name, 'category' );
			}
			if ( ! is_wp_error( $term ) && ! empty( $term['term_id'] ) ) {
				$cat_ids[] = (int) $term['term_id'];
			}
		}

		wp_insert_post(
			array(
				'post_title'    => $t['title'],
				'post_name'     => $slug,
				'post_status'   => 'draft',
				'post_type'     => 'post',
				'post_content'  => $body,
				'post_category' => $cat_ids,
				'post_author'   => get_current_user_id() ? get_current_user_id() : 1,
			)
		);
	}

	update_option( 'voltalux_blog_seeded', 1 );
}
add_action( 'admin_init', 'voltalux_seed_blog_drafts', 20 );
