<?php
/**
 * Customizer settings for Header
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_header_customizer' ) ) :
	function inspiry_header_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Header Panel
		 */
		$wp_customize->add_panel( 'inspiry_header_panel', array(
			'title' 	=> __( 'Header', 'framework' ),
			'priority'	=> 121,
		) );

	}

	add_action( 'customize_register', 'inspiry_header_customizer' );
endif;


/**
 * Social Icons
 */
if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/header/social-icons.php' );
}

/**
 * User Navigation
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/header/user-navigation.php' );


/**
 * Contact Information
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/header/contact-information.php' );


/**
 * Banner
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/header/banner.php' );


/**
 * Search Form
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/header/search-form.php' );
}


/**
 * Others
 */
if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/header/others.php' );
}

