<?php
/**
 * Template Name: Werkwijze
 * Template Post Type: page
 *
 * "Zo werken wij" — the six-step process, four promises, certifications and
 * work area. Copy is verbatim from the briefing (inc/content-data.php).
 *
 * @package Voltalux
 */

get_header();

$steps    = voltalux_werkwijze_steps();
$promises = voltalux_promises();
$certs    = voltalux_certifications();
$areas    = function_exists( 'voltalux_work_area' ) ? voltalux_work_area() : array();

voltalux_page_hero(
	array(
		'crumbs'  => array(
			array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ),
			array( 'label' => __( 'Werkwijze', 'voltalux' ) ),
		),
		'eyebrow' => __( 'Zo werken wij', 'voltalux' ),
		'title'   => __( 'Van eerste gesprek tot oplevering — en daarna', 'voltalux' ),
		'icon'    => 'layers',
		'lead'    => __( 'We verkopen geen batterijen. We zorgen dat je energiehuishouding klopt, en soms betekent dat dat we adviseren om nog even te wachten of om kleiner te gaan dan je zelf in gedachten had. Dit is precies hoe het traject loopt, zodat je vooraf weet waar je aan toe bent.', 'voltalux' ),
	)
);
?>

<section class="vlx-section">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-steps">
			<?php $i = 0; foreach ( $steps as $step ) : $i++; ?>
				<div class="vlx-step vlx-reveal">
					<div class="vlx-step__n"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></div>
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2.4rem">
			<?php voltalux_eyebrow( __( 'Wat je van ons mag verwachten', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Vier beloftes waar we op afgerekend willen worden', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-promises">
			<?php foreach ( $promises as $p ) : ?>
				<div class="vlx-promise vlx-reveal">
					<span class="vlx-promise__ic"><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?></span>
					<p><?php echo esc_html( $p ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-welkom">
			<div class="vlx-welkom__body vlx-reveal">
				<?php voltalux_eyebrow( __( 'Certificeringen & garanties', 'voltalux' ) ); ?>
				<h2 style="margin-top:1.25rem"><?php esc_html_e( 'Gecertificeerd vakwerk, met garantie', 'voltalux' ); ?></h2>
				<p style="color:var(--muted)"><?php esc_html_e( 'Naast de fabrieksgaranties geven we onze eigen installatiegarantie. Onze certificeringen:', 'voltalux' ); ?></p>
				<div class="vlx-certs" style="margin-top:1.2rem">
					<?php foreach ( $certs as $c ) : ?>
						<span class="vlx-cert"><?php echo esc_html( $c ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="vlx-welkom__media vlx-reveal">
				<div class="vlx-note-card">
					<h3><?php esc_html_e( 'Ons werkgebied', 'voltalux' ); ?></h3>
					<p><?php esc_html_e( 'We installeren in en rond de volgende regio\'s:', 'voltalux' ); ?></p>
					<div class="vlx-certs" style="margin-top:1rem">
						<?php foreach ( $areas as $a ) : ?>
							<span class="vlx-cert"><?php echo voltalux_icon( 'pin' ); // phpcs:ignore ?><?php echo esc_html( $a ); ?></span>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php voltalux_cta_band(); ?>

<?php get_footer(); ?>
