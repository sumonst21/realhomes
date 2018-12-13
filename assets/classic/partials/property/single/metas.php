<?php
/**
 * Property meta.
 *
 * @package    realhomes
 * @subpackage classic
 */

$post_meta_data = get_post_custom( $post->ID );

if ( is_singular( 'property' ) && ! empty( $post_meta_data['REAL_HOMES_property_id'][0] ) ) {
	$prop_id = $post_meta_data['REAL_HOMES_property_id'][0];
	echo '<span title="' . esc_html__( 'Property ID', 'framework' ) . '">';
	include INSPIRY_THEME_DIR . '/images/icon-id.svg';
	echo esc_html( $prop_id );
	echo '</span>';
}

if ( ! empty( $post_meta_data['REAL_HOMES_property_size'][0] ) ) {
	$prop_size = $post_meta_data['REAL_HOMES_property_size'][0];
	echo '<span title="' . esc_html__( 'Area Size', 'framework' ) . '">';
	include INSPIRY_THEME_DIR . '/images/icon-size.svg';
	echo esc_html( $prop_size );
	if ( ! empty( $post_meta_data['REAL_HOMES_property_size_postfix'][0] ) ) {
		$prop_size_postfix = $post_meta_data['REAL_HOMES_property_size_postfix'][0];
		echo '&nbsp;' . esc_html( $prop_size_postfix );
	}
	echo '</span>';
}

if ( ! empty( $post_meta_data['REAL_HOMES_property_bedrooms'][0] ) ) {
	$prop_bedrooms     = floatval( $post_meta_data['REAL_HOMES_property_bedrooms'][0] );
	$bedrooms_label    = ( $prop_bedrooms > 1 ) ? __( 'Bedrooms', 'framework' ) : __( 'Bedroom', 'framework' );
	$cs_bedrooms_label = get_option( 'inspiry_bedrooms_field_label' );

	if ( ! empty( $cs_bedrooms_label ) ) {
		$bedrooms_label = $cs_bedrooms_label;
	}

	echo '<span>';
	include INSPIRY_THEME_DIR . '/images/icon-bed.svg';
	echo esc_html( $prop_bedrooms . '&nbsp;' . $bedrooms_label );
	echo '</span>';
}

if ( ! empty( $post_meta_data['REAL_HOMES_property_bathrooms'][0] ) ) {
	$prop_bathrooms  = floatval( $post_meta_data['REAL_HOMES_property_bathrooms'][0] );
	$bathrooms_label = ( $prop_bathrooms > 1 ) ? __( 'Bathrooms', 'framework' ) : __( 'Bathroom', 'framework' );
	$cs_bathrooms_label = get_option( 'inspiry_bathrooms_field_label' );

	if ( ! empty( $cs_bathrooms_label ) ) {
		$bathrooms_label = $cs_bathrooms_label;
	}

	echo '<span>';
	include INSPIRY_THEME_DIR . '/images/icon-bath.svg';
	echo esc_html( $prop_bathrooms . '&nbsp;' . $bathrooms_label );
	echo '</span>';
}

if ( ! empty( $post_meta_data['REAL_HOMES_property_garage'][0] ) ) {
	$prop_garage  = floatval( $post_meta_data['REAL_HOMES_property_garage'][0] );
	$garage_label = ( $prop_garage > 1 ) ? __( 'Garages', 'framework' ) : __( 'Garage', 'framework' );
	$cs_garage_label = get_option( 'inspiry_garages_field_label' );

	if ( ! empty( $cs_garage_label ) ) {
		$garage_label = $cs_garage_label;
	}

	echo '<span>';
	include INSPIRY_THEME_DIR . '/images/icon-garage.svg';
	echo esc_html( $prop_garage . '&nbsp;' . $garage_label );
	echo '</span>';
}

if ( is_singular( 'property' ) && ! empty( $post_meta_data['REAL_HOMES_property_year_built'][0] ) ) {
	$year_built = intval( $post_meta_data['REAL_HOMES_property_year_built'][0] );
	$year_built_label = __( 'Year Built', 'framework' );
	$cs_year_built_label = get_option( 'inspiry_year_built_field_label' );

	if ( ! empty( $cs_year_built_label ) ) {
		$year_built_label = $cs_year_built_label;
	}

	echo '<span>';
	include INSPIRY_THEME_DIR . '/images/icon-calendar.svg';
	echo esc_html( $year_built . '&nbsp;' . $year_built_label );
	echo '</span>';
}

if ( is_singular( 'property' ) && ! empty( $post_meta_data['REAL_HOMES_property_lot_size'][0] ) ) {
	$lot_size = $post_meta_data['REAL_HOMES_property_lot_size'][0];
	echo '<span title="' . esc_html__( 'Lot Size', 'framework' ) . '">';
	include INSPIRY_THEME_DIR . '/images/icon-lot.svg';
	echo esc_html( $lot_size );
	if ( ! empty( $post_meta_data['REAL_HOMES_property_lot_size_postfix'][0] ) ) {
		$lot_size_postfix = $post_meta_data['REAL_HOMES_property_lot_size_postfix'][0];
		echo '&nbsp;' . esc_html( $lot_size_postfix );
	}
	echo '</span>';
}

/**
 * Custom property fields
 */
if ( is_singular( 'property' ) ) {
	$custom_fields = apply_filters(
		'inspiry_property_custom_fields', array(
			array(
				'tab'    => array(),
				'fields' => array(),
			),
		)
	);

	if ( isset( $custom_fields['fields'] ) && ! empty( $custom_fields['fields'] ) ) {

		$prefix    = 'REAL_HOMES_';
		$icons_dir = INSPIRY_THEME_DIR . '/icons/';
		$icons_uri = INSPIRY_DIR_URI . '/icons/';

		foreach ( $custom_fields['fields'] as $field ) {

			if ( isset( $field['display'] ) && true === $field['display'] ) {

				$meta_key = $prefix . inspiry_backend_safe_string( $field['name'] );

				if ( isset( $post_meta_data[ $meta_key ] ) && ! empty( $post_meta_data[ $meta_key ][0] ) ) {

					$field_label = ( ! empty( $field['postfix'] ) ) ? $field['postfix'] : '';

					echo '<span>';
					if ( file_exists( $icons_dir . $field['icon'] . '.png' ) ) {

						$data_rjs = ( file_exists( $icons_dir . $field['icon'] . '@2x.png' ) ) ? '2' : '';

						echo '<img src="' . esc_url( $icons_uri . $field['icon'] ) . '.png" alt="icon" data-rjs="' . esc_attr( $data_rjs ) . '">';
					}
					echo esc_html( $post_meta_data[ $meta_key ][0] . '&nbsp;' . $field_label );
					echo '</span>';
				}
			}
		}
	}
}

