<?php if (has_tag() && (int)get_theme_mod('is_show_post_tag', '1')): ?>
    <div id="origamiez-post-tag" class="entry-tag clearfix">
        <span class="fa fa-tags"></span> <?php the_tags('', '', ''); ?>
    </div>
<?php endif; 