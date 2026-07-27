<?php
/**
 * Archive.
 *
 * @package Voltalux
 */

get_header();
?>

<div class="vlx-page-hero">
	<div class="vlx-container vlx-container--wide">
		<?php voltalux_eyebrow( __( 'Tips & uitleg', 'voltalux' ) ); ?>
		<?php
		the_archive_title( '<h1>', '</h1>' );
		the_archive_description( '<p>', '</p>' );
		?>
	</div>
</div>

<div class="vlx-section vlx-container vlx-container--wide">
	<div class="vlx-layout">
		<div>
			<?php if ( have_posts() ) : ?>
				<div class="vlx-cards vlx-cards--2">
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
