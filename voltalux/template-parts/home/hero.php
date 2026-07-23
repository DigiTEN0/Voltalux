<?php
/**
 * Homepage hero — full-bleed background video.
 *
 * @package Voltalux
 */

$video   = voltalux_option( 'hero_video', VOLTALUX_DEFAULT_HERO_VIDEO );
$poster  = voltalux_option( 'hero_poster', '' );
$eyebrow = voltalux_option( 'hero_eyebrow', __( 'Vol vermogen, thuis', 'voltalux' ) );
$title   = voltalux_option( 'hero_title', __( 'Jouw energie, jouw vrijheid.', 'voltalux' ) );
$text    = voltalux_option( 'hero_text', '' );
$rating  = voltalux_option( 'hero_rating', __( '4.8 gemiddelde beoordeling', 'voltalux' ) );

$b1_label = voltalux_option( 'hero_btn1_label', __( 'Plan gratis advies', 'voltalux' ) );
$b1_url   = voltalux_option( 'hero_btn1_url', '#contact' );
$b2_label = voltalux_option( 'hero_btn2_label', __( 'Bekijk batterijen', 'voltalux' ) );
$b2_url   = voltalux_option( 'hero_btn2_url', '#producten' );
?>
<section class="vlx-hero" id="hero">
	<div class="vlx-hero__media">
		<?php if ( $video ) : ?>
			<video
				autoplay muted loop playsinline preload="metadata"
				<?php echo $poster ? 'poster="' . esc_url( $poster ) . '"' : ''; ?>
			>
				<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
			</video>
		<?php elseif ( $poster ) : ?>
			<img src="<?php echo esc_url( $poster ); ?>" alt="" fetchpriority="high">
		<?php endif; ?>
	</div>

	<div class="vlx-hero__inner">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-hero__grid">
				<div class="vlx-hero__content">
					<?php if ( $eyebrow ) : ?>
						<div class="vlx-hero__eyebrow"><?php voltalux_eyebrow( $eyebrow ); ?></div>
					<?php endif; ?>

					<?php if ( $title ) : ?>
						<h1><?php echo wp_kses_post( do_shortcode( voltalux_mark_shortcode_content( $title ) ) ); ?></h1>
					<?php endif; ?>

					<?php if ( $text ) : ?>
						<p class="vlx-hero__text"><?php echo wp_kses_post( $text ); ?></p>
					<?php endif; ?>

					<div class="vlx-hero__cta">
						<?php
						if ( $b1_label ) {
							voltalux_button( array( 'label' => $b1_label, 'url' => $b1_url, 'style' => 'green', 'size' => 'lg' ) );
						}
						if ( $b2_label ) {
							voltalux_button( array( 'label' => $b2_label, 'url' => $b2_url, 'style' => 'white', 'size' => 'lg' ) );
						}
						?>
					</div>
				</div>

				<?php if ( $rating ) : ?>
					<div class="vlx-hero__rating">
						<span class="vlx-stars" aria-hidden="true">★★★★★</span>
						<span><?php echo esc_html( $rating ); ?></span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="vlx-hero__scroll" aria-hidden="true">
		<span></span>
		<?php esc_html_e( 'Scroll', 'voltalux' ); ?>
	</div>
</section>
