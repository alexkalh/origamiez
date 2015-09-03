<div id="sidebar-center" class="origamiez-size-01 pull-left">

    <?php get_template_part('parts/breadcrumb'); ?>

    <div class="clearfix"></div>

    <div id="sidebar-center-bottom" class="row clearfix">                        
        <ul id="origamiez-blogposts">
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

<?php get_sidebar('middle'); ?>

<?php get_sidebar('right'); ?>