<?php
/**
 * Section: `Agent`
 * Panel:   `Property Detail Page`
 *
 * @package RH
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_property_agent_customizer' ) ) :

	/**
	 * inspiry_property_agent_customizer.
	 *
	 * @param  object $wp_customize - Instance of WP_Customize_Manager.
	 * @since  2.6.3
	 */
	function inspiry_property_agent_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Agent Section
		 */
		$wp_customize->add_section( 'inspiry_property_agent', array(
			'title' => __( 'Agent', 'framework' ),
			'panel' => 'inspiry_property_panel',
		) );

		/* Show/Hide Agent Information */
		$wp_customize->add_setting( 'theme_display_agent_info', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_display_agent_info', array(
			'label' => __( 'Agent Information', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_property_agent',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* Show/Hide Agent Contact Form */
		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting( 'inspiry_property_agent_form', array(
				'type' => 'option',
				'default' => 'true',
			) );
			$wp_customize->add_control( 'inspiry_property_agent_form', array(
				'label' => __( 'Agent Contact Form', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_property_agent',
				'choices' => array(
					'true' => __( 'Show', 'framework' ),
					'false' => __( 'Hide', 'framework' ),
				),
			) );
		}

		/* Enable/Disable Message Copy */
		$wp_customize->add_setting( 'theme_send_message_copy', array(
			'type' => 'option',
			'default' => 'false',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_send_message_copy', array(
			'label' => __( 'Get Copy of Message Sent to Agent', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_property_agent',
			'choices' => array(
				'true' => __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			),
		) );

		/* Email Address to Get a Copy of Agent Message */
		$wp_customize->add_setting( 'theme_message_copy_email', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_message_copy_email', array(
			'label' => __( 'Email Address to Get Copy of Message', 'framework' ),
			'description' => __( 'Given email address will get a copy of message sent to agent.', 'framework' ),
			'type' => 'email',
			'section' => 'inspiry_property_agent',
		) );

	}

	add_action( 'customize_register', 'inspiry_property_agent_customizer' );
endif;


if ( ! function_exists( 'inspiry_property_agent_defaults' ) ) :

	/**
	 * inspiry_property_agent_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_property_agent_defaults( WP_Customize_Manager $wp_customize ) {
		$property_agent_settings_ids = array(
			'theme_display_agent_info',
			'theme_send_message_copy',
			'inspiry_property_agent_form',
		);
		inspiry_initialize_defaults( $wp_customize, $property_agent_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_property_agent_defaults' );
endif;
