<?php
	/**
	 * Customizer settings with default fields
	 */
	if ( ! function_exists( 'inspiry_home_general_customizer_settings' ) ) :
		function inspiry_home_general_customizer( WP_Customize_Manager $wp_customize ) {

			// general section
			$wp_customize->add_section( 'inspiry_home_general_section', array(
				'title'    => esc_html__( 'General', 'framework' ),
				'panel'    => 'inspiry_home_panel',
			) );

			// homepage sections border type
			$wp_customize->add_setting( 'inspiry_home_sections_border', array(
				'type'    => 'option', // if you want to use as theme_mod then remove it
				'default' => 'diagonal-border',
			) );
			$wp_customize->add_control( 'inspiry_home_sections_border', array(
				'label'       => esc_html__( 'Sections Border Angle', 'framework' ),
				'type'        => 'radio', // if you may change it to select
				'section'     => 'inspiry_home_general_section',
				'choices'     => array(
					'diagonal-border' => esc_html__( 'Diagonal', 'framework' ),
					'flat-border'     => esc_html__( 'Flat', 'framework' ),
				),
			) );
		}

		add_action( 'customize_register', 'inspiry_home_general_customizer' );
	endif;