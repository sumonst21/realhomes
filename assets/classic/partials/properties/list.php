<?php
/**
 * Properties List Layout
 *
 * Displays properties in list layout
 *
 * @package    realhomes
 * @subpackage classic
 */

global $page;

?>

<div class="container contents listing-grid-layout">
	<div class="row">
		<div class="span9 main-wrap">

			<!-- Main Content -->
			<div class="main">

				<section class="listing-layout">

					<?php
					$title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
					if ( 'hide' !== $title_display ) {
						?>
						<h3 class="title-heading"><?php the_title(); ?></h3>
						<?php

					}
					// Listing view type.
					get_template_part( 'assets/classic/partials/properties/view-buttons' );
					?>

					<div class="list-container inner-wrapper clearfix">
						<?php get_template_part( 'assets/classic/partials/properties/sort-controls' ); ?>

						<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : ?>
								<?php the_post(); ?>

								<?php if ( get_the_content() ) : ?>
									<article <?php post_class(); ?>>
										<?php the_content(); ?>
									</article>
								<?php endif; ?>

							<?php endwhile; ?>
						<?php endif; ?>

						<?php
						$compare_properties_module = get_option( 'theme_compare_properties_module' );
						$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
						if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
							get_template_part( 'assets/classic/partials/properties/compare/view' );
						}

						$number_of_properties = intval( get_option( 'theme_number_of_properties' ) );
						if ( ! $number_of_properties ) {
							$number_of_properties = 6;
						}

						global $paged;
						if ( is_front_page() ) {
							$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
						}

						$property_listing_args = array(
							'post_type'      => 'property',
							'posts_per_page' => $number_of_properties,
							'paged'          => $paged,
						);

						// Apply properties filter.
						$property_listing_args = apply_filters( 'inspiry_properties_filter', $property_listing_args );

						$property_listing_args = sort_properties( $property_listing_args );

						$property_listing_query = new WP_Query( $property_listing_args );

						if ( $property_listing_query->have_posts() ) :
							while ( $property_listing_query->have_posts() ) :
								$property_listing_query->the_post();

								get_template_part( 'assets/classic/partials/properties/list-card' );

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

					<?php theme_pagination( $property_listing_query->max_num_pages ); ?>

				</section>

			</div><!-- End Main Content -->

		</div> <!-- End span9 -->

		<?php get_sidebar( 'property-listing' ); ?>

	</div><!-- End contents row -->
</div>
