<?php
/**
 * Homepage products — "Onze batterijen".
 *
 * Cards use a clean placeholder illustration by default; set an `image` URL
 * (via the voltalux_home_products filter) or rebuild the whole section in
 * Elementor to drop in real product photos.
 *
 * @package Voltalux
 */

$img_battery = VOLTALUX_URI . 'assets/images/battery.svg';
$img_solar   = VOLTALUX_URI . 'assets/images/solar-battery.svg';

$section_title = apply_filters( 'voltalux_home_products_title', __( 'Onze batterijen', 'voltalux' ) );
$section_eye   = apply_filters( 'voltalux_home_products_eyebrow', __( 'Onze producten', 'voltalux' ) );
$btn_label     = apply_filters( 'voltalux_home_products_btn_label', __( 'Kiezen van een installateur', 'voltalux' ) );
$btn_url       = apply_filters( 'voltalux_home_products_btn_url', '#contact' );

$products = apply_filters(
	'voltalux_home_products',
	array(
		array( 'name' => 'AEG',          'sub' => __( 'Duits kwaliteitsmerk', 'voltalux' ),        'image' => $img_battery, 'url' => '#aeg' ),
		array( 'name' => 'HyxiPower',    'sub' => __( 'All-in-one systeem', 'voltalux' ),          'image' => $img_battery, 'url' => '#hyxipower' ),
		array( 'name' => 'AlphaESS',     'sub' => __( 'Slim & uitbreidbaar', 'voltalux' ),         'image' => $img_battery, 'url' => '#alphaess' ),
		array( 'name' => __( '+ Zonnepanelen', 'voltalux' ), 'sub' => __( 'Compleet pakket', 'voltalux' ), 'image' => $img_solar, 'url' => '#zonnepanelen' ),
	)
);

if ( empty( $products ) ) {
	return;
}
?>
<section class="vlx-section vlx-bg-cloud" id="producten">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-head__row vlx-reveal">
			<div class="vlx-head">
				<?php if ( $section_eye ) { voltalux_eyebrow( $section_eye ); } ?>
				<h2><?php echo esc_html( $section_title ); ?></h2>
			</div>
			<?php if ( $btn_label ) { voltalux_button( array( 'label' => $btn_label, 'url' => $btn_url, 'style' => 'dark' ) ); } ?>
		</div>

		<div class="vlx-products__grid">
			<?php foreach ( $products as $product ) : ?>
				<article class="vlx-pcard vlx-reveal">
					<div class="vlx-pcard__media">
						<?php if ( ! empty( $product['image'] ) ) : ?>
							<img src="<?php echo esc_url( $product['image'] ); ?>" alt="<?php echo esc_attr( $product['name'] ); ?>" loading="lazy">
						<?php endif; ?>
					</div>
					<h3 class="vlx-pcard__title"><?php echo esc_html( $product['name'] ); ?></h3>
					<?php if ( ! empty( $product['sub'] ) ) : ?>
						<p class="vlx-pcard__sub"><?php echo esc_html( $product['sub'] ); ?></p>
					<?php endif; ?>
					<span class="vlx-pcard__cta"><?php esc_html_e( 'Meer informatie', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
					<?php if ( ! empty( $product['url'] ) ) : ?>
						<a class="vlx-pcard__link" href="<?php echo esc_url( $product['url'] ); ?>" aria-label="<?php echo esc_attr( $product['name'] ); ?>"></a>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
