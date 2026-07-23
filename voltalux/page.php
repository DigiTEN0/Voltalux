<?php
/**
 * Single page. Elementor pages render their own layout.
 *
 * @package Voltalux
 */

get_header();

while ( have_posts() ) :
	the_post();
	$is_elementor = voltalux_is_elementor_page( get_the_ID() );
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'vlx-page' ); ?>>

		<?php if ( ! $is_elementor ) : ?>
			<header class="vlx-page-hero">
				<div class="vlx-container">
					<?php voltalux_eyebrow( get_bloginfo( 'name' ) ); ?>
					<h1><?php the_title(); ?></h1>
				</div>
			</header>

			<div class="vlx-section vlx-container">
				<div class="vlx-layout vlx-layout--single">
					<div class="vlx-prose">
						<?php
						the_content();
						wp_link_pages( array( 'before' => '<div class="vlx-page-links">' . esc_html__( 'Pagina:', 'voltalux' ), 'after' => '</div>' ) );
						?>
					</div>
					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>
			</div>
		<?php else : ?>
			<?php the_content(); ?>
		<?php endif; ?>

	</article>
	<?php
endwhile;

get_footer();
