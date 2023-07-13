<?php
add_action( 'widgets_init', array( 'Origamiez_Widget_Posts_List_Media', 'register' ) );

class Origamiez_Widget_Posts_List_Media extends Origamiez_Posts_Widget_Type_C {
	public static function register() {
		register_widget( 'Origamiez_Widget_Posts_List_Media' );
	}

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'origamiez-widget-posts-with-format-icon',
			'description' => esc_attr__( 'Display posts list with icon of post-format.', 'origamiez' )
		);
		$control_ops = array( 'width' => 'auto', 'height' => 'auto' );
		parent::__construct( 'origamiez-widget-post-list-media', esc_attr__( 'Origamiez Posts List With Format Icon', 'origamiez' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->get_default() );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo wp_kses( $args['before_widget'], origamiez_get_allowed_tags() );
		if ( ! empty( $title ) ) {
			echo wp_kses( $args['before_title'] . $title . $args['after_title'], origamiez_get_allowed_tags() );
		}
		$query = $this->get_query( $instance );
		$posts = new WP_Query( $query );
		if ( $posts->have_posts() ):
			$is_true = true;
			while ( $posts->have_posts() ):
				$posts->the_post();
				$post_id     = get_the_ID();
				$post_title  = get_the_title();
				$post_url    = get_permalink();
				$post_format = get_post_format();
				$classes     = array( 'origamiez-w-m-post', 'clearfix' );
				if ( $is_true ) {
					$classes[] = 'origamiez-w-m-post-first';
					$is_true   = false;
				}
				?>
                <div <?php post_class( $classes ); ?>>
					<?php if ( has_post_thumbnail() ): ?>
						<?php
						$lightbox_markup = apply_filters( 'origamiez_get_lightbox_markup', array(
							'before' => '',
							'after'  => '',
							'url'    => $post_url,
							'atts'   => array()
						), $post_id );
						echo wp_kses( $lightbox_markup['before'], origamiez_get_allowed_tags() );
						?>
                        <a href="<?php echo esc_url( $lightbox_markup['url'] ); ?>"
                           title="<?php echo esc_attr( $post_title ); ?>"
                           class="link-hover-effect origamiez-w-m-post-thumb clearfix" <?php echo esc_attr( implode( ' ', $lightbox_markup['atts'] ) ); ?>>
							<?php the_post_thumbnail( 'origamiez-square-md', array( 'class' => 'image-effect img-responsive' ) ); ?>
                            <span><span class="metadata-post-format metadata-circle-icon"><span
                                            class="<?php echo esc_attr( origamiez_get_format_icon( $post_format ) ); ?>"></span></span></span>
                        </a>
						<?php echo wp_kses( $lightbox_markup['after'], origamiez_get_allowed_tags() ); ?>
					<?php endif; ?>
                    <h4 class="entry-title"><a href="<?php echo esc_url( $post_url ); ?>"
                                               title="<?php echo esc_attr( $post_title ); ?>"><?php echo esc_html( $post_title ); ?></a>
                    </h4>
					<?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata' ); ?>
					<?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix' ); ?>
                </div>
			<?php
			endwhile;
		endif;
		wp_reset_postdata();
		echo wp_kses( $args['after_widget'], origamiez_get_allowed_tags() );
	}
}
