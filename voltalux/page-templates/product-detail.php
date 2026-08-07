<?php
/**
 * Template Name: Productpagina (merk)
 * Template Post Type: page
 *
 * Renders a full brand page (Fox ESS, AlphaESS, Sigenergy, Daikin, LG) in the
 * 13-step structure from the briefing. The brand is resolved from the page slug,
 * so one template drives every brand. Copy lives in inc/content-data.php and is
 * fully filterable. If the slug matches no brand, the page's own content shows.
 *
 * @package Voltalux
 */

get_header();

$vlx_slug = get_post_field( 'post_name', get_queried_object_id() );
$vlx_bat  = voltalux_batteries();
$vlx_air  = voltalux_aircos();
$brand    = isset( $vlx_bat[ $vlx_slug ] ) ? $vlx_bat[ $vlx_slug ] : ( isset( $vlx_air[ $vlx_slug ] ) ? $vlx_air[ $vlx_slug ] : null );

if ( ! $brand ) :
	// Unknown slug — behave like a normal page.
	while ( have_posts() ) :
		the_post();
		voltalux_page_hero( array( 'eyebrow' => get_bloginfo( 'name' ), 'title' => get_the_title() ) );
		echo '<div class="vlx-section vlx-container"><div class="vlx-layout vlx-layout--single"><div class="vlx-prose">';
		the_content();
		echo '</div></div></div>';
	endwhile;
	get_footer();
	return;
endif;

$is_bat    = 'batterij' === $brand['kind'];
$overview  = $is_bat ? voltalux_page_link( 'thuisbatterij' ) : voltalux_page_link( 'aircos' );
$over_lbl  = $is_bat ? __( 'Thuisbatterijen', 'voltalux' ) : __( 'Airconditioning', 'voltalux' );
$kind_lbl  = $is_bat ? __( 'Thuisbatterij', 'voltalux' ) : __( 'Airco', 'voltalux' );
$phone     = voltalux_option( 'phone', VOLTALUX_PHONE );
$match     = $is_bat ? 'batter' : 'airco';

voltalux_schema_product( $brand );

voltalux_page_hero(
	array(
		'crumbs'  => array(
			array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ),
			array( 'label' => $over_lbl, 'url' => $overview ),
			array( 'label' => $brand['name'] ),
		),
		'eyebrow' => $kind_lbl . ( ! empty( $brand['badge'] ) ? ' · ' . $brand['badge'] : '' ),
		'title'   => $brand['name'],
		'lead'    => $brand['oneliner'],
		'icon'    => $is_bat ? 'battery' : 'snow',
		'flush'   => true,
	)
);
?>

<div class="vlx-keypoints-wrap vlx-container vlx-container--wide">
	<?php voltalux_keypoints_bar(); ?>
</div>

<?php /* 4. Uitleg in gewone taal */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-prod-intro vlx-reveal">
			<div class="vlx-prod-intro__lead">
					<?php voltalux_eyebrow( sprintf( __( 'Over %s', 'voltalux' ), $brand['name'] ) ); ?>
					<p class="vlx-prod-intro__oneliner"><?php echo esc_html( $brand['oneliner'] ); ?></p>
					<p class="vlx-lead"><?php echo esc_html( $brand['intro'] ); ?></p>
				</div>
				<figure class="vlx-prod-intro__figure">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large', array( 'class' => 'vlx-prod-intro__img', 'loading' => 'lazy' ) ); ?>
					<?php else : ?>
						<div class="vlx-prod-intro__ph" aria-hidden="true">
							<span class="vlx-prod-intro__ph-ic"><?php echo voltalux_icon( $is_bat ? 'battery' : 'snow' ); // phpcs:ignore ?></span>
							<span class="vlx-prod-intro__ph-name"><?php echo esc_html( $brand['name'] ); ?></span>
						</div>
						<?php if ( current_user_can( 'edit_pages' ) ) : ?>
							<span class="vlx-prod-intro__hint"><?php esc_html_e( 'Voeg hier je eigen foto toe via Pagina’s → deze pagina → Uitgelichte afbeelding.', 'voltalux' ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( ! empty( $brand['badge'] ) ) : ?>
						<figcaption class="vlx-prod-intro__tag"><?php echo esc_html( $brand['badge'] ); ?></figcaption>
					<?php endif; ?>
				</figure>
		</div>
	</div>
</section>

<?php /* 3. Voor wie wel / niet */ ?>
<?php if ( ! empty( $brand['for'] ) || ! empty( $brand['not_for'] ) ) : ?>
	<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-s-head vlx-reveal" style="margin-bottom:2.4rem">
				<?php voltalux_eyebrow( __( 'Past dit bij jou?', 'voltalux' ) ); ?>
				<h2><?php printf( esc_html__( 'Is %s de juiste keuze?', 'voltalux' ), esc_html( $brand['name'] ) ); ?></h2>
			</div>
			<div class="vlx-reveal"><?php voltalux_for_whom( $brand['for'], $brand['not_for'] ); ?></div>
		</div>
	</section>
<?php endif; ?>

<?php /* 5. Modellen */ ?>
<?php if ( ! empty( $brand['models']['rows'] ) ) : ?>
	<section class="vlx-section vlx-section--sm">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
				<?php voltalux_eyebrow( __( 'Modellen', 'voltalux' ) ); ?>
				<h2><?php esc_html_e( 'Modellen en configuraties', 'voltalux' ); ?></h2>
			</div>
			<div class="vlx-reveal"><?php voltalux_models_table( $brand['models'], sprintf( __( 'Modellen %s', 'voltalux' ), $brand['name'] ) ); ?></div>
		</div>
	</section>
<?php endif; ?>

<?php /* 6. Specificaties (batterij) of Techniek (airco) */ ?>
<?php if ( ! empty( $brand['specs'] ) ) : ?>
	<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
				<?php voltalux_eyebrow( __( 'Specificaties', 'voltalux' ) ); ?>
				<h2><?php esc_html_e( 'De techniek op een rij', 'voltalux' ); ?></h2>
				<p><?php esc_html_e( 'Alle specificaties zijn gecontroleerd in juli 2026. Bij twijfel checken we het actuele datasheet.', 'voltalux' ); ?></p>
			</div>
			<div class="vlx-reveal"><?php voltalux_spec_list( $brand['specs'] ); ?></div>
		</div>
	</section>
<?php endif; ?>

<?php if ( ! empty( $brand['tech'] ) ) : ?>
	<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
				<?php voltalux_eyebrow( __( 'Techniek', 'voltalux' ) ); ?>
				<h2><?php esc_html_e( 'De techniek uitgelegd', 'voltalux' ); ?></h2>
			</div>
			<div class="vlx-techlist<?php echo ( count( $brand['tech'] ) === 1 ) ? ' vlx-techlist--single' : ''; ?>">
					<?php foreach ( $brand['tech'] as $t ) : ?>
						<article class="vlx-techitem vlx-reveal">
							<span class="vlx-techitem__ic"><?php echo voltalux_icon( voltalux_tech_icon( $t[0] ) ); // phpcs:ignore ?></span>
							<h3><?php echo esc_html( $t[0] ); ?></h3>
							<p><?php echo esc_html( $t[1] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
		</div>
	</section>
<?php endif; ?>

<?php /* 8. Verbatim client blocks (letterlijk over te nemen) */ ?>
<?php if ( ! empty( $brand['blocks'] ) ) : ?>
	<section class="vlx-section vlx-section--sm">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-callouts">
				<?php foreach ( $brand['blocks'] as $b ) : ?>
					<div class="vlx-callout vlx-reveal">
						<span class="vlx-callout__ic"><?php echo voltalux_icon( 'spark' ); // phpcs:ignore ?></span>
						<div>
							<h3><?php echo esc_html( $b['title'] ); ?></h3>
							<p><?php echo esc_html( $b['text'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php /* 7. Prijs */ ?>
<?php if ( ! empty( $brand['price'] ) ) : ?>
	<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-price vlx-reveal">
				<div>
					<?php voltalux_eyebrow( __( 'Wat het kost', 'voltalux' ) ); ?>
					<h2 style="margin:1rem 0"><?php printf( esc_html__( 'De prijs van %s', 'voltalux' ), esc_html( $brand['name'] ) ); ?></h2>
					<p><?php echo esc_html( $brand['price'] ); ?></p>
				</div>
				<div class="vlx-price__aside">
					<span class="vlx-price__label"><?php esc_html_e( 'Altijd all-in', 'voltalux' ); ?></span>
					<p class="vlx-price__note"><?php esc_html_e( 'Installatie, keuring en inbedrijfstelling inbegrepen. Geen nacalculatie.', 'voltalux' ); ?></p>
					<?php voltalux_button( array( 'label' => __( 'Vraag een prijsopgave', 'voltalux' ), 'url' => '#contact', 'style' => 'dark', 'class' => 'vlx-btn--block', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php /* 9 + 10. Combineren + veiligheid/garantie/onderhoud */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-values">
			<?php if ( $is_bat ) : ?>
				<div class="vlx-value vlx-reveal"><div class="vlx-value__icon"><?php echo voltalux_icon( 'layers' ); // phpcs:ignore ?></div><h3><?php esc_html_e( 'Combineren', 'voltalux' ); ?></h3><p><?php esc_html_e( 'Werkt samen met je zonnepanelen, laadpaal en warmtepomp. We stemmen de capaciteit af op je totale verbruik, nu en de komende jaren.', 'voltalux' ); ?></p></div>
				<div class="vlx-value vlx-reveal"><div class="vlx-value__icon"><?php echo voltalux_icon( 'shield' ); // phpcs:ignore ?></div><h3><?php esc_html_e( 'Veiligheid & garantie', 'voltalux' ); ?></h3><p><?php esc_html_e( 'Veilige, kobaltvrije LiFePO4-cellen, CE-gecertificeerd en conform EN/IEC 62619. Garantiezaken handelen wij zelf voor je af.', 'voltalux' ); ?></p></div>
				<div class="vlx-value vlx-reveal"><div class="vlx-value__icon"><?php echo voltalux_icon( 'headset' ); // phpcs:ignore ?></div><h3><?php esc_html_e( 'App & nazorg', 'voltalux' ); ?></h3><p><?php esc_html_e( 'Volg je opbrengst en verbruik in de app. Na installatie kijken we mee in de monitoring en heb je één vaste contactpersoon.', 'voltalux' ); ?></p></div>
			<?php else : ?>
				<div class="vlx-value vlx-reveal"><div class="vlx-value__icon"><?php echo voltalux_icon( 'heat' ); // phpcs:ignore ?></div><h3><?php esc_html_e( 'Koelen én verwarmen', 'voltalux' ); ?></h3><p><?php esc_html_e( 'Een split-airco is een lucht-luchtwarmtepomp: koel in de zomer, en goedkope warmte in het tussenseizoen. Met zonnepanelen koel je op je eigen stroom.', 'voltalux' ); ?></p></div>
				<div class="vlx-value vlx-reveal"><div class="vlx-value__icon"><?php echo voltalux_icon( 'shield' ); // phpcs:ignore ?></div><h3><?php esc_html_e( 'F-gassen & garantie', 'voltalux' ); ?></h3><p><?php esc_html_e( 'Installatie uitsluitend door onze F-gassen-gecertificeerde monteurs. Zo blijft je garantie geldig en werkt het systeem zoals het hoort.', 'voltalux' ); ?></p></div>
				<div class="vlx-value vlx-reveal"><div class="vlx-value__icon"><?php echo voltalux_icon( 'clock' ); // phpcs:ignore ?></div><h3><?php esc_html_e( 'Onderhoud', 'voltalux' ); ?></h3><p><?php esc_html_e( 'Een airco vraagt jaarlijks onderhoud: filters, koudemiddeldruk en de buitenunit. Wij bieden hiervoor een onderhoudscontract.', 'voltalux' ); ?></p></div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php /* 11. FAQ */ ?>
<?php if ( ! empty( $brand['faq'] ) ) : ?>
	<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
		<div class="vlx-container">
			<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
				<?php voltalux_eyebrow( __( 'Veelgestelde vragen', 'voltalux' ) ); ?>
				<h2><?php printf( esc_html__( 'Vragen over %s', 'voltalux' ), esc_html( $brand['name'] ) ); ?></h2>
			</div>
			<div class="vlx-reveal"><?php voltalux_faq_block( $brand['faq'] ); ?></div>
		</div>
	</section>
<?php endif; ?>

<?php /* 12. Projectfoto's van dit merk */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head-row vlx-reveal" style="margin-bottom:2.2rem">
			<div class="vlx-s-head">
				<?php voltalux_eyebrow( __( 'Uit de praktijk', 'voltalux' ) ); ?>
				<h2><?php esc_html_e( 'Recent uitgevoerd', 'voltalux' ); ?></h2>
			</div>
			<?php voltalux_button( array( 'label' => __( 'Alle projecten', 'voltalux' ), 'url' => voltalux_page_link( 'onze-projecten' ), 'style' => 'ghost' ) ); ?>
		</div>
		<div class="vlx-reveal"><?php voltalux_project_strip( $match ); ?></div>
	</div>
</section>

<?php /* 13. CTA */ ?>
<?php voltalux_cta_band(); ?>

<?php get_footer(); ?>
