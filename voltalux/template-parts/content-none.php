<?php
/**
 * "Nothing found".
 *
 * @package Voltalux
 */
?>
<section class="vlx-none">
	<h2><?php esc_html_e( 'Niets gevonden', 'voltalux' ); ?></h2>
	<?php if ( is_search() ) : ?>
		<p class="vlx-lead"><?php esc_html_e( 'Geen resultaten voor deze zoekopdracht. Probeer andere zoekwoorden.', 'voltalux' ); ?></p>
		<div style="max-width:520px;margin:1.5rem auto 0;"><?php get_search_form(); ?></div>
	<?php else : ?>
		<p class="vlx-lead"><?php esc_html_e( 'Er staat hier nog geen content. Kom snel terug!', 'voltalux' ); ?></p>
		<div style="margin-top:1.5rem;"><?php voltalux_button( array( 'label' => __( 'Terug naar home', 'voltalux' ), 'url' => home_url( '/' ), 'style' => 'dark' ) ); ?></div>
	<?php endif; ?>
</section>
