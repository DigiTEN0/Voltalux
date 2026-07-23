<?php
/**
 * Homepage products — "Onze batterijen".
 *
 * @package Voltalux
 */

$eyebrow   = apply_filters( 'voltalux_home_products_eyebrow', __( 'Onze producten', 'voltalux' ) );
$title     = apply_filters( 'voltalux_home_products_title', __( 'Onze batterijen', 'voltalux' ) );
$btn_label = apply_filters( 'voltalux_home_products_btn_label', __( 'Kies een installateur', 'voltalux' ) );
$btn_url   = apply_filters( 'voltalux_home_products_btn_url', '#contact' );
$products  = voltalux_products();

if ( empty( $products ) ) {
	return;
}
?>
<section class="vlx-section vlx-bg-surface" style="border-block:1px solid var(--line-2)" id="producten">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head-row vlx-reveal">
			<div class="vlx-s-head">
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			</div>
			<?php if ( $btn_label ) { voltalux_button( array( 'label' => $btn_label, 'url' => $btn_url, 'style' => 'dark' ) ); } ?>
		</div>

		<div class="vlx-products">
			<?php
			$i = 0;
			foreach ( $products as $p ) :
				$i++;
				?>
				<article class="vlx-pcard vlx-reveal">
					<div class="vlx-pcard__top">
						<span class="vlx-pcard__tag"><?php echo esc_html( $p['tag'] ); ?></span>
						<span class="vlx-pcard__idx"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></span>
					</div>
					<div class="vlx-pcard__media"><img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( $p['name'] ); ?>" loading="lazy"></div>
					<div class="vlx-pcard__name"><?php echo esc_html( $p['name'] ); ?></div>
					<p class="vlx-pcard__desc"><?php echo esc_html( $p['desc'] ); ?></p>
					<div class="vlx-pcard__foot">
						<span class="vlx-arrow-link"><?php esc_html_e( 'Bekijk', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></span>
					</div>
					<a class="vlx-pcard__link" href="<?php echo esc_url( $p['url'] ); ?>" aria-label="<?php echo esc_attr( $p['name'] ); ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
