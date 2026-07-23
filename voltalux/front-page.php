<?php
/**
 * Front page.
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
	get_template_part( 'template-parts/home/services' );
	get_template_part( 'template-parts/home/producten' );
	get_template_part( 'template-parts/home/waarom' );
	get_template_part( 'template-parts/home/welkom' );
	get_template_part( 'template-parts/home/steps' );
	get_template_part( 'template-parts/home/reviews' );
	get_template_part( 'template-parts/home/projecten' );
	get_template_part( 'template-parts/home/offerte' );
endif;

get_footer();
