<?php
/**
 * Homepage testimonial — featured quote + review cards.
 *
 * @package Voltalux
 */

$eyebrow = apply_filters( 'voltalux_home_reviews_eyebrow', __( 'Ervaringen', 'voltalux' ) );
$title   = apply_filters( 'voltalux_home_reviews_title', __( 'Wat onze klanten vertellen', 'voltalux' ) );
$quote   = apply_filters( 'voltalux_home_quote', __( 'Vanaf het eerste gesprek tot en met de installatie is alles prima verlopen. Rustig en vakkundig uitgelegd, netjes geïnstalleerd. Echt een aanrader.', 'voltalux' ) );
$author  = apply_filters( 'voltalux_home_quote_author', __( 'Maarten K.', 'voltalux' ) );
$role    = apply_filters( 'voltalux_home_quote_role', __( 'Klant van Voltalux', 'voltalux' ) );

$reviews = apply_filters(
	'voltalux_home_reviews',
	array(
		array( 'text' => __( 'Zeer duidelijk en eerlijk adviesgesprek. Geen druk, wel een goed verhaal. Nu een slimme thuisbatterij en blij mee.', 'voltalux' ), 'name' => 'Jan de B.' ),
		array( 'text' => __( 'Uitstekende ondersteuning gedurende het hele traject. Vaste contactpersoon die alles netjes regelde.', 'voltalux' ), 'name' => 'Marc P.' ),
		array( 'text' => __( 'Snelle, nette installatie en een team dat meedenkt. Precies zoals beloofd.', 'voltalux' ), 'name' => 'Cheryl B.' ),
	)
);

$google = '<svg width="14" height="14" viewBox="0 0 48 48" aria-hidden="true"><path fill="#4285F4" d="M45.1 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h11.8c-.5 2.7-2 5-4.3 6.6v5.5h7C42.6 36.9 45.1 31.2 45.1 24.5z"/><path fill="#34A853" d="M24 46c5.8 0 10.7-1.9 14.3-5.2l-7-5.5c-1.9 1.3-4.4 2.1-7.3 2.1-5.6 0-10.3-3.8-12-8.9H4.8v5.7C8.4 41.4 15.6 46 24 46z"/><path fill="#FBBC05" d="M12 28.5c-.4-1.3-.7-2.7-.7-4.1s.3-2.8.7-4.1v-5.7H4.8C3.4 17.4 2.6 20.6 2.6 24s.8 6.6 2.2 9.4L12 28.5z"/><path fill="#EA4335" d="M24 11c3.2 0 6 1.1 8.2 3.2l6.1-6.1C34.7 4.5 29.8 2.6 24 2.6 15.6 2.6 8.4 7.2 4.8 14.6l7.2 5.7C13.7 14.8 18.4 11 24 11z"/></svg>';
?>
<section class="vlx-section" id="ervaringen">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head vlx-reveal" style="margin-bottom:2.4rem">
			<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
			<h2><?php echo esc_html( $title ); ?></h2>
		</div>

		<div class="vlx-quote vlx-reveal">
			<div class="vlx-quote__inner">
				<div class="vlx-quote__rating"><span class="vlx-stars">★★★★★</span> <?php echo $google; // phpcs:ignore ?> <span><?php esc_html_e( '4.8 gemiddeld · via Google', 'voltalux' ); ?></span></div>
				<blockquote>&bdquo;<?php echo esc_html( $quote ); ?>&rdquo;</blockquote>
				<div class="vlx-quote__by"><b><?php echo esc_html( $author ); ?></b><span>— <?php echo esc_html( $role ); ?></span></div>
			</div>
		</div>

		<?php if ( ! empty( $reviews ) ) : ?>
			<div class="vlx-reviews">
				<?php foreach ( $reviews as $review ) : ?>
					<div class="vlx-review vlx-reveal">
						<span class="vlx-stars" aria-label="<?php esc_attr_e( '5 van de 5 sterren', 'voltalux' ); ?>">★★★★★</span>
						<p><?php echo esc_html( $review['text'] ); ?></p>
						<div class="vlx-review__foot">
							<span class="vlx-review__name"><?php echo esc_html( $review['name'] ); ?></span>
							<span class="vlx-review__src"><?php echo $google; // phpcs:ignore ?> Google</span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
