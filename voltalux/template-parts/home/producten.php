<?php
/**
 * Homepage products — "Onze thuisbatterijen".
 *
 * A focused, premium showcase of the home-battery brands Voltalux installs.
 * Runs on a dark band so it reads as a distinct product moment.
 *
 * @package Voltalux
 */

$eyebrow  = apply_filters( 'voltalux_home_producten_eyebrow', __( 'Thuisbatterijen', 'voltalux' ) );
$title    = apply_filters( 'voltalux_home_producten_title', __( 'Sla je eigen stroom op voor later', 'voltalux' ) );
$intro    = apply_filters( 'voltalux_home_producten_intro', __( 'Gebruik je zonne-energie ook \'s avonds. Wij installeren alleen A-merk batterijen en adviseren welke het beste bij jouw verbruik past.', 'voltalux' ) );
$products = voltalux_battery_products();
$phone    = voltalux_option( 'phone', VOLTALUX_PHONE );

if ( empty( $products ) ) {
	return;
}
?>
<section class="vlx-section vlx-bg-ink" id="producten">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-s-head--center vlx-reveal">
			<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow, true ); } ?>
			<h2><?php echo esc_html( $title ); ?></h2>
		</div>

		<div class="vlx-batts">
			<?php foreach ( $products as $p ) : ?>
				<article class="vlx-batt vlx-reveal">
					<?php if ( ! empty( $p['img'] ) ) : ?>
						<div class="vlx-batt__media">
							<img src="<?php echo esc_url( set_url_scheme( $p['img'] ) ); ?>" alt="<?php echo esc_attr( sprintf( '%s thuisbatterij', $p['name'] ) ); ?>" loading="lazy">
						</div>
					<?php endif; ?>
					<div class="vlx-batt__body">
						<?php if ( ! empty( $p['spec'] ) ) : ?><span class="vlx-batt__spec"><?php echo esc_html( $p['spec'] ); ?></span><?php endif; ?>
						<h3 class="vlx-batt__name"><?php echo esc_html( $p['name'] ); ?></h3>
						<?php if ( ! empty( $p['desc'] ) ) : ?><p class="vlx-batt__desc"><?php echo esc_html( $p['desc'] ); ?></p><?php endif; ?>
						<span class="vlx-arrow-link vlx-batt__more"><?php esc_html_e( 'Bekijk batterij', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
					</div>
					<a class="vlx-batt__cover" href="<?php echo esc_url( $p['url'] ); ?>" aria-label="<?php echo esc_attr( $p['name'] ); ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="vlx-batts__foot vlx-reveal">
			<p><?php esc_html_e( 'Niet zeker welke batterij bij je past? We rekenen het gratis en vrijblijvend voor je uit.', 'voltalux' ); ?></p>
			<div class="vlx-batts__actions">
				<?php voltalux_button( array( 'label' => __( 'Advies op maat', 'voltalux' ), 'url' => '#contact', 'style' => 'primary', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
				<?php if ( $phone ) { voltalux_button( array( 'label' => __( 'Bel', 'voltalux' ) . ' ' . $phone, 'url' => 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ), 'style' => 'ghost', 'arrow' => false ) ); } ?>
			</div>
		</div>
	</div>
</section>
