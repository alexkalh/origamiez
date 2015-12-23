<?php get_header(); ?>

<div id="sidebar-center" class="origamiez-size-01 pull-left">

    <?php origamiez_get_breadcrumb(); ?>

    <div class="clearfix"></div>

    <div id="sidebar-center-bottom" class="row clearfix">                        
        <ul id="origamiez-blogposts">
            <?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					?>
                    <li <?php post_class( array( 'clearfix' ) ); ?>>
                        <article class="entry-item row clearfix">

                            <div class="entry-summary col-sm-12">

                                <h3 class="clearfix">                                                    
                                    <a href="<?php the_permalink(); ?>" class="entry-content"><?php the_title(); ?></a>
                                </h3>

                                <p class="metadata">
                                    <?php
									$is_show_author = (int) get_theme_mod( 'is_show_taxonomy_author', '0' );
									if ( $is_show_author ) :
									?>               
                                        <?php get_template_part( 'parts/metadata/author', 'blog' ); ?>
                                        <?php get_template_part( 'parts/metadata/divider', 'blog' ); ?>
                                    <?php else : ?>
                                        <?php get_template_part( 'parts/metadata/author' ); ?>
                                    <?php endif;?>                    

                                    <?php if ( 1 === (int) get_theme_mod( 'is_show_taxonomy_datetime', '1' ) ) : ?>
                                        <?php get_template_part( 'parts/metadata/date', 'blog' ); ?>
                                        <?php get_template_part( 'parts/metadata/divider', 'blog' ); ?>                        
                                    <?php endif; ?>

                                    <?php if ( 1 === (int) get_theme_mod( 'is_show_taxonomy_comments', '1' ) ) : ?>
                                        <?php get_template_part( 'parts/metadata/comments', 'blog' ); ?>
                                        <?php get_template_part( 'parts/metadata/divider', 'blog' ); ?>
                                    <?php endif; ?>

                                    <?php if ( 1 === (int) get_theme_mod( 'is_show_taxonomy_category', '1' ) && has_category() ) : ?>
                                        <?php get_template_part( 'parts/metadata/category', 'blog' ); ?>
                                    <?php endif; ?>
                                </p>

                                <div class="entry-content"><?php the_excerpt(); ?></div>            
                            </div>
                        </article>
                    </li>
                    <?php
				endwhile;
			else :
				get_template_part( 'content', 'none' );
			endif;
			?>
        </ul>
        <?php get_template_part( 'pagination' ); ?>
    </div>       
</div>
<?php get_sidebar( 'right' ); ?>

<div class="clearfix"></div>
<?php
$footer_number_of_cols = (int) get_theme_mod( 'footer_number_of_cols', 5 );
get_footer( $footer_number_of_cols );
