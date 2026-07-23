<?php
/**
 * Homepage intro — "Welkom bij Voltalux".
 *
 * @package Voltalux
 */

$eyebrow = apply_filters( 'voltalux_home_welkom_eyebrow', __( 'Welkom bij Voltalux', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_welkom_title', __( 'Alles onder één dak, van advies tot nazorg', 'voltalux' ) );
$text1   = apply_filters( 'voltalux_home_welkom_text1', __( 'Wij zijn de specialist in verduurzaming en bieden een alles-in-één oplossing voor het verduurzamen van jouw woning of bedrijfspand. Van zonnepanelen en thuisbatterijen tot airco\'s, warmtepompen en dakrenovaties.', 'voltalux' ) );
$text2   = apply_filters( 'voltalux_home_welkom_text2', __( 'Bij elke installatie hoort ons gratis serviceteam. Vragen, wijzigingen of een storing na installatie? Wij lossen het snel en efficiënt op, zodat je zorgeloos kunt genieten.', 'voltalux' ) );
$phone   = voltalux_option( 'phone', VOLTALUX_PHONE );

$points = apply_filters(
	'voltalux_home_welkom_points',
	array(
		__( 'Adviesgesprek op maat en op locatie', 'voltalux' ),
		__( 'Binnen 3 weken geïnstalleerd', 'voltalux' ),
		__( 'Geen betalingen vooraf', 'voltalux' ),
	)
);
?>
<section class="vlx-section vlx-bg-surface" style="border-top:1px solid var(--line-2)" id="over-ons">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-welkom">
			<div class="vlx-welkom__body vlx-reveal">
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
				<h2 style="margin-top:1.25rem"><?php echo esc_html( $title ); ?></h2>
				<p class="vlx-lead"><?php echo esc_html( $text1 ); ?></p>
				<p style="color:var(--muted)"><?php echo esc_html( $text2 ); ?></p>
				<div class="vlx-welkom__actions">
					<?php voltalux_button( array( 'label' => __( 'Offerte aanvragen', 'voltalux' ), 'url' => '#contact', 'style' => 'dark', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
					<?php if ( $phone ) { voltalux_button( array( 'label' => __( 'Bel', 'voltalux' ) . ' ' . $phone, 'url' => 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ), 'style' => 'ghost', 'arrow' => false ) ); } ?>
				</div>
			</div>

			<aside class="vlx-highlight vlx-reveal">
				<div class="vlx-highlight__row">
					<div class="vlx-highlight__n">650<span>+</span></div>
					<div class="vlx-highlight__l"><?php esc_html_e( 'Woningen verduurzaamd door heel Nederland', 'voltalux' ); ?></div>
				</div>
				<ul class="vlx-highlight__list">
					<?php foreach ( $points as $p ) : ?>
						<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><span><?php echo esc_html( $p ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</aside>
		</div>
	</div>
</section>
