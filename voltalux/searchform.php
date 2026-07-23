<?php
/**
 * Search form.
 *
 * @package Voltalux
 */
?>
<form role="search" method="get" class="vlx-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="vlx-search-<?php echo esc_attr( uniqid() ); ?>"><?php esc_html_e( 'Zoeken naar:', 'voltalux' ); ?></label>
	<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Waar ben je naar op zoek?', 'voltalux' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit vlx-btn vlx-btn--dark"><span><?php esc_html_e( 'Zoek', 'voltalux' ); ?></span></button>
</form>
