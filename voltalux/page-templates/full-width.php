<?php
/**
 * Template Name: Volledige breedte (Elementor)
 * Template Post Type: page
 *
 * Edge-to-edge canvas with the theme header + footer. Ideal for building
 * landing pages with Elementor. No container, no sidebar, no page title.
 *
 * @package Voltalux
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'vlx-fullwidth' ); ?>>
		<?php the_content(); ?>
	</article>
	<?php
endwhile;

get_footer();
