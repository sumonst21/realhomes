<?php
/**
 * Section:	`Search Form Locations`
 * Panel: 	`Properties Search`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_search_form_locations_customizer' ) ) :

	/**
	 * inspiry_search_form_locations_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_search_form_locations_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Search Form Locations
		 */
		$wp_customize->add_section( 'inspiry_search_form_locations', array(
			'title' => __( 'Search Form Locations', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Number of Location Boxes */
		$wp_customize->add_setting( 'theme_location_select_number', array(
			'type' 		=> 'option',
			'default' 	=> '1',
		) );
		$wp_customize->add_control( 'theme_location_select_number', array(
			'label' 		=> __( 'Number of Location Select Boxes', 'framework' ),
			'description' 	=> __( 'In case of 1 location box, all locations will be listed in that select box. In case of 2 or more, Each select box will list parent locations of a level that matches its number and all the remaining children locations will be listed in last select box.', 'framework' ),
			'type' 			=> 'select',
			'section' 		=> 'inspiry_search_form_locations',
			'choices' 		=> array(
				'1' 		=> 1,
				'2' 		=> 2,
				'3' 		=> 3,
				'4' 		=> 4,
			),
		) );

		/* 1st Location Box Title */
		$wp_customize->add_setting( 'theme_location_title_1', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_location_title_1', array(
			'label' 		=> __( 'Title for 1st Location Select Box', 'framework' ),
			'description' 	=> __( 'Example: Country', 'framework' ),
			'type' 			=> 'text',
			'section' 		=> 'inspiry_search_form_locations',
		) );

		/* 2nd Location Box Title */
		$wp_customize->add_setting( 'theme_location_title_2', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_location_title_2', array(
			'label' 		=> __( 'Title for 2nd Location Select Box', 'framework' ),
			'description' 	=> __( 'Example: State', 'framework' ),
			'type' 			=> 'text',
			'section' 		=> 'inspiry_search_form_locations',
		) );

		/* 3rd Location Box Title */
		$wp_customize->add_setting( 'theme_location_title_3', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_location_title_3', array(
			'label' 		=> __( 'Title for 3rd Location Select Box', 'framework' ),
			'description' 	=> __( 'Example: City', 'framework' ),
			'type' 			=> 'text',
			'section' 		=> 'inspiry_search_form_locations',
		) );

		/* 4th Location Box Title */
		$wp_customize->add_setting( 'theme_location_title_4', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_location_title_4', array(
			'label' 		=> __( 'Title for 4th Location Select Box', 'framework' ),
			'description' 	=> __( 'Example: Area', 'framework' ),
			'type' 			=> 'text',
			'section' 		=> 'inspiry_search_form_locations',
		) );

		/* Hide Empty Locations */
		$wp_customize->add_setting( 'inspiry_hide_empty_locations', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
		) );
		$wp_customize->add_control( 'inspiry_hide_empty_locations', array(
			'label' 		=> __( 'Hide Empty Locations ?', 'framework' ),
			'description' 	=> __( 'Optimize Locations by hiding the ones with zero property.', 'framework' ),
			'type' 			=> 'radio',
			'section' 		=> 'inspiry_search_form_locations',
			'choices' 		=> array(
				'true' 		=> __( 'Yes', 'framework' ),
				'false' 	=> __( 'No', 'framework' ),
			),
		) );

		/* Sort Locations */
		$wp_customize->add_setting( 'theme_locations_order', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
		) );
		$wp_customize->add_control( 'theme_locations_order', array(
			'label' 	=> __( 'Sort Locations Alphabetically ?', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_search_form_locations',
			'choices' 	=> array(
				'true' 	=> __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_search_form_locations_customizer' );
endif;


if ( ! function_exists( 'inspiry_search_form_locations_defaults' ) ) :

	/**
	 * inspiry_search_form_locations_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_search_form_locations_defaults( WP_Customize_Manager $wp_customize ) {
		$search_form_locations_settings_ids = array(
			'theme_location_select_number',
			'inspiry_hide_empty_locations',
			'theme_locations_order',
		);
		inspiry_initialize_defaults( $wp_customize, $search_form_locations_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_search_form_locations_defaults' );
endif;
