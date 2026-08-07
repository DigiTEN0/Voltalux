<?php
/**
 * Template Name: Dienst (pillar)
 * Template Post Type: page
 *
 * One conversion-focused template that drives every service pillar
 * (Zonnepanelen, Airco's, Warmtepompen, …). The content is resolved from the
 * page slug via voltalux_service() (inc/services-content.php), so the same
 * layout serves every service while each keeps its own copy — and its own SEO.
 *
 * If the slug has no service data, the page falls back to its own content.
 *
 * @package Voltalux
 */

get_header();

$vlx_slug = get_post_field( 'post_name', get_queried_object_id() );
$svc      = function_exists( 'voltalux_service' ) ? voltalux_service( $vlx_slug ) : null;
$phone    = voltalux_option( 'phone', VOLTALUX_PHONE );
$tel      = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );

if ( ! $svc ) {
	while ( have_posts() ) :
		the_post();
		voltalux_page_hero( array( 'eyebrow' => get_bloginfo( 'name' ), 'title' => get_the_title() ) );
		echo '<div class="vlx-section vlx-container"><div class="vlx-prose">';
		the_content();
		echo '</div></div>';
	endwhile;
	get_footer();
	return;
}

/* Hero CTA (captured as HTML for the hero's cta slot). */
ob_start();
voltalux_button( array( 'label' => __( 'Gratis adviesgesprek', 'voltalux' ), 'url' => voltalux_page_link( 'contact' ), 'style' => 'primary', 'size' => 'lg', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) );
if ( $phone ) {
	voltalux_button( array( 'label' => __( 'Bel', 'voltalux' ) . ' ' . $phone, 'url' => $tel, 'style' => 'ghost', 'size' => 'lg', 'arrow' => false ) );
}
$hero_cta = ob_get_clean();

/* Hero media: the page's own featured image (uploadable), else a branded square. */
ob_start();
if ( has_post_thumbnail() ) {
	the_post_thumbnail( 'large', array( 'class' => 'vlx-hero-figure__img', 'loading' => 'eager' ) );
} else {
	?>
	<div class="vlx-hero-figure__ph" aria-hidden="true">
		<span class="vlx-hero-figure__ic"><?php echo voltalux_icon( isset( $svc['icon'] ) ? $svc['icon'] : 'spark' ); // phpcs:ignore ?></span>
		<span class="vlx-hero-figure__name"><?php echo esc_html( $svc['kind'] ); ?></span>
	</div>
	<?php
	if ( current_user_can( 'edit_pages' ) ) {
		echo '<span class="vlx-hero-figure__hint">' . esc_html__( 'Voeg hier je eigen foto toe via Pagina’s → deze pagina → Uitgelichte afbeelding.', 'voltalux' ) . '</span>';
	}
}
$hero_media = '<figure class="vlx-hero-figure">' . ob_get_clean() . '</figure>';

/* Breadcrumbs: Home → any parent pages → this page (so /dakdekker/dakisolatie/ reads correctly). */
$vlx_crumbs   = array( array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ) );
$vlx_ancestors = array_reverse( get_post_ancestors( get_queried_object_id() ) );
foreach ( $vlx_ancestors as $anc_id ) {
	$vlx_crumbs[] = array( 'label' => get_the_title( $anc_id ), 'url' => get_permalink( $anc_id ) );
}
$vlx_crumbs[] = array( 'label' => $svc['kind'] );

voltalux_page_hero(
	array(
		'crumbs' => $vlx_crumbs,
		'eyebrow' => $svc['eyebrow'],
		'title'   => $svc['h1'],
		'lead'    => $svc['lead'],
		'icon'    => isset( $svc['icon'] ) ? $svc['icon'] : '',
		'media'   => $hero_media,
		'cta'     => $hero_cta,
		'flush'   => true,
	)
);
?>

<?php /* USP trust bar overlapping the hero */ ?>
<?php if ( ! empty( $svc['usps'] ) ) : ?>
<div class="vlx-keypoints-wrap vlx-container vlx-container--wide">
	<div class="vlx-usps vlx-reveal">
		<?php foreach ( $svc['usps'] as $u ) : ?>
			<div class="vlx-usp">
				<span class="vlx-usp__ic"><?php echo voltalux_icon( $u['icon'] ); // phpcs:ignore ?></span>
				<div><h3><?php echo esc_html( $u['title'] ); ?></h3><p><?php echo esc_html( $u['text'] ); ?></p></div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>

<?php /* Jump navigation */ ?>
<section class="vlx-section vlx-section--sm" style="padding-bottom:0">
	<div class="vlx-container vlx-container--wide">
		<nav class="vlx-jumpnav vlx-reveal" aria-label="<?php esc_attr_e( 'Direct naar', 'voltalux' ); ?>">
			<span class="vlx-jumpnav__lbl"><?php esc_html_e( 'Direct naar', 'voltalux' ); ?></span>
			<?php if ( ! empty( $svc['how'] ) ) : ?><a href="#hoe-werkt-het"><?php esc_html_e( 'Hoe werkt het?', 'voltalux' ); ?></a><?php endif; ?>
				<?php if ( ! empty( $svc['links']['items'] ) ) : ?><a href="#werkzaamheden"><?php echo esc_html( ! empty( $svc['links']['title'] ) ? $svc['links']['title'] : __( 'Werkzaamheden', 'voltalux' ) ); ?></a><?php endif; ?>
			<?php if ( ! empty( $svc['voordelen'] ) ) : ?><a href="#voordelen"><?php esc_html_e( 'Voordelen', 'voltalux' ); ?></a><?php endif; ?>
			<?php if ( ! empty( $svc['brands'] ) ) : ?><a href="#merken"><?php esc_html_e( 'Onze merken', 'voltalux' ); ?></a><?php endif; ?>
			<?php if ( ! empty( $svc['saldering'] ) ) : ?><a href="#saldering"><?php esc_html_e( 'Salderingsregeling', 'voltalux' ); ?></a><?php endif; ?>
			<a href="#werkwijze"><?php esc_html_e( 'Werkwijze', 'voltalux' ); ?></a>
			<?php if ( ! empty( $svc['faq'] ) ) : ?><a href="#faq"><?php esc_html_e( 'Veelgestelde vragen', 'voltalux' ); ?></a><?php endif; ?>
		</nav>
	</div>
</section>

<?php /* How it works */ ?>
<?php if ( ! empty( $svc['how']['steps'] ) ) : ?>
<section id="hoe-werkt-het" class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:1rem">
			<?php voltalux_eyebrow( __( 'Hoe werkt het?', 'voltalux' ) ); ?>
			<h2><?php echo esc_html( $svc['how']['title'] ); ?></h2>
			<?php if ( ! empty( $svc['how']['lead'] ) ) : ?><p><?php echo esc_html( $svc['how']['lead'] ); ?></p><?php endif; ?>
		</div>
		<div class="vlx-steps vlx-steps--4">
			<?php $i = 0; foreach ( $svc['how']['steps'] as $st ) : $i++; ?>
				<div class="vlx-step vlx-reveal">
					<div class="vlx-step__n"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></div>
					<h3><?php echo esc_html( $st['title'] ); ?></h3>
					<p><?php echo esc_html( $st['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php /* Subservices / interne links (bv. dakdekker → dakwerkzaamheden) */ ?>
<?php if ( ! empty( $svc['links']['items'] ) ) : ?>
<section id="werkzaamheden" class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:1rem">
			<?php voltalux_eyebrow( __( 'Specialismen', 'voltalux' ) ); ?>
			<h2><?php echo esc_html( $svc['links']['title'] ); ?></h2>
			<?php if ( ! empty( $svc['links']['lead'] ) ) : ?><p><?php echo esc_html( $svc['links']['lead'] ); ?></p><?php endif; ?>
		</div>
		<div class="vlx-linkcards">
			<?php foreach ( $svc['links']['items'] as $ln ) : ?>
				<a class="vlx-linkcard vlx-reveal" href="<?php echo esc_url( voltalux_page_link( $ln['slug'] ) ); ?>">
					<span class="vlx-linkcard__ic"><?php echo voltalux_icon( isset( $ln['icon'] ) ? $ln['icon'] : 'roof' ); // phpcs:ignore ?></span>
					<h3><?php echo esc_html( $ln['label'] ); ?></h3>
					<?php if ( ! empty( $ln['text'] ) ) : ?><p><?php echo esc_html( $ln['text'] ); ?></p><?php endif; ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php /* Voordelen */ ?>
<?php if ( ! empty( $svc['voordelen']['items'] ) ) : ?>
<section id="voordelen" class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:1rem">
			<?php voltalux_eyebrow( __( 'Voordelen', 'voltalux' ) ); ?>
			<h2><?php echo esc_html( $svc['voordelen']['title'] ); ?></h2>
		</div>
		<div class="vlx-values" style="margin-top:2.2rem">
			<?php
			$vicons = array( 'leaf', 'home', 'shield' );
			foreach ( array_values( $svc['voordelen']['items'] ) as $vi => $v ) : ?>
				<div class="vlx-value vlx-reveal">
					<div class="vlx-value__icon"><?php echo voltalux_icon( isset( $vicons[ $vi ] ) ? $vicons[ $vi ] : 'spark' ); // phpcs:ignore ?></div>
					<h3><?php echo esc_html( $v['title'] ); ?></h3>
					<p><?php echo esc_html( $v['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php /* Merken */ ?>
<?php if ( ! empty( $svc['brands']['items'] ) ) : ?>
<section id="merken" class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
			<?php voltalux_eyebrow( __( 'Onze merken', 'voltalux' ) ); ?>
			<h2><?php echo esc_html( $svc['brands']['title'] ); ?></h2>
			<?php if ( ! empty( $svc['brands']['lead'] ) ) : ?><p><?php echo esc_html( $svc['brands']['lead'] ); ?></p><?php endif; ?>
		</div>
		<div class="vlx-brands">
			<?php foreach ( $svc['brands']['items'] as $b ) : ?>
				<div class="vlx-merk vlx-reveal">
					<span class="vlx-merk__name"><?php echo esc_html( $b['name'] ); ?></span>
					<?php if ( ! empty( $b['tag'] ) ) : ?><span class="vlx-merk__tag"><?php echo esc_html( $b['tag'] ); ?></span><?php endif; ?>
					<p><?php echo esc_html( $b['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php /* Salderingsregeling — dark band with text left + conversion form right */ ?>
<?php if ( ! empty( $svc['saldering'] ) ) : ?>
<section id="saldering" class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-offerte vlx-reveal">
			<div class="vlx-offerte__body">
				<span class="vlx-featband__ic"><?php echo voltalux_icon( 'euro' ); // phpcs:ignore ?></span>
				<?php voltalux_eyebrow( __( 'Financieel voordeel', 'voltalux' ), true ); ?>
				<h2 style="margin-top:1rem"><?php echo esc_html( $svc['saldering']['title'] ); ?></h2>
				<p class="vlx-offerte__lead"><?php echo esc_html( $svc['saldering']['text'] ); ?></p>
				<?php if ( $phone ) : ?>
					<a class="vlx-offerte__phone" href="<?php echo esc_attr( $tel ); ?>"><?php echo voltalux_icon( 'phone' ); // phpcs:ignore ?><?php echo esc_html( __( 'Of bel', 'voltalux' ) . ' ' . $phone ); ?></a>
				<?php endif; ?>
			</div>
			<div class="vlx-offerte__card">
				<h3><?php esc_html_e( 'Vraag gratis advies aan', 'voltalux' ); ?></h3>
				<?php voltalux_form(); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<?php /* Werkwijze — 6 steps */ ?>
<section id="werkwijze" class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:1rem">
			<?php voltalux_eyebrow( __( 'Werkwijze', 'voltalux' ) ); ?>
			<h2><?php esc_html_e( 'Onze werkwijze voor een duurzaam proces', 'voltalux' ); ?></h2>
		</div>
		<div class="vlx-steps">
			<?php $i = 0; foreach ( voltalux_proces_steps() as $st ) : $i++; ?>
				<div class="vlx-step vlx-reveal">
					<div class="vlx-step__n"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></div>
					<h3><?php echo esc_html( $st['title'] ); ?></h3>
					<p><?php echo esc_html( $st['text'] ); ?></p>
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

<?php /* FAQ */ ?>
<?php if ( ! empty( $svc['faq'] ) ) : ?>
<section id="faq" class="vlx-section vlx-section--sm vlx-bg-surface" style="border-block:1px solid var(--line-2)">
	<div class="vlx-container">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2rem">
			<?php voltalux_eyebrow( __( 'Veelgestelde vragen', 'voltalux' ) ); ?>
			<h2><?php printf( esc_html__( 'Veelgestelde vragen over %s', 'voltalux' ), esc_html( strtolower( $svc['kind'] ) ) ); ?></h2>
		</div>
		<div class="vlx-reveal"><?php voltalux_faq_block( $svc['faq'] ); ?></div>
	</div>
</section>
<?php endif; ?>

<?php
$cta = ! empty( $svc['cta'] ) ? $svc['cta'] : array();
voltalux_cta_band(
	array(
		'title' => ! empty( $cta['title'] ) ? $cta['title'] : __( 'Mogelijkheden bespreken?', 'voltalux' ),
		'text'  => ! empty( $cta['text'] ) ? $cta['text'] : '',
	)
);
?>

<?php get_footer(); ?>
