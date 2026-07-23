<?php
/**
 * Header.
 *
 * @package Voltalux
 */

$has_hero   = ( is_front_page() && voltalux_use_coded_homepage() );
$has_menu   = has_nav_menu( 'primary' );
$services   = voltalux_services();
$cta_label  = voltalux_option( 'header_cta_label', __( 'Offerte aanvragen', 'voltalux' ) );
$cta_url    = voltalux_option( 'header_cta_url', '#contact' );
$phone      = voltalux_option( 'phone', VOLTALUX_PHONE );
$phone_href = $phone ? 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ) : '';
$open_attrs = array( 'data-vlx-open' => 'offerte' );
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

<?php if ( ! voltalux_has_elementor_location( 'header' ) ) : ?>
	<header class="vlx-site-header" id="site-header">
		<div class="vlx-container vlx-container--wide vlx-header-inner">

			<?php voltalux_branding( 'header' ); ?>

			<nav class="vlx-nav" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'voltalux' ); ?>">
				<ul>
					<li class="has-mega">
						<a href="#diensten"><?php esc_html_e( 'Diensten', 'voltalux' ); ?></a>
						<div class="vlx-mega vlx-mega--svc">
							<span class="vlx-mega__label"><?php esc_html_e( 'Onze diensten', 'voltalux' ); ?></span>
							<div class="vlx-mega-grid">
								<?php foreach ( $services as $s ) : ?>
									<a class="vlx-mega-item" href="<?php echo esc_url( $s['url'] ); ?>">
										<span class="vlx-mega-item__img"><?php echo voltalux_icon( $s['icon'] ); // phpcs:ignore ?></span>
										<span><span class="vlx-mega-item__t"><?php echo esc_html( $s['name'] ); ?></span><span class="vlx-mega-item__d"><?php echo esc_html( $s['desc'] ); ?></span></span>
									</a>
								<?php endforeach; ?>
							</div>
							<div class="vlx-mega-foot">
								<span><?php esc_html_e( 'Advies op maat en op locatie', 'voltalux' ); ?></span>
								<a class="vlx-arrow-link" href="<?php echo esc_url( $cta_url ); ?>" data-vlx-open="offerte" style="color:var(--green-strong)"><?php esc_html_e( 'Offerte aanvragen', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
							</div>
						</div>
					</li>
					<li class="has-mega">
						<a href="#producten"><?php esc_html_e( 'Producten', 'voltalux' ); ?></a>
						<div class="vlx-mega vlx-mega--prod">
							<span class="vlx-mega__label"><?php esc_html_e( 'Populaire thuisbatterijen', 'voltalux' ); ?></span>
							<div class="vlx-prodmega">
								<?php foreach ( voltalux_battery_products() as $bp ) : ?>
									<a class="vlx-prodcard" href="<?php echo esc_url( $bp['url'] ); ?>">
										<?php if ( ! empty( $bp['img'] ) ) : ?><span class="vlx-prodcard__img"><img src="<?php echo esc_url( $bp['img'] ); ?>" alt="<?php echo esc_attr( $bp['name'] ); ?>" loading="lazy"></span><?php endif; ?>
										<span class="vlx-prodcard__name"><?php echo esc_html( $bp['name'] ); ?></span>
										<span class="vlx-prodcard__spec"><?php echo esc_html( $bp['spec'] ); ?></span>
									</a>
								<?php endforeach; ?>
							</div>
							<div class="vlx-mega-foot">
								<span><?php esc_html_e( 'A-merk batterijen · advies op maat', 'voltalux' ); ?></span>
								<a class="vlx-arrow-link" href="#producten" style="color:var(--green-strong)"><?php esc_html_e( 'Alle thuisbatterijen', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
							</div>
						</div>
					</li>
					<?php
					if ( $has_menu ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'items_wrap'     => '%3$s',
								'depth'          => 2,
							)
						);
					} else {
						foreach ( voltalux_fallback_nav() as $item ) {
							printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $item['url'] ), esc_html( $item['label'] ) );
						}
					}
					?>
				</ul>
			</nav>

			<div class="vlx-header-actions">
				<?php if ( $phone ) : ?>
					<a class="vlx-header-phone" href="<?php echo esc_attr( $phone_href ); ?>"><?php echo voltalux_icon( 'phone' ); // phpcs:ignore ?><span><?php echo esc_html( $phone ); ?></span></a>
				<?php endif; ?>
				<?php
				if ( $cta_label ) {
					voltalux_button( array( 'label' => $cta_label, 'url' => $cta_url, 'style' => 'primary', 'attrs' => $open_attrs ) );
				}
				?>
				<button class="vlx-burger" aria-label="<?php esc_attr_e( 'Menu openen', 'voltalux' ); ?>" aria-expanded="false" aria-controls="vlx-m-nav">
					<span></span><span></span><span></span>
				</button>
			</div>
		</div>
	</header>

	<?php /* Mobile menu */ ?>
	<div class="vlx-m-nav" id="vlx-m-nav" aria-label="<?php esc_attr_e( 'Mobiel menu', 'voltalux' ); ?>">
		<div class="vlx-m-nav__top">
			<?php voltalux_branding( 'header' ); ?>
			<button class="vlx-m-close" aria-label="<?php esc_attr_e( 'Menu sluiten', 'voltalux' ); ?>"><?php echo voltalux_icon( 'close' ); // phpcs:ignore ?></button>
		</div>
		<div class="vlx-m-nav__scroll">
			<ul class="vlx-m-list">
				<li class="vlx-m-acc">
					<button class="vlx-m-acc__btn" aria-expanded="false"><?php esc_html_e( 'Diensten', 'voltalux' ); ?> <span class="vlx-ic"><?php echo voltalux_icon( 'plus' ); // phpcs:ignore ?></span></button>
					<div class="vlx-m-acc__panel"><div class="vlx-m-acc__inner"><div class="vlx-m-products">
						<?php foreach ( $services as $s ) : ?>
							<a class="vlx-m-product" href="<?php echo esc_url( $s['url'] ); ?>">
								<span class="vlx-m-product__img"><?php echo voltalux_icon( $s['icon'] ); // phpcs:ignore ?></span>
								<span class="vlx-m-product__t"><?php echo esc_html( $s['name'] ); ?></span>
								<span class="vlx-m-product__d"><?php echo esc_html( $s['desc'] ); ?></span>
							</a>
						<?php endforeach; ?>
					</div></div></div>
				</li>
					<li class="vlx-m-acc">
						<button class="vlx-m-acc__btn" aria-expanded="false"><?php esc_html_e( 'Producten', 'voltalux' ); ?> <span class="vlx-ic"><?php echo voltalux_icon( 'plus' ); // phpcs:ignore ?></span></button>
						<div class="vlx-m-acc__panel"><div class="vlx-m-acc__inner"><div class="vlx-m-products">
							<?php foreach ( voltalux_battery_products() as $bp ) : ?>
								<a class="vlx-m-product vlx-m-product--photo" href="<?php echo esc_url( $bp['url'] ); ?>">
									<span class="vlx-m-product__img"><?php if ( ! empty( $bp['img'] ) ) : ?><img src="<?php echo esc_url( $bp['img'] ); ?>" alt="<?php echo esc_attr( $bp['name'] ); ?>" loading="lazy"><?php else : echo voltalux_icon( 'battery' ); endif; // phpcs:ignore ?></span>
									<span class="vlx-m-product__t"><?php echo esc_html( $bp['name'] ); ?></span>
									<span class="vlx-m-product__d"><?php echo esc_html( $bp['spec'] ); ?></span>
								</a>
							<?php endforeach; ?>
						</div></div></div>
					</li>
				<?php
				if ( $has_menu ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'items_wrap'     => '%3$s',
							'depth'          => 1,
						)
					);
				} else {
					foreach ( voltalux_fallback_nav() as $item ) {
						printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $item['url'] ), esc_html( $item['label'] ) );
					}
				}
				?>
			</ul>
		</div>
		<div class="vlx-m-nav__foot">
			<?php
			if ( $cta_label ) {
				voltalux_button( array( 'label' => $cta_label, 'url' => $cta_url, 'style' => 'primary', 'class' => 'vlx-btn--block', 'attrs' => $open_attrs ) );
			}
			?>
			<div class="vlx-m-nav__meta">
				<?php if ( $phone ) : ?>
					<a href="<?php echo esc_attr( $phone_href ); ?>"><?php echo esc_html( $phone ); ?></a>
				<?php else : ?>
					<span></span>
				<?php endif; ?>
				<?php voltalux_social_icons( 'vlx-m-social' ); ?>
			</div>
		</div>
	</div>
<?php endif; // header location. ?>

<div id="page">
	<main id="main" class="vlx-site-content">
