<?php
add_action( 'widgets_init', array( 'Origamiez_Widget_Posts_List_Small', 'register' ) );

class Origamiez_Widget_Posts_List_Small extends Origamiez_Posts_Widget_Type_C {
	public static function register() {
		register_widget( 'Origamiez_Widget_Posts_List_Small' );
	}

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'origamiez-widget-posts-small-thumbnail',
			'description' => esc_attr__( 'Display posts list with small thumbnail.', 'origamiez' )
		);
		$control_ops = array( 'width' => 'auto', 'height' => 'auto' );
		parent::__construct( 'origamiez-widget-post-list-small', esc_attr__( 'Origamiez Posts List Small', 'origamiez' ), $widget_ops, $control_ops );
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
		$query = $this->get_query( $instance );
		$posts = new WP_Query( $query );
		if ( $posts->have_posts() ):
			$loop_index = 0;
			while ( $posts->have_posts() ):
				$posts->the_post();
				$post_title   = get_the_title();
				$post_url     = get_permalink();
				$post_classes = array( 'origamiez-wp-mt-post', 'clearfix' );
				if ( 0 == $loop_index ) {
					$post_classes[] = 'origamiez-wp-mt-post-first';
				}
				?>
                <div <?php post_class( $post_classes ); ?>>
					<?php if ( has_post_thumbnail() ): ?>
                        <a href="<?php echo esc_url( $post_url ); ?>" title="<?php echo esc_attr( $post_title ); ?>"
                           class="link-hover-effect origamiez-post-thumb pull-left">
							<?php the_post_thumbnail( 'origamiez-square-xs', array( 'class' => 'image-effect img-responsive' ) ); ?>
                        </a>
					<?php endif; ?>
                    <div class="origamiez-wp-mt-post-detail">
                        <h4>
                            <a class="entry-title" href="<?php echo esc_url( $post_url ); ?>"
                               title="<?php echo esc_attr( $post_title ); ?>"><?php echo esc_html( $post_title ); ?></a>
                        </h4>
						<?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata' ); ?>
						<?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix' ); ?>
                    </div>
                </div>
				<?php
				$loop_index ++;
			endwhile;
		endif;
		wp_reset_postdata();
		echo wp_kses( $after_widget, origamiez_get_allowed_tags() );
	}
}
