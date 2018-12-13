<?php
/**
 * Section:	`Search Form Garages`
 * Panel: 	`Properties Search`
 *
 * @package RH
 * @since 3.0.2
 */

if ( ! function_exists( 'inspiry_search_form_garages_customizer' ) ) :

	/**
	 * Search Form Garages Settings.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customizer_Manager.
	 * @since  3.0.2
	 */
	function inspiry_search_form_garages_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Search Form Garages
		 */
		$wp_customize->add_section( 'inspiry_search_form_garages', array(
			'title' => __( 'Search Form Garages', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Min Garages Label */
		$wp_customize->add_setting( 'inspiry_min_garages_label', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default' 			=> __( 'Min Garages', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_min_garages_label', array(
			'label' 	=> __( 'Label for Min Garages Field', 'framework' ),
			'type' 		=> 'text',
			'section' 	=> 'inspiry_search_form_garages',
		) );

		/* Min Garages for Advance Search */
		$wp_customize->add_setting( 'inspiry_min_garages', array(
			'type' 				=> 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' 			=> '1,2,3,4,5,6,7,8,9,10',
		) );
		$wp_customize->add_control( 'inspiry_min_garages', array(
			'label' 		=> __( 'Minimum Garages Values', 'framework' ),
			'description' 	=> __( 'Only provide comma separated numbers.', 'framework' ),
			'type' 			=> 'textarea',
			'section' 		=> 'inspiry_search_form_garages',
		) );

		/* Garages search behaviour */
		$wp_customize->add_setting( 'inspiry_garages_search_behaviour', array(
			'type'    	=> 'option',
			'default'	=> 'min',
		) );
		$wp_customize->add_control( 'inspiry_garages_search_behaviour', array(
			'label'       	=> __( 'Garages Search Behaviour', 'framework' ),
			'description' 	=> __( 'Do you want the search functionality to look for minimum garages, maximum garages or exact equals ?', 'framework' ),
			'type'        	=> 'select',
			'section'     	=> 'inspiry_search_form_garages',
			'choices'     	=> array(
				'min'   	=> __( 'Minimum', 'framework' ),
				'max'   	=> __( 'Maximum', 'framework' ),
				'equal' 	=> __( 'Equal', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_search_form_garages_customizer' );
endif;


if ( ! function_exists( 'inspiry_search_form_garages_defaults' ) ) :

	/**
	 * inspiry_search_form_garages_defaults.
	 *
	 * @since  3.0.2
	 */
	function inspiry_search_form_garages_defaults( WP_Customize_Manager $wp_customize ) {
		$search_form_garages_settings_ids = array(
			'inspiry_min_garages_label',
			'inspiry_min_garages',
			'inspiry_garages_search_behaviour',
		);
		inspiry_initialize_defaults( $wp_customize, $search_form_garages_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_search_form_garages_defaults' );
endif;
