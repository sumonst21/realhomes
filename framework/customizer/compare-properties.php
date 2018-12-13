<?php
/**
 * Section: Compare Properties
 *
 * Compare Properties customizer settings.
 *
 * @since 3.3.0
 * @package RH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'inspiry_compare_properties_section' ) ) {

	/**
	 * Compare Properties section of customizer.
	 *
	 * @param object $wp_customize — Instance of WP_Customize_Manager.
	 * @since 3.3.0
	 */
	function inspiry_compare_properties_section( WP_Customize_Manager $wp_customize ) {

		/**
		 * Favorites Panel
		 */
		global $inspiry_pages;

		/**
		 * Favorites
		 */
		$wp_customize->add_section(
			'inpsiry_compare_properties', array(
				'title' => esc_html__( 'Compare Properties', 'framework' ),
				'priority' => 126,
			)
		);

		/* Compare Properties Module  */
		$wp_customize->add_setting(
			'theme_compare_properties_module', array(
				'type'      => 'option',
				'default'   => 'disable',
			)
		);
		$wp_customize->add_control(
			'theme_compare_properties_module', array(
				'label'             => esc_html__( 'Compare Properties', 'framework' ),
				'description'       => esc_html__( 'Select to Enable or Disable Properties Compare functionality for Properties List Templates.', 'framework' ),
				'type'              => 'radio',
				'section'           => 'inpsiry_compare_properties',
				'choices'       => array(
					'enable'    => esc_html__( 'Enable', 'framework' ),
					'disable'   => esc_html__( 'Disable', 'framework' ),
				),
			)
		);

		/* Inspiry Compare Page */
		$wp_customize->add_setting(
			'inspiry_compare_page', array(
				'type'  => 'option',
			)
		);
		$wp_customize->add_control(
			'inspiry_compare_page', array(
				'label'             => esc_html__( 'Select Compare Page', 'framework' ),
				'description'       => esc_html__( 'Selected page should have Property Compare Template assigned to it. Also, make sure to Configure Pretty Permalinks.', 'framework' ),
				'type'              => 'select',
				'section'           => 'inpsiry_compare_properties',
				'active_callback'   => 'inspiry_compare_properties_enabled',
				'choices'           => $inspiry_pages,
			)
		);
	}

	add_action( 'customize_register', 'inspiry_compare_properties_section' );
}


if ( ! function_exists( 'inspiry_compare_properties_defaults' ) ) :
	/**
	 * Set default values for url slugs settings
	 *
	 * @param object $wp_customize — Instance of WP_Customize_Manager.
	 */
	function inspiry_compare_properties_defaults( WP_Customize_Manager $wp_customize ) {
		$news_settings_ids = array(
			'theme_compare_properties_module',
		);
		inspiry_initialize_defaults( $wp_customize, $news_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_compare_properties_defaults' );
endif;


if ( ! function_exists( 'inspiry_compare_properties_enabled' ) ) {
	/**
	 * Checks if compare properties is enabled or not
	 *
	 * @return true|false
	 */
	function inspiry_compare_properties_enabled() {
		$theme_compare_properties_module = get_option( 'theme_compare_properties_module' );
		if ( 'enable' === $theme_compare_properties_module ) {
			return true;
		}
		return false;
	}
}
