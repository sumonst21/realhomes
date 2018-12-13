<?php
/**
 * Field: Property Locations
 *
 * @since 	3.0.0
 * @package RH/modern
 */

// Number of locations chosen from theme options.
$location_select_count = inspiry_get_locations_number();

// Variable that contains location select boxes names.
$location_select_names = inspiry_get_location_select_names();

// Default location select boxes titles.
$location_select_titles = inspiry_get_location_titles();

/* Generate required location select boxes */
for ( $i = 0; $i < $location_select_count; $i++ ) {
	?>
	<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
		<label for="<?php echo esc_attr( $location_select_names[ $i ] ); ?>"><?php echo esc_html( $location_select_titles[ $i ] ); ?></label>
	    <span class="selectwrap">
	        <select name="<?php echo esc_attr( $location_select_names[ $i ] ); ?>" id="<?php echo esc_attr( $location_select_names[ $i ] ); ?>" class="rh_select2"></select>
	    </span>
	</div>
	<!-- /.rh_form__item -->
	<?php

}

// Important action hook - related JS works based on it.
do_action( 'after_location_fields' );
