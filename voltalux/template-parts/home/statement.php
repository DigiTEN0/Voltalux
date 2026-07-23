<?php
/**
 * Homepage statement — editorial two-column.
 *
 * @package Voltalux
 */

$big  = apply_filters( 'voltalux_home_statement', __( 'Voltalux maakt jouw huis klaar voor de toekomst — geen loze beloftes, maar eerlijk advies en een systeem dat écht [mark]bespaart[/mark].', 'voltalux' ) );
$side = apply_filters( 'voltalux_home_statement_side', __( 'Onafhankelijk, betrouwbaar en volledig op maat. Van het eerste gesprek tot de oplevering en de jaren daarna staan we naast je.', 'voltalux' ) );
$link_label = apply_filters( 'voltalux_home_statement_link_label', __( 'Bekijk onze werkwijze', 'voltalux' ) );
$link_url   = apply_filters( 'voltalux_home_statement_link_url', '#werkwijze' );
?>
<section class="vlx-section">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-statement vlx-reveal">
			<p class="vlx-statement__big"><?php echo wp_kses_post( do_shortcode( voltalux_mark_shortcode_content( $big ) ) ); ?></p>
			<div class="vlx-statement__side">
				<?php if ( $side ) : ?><p><?php echo esc_html( $side ); ?></p><?php endif; ?>
				<?php if ( $link_label ) : ?>
					<a class="vlx-arrow-link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_label ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
