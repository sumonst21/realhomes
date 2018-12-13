<?php
/**
 * Properties grid layout.
 *
 * Displays properties in grid layout.
 *
 * @since    3.3.2
 * @package  realhomes
 */

/*
 * 1. Apply sticky posts filter.
 * 2. Display google maps.
 */
get_template_part( 'assets/modern/partials/properties/common-top' );
?>

<section class="rh_section rh_section--flex rh_wrap--padding rh_wrap--topPadding">

	<div class="rh_page rh_page__listing_page rh_page__main">

		<?php
		/*
		 * 1. Display page's title.
		 * 2. Display page's sort controls.
		 * 3. Display page's layout buttons.
		 */
		get_template_part( 'assets/modern/partials/properties/common-content-top' );
		?>

		<?php
		/*
		 * 1. Display page contents.
		 * 2. Display compare properties module.
		 */
		get_template_part( 'assets/modern/partials/properties/common-content' );
		?>

		<div class="rh_page__listing rh_page__listing_grid">

			<?php
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

					// Display property for grid layout.
					get_template_part( 'assets/modern/partials/properties/grid-card' );

				endwhile;
				wp_reset_postdata();
			else :
				?>
				<div class="rh_alert-wrapper">
					<h4 class="no-results"><?php esc_html_e( 'Sorry No Results Found!', 'framework' ); ?></h4>
				</div>
				<?php
			endif;
			?>
		</div>
		<!-- /.rh_page__listing -->

		<?php inspiry_theme_pagination( $property_listing_query->max_num_pages ); ?>

	</div>
	<!-- /.rh_page rh_page__main -->

	<div class="rh_page rh_page__sidebar">
		<?php get_sidebar( 'property-listing' ); ?>
	</div>
	<!-- /.rh_page rh_page__sidebar -->

</section>
<!-- /.rh_section rh_wrap rh_wrap--padding -->
