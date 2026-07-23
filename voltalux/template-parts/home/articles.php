<?php
/**
 * Homepage "Handige artikelen" — latest posts with graceful fallback.
 *
 * @package Voltalux
 */

$eyebrow = apply_filters( 'voltalux_home_articles_eyebrow', __( 'Kennisbank', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_articles_title', __( 'Handige artikelen', 'voltalux' ) );

$query = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

$blog_url = get_permalink( get_option( 'page_for_posts' ) );
if ( ! $blog_url ) {
	$blog_url = home_url( '/' );
}
?>
<section class="vlx-section vlx-bg-surface" style="border-top:1px solid var(--line-2)" id="kennisbank">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head-row vlx-reveal" style="margin-bottom:2.4rem">
			<div class="vlx-s-head">
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			</div>
			<?php voltalux_button( array( 'label' => __( 'Alle artikelen', 'voltalux' ), 'url' => $blog_url, 'style' => 'ghost' ) ); ?>
		</div>

		<div class="vlx-cards">
			<?php if ( $query->have_posts() ) : ?>
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<article class="vlx-card vlx-reveal">
						<?php voltalux_post_thumbnail( 'medium_large' ); ?>
						<div class="vlx-card__body">
							<div class="vlx-card__meta"><?php voltalux_posted_on(); ?></div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
							<a class="vlx-arrow-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Lees meer', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<?php
				$fallback = array(
					__( 'Thuisbatterij: nu kopen of nog even wachten?', 'voltalux' ),
					__( 'Zo bereken je de terugverdientijd van een thuisbatterij', 'voltalux' ),
					__( 'Het einde van de salderingsregeling uitgelegd', 'voltalux' ),
				);
				foreach ( $fallback as $ft ) :
					?>
					<article class="vlx-card vlx-reveal">
						<span class="vlx-card__media vlx-card__media--ph"><?php echo voltalux_icon( 'plus' ); // phpcs:ignore ?></span>
						<div class="vlx-card__body">
							<div class="vlx-card__meta"><span><?php esc_html_e( 'Binnenkort', 'voltalux' ); ?></span></div>
							<h3><a href="#"><?php echo esc_html( $ft ); ?></a></h3>
							<p><?php esc_html_e( 'Publiceer je eerste blogbericht en het verschijnt hier automatisch.', 'voltalux' ); ?></p>
							<span class="vlx-arrow-link"><?php esc_html_e( 'Lees meer', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
						</div>
					</article>
					<?php
				endforeach;
				?>
			<?php endif; ?>
		</div>
	</div>
</section>
