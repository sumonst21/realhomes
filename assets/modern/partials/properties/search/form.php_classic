<?php
/**
 * Properties search form.
 *
 * @package    realhomes
 * @subpackage classic
 */

if ( inspiry_is_search_fields_configured() ) :
	$theme_search_fields = inspiry_get_search_fields();
	$collapse_more_fields = get_option( 'inspiry_sidebar_asf_collapse', 'no' );

	?>
	<div class="as-form-wrap">
		<form class="advance-search-form clearfix" action="<?php echo esc_url( inspiry_get_search_page_url() ); ?>" method="get">
			<?php

			/*
			 * Keyword Field
			 */
			if ( in_array( 'keyword-search', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/keyword' );
			}


			/*
			 * Property ID Field
			 */
			if ( in_array( 'property-id', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/property-id' );
			}


			/*
			 * Location Field
			 */
			if ( in_array( 'location', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/location' );
			}


			/*
			 * Property Status Field
			 */
			if ( in_array( 'status', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/status' );
			}

			/*
			 * Property Type Field
			 */
			if ( in_array( 'type', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/type' );
			}

			if ( 'yes' == $collapse_more_fields ) {
				echo '<div class="more-fields-wrapper collapsed">';
			}

			/*
			 * Agents Field
			 */
			if ( in_array( 'agent', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/agent' );
			}


			/*
			 * Min Beds Field
			 */
			if ( in_array( 'min-beds', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/min-beds' );
			}


			/*
			 * Min Baths Field
			 */
			if ( in_array( 'min-baths', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/min-baths' );
			}


			/*
			 * Min Garages Field
			 */
			if ( in_array( 'min-garages', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/min-garages' );
			}


			/*
			 * Min & Max Price
			 */
			if ( in_array( 'min-max-price', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/min-max-price' );
			}


			/*
			 * Min & Max Area
			 */
			if ( in_array( 'min-max-area', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/min-max-area' );
			}


			if ( 'yes' == $collapse_more_fields ) {
				?>
				</div>
				<div class="more-fields-trigger">
					<a href="#"><i class="fa fa-plus-square-o"></i>
						<span><?php esc_html_e( 'More fields', 'framework' ); ?></span></a>
				</div>
				<?php
			}

			/*
			 * Search Button
			 */
			get_template_part( 'assets/classic/partials/properties/search/fields/button' );


			if ( isset( $_GET['sortby'] ) ) {
				?><input type="hidden" name="sortby" value="<?php echo $_GET['sortby']; ?>" /><?php

			}


			/*
			 * Features
			 */
			if ( in_array( 'features', $theme_search_fields ) ) {
				get_template_part( 'assets/classic/partials/properties/search/fields/features' );
			}

			?>
		</form>
	</div>
	<?php
endif;
