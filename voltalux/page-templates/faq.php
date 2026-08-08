<?php
/**
 * Template Name: Veelgestelde vragen
 * Template Post Type: page
 *
 * @package Voltalux
 */

get_header();

$phone = voltalux_option( 'phone', VOLTALUX_PHONE );
$tel   = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );

ob_start();
voltalux_button( array( 'label' => __( 'Gratis adviesgesprek', 'voltalux' ), 'url' => voltalux_page_link( 'contact' ), 'style' => 'primary', 'size' => 'lg', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) );
if ( $phone ) {
	voltalux_button( array( 'label' => __( 'Bel', 'voltalux' ) . ' ' . $phone, 'url' => $tel, 'style' => 'ghost', 'size' => 'lg', 'arrow' => false ) );
}
$hero_cta = ob_get_clean();

voltalux_page_hero(
	array(
		'crumbs'  => array( array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ), array( 'label' => __( 'Veelgestelde vragen', 'voltalux' ) ) ),
		'eyebrow' => __( 'Veelgestelde vragen', 'voltalux' ),
		'title'   => __( 'Antwoord op je [mark]vragen[/mark]', 'voltalux' ),
		'lead'    => __( 'De meestgestelde vragen over zonnepanelen, salderen, onderhoud en meer — helder op een rij. Staat je vraag er niet bij? Neem gerust contact op.', 'voltalux' ),
		'cta'     => $hero_cta,
		'flush'   => true,
	)
);
?>

<section class="vlx-section vlx-section--sm">
	<div class="vlx-container">
		<div class="vlx-reveal">
			<?php
			if ( function_exists( 'voltalux_general_faq' ) ) {
				voltalux_faq_block( voltalux_general_faq() );
			}
			?>
		</div>
	</div>
</section>

<?php
voltalux_cta_band(
	array(
		'title' => __( 'Staat je vraag er niet bij?', 'voltalux' ),
		'text'  => __( 'Onze adviseurs helpen je graag verder. Vraag een vrijblijvend adviesgesprek aan of bel ons direct.', 'voltalux' ),
	)
);
?>

<?php get_footer(); ?>
