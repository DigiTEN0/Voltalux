<?php
/**
 * Homepage stats band.
 *
 * @package Voltalux
 */

$stats = apply_filters(
	'voltalux_home_stats',
	array(
		array( 'n' => '2.500', 'u' => '+', 'l' => __( 'Tevreden klanten geholpen', 'voltalux' ) ),
		array( 'n' => '€900', 'u' => '', 'l' => __( 'Gem. besparing per jaar', 'voltalux' ) ),
		array( 'n' => '10', 'u' => ' jr', 'l' => __( 'Garantie op je batterij', 'voltalux' ) ),
		array( 'n' => '4.8', 'u' => '★', 'l' => __( 'Beoordeling via Google', 'voltalux' ) ),
	)
);

if ( empty( $stats ) ) {
	return;
}
?>
<section class="vlx-section--sm vlx-bg-ink">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-stats">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="vlx-stat vlx-reveal">
					<div class="vlx-stat__n"><?php echo esc_html( $stat['n'] ); ?><?php echo $stat['u'] ? '<span class="vlx-u">' . esc_html( $stat['u'] ) . '</span>' : ''; ?></div>
					<div class="vlx-stat__l"><?php echo esc_html( $stat['l'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
