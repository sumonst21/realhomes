<?php
/**
 * Display properties in grid layout.
 *
 * @package realhomes
 * @subpackage classic
 */

?>

<!-- Content -->
<div class="container contents listing-grid-layout">
	<div class="row">
		<div class="span9 main-wrap">

			<!-- Main Content -->
			<div class="main">
				<section class="listing-layout property-grid">
					<?php
					/*
					 * Page title.
					 */
					$title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
					if ( 'hide' !== $title_display ) {
						?>
						<h3 class="title-heading"><?php the_title(); ?></h3>
						<?php
					}

					/*
					 * Grid or List View Buttons.
					 */
					get_template_part( 'assets/classic/partials/properties/view-buttons' );
					?>

					<div class="list-container inner-wrapper clearfix">
						<?php
						/*
						 * Sort controls.
						 */
						get_template_part( 'assets/classic/partials/properties/sort-controls' );

						/*
						 * Page contents.
						 */
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								if ( get_the_content() ) {
									?>
									<article <?php post_class(); ?>>
										<?php the_content(); ?>
									</article>
									<?php
								}
							}
						}

						/*
						 * Compare properties.
						 */
						$compare_properties_module = get_option( 'theme_compare_properties_module' );
						$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
						if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
							get_template_part( 'assets/classic/partials/properties/compare/view' );
						}

						/*
						 * Number of properties to display.
						 */
						$number_of_properties = intval( get_option( 'theme_number_of_properties' ) );
						if ( ! $number_of_properties ) {
							$number_of_properties = 6;
						}

						global $paged;
						if ( is_front_page() ) {
							$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
						}

						$properties_query_args = array(
							'post_type'      => 'property',
							'posts_per_page' => $number_of_properties,
							'paged'          => $paged,
						);

						// Apply properties filter.
						$properties_query_args = apply_filters( 'inspiry_properties_filter', $properties_query_args );

						// Add sorting arguments in properties query.
						$properties_query_args = sort_properties( $properties_query_args );

						$properties_query = new WP_Query( $properties_query_args );

						if ( $properties_query->have_posts() ) :

							$counter = 1;
							while ( $properties_query->have_posts() ) :
								$properties_query->the_post();

								// properties grid card.
								get_template_part( 'assets/classic/partials/properties/grid-card' );

								if ( $counter % 2 == 0 ) {
									?>
									<div class="clearfix rh-visible-xs"></div>
									<?php
								}

								if ( $counter % 3 == 0 ) {
									?>
									<div class="clearfix rh-visible-sm rh-visible-md rh-visible-lg"></div>
									<?php
								}
								$counter ++;
							endwhile;
							wp_reset_postdata();
						else :
							?>
							<div class="alert-wrapper">
								<h4><?php esc_html_e( 'Sorry No Results Found', 'framework' ); ?></h4>
							</div>
							<?php
						endif;
						?>
					</div>

					<?php theme_pagination( $properties_query->max_num_pages ); ?>

				</section>

			</div><!-- End Main Content -->
		</div> <!-- End span9 -->

		<?php get_sidebar( 'property-listing' ); ?>

	</div><!-- End contents row -->
</div><!-- End Content -->
