<?php
/**
 * Search results.
 *
 * @package Voltalux
 */

get_header();
?>

<div class="vlx-page-hero">
	<div class="vlx-container vlx-container--wide">
		<?php voltalux_eyebrow( __( 'Zoekresultaten', 'voltalux' ) ); ?>
		<h1>
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Resultaten voor: %s', 'voltalux' ), '&ldquo;' . esc_html( get_search_query() ) . '&rdquo;' );
			?>
		</h1>
		<div style="max-width:520px;margin-top:1.5rem;"><?php get_search_form(); ?></div>
	</div>
</div>

<div class="vlx-section vlx-container vlx-container--wide">
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
				'prev_text' => __( '&larr;', 'voltalux' ),
				'next_text' => __( '&rarr;', 'voltalux' ),
			)
		);
		?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>
</div>

<?php
get_footer();
