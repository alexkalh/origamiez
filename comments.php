<?php
if ( post_password_required() ) {
	return;
}

if ( ! comments_open() ) {
	return;
}
?>

<div class="comments-area widget" id="comments">
    <?php if ( have_comments() ) : ?>
        <h2 class="widget-title comments-title clearfix">
            <?php echo wp_kses( sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'origamiez' ), get_comments_number() ), origamiez_get_allowed_tags() ); ?>
        </h2>

        <div class="origamiez-widget-content clearfix">

            <ol class="comment-list">
                <?php
				wp_list_comments(array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 50,
					'callback'    => 'origamiez_list_comments',
				));
				?>
            </ol><!-- .comment-list -->

            <?php
			paginate_comments_links(array(
				'prev_text' => esc_attr__( '<span>&laquo;</span> Previous', 'origamiez' ),
				'next_text' => esc_attr__( 'Next <span>&raquo;</span>', 'origamiez' ),
			));
			?>

            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'origamiez' ); ?></p>
            <?php endif; ?>
        </div>

    <?php endif; ?>

    <?php origamiez_comment_form(); ?>

</div><!-- #comments -->
