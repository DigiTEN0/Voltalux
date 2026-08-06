<?php
/**
 * Elementor compatibility.
 *
 * The theme is designed to be excellent with FREE Elementor (our own header /
 * footer + a full-width canvas template) and to gracefully hand header/footer
 * over to Elementor Pro's Theme Builder when the client uses it.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Theme Builder locations (used by Elementor Pro only).
 * With free Elementor these simply stay unused and the theme renders its own
 * header.php / footer.php.
 */
function voltalux_register_elementor_locations( $manager ) {
	$manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'voltalux_register_elementor_locations' );

/**
 * Does an Elementor Pro Theme Builder template exist for a location?
 *
 * @param string $location header|footer|single|archive
 * @return bool
 */
function voltalux_has_elementor_location( $location ) {
	if ( ! function_exists( 'elementor_theme_do_location' ) ) {
		return false;
	}
	if ( ! class_exists( '\ElementorPro\Modules\ThemeBuilder\Module' ) ) {
		return false;
	}
	$module    = \ElementorPro\Modules\ThemeBuilder\Module::instance();
	$conditions = $module->get_conditions_manager()->get_documents_for_location( $location );
	return ! empty( $conditions );
}

/**
 * Tell Elementor which parts of the layout the theme handles, so its
 * "Full Width" / "Canvas" page templates behave correctly.
 */
function voltalux_elementor_theme_support() {
	// Nothing required here for modern Elementor, but keep the hook for clarity.
}
add_action( 'elementor/loaded', 'voltalux_elementor_theme_support' );

/**
 * Push the Voltalux brand into Elementor's Global Colours & Fonts so anything
 * the client builds inherits the identity out of the box.
 *
 * Runs once, only if the active kit has not been customised by the user yet.
 */
function voltalux_seed_elementor_kit() {
	// Only seed from the admin side to avoid saving a document on front-end hits.
	if ( ! is_admin() ) {
		return;
	}
	if ( get_option( 'voltalux_kit_seeded' ) ) {
		return;
	}
	if ( ! did_action( 'elementor/loaded' ) || ! class_exists( '\Elementor\Plugin' ) ) {
		return;
	}

	$kit_id = get_option( 'elementor_active_kit' );
	if ( ! $kit_id ) {
		return;
	}
	$kit = \Elementor\Plugin::$instance->documents->get( $kit_id );
	if ( ! $kit ) {
		return;
	}

	$settings = $kit->get_settings();

	$accent = get_theme_mod( 'voltalux_accent', '#059a41' );

	$settings['system_colors'] = array(
		array( '_id' => 'primary',   'title' => 'Voltalux groen', 'color' => $accent ),
		array( '_id' => 'secondary', 'title' => 'Zwart',          'color' => '#0A0B0D' ),
		array( '_id' => 'text',      'title' => 'Tekst',          'color' => '#33373B' ),
		array( '_id' => 'accent',    'title' => 'Papier',         'color' => '#F5F5F1' ),
	);

	$settings['system_typography'] = array(
		array(
			'_id'                 => 'primary',
			'title'               => 'Koppen — Manrope',
			'typography_typography'  => 'custom',
			'typography_font_family' => 'Manrope',
			'typography_font_weight' => '800',
		),
		array(
			'_id'                 => 'secondary',
			'title'               => 'Subkoppen — Manrope',
			'typography_typography'  => 'custom',
			'typography_font_family' => 'Manrope',
			'typography_font_weight' => '700',
		),
		array(
			'_id'                 => 'text',
			'title'               => 'Tekst — Manrope',
			'typography_typography'  => 'custom',
			'typography_font_family' => 'Manrope',
			'typography_font_weight' => '400',
		),
		array(
			'_id'                 => 'accent',
			'title'               => 'Accent — Manrope',
			'typography_typography'  => 'custom',
			'typography_font_family' => 'Manrope',
			'typography_font_weight' => '600',
		),
	);

	$kit->save( array( 'settings' => $settings ) );
	update_option( 'voltalux_kit_seeded', 1 );
}
add_action( 'wp_loaded', 'voltalux_seed_elementor_kit', 20 );

/**
 * Register Manrope (the theme's self-hosted brand font) in the Elementor font
 * picker, so Elementor-built content matches the site with no Google CDN call.
 */
function voltalux_elementor_fonts( $additional_fonts ) {
	$additional_fonts['Manrope'] = 'system';
	return $additional_fonts;
}
add_filter( 'elementor/fonts/additional_fonts', 'voltalux_elementor_fonts' );
