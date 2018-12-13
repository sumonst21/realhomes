<?php
/**
 * Agencies Customizer Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_agencies_customizer' ) ) :
	function inspiry_agencies_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Agencies Section
		 */
		$wp_customize->add_section( 'inspiry_agencies_pages', array(
			'title' => esc_html__( 'Agencies Pages', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_agencies_header_variation', array(
				'type'		=> 'option',
				'default' 	=> 'banner',
			) );

			$wp_customize->add_control( 'inspiry_agencies_header_variation', array(
				'label' 	=> esc_html__( 'Header Variation', 'framework' ),
				'description' => esc_html__( 'Header variation to display on agency pages.', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_agencies_pages',
				'choices' 	=> array(
					'banner'	=> esc_html__( 'Banner', 'framework' ),
					'none'		=> esc_html__( 'None', 'framework' ),
				),
			) );
		}

		/* Number of Agencies  */
		$wp_customize->add_setting( 'inspiry_number_posts_agency', array(
			'type' => 'option',
			'default' => '3',
		) );
		$wp_customize->add_control( 'inspiry_number_posts_agency', array(
			'label' => esc_html__( 'Number of Agencies', 'framework' ),
			'description' => esc_html__( 'Select the maximum number of agencies to display on an agencies list page.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_agencies_pages',
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

		/* Number of Agencies  */
		$wp_customize->add_setting( 'inspiry_number_of_agents_agency', array(
			'type' => 'option',
			'default' => '6',
		) );
		$wp_customize->add_control( 'inspiry_number_of_agents_agency', array(
			'label' => esc_html__( 'Number of Agents on Agency Detail Page', 'framework' ),
			'description' => esc_html__( 'Select the number of agents to display on agency detail page.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_agencies_pages',
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

	add_action( 'customize_register', 'inspiry_agencies_customizer' );
endif;
