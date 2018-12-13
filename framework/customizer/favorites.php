<?php
/**
 * Section: Favorites
 *
 * Favorites customizer settings.
 *
 * @since 3.3.0
 * @package RH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'inspiry_favorites_section' ) ) {

	/**
	 * Favorites section of customizer.
	 *
	 * @param object $wp_customize — Instance of WP_Customize_Manager.
	 * @since 3.3.0
	 */
	function inspiry_favorites_section( WP_Customize_Manager $wp_customize ) {

		/**
		 * Favorites Panel
		 */
		global $inspiry_pages;

		/**
		 * Favorites
		 */
		$wp_customize->add_section( 'inspiry_members_favorites', array(
			'title' => __( 'Favorites', 'framework' ),
			'priority' => 127,
		) );

		/* Enable/Disable Add to Favorites */
		$wp_customize->add_setting( 'theme_enable_fav_button', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_enable_fav_button', array(
			'label' => __( 'Add to Favorites Button on Property Detail Page', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_members_favorites',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* My Favorites Page */
		$wp_customize->add_setting( 'inspiry_favorites_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_favorites_page', array(
			'label' => __( 'Select Favorite Properties Page','framework' ),
			'description' => __( 'Selected page should have Favorite Properties Template assigned to it.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_members_favorites',
			'choices' => $inspiry_pages,
		) );

	}

	add_action( 'customize_register', 'inspiry_favorites_section' );
}


if ( ! function_exists( 'inspiry_favorites_section_defaults' ) ) :
	/**
	 * Set default values for url slugs settings
	 *
	 * @param object $wp_customize — Instance of WP_Customize_Manager.
	 */
	function inspiry_favorites_section_defaults( WP_Customize_Manager $wp_customize ) {
		$news_settings_ids = array(
			'theme_enable_fav_button',
		);
		inspiry_initialize_defaults( $wp_customize, $news_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_favorites_section_defaults' );
endif;
