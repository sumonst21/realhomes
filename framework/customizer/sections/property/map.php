<?php
/**
 * Section:	`Map`
 * Panel: 	`Property Detail Page`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_property_map_customizer' ) ) :

	/**
	 * inspiry_property_map_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_property_map_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Map Section
		 */

		$wp_customize->add_section( 'inspiry_property_map', array(
			'title' => __( 'Map', 'framework' ),
			'panel' => 'inspiry_property_panel',
		) );

		/* Show/Hide Map */
		$wp_customize->add_setting( 'theme_display_google_map', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_display_google_map', array(
			'label' => __( 'Google Map', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_property_map',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* Map Title */
		$wp_customize->add_setting( 'theme_property_map_title', array(
			'type' 				=> 'option',
			'transport' 		=> 'postMessage',
			'default' 			=> __( 'Property on Map', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_property_map_title', array(
			'label' 	=> __( 'Property Map Title', 'framework' ),
			'type' 		=> 'text',
			'section' 	=> 'inspiry_property_map',
		) );

		/* Video Title Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$map_title_selector = '.map-wrap .map-label';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$map_title_selector = '.rh_property__map_wrap .rh_property__heading';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_property_map_title', array(
				'selector' 				=> $map_title_selector,
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_property_map_title_render',
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_property_map_customizer' );
endif;


if ( ! function_exists( 'inspiry_property_map_defaults' ) ) :

	/**
	 * inspiry_property_map_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_property_map_defaults( WP_Customize_Manager $wp_customize ) {
		$property_map_settings_ids = array(
			'theme_display_google_map',
			'theme_property_map_title',
		);
		inspiry_initialize_defaults( $wp_customize, $property_map_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_property_map_defaults' );
endif;


if ( ! function_exists( 'inspiry_property_map_title_render' ) ) {
	function inspiry_property_map_title_render() {
		if ( get_option( 'theme_property_map_title' ) ) {
			echo get_option( 'theme_property_map_title' );
		}
	}
}
