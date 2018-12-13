<?php
/**
 * Properties search widget form.
 *
 * @package    realhomes
 * @subpackage modern
 */

if ( inspiry_is_search_fields_configured() && inspiry_show_search_form_widget() ) :
	$theme_search_fields = inspiry_get_search_fields();
	?>

	<form class="rh_widget_search__form advance-search-form" action="<?php echo esc_url( inspiry_get_search_page_url() ); ?>" method="get">

		<div class="rh_widget_search__fields">

			<?php

			/**
			 * Location Field
			 */
			if ( in_array( 'location', $theme_search_fields, true ) ) {
				get_template_part( 'assets/modern/partials/properties/search/fields/location' );
			}

			/**
			 * Property Type Field
			 */
			if ( in_array( 'type', $theme_search_fields, true ) ) {
				get_template_part( 'assets/modern/partials/properties/search/fields/type' );
			}

			/**
			 * Property Status Field
			 */
			if ( in_array( 'status', $theme_search_fields, true ) ) {
				get_template_part( 'assets/modern/partials/properties/search/fields/status' );
			}

			/**
			 * Min Beds Field
			 */
			if ( in_array( 'min-beds', $theme_search_fields, true ) ) {
				get_template_part( 'assets/modern/partials/properties/search/fields/min-beds' );
			}

			/**
			 * Min & Max Price
			 */
			if ( in_array( 'min-max-price', $theme_search_fields, true ) ) {
				get_template_part( 'assets/modern/partials/properties/search/fields/min-max-price' );
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
			 * Min & Max Area
			 */
			if ( in_array( 'min-max-area', $theme_search_fields, true ) ) {
				get_template_part( 'assets/modern/partials/properties/search/fields/min-max-area' );
			}

			/**
			 * Property ID Field
			 */
			if ( in_array( 'property-id', $theme_search_fields, true ) ) {
				get_template_part( 'assets/modern/partials/properties/search/fields/property-id' );
			}

			/**
			 * Keyword Field
			 */
			if ( in_array( 'keyword-search', $theme_search_fields, true ) ) {
				get_template_part( 'assets/modern/partials/properties/search/fields/keyword' );
			}

			?>

		</div>
		<!-- /.rh_widget_search__fields -->

		<div class="rh_widget_search__buttons">
			<?php
			/**
			 * Search Button
			 */
			get_template_part( 'assets/modern/partials/properties/search/fields/button' );
			?>
		</div>
		<!-- /.rh_widget_search__buttons -->

	</form>
	<!-- /.rh_widget_search__form -->

	<?php
else :
	?>
	<div class="rh_alert-wrapper rh_alert__widget">
		<h4 class="no-results"><?php esc_html_e( 'Advance Search is already enabled in the header.', 'framework' ); ?></h4>
	</div>
	<?php
endif;
