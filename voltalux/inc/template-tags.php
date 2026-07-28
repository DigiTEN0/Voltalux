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
 * Inline line-icon set (24x24, stroke = currentColor).
 *
 * @param string $name Icon key.
 * @return string SVG markup.
 */
function voltalux_icon( $name ) {
	$fill = array(
		'phone'   => '<path d="M6.6 10.8a15.5 15.5 0 006.6 6.6l2.2-2.2a1 1 0 011-.24c1.1.37 2.3.57 3.5.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.2.2 2.4.57 3.5a1 1 0 01-.24 1L6.6 10.8z"/>',
	);
	if ( isset( $fill[ $name ] ) ) {
		return '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">' . $fill[ $name ] . '</svg>';
	}

	$icons = array(
		'check'   => '<path d="M20 6L9 17l-5-5"/>',
		'plus'    => '<path d="M12 5v14M5 12h14"/>',
		'close'   => '<path d="M6 6l12 12M18 6L6 18"/>',
		'chevron' => '<path d="M6 9l6 6 6-6"/>',
		'arrow-right' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		// Services.
		'sun'     => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
		'battery' => '<rect x="2.5" y="8" width="15" height="9" rx="2.2"/><path d="M17.5 11h2a1 1 0 011 1v1a1 1 0 01-1 1h-2"/><path d="M9.2 9.6L7.4 12.6h2.4L8 15.6"/>',
		'snow'    => '<path d="M12 3v18M5 7.5l14 9M19 7.5l-14 9"/><path d="M9.4 4.4L12 6l2.6-1.6M9.4 19.6L12 18l2.6 1.6M4 10.2l.4 3-2.4 1.8M20 10.2l-.4 3 2.4 1.8M4 13.8l-2-.6M20 13.8l2-.6"/>',
		'roof'    => '<path d="M3 11l9-7 9 7"/><path d="M5 9.6V19a1 1 0 001 1h12a1 1 0 001-1V9.6"/><path d="M9.5 20v-5.5h5V20"/>',
		// Trust / value.
		'shield'  => '<path d="M12 3l7 3v5c0 4.5-3 8.5-7 10-4-1.5-7-5.5-7-10V6l7-3z"/><path d="M9 11.8l2 2 4-4"/>',
		'medal'   => '<circle cx="12" cy="9" r="5"/><path d="M9 13.4L7 21l5-3 5 3-2-7.6"/>',
		'layers'  => '<path d="M12 3l9 5-9 5-9-5 9-5z"/><path d="M3 13l9 5 9-5"/>',
		'clock'   => '<circle cx="12" cy="12" r="9"/><path d="M12 7.5V12l3 2"/>',
		'headset' => '<path d="M4 13v-1a8 8 0 0116 0v1"/><path d="M6 14a2 2 0 00-2 2v1a2 2 0 002 2M18 14a2 2 0 012 2v1a2 2 0 01-2 2"/><path d="M18 19a4 4 0 01-4 3h-1.5"/>',
		'home'    => '<path d="M3 11l9-7 9 7"/><path d="M5 9.6V19a1 1 0 001 1h12a1 1 0 001-1V9.6"/><path d="M9.5 14.5l1.7 1.7 3.3-3.3"/>',
		'euro'    => '<path d="M16 6.5A6 6 0 108 17M4 10.5h8M4 13.5h7"/>',
		'pin'     => '<path d="M12 21s7-6.3 7-12a7 7 0 10-14 0c0 5.7 7 12 7 12z"/><circle cx="12" cy="9" r="2.4"/>',
		'user'    => '<circle cx="12" cy="8" r="4"/><path d="M4 20.5V20a6 6 0 016-6h4a6 6 0 016 6v.5"/>',
		'mail'    => '<rect x="3" y="5" width="18" height="14" rx="2.4"/><path d="M3.5 7l8.5 6 8.5-6"/>',
		'spark'   => '<path d="M12 3v6M12 15v6M3 12h6M15 12h6"/><path d="M6.4 6.4l3.2 3.2M14.4 14.4l3.2 3.2M17.6 6.4l-3.2 3.2M9.6 14.4l-3.2 3.2"/>',
		'heat'    => '<circle cx="12" cy="12" r="8.5"/><circle cx="12" cy="12" r="1.6"/><path d="M12 10.4c0-3.2.8-4.9 2.4-4.9 1.2 0 1.6 1.6 0 3.3M13.6 12c3.2 0 4.9.8 4.9 2.4 0 1.2-1.6 1.6-3.3 0M12 13.6c0 3.2-.8 4.9-2.4 4.9-1.2 0-1.6-1.6 0-3.3M10.4 12c-3.2 0-4.9-.8-4.9-2.4 0-1.2 1.6-1.6 3.3 0"/>',
		'ev'      => '<rect x="6" y="3" width="9" height="18" rx="2"/><path d="M9.5 3V1.6M12 3V1.6"/><path d="M15 8.5h2a2 2 0 012 2v3a1.7 1.7 0 01-3.4 0V12"/><path d="M11 8l-1.6 3.2h3L10.8 14"/>',
		'lightning' => '<path d="M13 2L4.5 13.5H11L10 22l8.5-11.5H12L13 2z"/>',
		'leaf'    => '<path d="M20 4S9 4 6 9c-2.4 4-.5 8 2 9 3.5 1.4 8-1 10-5 2-4 2-9 2-9z"/><path d="M11 13c2-3 5-4 5-4"/>',
	);
	$body = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $body . '</svg>';
}

/**
 * Professional 5-star rating (filled SVG stars).
 *
 * @param float  $rating 0-5.
 * @param string $label  Accessible label.
 * @return string
 */
function voltalux_stars( $rating = 5, $label = '' ) {
	$star = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.5l2.9 6 6.6.6-5 4.3 1.5 6.5L12 17.9 5.5 21.4 7 14.9l-5-4.3 6.6-.6z"/></svg>';
	$out  = '<span class="vlx-stars" role="img" aria-label="' . esc_attr( $label ? $label : sprintf( '%s van 5 sterren', $rating ) ) . '">';
	$out .= str_repeat( $star, 5 );
	$out .= '</span>';
	return $out;
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
 * The offerte / quote form.
 *
 * If a form shortcode is set in the Customizer (e.g. a Contact Form 7 or
 * Elementor form), that is rendered. Otherwise a styled default form is shown
 * (mark-up only — wire it to your form plugin via the Customizer).
 *
 * @param bool $echo Echo or return.
 * @return string
 */
function voltalux_form( $echo = true ) {
	$shortcode = voltalux_option( 'form_shortcode', '' );
	if ( $shortcode ) {
		$html = do_shortcode( $shortcode );
		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		return $html;
	}

	$diensten = apply_filters(
		'voltalux_form_services',
		array( 'Zonnepanelen', 'Thuisbatterij', "Airco's", 'Warmtepomp', 'Dakrenovatie' )
	);

	ob_start();
	?>
	<form class="vlx-form" action="<?php echo esc_url( voltalux_option( 'form_action', '#' ) ); ?>" method="post" novalidate>
		<div class="vlx-form__grid">
			<label class="vlx-field"><span><?php esc_html_e( 'Naam', 'voltalux' ); ?></span>
				<input type="text" name="naam" autocomplete="name" placeholder="<?php esc_attr_e( 'Voor- en achternaam', 'voltalux' ); ?>" required></label>
			<label class="vlx-field"><span><?php esc_html_e( 'E-mailadres', 'voltalux' ); ?></span>
				<input type="email" name="email" autocomplete="email" placeholder="naam@voorbeeld.nl" required></label>
			<label class="vlx-field"><span><?php esc_html_e( 'Telefoonnummer', 'voltalux' ); ?></span>
				<input type="tel" name="telefoon" autocomplete="tel" placeholder="06 12 34 56 78" required></label>
			<label class="vlx-field"><span><?php esc_html_e( 'Dienst', 'voltalux' ); ?></span>
				<select name="dienst" required>
					<option value="" selected disabled><?php esc_html_e( 'Kies een dienst', 'voltalux' ); ?></option>
					<?php foreach ( $diensten as $d ) : ?>
						<option value="<?php echo esc_attr( $d ); ?>"><?php echo esc_html( $d ); ?></option>
					<?php endforeach; ?>
				</select></label>
			<label class="vlx-field vlx-field--sm"><span><?php esc_html_e( 'Postcode', 'voltalux' ); ?></span>
				<input type="text" name="postcode" placeholder="1234 AB"></label>
			<label class="vlx-field vlx-field--sm"><span><?php esc_html_e( 'Huisnummer', 'voltalux' ); ?></span>
				<input type="text" name="huisnummer" placeholder="12"></label>
			<label class="vlx-field vlx-field--full"><span><?php esc_html_e( 'Omschrijving', 'voltalux' ); ?></span>
				<textarea name="omschrijving" rows="3" placeholder="<?php esc_attr_e( 'Vertel kort wat je zoekt…', 'voltalux' ); ?>"></textarea></label>
		</div>
		<button type="submit" class="vlx-btn vlx-btn--primary vlx-btn--block vlx-btn--lg"><?php esc_html_e( 'Offerte aanvragen', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></button>
		<p class="vlx-form__note"><?php esc_html_e( 'Binnen 1 minuut geregeld · je zit nergens aan vast.', 'voltalux' ); ?></p>
	</form>
	<?php
	$html = ob_get_clean();
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

/**
 * Google reviews badge — a white pill (Google logo + rating + stars + count)
 * that links to the Google profile / Maps. The whole badge is one clickable link.
 */
function voltalux_google_badge( $echo = true ) {
	$url    = voltalux_option( 'google_url', defined( 'VOLTALUX_GOOGLE_URL' ) ? VOLTALUX_GOOGLE_URL : '' );
	$rating = voltalux_option( 'google_rating', defined( 'VOLTALUX_GOOGLE_RATING' ) ? VOLTALUX_GOOGLE_RATING : '' );
	$count  = voltalux_option( 'google_count', defined( 'VOLTALUX_GOOGLE_COUNT' ) ? VOLTALUX_GOOGLE_COUNT : '' );

	if ( ! $url || ! $rating ) {
		return '';
	}

	$g = '<svg viewBox="0 0 48 48" aria-hidden="true"><path fill="#4285F4" d="M45.1 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h11.8c-.5 2.7-2 5-4.3 6.6v5.5h7C42.6 36.9 45.1 31.2 45.1 24.5z"/><path fill="#34A853" d="M24 46c5.8 0 10.7-1.9 14.3-5.2l-7-5.5c-1.9 1.3-4.4 2.1-7.3 2.1-5.6 0-10.3-3.8-12-8.9H4.8v5.7C8.4 41.4 15.6 46 24 46z"/><path fill="#FBBC05" d="M12 28.5c-.4-1.3-.7-2.7-.7-4.1s.3-2.8.7-4.1v-5.7H4.8C3.4 17.4 2.6 20.6 2.6 24s.8 6.6 2.2 9.4L12 28.5z"/><path fill="#EA4335" d="M24 11c3.2 0 6 1.1 8.2 3.2l6.1-6.1C34.7 4.5 29.8 2.6 24 2.6 15.6 2.6 8.4 7.2 4.8 14.6l7.2 5.7C13.7 14.8 18.4 11 24 11z"/></svg>';

	$rating_num = (float) str_replace( ',', '.', $rating );

	$html  = '<a class="vlx-gbadge" href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( sprintf( __( 'Beoordeeld met %1$s door %2$s reviewers op Google — open onze Google-pagina', 'voltalux' ), $rating, $count ) ) . '">';
	$html .= '<span class="vlx-gbadge__g">' . $g . '</span>';
	$html .= '<span class="vlx-gbadge__body">';
	$html .= '<span class="vlx-gbadge__title">' . esc_html( sprintf( __( 'Bekijk onze %s reviews', 'voltalux' ), $count ) ) . '</span>';
	$html .= '<span class="vlx-gbadge__stars">' . voltalux_stars( $rating_num ) . '</span>';
	$html .= '</span>';
	$html .= '<span class="vlx-gbadge__rating">' . esc_html( $rating ) . '</span>';
	$html .= '</a>';

	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	return $html;
}
