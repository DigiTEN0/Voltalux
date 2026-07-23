<?php
/**
 * Footer template.
 *
 * @package Voltalux
 */
?>
	</main><!-- #main -->

<?php
// Elementor Pro footer takes over if one is set.
if ( ! voltalux_has_elementor_location( 'footer' ) ) :

	$tagline    = voltalux_option( 'footer_tagline', __( 'Jouw energie geeft [mark]vrijheid[/mark]', 'voltalux' ) );
	$address    = voltalux_option( 'footer_address', "Voltalux\nNederland" );
	$email      = voltalux_option( 'footer_email', 'info@voltalux.nl' );
	$phone      = voltalux_option( 'phone', '' );
	$copyright  = voltalux_option( 'footer_copyright', '' );
	$has_widgets = is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' );

	$socials = array(
		'instagram' => array( 'Instagram', 'M12 2.2c3.2 0 3.6 0 4.9.07 1.2.06 1.8.26 2.2.43.6.2 1 .5 1.4 1 .4.4.7.8 1 1.4.2.4.4 1 .4 2.2.07 1.3.07 1.7.07 4.9s0 3.6-.07 4.9c-.06 1.2-.26 1.8-.43 2.2-.2.6-.5 1-1 1.4-.4.4-.8.7-1.4 1-.4.2-1 .4-2.2.4-1.3.07-1.7.07-4.9.07s-3.6 0-4.9-.07c-1.2-.06-1.8-.26-2.2-.43-.6-.2-1-.5-1.4-1-.4-.4-.7-.8-1-1.4-.2-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.07-4.9c.06-1.2.26-1.8.43-2.2.2-.6.5-1 1-1.4.4-.4.8-.7 1.4-1 .4-.2 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2m0 1.6c-3.1 0-3.5 0-4.7.07-.9 0-1.4.2-1.7.3-.4.2-.7.4-1 .7-.3.3-.5.6-.7 1-.1.3-.3.8-.3 1.7C3.8 8.5 3.8 8.9 3.8 12s0 3.5.07 4.7c0 .9.2 1.4.3 1.7.2.4.4.7.7 1 .3.3.6.5 1 .7.3.1.8.3 1.7.3 1.2.07 1.6.07 4.7.07s3.5 0 4.7-.07c.9 0 1.4-.2 1.7-.3.4-.2.7-.4 1-.7.3-.3.5-.6.7-1 .1-.3.3-.8.3-1.7.07-1.2.07-1.6.07-4.7s0-3.5-.07-4.7c0-.9-.2-1.4-.3-1.7-.2-.4-.4-.7-.7-1-.3-.3-.6-.5-1-.7-.3-.1-.8-.3-1.7-.3-1.2-.07-1.6-.07-4.7-.07m0 2.8a5.4 5.4 0 110 10.8 5.4 5.4 0 010-10.8m0 1.9a3.5 3.5 0 100 7 3.5 3.5 0 000-7m5.6-.3a1.26 1.26 0 11-2.52 0 1.26 1.26 0 012.52 0z' ),
		'facebook'  => array( 'Facebook', 'M14 8.5V7c0-.8.2-1.2 1.3-1.2H17V3.1c-.3 0-1.3-.1-2.4-.1-2.4 0-4 1.4-4 4.1v1.4H8v2.9h2.6V21H14v-9.6h2.5l.4-2.9H14z' ),
		'linkedin'  => array( 'LinkedIn', 'M6.9 8.5H3.9V21h3V8.5zM5.4 3a1.8 1.8 0 100 3.5 1.8 1.8 0 000-3.5zM21 21h-3v-6.1c0-1.5-.5-2.5-1.8-2.5-1 0-1.6.7-1.9 1.4-.1.2-.1.5-.1.9V21h-3s.04-10.9 0-12h3v1.7c.4-.6 1.1-1.5 2.8-1.5 2 0 3.6 1.3 3.6 4.2V21z' ),
		'youtube'   => array( 'YouTube', 'M21.6 7.2s-.2-1.4-.8-2c-.8-.8-1.6-.8-2-.9C16 4 12 4 12 4h-.01s-4 0-6.8.3c-.4.1-1.2.1-2 .9-.6.6-.8 2-.8 2S2.2 8.8 2.2 10.5v1.6c0 1.6.2 3.3.2 3.3s.2 1.4.8 2c.8.8 1.8.8 2.3.9 1.6.2 6.5.3 6.5.3s4 0 6.8-.3c.4-.1 1.2-.1 2-.9.6-.6.8-2 .8-2s.2-1.6.2-3.3v-1.6c0-1.6-.2-3.3-.2-3.3zM9.9 14.6V8.9l5.2 2.9-5.2 2.8z' ),
	);
	?>
	<footer class="vlx-footer" role="contentinfo">
		<div class="vlx-container vlx-container--wide">

			<div class="vlx-footer__top">
				<div class="vlx-footer__brand">
					<?php if ( $tagline ) : ?>
						<p class="vlx-footer__tagline"><?php echo wp_kses_post( do_shortcode( voltalux_mark_shortcode_content( $tagline ) ) ); ?></p>
					<?php endif; ?>

					<div class="vlx-footer__contact">
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

					<div class="vlx-social">
						<?php
						foreach ( $socials as $key => $data ) {
							$url = voltalux_option( 'social_' . $key, '' );
							if ( ! $url ) {
								continue;
							}
							printf(
								'<a href="%1$s" aria-label="%2$s" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="%3$s"/></svg></a>',
								esc_url( $url ),
								esc_attr( $data[0] ),
								esc_attr( $data[1] )
							);
						}
						?>
					</div>
				</div>

				<?php if ( $has_widgets ) : ?>
					<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
							<div class="vlx-footer__col"><?php dynamic_sidebar( 'footer-' . $i ); ?></div>
						<?php endif; ?>
					<?php endfor; ?>
				<?php elseif ( has_nav_menu( 'footer' ) ) : ?>
					<div class="vlx-footer__col vlx-footer__col--menu" style="grid-column: span 3;">
						<h4><?php esc_html_e( 'Navigatie', 'voltalux' ); ?></h4>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'depth'          => 1,
								'link_before'    => '',
							)
						);
						?>
					</div>
				<?php else : ?>
					<div class="vlx-footer__col" style="grid-column: span 3;">
						<p style="max-width:40ch;"><?php esc_html_e( 'Voeg footer-widgets toe via Weergave → Widgets, of stel een footermenu in.', 'voltalux' ); ?></p>
					</div>
				<?php endif; ?>
			</div>

			<div class="vlx-footer__bottom">
				<span>
					<?php
					if ( $copyright ) {
						echo esc_html( $copyright );
					} else {
						/* translators: %1$s: year, %2$s: site name. */
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
				}
				?>
			</div>
		</div>
	</footer>

	<?php
	// Floating contact bar (matches the Domogo reference).
	$float_label = voltalux_option( 'header_cta_label', __( 'Plan gratis advies', 'voltalux' ) );
	$float_url   = voltalux_option( 'header_cta_url', '#contact' );
	if ( $float_label ) :
		?>
		<div class="vlx-floating" aria-hidden="false">
			<?php if ( $phone ) : ?>
				<a class="vlx-floating__phone" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>">
					<span class="vlx-floating__text"><strong><?php esc_html_e( 'Vragen? Bel direct', 'voltalux' ); ?></strong><?php echo esc_html( $phone ); ?></span>
				</a>
			<?php endif; ?>
			<?php
			voltalux_button(
				array(
					'label' => $float_label,
					'url'   => $float_url,
					'style' => 'green',
				)
			);
			?>
		</div>
	<?php endif; ?>

<?php endif; // footer location. ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
