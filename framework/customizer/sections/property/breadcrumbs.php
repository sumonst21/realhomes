<?php
/**
 * Section:	`Breadcrumbs`
 * Panel: 	`Property Detail Page`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_property_breadcrumbs_customizer' ) ) :

	/**
	 * inspiry_property_breadcrumbs_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */

	function inspiry_property_breadcrumbs_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Breadcrumbs Section
		 */
		$wp_customize->add_section( 'inspiry_property_breadcrumbs', array(
			'title' => __( 'Breadcrumbs', 'framework' ),
			'panel' => 'inspiry_property_panel',
		) );

		/* Show/Hide Breadcrumbs */
		$wp_customize->add_setting( 'theme_display_property_breadcrumbs', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_display_property_breadcrumbs', array(
			'label' => __( 'Property Breadcrumbs', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_property_breadcrumbs',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* property breadcrumbs taxonomy */
		$wp_customize->add_setting( 'theme_breadcrumbs_taxonomy', array(
			'type' 		=> 'option',
			'default' 	=> 'property-city',
		) );
		$wp_customize->add_control( 'theme_breadcrumbs_taxonomy', array(
			'label' 	=> __( 'Breadcrumbs will be based on', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_property_breadcrumbs',
			'choices'	=> array(
				'property-city' 	=> __( 'Property City', 'framework' ),
				'property-type' 	=> __( 'Property Type', 'framework' ),
				'property-status' 	=> __( 'Property Status', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_property_breadcrumbs_customizer' );
endif;


if ( ! function_exists( 'inspiry_property_breadcrumbs_defaults' ) ) :

	/**
	 * inspiry_property_breadcrumbs_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_property_breadcrumbs_defaults( WP_Customize_Manager $wp_customize ) {
		$property_breadcrumbs_settings_ids = array(
			'theme_display_property_breadcrumbs',
			'theme_breadcrumbs_taxonomy',
		);
		inspiry_initialize_defaults( $wp_customize, $property_breadcrumbs_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_property_breadcrumbs_defaults' );
endif;
