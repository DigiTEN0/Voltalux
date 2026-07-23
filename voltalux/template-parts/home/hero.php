<?php
/**
 * Homepage hero — full-bleed background video.
 *
 * @package Voltalux
 */

$video   = voltalux_option( 'hero_video', VOLTALUX_DEFAULT_HERO_VIDEO );
$poster  = voltalux_option( 'hero_poster', '' );
$eyebrow = voltalux_option( 'hero_eyebrow', __( 'Thuisbatterijen · Zonnepanelen', 'voltalux' ) );
$title   = voltalux_option( 'hero_title', __( 'Maak meer van je [mark]eigen stroom[/mark].', 'voltalux' ) );
$text    = voltalux_option( 'hero_text', __( 'Sla je zonne-energie op met een thuisbatterij van Voltalux. Bespaar elke dag, word onafhankelijker en maak je woning klaar voor de toekomst.', 'voltalux' ) );

$b1_label = voltalux_option( 'hero_btn1_label', __( 'Plan gratis advies', 'voltalux' ) );
$b1_url   = voltalux_option( 'hero_btn1_url', '#contact' );
$b2_label = voltalux_option( 'hero_btn2_label', __( 'Bekijk batterijen', 'voltalux' ) );
$b2_url   = voltalux_option( 'hero_btn2_url', '#producten' );

$specs = apply_filters(
	'voltalux_hero_specs',
	array(
		array( 'n' => __( '10 jaar', 'voltalux' ), 'l' => __( 'Fabrieksgarantie', 'voltalux' ) ),
		array( 'n' => '★★★★★', 'l' => __( '4.8 via Google reviews', 'voltalux' ), 'stars' => true ),
		array( 'n' => '2.500+', 'l' => __( 'Installaties in Nederland', 'voltalux' ) ),
	)
);
?>
<section class="vlx-hero" id="hero">
	<div class="vlx-hero__media">
		<?php if ( $video ) : ?>
			<video autoplay muted loop playsinline preload="metadata" <?php echo $poster ? 'poster="' . esc_url( $poster ) . '"' : ''; ?>>
				<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
			</video>
		<?php elseif ( $poster ) : ?>
			<img src="<?php echo esc_url( $poster ); ?>" alt="" fetchpriority="high">
		<?php endif; ?>
	</div>

	<div class="vlx-hero__inner">
		<div class="vlx-container vlx-container--wide">
			<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow, true ); } ?>
			<?php if ( $title ) : ?>
				<h1><?php echo wp_kses_post( do_shortcode( voltalux_mark_shortcode_content( $title ) ) ); ?></h1>
			<?php endif; ?>
			<?php if ( $text ) : ?>
				<p class="vlx-hero__text"><?php echo wp_kses_post( $text ); ?></p>
			<?php endif; ?>

			<div class="vlx-hero__cta">
				<?php
				if ( $b1_label ) {
					voltalux_button( array( 'label' => $b1_label, 'url' => $b1_url, 'style' => 'primary', 'size' => 'lg' ) );
				}
				if ( $b2_label ) {
					voltalux_button( array( 'label' => $b2_label, 'url' => $b2_url, 'style' => 'ghost', 'size' => 'lg' ) );
				}
				?>
			</div>

			<?php if ( ! empty( $specs ) ) : ?>
				<div class="vlx-hero__specs">
					<?php foreach ( $specs as $spec ) : ?>
						<div class="vlx-spec">
							<span class="vlx-spec__n<?php echo ! empty( $spec['stars'] ) ? ' vlx-stars' : ''; ?>"><?php echo esc_html( $spec['n'] ); ?></span>
							<span class="vlx-spec__l"><?php echo esc_html( $spec['l'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
