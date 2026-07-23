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
 * The signature diagonal arrow (↗) used on Voltalux buttons and links.
 *
 * @return string SVG markup.
 */
function voltalux_arrow_svg() {
	return '<svg class="vlx-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false"><path d="M4.5 11.5L11.5 4.5M11.5 4.5H5.5M11.5 4.5V10.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

/**
 * Render a Voltalux pill button.
 *
 * @param array $args {
 *     @type string $label   Button text.
 *     @type string $url     Destination.
 *     @type string $style   dark | green | ghost | white. Default dark.
 *     @type bool   $arrow   Show the ↗ arrow. Default true.
 *     @type string $size    md | lg. Default md.
 *     @type string $class   Extra classes.
 *     @type array  $attrs   Extra HTML attributes (key => value).
 * }
 * @param bool  $echo Echo or return.
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

	$classes = array( 'vlx-btn', 'vlx-btn--' . $args['style'] );
	if ( 'lg' === $args['size'] ) {
		$classes[] = 'vlx-btn--lg';
	}
	if ( $args['class'] ) {
		$classes[] = $args['class'];
	}

	$attr_html = '';
	foreach ( $args['attrs'] as $k => $v ) {
		$attr_html .= ' ' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
	}

	$html = sprintf(
		'<a class="%1$s" href="%2$s"%3$s><span>%4$s</span>%5$s</a>',
		esc_attr( implode( ' ', $classes ) ),
		esc_url( $args['url'] ),
		$attr_html,
		esc_html( $args['label'] ),
		$args['arrow'] ? voltalux_arrow_svg() : ''
	);

	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from escaped parts.
	}
	return $html;
}

/**
 * Small eyebrow label with a green dot (used above headings).
 *
 * @param string $text  Label.
 * @param bool   $echo  Echo or return.
 * @return string
 */
function voltalux_eyebrow( $text, $echo = true ) {
	$html = '<span class="vlx-eyebrow"><span class="vlx-eyebrow__dot" aria-hidden="true"></span>' . esc_html( $text ) . '</span>';
	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	return $html;
}

/**
 * Featured image with a graceful, on-brand fallback.
 *
 * @param string $size Image size.
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
			'<a class="vlx-card__media vlx-card__media--placeholder" href="%1$s" aria-hidden="true" tabindex="-1"><span>Voltalux</span></a>',
			esc_url( get_permalink() )
		);
	}
}

/**
 * Post meta line: date + reading time.
 */
function voltalux_posted_on() {
	printf(
		'<span class="vlx-meta__date"><time datetime="%1$s">%2$s</time></span><span class="vlx-meta__sep" aria-hidden="true">•</span><span class="vlx-meta__read">%3$s</span>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_html( voltalux_reading_time() )
	);
}

/**
 * Category pills for a post.
 */
function voltalux_post_categories() {
	$cats = get_the_category();
	if ( empty( $cats ) ) {
		return;
	}
	echo '<span class="vlx-tag">' . esc_html( $cats[0]->name ) . '</span>';
}

/**
 * Footer entry meta for single posts (tags + edit link).
 */
function voltalux_entry_footer() {
	if ( 'post' === get_post_type() ) {
		$tags = get_the_tag_list( '<ul class="vlx-tags"><li>', '</li><li>', '</li></ul>' );
		if ( $tags ) {
			echo '<div class="vlx-entry-tags">' . wp_kses_post( $tags ) . '</div>';
		}
	}
	edit_post_link(
		__( 'Bewerk', 'voltalux' ),
		'<span class="vlx-edit-link">',
		'</span>'
	);
}

/**
 * The site logo: custom-logo if set, otherwise the hard-coded Voltalux default
 * (which the client can replace in Appearance > Customize > Site-identiteit).
 *
 * @param string $context header|footer
 */
function voltalux_branding( $context = 'header' ) {
	$default_logo = voltalux_option( 'logo_url', VOLTALUX_DEFAULT_LOGO );
	$home         = esc_url( home_url( '/' ) );
	$name         = get_bloginfo( 'name' );

	// Footer uses a light logo variant if provided, else the same logo.
	if ( 'footer' === $context ) {
		$footer_logo = voltalux_option( 'logo_footer_url', $default_logo );
		printf(
			'<a class="vlx-brand vlx-brand--footer" href="%1$s" rel="home"><img src="%2$s" alt="%3$s" width="180" height="52" loading="lazy" decoding="async"></a>',
			$home,
			esc_url( $footer_logo ),
			esc_attr( $name )
		);
		return;
	}

	// Header: honour WordPress custom-logo when the client sets one; fall back to default URL.
	if ( has_custom_logo() ) {
		echo '<span class="vlx-brand">';
		the_custom_logo();
		echo '</span>';
		return;
	}

	printf(
		'<a class="vlx-brand" href="%1$s" rel="home"><img src="%2$s" alt="%3$s" width="180" height="52" fetchpriority="high" decoding="async"></a>',
		$home,
		esc_url( $default_logo ),
		esc_attr( $name )
	);
}
