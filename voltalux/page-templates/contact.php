<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * @package Voltalux
 */

get_header();

$phone = voltalux_option( 'phone', VOLTALUX_PHONE );
$tel   = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
$email = voltalux_option( 'footer_email', VOLTALUX_EMAIL );
list( $street, $postal, $city ) = voltalux_address_parts();

voltalux_page_hero(
	array(
		'crumbs'  => array( array( 'label' => __( 'Home', 'voltalux' ), 'url' => home_url( '/' ) ), array( 'label' => __( 'Contact', 'voltalux' ) ) ),
		'eyebrow' => __( 'Contact', 'voltalux' ),
		'title'   => __( 'Wij helpen je graag [mark]vrijblijvend[/mark] verder', 'voltalux' ),
		'lead'    => __( 'Vragen over onze diensten of een gratis adviesgesprek met één van onze experts? Laat je gegevens achter, dan nemen we zo snel mogelijk contact met je op.', 'voltalux' ),
		'flush'   => true,
	)
);
?>

<section class="vlx-section vlx-section--sm">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-contactgrid vlx-reveal">

			<div class="vlx-contactgrid__info">
				<?php voltalux_eyebrow( __( 'Direct contact', 'voltalux' ) ); ?>
				<h2><?php esc_html_e( 'Neem de eerste stap naar duurzaamheid', 'voltalux' ); ?></h2>

				<ul class="vlx-contactlist">
					<?php if ( $phone ) : ?>
						<li><span class="vlx-contactlist__ic"><?php echo voltalux_icon( 'phone' ); // phpcs:ignore ?></span><span><span class="vlx-contactlist__k"><?php esc_html_e( 'Telefoon', 'voltalux' ); ?></span><a href="<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a></span></li>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<li><span class="vlx-contactlist__ic"><?php echo voltalux_icon( 'mail' ); // phpcs:ignore ?></span><span><span class="vlx-contactlist__k"><?php esc_html_e( 'E-mail', 'voltalux' ); ?></span><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></span></li>
					<?php endif; ?>
					<?php if ( $street ) : ?>
						<li><span class="vlx-contactlist__ic"><?php echo voltalux_icon( 'pin' ); // phpcs:ignore ?></span><span><span class="vlx-contactlist__k"><?php esc_html_e( 'Adres', 'voltalux' ); ?></span><?php echo esc_html( trim( $street . ', ' . $postal . ' ' . $city, ', ' ) ); ?></span></li>
					<?php endif; ?>
					<li><span class="vlx-contactlist__ic"><?php echo voltalux_icon( 'clock' ); // phpcs:ignore ?></span><span><span class="vlx-contactlist__k"><?php esc_html_e( 'Openingstijden', 'voltalux' ); ?></span><?php esc_html_e( 'Ma–Vrij · 10:00–16:30', 'voltalux' ); ?></span></li>
				</ul>

				<ul class="vlx-ticks" style="margin-top:1.8rem">
					<li><?php esc_html_e( 'Adviesgesprek op maat en op locatie', 'voltalux' ); ?></li>
					<li><?php esc_html_e( 'Binnen 3 weken geïnstalleerd', 'voltalux' ); ?></li>
					<li><?php esc_html_e( 'Geen betalingen vooraf', 'voltalux' ); ?></li>
				</ul>
			</div>

			<div class="vlx-contactgrid__form vlx-offerte__card">
				<h3><?php esc_html_e( 'Vraag gratis advies aan', 'voltalux' ); ?></h3>
				<?php voltalux_form(); ?>
			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>
