<?php
/**
 * Widget: Featured Properties Widget
 *
 * @since 3.0.0
 * @package RH/modern
 */

if ( ! class_exists( 'Featured_Properties_Widget' ) ) {

	/**
	 * Featured_Properties_Widget.
	 *
	 * Widget of featured properties.
	 *
	 * @since 3.0.0
	 */
	class Featured_Properties_Widget extends WP_Widget {

		/**
		 * Method: Constructor
		 *
		 * @since  1.0.0
		 */
		function __construct() {
			$widget_ops = array(
				'classname' => 'Featured_Properties_Widget',
				'description' => __( 'Displays Random or Recent Featured Properties.', 'framework' ),
				'customize_selective_refresh' => true,
			);
			parent::__construct(
				'Featured_Properties_Widget',
				__( 'RealHomes - Featured Properties', 'framework' ),
				$widget_ops
			);
		}

		/**
		 * Method: Widget Front-End
		 *
		 * @param array $args - Arguments of the widget.
		 * @param array $instance - Instance of the widget.
		 * @since  1.0.0
		 */
		function widget( $args, $instance ) {

			extract( $args );

			$title = apply_filters( 'widget_title', $instance['title'] );

			if ( empty( $title ) ) {
				$title = false;
			}

			$count = intval( $instance['count'] );
			$sort_by = $instance['sort_by'];

			$featured_args = array(
				'post_type' => 'property',
				'posts_per_page' => $count,
				'meta_query' => array(
					array(
						'key' => 'REAL_HOMES_featured',
						'value' => 1,
						'compare' => '=',
						'type'  => 'NUMERIC',
					),
				),
			);

			// Order by.
			if ( 'random' == $sort_by ) :
				$featured_args['orderby'] = 'rand';
			else :
				$featured_args['orderby'] = 'date';
			endif;

			$featured_query = new WP_Query( $featured_args );

			echo $before_widget;

			if ( $title ) :
				echo $before_title;
				echo $title;
				echo $after_title;
			endif;

			if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
				if ( $featured_query->have_posts() ) :
					?>
					<ul class="featured-properties">
						<?php
						while ( $featured_query->have_posts() ) :
							$featured_query->the_post();
							?>
							<li>

								<figure>
									<a href="<?php the_permalink(); ?>">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'grid-view-image' );
									} else {
										inspiry_image_placeholder( 'grid-view-image' );
									}
									?>
									</a>
								</figure>

								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p><?php framework_excerpt( 7 ); ?> <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More','framework' ); ?></a></p>
								<?php
								$price = get_property_price();
								if ( $price ) {
									echo '<span class="price">' . esc_html( $price ) . '</span>';
								}
								?>
							</li>
							<?php
						endwhile;
						?>
					</ul>
					<?php
					wp_reset_query();
				else :
					?>
					<ul class="featured-properties">
						<?php
						echo '<li>';
							esc_html_e( 'No Featured Property Found!', 'framework' );
						echo '</li>';
						?>
					</ul>
					<?php
				endif;
			} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
				if ( $featured_query->have_posts() ) :
					while ( $featured_query->have_posts() ) :
						$featured_query->the_post();

						global $post;
						$property_size      = get_post_meta( $post->ID, 'REAL_HOMES_property_size', true );
						$size_postfix       = get_post_meta( $post->ID, 'REAL_HOMES_property_size_postfix', true );
						$property_bedrooms  = get_post_meta( $post->ID, 'REAL_HOMES_property_bedrooms', true );
						$property_bathrooms = get_post_meta( $post->ID, 'REAL_HOMES_property_bathrooms', true );
						$property_address   = get_post_meta( $post->ID, 'REAL_HOMES_property_address', true );
						$is_featured        = get_post_meta( $post->ID, 'REAL_HOMES_featured', true );

						?>

						<article <?php post_class( 'rh_prop_card rh_prop_card--block' ); ?>>

							<div class="rh_prop_card__wrap">

								<?php if ( $is_featured ) : ?>
									<div class="rh_label rh_label__featured_widget">
										<div class="rh_label__wrap">
											<?php esc_html_e( 'Featured', 'framework' ); ?>
											<span></span>
										</div>
									</div>
									<!-- /.rh_label -->
								<?php endif; ?>

								<figure class="rh_prop_card__thumbnail">
									<a href="<?php the_permalink(); ?>">
										<?php
										if ( has_post_thumbnail( $post->ID ) ) {
											the_post_thumbnail( 'modern-property-child-slider' );
										} else {
											inspiry_image_placeholder( 'modern-property-child-slider' );
										}
										?>
									</a>

									<div class="rh_overlay"></div>
									<div class="rh_overlay__contents rh_overlay__fadeIn-bottom">
										<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Property', 'framework' ); ?></a>
									</div>
									<!-- /.rh_overlay__contents -->

									<?php inspiry_display_property_label( get_the_ID() ); ?>

									<div class="rh_prop_card__btns">
										<?php
										$property_id = $post->ID;
										if ( is_added_to_favorite( $property_id ) ) {
											?>
											<span href="#" class="favorite-placeholder highlight__red" data-tooltip="<?php esc_attr_e( 'Added to favorites', 'framework' ); ?>">
												<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg' ); ?>
											</span>
											<?php
										} else {
											?>
											<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="add-to-favorite-form">
												<input type="hidden" name="property_id" value="<?php echo esc_attr( $property_id ); ?>" />
												<input type="hidden" name="action" value="add_to_favorite" />
											</form>
											<span href="#" class="favorite-placeholder highlight__red hide" data-tooltip="<?php esc_attr_e( 'Added to favorites', 'framework' ); ?>">
												<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg' ); ?>
											</span>
											<a href="#" class="favorite add-to-favorite" data-tooltip="<?php esc_attr_e( 'Add to favorites', 'framework' ); ?>">
												<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg' ); ?>
											</a>
											<?php
										}
										?>
									</div>
									<!-- /.rh_prop_card__btns -->
								</figure>
								<!-- /.rh_prop_card__thumbnail -->

								<div class="rh_prop_card__details">

									<h3>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<p class="rh_prop_card__excerpt"><?php framework_excerpt( 10 ); ?></p>
									<!-- /.rh_prop_card__excerpt -->

									<div class="rh_prop_card__meta_wrap">

										<?php if ( ! empty( $property_bedrooms ) ) : ?>
											<div class="rh_prop_card__meta">
												<h4><?php esc_html_e( 'Bedrooms', 'framework' ); ?></h4>
												<div>
													<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-bed.svg' ); ?>
													<!-- <img src="php" alt="" /> -->
													<span class="figure"><?php echo esc_html( $property_bedrooms ); ?></span>
												</div>
											</div>
											<!-- /.rh_prop_card__meta -->
										<?php endif; ?>

										<?php if ( ! empty( $property_bathrooms ) ) : ?>
											<div class="rh_prop_card__meta">
												<h4><?php esc_html_e( 'Bathrooms', 'framework' ); ?></h4>
												<div>
													<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-shower.svg' ); ?>
													<!-- <img src="php" alt="" /> -->
													<span class="figure"><?php echo esc_html( $property_bathrooms ); ?></span>
												</div>
											</div>
											<!-- /.rh_prop_card__meta -->
										<?php endif; ?>

										<?php if ( ! empty( $property_size ) ) : ?>
											<div class="rh_prop_card__meta">
												<h4><?php esc_html_e( 'Area', 'framework' ); ?></h4>
												<div>
													<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-area.svg' ); ?>
													<!-- <img src="php" alt="" /> -->
													<span class="figure">
														<?php echo esc_html( $property_size ); ?>
													</span>
													<?php if ( ! empty( $size_postfix ) ) : ?>
														<span class="label">
															<?php echo esc_html( $size_postfix ); ?>
														</span>
													<?php endif; ?>
												</div>
											</div>
											<!-- /.rh_prop_card__meta -->
										<?php endif; ?>

									</div>
									<!-- /.rh_prop_card__meta_wrap -->

									<div class="rh_prop_card__priceLabel">

										<h4 class="rh_prop_card__status">
											<?php display_figcaption( $post->ID ); ?>
										</h4>
										<!-- /.rh_prop_card__type -->
										<p class="rh_prop_card__price">
											<?php property_price(); ?>
										</p>
										<!-- /.rh_prop_card__price -->

									</div>
									<!-- /.rh_prop_card__priceLabel -->

								</div>
								<!-- /.rh_prop_card__details -->

							</div>
							<!-- /.rh_prop_card__wrap -->

						</article>
						<!-- /.rh_prop_card -->
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<div class="rh_alert-wrapper rh_alert__widget">
						<h4 class="no-results"><?php esc_html_e( 'No Featured Property Found!', 'framework' ); ?></h4>
					</div>
					<?php
				endif;
			}

			echo $after_widget;
		}

		/**
		 * Method: Widget Backend Form
		 *
		 * @param array $instance - Instance of the widget.
		 * @since  1.0.0
		 */
		function form( $instance ) {
			$instance = wp_parse_args(
				(array) $instance, array(
					'title' => 'Featured Properties',
					'count' => 1,
					'sort_by' => 'random',
				)
			);

			$title = esc_attr( $instance['title'] );
			$count = $instance['count'];
			$sort_by = $instance['sort_by'];
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title', 'framework' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of Properties', 'framework' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'sort_by' ) ); ?>"><?php esc_html_e( 'Sort By:', 'framework' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'sort_by' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'sort_by' ) ); ?>" class="widefat">
						<option value="recent" <?php selected( $sort_by, 'recent' ); ?>><?php esc_html_e( 'Most Recent', 'framework' ); ?></option>
						<option value="random" <?php selected( $sort_by, 'random' ); ?>><?php esc_html_e( 'Random', 'framework' ); ?></option>
				</select>
			</p>
			<?php
		}

		/**
		 * Method: Widget Update Function
		 *
		 * @param array $new_instance - New instance of the widget.
		 * @param array $old_instance - Old instance of the widget.
		 * @since  1.0.0
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']      = strip_tags( $new_instance['title'] );
			$instance['count']      = $new_instance['count'];
			$instance['sort_by']    = $new_instance['sort_by'];

			return $instance;
		}

	}
}
?>
