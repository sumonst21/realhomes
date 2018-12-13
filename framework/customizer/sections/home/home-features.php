<?php
/**
 * Section: Features
 *
 * Home features section settings.
 *
 * @since 	3.0.0
 * @package RH
 */

if ( ! function_exists( 'inspiry_home_features_customizer' ) ) :

	/**
	 * Function to register customizer options
	 * for home features section
	 *
	 * @param object $wp_customize - Object of WP_Customize_Manager.
	 * @since 3.0.0
	 */
	function inspiry_home_features_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Slogan Section
		 */
		$wp_customize->add_section( 'inspiry_home_features', array(
			'title' => __( 'Features', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Show/Hide Features Section on Homepage */
		$wp_customize->add_setting( 'inspiry_show_home_features', array(
			'type' 		=> 'option',
			'default' 	=> 'true',
		) );
		$wp_customize->add_control( 'inspiry_show_home_features', array(
			'label' 	=> __( 'Features on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_features',
			'choices' 	=> array(
				'true' 	=> __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* Features Section Text Over Title */
		$wp_customize->add_setting( 'inspiry_home_features_sub_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> esc_html__( 'Amazing', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_features_sub_title', array(
			'label' 	=> __( 'Text Over Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_features',
		) );

		/* Features Section Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_features_sub_title', array(
				'selector' 				=> '.home .rh_section__features .rh_section__subtitle',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_features_sub_title_render',
			) );
		}

		/* Features Section Title */
		$wp_customize->add_setting( 'inspiry_home_features_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> esc_html__( 'Features', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_features_title', array(
			'label' 	=> __( 'Section Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_features',
		) );

		/* Features Section Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_features_title', array(
				'selector' 				=> '.home .rh_section__features .rh_section__title',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_features_title_render',
			) );
		}

		/* Features Section Description */
		$wp_customize->add_setting( 'inspiry_home_features_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> 'Some amazing features of Real Homes theme.',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_home_features_desc', array(
			'label' 	=> __( 'Section Description', 'framework' ),
			'type' 		=> 'textarea',
			'section' 	=> 'inspiry_home_features',
		) );

		/* Home Features Intro */
		$wp_customize->add_setting( 'inspiry_home_features_intro', array() );
		$wp_customize->add_control(
			new Inspiry_Intro_Customize_Control(
				$wp_customize,
				'inspiry_home_features_intro',
				array(
					'section' => 'inspiry_home_features',
					'label' => esc_html__( 'How to add homepage features?', 'framework' ),
					'description' => esc_html__( 'Simply edit homepage and add features using meta boxes. You can get in touch with our support team in case of any confusion. Thanks!', 'framework' ),
				)
			)
		);

		/* Features Section Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_features_desc', array(
				'selector' 				=> '.home .rh_section__features .rh_section__desc',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_features_desc_render',
			) );
		}

//		/* Separator */
//		$wp_customize->add_setting( 'inspiry_home_features_title_separator', array() );
//		$wp_customize->add_control(
//			new Inspiry_Separator_Control(
//				$wp_customize,
//				'inspiry_home_features_title_separator',
//				array(
//					'section' 	=> 'inspiry_home_features',
//				)
//			)
//		);
//
//		/* Section Title Color */
//		$wp_customize->add_setting( 'inspiry_home_features_title_span_color', array(
//			'type' 		=> 'option',
////			'default'	=> '#1ea69a',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_home_features_title_span_color',
//				array(
//					'label'       => esc_html__( 'Text Over Title Color', 'framework' ),
//					'section'     => 'inspiry_home_features',
//					'description' => esc_html__( 'Default color is #1ea69a', 'framework' ),
//				)
//			)
//		);
//
//		/* Section Title Color */
//		$wp_customize->add_setting( 'inspiry_home_features_title_color', array(
//			'type' 		=> 'option',
//			'default'	=> '#1a1a1a',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_home_features_title_color',
//				array(
//					'label' 	=> esc_html__( 'Section Title Color', 'framework' ),
//					'section'	=> 'inspiry_home_features',
//				)
//			)
//		);
//
//		/* Section Description Color */
//		$wp_customize->add_setting( 'inspiry_home_features_desc_color', array(
//			'type' 		=> 'option',
//			'default'	=> '#808080',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_home_features_desc_color',
//				array(
//					'label' 	=> esc_html__( 'Section Description Color', 'framework' ),
//					'section'	=> 'inspiry_home_features',
//				)
//			)
//		);
//
//		/* Feature Title Color */
//		$wp_customize->add_setting( 'inspiry_home_feature_title_color', array(
//			'type' 		=> 'option',
//			'default'	=> '#1a1a1a',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_home_feature_title_color',
//				array(
//					'label' 	=> esc_html__( 'Feature Title Color', 'framework' ),
//					'section'	=> 'inspiry_home_features',
//				)
//			)
//		);
//
//		/* Feature Text Color */
//		$wp_customize->add_setting( 'inspiry_home_feature_text_color', array(
//			'type' 		=> 'option',
//			'default'	=> '#808080',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_home_feature_text_color',
//				array(
//					'label' 	=> esc_html__( 'Feature Text Color', 'framework' ),
//					'section'	=> 'inspiry_home_features',
//				)
//			)
//		);

	}

	add_action( 'customize_register', 'inspiry_home_features_customizer' );
endif;

if ( ! function_exists( 'inspiry_home_agents_defaults' ) ) :

	/**
	 * inspiry_home_agents_defaults.
	 *
	 * @since  3.0.0
	 */
	function inspiry_home_agents_defaults( WP_Customize_Manager $wp_customize ) {
		$testimonial_settings_ids = array(
			'inspiry_show_home_features',
			'inspiry_home_features_title',
			'inspiry_home_features_desc',
//			'inspiry_home_features_title_span_color',
//			'inspiry_home_features_title_color',
//			'inspiry_home_features_desc_color',
//			'inspiry_home_feature_title_color',
//			'inspiry_home_feature_text_color',
		);
		inspiry_initialize_defaults( $wp_customize, $testimonial_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_home_agents_defaults' );
endif;


if ( ! function_exists( 'inspiry_home_features_sub_title_render' ) ) {
	function inspiry_home_features_sub_title_render() {
		if ( get_option( 'inspiry_home_features_sub_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_features_sub_title' ) );
		}
	}
}


if ( ! function_exists( 'inspiry_home_features_title_render' ) ) {
	function inspiry_home_features_title_render() {
		if ( get_option( 'inspiry_home_features_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_features_title' ) );
		}
	}
}


if ( ! function_exists( 'inspiry_home_features_desc_render' ) ) {
	function inspiry_home_features_desc_render() {
		if ( get_option( 'inspiry_home_features_desc' ) ) {
			echo get_option( 'inspiry_home_features_desc' );
		}
	}
}
