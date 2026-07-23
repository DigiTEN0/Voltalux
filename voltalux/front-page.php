<?php
/**
 * Front page.
 *
 * When built with Elementor, hand over to Elementor. Otherwise render the
 * crafted Voltalux homepage, fed by Customizer values.
 *
 * @package Voltalux
 */

get_header();

if ( ! voltalux_use_coded_homepage() ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
else :
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/statement' );
	get_template_part( 'template-parts/home/products' );
	get_template_part( 'template-parts/home/steps' );
	get_template_part( 'template-parts/home/feature' );
	get_template_part( 'template-parts/home/stats' );
	get_template_part( 'template-parts/home/testimonial' );
	get_template_part( 'template-parts/home/articles' );
	get_template_part( 'template-parts/home/cta' );
endif;

get_footer();
