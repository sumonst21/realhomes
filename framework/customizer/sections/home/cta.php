<?php
/**
 * Section: Call to Action
 *
 * Call to action section settings.
 *
 * @since 	3.0.0
 * @package RH
 */

if ( ! function_exists( 'inspiry_cta_customizer' ) ) :

	/**
	 * Function to register customizer options
	 * for testimonial section
	 *
	 * @param object $wp_customize - Object of WP_Customize_Manager.
	 * @since 3.0.0
	 */
	function inspiry_cta_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Slogan Section
		 */
		$wp_customize->add_section( 'inspiry_home_cta', array(
			'title' => __( 'Call to Action', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Show/Hide CTA on Homepage */
		$wp_customize->add_setting( 'inspiry_show_cta', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
		) );
		$wp_customize->add_control( 'inspiry_show_cta', array(
			'label' 	=> __( 'CTA on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_cta',
			'choices' 	=> array(
				'true' 	=> __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* CTA Section Background Image */
		$wp_customize->add_setting( 'inspiry_cta_background_image', array(
			'type' 				=> 'option',
			'sanitize_callback'	=> 'esc_url_raw',
			'default' 	=> get_template_directory_uri() . '/assets/modern/images/cta-bg.jpg',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'inspiry_cta_background_image',
				array(
					'label' 		=> __( 'CTA Background', 'framework' ),
					'section' 		=> 'inspiry_home_cta',
				)
			)
		);

		/* CTA Title */
		$wp_customize->add_setting( 'inspiry_cta_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> 'Featured',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_title', array(
			'label' 	=> __( 'CTA Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta',
		) );

		/* CTA Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_cta_title', array(
				'selector' 				=> '.rh_cta--featured .rh_cta__title',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_cta_title_render',
			) );
		}

		/* CTA Description */
		$wp_customize->add_setting( 'inspiry_cta_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> 'Unknown printer took a galley of type and scrambled it to make a type specimen book.',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_cta_desc', array(
			'label' 	=> __( 'CTA Description', 'framework' ),
			'type' 		=> 'textarea',
			'section' 	=> 'inspiry_home_cta',
		) );

		/* CTA Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_cta_desc', array(
				'selector' 				=> '.rh_cta--featured .rh_cta__quote',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_cta_desc_render',
			) );
		}

//		/* CTA Title Color */
//		$wp_customize->add_setting( 'inspiry_cta_title_color', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_title_color',
//				array(
//					'label' => esc_html__( 'CTA Title Color', 'framework' ),
//					'section' => 'inspiry_home_cta',
//				)
//			)
//		);
//
//		/* CTA Description Color */
//		$wp_customize->add_setting( 'inspiry_cta_desc_color', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_desc_color',
//				array(
//					'label' => esc_html__( 'CTA Description Color', 'framework' ),
//					'section' => 'inspiry_home_cta',
//				)
//			)
//		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_cta_btn_one_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_cta_btn_one_separator',
				array(
					'section' 	=> 'inspiry_home_cta',
				)
			)
		);

		/* CTA Button 1 Title */
		$wp_customize->add_setting( 'inspiry_cta_btn_one_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> __( 'Submit Property', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_btn_one_title', array(
			'label' 	=> __( 'CTA Button Title One', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta',
		) );

		/* CTA Button Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_cta_btn_one_title', array(
				'selector' 				=> '.rh_cta--featured .rh_cta__btns .rh_btn--secondary',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_cta_btn_one_title_render',
			) );
		}

		/* CTA Button 1 URL */
		$wp_customize->add_setting( 'inspiry_cta_btn_one_url', array(
			'type' 				=> 'option',
			'transport'			=> 'refresh',
			'default'			=> '#',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_btn_one_url', array(
			'label' 	=> __( 'CTA Button URL One', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta',
		) );
//
//		$wp_customize->add_setting( 'inspiry_cta_btn_one_color', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_btn_one_color',
//				array(
//					'label' => esc_html__( 'CTA Button Color', 'framework' ),
//					'section' => 'inspiry_home_cta',
//				)
//			)
//		);
//
//		$wp_customize->add_setting( 'inspiry_cta_btn_one_bg', array(
//			'type' => 'option',
////			'default' => '#ea723d',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_btn_one_bg',
//				array(
//					'label' => esc_html__( 'CTA Button Background Color', 'framework' ),
//					'section' => 'inspiry_home_cta',
//					'description' => esc_html__('Default color is #ea723d','framework'),
//				)
//			)
//		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_cta_btn_two_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_cta_btn_two_separator',
				array(
					'section' 	=> 'inspiry_home_cta',
				)
			)
		);

		/* CTA Button 2 Title */
		$wp_customize->add_setting( 'inspiry_cta_btn_two_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> __( 'Browse Property', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_btn_two_title', array(
			'label' 	=> __( 'CTA Button Title Two', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta',
		) );

		/* CTA Button Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_cta_btn_two_title', array(
				'selector' 				=> '.rh_cta--featured .rh_cta__btns .rh_btn--greyBG',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_cta_btn_two_title_render',
			) );
		}

		/* CTA Button 2 URL */
		$wp_customize->add_setting( 'inspiry_cta_btn_two_url', array(
			'type' 				=> 'option',
			'transport'			=> 'refresh',
			'default'			=> '#',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_btn_two_url', array(
			'label' 	=> __( 'CTA Button URL Two', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta',
		) );

//		$wp_customize->add_setting( 'inspiry_cta_btn_two_color', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_btn_two_color',
//				array(
//					'label' => esc_html__( 'CTA Button Color', 'framework' ),
//					'section' => 'inspiry_home_cta',
//				)
//			)
//		);
//
//		$wp_customize->add_setting( 'inspiry_cta_btn_two_bg', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_btn_two_bg',
//				array(
//					'label' => esc_html__( 'CTA Button Background Color', 'framework' ),
//					'section' => 'inspiry_home_cta',
//				)
//			)
//		);

	}

	add_action( 'customize_register', 'inspiry_cta_customizer' );
endif;

if ( ! function_exists( 'inspiry_cta_defaults' ) ) :

	/**
	 * inspiry_cta_defaults.
	 *
	 * @since  3.0.0
	 */
	function inspiry_cta_defaults( WP_Customize_Manager $wp_customize ) {
		$testimonial_settings_ids = array(
			'inspiry_show_cta',
			'inspiry_cta_title',
			'inspiry_cta_desc',
			'inspiry_cta_title_color',
			'inspiry_cta_desc_color',
			'inspiry_cta_btn_one_title',
			'inspiry_cta_btn_one_url',
			'inspiry_cta_btn_two_title',
			'inspiry_cta_btn_two_url',
			'inspiry_cta_btn_one_color',
			'inspiry_cta_btn_one_bg',
			'inspiry_cta_btn_two_color',
			'inspiry_cta_btn_two_bg',
		);
		inspiry_initialize_defaults( $wp_customize, $testimonial_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_cta_defaults' );
endif;

if ( ! function_exists( 'inspiry_cta_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_cta_title_render() {
		if ( get_option( 'inspiry_cta_title' ) ) {
			echo esc_html( get_option( 'inspiry_cta_title' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_cta_desc_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_cta_desc_render() {
		if ( get_option( 'inspiry_cta_desc' ) ) {
			echo esc_html( get_option( 'inspiry_cta_desc' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_cta_btn_one_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_cta_btn_one_title_render() {
		if ( get_option( 'inspiry_cta_btn_one_title' ) ) {
			echo esc_html( get_option( 'inspiry_cta_btn_one_title' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_cta_btn_two_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_cta_btn_two_title_render() {
		if ( get_option( 'inspiry_cta_btn_two_title' ) ) {
			echo esc_html( get_option( 'inspiry_cta_btn_two_title' ) );
		}
	}
}
