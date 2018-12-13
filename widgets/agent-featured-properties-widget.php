<?php
/**
 * Widget: Agent Featured Properties Widget
 *
 * @since 3.0.0
 * @package RH/modern
 */

if ( ! class_exists( 'Agent_Featured_Properties_Widget' ) ) {

	/**
	 * Agent_Featured_Properties_Widget.
	 *
	 * Widget of agent featured properties.
	 *
	 * @since 3.0.0
	 */
	class Agent_Featured_Properties_Widget extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname' => 'Agent_Featured_Properties_Widget',
				'description' => __( 'Important: This widget is only for the Agent Sidebar.','framework' ),
                'customize_selective_refresh' => true,
			);
			parent::__construct( 'Agent_Featured_Properties_Widget', __( 'RealHomes - Agent Featured Properties','framework' ), $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			$title = apply_filters( 'widget_title', $instance['title'] );

			if ( empty( $title ) ) {
				$title = false;
			}

			$sort_by = $instance['sort_by'];
			$count = intval( $instance['count'] );

			$agent_args = array(
				'post_type' => 'property',
				'posts_per_page' => $count,
				'meta_query' => array(
					array(
						'key' => 'REAL_HOMES_featured',     // Show only Featured Properties
						'value' => 1,
						'compare' => '=',
						'type'  => 'NUMERIC',
					),
				),
			);

			// If author user author id otherwise if agent use agent id
			if ( is_author() ) {
				global $wp_query;
				$current_author = $wp_query->get_queried_object();
				$agent_args['author'] = $current_author->ID;
			} elseif ( is_singular( 'agent' ) ) {
				$agent_id = get_the_ID();
				$agent_args['meta_query'][] = array(
					'key' => 'REAL_HOMES_agents',
					'value' => $agent_id,
					'compare' => '=',
				);
				$agent_args['meta_query']['relation'] = 'AND';
			}

			// Order by
			if ( $sort_by == 'random' ) :
				$agent_args['orderby'] = 'rand';
			else :
				$agent_args['orderby'] = 'date';
			endif;

			$agent_query = new WP_Query( $agent_args );

			if ( is_author() || is_singular( 'agent' ) ) {  // it only works on author page or agent single page

				echo $before_widget;

				if ( $title ) :
					echo $before_title;
					echo $title;
					echo $after_title;
				endif;

				if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {

					if ( $agent_query->have_posts() ) :
						?>
						<ul class="featured-properties">
							<?php
							while ( $agent_query->have_posts() ) :
								$agent_query->the_post();
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
									<p><?php framework_excerpt( 7 ); ?> <a href="<?php the_permalink(); ?>"><?php _e( 'Read More','framework' ); ?></a></p>
									<?php
									$price = get_property_price();
									if ( $price ) {
										echo '<span class="price">' . $price . '</span>';
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
							_e( 'No Featured Property Found For This Agent', 'framework' );
							echo '.</li>';
							?>
						</ul>
						<?php
					endif;

				} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
					if ( $agent_query->have_posts() ) :
						while ( $agent_query->have_posts() ) :
							$agent_query->the_post();

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
						wp_reset_query();
					else :
					?>
					<div class="rh_alert-wrapper rh_alert__widget">
						<h4 class="no-results"><?php esc_html_e( 'No Featured Property Found For This Agent', 'framework' ); ?></h4>
					</div>
					<?php
					endif;
				}

				echo $after_widget;
			}
		}


		function form( $instance ) {

			$instance = wp_parse_args(
				(array) $instance, array(
					'title' => 'Featured Properties',
					'count' => 1,
					'sort_by' => 'random',
				)
			);

			$title = esc_attr( $instance['title'] );
			$sort_by = $instance['sort_by'];
			$count = $instance['count'];

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title', 'framework' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'sort_by' ) ); ?>"><?php _e( 'Sort By:', 'framework' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'sort_by' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'sort_by' ) ); ?>" class="widefat">
					<option value="recent"<?php selected( $sort_by, 'recent' ); ?>><?php _e( 'Most Recent', 'framework' ); ?></option>
					<option value="random"<?php selected( $sort_by, 'random' ); ?>><?php _e( 'Random', 'framework' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php _e( 'Number of Properties', 'framework' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" size="3" />
			</p>
		<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['sort_by'] = $new_instance['sort_by'];
			$instance['count'] = $new_instance['count'];

			return $instance;

		}

	}
}
?>
