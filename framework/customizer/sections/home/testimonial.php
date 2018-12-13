<?php
/**
 * Section: Testimonial
 *
 * Testimonial section settings.
 *
 * @since 	3.0.0
 * @package RH
 */

if ( ! function_exists( 'inspiry_testimonial_customizer' ) ) :

	/**
	 * Function to register customizer options
	 * for testimonial section
	 *
	 * @param object $wp_customize - Object of WP_Customize_Manager.
	 * @since 3.0.0
	 */
	function inspiry_testimonial_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Slogan Section
		 */
		$wp_customize->add_section( 'inspiry_home_testimonial', array(
			'title' => __( 'Testimonial', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Show/Hide Testimonial on Homepage */
		$wp_customize->add_setting( 'inspiry_show_testimonial', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
		) );
		$wp_customize->add_control( 'inspiry_show_testimonial', array(
			'label' 	=> __( 'Testimonial on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_testimonial',
			'choices' 	=> array(
				'true' 	=> __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

//		/* Testimonial Color */
//		$wp_customize->add_setting( 'inspiry_testimonial_color', array(
//			'type' 		=> 'option',
//			'default'	=> '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_testimonial_color',
//				array(
//					'label' 	=> esc_html__( 'Testimonial Text Color', 'framework' ),
//					'section'	=> 'inspiry_home_testimonial',
//				)
//			)
//		);

//		/* Testimonial Background */
//		$wp_customize->add_setting( 'inspiry_testimonial_bg', array(
//			'type' 		=> 'option',
////			'default'	=> '#1ea69a',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_testimonial_bg',
//				array(
//					'label'       => esc_html__( 'Testimonial Background Color', 'framework' ),
//					'section'     => 'inspiry_home_testimonial',
//					'description' => esc_html__( 'Default color is #1ea69a', 'framework' )
//				)
//			)
//		);
//
//		$wp_customize->add_setting( 'inspiry_testimonial_bg_quote', array(
//			'type' 		=> 'option',
////			'default'	=> '#1ea69a',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_testimonial_bg_quote',
//				array(
//					'label'       => esc_html__( 'Testimonial Quote Mark Color', 'framework' ),
//					'section'     => 'inspiry_home_testimonial',
//					'description' => esc_html__( 'Default color is #1c9d92', 'framework' )
//				)
//			)
//		);


		/* Testimonial */
		$wp_customize->add_setting( 'inspiry_testimonial_text', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> __( 'Best theme for Real Estate Agency fast installation and translation can be done with po-edit software. Cool & comfortable design, thanks for this amazing theme. Recommended for all real estate agency.', 'framework' ),
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_testimonial_text', array(
			'label' 	=> __( 'Testimonial', 'framework' ),
			'type' 		=> 'textarea',
			'section' 	=> 'inspiry_home_testimonial',
		) );

		/* Testimonial Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_testimonial_text', array(
				'selector' 				=> '.rh_testimonial .rh_testimonial__quote',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_testimonial_text_render',
			) );
		}

		/* Separator */
		$wp_customize->add_setting( 'inspiry_testimonial_text_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_testimonial_text_separator',
				array(
					'section' 	=> 'inspiry_home_testimonial',
				)
			)
		);

		/* Testimonial Name */
		$wp_customize->add_setting( 'inspiry_testimonial_name', array(
			'type' 				=> 'option',
			'transport'			=> 'refresh',
			'default'			=> __( 'giovannigr', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_testimonial_name', array(
			'label' 	=> __( 'Name', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_testimonial',
		) );

		/* Testimonial Name Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_testimonial_name', array(
				'selector' 				=> '.rh_testimonial .rh_testimonial__author_name',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_testimonial_name_render',
			) );
		}

//		/* Testimonial Color */
//		$wp_customize->add_setting( 'inspiry_testimonial_name_color', array(
//			'type' 		=> 'option',
//			'default'	=> '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_testimonial_name_color',
//				array(
//					'label' 	=> esc_html__( 'Name Color', 'framework' ),
//					'section'	=> 'inspiry_home_testimonial',
//				)
//			)
//		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_testimonial_name_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_testimonial_name_separator',
				array(
					'section' 	=> 'inspiry_home_testimonial',
				)
			)
		);

		/* Testimonial URL */
		$wp_customize->add_setting( 'inspiry_testimonial_url', array(
			'type' 				=> 'option',
			'transport'			=> 'refresh',
			'default'			=> 'http://giovannigr.com',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_testimonial_url', array(
			'label' 	=> __( 'URL', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_testimonial',
		) );

		/* Testimonial URL Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_testimonial_url', array(
				'selector' 				=> '.rh_testimonial .rh_testimonial__author__link',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_testimonial_url_render',
			) );
		}

//		/* Testimonial Color */
//		$wp_customize->add_setting( 'inspiry_testimonial_url_color', array(
//			'type' 		=> 'option',
//			'default'	=> '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_testimonial_url_color',
//				array(
//					'label' 	=> esc_html__( 'URL Color', 'framework' ),
//					'section'	=> 'inspiry_home_testimonial',
//				)
//			)
//		);

	}

	add_action( 'customize_register', 'inspiry_testimonial_customizer' );
endif;

if ( ! function_exists( 'inspiry_testimonial_defaults' ) ) :

	/**
	 * inspiry_testimonial_defaults.
	 *
	 * @since  3.0.0
	 */
	function inspiry_testimonial_defaults( WP_Customize_Manager $wp_customize ) {
		$testimonial_settings_ids = array(
			'inspiry_show_testimonial',
			'inspiry_testimonial_text',
			'inspiry_testimonial_name',
			'inspiry_testimonial_url',
//			'inspiry_testimonial_color',
//			'inspiry_testimonial_name_color',
//			'inspiry_testimonial_url_color',
		);
		inspiry_initialize_defaults( $wp_customize, $testimonial_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_testimonial_defaults' );
endif;

if ( ! function_exists( 'inspiry_testimonial_text_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_testimonial_text_render() {
		if ( get_option( 'inspiry_testimonial_text' ) ) {
			echo esc_html( get_option( 'inspiry_testimonial_text' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_testimonial_name_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_testimonial_name_render() {
		if ( get_option( 'inspiry_testimonial_name' ) ) {
			echo esc_html( get_option( 'inspiry_testimonial_name' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_testimonial_url_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_testimonial_url_render() {
		if ( get_option( 'inspiry_testimonial_url' ) ) {
			echo '<a href="' . esc_url( get_option( 'inspiry_testimonial_url' ) ) . '">' . esc_html( get_option( 'inspiry_testimonial_url' ) ) . '</a>';
		}
	}
}
