<?php
/**
 * Template Name: Over ons
 * Template Post Type: page
 *
 * @package Voltalux
 */

get_header();

$phone = voltalux_option( 'phone', VOLTALUX_PHONE );
$tel   = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );

ob_start();
voltalux_button( array( 'label' => __( 'Gratis adviesgesprek', 'voltalux' ), 'url' => voltalux_page_link( 'contact' ), 'style' => 'primary', 'size' => 'lg', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) );
if ( $phone ) {
	voltalux_button( array( 'label' => __( 'Bel', 'voltalux' ) . ' ' . $phone, 'url' => $tel, 'style' => 'ghost', 'size' => 'lg', 'arrow' => false ) );
}
$hero_cta = ob_get_clean();

ob_start();
if ( has_post_thumbnail() ) {
	the_post_thumbnail( 'large', array( 'class' => 'vlx-hero-figure__img', 'loading' => 'eager' ) );
} else {
	?>
	<div class="vlx-hero-figure__ph" aria-hidden="true">
		<span class="vlx-hero-figure__ic"><?php echo voltalux_icon( 'leaf' ); // phpcs:ignore ?></span>
		<span class="vlx-hero-figure__name"><?php esc_html_e( 'Over Voltalux', 'voltalux' ); ?></span>
	</div>
	<?php
}
$hero_media = '<figure class="vlx-hero-figure">' . ob_get_clean() . '</figure>';

voltalux_page_hero(
	array(
		'crumbs'  => array( array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ), array( 'label' => __( 'Over ons', 'voltalux' ) ) ),
		'eyebrow' => __( 'Over Voltalux', 'voltalux' ),
		'title'   => __( 'Samen naar een [mark]duurzamer[/mark] huis', 'voltalux' ),
		'lead'    => __( 'Welkom bij Voltalux — jouw partner in zonnepanelen, thuisbatterijen, airco\'s, warmtepompen en dakrenovatie. Ons team gelooft in de kracht van de zon en helpt je bij een soepele overstap naar duurzame energie.', 'voltalux' ),
		'icon'    => 'leaf',
		'media'   => $hero_media,
		'cta'     => $hero_cta,
		'flush'   => true,
	)
);
?>

<?php /* Social-proof cijferband */ ?>
<section class="vlx-section vlx-section--sm" style="padding-top:clamp(2.6rem,2rem+2vw,3.6rem);padding-bottom:0">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-statband vlx-reveal">
			<span class="vlx-statband__glow" aria-hidden="true"></span>
			<div class="vlx-statband__grid">
				<?php
				$rating = str_replace( '.', ',', (string) voltalux_option( 'google_rating', VOLTALUX_GOOGLE_RATING ) );
				$stats  = array(
					array( '650<span>+</span>', __( 'woningen verduurzaamd', 'voltalux' ) ),
					array( '7<span>+</span>', __( 'jaar branche-ervaring', 'voltalux' ) ),
					array( esc_html( $rating ) . '<span>/5</span>', sprintf( /* translators: %s review count */ __( 'uit %s Google-reviews', 'voltalux' ), esc_html( voltalux_option( 'google_count', VOLTALUX_GOOGLE_COUNT ) ) ) ),
					array( __( 'Eén', 'voltalux' ) . '<span>&nbsp;aanspreekpunt</span>', __( 'alles onder één dak', 'voltalux' ) ),
				);
				foreach ( $stats as $st ) : ?>
					<div class="vlx-statband__item">
						<div class="vlx-statband__n"><?php echo wp_kses_post( $st[0] ); ?></div>
						<div class="vlx-statband__l"><?php echo esc_html( $st[1] ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php /* Missie — 2-koloms */ ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-richsplit vlx-reveal">
			<div class="vlx-richsplit__head">
				<?php voltalux_eyebrow( __( 'Onze missie', 'voltalux' ) ); ?>
				<h2><?php esc_html_e( 'Duurzame energie, voor iedereen bereikbaar', 'voltalux' ); ?></h2>
				<a class="vlx-inline-cta" href="<?php echo esc_url( voltalux_page_link( 'contact' ) ); ?>" data-vlx-open="offerte"><?php esc_html_e( 'Plan een adviesgesprek', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
			</div>
			<div class="vlx-richsplit__body">
				<p class="vlx-richsplit__lead"><?php esc_html_e( 'Bij Voltalux zijn we toegewijd aan duurzame energieoplossingen en helpen we je aan een groenere, comfortabelere woning.', 'voltalux' ); ?></p>
				<p><?php esc_html_e( 'We geloven dat zonne-energie essentieel is voor de overgang naar een schonere, hernieuwbare toekomst. Daarom bieden we hoogwaardige zonnepanelen en energieopslag die betrouwbaar, efficiënt én betaalbaar zijn.', 'voltalux' ); ?></p>
				<p><?php esc_html_e( 'Ons team van deskundige professionals heeft ruime ervaring in de branche en diepgaande kennis van de nieuwste technologie. We werken samen met gerenommeerde fabrikanten, zodat we producten leveren die voldoen aan de hoogste eisen op het gebied van prestatie, betrouwbaarheid en duurzaamheid.', 'voltalux' ); ?></p>
			</div>
		</div>
	</div>
</section>

<?php /* Waarom Voltalux — kaarten */ ?>
<section class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-s-head--center vlx-reveal">
			<?php voltalux_eyebrow( __( 'Waarom Voltalux', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Waarom klanten voor ons kiezen', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-values" style="margin-top:2.4rem">
			<?php
			$why = array(
				array( 'shield', __( 'Eigen erkende installateurs', 'voltalux' ), __( 'Gecertificeerde experts in eigen dienst — dat geeft betrouwbaarheid en één aanspreekpunt.', 'voltalux' ) ),
				array( 'euro', __( 'A-merken tegen scherpe tarieven', 'voltalux' ), __( 'Alleen de beste merken zijn goed genoeg — kwaliteit gecombineerd met toegankelijkheid.', 'voltalux' ) ),
				array( 'layers', __( 'Eén organisatie, één aanspreekpunt', 'voltalux' ), __( 'Alles onder één dak voor al je verduurzamingsbehoeften — van advies tot nazorg.', 'voltalux' ) ),
			);
			foreach ( $why as $w ) : ?>
				<div class="vlx-value vlx-reveal">
					<div class="vlx-value__icon"><?php echo voltalux_icon( $w[0] ); // phpcs:ignore ?></div>
					<h3><?php echo esc_html( $w[1] ); ?></h3>
					<p><?php echo esc_html( $w[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* Reviews */ ?>
<?php $vlx_badge = function_exists( 'voltalux_google_badge' ) ? voltalux_google_badge( false ) : ''; ?>
<?php if ( $vlx_badge ) : ?>
<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-reviewband vlx-reveal">
			<div>
				<?php voltalux_eyebrow( __( 'Onze reviews', 'voltalux' ) ); ?>
				<h2 style="margin-top:.8rem"><?php esc_html_e( 'Klanten waarderen onze aanpak', 'voltalux' ); ?></h2>
			</div>
			<?php echo $vlx_badge; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
voltalux_cta_band(
	array(
		'title' => __( 'Klaar om te verduurzamen?', 'voltalux' ),
		'text'  => __( 'Vraag een vrijblijvend adviesgesprek aan — binnen 24 uur nemen we contact met je op.', 'voltalux' ),
	)
);
?>

<?php get_footer(); ?>
