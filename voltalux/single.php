<?php
/**
 * Single post — premium article layout with a sticky sidebar.
 *
 * @package Voltalux
 */

get_header();

while ( have_posts() ) :
	the_post();
	$phone      = voltalux_option( 'phone', VOLTALUX_PHONE );
	$phone_href = $phone ? 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ) : '';
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'vlx-single' ); ?>>

		<header class="vlx-page-hero vlx-article-hero">
			<div class="vlx-container">
				<nav class="vlx-crumbs" aria-label="<?php esc_attr_e( 'Kruimelpad', 'voltalux' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'voltalux' ); ?></a>
					<span aria-hidden="true">/</span>
					<?php $blog_id = (int) get_option( 'page_for_posts' ); ?>
					<?php if ( $blog_id ) : ?>
						<a href="<?php echo esc_url( get_permalink( $blog_id ) ); ?>"><?php echo esc_html( get_the_title( $blog_id ) ); ?></a>
						<span aria-hidden="true">/</span>
					<?php endif; ?>
					<?php voltalux_post_categories(); ?>
				</nav>
				<h1><?php the_title(); ?></h1>
				<div class="vlx-article__meta">
					<?php voltalux_posted_on(); ?>
					<span aria-hidden="true">·</span>
					<span><?php echo esc_html( get_the_author() ); ?></span>
				</div>
			</div>
		</header>

		<div class="vlx-section vlx-container">
			<div class="vlx-blog-layout">
				<div class="vlx-article">
					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="vlx-article__figure"><?php the_post_thumbnail( 'large' ); ?></figure>
					<?php endif; ?>

					<div class="vlx-prose">
						<?php
						the_content();
						wp_link_pages( array( 'before' => '<div class="vlx-page-links">' . esc_html__( 'Pagina:', 'voltalux' ), 'after' => '</div>' ) );
						?>
					</div>

					<footer class="vlx-entry-footer"><?php voltalux_entry_footer(); ?></footer>

					<div class="vlx-article-cta">
						<div>
							<span class="vlx-article-cta__eyebrow"><?php esc_html_e( 'Zelf aan de slag?', 'voltalux' ); ?></span>
							<h3><?php esc_html_e( 'Ontdek wat verduurzamen jou oplevert', 'voltalux' ); ?></h3>
						</div>
						<div class="vlx-article-cta__actions">
							<?php voltalux_button( array( 'label' => __( 'Offerte aanvragen', 'voltalux' ), 'url' => '#contact', 'style' => 'primary', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
							<?php if ( $phone ) { voltalux_button( array( 'label' => __( 'Bel', 'voltalux' ) . ' ' . $phone, 'url' => $phone_href, 'style' => 'ghost', 'arrow' => false ) ); } ?>
						</div>
					</div>

					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>
	</article>

	<?php
	$related = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => 3,
			'post__not_in'        => array( get_the_ID() ),
			'category__in'        => wp_get_post_categories( get_the_ID() ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	if ( $related->have_posts() ) :
		?>
		<section class="vlx-section vlx-bg-surface" style="border-top:1px solid var(--line-2)">
			<div class="vlx-container vlx-container--wide">
				<div class="vlx-s-head" style="margin-bottom:2.4rem;">
					<?php voltalux_eyebrow( __( 'Lees ook', 'voltalux' ) ); ?>
					<h2><?php esc_html_e( 'Meer artikelen', 'voltalux' ); ?></h2>
				</div>
				<div class="vlx-cards">
					<?php
					while ( $related->have_posts() ) :
						$related->the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
		<?php
	endif;
	?>
	<?php
endwhile;

get_footer();
