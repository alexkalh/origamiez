<?php

global $post;

$get_related_post_by     = get_theme_mod('get_related_post_by', 'post_tag');
$number_of_related_posts = (int)get_theme_mod('number_of_related_posts', 5);

$args = array(
  'post__not_in'   => array($post->ID),
  'posts_per_page' => $number_of_related_posts
);

if('post_tag' == $get_related_post_by){
  $tags = get_the_tags($post->ID);
  if (!empty($tags)) {
    $tag_ids = array();
    foreach ($tags as $tag) {
        $tag_ids[] = $tag->term_id;
    }

    $args['tax_query'] = array(array(
      'taxonomy' => 'post_tag',
      'field'    => 'id',
      'terms'    => $tag_ids
    ));        
  }
}else{
  $categories = get_the_category($post->ID);
  if (!empty($categories)) {
    $category_id = array();
    foreach ($categories as $category) {
        $category_id[] = $category->term_id;
    }
    $args['tax_query'] = array(array(
      'taxonomy' => 'category',
      'field'    => 'id',
      'terms'    => $category_id
    ));        
  }
}

$related_posts = new WP_Query($args);
if ($related_posts->have_posts()):
    ?>
    <div id="origamiez-post-related" class="widget">
        <h2 class="widget-title clearfix">
            <span class="widget-title-text pull-left"><?php esc_html_e('Related Articles', 'origamiez'); ?></span>  
            <span class="pull-right owl-custom-pagination fa fa-angle-right origamiez-transition-all"></span>
            <span class="pull-right owl-custom-pagination fa fa-angle-left origamiez-transition-all"></span>
        </h2>

        <div class="origamiez-widget-content clearfix">
            <div class="owl-carousel owl-theme">
                <?php
                while ($related_posts->have_posts()):
                    $related_posts->the_post();
                    ?>
                    <figure class="post">
                        <?php if (has_post_thumbnail()): ?>                        
                            <?php the_post_thumbnail('origamiez-square-md', array('class'=> 'img-responsive')); ?>                                       
                        <?php else: ?>
                            <img src="http://placehold.it/374x209" class="img-responsive">
                        <?php endif; ?>                                
                        <figcaption><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></figcaption>
                    </figure>
                    <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>
    <?php
endif;

wp_reset_postdata();