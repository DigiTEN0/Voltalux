<?php
/**
 * Template Name: Projecten
 * Template Post Type: page
 *
 * Filterable project grid (per the briefing: filter by category, default view
 * shows all). Each project is a small proof point: situation, question,
 * solution and a concrete result — worth more than a wall of photos.
 *
 * @package Voltalux
 */

get_header();

$projects = voltalux_projects();

// Build the filter list from the categories present.
$cats = array();
foreach ( $projects as $p ) {
	$cats[ $p['cat'] ] = true;
}
$cats = array_keys( $cats );

voltalux_page_hero(
	array(
		'crumbs'  => array(
			array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ),
			array( 'label' => __( 'Projecten', 'voltalux' ) ),
		),
		'eyebrow' => __( 'Uitgevoerde projecten', 'voltalux' ),
		'title'   => __( 'Werk dat voor zich [mark]spreekt[/mark]', 'voltalux' ),
		'icon'    => 'medal',
		'lead'    => __( 'Een greep uit onze recente installaties door heel Nederland. Elk project vertelt een klein verhaal: de situatie, de vraag van de klant en het resultaat.', 'voltalux' ),
	)
);
?>

<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">

		<div class="vlx-filterbar vlx-reveal" data-vlx-filterbar role="tablist" aria-label="<?php esc_attr_e( 'Filter projecten', 'voltalux' ); ?>">
			<button class="vlx-chip vlx-chip--active" data-vlx-filter="*" aria-pressed="true"><?php esc_html_e( 'Alles', 'voltalux' ); ?></button>
			<?php foreach ( $cats as $cat ) : ?>
				<button class="vlx-chip" data-vlx-filter="<?php echo esc_attr( sanitize_title( $cat ) ); ?>" aria-pressed="false"><?php echo esc_html( $cat ); ?></button>
			<?php endforeach; ?>
		</div>

		<div class="vlx-projectgrid" data-vlx-filtergrid>
			<?php foreach ( $projects as $p ) : ?>
				<article class="vlx-projectcard vlx-reveal" data-cat="<?php echo esc_attr( sanitize_title( $p['cat'] ) ); ?>">
					<div class="vlx-projectcard__media">
						<?php if ( ! empty( $p['img'] ) ) : ?>
							<img src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['title'] . ' — ' . $p['location'] ); ?>" loading="lazy">
						<?php else : ?>
							<span class="vlx-projectcard__ph"><?php echo voltalux_icon( isset( $p['icon'] ) ? $p['icon'] : 'spark' ); // phpcs:ignore ?></span>
						<?php endif; ?>
						<span class="vlx-projectcard__cat"><?php echo esc_html( $p['cat'] ); ?></span>
					</div>
					<div class="vlx-projectcard__body">
						<span class="vlx-projectcard__loc"><?php echo voltalux_icon( 'pin' ); // phpcs:ignore ?><?php echo esc_html( $p['location'] ); ?></span>
						<h3><?php echo esc_html( $p['title'] ); ?></h3>

						<dl class="vlx-projectcard__meta">
							<?php if ( ! empty( $p['system'] ) ) : ?>
								<div><dt><?php esc_html_e( 'Systeem', 'voltalux' ); ?></dt><dd><?php echo esc_html( $p['system'] ); ?></dd></div>
							<?php endif; ?>
							<?php if ( ! empty( $p['situation'] ) ) : ?>
								<div><dt><?php esc_html_e( 'Situatie', 'voltalux' ); ?></dt><dd><?php echo esc_html( $p['situation'] ); ?></dd></div>
							<?php endif; ?>
						</dl>

						<?php if ( ! empty( $p['quote'] ) ) : ?>
							<blockquote class="vlx-projectcard__quote"><?php echo esc_html( $p['quote'] ); ?></blockquote>
						<?php endif; ?>

						<?php if ( ! empty( $p['result'] ) ) : ?>
							<span class="vlx-projectcard__result"><?php echo voltalux_icon( 'spark' ); // phpcs:ignore ?><?php echo esc_html( $p['result'] ); ?></span>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<?php voltalux_cta_band(); ?>

<?php get_footer(); ?>
