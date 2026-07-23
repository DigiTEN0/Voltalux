<?php
/**
 * Homepage services — "Onze diensten".
 *
 * @package Voltalux
 */

$eyebrow  = apply_filters( 'voltalux_home_services_eyebrow', __( 'Onze diensten', 'voltalux' ) );
$title    = apply_filters( 'voltalux_home_services_title', __( 'Alles voor een duurzaam huis, onder één dak', 'voltalux' ) );
$intro    = apply_filters( 'voltalux_home_services_intro', __( 'Duurzaam én comfortabel wonen voor iedereen bereikbaar maken. Maak kennis met ons A-merk assortiment.', 'voltalux' ) );
$services = voltalux_services();

if ( empty( $services ) ) {
	return;
}
?>
<section class="vlx-section vlx-bg-surface" style="border-block:1px solid var(--line-2)" id="diensten">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal">
			<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
			<h2><?php echo esc_html( $title ); ?></h2>
		</div>

		<div class="vlx-services">
			<?php foreach ( $services as $s ) : ?>
				<article class="vlx-service vlx-reveal">
					<div class="vlx-service__icon"><?php echo voltalux_icon( $s['icon'] ); // phpcs:ignore ?></div>
					<h3><?php echo esc_html( $s['name'] ); ?></h3>
					<p><?php echo esc_html( $s['desc'] ); ?></p>
					<span class="vlx-arrow-link"><?php esc_html_e( 'Meer informatie', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
					<a class="vlx-service__link" href="<?php echo esc_url( $s['url'] ); ?>" aria-label="<?php echo esc_attr( $s['name'] ); ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
