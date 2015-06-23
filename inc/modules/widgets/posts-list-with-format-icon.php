<?php

class CT_Widget_Post_List_Media extends CT_Post_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'ct-widget-media', 'description' => __('Display posts list with icon of post-format.', ct_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('ct-widget-post-list-media', __('CT Posts List With Format Icon', ct_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        $query = $this->get_query($instance);
        $posts = new WP_Query($query);

        if ($posts->have_posts()):            
            $is_true = true;
            while ($posts->have_posts()):
                $posts->the_post();
                $post_id = get_the_ID();
                $post_title = get_the_title();
                $post_url = get_permalink();
                $post_format = get_post_format();

                $classes = array('ct-w-m-post', 'clearfix');
                if ($is_true) {
                    $classes[] = 'ct-w-m-post-first';
                    $is_true = false;
                }
                ?> 
                <div <?php post_class($classes); ?>>
                    <?php if (has_post_thumbnail()): ?>   
                        <?php
                        $lightbox_markup = apply_filters('ct_get_lightbox_markup', array(
                            'before' => '',
                            'after' => '',
                            'url' => $post_url,
                            'atts' => array()
                                ), $post_id);

                        echo $lightbox_markup['before'];
                        ?>

                        <a href="<?php echo $lightbox_markup['url']; ?>" title="<?php echo $post_title; ?>" class="link-hover-effect ct-w-m-post-thumb clearfix"  <?php echo implode(' ', $lightbox_markup['atts']); ?>>
                            <?php the_post_thumbnail('thumbnail', array('class'=> 'image-effect img-responsive')); ?>                            
                            <span><span class="metadata-post-format metadata-circle-icon"><span class="<?php echo ct_get_format_icon($post_format); ?>"></span></span></span>
                        </a>      
                        <?php echo $lightbox_markup['after']; ?>
                    <?php endif; ?>

                    <h5 class="entry-title"><a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></h5>

                    <p class="metadata clearfix">
                       <span class="vcard author hidden"><span class="fn"><?php the_author();?></span></span>
                        <time class="updated metadata-date" datetime="<?php echo get_post_field('post_date_gmt', get_the_ID()); ?>">&horbar; <?php echo get_the_date(); ?></time>                                        
                    </p>
                </div>
                <?php
            endwhile;            
        endif;
        wp_reset_postdata();

        echo $args['after_widget'];
    }

}
