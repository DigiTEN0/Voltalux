<?php
/**
 * Homepage blog — latest articles.
 *
 * Renders the three most recent posts. Hides itself when there are no posts yet.
 *
 * @package Voltalux
 */

$q = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( ! $q->have_posts() ) {
	wp_reset_postdata();
	return;
}

$eyebrow  = apply_filters( 'voltalux_home_blog_eyebrow', __( 'Blog', 'voltalux' ) );
$title    = apply_filters( 'voltalux_home_blog_title', __( 'Kennis & inspiratie', 'voltalux' ) );
$blog_url = get_permalink( (int) get_option( 'page_for_posts' ) );
?>
<section class="vlx-section vlx-bg-surface" style="border-top:1px solid var(--line-2)" id="blog">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head-row vlx-reveal" style="margin-bottom:2.4rem">
			<div class="vlx-s-head">
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			</div>
			<?php if ( $blog_url ) { voltalux_button( array( 'label' => __( 'Alle artikelen', 'voltalux' ), 'url' => $blog_url, 'style' => 'ghost' ) ); } ?>
		</div>

		<div class="vlx-cards">
			<?php
			while ( $q->have_posts() ) :
				$q->the_post();
				?>
				<article class="vlx-card vlx-reveal">
					<a class="vlx-card__media<?php echo has_post_thumbnail() ? '' : ' vlx-card__media--ph'; ?>" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
						<?php else : ?>
							<?php echo voltalux_icon( 'spark' ); // phpcs:ignore ?>
						<?php endif; ?>
					</a>
					<div class="vlx-card__body">
						<div class="vlx-card__meta">
							<?php
							$cats = get_the_category();
							if ( ! empty( $cats ) ) {
								echo esc_html( $cats[0]->name ) . ' &middot; ';
							}
							echo esc_html( get_the_date() );
							?>
						</div>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
						<span class="vlx-arrow-link"><?php esc_html_e( 'Lees meer', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php
wp_reset_postdata();
