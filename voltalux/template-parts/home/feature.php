<?php
/**
 * Homepage feature split — thuisbatterij, with an energy-dashboard mock.
 *
 * @package Voltalux
 */

$image   = apply_filters( 'voltalux_home_feature_image', '' );
$eyebrow = apply_filters( 'voltalux_home_feature_eyebrow', __( 'De thuisbatterij die bespaart én verdient', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_feature_title', __( "Sla je stroom op en gebruik 'm wanneer jij wilt", 'voltalux' ) );
$text    = apply_filters( 'voltalux_home_feature_text', __( "Haal alles uit je zonnepanelen: sla overdag op en gebruik 's avonds — of speel slim in op de energieprijzen. Zo word je minder afhankelijk van het net.", 'voltalux' ) );

$points = apply_filters(
	'voltalux_home_feature_points',
	array(
		__( 'Direct besparen op je energierekening', 'voltalux' ),
		__( 'Klaar voor het einde van de salderingsregeling', 'voltalux' ),
		__( 'Bescherming tegen stroomuitval', 'voltalux' ),
		__( 'Slim opladen op de goedkoopste momenten', 'voltalux' ),
	)
);

$bars = array( 30, 45, 38, 60, 52, 80, 70, 95, 64, 48 );
?>
<section class="vlx-section vlx-bg-surface" style="border-block:1px solid var(--line-2)" id="thuisbatterij">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-split vlx-split--rev">
			<div class="vlx-split__media vlx-reveal">
				<?php if ( $image ) : ?>
					<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" style="border-radius:var(--r-card);aspect-ratio:4/3.4;object-fit:cover;width:100%;" loading="lazy">
				<?php else : ?>
					<div class="vlx-panel">
						<div class="vlx-panel__grid"></div>
						<div class="vlx-panel__row"><span class="vlx-panel__label"><?php esc_html_e( 'Live · thuisbatterij', 'voltalux' ); ?></span><span class="vlx-panel__dot"></span></div>
						<div class="vlx-panel__big"><b>78%</b><span><?php esc_html_e( 'Opgeladen — 8,4 kWh', 'voltalux' ); ?></span></div>
						<div class="vlx-panel__bars">
							<?php foreach ( $bars as $h ) : ?>
								<i class="<?php echo $h > 65 ? 'on' : ''; ?>" style="height:<?php echo (int) $h; ?>%"></i>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="vlx-split__body vlx-reveal">
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
				<h2 style="margin-top:1.1rem"><?php echo esc_html( $title ); ?></h2>
				<?php if ( $text ) : ?><p class="vlx-lead" style="margin-top:1rem"><?php echo esc_html( $text ); ?></p><?php endif; ?>
				<?php if ( ! empty( $points ) ) : ?>
					<ul class="vlx-split__list">
						<?php foreach ( $points as $point ) : ?>
							<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><span><?php echo esc_html( $point ); ?></span></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<div style="margin-top:1.9rem">
					<?php voltalux_button( array( 'label' => __( 'Meer over de thuisbatterij', 'voltalux' ), 'url' => '#contact', 'style' => 'dark' ) ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
