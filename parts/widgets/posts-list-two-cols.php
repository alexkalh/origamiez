<?php

add_action('widgets_init', array('Origamiez_Widget_Posts_List_Two_Cols', 'register'));

class Origamiez_Widget_Posts_List_Two_Cols extends CT_Post_Widget {

    public static function register(){
        register_widget('Origamiez_Widget_Posts_List_Two_Cols');
    }

    function __construct() {
        $widget_ops  = array('classname' => 'origamiez-widget-posts-two-cols', 'description' => __('Display posts list with layout two cols.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-posts-two-cols', __('Origamiez Posts List Two Cols', 'origamiez'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo  htmlspecialchars_decode(esc_html($before_widget));
        if (!empty($title))
            echo  htmlspecialchars_decode(esc_html($before_title . $title . $after_title));

        extract($instance);

        $query = $this->get_query($instance);
        $posts = new WP_Query($query);

        if ($posts->have_posts()):
            ?>
            <div class="row">
                <div class="article-col-left col-sm-6 col-xs-12">
                <?php
                $loop_index = 0;

                while ($posts->have_posts()):
                    $posts->the_post();
                    $post_title = get_the_title();
                    $post_url   = get_permalink();

                    $post_classes = "origamiez-post-{$loop_index} clearfix";

                    if(0 == $loop_index):                                  
                    ?>
                        <article <?php post_class($post_classes); ?>>
                            <?php if(has_post_thumbnail()): ?>
                                <a class="link-hover-effect origamiez-post-thumb" 
                                    href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('origamiez-square-m', 
                                        array('class' => 'image-effect img-responsive')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <p class="metadata">
                                <span class="author hidden"><?php the_author();?></span>
                                <time class="updated metadata-date" datetime="<?php echo esc_attr(get_post_field('post_date_gmt', get_the_ID())); ?>"><?php origamiez_get_metadata_prefix(); ?> <?php echo get_the_date(); ?></time>
                                <span class="metadata-divider">&nbsp;|&nbsp;</span>
                                <?php comments_popup_link(__('No Comment', 'origamiez'), __('1 Comment', 'origamiez'), __('% Comments', 'origamiez'), 'metadata-comment', __('Comment Closed', 'origamiez')); ?>                                    
                            </p>        

                            <h3>
                                <a class="entry-title" 
                                    href="<?php echo esc_url($post_url); ?>" 
                                    title="<?php echo esc_attr($post_title); ?>">
                                    <?php echo esc_attr($post_title); ?>
                                </a>
                            </h3>               

                            <?php the_excerpt(); ?>
                        </article>
                      
                        <?php
                        echo '</div>';
                        echo '<div class="article-col-right col-sm-6 col-xs-12">';
                    else:                                            
                        ?>
                        <article <?php post_class($post_classes); ?>>

                            <p class="metadata">
                                <span class="author hidden"><?php the_author();?></span>
                                <time class="updated metadata-date" datetime="<?php echo esc_attr(get_post_field('post_date_gmt', get_the_ID())); ?>"><?php origamiez_get_metadata_prefix(); ?> <?php echo get_the_date(); ?></time>
                                <span class="metadata-divider">&nbsp;|&nbsp;</span>
                                <?php comments_popup_link(__('No Comment', 'origamiez'), __('1 Comment', 'origamiez'), __('% Comments', 'origamiez'), 'metadata-comment', __('Comment Closed', 'origamiez')); ?>                                    
                            </p>        

                            <h5>
                                <a class="entry-title" 
                                    href="<?php echo esc_url($post_url); ?>" 
                                    title="<?php echo esc_attr($post_title); ?>">
                                    <?php echo esc_attr($post_title); ?>
                                </a>
                            </h5>                                       
                        </article>
                        <?php
                    endif;

                    $loop_index++;
                endwhile;
                ?>                    
                </div>
            </div>
            <?php
        endif;
        wp_reset_postdata();

        echo  htmlspecialchars_decode(esc_html($after_widget));
    }

}
