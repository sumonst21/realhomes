<?php
/**
 * Section:	`Attachments`
 * Panel: 	`Property Detail Page`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_property_attachments_customizer' ) ) :

	/**
	 * inspiry_property_attachments_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_property_attachments_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Attachments Section
		 */

		$wp_customize->add_section( 'inspiry_property_attachments', array(
			'title' => __( 'Attachments', 'framework' ),
			'panel' => 'inspiry_property_panel',
		) );

		/* Show/Hide Attachments */
		$wp_customize->add_setting( 'theme_display_attachments', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_display_attachments', array(
			'label' => __( 'Property Attachments', 'framework' ),
			'description' => __( 'Attachments will only appear if there are any.', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_property_attachments',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* Attachments Title */
		$wp_customize->add_setting( 'theme_property_attachments_title', array(
			'type' 				=> 'option',
			'transport' 		=> 'postMessage',
			'default' 			=> __( 'Property Attachments', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_property_attachments_title', array(
			'label' => __( 'Property Attachments Title', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_property_attachments',
		) );

		/* Attachments Title Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$attachments_title_selector = '.attachments-wrap .attachments-label';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$attachments_title_selector = '.rh_property__attachments_wrap .rh_property__heading';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_property_attachments_title', array(
				'selector' 				=> $attachments_title_selector,
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_property_attachments_title_render',
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_property_attachments_customizer' );
endif;


if ( ! function_exists( 'inspiry_property_attachments_defaults' ) ) :

	/**
	 * inspiry_property_attachments_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_property_attachments_defaults( WP_Customize_Manager $wp_customize ) {
		$property_attachments_settings_ids = array(
			'theme_display_attachments',
			'theme_property_attachments_title',
		);
		inspiry_initialize_defaults( $wp_customize, $property_attachments_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_property_attachments_defaults' );
endif;


if ( ! function_exists( 'inspiry_property_attachments_title_render' ) ) {
	function inspiry_property_attachments_title_render() {
		if ( get_option( 'theme_property_attachments_title' ) ) {
			echo esc_html( get_option( 'theme_property_attachments_title' ) );
		}
	}
}
