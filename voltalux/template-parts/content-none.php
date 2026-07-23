<?php
/**
 * "Nothing found" message.
 *
 * @package Voltalux
 */
?>
<section class="vlx-none">
	<h2><?php esc_html_e( 'Niets gevonden', 'voltalux' ); ?></h2>
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Geen resultaten voor deze zoekopdracht. Probeer andere zoekwoorden.', 'voltalux' ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Er staat hier nog geen content. Kom snel terug!', 'voltalux' ); ?></p>
		<?php voltalux_button( array( 'label' => __( 'Terug naar home', 'voltalux' ), 'url' => home_url( '/' ), 'style' => 'dark' ) ); ?>
	<?php endif; ?>
</section>
