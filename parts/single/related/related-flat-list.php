<?php

global $post;

$get_related_post_by     = get_theme_mod('get_related_post_by', 'post_tag');
$number_of_related_posts = (int)get_theme_mod('number_of_related_posts', 8);

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
    <div id="origamiez-post-related" class="widget origamiez-widget-posts-two-cols">

      <h2 class="widget-title clearfix">
          <span class="widget-title-text pull-left"><?php esc_html_e('Related Articles', 'origamiez'); ?></span>
      </h2>

      <div class="origamiez-widget-content clearfix">

	          <div class="article-col-left col-sm-6 col-xs-12">
	          <?php
	          $loop_index = 0;

	          while ($related_posts->have_posts()):
	              $related_posts->the_post();
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
													<?php get_template_part('parts/metadata/author'); ?>
													<?php get_template_part('parts/metadata/date'); ?>
													<?php get_template_part('parts/metadata/divider'); ?>
													<?php get_template_part('parts/metadata/comments'); ?>
	                      </p>


	                      <h3>
	                          <a class="entry-title"
	                              href="<?php echo esc_url($post_url); ?>"
	                              title="<?php echo esc_attr($post_title); ?>">
	                              <?php echo esc_attr($post_title); ?>
	                          </a>
	                      </h3>

	                      <?php add_filter('excerpt_length', "origamiez_return_20"); ?>
	                      	<p class="entry-excerpt clearfix"><?php echo get_the_excerpt(); ?></p>
	                      <?php remove_filter('excerpt_length', "origamiez_return_20"); ?>

	                  </article>

	                  <?php
	                  echo '</div>';
	                  echo '<div class="article-col-right col-sm-6 col-xs-12">';
	              else:
	                  ?>
	                  <article <?php post_class($post_classes); ?>>

	                      <p class="metadata">
													<?php get_template_part('parts/metadata/author'); ?>
													<?php get_template_part('parts/metadata/date'); ?>
													<?php get_template_part('parts/metadata/divider'); ?>
													<?php get_template_part('parts/metadata/comments'); ?>
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

    </div>
    <?php
endif;

wp_reset_postdata();
