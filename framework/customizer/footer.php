<?php
/**
 * Footer Customizer Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_footer_customizer' ) ) :
	function inspiry_footer_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Footer Panel
		 */
		$wp_customize->add_panel( 'inspiry_footer_panel', array(
			'title' 	=> __( 'Footer', 'framework' ),
			'priority' 	=> 125,
		) );

	}

	add_action( 'customize_register', 'inspiry_footer_customizer' );
endif;


/**
 * Partners
 */
if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/partners.php' );
}

/**
 * Logo
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/logo.php' );
}

/**
 * Text
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/text.php' );

/**
 * Social Icons
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/header/social-icons.php' );
}


/**
 * Layout
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/footer/layout.php' );

