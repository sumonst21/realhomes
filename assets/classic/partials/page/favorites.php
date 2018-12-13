<?php
/**
 * Favorite Properties Page
 *
 * Page template for favorite properties.
 *
 * @since 2.7.0
 * @package RH/classic
 */

get_header();

get_template_part( 'assets/classic/partials/banners/default' ); ?>

<!-- Content -->
<div class="container contents listing-grid-layout">
	<div class="row">
		<div class="span9 main-wrap">

			<!-- Main Content -->
			<div class="main">
				<section class="listing-layout property-grid">

					<?php
					global $post;
					$title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
					if ( 'hide' !== $title_display ) {
						?>
						<h3 class="title-heading"><?php the_title(); ?></h3>
						<?php
					}
					?>

					<div class="list-container inner-wrapper clearfix">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();

								$content = get_the_content();
								if ( ! empty( $content ) ) {
									?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
										<?php the_content(); ?>
									</article>
									<?php
								}
							endwhile;
						endif;

						$favorite_properties = array();

						if ( is_user_logged_in() ) {
							$user_id = get_current_user_id();
							$favorite_properties = get_user_meta( $user_id, 'favorite_properties' );
						} else {
							if ( isset( $_COOKIE['inspiry_favorites'] ) ) {
								$favorite_properties = unserialize( $_COOKIE['inspiry_favorites'] );
							}
						}

						$number_of_properties = count( $favorite_properties );

						if ( $number_of_properties > 0 ) {

							$favorites_properties_args = array(
								'post_type' => 'property',
								'posts_per_page' => $number_of_properties,
								'post__in' => $favorite_properties,
								'orderby' => 'post__in',
							);

							$favorites_query = new WP_Query( $favorites_properties_args );

							if ( $favorites_query->have_posts() ) {
								while ( $favorites_query->have_posts() ) {
									$favorites_query->the_post();
									?>
									<article <?php post_class( 'property-item clearfix' ); ?>>

										<figure>
											<a href="<?php the_permalink(); ?>">
												<?php
												if ( has_post_thumbnail( $post->ID ) ) {
													the_post_thumbnail( 'grid-view-image' );
												} else {
													inspiry_image_placeholder( 'grid-view-image' );
												}
												?>
											</a>
											<?php inspiry_display_property_label( $post->ID ); ?>
											<figcaption>
												<?php
												$status_terms = get_the_terms( $post->ID, 'property-status' );
												if ( ! empty( $status_terms ) ) {
													$status_count = 0;
													foreach ( $status_terms as $term ) {
														if ( $status_count > 0 ) {
															echo ', ';
														}
														echo esc_html( $term->name );
														$status_count++;
													}
												}
												?>
											</figcaption>
											<a class="remove-from-favorite" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" title="<?php esc_attr_e( 'Remove from favorites', 'framework' ); ?>"><i class="fa fa-trash-o"></i></a>
											<span class="loader"><i class="fa fa-spinner fa-spin"></i></span>
										</figure>

										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

										<p><?php framework_excerpt( 10 ); ?>
											<a class="more-details" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More Details ', 'framework' ); ?>
												<i class="fa fa-caret-right"></i></a></p>
										<?php
										$price = get_property_price();
										if ( $price ) {
											echo '<span>';
												echo esc_html( $price );
											echo '</span>';
										}
										?>
										<div class="ajax-response"></div>
									</article>
									<?php
								}
								wp_reset_postdata();
							} else {
								?>
								<div class="alert-wrapper">
									<h4><?php esc_html_e( 'No property found!', 'framework' ); ?></h4>
								</div>
								<?php
							}
						} else {
							?>
							<div class="alert-wrapper">
								<h4><?php esc_html_e( 'You have no property in favorites!', 'framework' ); ?></h4>
							</div>
							<?php
						}
						?>
					</div>

				</section>

			</div><!-- End Main Content -->
		</div> <!-- End span9 -->

		<?php get_sidebar( 'property-listing' ); ?>

	</div><!-- End contents row -->
</div><!-- End Content -->

<?php get_footer(); ?>
