<?php
/**
 * First-run site setup.
 *
 * Creates the core WordPress Pages (so everything is a real, editable Page that
 * also opens in Elementor), sets a static front page ("Home") and a posts page
 * ("Blog"). Runs once, guarded by an option, on theme activation and on the
 * first admin load after the theme is installed.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create the core pages and configure the reading settings — once.
 */
function voltalux_first_run_setup() {

	if ( get_option( 'voltalux_setup_complete' ) ) {
		return;
	}
	// Only in a normal admin/activation context with the APIs available.
	if ( ! function_exists( 'wp_insert_post' ) || ! function_exists( 'get_page_by_path' ) ) {
		return;
	}
	if ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
		return;
	}

	/* slug => title (order matters for the Pages list) */
	$pages = array(
		'home'      => __( 'Home', 'voltalux' ),
		'diensten'  => __( 'Diensten', 'voltalux' ),
		'producten' => __( 'Producten', 'voltalux' ),
		'projecten' => __( 'Projecten', 'voltalux' ),
		'werkwijze' => __( 'Werkwijze', 'voltalux' ),
		'reviews'   => __( 'Reviews', 'voltalux' ),
		'over-ons'  => __( 'Over ons', 'voltalux' ),
		'contact'   => __( 'Contact', 'voltalux' ),
		'blog'      => __( 'Blog', 'voltalux' ),
	);

	$ids = array();
	foreach ( $pages as $slug => $title ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$ids[ $slug ] = (int) $existing->ID;
			continue;
		}
		$new_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
				'post_author'  => get_current_user_id() ? get_current_user_id() : 1,
			)
		);
		if ( $new_id && ! is_wp_error( $new_id ) ) {
			$ids[ $slug ] = (int) $new_id;
		}
	}

	// Static front page = Home (only if the site hasn't already got one set).
	if ( ! empty( $ids['home'] ) && (int) get_option( 'page_on_front' ) < 1 ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}
	// Posts page = Blog.
	if ( ! empty( $ids['blog'] ) && (int) get_option( 'page_for_posts' ) < 1 ) {
		update_option( 'page_for_posts', $ids['blog'] );
	}

	update_option( 'voltalux_setup_complete', 1 );
}
add_action( 'after_switch_theme', 'voltalux_first_run_setup' );
add_action( 'admin_init', 'voltalux_first_run_setup' );
