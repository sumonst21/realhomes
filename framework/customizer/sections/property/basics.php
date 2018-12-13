<?php
/**
 * Section: `Basics`
 * Panel:   `Property Detail Page`
 *
 * @package RH
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_property_basics_customizer' ) ) :

	/**
	 * inspiry_property_basics_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_property_basics_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Basics Section
		 */
		$wp_customize->add_section(
			'inspiry_property_basics', array(
				'title' => __( 'Basics', 'framework' ),
				'panel' => 'inspiry_property_panel',
			)
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting(
				'inspiry_property_detail_header_variation', array(
					'type'      => 'option',
					'default'   => 'banner',
				)
			);

			$wp_customize->add_control(
				'inspiry_property_detail_header_variation', array(
					'label'     => __( 'Header Variation', 'framework' ),
					'description' => __( 'Header variation to display on Property Detail Page.', 'framework' ),
					'type'      => 'radio',
					'section'   => 'inspiry_property_basics',
					'choices'   => array(
						'banner'    => __( 'Banner', 'framework' ),
						'none'      => __( 'None', 'framework' ),
					),
				)
			);
		}

		/* property detail variation */
		$wp_customize->add_setting(
			'theme_property_detail_variation', array(
				'type' => 'option',
				'default' => 'default',
			)
		);
		$wp_customize->add_control(
			'theme_property_detail_variation', array(
				'label' => __( 'Property Detail Page Layout Variation ?', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'default' => __( 'Agent info below Google Map', 'framework' ),
					'agent-in-sidebar' => __( 'Agent info in Sidebar', 'framework' ),
				),
			)
		);

		/* Display Property Address */
		$wp_customize->add_setting(
			'inspiry_display_property_address', array(
				'type' => 'option',
				'default' => 'true',
			)
		);
		$wp_customize->add_control(
			'inspiry_display_property_address', array(
				'label' => __( 'Property Address', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true' => __( 'Show', 'framework' ),
					'false' => __( 'Hide', 'framework' ),
				),
			)
		);

		/* Display Image Title in Lightbox */
		$wp_customize->add_setting(
			'inspiry_display_title_in_lightbox', array(
				'type' => 'option',
				'default' => 'false',
			)
		);
		$wp_customize->add_control(
			'inspiry_display_title_in_lightbox', array(
				'label' => __( 'Image title in gallery lightbox.', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true' => __( 'Show', 'framework' ),
					'false' => __( 'Hide', 'framework' ),
				),
			)
		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_property_field_titles_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_property_field_titles_separator',
				array(
					'section' 	=> 'inspiry_property_basics',
				)
			)
		);

		/* Bedrooms Field Title  */
		$wp_customize->add_setting(
			'inspiry_bedrooms_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_bedrooms_field_label', array(
				'label'         => esc_html__( 'Bedrooms field label', 'framework' ),
				'description'   => esc_html__( 'This will overwrite the bedrooms field label.', 'framework' ),
				'type'          => 'text',
				'section'       => 'inspiry_property_basics',
			)
		);

		/* Bathrooms Field Title  */
		$wp_customize->add_setting(
			'inspiry_bathrooms_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_bathrooms_field_label', array(
				'label'         => esc_html__( 'Bathrooms field label', 'framework' ),
				'description'   => esc_html__( 'This will overwrite the bathrooms field label.', 'framework' ),
				'type'          => 'text',
				'section'       => 'inspiry_property_basics',
			)
		);

		/* Garages Field Title  */
		$wp_customize->add_setting(
			'inspiry_garages_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_garages_field_label', array(
				'label'         => esc_html__( 'Garages field label', 'framework' ),
				'description'   => esc_html__( 'This will overwrite the garages field label.', 'framework' ),
				'type'          => 'text',
				'section'       => 'inspiry_property_basics',
			)
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Area Field Title  */
			$wp_customize->add_setting(
				'inspiry_area_field_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_area_field_label', array(
					'label'       => esc_html__( 'Area field label', 'framework' ),
					'description' => esc_html__( 'This will overwrite the area field label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);
		}

		/* Year Built Field Title  */
		$wp_customize->add_setting(
			'inspiry_year_built_field_label', array(
				'type'              => 'option',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'inspiry_year_built_field_label', array(
				'label'         => esc_html__( 'Year Built field label', 'framework' ),
				'description'   => esc_html__( 'This will overwrite the year-built field label.', 'framework' ),
				'type'          => 'text',
				'section'       => 'inspiry_property_basics',
			)
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Lot Size Field Title  */
			$wp_customize->add_setting(
				'inspiry_lot_size_field_label', array(
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'inspiry_lot_size_field_label', array(
					'label'       => esc_html__( 'Lot Size field label', 'framework' ),
					'description' => esc_html__( 'This will overwrite the lot-size field label.', 'framework' ),
					'type'        => 'text',
					'section'     => 'inspiry_property_basics',
				)
			);
		}

		/* Separator */
		$wp_customize->add_setting( 'theme_additional_details_title_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'theme_additional_details_title_separator',
				array(
					'section' 	=> 'inspiry_property_basics',
				)
			)
		);


		/* Additional Detail Title  */
		$wp_customize->add_setting(
			'theme_additional_details_title', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'default'           => __( 'Additional Details', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_additional_details_title', array(
				'label'         => __( 'Additional Details Title', 'framework' ),
				'description'   => __( 'This will only display if a property has additional details.', 'framework' ),
				'type'          => 'text',
				'section'       => 'inspiry_property_basics',
			)
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'theme_additional_details_title', array(
						'selector'              => '.rh_property__additional_details',
						'container_inclusive'   => false,
						'render_callback'       => 'theme_additional_details_title_render',
					)
				);
			}
		}

		/* Features Title  */
		$wp_customize->add_setting(
			'theme_property_features_title', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'default'           => __( 'Features', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_property_features_title', array(
				'label'     => __( 'Features Title', 'framework' ),
				'type'      => 'text',
				'section'   => 'inspiry_property_basics',
			)
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'theme_property_features_title', array(
						'selector'              => '.rh_property__features_wrap .rh_property__heading',
						'container_inclusive'   => false,
						'render_callback'       => 'theme_property_features_title_render',
					)
				);
			}
		}

		/* Show/Hide Social Share */
		$wp_customize->add_setting(
			'theme_display_social_share', array(
				'type' => 'option',
				'default' => 'true',
			)
		);
		$wp_customize->add_control(
			'theme_display_social_share', array(
				'label' => __( 'Social Share Icons', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true' => __( 'Show', 'framework' ),
					'false' => __( 'Hide', 'framework' ),
				),
			)
		);

		/* Child Properties Title  */
		$wp_customize->add_setting(
			'theme_child_properties_title', array(
				'type'              => 'option',
				'transport'         => 'postMessage',
				'default'           => __( 'Sub Properties', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_child_properties_title', array(
				'label'         => __( 'Child Properties Title', 'framework' ),
				'description'   => __( 'This will only display if a property has child properties.', 'framework' ),
				'type'          => 'text',
				'section'       => 'inspiry_property_basics',
			)
		);

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'theme_child_properties_title', array(
						'selector'              => '.rh_property__child_properties .rh_property__heading',
						'container_inclusive'   => false,
						'render_callback'       => 'theme_child_properties_title_render',
					)
				);
			}
		}

		/* Add/Remove  Open Graph Meta Tags */
		$wp_customize->add_setting(
			'theme_add_meta_tags', array(
				'type' => 'option',
				'default' => 'false',
			)
		);
		$wp_customize->add_control(
			'theme_add_meta_tags', array(
				'label' => __( 'Open Graph Meta Tags', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true' => __( 'Enable', 'framework' ),
					'false' => __( 'Disable', 'framework' ),
				),
			)
		);

		/* Link to Previous and Next Property */
		$wp_customize->add_setting(
			'inspiry_property_prev_next_link', array(
				'type' => 'option',
				'default' => 'true',
			)
		);
		$wp_customize->add_control(
			'inspiry_property_prev_next_link', array(
				'label' => __( 'Link to Previous and Next Property', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true' => __( 'Enable', 'framework' ),
					'false' => __( 'Disable', 'framework' ),
				),
			)
		);

		/* Property Ratings */
		$wp_customize->add_setting(
			'inspiry_property_ratings', array(
				'type' => 'option',
				'default' => 'false',
			)
		);
		$wp_customize->add_control(
			'inspiry_property_ratings', array(
				'label' => __( 'Property Ratings', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_property_basics',
				'choices' => array(
					'true' => __( 'Enable', 'framework' ),
					'false' => __( 'Disable', 'framework' ),
				),
			)
		);

	}

	add_action( 'customize_register', 'inspiry_property_basics_customizer' );
endif;


if ( ! function_exists( 'inspiry_property_basics_defaults' ) ) :

	/**
	 * inspiry_property_basics_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_property_basics_defaults( WP_Customize_Manager $wp_customize ) {
		$property_basics_settings_ids = array(
			'inspiry_property_detail_header_variation',
			'theme_property_detail_variation',
			'inspiry_display_title_in_lightbox',
			'theme_additional_details_title',
			'theme_property_features_title',
			'theme_display_social_share',
			'theme_child_properties_title',
			'theme_add_meta_tags',
			'inspiry_property_prev_next_link',
			'inspiry_property_ratings',
		);
		inspiry_initialize_defaults( $wp_customize, $property_basics_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_property_basics_defaults' );
endif;

if ( ! function_exists( 'theme_additional_details_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function theme_additional_details_title_render() {
		if ( get_option( 'theme_additional_details_title' ) ) {
			echo esc_html( get_option( 'theme_additional_details_title' ) );
		}
	}
}

if ( ! function_exists( 'theme_property_features_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function theme_property_features_title_render() {
		if ( get_option( 'theme_property_features_title' ) ) {
			echo esc_html( get_option( 'theme_property_features_title' ) );
		}
	}
}

if ( ! function_exists( 'theme_child_properties_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function theme_child_properties_title_render() {
		if ( get_option( 'theme_child_properties_title' ) ) {
			echo esc_html( get_option( 'theme_child_properties_title' ) );
		}
	}
}
