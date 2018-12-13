<?php
/**
 * Section:	`Basic`
 * Panel: 	`Styles`
 *
 * @package RH
 * @since 3.0.0
 */

if ( ! function_exists( 'inspiry_styles_basic_customizer' ) ) :

	/**
	 * inspiry_styles_basic_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  3.0.0
	 */
	function inspiry_styles_basic_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Basic Section
		 */
		$wp_customize->add_section( 'inspiry_styles_basic', array(
			'title' => esc_html__( 'Quick CSS', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		/* Quick CSS */
		$wp_customize->add_setting( 'theme_quick_css', array(
			'type' => 'option',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_quick_css', array(
			'label' => esc_html__( 'Quick CSS', 'framework' ),
			'description' => esc_html__( 'Enter small CSS changes here. If you need to change major portions of the theme then use child-custom.css file in child theme.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_styles_basic',
		) );

	}

	add_action( 'customize_register', 'inspiry_styles_basic_customizer' );
endif;


if ( ! function_exists( 'inspiry_styles_basic_defaults' ) ) :

	/**
	 * inspiry_styles_basic_defaults.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  3.0.0
	 */
	function inspiry_styles_basic_defaults( WP_Customize_Manager $wp_customize ) {
		$styles_basic_settings_ids = array();
		inspiry_initialize_defaults( $wp_customize, $styles_basic_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_styles_basic_defaults' );
endif;
