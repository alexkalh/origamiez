<li class="clearfix origamiez-first-post">
    <article class="entry-item row clearfix">
        <div class="entry-summary col-sm-12">
            <?php if (is_home() && current_user_can('publish_posts')) : ?>

                <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'origamiez'), admin_url('post-new.php')); ?></p>

            <?php elseif (is_search()) : ?>

                <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'origamiez'); ?></p>
                <?php get_search_form(); ?>

            <?php else : ?>

                <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'origamiez'); ?></p>
                <?php get_search_form(); ?>

            <?php endif; ?>
        </div>
    </article>
</li>