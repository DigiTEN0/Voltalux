<?php
/**
 * Template Name: Informatie / juridisch (prose)
 * Template Post Type: page
 *
 * Renders a clean prose page: the page's own content when present, otherwise a
 * coded fallback for known slugs (e.g. privacybeleid). Fully editor-editable.
 *
 * @package Voltalux
 */

get_header();

$vlx_id   = get_queried_object_id();
$vlx_slug = get_post_field( 'post_name', $vlx_id );
$vlx_body = trim( (string) get_post_field( 'post_content', $vlx_id ) );

voltalux_page_hero(
	array(
		'crumbs'  => array( array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ), array( 'label' => get_the_title( $vlx_id ) ) ),
		'eyebrow' => __( 'Voltalux', 'voltalux' ),
		'title'   => get_the_title( $vlx_id ),
		'flush'   => true,
	)
);
?>

<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--narrow">
		<div class="vlx-rich vlx-prose vlx-reveal">
			<?php
			if ( '' !== $vlx_body ) {
				while ( have_posts() ) {
					the_post();
					the_content();
				}
			} elseif ( 'privacybeleid' === $vlx_slug && function_exists( 'voltalux_privacy_html' ) ) {
				echo voltalux_privacy_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
