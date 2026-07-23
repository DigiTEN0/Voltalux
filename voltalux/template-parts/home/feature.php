<?php
/**
 * Homepage feature split — why a home battery.
 *
 * @package Voltalux
 */

$image   = apply_filters( 'voltalux_home_feature_image', '' );
$eyebrow = apply_filters( 'voltalux_home_feature_eyebrow', __( 'De thuisbatterij die bespaart én verdient', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_feature_title', __( 'Sla je eigen stroom op en gebruik \'m wanneer jij wilt', 'voltalux' ) );
$text    = apply_filters( 'voltalux_home_feature_text', __( 'Met een thuisbatterij van Voltalux haal je alles uit je zonnepanelen. Sla overdag je opgewekte stroom op en gebruik die \'s avonds — of speel slim in op de energieprijzen. Zo word je minder afhankelijk van het net en de veranderende regelgeving.', 'voltalux' ) );

$points = apply_filters(
	'voltalux_home_feature_points',
	array(
		__( 'Direct besparen op je energierekening', 'voltalux' ),
		__( 'Klaar voor het einde van de salderingsregeling', 'voltalux' ),
		__( 'Bescherming tegen stroomuitval', 'voltalux' ),
		__( 'Slim opladen op de goedkoopste momenten', 'voltalux' ),
	)
);

$check = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>';
?>
<section class="vlx-section" id="thuisbatterij">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-split vlx-split--reverse">
			<div class="vlx-split__media vlx-reveal">
				<?php if ( $image ) : ?>
					<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
				<?php else : ?>
					<div class="vlx-split__media" style="aspect-ratio:5/4;border-radius:var(--vlx-radius-lg);background:linear-gradient(150deg,#0B0C0E 0%,#12281c 60%,#0f3d24 100%);display:grid;place-items:center;position:relative;overflow:hidden;">
						<span style="position:absolute;inset:auto -10% -30% -10%;height:70%;background:radial-gradient(60% 100% at 50% 100%,rgba(22,224,106,.5),transparent 70%);"></span>
						<img src="<?php echo esc_url( VOLTALUX_URI . 'assets/images/battery.svg' ); ?>" alt="" style="width:140px;height:auto;position:relative;filter:drop-shadow(0 20px 30px rgba(0,0,0,.4));" loading="lazy">
					</div>
				<?php endif; ?>
			</div>

			<div class="vlx-split__body vlx-reveal">
				<div class="vlx-head">
					<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
					<h2><?php echo esc_html( $title ); ?></h2>
					<?php if ( $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
				</div>

				<?php if ( ! empty( $points ) ) : ?>
					<ul class="vlx-split__list">
						<?php foreach ( $points as $point ) : ?>
							<li><?php echo $check; // phpcs:ignore ?><span><?php echo esc_html( $point ); ?></span></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<div style="margin-top:2rem;">
					<?php voltalux_button( array( 'label' => __( 'Meer over de thuisbatterij', 'voltalux' ), 'url' => '#contact', 'style' => 'dark' ) ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
