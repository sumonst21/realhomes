<?php
/**
 * Section:	`Features Section`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_features_section_customizer' ) ) :

	/**
	 * inspiry_features_section_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_features_section_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Features Section
		 */
		$wp_customize->add_section( 'inspiry_home_features_section', array(
			'title' => __( 'Features Section', 'framework' ),
			'panel'	=> 'inspiry_home_panel',
		) );

		/* Show/Hide Features Section on Homepage */
		$wp_customize->add_setting( 'inspiry_show_features_section', array(
			'type' 		=> 'option',
			'default'	=> 'false',
		) );
		$wp_customize->add_control( 'inspiry_show_features_section', array(
			'label' 	=> __( 'Features Section on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_features_section',
			'choices' 	=> array(
				'true' 	=> __( 'Show', 'framework' ),
				'false'	=> __( 'Hide', 'framework' ),
			),
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_features_styles_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_features_styles_separator',
				array(
					'section' => 'inspiry_home_features_section',
				)
			)
		);

//		/* Features Section Text Color */
//		$wp_customize->add_setting( 'inspiry_features_text_color', array(
//			'default' 			=> '#FFFFFF',
//			'type' 				=> 'option',
//			'transport'			=> 'postMessage',
//			'sanitize_callback'	=> 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_features_text_color',
//				array(
//					'label' 	=> __( 'Section Text Color', 'framework' ),
//					'section'	=> 'inspiry_home_features_section',
//				)
//			)
//		);
//
//		/* Features Section Background Color */
//		$wp_customize->add_setting( 'inspiry_features_background_color', array(
//			'default' 			=> '#3EB6E0',
//			'type' 				=> 'option',
//			'transport'			=> 'postMessage',
//			'sanitize_callback'	=> 'sanitize_hex_color',
//		) );
//		$wp_customize->add_control(
//			new WP_Customize_Color_Control(
//				$wp_customize,
//				'inspiry_features_background_color',
//				array(
//					'label' 	=> __( 'Section Background Color', 'framework' ),
//					'section'	=> 'inspiry_home_features_section',
//				)
//			)
//		);

		/* Features Section Background Image */
		$wp_customize->add_setting( 'inspiry_features_background_image', array(
			'type' 				=> 'option',
			'sanitize_callback'	=> 'esc_url_raw',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'inspiry_features_background_image',
				array(
					'label' 		=> __( 'Section Background Image', 'framework' ),
					'section' 		=> 'inspiry_home_features_section',
				)
			)
		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_features_title_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_features_title_separator',
				array(
					'section' => 'inspiry_home_features_section',
				)
			)
		);

		/* Section Title */
		$wp_customize->add_setting( 'inspiry_features_section_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_features_section_title', array(
			'label' 	=> __( 'Section Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_features_section',
		) );

		/* Section Description */
		$wp_customize->add_setting( 'inspiry_features_section_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_features_section_desc', array(
			'label' 	=> __( 'Description Text', 'framework' ),
			'type' 		=> 'textarea',
			'section'	=> 'inspiry_home_features_section',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_features_section_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_features_section_separator',
				array(
					'section' => 'inspiry_home_features_section',
				)
			)
		);

		/* First Feature Image */
		$wp_customize->add_setting( 'inspiry_first_feature_image', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'inspiry_first_feature_image',
				array(
					'label' 		=> __( 'Feature Image', 'framework' ),
					'section' 		=> 'inspiry_home_features_section',
				)
			)
		);

		/* First Feature Image Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_first_feature_image', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(1) .feature-img',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_first_feature_image_render',
			) );
		}

		/* First Feature Title */
		$wp_customize->add_setting( 'inspiry_first_feature_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_first_feature_title', array(
			'label' 	=> __( 'Feature Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_features_section',
		) );

		/* First Feature Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_first_feature_title', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(1) .feature-content h4',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_first_feature_title_render',
			) );
		}

		/* First Feature Description */
		$wp_customize->add_setting( 'inspiry_first_feature_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_first_feature_desc', array(
			'label' 	=> __( 'Feature Description', 'framework' ),
			'type' 		=> 'textarea',
			'section'	=> 'inspiry_home_features_section',
		) );

		/* First Feature Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_first_feature_desc', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(1) .feature-content p',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_first_feature_desc_render',
			) );
		}

		/* First Feature URL */
		$wp_customize->add_setting( 'inspiry_first_feature_url', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw',
		) );
		$wp_customize->add_control( 'inspiry_first_feature_url', array(
			'label' 	=> __( 'Feature URL', 'framework' ),
			'type' 		=> 'url',
			'section'	=> 'inspiry_home_features_section',
		) );


		/* Second Feature Image */
		$wp_customize->add_setting( 'inspiry_second_feature_image', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'inspiry_second_feature_image',
				array(
					'label' 		=> __( 'Feature Image', 'framework' ),
					'section' 		=> 'inspiry_home_features_section',
				)
			)
		);

		/* Second Feature Image Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_second_feature_image', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(2) .feature-img',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_second_feature_image_render',
			) );
		}

		/* Second Feature Title */
		$wp_customize->add_setting( 'inspiry_second_feature_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_second_feature_title', array(
			'label' 	=> __( 'Feature Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_features_section',
		) );

		/* Second Feature Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_second_feature_title', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(2) .feature-content h4',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_second_feature_title_render',
			) );
		}

		/* Second Feature Description */
		$wp_customize->add_setting( 'inspiry_second_feature_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_second_feature_desc', array(
			'label' 	=> __( 'Feature Description', 'framework' ),
			'type' 		=> 'textarea',
			'section'	=> 'inspiry_home_features_section',
		) );

		/* Second Feature Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_second_feature_desc', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(2) .feature-content p',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_second_feature_desc_render',
			) );
		}

		/* Second Feature URL */
		$wp_customize->add_setting( 'inspiry_second_feature_url', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw',
		) );
		$wp_customize->add_control( 'inspiry_second_feature_url', array(
			'label' 	=> __( 'Feature URL', 'framework' ),
			'type' 		=> 'url',
			'section'	=> 'inspiry_home_features_section',
		) );


		/* Third Feature Image */
		$wp_customize->add_setting( 'inspiry_third_feature_image', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'inspiry_third_feature_image',
				array(
					'label' 		=> __( 'Feature Image', 'framework' ),
					'section' 		=> 'inspiry_home_features_section',
				)
			)
		);

		/* Third Feature Image Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_third_feature_image', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(3) .feature-img',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_third_feature_image_render',
			) );
		}

		/* Third Feature Title */
		$wp_customize->add_setting( 'inspiry_third_feature_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_third_feature_title', array(
			'label' 	=> __( 'Feature Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_features_section',
		) );

		/* Third Feature Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_third_feature_title', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(3) .feature-content h4',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_third_feature_title_render',
			) );
		}

		/* Third Feature Description */
		$wp_customize->add_setting( 'inspiry_third_feature_desc', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'wp_kses_data',
		) );
		$wp_customize->add_control( 'inspiry_third_feature_desc', array(
			'label' 	=> __( 'Feature Description', 'framework' ),
			'type' 		=> 'textarea',
			'section'	=> 'inspiry_home_features_section',
		) );

		/* Third Feature Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_third_feature_desc', array(
				'selector' 				=> '.features-wrapper .features-single:nth-child(3) .feature-content p',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_third_feature_desc_render',
			) );
		}

		/* Second Feature URL */
		$wp_customize->add_setting( 'inspiry_third_feature_url', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw',
		) );
		$wp_customize->add_control( 'inspiry_third_feature_url', array(
			'label' 	=> __( 'Feature URL', 'framework' ),
			'type' 		=> 'url',
			'section'	=> 'inspiry_home_features_section',
		) );

	}

	add_action( 'customize_register', 'inspiry_features_section_customizer' );
endif;


if ( ! function_exists( 'inspiry_features_section_defaults' ) ) :

	/**
	 * inspiry_features_section_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_features_section_defaults( WP_Customize_Manager $wp_customize ) {
		$features_section_settings_ids = array(
//			'inspiry_features_text_color',
//			'inspiry_features_background_color',
			'inspiry_show_features_section'
		);
		inspiry_initialize_defaults( $wp_customize, $features_section_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_features_section_defaults' );
endif;


if ( ! function_exists( 'inspiry_first_feature_image_render' ) ) {
	function inspiry_first_feature_image_render() {
		if ( get_option( 'inspiry_first_feature_image' ) ) : ?>
			<img src="<?php echo get_option( 'inspiry_first_feature_image' ); ?>"
				alt="<?php _e( 'Feature Image', 'framework' ); ?>" /> <?php
		endif;
	}
}


if ( ! function_exists( 'inspiry_first_feature_title_render' ) ) {
	function inspiry_first_feature_title_render() {
		if ( get_option( 'inspiry_first_feature_title' ) ) {
			echo get_option( 'inspiry_first_feature_title' );
		}
	}
}


if ( ! function_exists( 'inspiry_first_feature_desc_render' ) ) {
	function inspiry_first_feature_desc_render() {
		if ( get_option( 'inspiry_first_feature_desc' ) ) {
			echo get_option( 'inspiry_first_feature_desc' );
		}
	}
}


if ( ! function_exists( 'inspiry_second_feature_image_render' ) ) {
	function inspiry_second_feature_image_render() {
		if ( get_option( 'inspiry_second_feature_image' ) ) : ?>
			<img src="<?php echo get_option( 'inspiry_second_feature_image' ); ?>"
				alt="<?php _e( 'Feature Image', 'framework' ); ?>" /> <?php
		endif;
	}
}


if ( ! function_exists( 'inspiry_second_feature_title_render' ) ) {
	function inspiry_second_feature_title_render() {
		if ( get_option( 'inspiry_second_feature_title' ) ) {
			echo get_option( 'inspiry_second_feature_title' );
		}
	}
}


if ( ! function_exists( 'inspiry_second_feature_desc_render' ) ) {
	function inspiry_second_feature_desc_render() {
		if ( get_option( 'inspiry_second_feature_desc' ) ) {
			echo get_option( 'inspiry_second_feature_desc' );
		}
	}
}


if ( ! function_exists( 'inspiry_third_feature_image_render' ) ) {
	function inspiry_third_feature_image_render() {
		if ( get_option( 'inspiry_third_feature_image' ) ) : ?>
			<img src="<?php echo get_option( 'inspiry_third_feature_image' ); ?>"
				alt="<?php _e( 'Feature Image', 'framework' ); ?>" /> <?php
		endif;
	}
}


if ( ! function_exists( 'inspiry_third_feature_title_render' ) ) {
	function inspiry_third_feature_title_render() {
		if ( get_option( 'inspiry_third_feature_title' ) ) {
			echo get_option( 'inspiry_third_feature_title' );
		}
	}
}


if ( ! function_exists( 'inspiry_third_feature_desc_render' ) ) {
	function inspiry_third_feature_desc_render() {
		if ( get_option( 'inspiry_third_feature_desc' ) ) {
			echo get_option( 'inspiry_third_feature_desc' );
		}
	}
}

