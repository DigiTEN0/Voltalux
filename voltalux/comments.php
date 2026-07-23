<?php
/**
 * Comments template.
 *
 * @package Voltalux
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="vlx-comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="vlx-comments__title">
			<?php
			$count = get_comments_number();
			if ( '1' === (string) $count ) {
				esc_html_e( '1 reactie', 'voltalux' );
			} else {
				/* translators: %s: comment count. */
				printf( esc_html__( '%s reacties', 'voltalux' ), esc_html( number_format_i18n( $count ) ) );
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => __( '&larr;', 'voltalux' ),
				'next_text' => __( '&rarr;', 'voltalux' ),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Reacties zijn gesloten.', 'voltalux' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_form'         => 'vlx-comment-form',
			'title_reply_before' => '<h3 class="vlx-comment-reply-title">',
			'title_reply_after'  => '</h3>',
			'title_reply'        => __( 'Laat een reactie achter', 'voltalux' ),
			'label_submit'       => __( 'Plaats reactie', 'voltalux' ),
		)
	);
	?>
</div>
