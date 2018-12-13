<?php
/**
 * Search Form Over Image for Homepage.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<!-- SFOI = Search form over image -->
<div class="SFOI clearfix" style="background: url('<?php echo inspiry_get_search_bg_image(); ?>') no-repeat top center; background-size: cover; ">

<div class="SFOI__overlay">

	<div class="SFOI__content">
		<?php
			/*
			 * Title
			 */
			$inspiry_SFOI_title = get_option( 'inspiry_SFOI_title' );
			if ( ! empty( $inspiry_SFOI_title ) ) {
				?><h2 class="SFOI__title"><?php echo $inspiry_SFOI_title; ?></h2><?php

			}

			/*
			 * Description
			 */
			$inspiry_SFOI_description = get_option( 'inspiry_SFOI_description' );
			if ( ! empty( $inspiry_SFOI_description ) ) {
				?><p class="SFOI__description"><?php echo $inspiry_SFOI_description; ?></p><?php

			}
		?>
		<div class="SFOI__form-wrapper">
			<?php
				if ( inspiry_is_search_page_configured() ) :

					if ( inspiry_is_search_fields_configured() ) :

						$theme_search_fields = inspiry_get_search_fields();
						?>
						<form class="SFOI__form advance-search-form clearfix" action="<?php echo esc_url( inspiry_get_search_page_url() ); ?>" method="get">

							<div class="SFOI__top-fields-wrapper">

								<div class="SFOI__top-fields-container">
									<?php
										$SFOI_fields_counter = 0;
										$SFOI_max_top_fields = 3;
										$SFOI_top_fields     = array();

										/*
										 * Keyword Field
										 */
										if ( in_array( 'keyword-search', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/keyword' );
											$SFOI_top_fields[] = 'keyword-search';
											$SFOI_fields_counter ++;
										}

										/*
										 * Property ID Field
										 */
										if ( in_array( 'property-id', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/property-id' );
											$SFOI_top_fields[] = 'property-id';
											$SFOI_fields_counter ++;
										}

										/*
										 * Location Field
										 */
										if ( in_array( 'location', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/location' );
											$SFOI_top_fields[]     = 'location';
											$location_select_count = inspiry_get_locations_number();
											$SFOI_fields_counter += $location_select_count;
										}

										/*
										 * Property Status Field
										 */
										if ( in_array( 'status', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/status' );
											$SFOI_top_fields[] = 'status';
											$SFOI_fields_counter ++;
										}

										/*
										 * Property Type Field
										 */
										if ( in_array( 'type', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/type' );
											$SFOI_top_fields[] = 'type';
											$SFOI_fields_counter ++;
										}

										/*
										 * Agent Field
										 */
										if ( in_array( 'agent', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/agent' );
											$SFOI_top_fields[] = 'agent';
											$SFOI_fields_counter ++;
										}

										/*
										 * Min Beds Field
										 */
										if ( in_array( 'min-beds', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/min-beds' );
											$SFOI_top_fields[] = 'min-beds';
											$SFOI_fields_counter ++;
										}

										/*
										 * Min Baths Field
										 */
										if ( in_array( 'min-baths', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/min-baths' );
											$SFOI_top_fields[] = 'min-baths';
											$SFOI_fields_counter ++;
										}

										/*
										 * Min Garages Field
										 */
										if ( in_array( 'min-garages', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/min-garages' );
											$SFOI_top_fields[] = 'min-garages';
											$SFOI_fields_counter += 1;
										}

										/*
										 * Min & Max Price
										 */
										if ( in_array( 'min-max-price', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/min-max-price' );
											$SFOI_top_fields[] = 'min-max-price';
											$SFOI_fields_counter += 2;
										}

										/*
										 * Min & Max Area
										 */
										if ( in_array( 'min-max-area', $theme_search_fields ) && ( $SFOI_fields_counter < $SFOI_max_top_fields ) ) {
											get_template_part( 'assets/classic/partials/properties/search/fields/min-max-area' );
											$SFOI_top_fields[] = 'min-max-area';
											$SFOI_fields_counter += 2;
										}

										/*
										 * Search Button
										 */
										get_template_part( 'assets/classic/partials/properties/search/fields/button' );
									?>
								</div>
							</div>
							<?php
								/*
								 * Check to find out if we really need to show advanced fields
								 * Ref: http://www.php.net/manual/en/language.operators.array.php
								 */
								if ( $theme_search_fields != $SFOI_top_fields ) {
									?>
									<div class="SFOI__advanced-fields-wrapper">

										<div class="SFOI__advanced-fields-container">
											<?php
												/*
												 * We will not display fields those are displayed in top container and we know about those fields using $SFOI_top_fields array
												 */

												/*
												 * Property Status Field
												 */
												if ( in_array( 'status', $theme_search_fields ) && ! in_array( 'status', $SFOI_top_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/status' );
												}

												/*
												 * Property Type Field
												 */
												if ( in_array( 'type', $theme_search_fields ) && ! in_array( 'type', $SFOI_top_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/type' );
												}

												/*
												 * Property Agent Field
												 */
												if ( in_array( 'agent', $theme_search_fields ) && ! in_array( 'agent', $SFOI_top_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/agent' );
												}

												/*
												 * Min Beds Field
												 */
												if ( in_array( 'min-beds', $theme_search_fields ) && ! in_array( 'min-beds', $SFOI_top_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/min-beds' );
												}

												/*
												 * Min Baths Field
												 */
												if ( in_array( 'min-baths', $theme_search_fields ) && ! in_array( 'min-baths', $SFOI_top_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/min-baths' );
												}

												/*
												 * Min Garages Field
												 */
												if ( in_array( 'min-garages', $theme_search_fields ) && ! in_array( 'min-garages', $SFOI_top_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/min-garages' );
												}

												/*
												 * Min & Max Price
												 */
												if ( in_array( 'min-max-price', $theme_search_fields ) && ! in_array( 'min-max-price', $SFOI_top_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/min-max-price' );
												}

												/*
												 * Min & Max Area
												 */
												if ( in_array( 'min-max-area', $theme_search_fields ) && ! in_array( 'min-max-area', $SFOI_top_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/min-max-area' );
												}

												/*
												 * Features
												 */
												if ( in_array( 'features', $theme_search_fields ) ) {
													get_template_part( 'assets/classic/partials/properties/search/fields/features' );
												} ?>
										</div>
									</div>
									<?php

								}
							?>
						</form>
						<?php
						/**
						 * Check to find out if we really need to show advanced search button
						 * Ref: http://www.php.net/manual/en/language.operators.array.php
						 */
						if ( $theme_search_fields != $SFOI_top_fields ) {
							?>
							<div class="SFOI__advanced-expander"><?php esc_html_e( 'Advanced Search', 'framework' ); ?>
							<i class="fa fa-angle-down" aria-hidden="true"></i></div><?php
						}
					endif;
				endif;
			?>
		</div>
	</div>

</div>
</div>
