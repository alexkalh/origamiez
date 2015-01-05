<?php
get_header();
?>

<div id="sidebar-center" class="pull-left">

    <?php ct_get_breadcrumb(); ?>

    <div class="clearfix"></div>

    <div id="sidebar-center-bottom" class="row clearfix">                        
        <ul id="ct-blogposts">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    get_template_part('content', get_post_format());
                endwhile;
            else :
                get_template_part('content', 'none');
            endif;
            ?>
        </ul>
        <?php get_template_part('pagination'); ?>
    </div>       
</div>
<?php get_sidebar('right'); ?>

<div class="clearfix"></div>
<?php get_sidebar('bottom'); ?>
<div class="clearfix"></div>

<?php
get_footer();
