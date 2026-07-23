<?php
/**
 * Homepage offerte / contact section — the main conversion block.
 *
 * @package Voltalux
 */

$eyebrow = apply_filters( 'voltalux_home_offerte_eyebrow', __( 'Neem de eerste stap naar duurzaamheid', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_offerte_title', __( 'Vraag vrijblijvend een offerte aan', 'voltalux' ) );
$text    = apply_filters( 'voltalux_home_offerte_text', __( 'Benieuwd welke duurzame installatie bij jouw woning past? Doe de gratis check en ontvang een vrijblijvend advies en offerte op maat.', 'voltalux' ) );
$phone   = voltalux_option( 'phone', VOLTALUX_PHONE );

$points = apply_filters(
	'voltalux_home_offerte_points',
	array(
		__( 'Adviesgesprek op maat en op locatie', 'voltalux' ),
		__( 'Binnen 3 weken geïnstalleerd', 'voltalux' ),
		__( 'Geen betalingen vooraf', 'voltalux' ),
	)
);
?>
<section class="vlx-section" id="contact">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-offerte vlx-reveal">
			<div class="vlx-offerte__body">
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow, true ); } ?>
				<h2 style="margin-top:1rem"><?php echo esc_html( $title ); ?></h2>
				<p class="vlx-offerte__lead"><?php echo esc_html( $text ); ?></p>
				<ul class="vlx-offerte__trust">
					<?php foreach ( $points as $p ) : ?>
						<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><span><?php echo esc_html( $p ); ?></span></li>
					<?php endforeach; ?>
				</ul>
				<?php if ( $phone ) : ?>
					<a class="vlx-offerte__phone" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo voltalux_icon( 'phone' ); // phpcs:ignore ?><?php echo esc_html( __( 'Of bel', 'voltalux' ) . ' ' . $phone ); ?></a>
				<?php endif; ?>
			</div>

			<div class="vlx-offerte__card">
				<h3><?php esc_html_e( 'Start jouw aanvraag', 'voltalux' ); ?></h3>
				<?php voltalux_form(); ?>
			</div>
		</div>
	</div>
</section>
