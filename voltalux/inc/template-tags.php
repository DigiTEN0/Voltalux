<?php
/**
 * Reusable template tags / output helpers.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Signature diagonal arrow (↗).
 */
function voltalux_arrow_svg() {
	return '<svg viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false"><path d="M4.5 11.5L11.5 4.5M11.5 4.5H5.5M11.5 4.5V10.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

/**
 * Inline icon set.
 *
 * @param string $name check|plus|close|phone|chevron
 * @return string
 */
function voltalux_icon( $name ) {
	$icons = array(
		'check'   => '<path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>',
		'plus'    => '<path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>',
		'close'   => '<path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>',
		'phone'   => '<path d="M6.6 10.8a15.5 15.5 0 006.6 6.6l2.2-2.2a1 1 0 011-.24c1.1.37 2.3.57 3.5.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.2.2 2.4.57 3.5a1 1 0 01-.24 1L6.6 10.8z" fill="currentColor"/>',
		'chevron' => '<path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
	);
	$body = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
	return '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">' . $body . '</svg>';
}

/**
 * Voltalux button.
 *
 * @param array $args label, url, style (primary|dark|light|ghost), arrow, size (md|lg), class, attrs
 * @param bool  $echo
 * @return string
 */
function voltalux_button( $args = array(), $echo = true ) {
	$args = wp_parse_args(
		$args,
		array(
			'label' => __( 'Meer informatie', 'voltalux' ),
			'url'   => '#',
			'style' => 'dark',
			'arrow' => true,
			'size'  => 'md',
			'class' => '',
			'attrs' => array(),
		)
	);

	// Back-compat aliases.
	$map   = array( 'green' => 'primary', 'white' => 'light' );
	$style = isset( $map[ $args['style'] ] ) ? $map[ $args['style'] ] : $args['style'];

	$classes = array( 'vlx-btn', 'vlx-btn--' . $style );
	if ( 'lg' === $args['size'] ) {
		$classes[] = 'vlx-btn--lg';
	}
	if ( $args['class'] ) {
		$classes[] = $args['class'];
	}

	$attr = '';
	foreach ( $args['attrs'] as $k => $v ) {
		$attr .= ' ' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
	}

	$html = sprintf(
		'<a class="%1$s" href="%2$s"%3$s>%4$s%5$s</a>',
		esc_attr( implode( ' ', $classes ) ),
		esc_url( $args['url'] ),
		$attr,
		esc_html( $args['label'] ),
		$args['arrow'] ? ' ' . voltalux_arrow_svg() : ''
	);

	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	return $html;
}

/**
 * Mono eyebrow label with hairline.
 */
function voltalux_eyebrow( $text, $inv = false, $echo = true ) {
	$html = '<span class="vlx-eyebrow' . ( $inv ? ' vlx-eyebrow--inv' : '' ) . '">' . esc_html( $text ) . '</span>';
	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	return $html;
}

/**
 * Site branding (logo). Falls back to the hard-coded Voltalux logo, which the
 * client can replace under Appearance > Customize.
 */
function voltalux_branding( $context = 'header' ) {
	$home = esc_url( home_url( '/' ) );
	$name = get_bloginfo( 'name' );

	if ( 'header' === $context && has_custom_logo() ) {
		echo '<span class="vlx-brand">';
		the_custom_logo();
		echo '</span>';
		return;
	}

	$logo = ( 'footer' === $context )
		? voltalux_option( 'logo_footer_url', voltalux_option( 'logo_url', VOLTALUX_DEFAULT_LOGO ) )
		: voltalux_option( 'logo_url', VOLTALUX_DEFAULT_LOGO );

	printf(
		'<a class="vlx-brand%1$s" href="%2$s" rel="home"><img src="%3$s" alt="%4$s" width="150" height="34"%5$s decoding="async"></a>',
		'footer' === $context ? ' vlx-brand--footer' : '',
		$home,
		esc_url( $logo ),
		esc_attr( $name ),
		'header' === $context ? ' fetchpriority="high"' : ' loading="lazy"'
	);
}

/**
 * Featured image (or on-brand placeholder) for article cards.
 */
function voltalux_post_thumbnail( $size = 'large' ) {
	if ( post_password_required() || is_attachment() ) {
		return;
	}
	if ( has_post_thumbnail() ) {
		printf(
			'<a class="vlx-card__media" href="%1$s" aria-hidden="true" tabindex="-1">%2$s</a>',
			esc_url( get_permalink() ),
			get_the_post_thumbnail( null, $size, array( 'loading' => 'lazy', 'alt' => the_title_attribute( array( 'echo' => false ) ) ) )
		);
	} else {
		printf(
			'<a class="vlx-card__media vlx-card__media--ph" href="%1$s" aria-hidden="true" tabindex="-1">%2$s</a>',
			esc_url( get_permalink() ),
			voltalux_icon( 'plus' )
		);
	}
}

/**
 * Post meta (date · reading time), mono styled.
 */
function voltalux_posted_on() {
	printf(
		'<time datetime="%1$s">%2$s</time><span aria-hidden="true">·</span><span>%3$s</span>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date( 'j M Y' ) ),
		esc_html( voltalux_reading_time() )
	);
}

/**
 * First category as a tag pill.
 */
function voltalux_post_categories() {
	$cats = get_the_category();
	if ( ! empty( $cats ) ) {
		echo '<span class="vlx-tag">' . esc_html( $cats[0]->name ) . '</span>';
	}
}

/**
 * Social icon links (from the Customizer). Renders nothing if none set.
 *
 * @param string $wrap_class Wrapper class.
 */
function voltalux_social_icons( $wrap_class = 'vlx-footer-social' ) {
	$socials = array(
		'instagram' => array( 'Instagram', 'M12 2.2c3.2 0 3.6 0 4.9.07 1.2.06 1.8.26 2.2.43.6.2 1 .5 1.4 1 .4.4.7.8 1 1.4.2.4.4 1 .43 2.2.06 1.3.07 1.7.07 4.9s0 3.6-.07 4.9c-.03 1.2-.23 1.8-.43 2.2-.2.6-.5 1-1 1.4-.4.4-.8.7-1.4 1-.4.2-1 .4-2.2.43-1.3.06-1.7.07-4.9.07s-3.6 0-4.9-.07c-1.2-.03-1.8-.23-2.2-.43-.6-.2-1-.5-1.4-1-.4-.4-.7-.8-1-1.4-.2-.4-.4-1-.43-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.07-4.9c.03-1.2.23-1.8.43-2.2.2-.6.5-1 1-1.4.4-.4.8-.7 1.4-1 .4-.2 1-.4 2.2-.43C8.4 2.2 8.8 2.2 12 2.2m0 1.6c-3.1 0-3.5 0-4.7.07-.9 0-1.4.2-1.7.3-.4.2-.7.4-1 .7-.3.3-.5.6-.7 1-.1.3-.3.8-.3 1.7C3.8 8.5 3.8 8.9 3.8 12s0 3.5.07 4.7c0 .9.2 1.4.3 1.7.2.4.4.7.7 1 .3.3.6.5 1 .7.3.1.8.3 1.7.3 1.2.07 1.6.07 4.7.07s3.5 0 4.7-.07c.9 0 1.4-.2 1.7-.3.4-.2.7-.4 1-.7.3-.3.5-.6.7-1 .1-.3.3-.8.3-1.7.07-1.2.07-1.6.07-4.7s0-3.5-.07-4.7c0-.9-.2-1.4-.3-1.7-.2-.4-.4-.7-.7-1-.3-.3-.6-.5-1-.7-.3-.1-.8-.3-1.7-.3-1.2-.07-1.6-.07-4.7-.07m0 2.8a5.4 5.4 0 110 10.8 5.4 5.4 0 010-10.8m0 1.9a3.5 3.5 0 100 7 3.5 3.5 0 000-7m5.6-.3a1.26 1.26 0 11-2.52 0 1.26 1.26 0 012.52 0z' ),
		'facebook'  => array( 'Facebook', 'M14 8.5V7c0-.8.2-1.2 1.3-1.2H17V3.1c-.3 0-1.3-.1-2.4-.1-2.4 0-4 1.4-4 4.1v1.4H8v2.9h2.6V21H14v-9.6h2.5l.4-2.9H14z' ),
		'linkedin'  => array( 'LinkedIn', 'M6.9 8.5H3.9V21h3V8.5zM5.4 3a1.8 1.8 0 100 3.5 1.8 1.8 0 000-3.5zM21 21h-3v-6.1c0-1.5-.5-2.5-1.8-2.5-1 0-1.6.7-1.9 1.4-.1.2-.1.5-.1.9V21h-3s.04-10.9 0-12h3v1.7c.4-.6 1.1-1.5 2.8-1.5 2 0 3.6 1.3 3.6 4.2V21z' ),
		'youtube'   => array( 'YouTube', 'M21.6 7.2s-.2-1.4-.8-2c-.8-.8-1.6-.8-2-.9C16 4 12 4 12 4s-4 0-6.8.3c-.4.1-1.2.1-2 .9-.6.6-.8 2-.8 2S2.2 8.8 2.2 10.5v1.6c0 1.6.2 3.3.2 3.3s.2 1.4.8 2c.8.8 1.8.8 2.3.9 1.6.2 6.5.3 6.5.3s4 0 6.8-.3c.4-.1 1.2-.1 2-.9.6-.6.8-2 .8-2s.2-1.6.2-3.3v-1.6c0-1.6-.2-3.3-.2-3.3zM9.9 14.6V8.9l5.2 2.9-5.2 2.8z' ),
	);

	$out = '';
	foreach ( $socials as $key => $data ) {
		$url = voltalux_option( 'social_' . $key, '' );
		if ( ! $url ) {
			continue;
		}
		$out .= sprintf(
			'<a href="%1$s" aria-label="%2$s" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="%3$s"/></svg></a>',
			esc_url( $url ),
			esc_attr( $data[0] ),
			esc_attr( $data[1] )
		);
	}

	if ( $out ) {
		echo '<div class="' . esc_attr( $wrap_class ) . '">' . $out . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Single-post footer meta (tags + edit link).
 */
function voltalux_entry_footer() {
	if ( 'post' === get_post_type() ) {
		$tags = get_the_tag_list( '<ul class="vlx-tags"><li>', '</li><li>', '</li></ul>' );
		if ( $tags ) {
			echo '<div class="vlx-entry-tags">' . wp_kses_post( $tags ) . '</div>';
		}
	}
	edit_post_link( __( 'Bewerk', 'voltalux' ), '<span class="vlx-edit-link">', '</span>' );
}
