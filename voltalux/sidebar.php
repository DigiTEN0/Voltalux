<?php
/**
 * Blog sidebar.
 *
 * @package Voltalux
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	?>
	<aside class="vlx-sidebar" aria-label="<?php esc_attr_e( 'Zijbalk', 'voltalux' ); ?>">
		<div class="widget">
			<h4 class="widget__title"><?php esc_html_e( 'Zoeken', 'voltalux' ); ?></h4>
			<?php get_search_form(); ?>
		</div>
		<div class="widget">
			<h4 class="widget__title"><?php esc_html_e( 'Recente artikelen', 'voltalux' ); ?></h4>
			<ul>
				<?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => 6 ) ); ?>
			</ul>
		</div>
	</aside>
	<?php
	return;
}
?>
<aside class="vlx-sidebar" aria-label="<?php esc_attr_e( 'Zijbalk', 'voltalux' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
