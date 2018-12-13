<?php
/**
 * GDPR Customizer Settings
 *
 * @since 3.5.1
 * @package RH
 */

if ( ! function_exists( 'inspiry_gdpr_customizer' ) ) :
	function inspiry_gdpr_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * GDPR Section
		 */
		$wp_customize->add_section( 'inspiry_gdpr_section', array(
			'title'    => __( 'GDPR', 'framework' ),
			'priority' => 140,
		) );

		/* Enable / Disable GDPR on theme forms */
		$wp_customize->add_setting( 'inspiry_gdpr', array(
			'type'    => 'option',
			'default' => '0',
		) );
		$wp_customize->add_control( 'inspiry_gdpr', array(
			'label'       => __( 'Add GDPR agreement checkbox in forms across website?', 'framework' ),
			'type'        => 'radio',
			'section'     => 'inspiry_gdpr_section',
			'choices'     => array(
				'1' => __( 'Yes', 'framework' ),
				'0' => __( 'No', 'framework' ),
			),
		) );

		/* Contact form GDPR checkbox label */
		$wp_customize->add_setting( 'inspiry_gdpr_label', array(
			'type'              => 'option',
			'default'           => __( 'GDPR Agreement', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_gdpr_label', array(
			'label'           => __( 'GDPR agreement checkbox label', 'framework' ),
			'type'            => 'text',
			'section'         => 'inspiry_gdpr_section',
			'active_callback' => 'inspiry_gdpr_status',
		) );

		/* Contact form GDPR checkbox text */
		$wp_customize->add_setting( 'inspiry_gdpr_text', array(
			'type'              => 'option',
			'default'           => __( 'I consent to having this website store my submitted information so they can respond to my inquiry.', 'framework' ),
			'sanitize_callback' => 'inspiry_sanitize_gdpr_text_field',
		) );
		$wp_customize->add_control( 'inspiry_gdpr_text', array(
			'label'           => __( 'GDPR agreement checkbox text', 'framework' ),
			'description'     => '<strong>' . __( 'Note:', 'framework' ) . ' </strong>' . esc_html__( 'You can use <a> tag in your GDPR agreement checkbox text.', 'framework' ),
			'type'            => 'textarea',
			'section'         => 'inspiry_gdpr_section',
			'active_callback' => 'inspiry_gdpr_status',
		) );

		/* Contact form GDPR validation text */
		$wp_customize->add_setting( 'inspiry_gdpr_validation_text', array(
			'type'              => 'option',
			'default'           => __( '* Please accept GDPR agreement', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_gdpr_validation_text', array(
			'label'           => __( 'GDPR agreement checkbox validation message', 'framework' ),
			'type'            => 'text',
			'section'         => 'inspiry_gdpr_section',
			'active_callback' => 'inspiry_gdpr_status',
		) );

		/* Enable / Disable GDPR on in contact form emails */
		$wp_customize->add_setting( 'inspiry_gdpr_in_email', array(
			'type'    => 'option',
			'default' => '0',
		) );
		$wp_customize->add_control( 'inspiry_gdpr_in_email', array(
			'label'           => __( 'Add GDPR detail in resulting email?', 'framework' ),
			'type'            => 'radio',
			'section'         => 'inspiry_gdpr_section',
			'choices'         => array(
				'1'  => __( 'Yes', 'framework' ),
				'0' => __( 'No', 'framework' ),
			),
			'active_callback' => 'inspiry_gdpr_status',
		) );
	}

	add_action( 'customize_register', 'inspiry_gdpr_customizer' );
endif;

if ( ! function_exists( 'inspiry_gdpr_status' ) ) {
	/**
	 * Check GDPR field enabled/disabled status
	 *
	 * @return bool
	 */
	function inspiry_gdpr_status() {

		$inspiry_gdpr = get_option( 'inspiry_gdpr', 0 );

		if ( $inspiry_gdpr ) {
			return true;
		}

		return false;
	}
}

if( ! function_exists( 'inspiry_sanitize_gdpr_text_field' ) ) {
	/**
	 * Sanitize GDPR text before it is inserted into the database
	 *
	 * @param $gdpr_text
	 *
	 * @return string
	 */
	function inspiry_sanitize_gdpr_text_field( $gdpr_text ) {
		$gdpr_text = wp_kses( $gdpr_text, array(
			'a' => array(
				'href'   => array(),
				'target' => array(),
				'title'  => array()
			)
		) );

		return $gdpr_text;
	}
}
