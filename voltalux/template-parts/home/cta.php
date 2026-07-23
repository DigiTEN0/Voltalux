<?php
/**
 * Homepage closing CTA band.
 *
 * @package Voltalux
 */

$eyebrow = apply_filters( 'voltalux_home_cta_eyebrow', __( 'Geen mooie praatjes, wel een eerlijk verhaal', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_cta_title', __( 'Klaar om te besparen met een thuisbatterij?', 'voltalux' ) );
$text    = apply_filters( 'voltalux_home_cta_text', __( 'Plan een vrijblijvend adviesgesprek. We kijken samen naar jouw situatie en maken een voorstel op maat — helder, eerlijk en zonder verplichtingen.', 'voltalux' ) );
$b1_label = apply_filters( 'voltalux_home_cta_btn1_label', voltalux_option( 'header_cta_label', __( 'Plan gratis advies', 'voltalux' ) ) );
$b1_url   = apply_filters( 'voltalux_home_cta_btn1_url', voltalux_option( 'header_cta_url', '#contact' ) );
$phone    = voltalux_option( 'phone', '' );
?>
<section class="vlx-section" id="contact">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-cta-band__box vlx-reveal">
			<div>
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
				<h2 style="margin-top:1rem;"><?php echo esc_html( $title ); ?></h2>
				<?php if ( $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
			</div>
			<div class="vlx-cta-band__actions">
				<?php voltalux_button( array( 'label' => $b1_label, 'url' => $b1_url, 'style' => 'green', 'size' => 'lg' ) ); ?>
				<?php if ( $phone ) : ?>
					<?php voltalux_button( array( 'label' => $phone, 'url' => 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ), 'style' => 'ghost', 'arrow' => false, 'size' => 'lg', 'class' => 'vlx-btn--on-dark' ) ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
