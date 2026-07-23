<?php
/**
 * Post card (blog/archive grids).
 *
 * @package Voltalux
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'vlx-card' ); ?>>
	<?php voltalux_post_thumbnail( 'medium_large' ); ?>
	<div class="vlx-card__body">
		<div class="vlx-card__meta"><?php voltalux_posted_on(); ?></div>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
		<a class="vlx-arrow-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Lees meer', 'voltalux' ); ?> <?php echo voltalux_arrow_svg(); // phpcs:ignore ?></a>
	</div>
</article>
