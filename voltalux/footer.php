<?php
/**
 * Footer.
 *
 * @package Voltalux
 */

$phone      = voltalux_option( 'phone', VOLTALUX_PHONE );
$phone_href = $phone ? 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ) : '';
$cta_label  = voltalux_option( 'header_cta_label', __( 'Offerte aanvragen', 'voltalux' ) );
$cta_url    = voltalux_option( 'header_cta_url', '#contact' );
?>
	</main><!-- #main -->

<?php if ( ! voltalux_has_elementor_location( 'footer' ) ) : ?>
	<?php
	$tagline   = voltalux_option( 'footer_tagline', __( 'Samen naar een [mark]duurzamer[/mark] huis', 'voltalux' ) );
	$address   = voltalux_option( 'footer_address', VOLTALUX_ADDRESS );
	$email     = voltalux_option( 'footer_email', VOLTALUX_EMAIL );
	$kvk       = voltalux_option( 'kvk', VOLTALUX_KVK );
	$copyright = voltalux_option( 'footer_copyright', '' );
	$has_widgets = is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' );

	$col_solutions = array();
	foreach ( voltalux_services() as $s ) {
		$col_solutions[] = array( $s['name'], $s['url'] );
	}
	$default_cols = array(
		__( 'Onze oplossingen', 'voltalux' ) => $col_solutions,
		__( 'Bekijk ook', 'voltalux' ) => array(
			array( __( 'Over ons', 'voltalux' ), 'https://www.voltalux.nl/over-ons/' ),
			array( __( 'Onze projecten', 'voltalux' ), 'https://www.voltalux.nl/onze-projecten/' ),
			array( __( 'Veelgestelde vragen', 'voltalux' ), 'https://www.voltalux.nl/veelgestelde-vragen/' ),
			array( __( 'Blog', 'voltalux' ), 'https://www.voltalux.nl/blog/' ),
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
						<?php if ( $address ) : ?><address style="font-style:normal;"><?php echo nl2br( esc_html( $address ) ); ?></address><?php endif; ?>
						<?php if ( $email ) : ?><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a><br><?php endif; ?>
						<?php if ( $phone ) : ?><a href="<?php echo esc_attr( $phone_href ); ?>"><?php echo esc_html( $phone ); ?></a><br><?php endif; ?>
						<?php if ( $kvk ) : ?><span style="opacity:.7;"><?php echo esc_html( $kvk ); ?></span><?php endif; ?>
					</div>
					<?php voltalux_social_icons( 'vlx-footer-social' ); ?>
				</div>

				<?php if ( $has_widgets ) : ?>
					<?php for ( $i = 1; $i <= 2; $i++ ) : ?>
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

				<div class="vlx-footer-col vlx-footer-cta">
					<h4><?php esc_html_e( 'Direct contact', 'voltalux' ); ?></h4>
					<?php if ( $phone ) : ?>
						<a class="vlx-footer-phone" href="<?php echo esc_attr( $phone_href ); ?>"><?php echo voltalux_icon( 'phone' ); // phpcs:ignore ?><?php echo esc_html( $phone ); ?></a>
					<?php endif; ?>
					<p style="margin:.6rem 0 1.1rem;font-size:.9rem;"><?php esc_html_e( 'Onze adviseurs staan voor je klaar — bel direct of vraag vrijblijvend een offerte aan.', 'voltalux' ); ?></p>
					<?php voltalux_button( array( 'label' => $cta_label, 'url' => $cta_url, 'style' => 'primary', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
				</div>
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
					wp_nav_menu( array( 'theme_location' => 'legal', 'container' => 'nav', 'depth' => 1, 'menu_class' => 'vlx-legal-menu' ) );
				} else {
					echo '<nav><ul><li><a href="https://www.voltalux.nl/privacybeleid/">' . esc_html__( 'Privacybeleid', 'voltalux' ) . '</a></li><li><a href="#">' . esc_html__( 'Algemene voorwaarden', 'voltalux' ) . '</a></li></ul></nav>';
				}
				?>
			</div>
		</div>
	</footer>

	<?php /* Floating call + offerte */ ?>
	<?php if ( $cta_label || $phone ) : ?>
		<div class="vlx-floating">
			<?php if ( $phone ) : ?>
				<a class="vlx-floating__call" href="<?php echo esc_attr( $phone_href ); ?>" aria-label="<?php esc_attr_e( 'Bel direct', 'voltalux' ); ?>"><?php echo voltalux_icon( 'phone' ); // phpcs:ignore ?></a>
			<?php endif; ?>
			<?php if ( $cta_label ) : ?>
				<button class="vlx-btn vlx-btn--primary" data-vlx-open="offerte"><span class="vlx-btn__lbl"><?php echo esc_html( $cta_label ); ?></span> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></button>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php /* Offerte drawer */ ?>
	<div class="vlx-drawer" id="vlx-offerte" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Offerte aanvragen', 'voltalux' ); ?>">
		<div class="vlx-drawer__overlay" data-vlx-close></div>
		<div class="vlx-drawer__panel">
			<div class="vlx-drawer__head">
				<?php voltalux_eyebrow( __( 'Binnen 1 minuut geregeld', 'voltalux' ) ); ?>
				<h2><?php esc_html_e( 'Vraag vrijblijvend een offerte aan', 'voltalux' ); ?></h2>
				<button class="vlx-drawer__close" data-vlx-close aria-label="<?php esc_attr_e( 'Sluiten', 'voltalux' ); ?>"><?php echo voltalux_icon( 'close' ); // phpcs:ignore ?></button>
			</div>
			<div class="vlx-drawer__body">
				<ul class="vlx-drawer__trust">
					<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><?php esc_html_e( 'Adviesgesprek op maat en op locatie', 'voltalux' ); ?></li>
					<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><?php esc_html_e( 'Binnen 3 weken geïnstalleerd', 'voltalux' ); ?></li>
					<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><?php esc_html_e( 'Geen betalingen vooraf', 'voltalux' ); ?></li>
				</ul>
				<?php voltalux_form(); ?>
			</div>
		</div>
	</div>
<?php endif; // footer location. ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
