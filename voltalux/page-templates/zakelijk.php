<?php
/**
 * Template Name: Zakelijk (containerbatterijen)
 * Template Post Type: page
 *
 * Business battery storage & container batteries. Commercially the most valuable
 * page: high order value, little good content at the competition. Copy from the
 * briefing (inc/content-data.php → voltalux_business_data()).
 *
 * @package Voltalux
 */

get_header();

$data  = voltalux_business_data();
$phone = voltalux_option( 'phone', VOLTALUX_PHONE );

voltalux_page_hero(
	array(
		'crumbs'  => array(
			array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ),
			array( 'label' => __( 'Zakelijk', 'voltalux' ) ),
		),
		'eyebrow' => __( 'Zakelijke batterijopslag', 'voltalux' ),
		'title'   => __( 'Doorgroeien zonder te wachten op [mark]netverzwaring[/mark]', 'voltalux' ),
		'icon'    => 'euro',
		'lead'    => $data['intro'],
	)
);
?>

<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2.4rem">
			<?php voltalux_eyebrow( __( 'Waarom bedrijven aankloppen', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Vier redenen voor batterijopslag', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-values">
			<?php foreach ( $data['reasons'] as $i => $r ) : ?>
				<div class="vlx-value vlx-reveal">
					<div class="vlx-value__icon"><?php echo voltalux_icon( $r['icon'] ); // phpcs:ignore ?></div>
					<h3><?php echo esc_html( $r['title'] ); ?></h3>
					<p><?php echo esc_html( $r['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* Business case */ ?>
<section class="vlx-section vlx-section--sm vlx-bg-ink" id="businesscase">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-welkom">
			<div class="vlx-welkom__body vlx-reveal">
				<?php voltalux_eyebrow( __( 'De businesscase', 'voltalux' ), true ); ?>
				<h2 style="margin-top:1.25rem"><?php esc_html_e( 'Drie getallen van je netbeheerderfactuur', 'voltalux' ); ?></h2>
				<p class="vlx-lead" style="color:var(--muted-inv)"><?php esc_html_e( 'Meer hebben we niet nodig voor een eerste doorrekening:', 'voltalux' ); ?></p>
				<ol class="vlx-numlist">
					<li><strong><?php esc_html_e( 'Contractwaarde in kW', 'voltalux' ); ?></strong><?php esc_html_e( ' — waar de aansluiting op is gedimensioneerd.', 'voltalux' ); ?></li>
					<li><strong><?php esc_html_e( 'Gerealiseerde kwartierpiek in kW', 'voltalux' ); ?></strong><?php esc_html_e( ' — het hoogste kwartiergemiddelde per maand.', 'voltalux' ); ?></li>
					<li><strong><?php esc_html_e( 'Piekduur in minuten', 'voltalux' ); ?></strong><?php esc_html_e( ' — typisch 15 tot 90 minuten per dag.', 'voltalux' ); ?></li>
				</ol>
				<p style="color:var(--muted-inv);font-size:.92rem"><?php esc_html_e( 'Terugverdientijden bij structurele pieken boven het contractvermogen liggen doorgaans tussen de drie en acht jaar. We rekenen altijd twee scenario\'s: één conservatief zonder handelsopbrengsten en één met. Komt het conservatieve scenario niet uit, dan zeggen we dat.', 'voltalux' ); ?></p>
			</div>
			<div class="vlx-welkom__media vlx-reveal">
				<div class="vlx-casecard">
					<span class="vlx-casecard__label"><?php esc_html_e( 'Rekenvoorbeeld', 'voltalux' ); ?></span>
					<dl>
						<div><dt><?php esc_html_e( 'Bedrijf', 'voltalux' ); ?></dt><dd><?php esc_html_e( '[type, bijv. metaalbewerking]', 'voltalux' ); ?></dd></div>
						<div><dt><?php esc_html_e( 'Contractwaarde', 'voltalux' ); ?></dt><dd>[160] kW</dd></div>
						<div><dt><?php esc_html_e( 'Gerealiseerde piek', 'voltalux' ); ?></dt><dd>[220] kW</dd></div>
						<div><dt><?php esc_html_e( 'Te shaven', 'voltalux' ); ?></dt><dd><?php esc_html_e( '[60] kW gedurende [45] min', 'voltalux' ); ?></dd></div>
						<div><dt><?php esc_html_e( 'Benodigd systeem', 'voltalux' ); ?></dt><dd>[…] kW / […] kWh</dd></div>
						<div><dt><?php esc_html_e( 'Investering', 'voltalux' ); ?></dt><dd>[€ …]</dd></div>
						<div><dt><?php esc_html_e( 'EIA-voordeel', 'voltalux' ); ?></dt><dd><?php esc_html_e( 'ca. 40% aftrek (± 10% van de investering aan belastingvoordeel)', 'voltalux' ); ?></dd></div>
						<div><dt><?php esc_html_e( 'Terugverdientijd', 'voltalux' ); ?></dt><dd>[…] <?php esc_html_e( 'jaar', 'voltalux' ); ?></dd></div>
					</dl>
				</div>
			</div>
		</div>
	</div>
</section>

<?php /* Cabinet vs container */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
			<?php voltalux_eyebrow( __( 'Kast of container', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Van een kast in de technische ruimte tot een container', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-reveal"><?php voltalux_compare_table( array( 'brands' => array_slice( $data['cabinet']['cols'], 1 ), 'rows' => $data['cabinet']['rows'] ) ); ?></div>
	</div>
</section>

<?php /* Sectors */ ?>
<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2.4rem">
			<?php voltalux_eyebrow( __( 'Voor welke sectoren', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Oplossingen per sector', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-sectors">
			<?php foreach ( $data['sectors'] as $s ) : ?>
				<div class="vlx-sector vlx-reveal">
					<span class="vlx-sector__ic"><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?></span>
					<p><?php echo esc_html( $s ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* Quickscan CTA (business-specific) */ ?>
<section class="vlx-section">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-offerte vlx-reveal">
			<div class="vlx-offerte__body">
				<?php voltalux_eyebrow( __( 'Concrete eerste stap', 'voltalux' ), true ); ?>
				<h2 style="margin-top:1rem"><?php esc_html_e( 'Gratis quickscan businesscase', 'voltalux' ); ?></h2>
				<p class="vlx-offerte__lead"><?php echo esc_html( $data['cta'] ); ?></p>
				<?php if ( $phone ) : ?>
					<a class="vlx-offerte__phone" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo voltalux_icon( 'phone' ); // phpcs:ignore ?><?php echo esc_html( __( 'Of bel', 'voltalux' ) . ' ' . $phone ); ?></a>
				<?php endif; ?>
			</div>
			<div class="vlx-offerte__card">
				<h3><?php esc_html_e( 'Vraag je quickscan aan', 'voltalux' ); ?></h3>
				<?php voltalux_form(); ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
