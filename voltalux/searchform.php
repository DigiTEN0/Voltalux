<?php
/**
 * Search form.
 *
 * @package Voltalux
 */
$vlx_id = 'vlx-search-' . wp_unique_id();
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $vlx_id ); ?>"><?php esc_html_e( 'Zoeken naar:', 'voltalux' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $vlx_id ); ?>" class="search-field" placeholder="<?php esc_attr_e( 'Waar ben je naar op zoek?', 'voltalux' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit vlx-btn vlx-btn--dark"><?php esc_html_e( 'Zoek', 'voltalux' ); ?></button>
</form>
