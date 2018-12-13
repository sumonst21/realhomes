<?php
/**
 * Section:	`Home Properties`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 * @package RH
 */

if ( ! function_exists( 'inspiry_home_properties_customizer' ) ) :

	/**
	 * Home section settings.
	 *
	 * @param  object $wp_customize - Instance of WP_Customize_Manager.
	 * @since  2.6.3
	 */
	function inspiry_home_properties_customizer( WP_Customize_Manager $wp_customize ) {

		/* Access the property-city terms via an Array */
		$cities_array = array();
		$city_terms = get_terms( 'property-city' );
		foreach ( $city_terms as $city_term ) {
			$cities_array[ $city_term->slug ] = $city_term->name;
		}

		/* Access the property-status terms via an Array */
		$statuses_array = array();
		$status_terms = get_terms( 'property-status' );
		foreach ( $status_terms as $status_term ) {
			$statuses_array[ $status_term->slug ] = $status_term->name;
		}

		/* Access the property-type terms via an Array */
		$types_array = array();
		$type_terms = get_terms( 'property-type' );
		foreach ( $type_terms as $type_term ) {
			$types_array[ $type_term->slug ] = $type_term->name;
		}

		/**
		 * Home Properties Section
		 */
		$wp_customize->add_section( 'inspiry_home_properties', array(
			'title' => __( 'Home Properties', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* Show or Hide Properties on Homepage */
			$wp_customize->add_setting( 'theme_show_home_properties', array(
				'type' 		=> 'option',
				'default' 	=> 'true',
			) );
			$wp_customize->add_control( 'theme_show_home_properties', array(
				'label' 	=> __( 'Show or Hide Slogan + Properties on Homepage ?', 'framework' ),
				'type' 		=> 'radio',
				'section' 	=> 'inspiry_home_properties',
				'choices' 	=> array(
					'true' 	=> __( 'Show', 'framework' ),
					'false'	=> __( 'Hide', 'framework' ),
				),
			) );
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Show or Hide Properties on Homepage */
			$wp_customize->add_setting( 'theme_show_home_properties', array(
				'type' 		=> 'option',
				'default' 	=> 'true',
			) );
			$wp_customize->add_control( 'theme_show_home_properties', array(
				'label' 	=> esc_html__( 'Latest Properties on Homepage', 'framework' ),
				'type' 		=> 'radio',
				'section' 	=> 'inspiry_home_properties',
				'choices' 	=> array(
					'true' 	=> esc_html__( 'Show', 'framework' ),
					'false'	=> esc_html__( 'Hide', 'framework' ),
				),
			) );

			// Section Text Over Title.
			$wp_customize->add_setting( 'inspiry_home_properties_sub_title', array(
				'type' 				=> 'option',
				'transport'			=> 'postMessage',
				'default'			=> esc_html__( 'Latest', 'framework' ),
				'sanitize_callback'	=> 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_home_properties_sub_title', array(
				'label' 	=> __( 'Text Over Title', 'framework' ),
				'type' 		=> 'text',
				'section'	=> 'inspiry_home_properties',
			) );

			// Partial Refresh.
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'inspiry_home_properties_sub_title', array(
					'selector' 				=> '.home .rh_section--props_padding .rh_section__subtitle',
					'container_inclusive'	=> false,
					'render_callback' 		=> 'inspiry_home_properties_sub_title_render',
				) );
			}

			// Section Title.
			$wp_customize->add_setting( 'inspiry_home_properties_title', array(
				'type' 				=> 'option',
				'transport'			=> 'postMessage',
				'default'			=> esc_html__( 'Properties', 'framework' ),
				'sanitize_callback'	=> 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'inspiry_home_properties_title', array(
				'label' 	=> __( 'Section Title', 'framework' ),
				'type' 		=> 'text',
				'section'	=> 'inspiry_home_properties',
			) );

			// Partial Refresh.
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'inspiry_home_properties_title', array(
					'selector' 				=> '.home .rh_section--props_padding .rh_section__title',
					'container_inclusive'	=> false,
					'render_callback' 		=> 'inspiry_home_properties_title_render',
				) );
			}

			// Section Description.
			$wp_customize->add_setting( 'inspiry_home_properties_desc', array(
				'type' 				=> 'option',
				'transport'			=> 'postMessage',
				'default'			=> esc_html__( 'Some amazing features of Real Homes theme.', 'framework' ),
				'sanitize_callback' => 'wp_kses_data',
			) );
			$wp_customize->add_control( 'inspiry_home_properties_desc', array(
				'label' 	=> __( 'Section Description', 'framework' ),
				'type' 		=> 'textarea',
				'section' 	=> 'inspiry_home_properties',
			) );

			// Partial Refresh.
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'inspiry_home_properties_desc', array(
					'selector' 				=> '.home .rh_section--props_padding .rh_section__desc',
					'container_inclusive'	=> false,
					'render_callback' 		=> 'inspiry_home_properties_desc_render',
				) );
			}
		}

		/* Properties on Homepage */
		$wp_customize->add_setting( 'theme_home_properties', array(
			'type' 		=> 'option',
			'default' 	=> 'recent',
		) );
		$wp_customize->add_control( 'theme_home_properties', array(
			'label' 	=> __( 'What Kind of Properties You Want to Display on Homepage ?', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_properties',
			'choices' 	=> array(
				'recent' 				=> __( 'Recent Properties', 'framework' ),
				'featured' 				=> __( 'Featured Properties', 'framework' ),
				'based-on-selection'	=> __( 'Properties Based on Selected Locations, Statuses and Types from Below', 'framework' ),
			),
		) );

		/* Property Locations */
		$wp_customize->add_setting( 'theme_cities_for_homepage', array(
			'type' 				=> 'option',
			'default' 			=> array(),
			'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes',
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'theme_cities_for_homepage',
				array(
					'section' 			=> 'inspiry_home_properties',
					'label' 			=> __( 'Select Property Locations', 'framework' ),
					'choices' 			=> $cities_array,
					'active_callback'	=> 'inspiry_selection_based_home_properties',
				)
			)
		);

		/* Property Statuses */
		$wp_customize->add_setting( 'theme_statuses_for_homepage', array(
			'type' 				=> 'option',
			'default' 			=> array(),
			'sanitize_callback'	=> 'inspiry_sanitize_multiple_checkboxes',
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'theme_statuses_for_homepage',
				array(
					'section' 			=> 'inspiry_home_properties',
					'label' 			=> __( 'Select Property Statuses', 'framework' ),
					'choices' 			=> $statuses_array,
					'active_callback'	=> 'inspiry_selection_based_home_properties',
				)
			)
		);

		/* Property Types */
		$wp_customize->add_setting( 'theme_types_for_homepage', array(
			'type' 					=> 'option',
			'default' 				=> array(),
			'sanitize_callback' 	=> 'inspiry_sanitize_multiple_checkboxes',
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'theme_types_for_homepage',
				array(
					'section' 			=> 'inspiry_home_properties',
					'label' 			=> __( 'Select Property Types', 'framework' ),
					'choices' 			=> $types_array,
					'active_callback'	=> 'inspiry_selection_based_home_properties',
				)
			)
		);

		/* Properties on Homepage */
		$wp_customize->add_setting( 'theme_sorty_by', array(
			'type' 		=> 'option',
			'default' 	=> 'recent',
		) );
		$wp_customize->add_control( 'theme_sorty_by', array(
			'label' 	=> __( 'Sort Properties By', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_properties',
			'choices' 	=> array(
				'recent' 		=> __( 'Time - Recent First', 'framework' ),
				'low-to-high' 	=> __( 'Price - Low to High', 'framework' ),
				'high-to-low'	=> __( 'Price - High to Low', 'framework' ),
				'random' 		=> __( 'Random', 'framework' ),
			),
		) );

		/* Number of Properties To Display on Home Page */
		$wp_customize->add_setting( 'theme_properties_on_home', array(
			'type' 		=> 'option',
			'default' 	=> '4',
		) );
		$wp_customize->add_control( 'theme_properties_on_home', array(
			'label' 	=> __( 'Number of Properties on Each Page', 'framework' ),
			'type' 		=> 'select',
			'section' 	=> 'inspiry_home_properties',
			'choices'	=> array(
				'1' 	=> 1,
				'2' 	=> 2,
				'3' 	=> 3,
				'4' 	=> 4,
				'5' 	=> 5,
				'6' 	=> 6,
				'7' 	=> 7,
				'8' 	=> 8,
				'9' 	=> 9,
				'10' 	=> 10,
				'11' 	=> 11,
				'12' 	=> 12,
				'13' 	=> 13,
				'14' 	=> 14,
				'15' 	=> 15,
				'16' 	=> 16,
				'17' 	=> 17,
				'18' 	=> 18,
				'19' 	=> 19,
				'20' 	=> 20,
			),
		) );

		// Skip Sticky Properties Option.
		$wp_customize->add_setting( 'inspiry_home_skip_sticky', array(
			'type'		=> 'option',
			'default'	=> false,
		) );
		$wp_customize->add_control( 'inspiry_home_skip_sticky', array(
			'label' 	=> __( 'Skip Sticky Properties','framework' ),
			'description' => __( 'Check to skip sticky properties on home page.','framework' ),
			'section' 	=> 'inspiry_home_properties',
			'type'      => 'checkbox',
		) );

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* AJAX Pagination */
			$wp_customize->add_setting( 'theme_ajax_pagination_home', array(
				'type' 		=> 'option',
				'default'	=> 'true',
			) );
			$wp_customize->add_control( 'theme_ajax_pagination_home', array(
				'label' 	=> __( 'AJAX Pagination', 'framework' ),
				'type' 		=> 'radio',
				'section' 	=> 'inspiry_home_properties',
				'choices' 	=> array(
					'true' 	=> 'Enable',
					'false'	=> 'Disable',
				),
			) );
		}

//		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
//			/* Separator */
//			$wp_customize->add_setting( 'inspiry_home_properties_title_separator', array() );
//			$wp_customize->add_control(
//				new Inspiry_Separator_Control(
//					$wp_customize,
//					'inspiry_home_properties_title_separator',
//					array(
//						'section' 	=> 'inspiry_home_properties',
//					)
//				)
//			);
//
//			/* Section Title Color */
//			$wp_customize->add_setting( 'inspiry_home_properties_title_span_color', array(
//				'type' 		=> 'option',
////				'default'	=> '#1ea69a',
//				'sanitize_callback' => 'sanitize_hex_color',
//			) );
//			$wp_customize->add_control(
//				new WP_Customize_Color_Control(
//					$wp_customize,
//					'inspiry_home_properties_title_span_color',
//					array(
//						'label'       => esc_html__( 'Text Over Title Color', 'framework' ),
//						'section'     => 'inspiry_home_properties',
//						'description' => esc_html__( 'Default color is #1ea69a', 'framework' ),
//					)
//				)
//			);
//
//			/* Section Title Color */
//			$wp_customize->add_setting( 'inspiry_home_properties_title_color', array(
//				'type' 		=> 'option',
//				'default'	=> '#1a1a1a',
//				'sanitize_callback' => 'sanitize_hex_color',
//			) );
//			$wp_customize->add_control(
//				new WP_Customize_Color_Control(
//					$wp_customize,
//					'inspiry_home_properties_title_color',
//					array(
//						'label' 	=> esc_html__( 'Section Title Color', 'framework' ),
//						'section'	=> 'inspiry_home_properties',
//					)
//				)
//			);
//
//			/* Section Description Color */
//			$wp_customize->add_setting( 'inspiry_home_properties_desc_color', array(
//				'type' 		=> 'option',
//				'default'	=> '#808080',
//				'sanitize_callback' => 'sanitize_hex_color',
//			) );
//			$wp_customize->add_control(
//				new WP_Customize_Color_Control(
//					$wp_customize,
//					'inspiry_home_properties_desc_color',
//					array(
//						'label' 	=> esc_html__( 'Section Description Color', 'framework' ),
//						'section'	=> 'inspiry_home_properties',
//					)
//				)
//			);
//		}

	}

	add_action( 'customize_register', 'inspiry_home_properties_customizer' );
endif;


if ( ! function_exists( 'inspiry_home_properties_defaults' ) ) :

	/**
	 * Section default options.
	 *
	 * @param object $wp_customize - instance of WP_Customize_Manager.
	 * @since  2.6.3
	 */
	function inspiry_home_properties_defaults( WP_Customize_Manager $wp_customize ) {
		$home_properties_settings_ids = array(
			'inspiry_home_properties_title',
			'inspiry_home_properties_desc',
			'theme_show_home_properties',
			'theme_home_properties',
			'theme_cities_for_homepage',
			'theme_statuses_for_homepage',
			'theme_types_for_homepage',
			'theme_sorty_by',
			'theme_properties_on_home',
			'theme_ajax_pagination_home',
		);
		inspiry_initialize_defaults( $wp_customize, $home_properties_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_home_properties_defaults' );
endif;


if ( ! function_exists( 'inspiry_home_properties_sub_title_render' ) ) {

	/**
	 * Renders title for home properties section.
	 */
	function inspiry_home_properties_sub_title_render() {
		if ( get_option( 'inspiry_home_properties_sub_title' ) && ( 'modern' === INSPIRY_DESIGN_VARIATION ) ) {
			$subtitle = get_option( 'inspiry_home_properties_sub_title' );
			if ( ! empty( $subtitle ) ) {
				echo esc_html( $subtitle );
			}
		}
	}
}


if ( ! function_exists( 'inspiry_home_properties_title_render' ) ) {

	/**
	 * Renders title for home properties section.
	 */
	function inspiry_home_properties_title_render() {
		if ( get_option( 'inspiry_home_properties_title' ) && ( 'modern' === INSPIRY_DESIGN_VARIATION ) ) {
			$title = get_option( 'inspiry_home_properties_title' );
			if ( ! empty( $title ) ) {
				echo esc_html( $title );
			}
		}
	}
}


if ( ! function_exists( 'inspiry_home_properties_desc_render' ) ) {

	/**
	 * Renders description for home properties section.
	 */
	function inspiry_home_properties_desc_render() {
		if ( get_option( 'inspiry_home_properties_desc' ) ) {
			echo esc_html( get_option( 'inspiry_home_properties_desc' ) );
		}
	}
}


if ( ! function_exists( 'inspiry_selection_based_home_properties' ) ) {
	/**
	 * Checks if home properties are based on selection
	 *
	 * @return boolean
	 */
	function inspiry_selection_based_home_properties() {
		$theme_home_properties = get_option( 'theme_home_properties' );
		if ( 'based-on-selection' === $theme_home_properties ) {
			return true;
		}
		return false;
	}
}
