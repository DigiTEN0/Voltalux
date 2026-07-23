<?php
/**
 * Main template — blog index & fallback.
 *
 * @package Voltalux
 */

get_header();
?>

<div class="vlx-page-hero">
	<div class="vlx-container vlx-container--wide">
		<?php voltalux_eyebrow( __( 'Kennisbank', 'voltalux' ) ); ?>
		<h1>
			<?php
			if ( is_home() && ! is_front_page() && get_option( 'page_for_posts' ) ) {
				echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) );
			} else {
				esc_html_e( 'Nieuws & inzichten', 'voltalux' );
			}
			?>
		</h1>
		<p><?php esc_html_e( 'Alles over thuisbatterijen, zonnepanelen, besparen en verduurzamen — praktisch uitgelegd.', 'voltalux' ); ?></p>
	</div>
</div>

<div class="vlx-section vlx-container vlx-container--wide">
	<div class="vlx-layout">
		<div>
			<?php if ( have_posts() ) : ?>
				<div class="vlx-cards">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					?>
				</div>
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 1,
						'prev_text' => __( '&larr; Vorige', 'voltalux' ),
						'next_text' => __( 'Volgende &rarr;', 'voltalux' ),
					)
				);
				?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
