<?php
get_header();
?>

<div id="sidebar-center" class="pull-left">

    <?php ct_get_breadcrumb(); ?>

    <?php if (have_posts()) : ?>
        <div class="clearfix"></div>

        <div id="sidebar-center-bottom" class="row clearfix">                        
            <?php
            while (have_posts()) : the_post();
                ?>
            <article id="ct-post-wrap" <?php post_class('clearfix'); ?>>
                <h1 class="entry-title" style="display: none;"><?php the_title(); ?></h1>

                    <div class="entry-content">
                    <?php 
                    if(class_exists('CT_Page_Builder')){
                        add_filter('the_content', array('CT_Page_Builder', 'the_content'));
                        the_content(); 
                        remove_filter('the_content', array('CT_Page_Builder', 'the_content'));
                    }else{
                        the_content(); 
                    }
                    ?>
                    </div>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div id="ct_singular_pagination" class="clearfix">',
                        'after' => '</div>',
                        'next_or_number' => 'next',
                        'separator' => ' . ',
                        'nextpagelink' => __('Next', ct_get_domain()),
                        'previouspagelink' => __('Previous', ct_get_domain()),
                    ));
                    ?>

                </article>
                <?php comments_template(); ?>

                <?php
            endwhile;
            ?>                        
        </div>
        <?php
    else :
        // If no content, include the "No posts found" template.
        get_template_part('content', 'none');
    endif;
    ?>
</div>
<?php get_sidebar('right'); ?>

<div class="clearfix"></div>
<?php
get_footer();
