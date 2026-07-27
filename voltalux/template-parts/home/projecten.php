<?php
/**
 * Homepage projects — "Onze projecten".
 *
 * @package Voltalux
 */

$eyebrow  = apply_filters( 'voltalux_home_projects_eyebrow', __( 'Onze projecten', 'voltalux' ) );
$title    = apply_filters( 'voltalux_home_projects_title', __( 'Recent afgerond, door heel Nederland', 'voltalux' ) );
$projects = voltalux_projects();

if ( empty( $projects ) ) {
	return;
}
?>
<section class="vlx-section vlx-bg-surface" style="border-top:1px solid var(--line-2)" id="projecten">
	<div class="vlx-container vlx-container--wide">
		<div class="vlx-s-head-row vlx-reveal">
			<div class="vlx-s-head">
				<?php if ( $eyebrow ) { voltalux_eyebrow( $eyebrow ); } ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			</div>
			<?php voltalux_button( array( 'label' => __( 'Alle projecten', 'voltalux' ), 'url' => 'https://www.voltalux.nl/onze-projecten/', 'style' => 'ghost' ) ); ?>
		</div>

		<div class="vlx-projects">
			<?php foreach ( $projects as $p ) : ?>
				<article class="vlx-project vlx-reveal">
					<?php if ( ! empty( $p['img'] ) ) : ?><img class="vlx-project__img" src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['title'] . ' — ' . $p['location'] ); ?>" loading="lazy"><?php endif; ?>
					<span class="vlx-project__cat"><?php echo esc_html( $p['cat'] ); ?></span>
					<h3><?php echo esc_html( $p['title'] ); ?></h3>
					<span class="vlx-project__loc"><?php echo voltalux_icon( 'pin' ); // phpcs:ignore ?><?php echo esc_html( $p['location'] ); ?></span>
					<a class="vlx-project__link" href="<?php echo esc_url( $p['url'] ); ?>" aria-label="<?php echo esc_attr( $p['title'] ); ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
