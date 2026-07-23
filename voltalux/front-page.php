<?php
/**
 * Front page.
 *
 * When the front page is built with Elementor, we get out of the way and let
 * Elementor render the content. Otherwise we render the crafted Voltalux
 * homepage (video hero, batterij-cards, USP's, testimonials, CTA), all fed by
 * Customizer values so the client can edit it without code.
 *
 * @package Voltalux
 */

get_header();

if ( ! voltalux_use_coded_homepage() ) :
	// Elementor (or a normal page builder) owns this page.
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
else :
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/statement' );
	get_template_part( 'template-parts/home/usps' );
	get_template_part( 'template-parts/home/products' );
	get_template_part( 'template-parts/home/feature' );
	get_template_part( 'template-parts/home/testimonial' );
	get_template_part( 'template-parts/home/articles' );
	get_template_part( 'template-parts/home/cta' );
endif;

get_footer();
