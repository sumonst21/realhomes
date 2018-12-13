<?php
/**
 * Functions: Compare.
 *
 * This file contain functions related to compare properties.
 *
 * @since 2.6.0
 */

if ( ! function_exists( 'inspiry_add_to_compare' ) ) {
	/**
	 * Add a property to list of compare.
	 */
	function inspiry_add_to_compare() {

		/* Store the property id in the list of compare cookie */
		if ( isset( $_POST['property_id'] ) ) {

			// Get the property id from form.
			$property_id 			= intval( $_POST[ 'property_id' ] );
			// Check if the property id is valid.
			if ( $property_id > 0 ) {

				$property_img = wp_get_attachment_image_src(
					get_post_meta( $property_id, '_thumbnail_id', true ), 'property-thumb-image'
				);

				if ( empty( $property_img ) ) {
					$property_img[0] = get_inspiry_image_placeholder_url( 'property-thumb-image' );
				}

				$inspiry_compare 		= array();
				if ( isset( $_COOKIE[ 'inspiry_compare' ] ) ) {
					$inspiry_compare 	= unserialize( $_COOKIE[ 'inspiry_compare' ] );
				}
				$inspiry_compare[] 		= $property_id;

				if ( setcookie( 'inspiry_compare', serialize( $inspiry_compare ), time() + ( 60 * 60 * 24 * 30 ), '/' ) ) {
					echo json_encode( array (
						'success'		=> true,
						'message'		=> __( 'Added to Compare', 'framework' ),
						'img' 			=> ( isset( $property_img[0] ) ) ? $property_img[0] : false,
						'img_width'		=> ( isset( $property_img[1] ) ) ? $property_img[1] : false,
						'img_height'	=> ( isset( $property_img[2] ) ) ? $property_img[2] : false,
						'property_id' 	=> $property_id,
						'ajaxURL'		=> admin_url( 'admin-ajax.php' )
					) );
				} else {
					echo json_encode( array (
						'success'		=> false,
						'message'		=> __( 'Failed!', 'framework' )
					) );
				}

			}
		} else {
			echo json_encode( array (
				'success'		=> false,
				'message'		=> __( 'Invalid Parameters', 'framework' )
			) );
		}
		die();

	}

	add_action( 'wp_ajax_inspiry_add_to_compare', 'inspiry_add_to_compare' );
	add_action( 'wp_ajax_nopriv_inspiry_add_to_compare', 'inspiry_add_to_compare' );
}

if ( ! function_exists( 'inspiry_is_added_to_compare' ) ) {
	/**
	 * Check if a property is already added to compare list.
	 *
	 * @param $property_id
	 * @return bool
	 */
	function inspiry_is_added_to_compare( $property_id ) {

		if ( $property_id > 0 ) {
			/* check cookies for property id */
			if ( isset( $_COOKIE[ 'inspiry_compare' ] ) ) {
				$inspiry_compare 	= unserialize( $_COOKIE[ 'inspiry_compare' ] );
				if ( in_array( $property_id, $inspiry_compare ) ) {
					return true;
				}
			}
		}
		return false;

	}
}


if ( ! function_exists( 'inspiry_remove_from_compare' ) ) {
	/**
	 * Remove from compare
	 */
	function inspiry_remove_from_compare() {

		if ( isset( $_POST[ 'property_id' ] ) ) {

			$property_id 				= intval( $_POST[ 'property_id' ] );

			if ( $property_id > 0 ) {

				if ( isset( $_COOKIE[ 'inspiry_compare' ] ) ) {

					$inspiry_compare 	= unserialize( $_COOKIE[ 'inspiry_compare' ] );
					$target_index 		= array_search( $property_id, $inspiry_compare );

					if ( $target_index >= 0 && $target_index !== false ) {
						unset( $inspiry_compare[ $target_index ] );
						setcookie( 'inspiry_compare', serialize( $inspiry_compare ), time() + ( 60 * 60 * 24 * 30 ), '/' );
						echo json_encode( array(
								'success' 		=> true,
								'property_id'	=> $property_id,
								'message' 		=> __( "Removed Successfully!", 'framework' )
							)
						);
						die();
					} else {
						echo json_encode( array(
								'success' 	=> false,
								'message' 	=> __( "Failed to remove!", 'framework' )
							)
						);
						die();
					}
				}
			}
		}

		echo json_encode( array(
				'success' => false,
				'message' => __( "Invalid Parameters!", 'framework' )
			)
		);
		die();
	}

	add_action( 'wp_ajax_inspiry_remove_from_compare', 'inspiry_remove_from_compare' );
	add_action( 'wp_ajax_nopriv_inspiry_remove_from_compare', 'inspiry_remove_from_compare' );
}
