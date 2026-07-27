<?php
/**
 * Blog sidebar — conversion CTA + recent posts + categories + search.
 *
 * @package Voltalux
 */

$phone      = voltalux_option( 'phone', VOLTALUX_PHONE );
$phone_href = $phone ? 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ) : '';
?>
<aside class="vlx-sidebar" aria-label="<?php esc_attr_e( 'Zijbalk', 'voltalux' ); ?>">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>

		<div class="vlx-side-cta">
			<span class="vlx-side-cta__eyebrow"><?php esc_html_e( 'Gratis & vrijblijvend', 'voltalux' ); ?></span>
			<h4><?php esc_html_e( 'Benieuwd wat verduurzamen jou oplevert?', 'voltalux' ); ?></h4>
			<p><?php esc_html_e( 'Ontvang een advies op maat — binnen 1 minuut aangevraagd.', 'voltalux' ); ?></p>
			<?php voltalux_button( array( 'label' => __( 'Offerte aanvragen', 'voltalux' ), 'url' => '#contact', 'style' => 'primary', 'class' => 'vlx-btn--block', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
			<?php if ( $phone ) : ?>
				<a class="vlx-side-cta__tel" href="<?php echo esc_attr( $phone_href ); ?>"><?php echo voltalux_icon( 'phone' ); // phpcs:ignore ?><?php echo esc_html( __( 'Of bel', 'voltalux' ) . ' ' . $phone ); ?></a>
			<?php endif; ?>
		</div>

		<?php
		$recent = new WP_Query(
			array(
				'post_type'           => 'post',
				'posts_per_page'      => 4,
				'post__not_in'        => is_singular( 'post' ) ? array( get_the_ID() ) : array(),
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		if ( $recent->have_posts() ) :
			?>
			<div class="widget">
				<h4 class="widget__title"><?php esc_html_e( 'Recente artikelen', 'voltalux' ); ?></h4>
				<div class="vlx-side-posts">
					<?php
					while ( $recent->have_posts() ) :
						$recent->the_post();
						?>
						<a class="vlx-side-post" href="<?php the_permalink(); ?>">
							<span class="vlx-side-post__img<?php echo has_post_thumbnail() ? '' : ' is-ph'; ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'medium' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
								<?php else : ?>
									<?php echo voltalux_icon( 'spark' ); // phpcs:ignore ?>
								<?php endif; ?>
							</span>
							<span class="vlx-side-post__body">
								<span class="vlx-side-post__t"><?php the_title(); ?></span>
								<span class="vlx-side-post__d"><?php echo esc_html( get_the_date() ); ?></span>
							</span>
						</a>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( ! wp_list_categories( array( 'echo' => false, 'title_li' => '', 'hide_empty' => true ) ) === false ) : ?>
			<div class="widget">
				<h4 class="widget__title"><?php esc_html_e( 'Categorieën', 'voltalux' ); ?></h4>
				<ul class="vlx-side-cats">
					<?php wp_list_categories( array( 'title_li' => '', 'show_count' => true, 'hide_empty' => true ) ); ?>
				</ul>
			</div>
		<?php endif; ?>

		<div class="widget">
			<h4 class="widget__title"><?php esc_html_e( 'Zoeken', 'voltalux' ); ?></h4>
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>
</aside>
