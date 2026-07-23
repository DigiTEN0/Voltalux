<?php
/**
 * Voltalux Customizer — everything the client can change without touching code.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register settings & controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function voltalux_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/* ------------------------------------------------------------------ *
	 *  PANEL: Voltalux
	 * ------------------------------------------------------------------ */
	$wp_customize->add_panel(
		'voltalux_panel',
		array(
			'title'    => __( 'Voltalux thema', 'voltalux' ),
			'priority' => 5,
		)
	);

	/* ---------- Section: Merk & kleuren ---------- */
	$wp_customize->add_section(
		'voltalux_brand',
		array(
			'title' => __( 'Merk & kleuren', 'voltalux' ),
			'panel' => 'voltalux_panel',
		)
	);

	$wp_customize->add_setting(
		'voltalux_accent',
		array(
			'default'           => '#15DD6E',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'voltalux_accent',
			array(
				'label'       => __( 'Accentkleur (groen)', 'voltalux' ),
				'description' => __( 'De signatuurkleur voor knoppen, highlights en accenten.', 'voltalux' ),
				'section'     => 'voltalux_brand',
			)
		)
	);

	voltalux_add_url_setting(
		$wp_customize,
		'voltalux_logo_url',
		VOLTALUX_DEFAULT_LOGO,
		__( 'Logo (URL)', 'voltalux' ),
		__( 'Standaard staat het Voltalux-logo hier al ingesteld. Vervang met een eigen afbeelding via Site-identiteit of plak hier een nieuwe media-URL.', 'voltalux' ),
		'voltalux_brand'
	);

	voltalux_add_url_setting(
		$wp_customize,
		'voltalux_logo_footer_url',
		VOLTALUX_DEFAULT_LOGO,
		__( 'Footer-logo (URL, optioneel)', 'voltalux' ),
		__( 'Laat leeg om hetzelfde logo te gebruiken. Handig als je een witte variant voor de donkere footer hebt.', 'voltalux' ),
		'voltalux_brand'
	);

	/* ---------- Section: Hero (homepage) ---------- */
	$wp_customize->add_section(
		'voltalux_hero',
		array(
			'title'       => __( 'Homepage hero', 'voltalux' ),
			'description' => __( 'De grote videobanner bovenaan de homepage. Deze sectie verschijnt zolang de homepage niet met Elementor is opgebouwd.', 'voltalux' ),
			'panel'       => 'voltalux_panel',
		)
	);

	voltalux_add_url_setting(
		$wp_customize,
		'voltalux_hero_video',
		VOLTALUX_DEFAULT_HERO_VIDEO,
		__( 'Achtergrond-video (MP4 URL)', 'voltalux' ),
		__( 'De Voltalux-bannervideo staat standaard ingesteld. Plak hier een andere MP4-URL om te wisselen.', 'voltalux' ),
		'voltalux_hero'
	);

	voltalux_add_url_setting(
		$wp_customize,
		'voltalux_hero_poster',
		'',
		__( 'Video-posterafbeelding (URL, optioneel)', 'voltalux' ),
		__( 'Wordt getoond terwijl de video laadt. Aanbevolen voor snelheid.', 'voltalux' ),
		'voltalux_hero'
	);

	voltalux_add_text_setting( $wp_customize, 'voltalux_hero_eyebrow', __( 'Zonnepanelen · Thuisbatterij · Airco · Dakrenovatie', 'voltalux' ), __( 'Klein label boven de titel', 'voltalux' ), 'voltalux_hero' );
	voltalux_add_textarea_setting( $wp_customize, 'voltalux_hero_title', __( 'Jouw partner in [mark]verduurzaming[/mark].', 'voltalux' ), __( 'Hero-titel. Zet [mark]tekst[/mark] rond een woord voor de groene markering.', 'voltalux' ), 'voltalux_hero' );
	voltalux_add_textarea_setting( $wp_customize, 'voltalux_hero_text', __( "Van zonnepanelen en thuisbatterijen tot airco's en dakrenovaties — wij verduurzamen je woning van A tot Z.", 'voltalux' ), __( 'Hero-tekst', 'voltalux' ), 'voltalux_hero' );

	voltalux_add_text_setting( $wp_customize, 'voltalux_hero_btn1_label', __( 'Offerte aanvragen', 'voltalux' ), __( 'Knop 1 — tekst', 'voltalux' ), 'voltalux_hero' );
	voltalux_add_url_setting( $wp_customize, 'voltalux_hero_btn1_url', '#contact', __( 'Knop 1 — link', 'voltalux' ), '', 'voltalux_hero' );
	voltalux_add_text_setting( $wp_customize, 'voltalux_hero_btn2_label', __( 'Bekijk batterijen', 'voltalux' ), __( 'Knop 2 — tekst (leeg = verbergen)', 'voltalux' ), 'voltalux_hero' );
	voltalux_add_url_setting( $wp_customize, 'voltalux_hero_btn2_url', '#producten', __( 'Knop 2 — link', 'voltalux' ), '', 'voltalux_hero' );

	voltalux_add_text_setting( $wp_customize, 'voltalux_hero_rating', __( '4.8 gemiddelde beoordeling', 'voltalux' ), __( 'Beoordelingstekst (leeg = verbergen)', 'voltalux' ), 'voltalux_hero' );

	/* ---------- Section: Topbalk & CTA ---------- */
	$wp_customize->add_section(
		'voltalux_header',
		array(
			'title' => __( 'Header & CTA', 'voltalux' ),
			'panel' => 'voltalux_panel',
		)
	);
	voltalux_add_text_setting( $wp_customize, 'voltalux_header_cta_label', __( 'Offerte aanvragen', 'voltalux' ), __( 'Groene knop in de header — tekst (leeg = verbergen)', 'voltalux' ), 'voltalux_header' );
	voltalux_add_url_setting( $wp_customize, 'voltalux_header_cta_url', '#contact', __( 'Groene knop in de header — link', 'voltalux' ), '', 'voltalux_header' );
	voltalux_add_text_setting( $wp_customize, 'voltalux_phone', VOLTALUX_PHONE, __( 'Telefoonnummer (optioneel)', 'voltalux' ), 'voltalux_header' );

	/* ---------- Section: Footer ---------- */
	$wp_customize->add_section(
		'voltalux_footer',
		array(
			'title' => __( 'Footer', 'voltalux' ),
			'panel' => 'voltalux_panel',
		)
	);
	voltalux_add_textarea_setting( $wp_customize, 'voltalux_footer_tagline', __( 'Samen naar een [mark]duurzamer[/mark] huis', 'voltalux' ), __( 'Grote slogan in de footer. Gebruik [mark]…[/mark] voor de groene markering.', 'voltalux' ), 'voltalux_footer' );
	voltalux_add_textarea_setting( $wp_customize, 'voltalux_footer_address', VOLTALUX_ADDRESS, __( 'Adres / contactblok', 'voltalux' ), 'voltalux_footer' );
	voltalux_add_text_setting( $wp_customize, 'voltalux_footer_email', VOLTALUX_EMAIL, __( 'E-mailadres', 'voltalux' ), 'voltalux_footer' );
	voltalux_add_text_setting( $wp_customize, 'voltalux_kvk', VOLTALUX_KVK, __( 'KvK-nummer', 'voltalux' ), 'voltalux_footer' );
	voltalux_add_text_setting( $wp_customize, 'voltalux_footer_copyright', '', __( 'Copyright-regel (leeg = automatisch)', 'voltalux' ), 'voltalux_footer' );

	// Social links (Instagram + Facebook prefilled with the real Voltalux profiles).
	$social_defaults = array( 'instagram' => VOLTALUX_IG, 'facebook' => VOLTALUX_FB, 'linkedin' => '', 'youtube' => '' );
	foreach ( array(
		'instagram' => 'Instagram',
		'facebook'  => 'Facebook',
		'linkedin'  => 'LinkedIn',
		'youtube'   => 'YouTube',
	) as $key => $label ) {
		voltalux_add_url_setting( $wp_customize, 'voltalux_social_' . $key, $social_defaults[ $key ], $label . ' URL', '', 'voltalux_footer' );
	}

	/* ---------- Section: Offerteformulier ---------- */
	$wp_customize->add_section(
		'voltalux_form',
		array(
			'title'       => __( 'Offerteformulier', 'voltalux' ),
			'description' => __( 'Het formulier in de offerte-sectie en de slide-in. Laat leeg voor het ingebouwde formulier, of plak een shortcode van Contact Form 7 / Elementor / WPForms om je eigen formulier te tonen.', 'voltalux' ),
			'panel'       => 'voltalux_panel',
		)
	);
	voltalux_add_textarea_setting( $wp_customize, 'voltalux_form_shortcode', '', __( 'Formulier-shortcode (optioneel)', 'voltalux' ), 'voltalux_form' );
	voltalux_add_url_setting( $wp_customize, 'voltalux_form_action', '', __( 'Formulier-action URL (ingebouwd formulier)', 'voltalux' ), __( 'Waar het ingebouwde formulier naartoe post. Leeg = alleen tonen.', 'voltalux' ), 'voltalux_form' );
}
add_action( 'customize_register', 'voltalux_customize_register' );

/* ---------- Tiny helpers to keep the registrations DRY ---------- */

function voltalux_add_text_setting( $wp, $id, $default, $label, $section ) {
	$wp->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp->add_control( $id, array( 'label' => $label, 'section' => $section, 'type' => 'text' ) );
}

function voltalux_add_textarea_setting( $wp, $id, $default, $label, $section ) {
	$wp->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh' ) );
	$wp->add_control( $id, array( 'label' => $label, 'section' => $section, 'type' => 'textarea' ) );
}

function voltalux_add_url_setting( $wp, $id, $default, $label, $description, $section ) {
	$wp->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ) );
	$wp->add_control( $id, array( 'label' => $label, 'description' => $description, 'section' => $section, 'type' => 'url' ) );
}

/**
 * Live-preview JS for postMessage settings.
 */
function voltalux_customize_preview_js() {
	wp_enqueue_script(
		'voltalux-customize-preview',
		VOLTALUX_URI . 'assets/js/customize-preview.js',
		array( 'customize-preview' ),
		VOLTALUX_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'voltalux_customize_preview_js' );
