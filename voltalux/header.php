<?php
/**
 * Header template.
 *
 * @package Voltalux
 */

$has_hero = ( is_front_page() && voltalux_use_coded_homepage() );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( $has_hero ? 'has-hero' : '' ); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Ga naar de inhoud', 'voltalux' ); ?></a>

<?php
// If Elementor Pro provides a header template, let it render and skip ours.
if ( ! voltalux_has_elementor_location( 'header' ) ) :
	$cta_label = voltalux_option( 'header_cta_label', __( 'Plan gratis advies', 'voltalux' ) );
	$cta_url   = voltalux_option( 'header_cta_url', '#contact' );
	$phone     = voltalux_option( 'phone', '' );
	?>
	<header class="vlx-header" id="site-header">
		<div class="vlx-container vlx-container--wide vlx-header__inner">

			<?php voltalux_branding( 'header' ); ?>

			<nav class="vlx-nav" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'voltalux' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'depth'          => 2,
						)
					);
				} else {
					echo '<ul><li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Stel je menu in', 'voltalux' ) . '</a></li></ul>';
				}
				?>
			</nav>

			<div class="vlx-header__actions">
				<?php if ( $phone ) : ?>
					<a class="vlx-header__phone" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>">
						<svg width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6.6 10.8a15.5 15.5 0 006.6 6.6l2.2-2.2a1 1 0 011-.24c1.1.37 2.3.57 3.5.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.2.2 2.4.57 3.5a1 1 0 01-.24 1L6.6 10.8z" fill="currentColor"/></svg>
						<span><?php echo esc_html( $phone ); ?></span>
					</a>
				<?php endif; ?>

				<?php
				if ( $cta_label ) {
					voltalux_button(
						array(
							'label' => $cta_label,
							'url'   => $cta_url,
							'style' => 'green',
							'class' => 'vlx-header__cta',
						)
					);
				}
				?>

				<button class="vlx-burger" aria-label="<?php esc_attr_e( 'Menu openen', 'voltalux' ); ?>" aria-expanded="false" aria-controls="vlx-drawer">
					<span></span><span></span><span></span>
				</button>
			</div>
		</div>
	</header>

	<?php // Mobile drawer ?>
	<div class="vlx-drawer__overlay" aria-hidden="true"></div>
	<aside class="vlx-drawer" id="vlx-drawer" aria-label="<?php esc_attr_e( 'Mobiel menu', 'voltalux' ); ?>">
		<button class="vlx-drawer__close" aria-label="<?php esc_attr_e( 'Menu sluiten', 'voltalux' ); ?>">&times;</button>
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 2,
				)
			);
		}
		?>
		<?php if ( $cta_label ) : ?>
			<div class="vlx-drawer__cta">
				<?php
				voltalux_button(
					array(
						'label' => $cta_label,
						'url'   => $cta_url,
						'style' => 'green',
					)
				);
				?>
			</div>
		<?php endif; ?>
	</aside>
<?php endif; // header location. ?>

<div id="page" class="vlx-site">
	<main id="main" class="vlx-site-content">
