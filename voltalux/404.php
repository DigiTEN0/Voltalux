<?php
/**
 * 404.
 *
 * @package Voltalux
 */

get_header();
?>

<section class="vlx-section" style="text-align:center;">
	<div class="vlx-container">
		<?php voltalux_eyebrow( __( 'Foutmelding 404', 'voltalux' ) ); ?>
		<h1 style="font-size:clamp(3.5rem,2rem+7vw,8rem);margin:1.2rem 0;">4<span class="vlx-mark">0</span>4</h1>
		<p class="vlx-lead" style="max-width:46ch;margin:0 auto 2rem;">
			<?php esc_html_e( 'Deze pagina bestaat niet (meer). Ga terug naar de homepage of zoek verder.', 'voltalux' ); ?>
		</p>
		<div style="display:flex;gap:.7rem;justify-content:center;flex-wrap:wrap;">
			<?php voltalux_button( array( 'label' => __( 'Naar de homepage', 'voltalux' ), 'url' => home_url( '/' ), 'style' => 'dark' ) ); ?>
		</div>
		<div style="max-width:520px;margin:2.5rem auto 0;"><?php get_search_form(); ?></div>
	</div>
</section>

<?php
get_footer();
