<?php
if (post_password_required()) {
    return;
}

if (!comments_open()) {
    return;
}
?>

<div class="comments-area widget" id="comments">
    <?php if (have_comments()) : ?>
        <h2 class="widget-title comments-title clearfix">
            <?php
            printf(_n('%1$s Comment', '%1$s Comments', get_comments_number(), ct_get_domain()), get_comments_number());
            ?> 
        </h2>

        <div class="ct-widget-content clearfix">

            <ol class="comment-list">
                <?php
                wp_list_comments(array(
                    'style' => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 50,
                    'callback' => 'ct_list_comments',
                ));
                ?>
            </ol><!-- .comment-list -->

            <?php
            paginate_comments_links(array(
                'prev_text' => __('<span>&laquo;</span> Previous', ct_get_domain()),
                'next_text' => __('Next <span>&raquo;</span>', ct_get_domain())
            ));
            ?>

            <?php if (!comments_open()) : ?>
                <p class="no-comments"><?php _e('Comments are closed.', ct_get_domain()); ?></p>
            <?php endif; ?>
        </div>

    <?php endif; // have_comments()  ?>

    <?php ct_comment_form(); ?>

</div><!-- #comments -->