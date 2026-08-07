<?php
/**
 * Header.
 *
 * @package Voltalux
 */

$has_hero   = ( is_front_page() && voltalux_use_coded_homepage() );
$has_menu   = has_nav_menu( 'primary' );
$services   = voltalux_services();
$batteries  = function_exists( 'voltalux_batteries' ) ? voltalux_batteries() : array();
$aircos     = function_exists( 'voltalux_aircos' ) ? voltalux_aircos() : array();
$dak_svc    = function_exists( 'voltalux_service' ) ? voltalux_service( 'dakdekker' ) : null;
$dak_links  = ( $dak_svc && ! empty( $dak_svc['links']['items'] ) ) ? $dak_svc['links']['items'] : array();
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

<?php if ( function_exists( 'voltalux_huisscan_enabled' ) && voltalux_huisscan_enabled() ) : ?>
	<a class="vlx-topbar" href="#contact" data-vlx-hsc-open>
		<span class="vlx-topbar__inner">
			<svg class="vlx-topbar__spark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M12 1.5l1.7 6.3a4 4 0 002.5 2.5l6.3 1.7-6.3 1.7a4 4 0 00-2.5 2.5L12 22.5l-1.7-6.3a4 4 0 00-2.5-2.5L1.5 12l6.3-1.7a4 4 0 002.5-2.5z"/></svg>
			<span class="vlx-topbar__txt"><strong><?php esc_html_e( 'Gratis huisscan', 'voltalux' ); ?></strong><span class="vlx-topbar__sub"> — <?php esc_html_e( 'ontdek wat je bespaart', 'voltalux' ); ?></span></span>
			<span class="vlx-topbar__go"><?php echo voltalux_icon( 'arrow-right' ); // phpcs:ignore ?></span>
		</span>
	</a>
<?php endif; ?>

<?php if ( ! voltalux_has_elementor_location( 'header' ) ) : ?>
	<header class="vlx-site-header" id="site-header">
		<div class="vlx-container vlx-container--wide vlx-header-inner">

			<?php voltalux_branding( 'header' ); ?>

			<nav class="vlx-nav" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'voltalux' ); ?>">
				<ul>
					<li><a href="<?php echo esc_url( voltalux_page_link( 'zonnepanelen' ) ); ?>"><?php esc_html_e( 'Zonnepanelen', 'voltalux' ); ?></a></li>
					<li class="has-mega">
						<a href="<?php echo esc_url( voltalux_page_link( 'thuisbatterij' ) ); ?>"><?php esc_html_e( 'Thuisbatterijen', 'voltalux' ); ?></a>
						<div class="vlx-mega vlx-mega--svc">
							<span class="vlx-mega__label"><?php esc_html_e( 'Onze thuisbatterijen', 'voltalux' ); ?></span>
							<div class="vlx-mega-grid">
								<?php foreach ( $batteries as $b ) : ?>
									<a class="vlx-mega-item" href="<?php echo esc_url( voltalux_page_link( $b['slug'] ) ); ?>">
										<span class="vlx-mega-item__img"><?php echo voltalux_icon( 'battery' ); // phpcs:ignore ?></span>
										<span><span class="vlx-mega-item__t"><?php echo esc_html( $b['name'] ); ?></span><span class="vlx-mega-item__d"><?php echo esc_html( $b['badge'] ); ?></span></span>
									</a>
								<?php endforeach; ?>
							</div>
							<div class="vlx-mega-foot">
								<span><?php esc_html_e( 'A-merk · LiFePO4 · 10 jaar garantie', 'voltalux' ); ?></span>
								<a class="vlx-arrow-link" href="<?php echo esc_url( voltalux_page_link( 'thuisbatterij' ) ); ?>" style="color:var(--green-strong)"><?php esc_html_e( 'Vergelijk alle batterijen', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
							</div>
						</div>
					</li>
					<li class="has-mega">
						<a href="<?php echo esc_url( voltalux_page_link( 'aircos' ) ); ?>"><?php esc_html_e( "Airco's", 'voltalux' ); ?></a>
						<div class="vlx-mega vlx-mega--svc">
							<span class="vlx-mega__label"><?php esc_html_e( 'Airconditioning', 'voltalux' ); ?></span>
							<div class="vlx-mega-grid">
								<?php foreach ( $aircos as $a ) : ?>
									<a class="vlx-mega-item" href="<?php echo esc_url( voltalux_page_link( $a['slug'] ) ); ?>">
										<span class="vlx-mega-item__img"><?php echo voltalux_icon( 'snow' ); // phpcs:ignore ?></span>
										<span><span class="vlx-mega-item__t"><?php echo esc_html( $a['name'] ); ?></span><span class="vlx-mega-item__d"><?php echo esc_html( $a['badge'] ); ?></span></span>
									</a>
								<?php endforeach; ?>
							</div>
							<div class="vlx-mega-foot">
								<span><?php esc_html_e( 'Koelen én verwarmen · F-gassen-gecertificeerd', 'voltalux' ); ?></span>
								<a class="vlx-arrow-link" href="<?php echo esc_url( voltalux_page_link( 'aircos' ) ); ?>" style="color:var(--green-strong)"><?php esc_html_e( 'Daikin en LG vergelijken', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
							</div>
						</div>
					</li>
					<li><a href="<?php echo esc_url( voltalux_page_link( 'warmtepompen' ) ); ?>"><?php esc_html_e( 'Warmtepompen', 'voltalux' ); ?></a></li>
					<li class="has-mega">
						<a href="<?php echo esc_url( voltalux_page_link( 'dakdekker' ) ); ?>"><?php esc_html_e( 'Dakrenovatie', 'voltalux' ); ?></a>
						<?php if ( $dak_links ) : ?>
						<div class="vlx-mega vlx-mega--svc">
							<span class="vlx-mega__label"><?php esc_html_e( 'Dakwerkzaamheden', 'voltalux' ); ?></span>
							<div class="vlx-mega-grid">
								<?php foreach ( $dak_links as $dl ) : ?>
									<a class="vlx-mega-item" href="<?php echo esc_url( voltalux_page_link( $dl['slug'] ) ); ?>">
										<span class="vlx-mega-item__img"><?php echo voltalux_icon( isset( $dl['icon'] ) ? $dl['icon'] : 'roof' ); // phpcs:ignore ?></span>
										<span><span class="vlx-mega-item__t"><?php echo esc_html( $dl['label'] ); ?></span><span class="vlx-mega-item__d"><?php echo esc_html( $dl['text'] ); ?></span></span>
									</a>
								<?php endforeach; ?>
							</div>
							<div class="vlx-mega-foot">
								<span><?php esc_html_e( 'Erkende dakdekkers · gratis dakinspectie', 'voltalux' ); ?></span>
								<a class="vlx-arrow-link" href="<?php echo esc_url( voltalux_page_link( 'dakdekker' ) ); ?>" style="color:var(--green-strong)"><?php esc_html_e( 'Alles over dakrenovatie', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
							</div>
						</div>
						<?php endif; ?>
					</li>
					<li><a href="<?php echo esc_url( voltalux_page_link( 'zakelijk' ) ); ?>"><?php esc_html_e( 'Zakelijk', 'voltalux' ); ?></a></li>
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
					<li><a href="<?php echo esc_url( voltalux_page_link( 'zonnepanelen' ) ); ?>"><?php esc_html_e( 'Zonnepanelen', 'voltalux' ); ?></a></li>
				<li class="vlx-m-acc">
					<button class="vlx-m-acc__btn" aria-expanded="false"><?php esc_html_e( 'Thuisbatterijen', 'voltalux' ); ?> <span class="vlx-ic"><?php echo voltalux_icon( 'plus' ); // phpcs:ignore ?></span></button>
					<div class="vlx-m-acc__panel"><div class="vlx-m-acc__inner"><div class="vlx-m-products">
						<?php foreach ( $batteries as $b ) : ?>
								<a class="vlx-m-product" href="<?php echo esc_url( voltalux_page_link( $b['slug'] ) ); ?>">
									<span class="vlx-m-product__img"><?php echo voltalux_icon( 'battery' ); // phpcs:ignore ?></span>
									<span class="vlx-m-product__t"><?php echo esc_html( $b['name'] ); ?></span>
									<span class="vlx-m-product__d"><?php echo esc_html( $b['badge'] ); ?></span>
								</a>
							<?php endforeach; ?>
							<a class="vlx-m-product vlx-m-product--all" href="<?php echo esc_url( voltalux_page_link( 'thuisbatterij' ) ); ?>">
								<span class="vlx-m-product__t"><?php esc_html_e( 'Alle batterijen vergelijken', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
							</a>
					</div></div></div>
				</li>
					<li class="vlx-m-acc">
						<button class="vlx-m-acc__btn" aria-expanded="false"><?php esc_html_e( 'Airconditioning', 'voltalux' ); ?> <span class="vlx-ic"><?php echo voltalux_icon( 'plus' ); // phpcs:ignore ?></span></button>
						<div class="vlx-m-acc__panel"><div class="vlx-m-acc__inner"><div class="vlx-m-products">
							<?php foreach ( $aircos as $a ) : ?>
									<a class="vlx-m-product" href="<?php echo esc_url( voltalux_page_link( $a['slug'] ) ); ?>">
										<span class="vlx-m-product__img"><?php echo voltalux_icon( 'snow' ); // phpcs:ignore ?></span>
										<span class="vlx-m-product__t"><?php echo esc_html( $a['name'] ); ?></span>
										<span class="vlx-m-product__d"><?php echo esc_html( $a['badge'] ); ?></span>
									</a>
								<?php endforeach; ?>
								<a class="vlx-m-product vlx-m-product--all" href="<?php echo esc_url( voltalux_page_link( 'aircos' ) ); ?>">
									<span class="vlx-m-product__t"><?php esc_html_e( 'Daikin en LG vergelijken', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
								</a>
						</div></div></div>
					</li>
					<li><a href="<?php echo esc_url( voltalux_page_link( 'warmtepompen' ) ); ?>"><?php esc_html_e( 'Warmtepompen', 'voltalux' ); ?></a></li>
					<?php if ( $dak_links ) : ?>
					<li class="vlx-m-acc">
						<button class="vlx-m-acc__btn" aria-expanded="false"><?php esc_html_e( 'Dakrenovatie', 'voltalux' ); ?> <span class="vlx-ic"><?php echo voltalux_icon( 'plus' ); // phpcs:ignore ?></span></button>
						<div class="vlx-m-acc__panel"><div class="vlx-m-acc__inner"><div class="vlx-m-products">
							<?php foreach ( $dak_links as $dl ) : ?>
								<a class="vlx-m-product" href="<?php echo esc_url( voltalux_page_link( $dl['slug'] ) ); ?>">
									<span class="vlx-m-product__img"><?php echo voltalux_icon( isset( $dl['icon'] ) ? $dl['icon'] : 'roof' ); // phpcs:ignore ?></span>
									<span class="vlx-m-product__t"><?php echo esc_html( $dl['label'] ); ?></span>
									<span class="vlx-m-product__d"><?php echo esc_html( $dl['text'] ); ?></span>
								</a>
							<?php endforeach; ?>
							<a class="vlx-m-product vlx-m-product--all" href="<?php echo esc_url( voltalux_page_link( 'dakdekker' ) ); ?>">
								<span class="vlx-m-product__t"><?php esc_html_e( 'Alles over dakrenovatie', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
							</a>
						</div></div></div>
					</li>
					<?php endif; ?>
					<li><a href="<?php echo esc_url( voltalux_page_link( 'zakelijk' ) ); ?>"><?php esc_html_e( 'Zakelijk', 'voltalux' ); ?></a></li>
					<li><a href="<?php echo esc_url( voltalux_page_link( 'werkwijze' ) ); ?>"><?php esc_html_e( 'Werkwijze', 'voltalux' ); ?></a></li>
					<li><a href="<?php echo esc_url( voltalux_page_link( 'onze-projecten' ) ); ?>"><?php esc_html_e( 'Projecten', 'voltalux' ); ?></a></li>
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
