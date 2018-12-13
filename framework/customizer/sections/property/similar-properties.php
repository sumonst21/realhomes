<?php
/**
 * Section:	`Similar Properties`
 * Panel: 	`Property Detail Page`
 *
 * @since 2.6.3
 * @package RH/classic
 */

if ( ! function_exists( 'inspiry_similar_properties_customizer' ) ) :

	/**
	 * inspiry_similar_properties_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_similar_properties_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Similar Properties Section
		 */
		$wp_customize->add_section( 'inspiry_property_similar', array(
			'title' => __( 'Similar Properties', 'framework' ),
			'panel' => 'inspiry_property_panel',
		) );

		/* Show/Hide Similar */
		$wp_customize->add_setting( 'theme_display_similar_properties', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_display_similar_properties', array(
			'label' => __( 'Similar Properties', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_property_similar',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* Similar Properties Title */
		$wp_customize->add_setting( 'theme_similar_properties_title', array(
			'type' 				=> 'option',
			'transport' 		=> 'postMessage',
			'default' 			=> __( 'Similar Properties', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_similar_properties_title', array(
			'label' 	=> __( 'Similar Properties Title', 'framework' ),
			'type' 		=> 'text',
			'section' 	=> 'inspiry_property_similar',
		) );

		/* Similar Properties Title Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$similar_properties_selector = '.detail .list-container h3';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$similar_properties_selector = '.rh_property__similar_properties .rh_property__heading';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_similar_properties_title', array(
				'selector' 				=> $similar_properties_selector,
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_similar_properties_title_render',
			) );
		}

		/* Properties for Similar Properties section */
		$wp_customize->add_setting( 'inspiry_similar_properties', array(
			'type' 		=> 'option',
			'default' 	=> array( 'property-type', 'property-city' ),
			'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes',
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'inspiry_similar_properties',
				array(
					'section' => 'inspiry_property_similar',
					'label'   => __( 'Show similar properties based on', 'framework' ),
					'choices' => array(
						'property-feature' 	=> __( 'Property Features', 'framework' ),
						'property-type'		=> __( 'Property Type', 'framework' ),
						'property-city' 	=> __( 'Property Location', 'framework' ),
						'property-status'	=> __( 'Property Status', 'framework' ),
					),
				)
			)
		);

		/* Properties for Similar Properties section */
		$wp_customize->add_setting( 'inspiry_similar_properties_sorty_by', array(
			'type' 		=> 'option',
			'default' 	=> 'random',
		) );
		$wp_customize->add_control( 'inspiry_similar_properties_sorty_by', array(
			'label' 	=> __( 'Sort Properties By', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_property_similar',
			'choices' 	=> array(
				'recent' 		=> __( 'Time - Recent First', 'framework' ),
				'low-to-high' 	=> __( 'Price - Low to High', 'framework' ),
				'high-to-low'	=> __( 'Price - High to Low', 'framework' ),
				'random' 		=> __( 'Random', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_similar_properties_customizer' );
endif;


if ( ! function_exists( 'inspiry_similar_properties_defaults' ) ) :

	/**
	 * inspiry_similar_properties_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_similar_properties_defaults( WP_Customize_Manager $wp_customize ) {
		$similar_properties_settings_ids = array(
			'theme_display_similar_properties',
			'theme_similar_properties_title',
			'inspiry_similar_properties',
			'inspiry_similar_properties_sorty_by',
		);
		inspiry_initialize_defaults( $wp_customize, $similar_properties_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_similar_properties_defaults' );
endif;


if ( ! function_exists( 'inspiry_similar_properties_title_render' ) ) {
	function inspiry_similar_properties_title_render() {
		if ( get_option( 'theme_similar_properties_title' ) ) {
			echo esc_html( get_option( 'theme_similar_properties_title' ) );
		}
	}
}
