<?php
/**
 * Section: CTA Contact
 *
 * CTA contact section settings.
 *
 * @since 	3.0.0
 * @package RH
 */

if ( ! function_exists( 'inspiry_home_cta_contact_customizer' ) ) :

	/**
	 * Function to register customizer options
	 * for CTA contact section
	 *
	 * @param object $wp_customize - Object of WP_Customize_Manager.
	 * @since 3.0.0
	 */
	function inspiry_home_cta_contact_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Slogan Section
		 */
		$wp_customize->add_section( 'inspiry_home_cta_contact', array(
			'title' => __( 'Call to Action — Contact', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Show/Hide CTA Contact on Homepage */
		$wp_customize->add_setting( 'inspiry_show_home_cta_contact', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
		) );
		$wp_customize->add_control( 'inspiry_show_home_cta_contact', array(
			'label' 	=> __( 'CTA Contact on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_cta_contact',
			'choices' 	=> array(
				'true' 	=> __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* CTA Section Background Image */
		$wp_customize->add_setting( 'inspiry_home_cta_contact_bg_image', array(
			'type' 				=> 'option',
			'sanitize_callback'	=> 'esc_url_raw',
			'default' 	=> get_template_directory_uri() . '/assets/modern/images/cta-above-footer.jpg',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'inspiry_home_cta_contact_bg_image',
				array(
					'label' 		=> __( 'CTA Background', 'framework' ),
					'section' 		=> 'inspiry_home_cta_contact',
				)
			)
		);

//		// CTA Background Color.
//		$wp_customize->add_setting( 'inspiry_home_cta_bg_color', array(
//			'type' 		=> 'option',
////			'default'	=> '#1EA69A',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_home_cta_bg_color',
//				array(
//					'label' 	=> __( 'CTA Overlay Color', 'framework' ),
//					'section' 	=> 'inspiry_home_cta_contact',
//					'description' => esc_html__('Default color is #1EA69A','framework'),
//				)
//			)
//		);

		/* CTA Section Title */
		$wp_customize->add_setting( 'inspiry_home_cta_contact_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> __( 'Trouble Finding', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_home_cta_contact_title', array(
			'label' 	=> __( 'Section Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta_contact',
		) );

		/* CTA Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_cta_contact_title', array(
				'selector' 				=> '.rh_cta--contact .rh_cta__title',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_cta_contact_title_render',
			) );
		}

		/* CTA Section Description */
		$wp_customize->add_setting( 'inspiry_home_cta_contact_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> __( 'Need help? Talk to our expert.', 'framework' ),
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_home_cta_contact_desc', array(
			'label' 	=> __( 'Section Description', 'framework' ),
			'type' 		=> 'textarea',
			'section' 	=> 'inspiry_home_cta_contact',
		) );

		/* CTA Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_home_cta_contact_desc', array(
				'selector' 				=> '.rh_cta--contact .rh_cta__quote',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_home_cta_contact_desc_render',
			) );
		}

//		/* CTA Contact Title Color */
//		$wp_customize->add_setting( 'inspiry_cta_contact_title_color', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_contact_title_color',
//				array(
//					'label' => esc_html__( 'CTA Contact Title Color', 'framework' ),
//					'section' => 'inspiry_home_cta_contact',
//				)
//			)
//		);
//
//		/* CTA Contact Description Color */
//		$wp_customize->add_setting( 'inspiry_cta_contact_desc_color', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_contact_desc_color',
//				array(
//					'label' => esc_html__( 'CTA Contact Description Color', 'framework' ),
//					'section' => 'inspiry_home_cta_contact',
//				)
//			)
//		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_cta_contact_btn_one_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_cta_contact_btn_one_separator',
				array(
					'section' 	=> 'inspiry_home_cta_contact',
				)
			)
		);

		/* CTA Button 1 Title */
		$wp_customize->add_setting( 'inspiry_cta_contact_btn_one_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> __( 'Submit Property', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_contact_btn_one_title', array(
			'label' 	=> __( 'CTA Button Title One', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta_contact',
		) );

		/* CTA Button Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_cta_contact_btn_one_title', array(
				'selector' 				=> '.rh_cta--contact .rh_cta__btns .rh_btn--blackBG',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_cta_contact_btn_one_title_render',
			) );
		}

		/* CTA Button 1 URL */
		$wp_customize->add_setting( 'inspiry_cta_contact_btn_one_url', array(
			'type' 				=> 'option',
			'transport'			=> 'refresh',
			'default'			=> '#',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_contact_btn_one_url', array(
			'label' 	=> __( 'CTA Button URL One', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta_contact',
		) );

//		$wp_customize->add_setting( 'inspiry_cta_contact_btn_one_color', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_contact_btn_one_color',
//				array(
//					'label' => esc_html__( 'CTA Button Color One', 'framework' ),
//					'section' => 'inspiry_home_cta_contact',
//				)
//			)
//		);
//
//		$wp_customize->add_setting( 'inspiry_cta_contact_btn_one_bg', array(
//			'type' => 'option',
//			'default' => '#303030',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_contact_btn_one_bg',
//				array(
//					'label' => esc_html__( 'CTA Button Background Color One', 'framework' ),
//					'section' => 'inspiry_home_cta_contact',
//				)
//			)
//		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_cta_contact_btn_two_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_cta_contact_btn_two_separator',
				array(
					'section' 	=> 'inspiry_home_cta_contact',
				)
			)
		);

		/* CTA Button 2 Title */
		$wp_customize->add_setting( 'inspiry_cta_contact_btn_two_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default'			=> __( 'Browse Property', 'framework' ),
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_contact_btn_two_title', array(
			'label' 	=> __( 'CTA Button Title Two', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta_contact',
		) );

		/* CTA Button Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_cta_contact_btn_two_title', array(
				'selector' 				=> '.rh_cta--contact .rh_cta__btns .rh_btn--whiteBG',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_cta_contact_btn_two_title_render',
			) );
		}

		/* CTA Button 2 URL */
		$wp_customize->add_setting( 'inspiry_cta_contact_btn_two_url', array(
			'type' 				=> 'option',
			'transport'			=> 'refresh',
			'default'			=> '#',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_cta_contact_btn_two_url', array(
			'label' 	=> __( 'CTA Button URL Two', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_cta_contact',
		) );

//		$wp_customize->add_setting( 'inspiry_cta_contact_btn_two_color', array(
//			'type' => 'option',
//			'default' => '#303030',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_contact_btn_two_color',
//				array(
//					'label' => esc_html__( 'CTA Button Color Two', 'framework' ),
//					'section' => 'inspiry_home_cta_contact',
//				)
//			)
//		);
//
//		$wp_customize->add_setting( 'inspiry_cta_contact_btn_two_bg', array(
//			'type' => 'option',
//			'default' => '#ffffff',
//			'sanitize_callback' => 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_cta_contact_btn_two_bg',
//				array(
//					'label' => esc_html__( 'CTA Button Background Color Two', 'framework' ),
//					'section' => 'inspiry_home_cta_contact',
//				)
//			)
//		);

	}

	add_action( 'customize_register', 'inspiry_home_cta_contact_customizer' );
endif;

if ( ! function_exists( 'inspiry_home_cta_contact_defaults' ) ) :

	/**
	 * inspiry_home_cta_contact_defaults.
	 *
	 * @since  3.0.0
	 */
	function inspiry_home_cta_contact_defaults( WP_Customize_Manager $wp_customize ) {
		$testimonial_settings_ids = array(
			'inspiry_show_home_cta_contact',
			'inspiry_home_cta_bg_color',
			'inspiry_home_cta_contact_title',
			'inspiry_home_cta_contact_desc',
			'inspiry_cta_contact_title_color',
			'inspiry_cta_contact_desc_color',
			'inspiry_cta_contact_btn_one_title',
			'inspiry_cta_contact_btn_one_url',
			'inspiry_cta_contact_btn_two_title',
			'inspiry_cta_contact_btn_two_url',
			'inspiry_cta_contact_btn_one_color',
			'inspiry_cta_contact_btn_one_bg',
			'inspiry_cta_contact_btn_two_color',
			'inspiry_cta_contact_btn_two_bg',
		);
		inspiry_initialize_defaults( $wp_customize, $testimonial_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_home_cta_contact_defaults' );
endif;

if ( ! function_exists( 'inspiry_home_cta_contact_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_home_cta_contact_title_render() {
		if ( get_option( 'inspiry_home_cta_contact_title' ) ) {
			echo esc_html( get_option( 'inspiry_home_cta_contact_title' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_home_cta_contact_desc_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_home_cta_contact_desc_render() {
		if ( get_option( 'inspiry_home_cta_contact_desc' ) ) {
			echo esc_html( get_option( 'inspiry_home_cta_contact_desc' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_cta_contact_btn_one_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_cta_contact_btn_one_title_render() {
		if ( get_option( 'inspiry_cta_contact_btn_one_title' ) ) {
			echo esc_html( get_option( 'inspiry_cta_contact_btn_one_title' ) );
		}
	}
}

if ( ! function_exists( 'inspiry_cta_contact_btn_two_title_render' ) ) {

	/**
	 * Partial Refresh Render
	 *
	 * @since  3.0.0
	 */
	function inspiry_cta_contact_btn_two_title_render() {
		if ( get_option( 'inspiry_cta_contact_btn_two_title' ) ) {
			echo esc_html( get_option( 'inspiry_cta_contact_btn_two_title' ) );
		}
	}
}
