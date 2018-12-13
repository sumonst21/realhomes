<?php
/**
 * Section:	`Typography`
 * Panel: 	`Styles`
 *
 * @package RH
 * @since 3.0.0
 */

if ( ! function_exists( 'inspiry_typography_customizer' ) ) :

	/**
	 * inspiry_typography_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  3.0.0
	 */
	function inspiry_typography_customizer( WP_Customize_Manager $wp_customize ) {

		$inspiry_google_fonts = inspiry_get_google_fonts_list();

		/**
		 * Typography Section
		 */
		$wp_customize->add_section( 'inspiry_typography_section', array(
			'title' => esc_html__( 'Typography', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		/* Heading Font */
		$wp_customize->add_setting( 'inspiry_heading_font', array(
			'type'    => 'option',
			'Default' => 'Default',
		) );
		$wp_customize->add_control( 'inspiry_heading_font', array(
			'label'   => esc_html__( 'Google Font for Primary Headings', 'framework' ),
			'section' => 'inspiry_typography_section',
			'type'    => 'select',
			'choices' => $inspiry_google_fonts,
		) );

		/* Secondary Font */
		$wp_customize->add_setting( 'inspiry_secondary_font', array(
			'type'    => 'option',
			'Default' => 'Default',
		) );
		$wp_customize->add_control( 'inspiry_secondary_font', array(
			'label'   => esc_html__( 'Google Font for Secondary Headings and Text', 'framework' ),
			'section' => 'inspiry_typography_section',
			'type'    => 'select',
			'choices' => $inspiry_google_fonts,
		) );

		/* Body Font */
		$wp_customize->add_setting( 'inspiry_body_font', array(
			'type'    => 'option',
			'Default' => 'Default',
		) );
		$wp_customize->add_control( 'inspiry_body_font', array(
			'label'   => esc_html__( 'Google Font for Body Text', 'framework' ),
			'section' => 'inspiry_typography_section',
			'type'    => 'select',
			'choices' => $inspiry_google_fonts,
		) );

	}

	add_action( 'customize_register', 'inspiry_typography_customizer' );
endif;


if ( ! function_exists( 'inspiry_typography_defaults' ) ) :

	/**
	 * inspiry_typography_defaults.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  3.0.0
	 */
	function inspiry_typography_defaults( WP_Customize_Manager $wp_customize ) {
		$typography_settings_ids = array(
			'inspiry_heading_font',
			'inspiry_secondary_font',
			'inspiry_body_font',
		);
		inspiry_initialize_defaults( $wp_customize, $typography_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_typography_defaults' );
endif;
