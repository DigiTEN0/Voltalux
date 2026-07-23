<?php
/**
 * Homepage statement — bold mission line with green highlight.
 *
 * @package Voltalux
 */

$statement = apply_filters(
	'voltalux_home_statement',
	__( 'Voltalux maakt jouw huis klaar voor de toekomst. Geen loze beloftes, maar eerlijk advies, vakkundige installatie en een thuisbatterij die écht [mark]bespaart[/mark].', 'voltalux' )
);
$link_label = apply_filters( 'voltalux_home_statement_link_label', __( 'Bekijk onze werkwijze', 'voltalux' ) );
$link_url   = apply_filters( 'voltalux_home_statement_link_url', '#werkwijze' );
?>
<section class="vlx-section vlx-section--tight">
	<div class="vlx-container">
		<div class="vlx-statement vlx-statement--wide vlx-reveal">
			<p class="vlx-statement__big"><?php echo wp_kses_post( do_shortcode( voltalux_mark_shortcode_content( $statement ) ) ); ?></p>
			<?php if ( $link_label ) : ?>
				<div style="margin-top:2rem;">
					<?php voltalux_button( array( 'label' => $link_label, 'url' => $link_url, 'style' => 'dark' ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
