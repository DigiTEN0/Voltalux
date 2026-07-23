<?php
/**
 * 404 — page not found.
 *
 * @package Voltalux
 */

get_header();
?>

<section class="vlx-section" style="text-align:center;">
	<div class="vlx-container">
		<p class="vlx-eyebrow" style="justify-content:center;"><span class="vlx-eyebrow__dot"></span> <?php esc_html_e( 'Foutmelding 404', 'voltalux' ); ?></p>
		<h1 style="font-size:clamp(3rem,2rem+6vw,7rem);margin:1rem 0;">4<span class="vlx-mark">0</span>4</h1>
		<p style="max-width:46ch;margin:0 auto 2rem;color:var(--vlx-muted);font-size:var(--vlx-lead);">
			<?php esc_html_e( 'Deze pagina bestaat niet (meer). Ga terug naar de homepage of zoek verder.', 'voltalux' ); ?>
		</p>
		<div style="display:flex;gap:.8rem;justify-content:center;flex-wrap:wrap;">
			<?php voltalux_button( array( 'label' => __( 'Naar de homepage', 'voltalux' ), 'url' => home_url( '/' ), 'style' => 'dark' ) ); ?>
		</div>
		<div style="max-width:520px;margin:2.5rem auto 0;"><?php get_search_form(); ?></div>
	</div>
</section>

<?php
get_footer();
