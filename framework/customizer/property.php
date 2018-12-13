<?php
/**
 * Property Customizer
 */


if ( ! function_exists( 'inspiry_property_customizer' ) ) :
	function inspiry_property_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Property Panel
		 */

		$wp_customize->add_panel( 'inspiry_property_panel', array(
			'title' => __( 'Property Detail Page', 'framework' ),
			'priority' => 126,
		) );

	}

	add_action( 'customize_register', 'inspiry_property_customizer' );
endif;


/**
 * Breadcrumbs
 */
//if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/breadcrumbs.php' );
//}


/**
 * Basics
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/basics.php' );


/**
 * Common Note
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/common-note.php' );


/**
 * Property Video
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/video.php' );

/**
 * Property Video
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/virtual-tour.php' );


/**
 * Property Map
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/map.php' );


/**
 * Attachments
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/attachments.php' );


/**
 * Agent
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/agent.php' );


/**
 * Similar Properties
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/property/similar-properties.php' );