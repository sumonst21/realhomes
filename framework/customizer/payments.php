<?php
/**
 * Payments Customizer Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_payments_customizer' ) ) :
	function inspiry_payments_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Payments Section
		 */
		$wp_customize->add_section( 'inspiry_members_payments', array(
			'title' => __( 'Payments', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Enable/Disable PayPal Payments */
		$wp_customize->add_setting( 'theme_enable_paypal', array(
			'type' => 'option',
			'default' => 'false',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_enable_paypal', array(
			'label' => __( 'Enable PayPal Payments for Submitted Property', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_members_payments',
			'choices' => array(
				'true' => __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			),
		) );

		/* PayPal IPN URL */
		$wp_customize->add_setting( 'theme_paypal_ipn_url', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_paypal_ipn_url', array(
			'label' => __( 'PayPal IPN URL', 'framework' ),
			'description' => 'You need to install <a href="https://wordpress.org/plugins/paypal-ipn/" target="_blank">PayPal IPN for WordPress</a> plugin and get its IPN URL from <strong>Settings > PayPal IPN</strong>',
			'type' => 'url',
			'section' => 'inspiry_members_payments',
		) );

		/* PayPal Merchant ID */
		$wp_customize->add_setting( 'theme_paypal_merchant_id', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_paypal_merchant_id', array(
			'label' => __( 'PayPal merchant account ID or Email', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_members_payments',
		) );

		/* Enable/Disable PayPal Sandbox */
		$wp_customize->add_setting( 'theme_enable_sandbox', array(
			'type' => 'option',
			'default' => 'false',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_enable_sandbox', array(
			'label' => __( 'Enable PayPal Sandbox for Testing', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_members_payments',
			'choices' => array(
				'true' => __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			),
		) );

		/* PayPal Payment Amount */
		$wp_customize->add_setting( 'theme_payment_amount', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'default' => '20.00',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_payment_amount', array(
			'label' => __( 'Payment Amount Per Property', 'framework' ),
			'description' => __( 'Provide the amount that you want to charge for one property. Example: 20.00', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_members_payments',
		) );

		/* PayPal Currency Code */
		$wp_customize->add_setting( 'theme_currency_code', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'default' => 'USD',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_currency_code', array(
			'label' => __( 'Currency Code', 'framework' ),
			'description' => __( 'Provide currency code that you want to use. Example: USD', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_members_payments',
		) );

		/* Enable/Disable Publish on Payment */
		$wp_customize->add_setting( 'theme_publish_on_payment', array(
			'type' => 'option',
			'default' => 'false',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_publish_on_payment', array(
			'label' => __( 'Automatically Publish Submitted Property after Payment', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_members_payments',
			'choices' => array(
				'true' => __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_payments_customizer' );
endif;


if ( ! function_exists( 'inspiry_payments_defaults' ) ) :
	/**
	 * Set default values for payments settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_payments_defaults( WP_Customize_Manager $wp_customize ) {
		$payments_settings_ids = array(
			'theme_enable_paypal',
			'theme_enable_sandbox',
			'theme_payment_amount',
			'theme_currency_code',
			'theme_publish_on_payment',
		);
		inspiry_initialize_defaults( $wp_customize, $payments_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_payments_defaults' );
endif;
