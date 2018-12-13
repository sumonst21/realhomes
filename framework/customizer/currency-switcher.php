<?php
/**
 * Currency Switcher Customizer Settings
 */

if ( ! function_exists( 'inspiry_currency_switcher_customizer' ) ) :
	function inspiry_currency_switcher_customizer( WP_Customize_Manager $wp_customize ) {

		/* Get all currency codes */
		$currencies = get_currencies();
		$currency_codes = array();
		if ( 0 < count( $currencies ) ) {
			foreach ( $currencies as $currency_code => $currency ) {
				$currency_codes[ $currency_code ] = $currency['name'];
			}
		}

		/**
		 * Currency Switcher Section
		 */
		$wp_customize->add_section( 'inspiry_currency_switcher', array(
			'title' => __( 'Currency Switcher', 'framework' ),
			'panel' => 'inspiry_header_panel',
		) );

		/* Base Currency */
		$wp_customize->add_setting( 'theme_base_currency', array(
			'type' => 'option',
			'default' => 'USD',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_base_currency', array(
			'label' => __( 'Base Currency', 'framework' ),
			'description' => __( 'Selected currency will be used as base currency for all conversions. You can find full list of supported currencies at <a target="_blank" href="https://openexchangerates.org/currencies">https://openexchangerates.org/currencies</a>', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_currency_switcher',
			'choices' => $currency_codes,
		) );

		/* Supported Currencies */
		$wp_customize->add_setting( 'theme_supported_currencies', array(
			'type' => 'option',
			'default' => "AUD,CAD,CHF,EUR,GBP,HKD,JPY,NOK,SEK,USD",
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_supported_currencies', array(
			'label' => __( 'Currencies You Want to Support', 'framework' ),
			'description' => __( 'Only provide comma separated list of currency codes in capital letters. Do not add dashes, spaces or currency signs.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_currency_switcher',
		) );

		/* Expiry Time for Switched Currency */
		$wp_customize->add_setting( 'theme_currency_expiry', array(
			'type' => 'option',
			'default' => '3600',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_currency_expiry', array(
			'label' => __( 'Expiry Period for Switched Currency', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_currency_switcher',
			'choices' => array(
				'3600' => __( 'One Hour', 'framework' ),
				'86400' => __( 'One Day', 'framework' ),
				'604800' => __( 'One Week', 'framework' ),
				'18144000' => __( 'One Month', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_currency_switcher_customizer' );
endif;


if ( ! function_exists( 'inspiry_currency_switcher_defaults' ) ) :
	/**
	 * Set default values for price format settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_currency_switcher_defaults( WP_Customize_Manager $wp_customize ) {
		$currency_switcher_settings_ids = array(
			'theme_base_currency',
			'theme_supported_currencies',
			'theme_currency_expiry',
		);
		inspiry_initialize_defaults( $wp_customize, $currency_switcher_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_currency_switcher_defaults' );
endif;
