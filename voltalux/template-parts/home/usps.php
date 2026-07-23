<?php
/**
 * Homepage USP row.
 *
 * @package Voltalux
 */

$icons = array(
	'advice'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.4 8.4 0 01-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 01-.9-3.8 8.5 8.5 0 014.7-7.6A8.4 8.4 0 0112.5 3H13a8.5 8.5 0 018 8v.5z"/></svg>',
	'install' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a4 4 0 00-5.4 5.4l-6.6 6.6a1.5 1.5 0 002.1 2.1l6.6-6.6a4 4 0 005.4-5.4l-2.8 2.8-1.9-.4-.4-1.9 2.9-2.9z"/></svg>',
	'care'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 00-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg>',
	'shield'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.5-3 8.5-7 10-4-1.5-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/></svg>',
);

$usps = apply_filters(
	'voltalux_home_usps',
	array(
		array( 'icon' => $icons['advice'], 'title' => __( 'Advies op maat', 'voltalux' ), 'text' => __( 'Eerlijk en onafhankelijk advies dat écht bij jouw situatie past — geen verkooppraatjes.', 'voltalux' ) ),
		array( 'icon' => $icons['install'], 'title' => __( 'Gecertificeerde installatie', 'voltalux' ), 'text' => __( 'Vakkundig geïnstalleerd volgens de voorschriften van de fabrikant en alle veiligheidsnormen.', 'voltalux' ) ),
		array( 'icon' => $icons['care'], 'title' => __( 'Volledige ontzorging', 'voltalux' ), 'text' => __( 'Van eerste gesprek tot oplevering regelen wij alles voor je. Jij hoeft nergens naar om te kijken.', 'voltalux' ) ),
		array( 'icon' => $icons['shield'], 'title' => __( 'Maximale zekerheid', 'voltalux' ), 'text' => __( 'Volledige garantie, monitoring en onderhoud. Zo haal je gegarandeerd het meeste uit je systeem.', 'voltalux' ) ),
	)
);

if ( empty( $usps ) ) {
	return;
}
?>
<section class="vlx-section vlx-section--tight" id="waarom">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-usps">
			<?php foreach ( $usps as $usp ) : ?>
				<div class="vlx-usp vlx-reveal">
					<div class="vlx-usp__icon"><?php echo $usp['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG. ?></div>
					<h3><?php echo esc_html( $usp['title'] ); ?></h3>
					<p><?php echo esc_html( $usp['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
