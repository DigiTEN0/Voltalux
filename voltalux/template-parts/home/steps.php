<?php
/**
 * Homepage werkwijze — numbered steps.
 *
 * @package Voltalux
 */

$eyebrow = apply_filters( 'voltalux_home_steps_eyebrow', __( 'Werkwijze', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_steps_title', __( 'Van advies tot jarenlang zorgeloos besparen', 'voltalux' ) );

$steps = apply_filters(
	'voltalux_home_steps',
	array(
		array( 'title' => __( 'Adviesgesprek', 'voltalux' ), 'text' => __( 'We brengen jouw verbruik, dak en wensen in kaart — eerlijk en vrijblijvend.', 'voltalux' ) ),
		array( 'title' => __( 'Voorstel op maat', 'voltalux' ), 'text' => __( 'Een helder plan met het juiste systeem, de opbrengst en de terugverdientijd.', 'voltalux' ) ),
		array( 'title' => __( 'Installatie', 'voltalux' ), 'text' => __( 'Gecertificeerde monteurs plaatsen je systeem netjes en volgens de normen.', 'voltalux' ) ),
		array( 'title' => __( 'Nazorg & monitoring', 'voltalux' ), 'text' => __( 'We monitoren je systeem en staan klaar met onderhoud en garantie.', 'voltalux' ) ),
	)
);

if ( empty( $steps ) ) {
	return;
}
?>
<section class="vlx-section" id="werkwijze">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal">
			<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
			<h2><?php echo esc_html( $title ); ?></h2>
		</div>
		<div class="vlx-steps">
			<?php
			$i = 0;
			foreach ( $steps as $step ) :
				$i++;
				?>
				<div class="vlx-step vlx-reveal">
					<div class="vlx-step__n"><?php echo esc_html( sprintf( '%02d', $i ) ); ?> — <?php esc_html_e( 'Stap', 'voltalux' ); ?></div>
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
