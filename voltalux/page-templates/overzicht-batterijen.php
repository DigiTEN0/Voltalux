<?php
/**
 * Template Name: Overzicht thuisbatterijen
 * Template Post Type: page
 *
 * Overview + comparison page for the home-battery brands. Following the briefing:
 * the comparison table sits directly under the intro (visitors who arrive on a
 * brand name already know what a battery is), the "wat is een thuisbatterij"
 * explainer comes after, then the general FAQ.
 *
 * @package Voltalux
 */

get_header();

$batteries = voltalux_batteries();
$compare   = voltalux_battery_comparison();
$links     = array();
foreach ( $batteries as $b ) {
	$links[ $b['name'] ] = voltalux_page_link( $b['slug'] );
}

voltalux_page_hero(
	array(
		'crumbs'  => array(
			array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ),
			array( 'label' => __( 'Thuisbatterijen', 'voltalux' ) ),
		),
		'eyebrow' => __( 'Thuisbatterijen', 'voltalux' ),
		'title'   => __( 'De juiste thuisbatterij, [mark]eerlijk[/mark] vergeleken', 'voltalux' ),
		'icon'    => 'battery',
		'lead'    => __( 'Wij installeren alleen A-merk batterijen met veilige LiFePO4-cellen. Hieronder vergelijk je de merken die wij voeren — en welke het beste bij jouw verbruik past.', 'voltalux' ),
	)
);
?>

<?php /* Comparison table — directly under the intro */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
			<?php voltalux_eyebrow( __( 'De merken naast elkaar', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Fox ESS, AlphaESS en Sigenergy vergeleken', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-reveal"><?php voltalux_compare_table( $compare, $links ); ?></div>
		<p class="vlx-table-note vlx-reveal"><?php esc_html_e( 'Een vierde, herkenbaar merk voegen we binnenkort toe. Alle specificaties zijn gecontroleerd in juli 2026.', 'voltalux' ); ?></p>
	</div>
</section>

<?php /* Brand cards */ ?>
<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-brandcards">
			<?php foreach ( $batteries as $b ) : ?>
				<article class="vlx-brandcard vlx-reveal">
					<span class="vlx-brandcard__badge"><?php echo esc_html( $b['badge'] ); ?></span>
					<h3><?php echo esc_html( $b['name'] ); ?></h3>
					<p><?php echo esc_html( $b['oneliner'] ); ?></p>
					<span class="vlx-arrow-link"><?php esc_html_e( 'Bekijk dit merk', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
					<a class="vlx-brandcard__link" href="<?php echo esc_url( voltalux_page_link( $b['slug'] ) ); ?>" aria-label="<?php echo esc_attr( $b['name'] ); ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* Explainer — wat een thuisbatterij doet + saldering */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-welkom">
			<div class="vlx-welkom__body vlx-reveal">
				<?php voltalux_eyebrow( __( 'Waarom nu', 'voltalux' ) ); ?>
				<h2 style="margin-top:1.25rem"><?php esc_html_e( 'De salderingsregeling stopt per 1 januari 2027', 'voltalux' ); ?></h2>
				<p class="vlx-lead"><?php esc_html_e( 'Een thuisbatterij slaat de zonnestroom op die je overdag niet verbruikt, zodat je hem \'s avonds zelf gebruikt in plaats van hem voor een lage vergoeding aan het net te leveren.', 'voltalux' ); ?></p>
				<p style="color:var(--muted)"><?php esc_html_e( 'Tot en met 31 december 2026 mag je teruggeleverde stroom nog één op één wegstrepen tegen je verbruik. Daarna niet meer: je krijgt een terugleververgoeding, die tot 2030 wettelijk minimaal 50 procent van het kale leveringstarief moet zijn. Niet langer het aantal panelen bepaalt dan je energierekening, maar het moment waarop je je stroom gebruikt.', 'voltalux' ); ?></p>
				<div class="vlx-welkom__actions">
					<?php voltalux_button( array( 'label' => __( 'Bereken mijn besparing', 'voltalux' ), 'url' => '#contact', 'style' => 'dark', 'attrs' => array( 'data-vlx-hsc-open' => '1' ) ) ); ?>
				</div>
			</div>
			<div class="vlx-welkom__media vlx-reveal">
				<div class="vlx-note-card">
					<h3><?php esc_html_e( 'Nominaal versus bruikbaar', 'voltalux' ); ?></h3>
					<p><?php esc_html_e( 'Een batterij van 10 kWh nominaal levert geen 10 kWh bruikbaar. Bij een ontladingsdiepte van circa 90 procent blijft ongeveer 9 kWh over. Wij vermelden op elke offerte zowel de nominale als de bruikbare capaciteit.', 'voltalux' ); ?></p>
					<h3 style="margin-top:1.4rem"><?php esc_html_e( 'Altijd LiFePO4', 'voltalux' ); ?></h3>
					<p><?php esc_html_e( 'Alle drie de merken gebruiken lithium-ijzerfosfaat: de veiligste en meest stabiele lithiumchemie, kobaltvrij en thermisch stabiel.', 'voltalux' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<?php /* General FAQ */ ?>
<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-top:1px solid var(--line-2)">
	<div class="vlx-container">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
			<?php voltalux_eyebrow( __( 'Veelgestelde vragen', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Algemene vragen over thuisbatterijen', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-reveal"><?php voltalux_faq_block( voltalux_general_battery_faq() ); ?></div>
	</div>
</section>

<?php voltalux_cta_band(); ?>

<?php get_footer(); ?>
