<?php
/**
 * Homepage hero — full-bleed background video.
 *
 * @package Voltalux
 */

$video   = voltalux_option( 'hero_video', VOLTALUX_DEFAULT_HERO_VIDEO );
$poster  = voltalux_option( 'hero_poster', '' );
$eyebrow = voltalux_option( 'hero_eyebrow', __( "Zonnepanelen · Thuisbatterij · Airco · Dakrenovatie", 'voltalux' ) );
$title   = voltalux_option( 'hero_title', __( 'Jouw partner in [mark]verduurzaming[/mark].', 'voltalux' ) );
$text    = voltalux_option( 'hero_text', __( "Verduurzamen zonder gedoe — van eerlijk advies tot installatie en nazorg.", 'voltalux' ) );

$phone   = voltalux_option( 'phone', VOLTALUX_PHONE );
$b1_label = voltalux_option( 'hero_btn1_label', __( 'Offerte aanvragen', 'voltalux' ) );
$b1_url   = voltalux_option( 'hero_btn1_url', '#contact' );
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
					voltalux_button( array( 'label' => $b1_label, 'url' => $b1_url, 'style' => 'primary', 'size' => 'lg', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) );
				}
				if ( $phone ) {
					voltalux_button( array( 'label' => __( 'Bel', 'voltalux' ) . ' ' . $phone, 'url' => 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ), 'style' => 'ghost', 'size' => 'lg', 'arrow' => false ) );
				}
				?>
			</div>

			<div class="vlx-hero__specs">
				<div class="vlx-spec"><span class="vlx-spec__n">650+</span><span class="vlx-spec__l"><?php esc_html_e( 'Woningen verduurzaamd', 'voltalux' ); ?></span></div>
				<div class="vlx-spec"><span class="vlx-spec__n"><?php esc_html_e( '7+ jaar', 'voltalux' ); ?></span><span class="vlx-spec__l"><?php esc_html_e( 'Branche-ervaring', 'voltalux' ); ?></span></div>
				<div class="vlx-spec"><span class="vlx-spec__n"><?php echo voltalux_stars( 4.9, __( '4.9 uit 5 op Google', 'voltalux' ) ); // phpcs:ignore ?></span><span class="vlx-spec__l"><?php esc_html_e( '4.9 uit Google reviews', 'voltalux' ); ?></span></div>
				<div class="vlx-spec"><span class="vlx-spec__n"><?php esc_html_e( 'Gratis', 'voltalux' ); ?></span><span class="vlx-spec__l"><?php esc_html_e( 'Service na installatie', 'voltalux' ); ?></span></div>
			</div>
		</div>
	</div>
</section>
