<?php
/**
 * Section:    `Default or Custom`
 * Panel:    `Styles`
 *
 * @package RH
 * @since 3.4.2
 */

if ( ! function_exists( 'inspiry_basic_settings_customizer' ) ) :

	function inspiry_basic_settings_customizer( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section( 'inspiry_default_or_custom_section', array(
			'title' => esc_html__( 'Default or Custom', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		$allow_kses = array(
			'br'     => array(),
			'strong' => array(),
		);

		$wp_customize->add_setting( 'inspiry_default_styles', array(
			'default' => 'custom',
		) );



		$wp_customize->add_control( 'inspiry_default_styles', array(
			'label'       => esc_html__( 'You are going to use default theme colors or your own custom colors?', 'framework' ),
			'section'     => 'inspiry_default_or_custom_section',
			'type'        => 'radio',
			'settings'    => 'inspiry_default_styles',
			'choices'     => array(
				'default' => esc_html__( 'Default Theme Colors', 'framework' ),
				'custom'  => esc_html__( 'My Own Custom Colors', 'framework' ),
			),
		) );

		$wp_customize->add_setting( 'inspiry_basic_settings_note', array() );
		$wp_customize->add_control(
			new Inspiry_Intro_Customize_Control(
				$wp_customize,
				'inspiry_basic_settings_note',
				array(
					'section'     => 'inspiry_default_or_custom_section',
					'label'       => esc_html__( 'Important Note:', 'framework' ),
					'description' => esc_html__( "Above settings will automatically change to Default whenever you change the design variation. So that you can view freshly changed design variation in original colors.", 'framework' ),
				)
			)
		);

	}

	add_action( 'customize_register', 'inspiry_basic_settings_customizer' );
endif;