<li class="clearfix origamiez-first-post">
    <article class="entry-item row clearfix">
        <div class="entry-summary col-sm-12">
            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                <p>
                    <?php
					$message = sprintf( esc_attr__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'origamiez' ), admin_url( 'post-new.php' ) );
					echo wp_kses( $message, origamiez_get_allowed_tags() );
					?>
                </p>

            <?php elseif ( is_search() ) : ?>

                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'origamiez' ); ?></p>
                <?php get_search_form(); ?>

            <?php else : ?>

                <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'origamiez' ); ?></p>
                <?php get_search_form(); ?>

            <?php endif; ?>
        </div>
    </article>
</li>
