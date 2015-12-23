<?php if (has_category() && '1' == get_theme_mod('is_show_post_category', '1')): ?>  
    <div id="origamiez-post-category" class="entry-category clearfix">
        <span class="fa fa-book"></span> <?php the_category(' '); ?> 
    </div>                  
<?php endif;