<?php
	
if ( ! function_exists( 'inspiry_guests_search' ) ) :
	/**
	 * Add property guest related search arguments to meta query
	 *
	 * @param $meta_query
	 *
	 * @return array
	 */
	function inspiry_guests_search( $meta_query ) {
		if ( isset( $_GET['guests'] ) && ! empty( $_GET['guests'] ) ) {
			$meta_query[] = array(
				'key'     => 'rvr_guests_capacity',
				'value'   => $_GET['guests'],
				'compare' => '>=',
				'type'    => 'NUMERIC'
			);
		}

		return $meta_query;
	}

	add_filter( 'inspiry_real_estate_meta_search', 'inspiry_guests_search' );
endif;



if ( ! function_exists( 'inspiry_min_guests' ) ) {
	/**
	 * Generate values for minimum guests select box
	 */
	function inspiry_min_guests() {
		
		$min_guests_values = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );

		/* check and store searched value if there is any */
		$searched_value = '';
		if ( isset( $_GET[ 'guests' ] ) ) {
			$searched_value = $_GET[ 'guests' ];
		}

		/* Add any to select box */
		if ( $searched_value == inspiry_any_value() || empty( $searched_value ) ) {
			echo '<option value="' . inspiry_any_value() . '" selected="selected">' . inspiry_any_text() . '</option>';
		} else {
			echo '<option value="' . inspiry_any_value() . '">' . inspiry_any_text() . '</option>';
		}

		/* loop through min guests values and generate select options */
		if ( ! empty( $min_guests_values ) ) {
			foreach ( $min_guests_values as $guests_value ) {
				if ( $searched_value == $guests_value ) {
					echo '<option value="' . $guests_value . '" selected="selected">' . $guests_value . '</option>';
				} else {
					echo '<option value="' . $guests_value . '">' . $guests_value . '</option>';
				}
			}
		}

	}
}