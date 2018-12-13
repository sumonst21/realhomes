<?php
/**
 * Section:	`Others`
 * Panel: 	`Header`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_header_others_customizer' ) ) :

	/**
	 * inspiry_header_others_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */

	function inspiry_header_others_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Header Others
		 */
		$wp_customize->add_section( 'inspiry_header_others', array(
			'title' => __( 'Others', 'framework' ),
			'panel' => 'inspiry_header_panel',
		) );

		/* Sticky Header */
		$wp_customize->add_setting( 'theme_sticky_header', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
		) );
		$wp_customize->add_control( 'theme_sticky_header', array(
			'label' 	=> __( 'Sticky Header', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_header_others',
			'choices' 	=> array(
				'true' 	=> 'Enable',
				'false'	=> 'Disable',
			),
		) );

		/* Enable / Disable WPML Language switcher */
		$wp_customize->add_setting( 'theme_wpml_lang_switcher', array(
			'type' 		=> 'option',
			'default' 	=> 'true',
		) );
		$wp_customize->add_control( 'theme_wpml_lang_switcher', array(
			'label' 		=> __( 'Display WPML Language Switcher in Top Header', 'framework' ),
			'description' 	=> __( 'Only works if WPML is installed.', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_header_others',
			'choices' 	=> array(
				'true' 	=> __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			),
		) );

		/* Header Variation */
		$wp_customize->add_setting( 'inspiry_header_variation', array(
			'type' 		=> 'option',
			'default'	=> 'default',
		) );
		$wp_customize->add_control( 'inspiry_header_variation', array(
			'label' 		=> __( 'Choose Header Variation', 'framework' ),
			'type' 			=> 'radio',
			'section' 		=> 'inspiry_header_others',
			'choices' 		=> array(
				'default' 	=> __( 'Default', 'framework' ),
				'center' 	=> __( 'Center', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_header_others_customizer' );
endif;


if ( ! function_exists( 'inspiry_header_others_defaults' ) ) :

	/**
	 * inspiry_header_others_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_header_others_defaults( WP_Customize_Manager $wp_customize ) {
		$header_others_settings_ids = array(
			'theme_sticky_header',
			'theme_wpml_lang_switcher',
			'inspiry_header_variation'
		);
		inspiry_initialize_defaults( $wp_customize, $header_others_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_header_others_defaults' );
endif;
