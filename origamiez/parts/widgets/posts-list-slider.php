<?php
add_action( 'widgets_init', array( 'Origamiez_Widget_Posts_List_Slider', 'register' ) );

class Origamiez_Widget_Posts_List_Slider extends Origamiez_Posts_Widget_Type_B {
	public static function register() {
		register_widget( 'Origamiez_Widget_Posts_List_Slider' );
	}

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'origamiez-widget-posts-slider',
			'description' => esc_attr__( 'Display a slider with three block: two static blocks, one dynamic (carousel) block.', 'origamiez' )
		);
		$control_ops = array( 'width' => 'auto', 'height' => 'auto' );
		parent::__construct( 'origamiez-widget-posts-slider', esc_attr__( 'Origamiez Posts Slider', 'origamiez' ), $widget_ops, $control_ops );
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
		if ( 1 === (int) $is_assign_last_to_small ) {
			$this->get_layout_last_to_small( $args, $instance );
		} else {
			$this->get_layout_default( $args, $instance );
		}
		echo wp_kses( $after_widget, origamiez_get_allowed_tags() );
	}

	function update( $new_instance, $old_instance ) {
		$instance                            = parent::update( $new_instance, $old_instance );
		$instance['is_assign_last_to_small'] = isset( $new_instance['is_assign_last_to_small'] ) ? 1 : 0;

		return $instance;
	}

	function form( $instance ) {
		parent::form( $instance );
		$instance = wp_parse_args( (array) $instance, $this->get_default() );
		extract( $instance );
		?>
        <p>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'is_assign_last_to_small' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'is_assign_last_to_small' ) ); ?>" type="checkbox"
                   value="1" <?php checked( 1, (int) $is_assign_last_to_small, true ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'is_assign_last_to_small' ) ); ?>"><?php esc_html_e( 'Is assign two last posts to small box ?', 'origamiez' ); ?></label>
        </p>
		<?php
	}

	protected function get_layout_default( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$query = $this->get_query( $instance );
		echo '<div class="row clearfix">';
		$posts = new WP_Query( array_merge( $query, array( 'posts_per_page' => 2 ) ) );
		if ( $posts->have_posts() ):
			?>
            <div class="col-left col-sm-4 col-xs-4">
                <div class="d-flex flex-column">
					<?php
					$is_first   = true;
					$loop_index = 1;
					while ( $posts->have_posts() ):
						$posts->the_post();
						$post_title    = get_the_title();
						$post_url      = get_permalink();
						$post_format   = get_post_format();
						if ( has_post_thumbnail() ):
							$classes = array( 'item' );
							$classes[] = $is_first ? 'item-top' : 'item-bottom';
							?>
                            <div class="item-outer">
                                <article <?php post_class( $classes ); ?>>
									<?php the_post_thumbnail( 'origamiez-posts-slide-metro', array( 'class' => 'img-responsive' ) ); ?>
                                    <div class="caption">
                                        <h5>
                                            <a class="entry-title" href="<?php echo esc_url( $post_url ); ?>"
                                               title="<?php echo esc_attr( $post_title ); ?>">
												<?php echo esc_attr( $post_title ); ?>
                                            </a>
                                        </h5> <?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata clearfix hidden' ); ?>                                <?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix hidden' ); ?>
                                    </div>
                                </article>
                            </div>
							<?php
							$is_first = false;
						endif;
						$loop_index ++;
					endwhile;
					?>
                </div>
            </div>
		<?php
		endif;
		wp_reset_postdata();
		$posts = new WP_Query( array_merge( $query, array(
			'offset'         => 2,
			'posts_per_page' => (int) $instance['posts_per_page'] - 2
		) ) );
		if ( $posts->have_posts() ):
			?>
            <div class="col-right col-sm-8 col-xs-8">
                <div class="owl-carousel owl-theme">
					<?php
					while ( $posts->have_posts() ):
						$posts->the_post();
						$post_title  = get_the_title();
						$post_url    = get_permalink();
						$post_format = get_post_format();
						if ( has_post_thumbnail() ):
							?>
                            <article <?php post_class( 'item' ); ?>>
								<?php the_post_thumbnail( 'origamiez-posts-slide-metro', array( 'class' => 'img-responsive' ) ); ?>
                                <div class="caption">
                                    <h2>
                                        <a class="entry-title" href="<?php echo esc_url( $post_url ); ?>"
                                           title="<?php echo esc_attr( $post_title ); ?>">
											<?php echo esc_attr( $post_title ); ?>
                                        </a>
                                    </h2> <?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata clearfix' ); ?>                                    <?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix' ); ?>
                                </div>
                            </article>
						<?php
						endif;
						$loop_index ++; endwhile;
					?>
                </div>
            </div>
		<?php
		endif;
		wp_reset_postdata();
		echo '</div>';
	}

	protected function get_layout_last_to_small( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$query = $this->get_query( $instance );
		echo '<div class="row clearfix">';
		$posts      = new WP_Query( $query );
		$post_count = $posts->post_count;
		wp_reset_postdata();
		if ( $post_count >= 3 ): $offset = $post_count - 2;            // Small box.
			$posts  = new WP_Query( array_merge( $query, array( 'offset' => $offset, 'posts_per_page' => 2 ) ) );
			if ( $posts->have_posts() ):
				?>
                <div class="col-left col-sm-4 col-xs-4">
                    <div class="d-flex flex-column">
						<?php
						$is_first   = true;
						$loop_index = 1;
						while ( $posts->have_posts() ):
							$posts->the_post();
							$post_title    = get_the_title();
							$post_url      = get_permalink();
							$post_format   = get_post_format();
							if ( has_post_thumbnail() ):
								$classes = array( 'item' );
								$classes[] = $is_first ? 'item-top' : 'item-bottom';
								?>
                                <div class="item-outer">
                                    <article <?php post_class( $classes ); ?>>
										<?php the_post_thumbnail( 'origamiez-posts-slide-metro', array( 'class' => 'img-responsive' ) ); ?>
                                        <div class="caption">
                                            <h5>
                                                <a class="entry-title" href="<?php echo esc_url( $post_url ); ?>"
                                                   title="<?php echo esc_attr( $post_title ); ?>">
													<?php echo esc_attr( $post_title ); ?>
                                                </a>
                                            </h5> <?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata clearfix hidden' ); ?>                                    <?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix hidden' ); ?>
                                        </div>
                                    </article>
                                </div>
								<?php
								$is_first = false;
							endif;
							$loop_index ++;
						endwhile;
						?>
                    </div>
                </div>
			<?php
			endif;
			wp_reset_postdata();            // Large box.
			$posts = new WP_Query( array_merge( $query, array( 'posts_per_page' => $offset ) ) );
			if ( $posts->have_posts() ):
				?>
                <div class="col-right col-sm-8 col-xs-8">
                    <div class="owl-carousel owl-theme">
						<?php
						while ( $posts->have_posts() ):
							$posts->the_post();
							$post_title  = get_the_title();
							$post_url    = get_permalink();
							$post_format = get_post_format();
							if ( has_post_thumbnail() ):
								?>
                                <article <?php post_class( 'item' ); ?>>
									<?php the_post_thumbnail( 'origamiez-posts-slide-metro', array( 'class' => 'img-responsive' ) ); ?>
                                    <div class="caption">
                                        <h2>
                                            <a class="entry-title" href="<?php echo esc_url( $post_url ); ?>"
                                               title="<?php echo esc_attr( $post_title ); ?>">
												<?php echo esc_attr( $post_title ); ?>
                                            </a>
                                        </h2> <?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata clearfix' ); ?>                                        <?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix' ); ?>
                                    </div>
                                </article>
							<?php
							endif;
							$loop_index ++; endwhile;
						?>
                    </div>
                </div>
			<?php
			endif;
			wp_reset_postdata(); endif;
		echo '</div>';
	}

	protected function get_default() {
		$default                            = parent::get_default();
		$default['is_assign_last_to_small'] = 0;

		return $default;
	}
}
