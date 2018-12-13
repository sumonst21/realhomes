<?php
/**
 * Agents Customizer Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_agents_customizer' ) ) :
	function inspiry_agents_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Agents Section
		 */
		$wp_customize->add_section( 'inspiry_agents_pages', array(
			'title' => __( 'Agents Pages', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_agents_header_variation', array(
				'type'		=> 'option',
				'default' 	=> 'banner',
			) );

			$wp_customize->add_control( 'inspiry_agents_header_variation', array(
				'label' 	=> __( 'Header Variation', 'framework' ),
				'description' => __( 'Header variation to display on agent pages.', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_agents_pages',
				'choices' 	=> array(
					'banner'	=> __( 'Banner', 'framework' ),
					'none'		=> __( 'None', 'framework' ),
				),
			) );
		}

		/* Number of Agents  */
		$wp_customize->add_setting( 'theme_number_posts_agent', array(
			'type' => 'option',
			'default' => '3',
		) );
		$wp_customize->add_control( 'theme_number_posts_agent', array(
			'label' => __( 'Number of Agents', 'framework' ),
			'description' => __( 'Select the maximum number of agents to display on an agents list page.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_agents_pages',
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
				'10' => 10,
				'11' => 11,
				'12' => 12,
				'13' => 13,
				'14' => 14,
				'15' => 15,
				'16' => 16,
				'17' => 17,
				'18' => 18,
				'19' => 19,
				'20' => 20,
			),
		) );

		/* Number of Agents  */
		$wp_customize->add_setting( 'theme_number_of_properties_agent', array(
			'type' => 'option',
			'default' => '6',
		) );
		$wp_customize->add_control( 'theme_number_of_properties_agent', array(
			'label' => __( 'Number of Properties on Agent Detail Page', 'framework' ),
			'description' => __( 'Select the number of properties to display on Agent detail page.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_agents_pages',
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
				'10' => 10,
				'11' => 11,
				'12' => 12,
				'13' => 13,
				'14' => 14,
				'15' => 15,
				'16' => 16,
				'17' => 17,
				'18' => 18,
				'19' => 19,
				'20' => 20,
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_agents_customizer' );
endif;


if ( ! function_exists( 'inspiry_agents_defaults' ) ) :
	/**
	 * Set default values for agents settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_agents_defaults( WP_Customize_Manager $wp_customize ) {
		$agents_settings_ids = array(
			'inspiry_agents_header_variation',
			'theme_number_posts_agent',
			'theme_number_of_properties_agent',
		);
		inspiry_initialize_defaults( $wp_customize, $agents_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_agents_defaults' );
endif;
