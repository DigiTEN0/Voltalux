<?php
/**
 * Voltalux Huisscan — a branded, multi-step lead flow.
 *
 * A conversion-focused "huisscan" the way the big Dutch energy players run it:
 *  - the hero shows a compact address card (postcode + huisnummer + toevoeging)
 *    that resolves the full address live via the official PDOK Locatieserver
 *    (free, no API key, GDPR-safe — a Dutch-government service);
 *  - clicking through opens a smooth 3-step wizard (product → situatie →
 *    gegevens) and submits without a page reload.
 *
 * Everything is in Voltalux's own design language (dark + green + Manrope) —
 * no borrowed branding. All copy and the product list are filterable, and the
 * lead is e-mailed to the client out of the box (wp_mail), with a filter hook
 * for CRM integrations.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Is the huisscan enabled? (Customizer toggle, on by default.)
 */
function voltalux_huisscan_enabled() {
	$v = voltalux_option( 'huisscan_enable', '1' );
	return (bool) apply_filters( 'voltalux_huisscan_enabled', ( '' !== $v && '0' !== $v ) );
}

/**
 * The products a visitor can request advice on. Filterable.
 *
 * @return array[] each: array( 'key', 'label', 'icon' )
 */
function voltalux_huisscan_products() {
	return apply_filters(
		'voltalux_huisscan_products',
		array(
			array( 'key' => 'zonnepanelen', 'label' => __( 'Zonnepanelen', 'voltalux' ), 'icon' => 'sun' ),
			array( 'key' => 'thuisbatterij', 'label' => __( 'Thuisbatterij', 'voltalux' ), 'icon' => 'battery' ),
			array( 'key' => 'airco', 'label' => __( "Airco", 'voltalux' ), 'icon' => 'snow' ),
			array( 'key' => 'warmtepomp', 'label' => __( 'Warmtepomp', 'voltalux' ), 'icon' => 'heat' ),
			array( 'key' => 'dakrenovatie', 'label' => __( 'Dakrenovatie', 'voltalux' ), 'icon' => 'roof' ),
			array( 'key' => 'laadpaal', 'label' => __( 'Laadpaal', 'voltalux' ), 'icon' => 'ev' ),
		)
	);
}

/* -------------------------------------------------------------------------
 *  Assets — hand the front-end the AJAX endpoint, nonce and geocoder URL.
 * ---------------------------------------------------------------------- */
function voltalux_huisscan_localize() {
	if ( ! voltalux_huisscan_enabled() ) {
		return;
	}
	wp_localize_script(
		'voltalux-theme',
		'voltaluxHsc',
		array(
			'ajax'    => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'voltalux_huisscan' ),
			// Official Dutch government address service (CORS-enabled, no key, no tracking).
			'geocode' => apply_filters( 'voltalux_huisscan_geocode_url', 'https://api.pdok.nl/bzk/locatieserver/search/v3_1/free' ),
			'i18n'    => array(
				'searching' => __( 'Adres zoeken…', 'voltalux' ),
				'notFound'  => __( 'We konden dit adres niet vinden — je kunt gewoon verder.', 'voltalux' ),
				'error'     => __( 'Er ging iets mis. Probeer het zo nog eens.', 'voltalux' ),
				'sending'   => __( 'Versturen…', 'voltalux' ),
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'voltalux_huisscan_localize', 20 );

/* -------------------------------------------------------------------------
 *  Hero address card (desktop) + mobile launch button.
 * ---------------------------------------------------------------------- */
function voltalux_huisscan_hero_card( $echo = true ) {
	if ( ! voltalux_huisscan_enabled() ) {
		return '';
	}
	ob_start();
	?>
	<aside class="vlx-hsc-card" data-vlx-hsc-card aria-label="<?php esc_attr_e( 'Gratis huisscan', 'voltalux' ); ?>">
		<span class="vlx-hsc-card__eyebrow"><span class="vlx-hsc-card__dot"></span><?php esc_html_e( 'Gratis huisscan', 'voltalux' ); ?></span>
		<h2 class="vlx-hsc-card__title"><?php esc_html_e( 'Ontdek wat jouw huis kan besparen', 'voltalux' ); ?></h2>
		<p class="vlx-hsc-card__sub"><?php esc_html_e( 'Vul je adres in en krijg binnen 2 minuten een persoonlijk, vrijblijvend advies.', 'voltalux' ); ?></p>

		<form class="vlx-hsc-card__form" data-vlx-hsc-heroform novalidate>
			<div class="vlx-hsc-card__row">
				<label class="vlx-hsc-field vlx-hsc-field--pc">
					<span><?php esc_html_e( 'Postcode', 'voltalux' ); ?></span>
					<input type="text" inputmode="text" autocomplete="postal-code" placeholder="1234 AB" maxlength="7" data-vlx-hsc-field="postcode">
				</label>
				<label class="vlx-hsc-field vlx-hsc-field--nr">
					<span><?php esc_html_e( 'Huisnr.', 'voltalux' ); ?></span>
					<input type="text" inputmode="numeric" autocomplete="off" placeholder="12" maxlength="6" data-vlx-hsc-field="huisnummer">
				</label>
				<label class="vlx-hsc-field vlx-hsc-field--add">
					<span><?php esc_html_e( 'Toev.', 'voltalux' ); ?></span>
					<input type="text" autocomplete="off" placeholder="A" maxlength="6" data-vlx-hsc-field="toevoeging">
				</label>
				<button type="submit" class="vlx-hsc-card__go" aria-label="<?php esc_attr_e( 'Start de huisscan', 'voltalux' ); ?>">
					<?php echo voltalux_icon( 'arrow-right' ); // phpcs:ignore ?>
				</button>
			</div>
			<p class="vlx-hsc-card__resolved" data-vlx-hsc-address aria-live="polite"></p>
		</form>

		<ul class="vlx-hsc-card__trust">
			<li><?php echo voltalux_icon( 'clock' ); // phpcs:ignore ?><?php esc_html_e( '± 2 minuten', 'voltalux' ); ?></li>
			<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><?php esc_html_e( '100% vrijblijvend', 'voltalux' ); ?></li>
		</ul>
	</aside>
	<?php
	$html = ob_get_clean();
	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	return $html;
}

/* -------------------------------------------------------------------------
 *  The wizard modal (rendered once, site-wide, in the footer).
 * ---------------------------------------------------------------------- */
function voltalux_huisscan_modal() {
	if ( ! voltalux_huisscan_enabled() ) {
		return;
	}
	$products = voltalux_huisscan_products();
	$intro_img = voltalux_option( 'huisscan_image', VOLTALUX_WELKOM_IMG );
	if ( $intro_img ) {
		$intro_img = set_url_scheme( $intro_img );
	}
	?>
	<div class="vlx-hsc" id="vlx-huisscan" data-vlx-hsc role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Gratis huisscan', 'voltalux' ); ?>" hidden>
		<div class="vlx-hsc__overlay" data-vlx-hsc-close></div>
		<div class="vlx-hsc__panel" role="document">
			<button class="vlx-hsc__close" type="button" data-vlx-hsc-close aria-label="<?php esc_attr_e( 'Sluiten', 'voltalux' ); ?>"><?php echo voltalux_icon( 'close' ); // phpcs:ignore ?></button>

			<div class="vlx-hsc__progress" data-vlx-hsc-progress hidden>
				<div class="vlx-hsc__progress-top"><span data-vlx-hsc-steplabel><?php esc_html_e( 'Stap 1 van 3', 'voltalux' ); ?></span></div>
				<div class="vlx-hsc__bar"><span data-vlx-hsc-barfill style="width:33%"></span></div>
			</div>

			<form class="vlx-hsc__form" data-vlx-hsc-form novalidate>
				<div class="vlx-hsc__steps">

					<?php /* STEP: address (entry point on mobile / direct open) */ ?>
					<section class="vlx-hsc-step" data-step="address">
						<div class="vlx-hsc-step__media" aria-hidden="true"<?php echo $intro_img ? ' style="background-image:url(\'' . esc_url( $intro_img ) . '\')"' : ''; ?>></div>
						<div class="vlx-hsc-step__body">
							<span class="vlx-eyebrow vlx-eyebrow--dark"><?php esc_html_e( 'Check jouw situatie', 'voltalux' ); ?></span>
							<h2 class="vlx-hsc-step__title"><?php esc_html_e( 'Doe de gratis huisscan', 'voltalux' ); ?></h2>
							<p class="vlx-hsc-step__lead"><?php esc_html_e( 'Benieuwd welke duurzame installaties passen bij jouw woning? Vul je adres in en ontvang een persoonlijk advies en offerte — geheel vrijblijvend.', 'voltalux' ); ?></p>
							<div class="vlx-hsc-adr">
								<label class="vlx-hsc-field vlx-hsc-field--pc"><span><?php esc_html_e( 'Postcode', 'voltalux' ); ?> *</span>
									<input type="text" autocomplete="postal-code" placeholder="1234 AB" maxlength="7" data-vlx-hsc-field="postcode"></label>
								<label class="vlx-hsc-field vlx-hsc-field--nr"><span><?php esc_html_e( 'Huisnummer', 'voltalux' ); ?> *</span>
									<input type="text" inputmode="numeric" placeholder="12" maxlength="6" data-vlx-hsc-field="huisnummer"></label>
								<label class="vlx-hsc-field vlx-hsc-field--add"><span><?php esc_html_e( 'Toev.', 'voltalux' ); ?></span>
									<input type="text" placeholder="A" maxlength="6" data-vlx-hsc-field="toevoeging"></label>
							</div>
							<p class="vlx-hsc-card__resolved vlx-hsc-card__resolved--dark" data-vlx-hsc-address aria-live="polite"></p>
						</div>
					</section>

					<?php /* STEP 1: product keuze */ ?>
					<section class="vlx-hsc-step" data-step="products" data-progress="1">
						<div class="vlx-hsc-step__body">
							<span class="vlx-eyebrow vlx-eyebrow--dark"><?php esc_html_e( 'Productkeuze', 'voltalux' ); ?></span>
							<h2 class="vlx-hsc-step__title"><?php esc_html_e( 'Waar wil je meer over weten?', 'voltalux' ); ?></h2>
							<p class="vlx-hsc-step__lead"><?php esc_html_e( 'Kies één of meerdere producten die we meenemen in je advies.', 'voltalux' ); ?></p>
							<div class="vlx-hsc-grid" role="group" aria-label="<?php esc_attr_e( 'Producten', 'voltalux' ); ?>">
								<?php foreach ( $products as $p ) : ?>
									<button type="button" class="vlx-hsc-opt" data-vlx-hsc-product="<?php echo esc_attr( $p['label'] ); ?>" aria-pressed="false">
										<span class="vlx-hsc-opt__ic"><?php echo voltalux_icon( $p['icon'] ); // phpcs:ignore ?></span>
										<span class="vlx-hsc-opt__lbl"><?php echo esc_html( $p['label'] ); ?></span>
										<span class="vlx-hsc-opt__check"><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?></span>
									</button>
								<?php endforeach; ?>
							</div>
						</div>
					</section>

					<?php /* STEP 2: situatie */ ?>
					<section class="vlx-hsc-step" data-step="situation" data-progress="2">
						<div class="vlx-hsc-step__body">
							<span class="vlx-eyebrow vlx-eyebrow--dark"><?php esc_html_e( 'Jouw woning', 'voltalux' ); ?></span>
							<h2 class="vlx-hsc-step__title"><?php esc_html_e( 'Vertel ons over je situatie', 'voltalux' ); ?></h2>
							<p class="vlx-hsc-step__lead"><?php esc_html_e( 'Zo maken we het advies meteen persoonlijk. Niets verplicht — sla gerust over.', 'voltalux' ); ?></p>

							<div class="vlx-hsc-q">
								<span class="vlx-hsc-q__label"><?php esc_html_e( 'Ken je je gemiddelde jaarverbruik?', 'voltalux' ); ?></span>
								<div class="vlx-hsc-pills">
									<label class="vlx-hsc-pill"><input type="radio" name="verbruik_bekend" value="Ja"><span><?php esc_html_e( 'Ja', 'voltalux' ); ?></span></label>
									<label class="vlx-hsc-pill"><input type="radio" name="verbruik_bekend" value="Nee"><span><?php esc_html_e( 'Nee', 'voltalux' ); ?></span></label>
								</div>
								<label class="vlx-hsc-field vlx-hsc-field--reveal" data-vlx-hsc-reveal="verbruik_bekend:Ja">
									<span><?php esc_html_e( 'Jaarverbruik (kWh)', 'voltalux' ); ?></span>
									<input type="text" inputmode="numeric" name="verbruik" placeholder="3500">
								</label>
							</div>

							<div class="vlx-hsc-q">
								<span class="vlx-hsc-q__label"><?php esc_html_e( 'Wat voor dak heb je?', 'voltalux' ); ?></span>
								<div class="vlx-hsc-pills">
									<?php foreach ( array( 'Schuin dak', 'Plat dak', 'Beide', 'Weet ik niet' ) as $dak ) : ?>
										<label class="vlx-hsc-pill"><input type="checkbox" name="daktype" value="<?php echo esc_attr( $dak ); ?>"><span><?php echo esc_html( $dak ); ?></span></label>
									<?php endforeach; ?>
								</div>
							</div>

							<label class="vlx-hsc-field vlx-hsc-field--full">
								<span><?php esc_html_e( 'Aantal bewoners', 'voltalux' ); ?></span>
								<input type="text" inputmode="numeric" name="bewoners" placeholder="<?php esc_attr_e( 'Bijv. 3', 'voltalux' ); ?>">
							</label>
						</div>
					</section>

					<?php /* STEP 3: gegevens */ ?>
					<section class="vlx-hsc-step" data-step="contact" data-progress="3">
						<div class="vlx-hsc-step__body">
							<span class="vlx-eyebrow vlx-eyebrow--dark"><?php esc_html_e( 'Bijna klaar', 'voltalux' ); ?></span>
							<h2 class="vlx-hsc-step__title"><?php esc_html_e( 'Waar mogen we je advies naartoe sturen?', 'voltalux' ); ?></h2>
							<p class="vlx-hsc-step__lead"><?php esc_html_e( 'We nemen binnen twee werkdagen persoonlijk contact met je op.', 'voltalux' ); ?></p>
							<div class="vlx-hsc-form-grid">
								<label class="vlx-hsc-field vlx-hsc-field--full"><span><?php esc_html_e( 'Aanhef', 'voltalux' ); ?></span>
									<span class="vlx-hsc-select">
										<select name="aanhef">
											<option value="Dhr."><?php esc_html_e( 'Dhr.', 'voltalux' ); ?></option>
											<option value="Mevr."><?php esc_html_e( 'Mevr.', 'voltalux' ); ?></option>
											<option value="Anders/onbekend"><?php esc_html_e( 'Anders / zeg ik liever niet', 'voltalux' ); ?></option>
										</select>
										<?php echo voltalux_icon( 'chevron' ); // phpcs:ignore ?>
									</span>
								</label>
								<label class="vlx-hsc-field"><span><?php esc_html_e( 'Voornaam', 'voltalux' ); ?> *</span>
									<input type="text" name="voornaam" autocomplete="given-name" placeholder="<?php esc_attr_e( 'Voornaam', 'voltalux' ); ?>" data-vlx-hsc-required></label>
								<label class="vlx-hsc-field"><span><?php esc_html_e( 'Achternaam', 'voltalux' ); ?> *</span>
									<input type="text" name="achternaam" autocomplete="family-name" placeholder="<?php esc_attr_e( 'Achternaam', 'voltalux' ); ?>" data-vlx-hsc-required></label>
								<label class="vlx-hsc-field"><span><?php esc_html_e( 'E-mailadres', 'voltalux' ); ?> *</span>
									<input type="email" name="email" autocomplete="email" placeholder="naam@voorbeeld.nl" data-vlx-hsc-required></label>
								<label class="vlx-hsc-field"><span><?php esc_html_e( 'Telefoonnummer', 'voltalux' ); ?> *</span>
									<input type="tel" name="telefoon" autocomplete="tel" placeholder="06 12 34 56 78" data-vlx-hsc-required></label>
							</div>
							<label class="vlx-hsc-consent">
								<input type="checkbox" name="akkoord" data-vlx-hsc-required>
								<span><?php esc_html_e( 'Ik ga akkoord dat Voltalux contact met me opneemt over mijn aanvraag.', 'voltalux' ); ?></span>
							</label>
						</div>
					</section>

					<?php /* Success */ ?>
					<section class="vlx-hsc-step vlx-hsc-step--done" data-step="success">
						<div class="vlx-hsc-step__body vlx-hsc-done">
							<span class="vlx-hsc-done__ic"><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?></span>
							<h2 class="vlx-hsc-step__title"><?php esc_html_e( 'Bedankt! Je aanvraag staat klaar.', 'voltalux' ); ?></h2>
							<p class="vlx-hsc-step__lead" data-vlx-hsc-donemsg><?php esc_html_e( 'Een van onze adviseurs neemt binnen twee werkdagen contact met je op voor een persoonlijk, vrijblijvend advies.', 'voltalux' ); ?></p>
							<button type="button" class="vlx-btn vlx-btn--dark vlx-btn--lg" data-vlx-hsc-close><span class="vlx-btn__lbl"><?php esc_html_e( 'Sluiten', 'voltalux' ); ?></span></button>
						</div>
					</section>
				</div>

				<div class="vlx-hsc__foot" data-vlx-hsc-foot>
					<button type="button" class="vlx-btn vlx-btn--ghost-dark" data-vlx-hsc-prev><?php esc_html_e( 'Vorige', 'voltalux' ); ?></button>
					<p class="vlx-hsc__err" data-vlx-hsc-error role="alert"></p>
					<button type="button" class="vlx-btn vlx-btn--primary vlx-btn--lg" data-vlx-hsc-next>
						<span class="vlx-btn__lbl" data-vlx-hsc-nextlbl><?php esc_html_e( 'Volgende', 'voltalux' ); ?></span> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?>
					</button>
				</div>
			</form>
		</div>
	</div>
	<?php
}

/* -------------------------------------------------------------------------
 *  AJAX handler — e-mail the lead to the client (best effort).
 * ---------------------------------------------------------------------- */
function voltalux_huisscan_submit() {
	check_ajax_referer( 'voltalux_huisscan', 'nonce' );

	$raw = isset( $_POST['data'] ) ? wp_unslash( $_POST['data'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$data = json_decode( is_string( $raw ) ? $raw : '', true );
	if ( ! is_array( $data ) ) {
		wp_send_json_error( array( 'message' => __( 'Ongeldige aanvraag.', 'voltalux' ) ), 400 );
	}

	$get = function ( $key ) use ( $data ) {
		return isset( $data[ $key ] ) ? sanitize_text_field( wp_strip_all_tags( (string) $data[ $key ] ) ) : '';
	};

	$voornaam   = $get( 'voornaam' );
	$achternaam = $get( 'achternaam' );
	$email      = sanitize_email( isset( $data['email'] ) ? (string) $data['email'] : '' );
	$telefoon   = $get( 'telefoon' );

	if ( '' === $voornaam || '' === $achternaam || ! is_email( $email ) || '' === $telefoon ) {
		wp_send_json_error( array( 'message' => __( 'Vul je naam, e-mailadres en telefoonnummer in.', 'voltalux' ) ), 422 );
	}

	$products = array();
	if ( ! empty( $data['products'] ) && is_array( $data['products'] ) ) {
		foreach ( $data['products'] as $p ) {
			$products[] = sanitize_text_field( wp_strip_all_tags( (string) $p ) );
		}
	}
	$daktypes = array();
	if ( ! empty( $data['daktype'] ) && is_array( $data['daktype'] ) ) {
		foreach ( $data['daktype'] as $d ) {
			$daktypes[] = sanitize_text_field( wp_strip_all_tags( (string) $d ) );
		}
	}

	$fields = array(
		__( 'Producten', 'voltalux' )       => implode( ', ', array_filter( $products ) ),
		__( 'Adres', 'voltalux' )           => trim( $get( 'adres' ) ),
		__( 'Postcode', 'voltalux' )        => strtoupper( str_replace( ' ', '', $get( 'postcode' ) ) ),
		__( 'Huisnummer', 'voltalux' )      => trim( $get( 'huisnummer' ) . ' ' . $get( 'toevoeging' ) ),
		__( 'Verbruik bekend', 'voltalux' ) => $get( 'verbruik_bekend' ),
		__( 'Jaarverbruik (kWh)', 'voltalux' ) => $get( 'verbruik' ),
		__( 'Daktype', 'voltalux' )         => implode( ', ', array_filter( $daktypes ) ),
		__( 'Aantal bewoners', 'voltalux' ) => $get( 'bewoners' ),
		__( 'Aanhef', 'voltalux' )          => $get( 'aanhef' ),
		__( 'Naam', 'voltalux' )            => trim( $voornaam . ' ' . $achternaam ),
		__( 'E-mail', 'voltalux' )          => $email,
		__( 'Telefoon', 'voltalux' )        => $telefoon,
	);

	// Let integrators take over (CRM, webhook, …) and short-circuit the e-mail.
	$handled = apply_filters( 'voltalux_huisscan_handle', null, $fields, $data );
	if ( null === $handled ) {
		$to = voltalux_option( 'huisscan_email', voltalux_option( 'footer_email', get_option( 'admin_email' ) ) );
		$to = apply_filters( 'voltalux_huisscan_recipient', $to );

		$lines = array( __( 'Nieuwe huisscan-aanvraag via de website:', 'voltalux' ), '' );
		foreach ( $fields as $label => $value ) {
			if ( '' !== $value ) {
				$lines[] = $label . ': ' . $value;
			}
		}
		$subject = sprintf( __( 'Nieuwe huisscan — %s', 'voltalux' ), trim( $voornaam . ' ' . $achternaam ) );
		$headers = array(
			'Content-Type: text/plain; charset=UTF-8',
			'Reply-To: ' . $voornaam . ' ' . $achternaam . ' <' . $email . '>',
		);
		if ( $to ) {
			wp_mail( $to, $subject, implode( "\n", $lines ), $headers );
		}
	}

	wp_send_json_success(
		array(
			'message' => __( 'Een van onze adviseurs neemt binnen twee werkdagen contact met je op voor een persoonlijk, vrijblijvend advies.', 'voltalux' ),
		)
	);
}
add_action( 'wp_ajax_voltalux_huisscan', 'voltalux_huisscan_submit' );
add_action( 'wp_ajax_nopriv_voltalux_huisscan', 'voltalux_huisscan_submit' );

/* -------------------------------------------------------------------------
 *  Customizer — recipient e-mail + toggle (added to the existing Footer/Form).
 * ---------------------------------------------------------------------- */
function voltalux_huisscan_customize( $wp_customize ) {
	$wp_customize->add_section(
		'voltalux_huisscan',
		array(
			'title'       => __( 'Huisscan', 'voltalux' ),
			'description' => __( 'De gratis huisscan in de hero en de bijbehorende wizard. Aanvragen worden per e-mail verstuurd.', 'voltalux' ),
			'panel'       => 'voltalux_panel',
		)
	);

	$wp_customize->add_setting( 'voltalux_huisscan_enable', array( 'default' => '1', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control(
		'voltalux_huisscan_enable',
		array(
			'label'   => __( 'Huisscan tonen', 'voltalux' ),
			'section' => 'voltalux_huisscan',
			'type'    => 'checkbox',
		)
	);

	voltalux_add_text_setting( $wp_customize, 'voltalux_huisscan_email', '', __( 'Aanvragen sturen naar (e-mail)', 'voltalux' ), 'voltalux_huisscan' );
	voltalux_add_url_setting( $wp_customize, 'voltalux_huisscan_image', VOLTALUX_WELKOM_IMG, __( 'Afbeelding startscherm (URL)', 'voltalux' ), __( 'Kleine sfeerfoto op het eerste scherm van de wizard.', 'voltalux' ), 'voltalux_huisscan' );
}
add_action( 'customize_register', 'voltalux_huisscan_customize', 20 );
