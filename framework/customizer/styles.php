<?php
/**
 * Styles Settings
 *
 * @package RH
 * @since 1.0.0
 */

if ( ! function_exists( 'inspiry_styles_customizer' ) ) :

	/**
	 * Customizer Section: Styles
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  1.0.0
	 */
	function inspiry_styles_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Styles Panel
		 */
		$wp_customize->add_panel( 'inspiry_styles_panel', array(
			'title' => esc_html__( 'Styles', 'framework' ),
			'priority' => 40,
		) );

	}

	add_action( 'customize_register', 'inspiry_styles_customizer' );
endif;

/**
 * Basic Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/basic-settings.php' );

/**
 * Core Styles
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/core-styles.php' );

/**
 * Typography
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/typography.php' );


/**
 * Header Styles
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/header-styles.php' );

/**
 * Slider
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/slider.php' );

/**
 * Banner
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/banner.php' );

/**
 * Home Page Styles
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/home-page.php' );

/**
 * Property Item
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/property-item.php' );

/**
 * Buttons
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/buttons.php' );

/**
 * News
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/news.php' );

/**
 * Gallery
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/gallery.php' );

/**
 * Footer
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/footer.php' );

/**
 * Quick CSS
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/styles/basic.php' );
