<?php
/**
 * URL Slugs Customizer
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_url_slugs_customizer' ) ) :
	function inspiry_url_slugs_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * URL Slugs Section
		 */
		$wp_customize->add_section( 'inspiry_url_slugs_section', array(
			'title' => __( 'URL Slugs', 'framework' ),
			'priority' => 132,
		) );

		/* URL Slug Intro */
		$wp_customize->add_setting( 'inspiry_url_slug_intro', array() );
		$wp_customize->add_control(
			new Inspiry_Intro_Customize_Control(
				$wp_customize,
				'inspiry_url_slug_intro',
				array(
					'section' => 'inspiry_url_slugs_section',
					'label' => esc_html__( 'Important Note for URL Slugs', 'framework' ),
					'description' => esc_html__( 'Make sure to re-save permalinks settings after every change in URL slugs to avoid 404 errors. You can do this from Settings > Permalinks', 'framework' ),
				)
			)
		);

		// $slug_change_description = __( 'Provide characters without spaces.', 'framework' );
		$slug_change_description = null;

		/* Property Slug  */
		$wp_customize->add_setting( 'inspiry_property_slug', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'default' => __( 'property', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_slug', array(
			'label' => __( 'Property Slug', 'framework' ),
			'description' => $slug_change_description,
			'type' => 'text',
			'section' => 'inspiry_url_slugs_section',
		) );

		/* Agent Slug  */
		$wp_customize->add_setting( 'inspiry_agent_slug', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'default' => __( 'agent', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_agent_slug', array(
			'label' => __( 'Agent Slug', 'framework' ),
			'description' => $slug_change_description,
			'type' => 'text',
			'section' => 'inspiry_url_slugs_section',
		) );

		/* Agency Slug  */
		$wp_customize->add_setting( 'inspiry_agency_slug', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'agency', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_agency_slug', array(
			'label'       => esc_html__( 'Agency Slug', 'framework' ),
			'description' => $slug_change_description,
			'type'        => 'text',
			'section'     => 'inspiry_url_slugs_section',
		) );

		/* Property City Slug  */
		$wp_customize->add_setting( 'inspiry_property_city_slug', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'default' => __( 'property-city', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_city_slug', array(
			'label' => __( 'Property City Slug', 'framework' ),
			'description' => $slug_change_description,
			'type' => 'text',
			'section' => 'inspiry_url_slugs_section',
		) );

		/* Property Status Slug  */
		$wp_customize->add_setting( 'inspiry_property_status_slug', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'default' => __( 'property-status', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_status_slug', array(
			'label' => __( 'Property Status Slug', 'framework' ),
			'description' => $slug_change_description,
			'type' => 'text',
			'section' => 'inspiry_url_slugs_section',
		) );

		/* Property Type Slug  */
		$wp_customize->add_setting( 'inspiry_property_type_slug', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'default' => __( 'property-type', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_type_slug', array(
			'label' => __( 'Property Type Slug', 'framework' ),
			'description' => $slug_change_description,
			'type' => 'text',
			'section' => 'inspiry_url_slugs_section',
		) );

		/* Property Feature Slug  */
		$wp_customize->add_setting( 'inspiry_property_feature_slug', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'default' => __( 'property-feature', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_feature_slug', array(
			'label' => __( 'Property Feature Slug', 'framework' ),
			'description' => $slug_change_description,
			'type' => 'text',
			'section' => 'inspiry_url_slugs_section',
		) );

	}

	add_action( 'customize_register', 'inspiry_url_slugs_customizer' );
endif;


if ( ! function_exists( 'inspiry_url_slugs_defaults' ) ) :
	/**
	 * Set default values for url slugs settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_url_slugs_defaults( WP_Customize_Manager $wp_customize ) {
		$news_settings_ids = array(
			'inspiry_property_slug',
			'inspiry_agent_slug',
			'inspiry_property_city_slug',
			'inspiry_property_status_slug',
			'inspiry_property_type_slug',
			'inspiry_property_feature_slug',
		);
		inspiry_initialize_defaults( $wp_customize, $news_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_url_slugs_defaults' );
endif;
