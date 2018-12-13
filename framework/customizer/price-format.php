<?php
/**
 * Price Format Customizer
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_price_customizer' ) ) :
	function inspiry_price_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Price Format Section
		 */

		$wp_customize->add_section( 'inspiry_price_format_section', array(
			'title' => __( 'Price Format', 'framework' ),
			'priority' => 131,
		) );

		/* Currency Sign  */
		$wp_customize->add_setting( 'theme_currency_sign', array(
			'type' => 'option',
			'default' => '$',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_currency_sign', array(
			'label' => __( 'Currency Sign', 'framework' ),
			'description' => __( 'Provide currency sign. For Example: $', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_price_format_section',
		) );

		/* Position */
		$wp_customize->add_setting( 'theme_currency_position', array(
			'type' => 'option',
			'default' => 'before',
		) );
		$wp_customize->add_control( 'theme_currency_position', array(
			'label' => __( 'Position of Currency Sign', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_price_format_section',
			'choices' => array(
				'before' => __( 'Before the numbers', 'framework' ),
				'after' => __( 'After the numbers', 'framework' ),
			),
		) );

		/* Number of Decimals */
		$wp_customize->add_setting( 'theme_decimals', array(
			'type' => 'option',
			'default' => '0',
		) );
		$wp_customize->add_control( 'theme_decimals', array(
			'label' => __( 'Number of Decimals Points', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_price_format_section',
			'choices' => array(
				'0' => 0,
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
			),
		) );

		/* Decimal Point Separator  */
		$wp_customize->add_setting( 'theme_dec_point', array(
			'type' => 'option',
			'default' => '.',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_dec_point', array(
			'label' => __( 'Decimal Point Separator', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_price_format_section',
		) );

		/* Thousand Separator  */
		$wp_customize->add_setting( 'theme_thousands_sep', array(
			'type' => 'option',
			'default' => ',',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_thousands_sep', array(
			'label' => __( 'Thousands Separator', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_price_format_section',
		) );

		/* Empty Price Text  */
		$wp_customize->add_setting( 'theme_no_price_text', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_no_price_text', array(
			'label' => __( 'Empty Price Text', 'framework' ),
			'description' => __( 'Text to display when no price is provided.', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_price_format_section',
		) );

	}

	add_action( 'customize_register', 'inspiry_price_customizer' );
endif;


if ( ! function_exists( 'inspiry_price_defaults' ) ) :
	/**
	 * Set default values for price format settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_price_defaults( WP_Customize_Manager $wp_customize ) {
		$price_settings_ids = array(
			'theme_currency_sign',
			'theme_currency_position',
			'theme_decimals',
			'theme_dec_point',
			'theme_thousands_sep',
		);
		inspiry_initialize_defaults( $wp_customize, $price_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_price_defaults' );
endif;
