<?php
/**
 * View: Submit Property
 *
 * Viewing template of Submit Property page.
 *
 * @since   3.0.0
 * @package RH/modern
 */

if ( is_page_template( 'templates/submit-property.php' ) ) {

	$inspiry_submit_fields = inspiry_get_submit_fields(); ?>

	<div class="rh_form">

		<form id="submit-property-form" class="rh_form__form" enctype="multipart/form-data" method="post">

			<div class="rh_form__row">

				<?php
				/**
				 * Property Title
				 */
				if ( in_array( 'title', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/title' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Property Description
				 */
				if ( in_array( 'description', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/description' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Property Type
				 */
				if ( in_array( 'property-type', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/property-type' );
				}

				/**
				 * Property Status
				 */
				if ( in_array( 'property-status', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/property-status' );
				}

				/**
				 * Locations
				 */
				if ( in_array( 'locations', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/locations' );
				}

				/**
				 * Bedrooms
				 */
				if ( in_array( 'bedrooms', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/bedrooms' );
				}

				/**
				 * Bathrooms
				 */
				if ( in_array( 'bathrooms', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/bathrooms' );
				}

				/**
				 * Garages
				 */
				if ( in_array( 'garages', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/garages' );
				}

				/**
				 * Property ID
				 */
				if ( in_array( 'property-id', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/property-id' );
				}

				/**
				 * Property Price
				 */
				if ( in_array( 'price', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/price' );
				}

				/**
				 * Property Price Postfix
				 */
				if ( in_array( 'price-postfix', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/price-postfix' );
				}

				/**
				 * Property Area
				 */
				if ( in_array( 'area', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/area' );
				}

				/**
				 * Property Area Postfix
				 */
				if ( in_array( 'area-postfix', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/area-postfix' );
				}

				/**
				 * Property Video
				 */
				if ( in_array( 'video', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/video' );
				}

				/**
				 * Property Year Built
				 */
				if ( in_array( 'year-built', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/year-built' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Gallery Images
				 */
				global $column_class;
				$column_class = 'rh_form--2-column';
				if ( in_array( 'images', $inspiry_submit_fields, true ) ) {
					if ( ! in_array( 'address-and-map', $inspiry_submit_fields, true ) ) {
						$column_class = 'rh_form--1-column';
					}
					get_template_part( 'assets/modern/partials/property/form-fields/images' );
				}

				/**
				 * Address and Google Map
				 */
				if ( in_array( 'address-and-map', $inspiry_submit_fields, true ) ) {
					if ( ! in_array( 'images', $inspiry_submit_fields, true ) ) {
						$column_class = 'rh_form--1-column';
					}
					get_template_part( 'assets/modern/partials/property/form-fields/address-and-map' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Additional Details
				 */
				if ( in_array( 'additional-details', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/additional-details' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Property Features
				 */
				if ( in_array( 'features', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/features' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Property Agent
				 */
				if ( in_array( 'agent', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/agent' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Reviewer Message
				 */
				if ( in_array( 'reviewer-message', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/reviewer-message' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Featured Property
				 */
				if ( in_array( 'featured', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/featured' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
					/**
					 * Terms & Conditions
					 */
				if ( in_array( 'terms-conditions', $inspiry_submit_fields, true ) ) {
					get_template_part( 'assets/modern/partials/property/form-fields/terms-conditions' );
				}
				?>

			</div>
			<!-- /.rh_form__row -->

			<div class="rh_form__row">

				<?php
				/**
				 * Submit Button
				 */
				get_template_part( 'assets/modern/partials/property/form-fields/submit-button' );
				?>

			</div>
			<!-- /.rh_form__row -->

		</form>

	</div>
	<!-- /.rh_form -->
	<?php
}
