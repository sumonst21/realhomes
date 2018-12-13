<?php
/**
 * Rental Properties search form.
 *
 * @package    realhomes
 * @subpackage classic
 */
?>
<div class="as-form-wrap">
	<form class="rvr-search advance-search-form clearfix" action="<?php echo esc_url( inspiry_get_search_page_url() ); ?>" method="get">
		<?php

			/*
			 * Location Field
			 */
			get_template_part( 'assets/classic/partials/properties/search/fields/location' );


			/*
			 * Check In & Check Out Field
			 */
			get_template_part( 'assets/classic/partials/properties/search/fields/rvr/check-in-out' );

			/*
			 * Number of Guests Field
			 */
			get_template_part( 'assets/classic/partials/properties/search/fields/rvr/guest' );

			/*
			 * Search Button
			 */
			get_template_part( 'assets/classic/partials/properties/search/fields/button' );

			if ( isset( $_GET['sortby'] ) ) {
				?><input type="hidden" name="sortby" value="<?php echo $_GET['sortby']; ?>" /><?php

			}
		?>
	</form>
</div>
