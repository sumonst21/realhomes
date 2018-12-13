<?php
/**
 * Properties Search Form
 *
 * @package    realhomes
 * @subpackage modern
 */

if ( inspiry_is_search_fields_configured() ) :
	$theme_search_fields = inspiry_get_search_fields();
	?>

	<form class="rh_prop_search__form advance-search-form" action="<?php echo esc_url( inspiry_get_search_page_url() ); ?>" method="get">

		<div class="rh_prop_search__fields">

			<div class="rh_prop_search__wrap">
				<?php

				// Number of locations chosen from theme options.
				$location_count = inspiry_get_locations_number();

				if ( 1 === $location_count ) {
					/**
					 * Keyword Field
					 */
					if ( in_array( 'keyword-search', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/keyword' );
					}

					/**
					 * Location Field
					 */
					if ( in_array( 'location', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/location' );
					}

					/**
					 * Property Status Field
					 */
					if ( in_array( 'status', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/status' );
					}

					/**
					 * Property Type Field
					 */
					if ( in_array( 'type', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/type' );
					}
				} elseif ( 2 === $location_count ) {
					/**
					 * Location Field
					 */
					if ( in_array( 'location', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/location' );
					}

					/**
					 * Property Status Field
					 */
					if ( in_array( 'status', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/status' );
					}

					/**
					 * Property Type Field
					 */
					if ( in_array( 'type', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/type' );
					}
				} elseif ( 3 === $location_count ) {
					/**
					 * Location Field
					 */
					if ( in_array( 'location', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/location' );
					}

					/**
					 * Property Status Field
					 */
					if ( in_array( 'status', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/status' );
					}
				} elseif ( 4 === $location_count ) {
					/**
					 * Location Field
					 */
					if ( in_array( 'location', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/location' );
					}
				}

				?>
			</div>
			<!-- /.rh_prop_search__wrap -->

			<div class="rh_prop_search__dropdown" id="rh_prop_search__dropdown">

				<?php
				if ( 2 === $location_count ) {
					/**
					 * Keyword Field
					 */
					if ( in_array( 'keyword-search', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/keyword' );
					}
				} elseif ( 3 === $location_count ) {
					/**
					 * Keyword Field
					 */
					if ( in_array( 'keyword-search', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/keyword' );
					}

					/**
					 * Property Type Field
					 */
					if ( in_array( 'type', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/type' );
					}
				} elseif ( 4 === $location_count ) {
					/**
					 * Keyword Field
					 */
					if ( in_array( 'keyword-search', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/keyword' );
					}

					/**
					 * Property Status Field
					 */
					if ( in_array( 'status', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/status' );
					}

					/**
					 * Property Type Field
					 */
					if ( in_array( 'type', $theme_search_fields, true ) ) {
						get_template_part( 'assets/modern/partials/properties/search/fields/type' );
					}
				}

				/**
				 * Property ID Field
				 */
				if ( in_array( 'property-id', $theme_search_fields, true ) ) {
					get_template_part( 'assets/modern/partials/properties/search/fields/property-id' );
				}

				/**
				 * Agent Field
				 */
				if ( in_array( 'agent', $theme_search_fields, true ) ) {
					get_template_part( 'assets/modern/partials/properties/search/fields/agent' );
				}

				/**
				 * Min Beds Field
				 */
				if ( in_array( 'min-beds', $theme_search_fields, true ) ) {
					get_template_part( 'assets/modern/partials/properties/search/fields/min-beds' );
				}

				/**
				 * Min Baths Field
				 */
				if ( in_array( 'min-baths', $theme_search_fields, true ) ) {
					get_template_part( 'assets/modern/partials/properties/search/fields/min-baths' );
				}

				/**
				 * Min Garages Field
				 */
				if ( in_array( 'min-garages', $theme_search_fields, true ) ) {
					get_template_part( 'assets/modern/partials/properties/search/fields/min-garages' );
				}

				/**
				 * Min & Max Price
				 */
				if ( in_array( 'min-max-price', $theme_search_fields, true ) ) {
					get_template_part( 'assets/modern/partials/properties/search/fields/min-max-price' );
				}

				/**
				 * Min & Max Area
				 */
				if ( in_array( 'min-max-area', $theme_search_fields, true ) ) {
					get_template_part( 'assets/modern/partials/properties/search/fields/min-max-area' );
				}
				?>

			</div>
			<!-- /.rh_prop_search__dropdown -->

		</div>
		<!-- /.rh_prop_search__fields -->

		<div class="rh_prop_search__buttons">
			<?php
			/**
			 * Search Button
			 */
			get_template_part( 'assets/modern/partials/properties/search/fields/button' );
			?>
		</div>
		<!-- /.rh_prop_search__buttons -->

	</form>
	<!-- /.rh_prop_search__form -->

	<?php
endif;
