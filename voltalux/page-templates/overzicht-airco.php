<?php
/**
 * Template Name: Overzicht airconditioning
 * Template Post Type: page
 *
 * Overview + comparison page for the airco brands (Daikin, LG).
 *
 * @package Voltalux
 */

get_header();

$aircos  = voltalux_aircos();
$compare = voltalux_airco_comparison();
$allin   = voltalux_airco_allin();
$links   = array();
foreach ( $aircos as $a ) {
	$links[ $a['name'] ] = voltalux_page_link( $a['slug'] );
}

voltalux_page_hero(
	array(
		'crumbs'  => array(
			array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ),
			array( 'label' => __( 'Airconditioning', 'voltalux' ) ),
		),
		'eyebrow' => __( 'Airconditioning', 'voltalux' ),
		'title'   => __( 'Koelen én [mark]verwarmen[/mark] met één systeem', 'voltalux' ),
		'icon'    => 'snow',
		'lead'    => __( 'Een moderne split-airco is een lucht-luchtwarmtepomp: hij koelt in de zomer en levert in het tussenseizoen goedkope warmte. Bij een SCOP van 5 krijg je voor elke kilowattuur stroom vijf kilowattuur warmte terug.', 'voltalux' ),
	)
);
?>

<?php /* Comparison table — directly under the intro */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
			<?php voltalux_eyebrow( __( 'De merken naast elkaar', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Daikin en LG vergeleken', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-reveal"><?php voltalux_compare_table( $compare, $links ); ?></div>
	</div>
</section>

<?php /* Brand cards */ ?>
<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-brandcards vlx-brandcards--2">
			<?php foreach ( $aircos as $a ) : ?>
				<article class="vlx-brandcard vlx-reveal">
					<span class="vlx-brandcard__badge"><?php echo esc_html( $a['badge'] ); ?></span>
					<h3><?php echo esc_html( $a['name'] ); ?></h3>
					<p><?php echo esc_html( $a['oneliner'] ); ?></p>
					<span class="vlx-arrow-link"><?php esc_html_e( 'Bekijk dit merk', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
					<a class="vlx-brandcard__link" href="<?php echo esc_url( voltalux_page_link( $a['slug'] ) ); ?>" aria-label="<?php echo esc_attr( $a['name'] ); ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* Sizing explainer */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-welkom">
			<div class="vlx-welkom__body vlx-reveal">
				<?php voltalux_eyebrow( __( 'Welk vermogen', 'voltalux' ) ); ?>
				<h2 style="margin-top:1.25rem"><?php esc_html_e( 'Het juiste vermogen is het halve werk', 'voltalux' ); ?></h2>
				<p class="vlx-lead"><?php esc_html_e( 'Vuistregel: reken op 60 tot 80 watt koelvermogen per kubieke meter ruimte-inhoud, en corrigeer voor zonbelasting, isolatie en glasoppervlak.', 'voltalux' ); ?></p>
				<p style="color:var(--muted)"><?php esc_html_e( 'Een te grote airco is niet beter: die schakelt te vaak aan en uit, ontvochtigt slecht en maakt meer geluid. Wij meten daarom altijd ter plaatse voordat we adviseren. Onthoud twee begrippen: SEER geeft aan hoe zuinig een airco koelt over een heel seizoen, SCOP doet hetzelfde voor verwarmen — hoe hoger, hoe beter.', 'voltalux' ); ?></p>
			</div>
			<div class="vlx-welkom__media vlx-reveal">
				<div class="vlx-note-card">
					<h3><?php esc_html_e( 'Wat zit er in de all-in prijs', 'voltalux' ); ?></h3>
					<ul class="vlx-checklist">
						<?php foreach ( $allin['in'] as $item ) : ?>
							<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><span><?php echo esc_html( $item ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<h3 style="margin-top:1.4rem"><?php esc_html_e( 'Wat er niet in zit', 'voltalux' ); ?></h3>
					<ul class="vlx-checklist vlx-checklist--no">
						<?php foreach ( $allin['out'] as $item ) : ?>
							<li><?php echo voltalux_icon( 'close' ); // phpcs:ignore ?><span><?php echo esc_html( $item ); ?></span></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<?php /* F-gassen note */ ?>
<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-top:1px solid var(--line-2)">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-callouts">
			<div class="vlx-callout vlx-reveal">
				<span class="vlx-callout__ic"><?php echo voltalux_icon( 'shield' ); // phpcs:ignore ?></span>
				<div>
					<h3><?php esc_html_e( 'Alleen door F-gassen-gecertificeerde monteurs', 'voltalux' ); ?></h3>
					<p><?php esc_html_e( 'Werken aan koudemiddelsystemen mag alleen door F-gassen-gecertificeerde monteurs. Wij zijn dat. Vraag hier bij elke aanbieder naar: installatie door een niet-gecertificeerde partij is niet toegestaan en kan je garantie kosten.', 'voltalux' ); ?></p>
				</div>
			</div>
			<div class="vlx-callout vlx-reveal">
				<span class="vlx-callout__ic"><?php echo voltalux_icon( 'clock' ); // phpcs:ignore ?></span>
				<div>
					<h3><?php esc_html_e( 'Jaarlijks onderhoud', 'voltalux' ); ?></h3>
					<p><?php esc_html_e( 'Een airco vraagt jaarlijks onderhoud: filters reinigen, koudemiddeldruk controleren en de buitenunit schoonmaken. Dat houdt het rendement op peil en is vaak een garantievoorwaarde. Wij bieden een onderhoudscontract vanaf [€ …] per jaar.', 'voltalux' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<?php voltalux_cta_band( array( 'title' => __( 'Vraag een airco-advies op maat aan', 'voltalux' ) ) ); ?>

<?php get_footer(); ?>
