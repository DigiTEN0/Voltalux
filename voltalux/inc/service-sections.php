<?php
/**
 * Service pillar section renderer (shared).
 *
 * The flexible rich-content sections used on the service pages were previously
 * inlined in page-templates/dienst.php. They live here as one function so the
 * exact same markup can be produced by (a) the page template and (b) the
 * editable Gutenberg block — guaranteeing the front-end stays pixel-identical
 * and SEO-neutral whether a section is coded or block-edited.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'voltalux_section_head' ) ) {
	/**
	 * Section eyebrow + heading (+ optional inline CTA).
	 *
	 * @param array $sec        Section data (eyebrow, title, cta).
	 * @param bool  $inline_cta Render the inline "advies" CTA link.
	 */
	function voltalux_section_head( $sec, $inline_cta = false ) {
		if ( empty( $sec['eyebrow'] ) && empty( $sec['title'] ) ) {
			return;
		}
		if ( ! empty( $sec['eyebrow'] ) ) {
			voltalux_eyebrow( $sec['eyebrow'] );
		}
		if ( ! empty( $sec['title'] ) ) {
			echo '<h2>' . esc_html( $sec['title'] ) . '</h2>';
		}
		if ( $inline_cta && ! empty( $sec['cta'] ) ) {
			printf(
				'<a class="vlx-inline-cta" href="%s"%s>%s %s</a>',
				esc_url( voltalux_page_link( 'contact' ) ),
				' data-vlx-open="offerte"',
				esc_html__( 'Vraag vrijblijvend advies aan', 'voltalux' ),
				voltalux_arrow_svg() // phpcs:ignore
			);
		}
	}
}

if ( ! function_exists( 'voltalux_render_service_section' ) ) {
	/**
	 * Render one flexible service section.
	 *
	 * @param array $sec  Section data (type, eyebrow, title, lead, paras, items, cols, price, list, icon, id, cta, alt).
	 * @param array $opts index (int, for alternating background), phone, tel.
	 */
	function voltalux_render_service_section( $sec, $opts = array() ) {
		$opts   = wp_parse_args(
			$opts,
			array(
				'index' => 1,
				'phone' => voltalux_option( 'phone', VOLTALUX_PHONE ),
				'tel'   => '',
			)
		);
		$phone  = $opts['phone'];
		$tel    = $opts['tel'] ? $opts['tel'] : 'tel:' . preg_replace( '/[^0-9+]/', '', (string) $phone );
		$sec_i  = (int) $opts['index'];

		$stype = isset( $sec['type'] ) ? $sec['type'] : 'text';
		$sid   = ! empty( $sec['id'] ) ? $sec['id'] : '';
		// Wissel de achtergrond af voor ritme, tenzij expliciet gezet.
		$alt   = array_key_exists( 'alt', $sec ) ? (bool) $sec['alt'] : ( 1 === $sec_i % 2 );
		if ( 'feature' === $stype ) { $alt = false; } // donkere band staat op papier-achtergrond
		?>
		<section <?php if ( $sid ) : ?>id="<?php echo esc_attr( $sid ); ?>" <?php endif; ?>class="vlx-section vlx-section--sm<?php echo $alt ? ' vlx-bg-surface' : ''; ?>"<?php echo $alt ? ' style="border-block:1px solid var(--line-2)"' : ''; ?>>
			<div class="vlx-container vlx-container--wide">

				<?php if ( 'feature' === $stype ) : /* donkere accent-band met kernboodschap */ ?>
					<div class="vlx-featband vlx-reveal">
						<span class="vlx-featband__glow" aria-hidden="true"></span>
						<div class="vlx-featband__body">
							<?php if ( ! empty( $sec['icon'] ) ) : ?><span class="vlx-featband__ic"><?php echo voltalux_icon( $sec['icon'] ); // phpcs:ignore ?></span><?php endif; ?>
							<?php if ( ! empty( $sec['eyebrow'] ) ) { voltalux_eyebrow( $sec['eyebrow'], true ); } ?>
							<?php if ( ! empty( $sec['title'] ) ) : ?><h2><?php echo esc_html( $sec['title'] ); ?></h2><?php endif; ?>
							<?php if ( ! empty( $sec['lead'] ) ) : ?><p><?php echo esc_html( $sec['lead'] ); ?></p><?php endif; ?>
							<?php if ( ! empty( $sec['paras'] ) ) : foreach ( $sec['paras'] as $para ) : ?><p><?php echo esc_html( $para ); ?></p><?php endforeach; endif; ?>
							<?php if ( ! empty( $sec['cta'] ) ) : ?>
								<?php voltalux_button( array( 'label' => __( 'Gratis adviesgesprek', 'voltalux' ), 'url' => voltalux_page_link( 'contact' ), 'style' => 'primary', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
								<?php if ( $phone ) { voltalux_button( array( 'label' => __( 'Of bel', 'voltalux' ) . ' ' . $phone, 'url' => $tel, 'style' => 'ghost', 'arrow' => false ) ); } ?>
							<?php endif; ?>
						</div>
					</div>

				<?php elseif ( 'compare' === $stype && ! empty( $sec['cols'] ) ) : ?>
					<div class="vlx-s-head vlx-s-head--center vlx-reveal">
						<?php voltalux_section_head( $sec ); ?>
						<?php if ( ! empty( $sec['lead'] ) ) : ?><p><?php echo esc_html( $sec['lead'] ); ?></p><?php endif; ?>
					</div>
					<div class="vlx-compare vlx-reveal" style="margin-top:2.2rem">
						<?php foreach ( $sec['cols'] as $ci => $col ) : ?>
							<div class="vlx-compare__col vlx-compare__col--<?php echo 0 === $ci ? 'a' : 'b'; ?>">
								<div class="vlx-compare__h"><?php echo esc_html( $col['h'] ); ?></div>
								<?php foreach ( $col['rows'] as $r ) : ?>
									<div class="vlx-compare__row"><div class="vlx-compare__k"><?php echo esc_html( $r['k'] ); ?></div><div class="vlx-compare__v"><?php echo esc_html( $r['v'] ); ?></div></div>
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?>
					</div>
					<?php if ( ! empty( $sec['cta'] ) ) : ?><div style="text-align:center;margin-top:1.9rem"><a class="vlx-inline-cta" href="<?php echo esc_url( voltalux_page_link( 'contact' ) ); ?>" data-vlx-open="offerte"><?php esc_html_e( 'Vraag vrijblijvend advies aan', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a></div><?php endif; ?>

				<?php elseif ( 'cards' === $stype && ! empty( $sec['items'] ) ) : ?>
					<div class="vlx-s-head vlx-s-head--center vlx-reveal">
						<?php voltalux_section_head( $sec ); ?>
						<?php if ( ! empty( $sec['lead'] ) ) : ?><p><?php echo esc_html( $sec['lead'] ); ?></p><?php endif; ?>
					</div>
					<div class="vlx-values" style="margin-top:2.4rem">
						<?php foreach ( $sec['items'] as $it ) : ?>
							<div class="vlx-value vlx-reveal">
								<?php if ( ! empty( $it['icon'] ) ) : ?><div class="vlx-value__icon"><?php echo voltalux_icon( $it['icon'] ); // phpcs:ignore ?></div><?php endif; ?>
								<h3><?php echo esc_html( $it['title'] ); ?></h3>
								<?php if ( ! empty( $it['text'] ) ) : ?><p><?php echo esc_html( $it['text'] ); ?></p><?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>

				<?php elseif ( 'accordion' === $stype && ! empty( $sec['items'] ) ) : ?>
					<div class="vlx-richsplit vlx-reveal">
						<div class="vlx-richsplit__head">
							<?php voltalux_section_head( $sec, true ); ?>
							<?php if ( ! empty( $sec['lead'] ) ) : ?><p class="vlx-richsplit__lead"><?php echo esc_html( $sec['lead'] ); ?></p><?php endif; ?>
						</div>
						<div class="vlx-richsplit__body"><?php voltalux_faq_block( $sec['items'] ); ?></div>
					</div>

				<?php elseif ( ! empty( $sec['title'] ) || ! empty( $sec['eyebrow'] ) ) : /* text -> 2-koloms split */ ?>
					<div class="vlx-richsplit vlx-reveal">
						<div class="vlx-richsplit__head">
							<?php voltalux_section_head( $sec, true ); ?>
						</div>
						<div class="vlx-richsplit__body">
							<?php if ( ! empty( $sec['lead'] ) ) : ?><p class="vlx-richsplit__lead"><?php echo esc_html( $sec['lead'] ); ?></p><?php endif; ?>
							<?php if ( ! empty( $sec['paras'] ) ) : foreach ( $sec['paras'] as $para ) : ?>
								<p><?php echo esc_html( $para ); ?></p>
							<?php endforeach; endif; ?>
							<?php if ( ! empty( $sec['price'] ) ) : ?>
								<div class="vlx-pricecard">
									<?php foreach ( $sec['price'] as $pc ) : ?>
										<div class="vlx-price-chip">
											<div class="vlx-price-chip__v"><?php echo esc_html( $pc['v'] ); ?><?php if ( ! empty( $pc['u'] ) ) : ?> <span><?php echo esc_html( $pc['u'] ); ?></span><?php endif; ?></div>
											<?php if ( ! empty( $pc['l'] ) ) : ?><div class="vlx-price-chip__l"><?php echo esc_html( $pc['l'] ); ?></div><?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $sec['list'] ) ) : ?>
								<ul class="vlx-ticks">
									<?php foreach ( $sec['list'] as $li ) : ?><li><?php echo esc_html( $li ); ?></li><?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>

				<?php else : /* titelloos tekstblok -> smal en rustig */ ?>
					<div class="vlx-container--narrow" style="margin-inline:auto;padding-inline:0">
						<div class="vlx-rich vlx-reveal">
							<?php if ( ! empty( $sec['paras'] ) ) : foreach ( $sec['paras'] as $para ) : ?>
								<p><?php echo esc_html( $para ); ?></p>
							<?php endforeach; endif; ?>
							<?php if ( ! empty( $sec['cta'] ) ) : ?>
								<a class="vlx-inline-cta" href="<?php echo esc_url( voltalux_page_link( 'contact' ) ); ?>" data-vlx-open="offerte"><?php esc_html_e( 'Vraag vrijblijvend advies aan', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</section>
		<?php
	}
}
