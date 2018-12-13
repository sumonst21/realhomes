<?php
/**
 * This file contains functions related to property submit and property edit
 */


if ( ! function_exists( 'generate_posts_list' ) ) {
	/**
	 * Generates options list for given post arguments
	 *
	 * @param $post_args
	 * @param int $selected
	 */
	function generate_posts_list( $post_args, $selected = 0 ) {

		$defaults = array( 'posts_per_page' => -1, 'suppress_filters' => true );

		if ( is_array( $post_args ) ) {
			$post_args = wp_parse_args( $post_args, $defaults );
		} else {
			$post_args = wp_parse_args( array( 'post_type' => $post_args ), $defaults );
		}

		$posts = get_posts( $post_args );

		if ( isset( $selected ) && is_array( $selected ) ) {
			foreach ( $posts as $post ) :
				?><option value="<?php echo esc_attr( $post->ID ); ?>" <?php if ( in_array( $post->ID, $selected ) ) { echo "selected"; } ?>><?php echo esc_html( $post->post_title ); ?></option><?php
			endforeach;
		} else {
			foreach ( $posts as $post ) :
				?><option value="<?php echo esc_attr( $post->ID ); ?>" <?php if ( isset( $selected ) && ( $selected == $post->ID ) ) { echo "selected"; } ?>><?php echo esc_html( $post->post_title ); ?></option><?php
			endforeach;
		}
	}
}


if ( ! function_exists( 'inspiry_is_edit_property' ) ) :
	/**
	 * Checks if edit property parameter is send
	 * @return bool
	 */
	function inspiry_is_edit_property() {
		if ( isset( $_GET[ 'edit_property' ] ) && ! empty( $_GET[ 'edit_property' ] ) ) {
			return true;
		}

		return false;
	}
endif;



if ( ! function_exists( 'inspiry_get_submit_fields' ) ) :
	/**
	 * Get submit fields array
	 */
	function inspiry_get_submit_fields() {
		$inspiry_submit_property_fields = get_option( 'inspiry_submit_property_fields' );
		if ( !empty( $inspiry_submit_property_fields ) && is_array( $inspiry_submit_property_fields ) ) {
			return $inspiry_submit_property_fields;
		} else {
			// All fields - To handle the case where related setting is not saved after theme update
			return array(
				'title',
				'description',
				'property-type',
				'property-status',
				'locations',
				'bedrooms',
				'bathrooms',
				'garages',
				'property-id',
				'price',
				'price-postfix',
				'area',
				'area-postfix',
				'video',
				'images',
				'address-and-map',
				'additional-details',
				'featured',
				'features',
				'agent',
				'parent',
				'reviewer-message',
			);
		}
	}
endif;