<?php
if (1 === (int)get_theme_mod('is_showpost_adjacent', 1)):
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if ($prev_post || $next_post):
        ?>
        <div id="origamiez-post-adjacent">
            <div class="row clearfix">
                <?php if ($prev_post): ?>
                    <div class="col-sm-6 origamiez-post-adjacent-prev">
                        <p class="direction">
                            <a href="<?php echo get_the_permalink($prev_post); ?>" title="<?php echo get_the_title($prev_post); ?>">
                                <?php
                                $post_adjacent_arrow_left = get_theme_mod('post_adjacent_arrow_left', false);
                                if(empty($post_adjacent_arrow_left)): 
                                ?>
                                    <span class="fa fa-angle-double-left"></span>&nbsp;<?php esc_html_e('Previous Post', 'origamiez'); ?>
                                <?php else: ?>
                                    <img src="<?php echo esc_url($post_adjacent_arrow_left); ?>" alt="<?php echo get_the_title($prev_post); ?>">
                                <?php endif;?>
                            </a>
                        </p>

                        <?php if((int)get_theme_mod('is_showpost_adjacent_title', '1')): ?>
                            <h4><a href="<?php echo get_the_permalink($prev_post); ?>"><?php echo get_the_title($prev_post); ?></a></h4>
                        <?php endif;?>

                        <?php if((int)get_theme_mod('is_showpost_adjacent_datetime', '1')): ?>
                            <p class="metadata clearfix">
                                <time class="updated metadata-date"><?php origamiez_get_metadata_prefix(); ?> <?php echo get_the_date('', $prev_post); ?></time>                                    
                            </p>
                        <?php endif;?>

                    </div>
                <?php endif; ?>
                <?php if ($next_post): ?>
                    <div class="col-sm-6 origamiez-post-adjacent-next">
                        <p class="direction">
                            <a href="<?php echo get_the_permalink($next_post); ?>" title="<?php echo get_the_title($next_post); ?>">
                                <?php
                                $post_adjacent_arrow_right = get_theme_mod('post_adjacent_arrow_right', false);
                                if(empty($post_adjacent_arrow_left)): 
                                ?>
                                    <?php esc_html_e('Next Post', 'origamiez'); ?>&nbsp;<span class="fa fa-angle-double-right"></span>
                                <?php else: ?>
                                    <img src="<?php echo esc_url($post_adjacent_arrow_right); ?>" alt="<?php echo get_the_title($next_post); ?>">
                                <?php endif;?>                                                    

                            </a>
                        </p>

                        <?php if(1 === (int)get_theme_mod('is_showpost_adjacent_title', 1)): ?>
                            <h4><a href="<?php echo get_the_permalink($next_post); ?>"><?php echo get_the_title($next_post); ?></a></h4>
                        <?php endif;?>

                        <?php if(1 === (int)get_theme_mod('is_showpost_adjacent_datetime', 1)): ?>
                            <p class="metadata clearfix">
                                <time class="updated metadata-date"><?php origamiez_get_metadata_prefix(); ?> <?php echo get_the_date('', $next_post); ?></time>                                    
                            </p>
                        <?php endif;?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    endif;
endif;