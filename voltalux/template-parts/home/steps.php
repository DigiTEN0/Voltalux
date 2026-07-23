<?php
/**
 * Homepage werkwijze — 6-step process.
 *
 * @package Voltalux
 */

$eyebrow = apply_filters( 'voltalux_home_steps_eyebrow', __( 'Onze werkwijze', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_steps_title', __( 'Van eerste gesprek tot jarenlange nazorg', 'voltalux' ) );
$phone   = voltalux_option( 'phone', VOLTALUX_PHONE );

$steps = apply_filters(
	'voltalux_home_steps',
	array(
		array( 'title' => __( 'Kennismaking', 'voltalux' ),          'text' => __( 'We luisteren naar jouw behoeften, doelen en verwachtingen — telefonisch of bij je thuis.', 'voltalux' ) ),
		array( 'title' => __( 'Ontwerp en plan', 'voltalux' ),       'text' => __( 'Onze experts werken de beste duurzame oplossing uit voor jouw specifieke situatie.', 'voltalux' ) ),
		array( 'title' => __( 'Voorbereiding', 'voltalux' ),         'text' => __( 'We stellen een gedetailleerd actieplan op, verzamelen de materialen en plannen de uitvoering in.', 'voltalux' ) ),
		array( 'title' => __( 'Uitvoering', 'voltalux' ),            'text' => __( 'Onze ervaren, erkende installateurs zorgen voor een professionele installatie volgens de hoogste normen.', 'voltalux' ) ),
		array( 'title' => __( 'Controle en oplevering', 'voltalux' ),'text' => __( 'Kwaliteitscontroles en tests. Pas als alles naar behoren werkt, leveren we op — en pas dan factureren we.', 'voltalux' ) ),
		array( 'title' => __( 'Service en nazorg', 'voltalux' ),     'text' => __( 'Ook na oplevering staan we paraat voor vragen, aanpassingen of storingen — op afstand en op locatie.', 'voltalux' ) ),
	)
);

if ( empty( $steps ) ) {
	return;
}
?>
<section class="vlx-section" id="werkwijze">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head-row vlx-reveal">
			<div class="vlx-s-head">
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			</div>
			<?php voltalux_button( array( 'label' => __( 'Mogelijkheden bespreken', 'voltalux' ), 'url' => '#contact', 'style' => 'dark', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
		</div>

		<div class="vlx-steps">
			<?php
			$i = 0;
			foreach ( $steps as $step ) :
				$i++;
				?>
				<div class="vlx-step vlx-reveal">
					<div class="vlx-step__n"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></div>
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
