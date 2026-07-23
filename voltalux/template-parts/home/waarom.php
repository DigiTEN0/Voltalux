<?php
/**
 * Homepage value props — "Waarom Voltalux".
 *
 * @package Voltalux
 */

$eyebrow = apply_filters( 'voltalux_home_waarom_eyebrow', __( 'Waarom Voltalux', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_waarom_title', __( 'Kwaliteit, zekerheid en één aanspreekpunt', 'voltalux' ) );

$values = apply_filters(
	'voltalux_home_values',
	array(
		array( 'icon' => 'shield', 'title' => __( 'Eigen erkende installateurs', 'voltalux' ), 'text' => __( 'Gecertificeerde experts in eigen dienst — voor betrouwbaarheid van begin tot eind.', 'voltalux' ) ),
		array( 'icon' => 'medal',  'title' => __( 'A-merken tegen scherpe tarieven', 'voltalux' ), 'text' => __( 'Alleen de beste merken zijn goed genoeg. Kwaliteit gecombineerd met toegankelijkheid.', 'voltalux' ) ),
		array( 'icon' => 'layers', 'title' => __( 'Eén organisatie, één aanspreekpunt', 'voltalux' ), 'text' => __( 'Alles onder één dak voor al jouw verduurzamingsbehoeften. Helder en overzichtelijk.', 'voltalux' ) ),
	)
);

if ( empty( $values ) ) {
	return;
}
?>
<section class="vlx-section" id="waarom">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal">
			<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
			<h2><?php echo esc_html( $title ); ?></h2>
		</div>
		<div class="vlx-values">
			<?php foreach ( $values as $v ) : ?>
				<div class="vlx-value vlx-reveal">
					<div class="vlx-value__icon"><?php echo voltalux_icon( $v['icon'] ); // phpcs:ignore ?></div>
					<h3><?php echo esc_html( $v['title'] ); ?></h3>
					<p><?php echo esc_html( $v['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
