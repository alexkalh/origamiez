<?php
add_action( 'widgets_init', array( 'Origamiez_Widget_Posts_List_Two_Cols', 'register' ) );

class Origamiez_Widget_Posts_List_Two_Cols extends Origamiez_Posts_Widget_Type_C {
	public static function register() {
		register_widget( 'Origamiez_Widget_Posts_List_Two_Cols' );
	}

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'origamiez-widget-posts-two-cols',
			'description' => esc_attr__( 'Display posts list with layout two cols.', 'origamiez' )
		);
		$control_ops = array( 'width' => 'auto', 'height' => 'auto' );
		parent::__construct( 'origamiez-widget-posts-two-cols', esc_attr__( 'Origamiez Posts List Two Cols', 'origamiez' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->get_default() );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo wp_kses( $before_widget, origamiez_get_allowed_tags() );
		if ( ! empty( $title ) ) {
			echo wp_kses( $before_title . $title . $after_title, origamiez_get_allowed_tags() );
		}
		extract( $instance );
		$query = $this->get_query( $instance );
		$posts = new WP_Query( $query );
		if ( $posts->have_posts() ):
			?>
            <div class="row">
                <div class="article-col-left col-sm-6 col-xs-12">
					<?php
					$loop_index = 0;
					while ( $posts->have_posts() ):
						$posts->the_post();
						$post_title   = get_the_title();
						$post_url     = get_permalink();
						$post_classes = "origamiez-post-{$loop_index} clearfix";
						if ( 0 == $loop_index ):
							?>
                            <article <?php post_class( $post_classes ); ?>>
								<?php if ( has_post_thumbnail() ): ?>
                                    <a class="link-hover-effect origamiez-post-thumb" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'origamiez-square-m', array( 'class' => 'image-effect img-responsive' ) ); ?>
                                    </a>
								<?php endif; ?>
								<?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata clearfix' ); ?>
                                <h3>
                                    <a class="entry-title" href="<?php echo esc_url( $post_url ); ?>"
                                       title="<?php echo esc_attr( $post_title ); ?>">
										<?php echo esc_attr( $post_title ); ?>
                                    </a>
                                </h3>
								<?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix' ); ?>
                            </article>
							<?php
							echo '</div>';
							echo '<div class="article-col-right col-sm-6 col-xs-12">';
						else:
							?>
                            <article <?php post_class( $post_classes ); ?>>
								<?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata clearfix' ); ?>
                                <h5>
                                    <a class="entry-title" href="<?php echo esc_url( $post_url ); ?>"
                                       title="<?php echo esc_attr( $post_title ); ?>">
										<?php echo esc_attr( $post_title ); ?>
                                    </a>
                                </h5>
                            </article>
						<?php
						endif;
						$loop_index ++;
					endwhile;
					?>
                </div>
            </div>
		<?php
		endif;
		wp_reset_postdata();
		echo wp_kses( $after_widget, origamiez_get_allowed_tags() );
	}
}
