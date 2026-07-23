<?php
/**
 * Footer.
 *
 * @package Voltalux
 */
?>
	</main><!-- #main -->

<?php if ( ! voltalux_has_elementor_location( 'footer' ) ) : ?>
	<?php
	$tagline     = voltalux_option( 'footer_tagline', __( 'Jouw energie geeft [mark]vrijheid[/mark]', 'voltalux' ) );
	$address     = voltalux_option( 'footer_address', "Voltalux\nNederland" );
	$email       = voltalux_option( 'footer_email', 'info@voltalux.nl' );
	$phone       = voltalux_option( 'phone', '' );
	$copyright   = voltalux_option( 'footer_copyright', '' );
	$has_widgets = is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' );

	// Sensible default footer columns (used when no footer widgets are set).
	$default_cols = array(
		__( 'Producten', 'voltalux' ) => array(
			array( __( 'Thuisbatterijen', 'voltalux' ), '#producten' ),
			array( __( 'Zonnepanelen', 'voltalux' ), '#zonnepanelen' ),
			array( __( 'Compleet pakket', 'voltalux' ), '#producten' ),
			array( __( 'AEG · HyxiPower · AlphaESS', 'voltalux' ), '#producten' ),
		),
		__( 'Voltalux', 'voltalux' ) => array(
			array( __( 'Werkwijze', 'voltalux' ), '#werkwijze' ),
			array( __( 'Over ons', 'voltalux' ), '#over-ons' ),
			array( __( 'Kennisbank', 'voltalux' ), '#kennisbank' ),
			array( __( 'Contact', 'voltalux' ), '#contact' ),
		),
		__( 'Service', 'voltalux' ) => array(
			array( __( 'Advies aanvragen', 'voltalux' ), '#contact' ),
			array( __( 'Garantie', 'voltalux' ), '#' ),
			array( __( 'Monitoring & onderhoud', 'voltalux' ), '#' ),
			array( __( 'Veelgestelde vragen', 'voltalux' ), '#' ),
		),
	);
	?>
	<footer class="vlx-site-footer" role="contentinfo">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-footer-top">
				<div class="vlx-footer-brand">
					<?php if ( $tagline ) : ?>
						<p class="vlx-footer-tag"><?php echo wp_kses_post( do_shortcode( voltalux_mark_shortcode_content( $tagline ) ) ); ?></p>
					<?php endif; ?>
					<div class="vlx-footer-contact">
						<?php if ( $address ) : ?>
							<address style="font-style:normal;"><?php echo nl2br( esc_html( $address ) ); ?></address>
						<?php endif; ?>
						<?php if ( $email ) : ?>
							<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a><br>
						<?php endif; ?>
						<?php if ( $phone ) : ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
						<?php endif; ?>
					</div>
					<?php voltalux_social_icons( 'vlx-footer-social' ); ?>
				</div>

				<?php if ( $has_widgets ) : ?>
					<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
							<div class="vlx-footer-col"><?php dynamic_sidebar( 'footer-' . $i ); ?></div>
						<?php endif; ?>
					<?php endfor; ?>
				<?php else : ?>
					<?php foreach ( $default_cols as $title => $links ) : ?>
						<div class="vlx-footer-col">
							<h4><?php echo esc_html( $title ); ?></h4>
							<ul>
								<?php foreach ( $links as $link ) : ?>
									<li><a href="<?php echo esc_url( $link[1] ); ?>"><?php echo esc_html( $link[0] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<div class="vlx-footer-bottom">
				<span>
					<?php
					if ( $copyright ) {
						echo esc_html( $copyright );
					} else {
						/* translators: 1: year, 2: site name. */
						printf( esc_html__( '© %1$s %2$s. Alle rechten voorbehouden.', 'voltalux' ), esc_html( gmdate( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) );
					}
					?>
				</span>
				<?php
				if ( has_nav_menu( 'legal' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'legal',
							'container'      => 'nav',
							'depth'          => 1,
							'menu_class'     => 'vlx-legal-menu',
						)
					);
				} else {
					echo '<nav><ul><li><a href="#">' . esc_html__( 'Privacy', 'voltalux' ) . '</a></li><li><a href="#">' . esc_html__( 'Voorwaarden', 'voltalux' ) . '</a></li><li><a href="#">' . esc_html__( 'Cookies', 'voltalux' ) . '</a></li></ul></nav>';
				}
				?>
			</div>
		</div>
	</footer>

	<?php
	$float_label = voltalux_option( 'header_cta_label', __( 'Plan gratis advies', 'voltalux' ) );
	$float_url   = voltalux_option( 'header_cta_url', '#contact' );
	if ( $float_label ) :
		?>
		<div class="vlx-floating">
			<?php if ( $phone ) : ?>
				<span class="vlx-floating__t"><b><?php esc_html_e( 'Vragen? Bel direct', 'voltalux' ); ?></b><?php echo esc_html( $phone ); ?></span>
			<?php endif; ?>
			<?php voltalux_button( array( 'label' => $float_label, 'url' => $float_url, 'style' => 'primary' ) ); ?>
		</div>
	<?php endif; ?>
<?php endif; // footer location. ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
