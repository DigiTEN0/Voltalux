<?php
/**
 * Reusable content blocks used by the product / overview / business pages.
 *
 * Each renderer follows the layout advice from the client's briefing:
 * comparison tables scroll horizontally on mobile (never re-stack), FAQs use
 * native <details> (accessible, no JS) and are wired to FAQPage schema.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Premium page hero used on all content pages — dark, with a brand-green glow,
 * a subtle grid, an optional icon watermark and an optional right-hand media slot.
 * Mirrors the homepage hero's energy so the inner pages feel just as high-end.
 *
 * @param array $args eyebrow, title, lead, crumbs, icon, media, flush
 */
function voltalux_page_hero( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array( 'eyebrow' => '', 'title' => '', 'lead' => '', 'crumbs' => array(), 'icon' => '', 'media' => '', 'flush' => false, 'cta' => '' )
	);
	$classes = 'vlx-phero';
	if ( $args['media'] ) { $classes .= ' vlx-phero--split'; }
	if ( $args['flush'] ) { $classes .= ' vlx-phero--flush'; }
	?>
	<header class="<?php echo esc_attr( $classes ); ?>">
		<span class="vlx-phero__glow" aria-hidden="true"></span>
		<span class="vlx-phero__grid" aria-hidden="true"></span>
		<?php if ( $args['icon'] ) : ?>
			<span class="vlx-phero__mark" aria-hidden="true"><?php echo voltalux_icon( $args['icon'] ); // phpcs:ignore ?></span>
		<?php endif; ?>
		<div class="vlx-container vlx-container--wide vlx-phero__inner">
			<div class="vlx-phero__body">
				<?php if ( ! empty( $args['crumbs'] ) ) : ?>
					<nav class="vlx-crumbs" aria-label="<?php esc_attr_e( 'Kruimelpad', 'voltalux' ); ?>">
						<?php
						$last = count( $args['crumbs'] ) - 1;
						foreach ( $args['crumbs'] as $i => $c ) {
							if ( ! empty( $c['url'] ) && $i !== $last ) {
								printf( '<a href="%s">%s</a><span aria-hidden="true">/</span>', esc_url( $c['url'] ), esc_html( $c['label'] ) );
							} else {
								printf( '<span>%s</span>', esc_html( $c['label'] ) );
							}
						}
						?>
					</nav>
				<?php endif; ?>
				<?php if ( $args['eyebrow'] ) { voltalux_eyebrow( $args['eyebrow'], true ); } ?>
				<?php if ( $args['title'] ) : ?><h1><?php echo wp_kses_post( do_shortcode( voltalux_mark_shortcode_content( $args['title'] ) ) ); ?></h1><?php endif; ?>
				<?php if ( $args['lead'] ) : ?><p class="vlx-phero__lead"><?php echo esc_html( $args['lead'] ); ?></p><?php endif; ?>
				<?php if ( $args['cta'] ) : ?><div class="vlx-phero__cta"><?php echo $args['cta']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div><?php endif; ?>
			</div>
			<?php if ( $args['media'] ) : ?>
				<div class="vlx-phero__media"><?php echo $args['media']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<?php endif; ?>
		</div>
	</header>
	<?php
}

/**
 * Four key-points bar (eigen monteurs · garantie · vaste adviseur · all-in prijs).
 */
function voltalux_keypoints_bar() {
	$points = voltalux_product_keypoints();
	if ( empty( $points ) ) {
		return;
	}
	echo '<div class="vlx-keypoints">';
	foreach ( $points as $p ) {
		printf(
			'<div class="vlx-keypoint"><span class="vlx-keypoint__ic">%s</span><span>%s</span></div>',
			voltalux_icon( $p['icon'] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			esc_html( $p['label'] )
		);
	}
	echo '</div>';
}

/**
 * "Voor wie wel / voor wie niet" two-column block.
 *
 * @param array $for     Bullets.
 * @param array $not_for Bullets.
 */
function voltalux_for_whom( $for = array(), $not_for = array() ) {
	if ( empty( $for ) && empty( $not_for ) ) {
		return;
	}
	?>
	<div class="vlx-forwhom">
		<?php if ( ! empty( $for ) ) : ?>
			<div class="vlx-forwhom__col vlx-forwhom__col--yes">
				<h3><span class="vlx-forwhom__ic"><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?></span><?php esc_html_e( 'Voor wie dit past', 'voltalux' ); ?></h3>
				<ul>
					<?php foreach ( $for as $item ) : ?>
						<li><?php echo voltalux_icon( 'check' ); // phpcs:ignore ?><span><?php echo esc_html( $item ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $not_for ) ) : ?>
			<div class="vlx-forwhom__col vlx-forwhom__col--no">
				<h3><span class="vlx-forwhom__ic"><?php echo voltalux_icon( 'close' ); // phpcs:ignore ?></span><?php esc_html_e( 'Waarschijnlijk niet voor jou', 'voltalux' ); ?></h3>
				<ul>
					<?php foreach ( $not_for as $item ) : ?>
						<li><?php echo voltalux_icon( 'close' ); // phpcs:ignore ?><span><?php echo esc_html( $item ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Pick a fitting line icon for a "techniek" item from its heading keyword.
 *
 * @param string $heading Item heading.
 * @return string Icon key understood by voltalux_icon().
 */
function voltalux_tech_icon( $heading ) {
	$h = function_exists( 'mb_strtolower' ) ? mb_strtolower( $heading ) : strtolower( $heading );
	$map = array(
		'verwarm' => 'heat', 'warmt' => 'heat', 'warm' => 'heat',
		'koel' => 'snow', 'koud' => 'snow',
		'koudemiddel' => 'leaf', 'r-32' => 'leaf', 'r32' => 'leaf',
		'lucht' => 'leaf', 'reinig' => 'leaf', 'filter' => 'leaf', 'streamer' => 'leaf', 'ionizer' => 'leaf', 'uv' => 'leaf', 'plasma' => 'leaf',
		'app' => 'headset', 'onecta' => 'headset', 'thinq' => 'headset', 'bedien' => 'headset',
		'sensor' => 'spark', 'beweging' => 'spark', 'ai' => 'spark',
		'inverter' => 'lightning', 'compressor' => 'lightning', 'rendement' => 'lightning',
	);
	foreach ( $map as $needle => $icon ) {
		if ( false !== strpos( $h, $needle ) ) {
			return $icon;
		}
	}
	return 'spark';
}

/**
 * A models table (cols + rows). Scrolls horizontally on mobile.
 *
 * @param array  $models array( 'cols' => [], 'rows' => [[]], 'note' => '' )
 * @param string $caption Optional visually-hidden caption.
 */
function voltalux_models_table( $models, $caption = '' ) {
	if ( empty( $models['rows'] ) ) {
		return;
	}
	$cols = ! empty( $models['cols'] ) ? $models['cols'] : array();
	?>
	<div class="vlx-rtable-wrap">
		<table class="vlx-rtable" aria-label="<?php echo esc_attr( $caption ? $caption : __( 'Modellen', 'voltalux' ) ); ?>">
			<?php if ( $cols ) : ?>
				<thead><tr>
					<?php foreach ( $cols as $col ) : ?>
						<th scope="col"><?php echo esc_html( $col ); ?></th>
					<?php endforeach; ?>
				</tr></thead>
			<?php endif; ?>
			<tbody>
				<?php foreach ( $models['rows'] as $row ) : ?>
					<tr>
						<?php foreach ( $row as $i => $cell ) : ?>
							<?php if ( 0 === $i ) : ?>
								<th scope="row"><?php echo esc_html( $cell ); ?></th>
							<?php else : ?>
								<td data-label="<?php echo esc_attr( isset( $cols[ $i ] ) ? $cols[ $i ] : '' ); ?>"><?php echo esc_html( $cell ); ?></td>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php if ( ! empty( $models['note'] ) ) : ?>
		<p class="vlx-table-note"><?php echo esc_html( $models['note'] ); ?></p>
	<?php endif; ?>
	<?php
}

/**
 * Specs list (label/value pairs).
 *
 * @param array $specs array( array( label, value ), ... )
 */
function voltalux_spec_list( $specs ) {
	if ( empty( $specs ) ) {
		return;
	}
	echo '<dl class="vlx-specs">';
	foreach ( $specs as $s ) {
		printf(
			'<div class="vlx-specs__row"><dt>%s</dt><dd>%s</dd></div>',
			esc_html( $s[0] ),
			esc_html( $s[1] )
		);
	}
	echo '</dl>';
}

/**
 * Brand comparison table with a highlighted first-column label and brand header.
 * Horizontal scroll on mobile — columns never re-stack (per the briefing).
 *
 * @param array  $data  array( 'brands' => [], 'rows' => [[label, ...values]] )
 * @param array  $links Optional map brandName => url (adds a link row).
 */
function voltalux_compare_table( $data, $links = array() ) {
	if ( empty( $data['rows'] ) ) {
		return;
	}
	$brands = ! empty( $data['brands'] ) ? $data['brands'] : array();
	?>
	<div class="vlx-rtable-wrap">
		<table class="vlx-rtable vlx-rtable--compare" aria-label="<?php esc_attr_e( 'Vergelijking', 'voltalux' ); ?>">
			<thead>
				<tr>
					<th scope="col"><span class="screen-reader-text"><?php esc_html_e( 'Kenmerk', 'voltalux' ); ?></span></th>
					<?php foreach ( $brands as $brand ) : ?>
						<th scope="col"><?php echo esc_html( $brand ); ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $data['rows'] as $r => $row ) : ?>
					<tr<?php echo 0 === $r ? ' class="vlx-rtable__lead"' : ''; ?>>
						<?php foreach ( $row as $i => $cell ) : ?>
							<?php if ( 0 === $i ) : ?>
								<th scope="row"><?php echo esc_html( $cell ); ?></th>
							<?php else : ?>
								<td data-label="<?php echo esc_attr( isset( $brands[ $i - 1 ] ) ? $brands[ $i - 1 ] : '' ); ?>"><?php echo esc_html( $cell ); ?></td>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
				<?php if ( ! empty( $links ) ) : ?>
					<tr class="vlx-rtable__cta">
						<th scope="row"><span class="screen-reader-text"><?php esc_html_e( 'Bekijk merk', 'voltalux' ); ?></span></th>
						<?php foreach ( $brands as $brand ) : ?>
							<td data-label="<?php echo esc_attr( $brand ); ?>">
								<?php if ( ! empty( $links[ $brand ] ) ) : ?>
									<a class="vlx-arrow-link" href="<?php echo esc_url( $links[ $brand ] ); ?>"><?php esc_html_e( 'Bekijken', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
								<?php endif; ?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}

/**
 * FAQ accordion using native <details>. Also collects the Q&A for FAQPage schema.
 *
 * @param array  $faq   array( array( question, answer ), ... )
 * @param string $title Optional heading.
 */
function voltalux_faq_block( $faq, $title = '' ) {
	if ( empty( $faq ) ) {
		return;
	}
	// Register with the schema collector (inc/schema.php).
	if ( function_exists( 'voltalux_register_faq' ) ) {
		voltalux_register_faq( $faq );
	}
	?>
	<div class="vlx-faq">
		<?php if ( $title ) : ?><h2 class="vlx-faq__title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
		<div class="vlx-faq__list">
			<?php foreach ( $faq as $item ) : ?>
				<details class="vlx-faq__item">
					<summary>
						<span><?php echo esc_html( $item[0] ); ?></span>
						<span class="vlx-faq__mark" aria-hidden="true"><?php echo voltalux_icon( 'plus' ); // phpcs:ignore ?></span>
					</summary>
					<?php if ( ! empty( $item[1] ) ) : ?>
						<div class="vlx-faq__a"><p><?php echo esc_html( $item[1] ); ?></p></div>
					<?php endif; ?>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

/**
 * A dark call-to-action band reused across content pages.
 *
 * @param array $args eyebrow, title, text
 */
function voltalux_cta_band( $args = array() ) {
	$args  = wp_parse_args(
		$args,
		array(
			'eyebrow' => __( 'Neem de eerste stap', 'voltalux' ),
			'title'   => __( 'Vraag vrijblijvend een adviesgesprek aan', 'voltalux' ),
			'text'    => __( 'We rekenen je situatie eerlijk door — ook als de conclusie is dat je beter even kunt wachten.', 'voltalux' ),
		)
	);
	$phone = voltalux_option( 'phone', VOLTALUX_PHONE );
	?>
	<section class="vlx-section vlx-cta">
		<div class="vlx-container vlx-container--wide">
			<div class="vlx-cta__box vlx-reveal">
				<div>
					<?php voltalux_eyebrow( $args['eyebrow'], true ); ?>
					<h2 style="margin-top:1rem"><?php echo esc_html( $args['title'] ); ?></h2>
					<p><?php echo esc_html( $args['text'] ); ?></p>
				</div>
				<div class="vlx-cta__actions">
					<?php voltalux_button( array( 'label' => __( 'Adviesgesprek aanvragen', 'voltalux' ), 'url' => '#contact', 'style' => 'primary', 'size' => 'lg', 'attrs' => array( 'data-vlx-open' => 'offerte' ) ) ); ?>
					<?php if ( $phone ) { voltalux_button( array( 'label' => __( 'Bel', 'voltalux' ) . ' ' . $phone, 'url' => 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ), 'style' => 'ghost', 'size' => 'lg', 'arrow' => false ) ); } ?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Related-projects strip filtered to a product kind/brand (point 12: projectfoto's).
 *
 * @param string $match Category/brand substring to match, or '' for latest.
 */
function voltalux_project_strip( $match = '' ) {
	$all = function_exists( 'voltalux_projects' ) ? voltalux_projects() : array();
	if ( $match ) {
		// Matching category first, then pad with other recent projects so the
		// strip always shows a full row of three (never just one).
		$matched = array();
		$rest    = array();
		foreach ( $all as $v ) {
			if ( false !== stripos( $v['cat'] . ' ' . $v['title'], $match ) ) {
				$matched[] = $v;
			} else {
				$rest[] = $v;
			}
		}
		$all = array_merge( $matched, $rest );
	}
	$projects = array_slice( $all, 0, 3 );
	if ( empty( $projects ) ) {
		return;
	}
	?>
	<div class="vlx-projects">
		<?php foreach ( $projects as $p ) : ?>
			<article class="vlx-project">
				<?php if ( ! empty( $p['img'] ) ) : ?><img class="vlx-project__img" src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['title'] . ' — ' . $p['location'] ); ?>" loading="lazy"><?php endif; ?>
				<span class="vlx-project__cat"><?php echo esc_html( $p['cat'] ); ?></span>
				<h3><?php echo esc_html( $p['title'] ); ?></h3>
				<span class="vlx-project__loc"><?php echo voltalux_icon( 'pin' ); // phpcs:ignore ?><?php echo esc_html( $p['location'] ); ?></span>
			</article>
		<?php endforeach; ?>
	</div>
	<?php
}
