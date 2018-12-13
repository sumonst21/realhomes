<?php
/**
 * Customizer settings for Header
 */

if ( ! function_exists( 'inspiry_search_customizer' ) ) :
	function inspiry_search_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Property Panel
		 */
		$wp_customize->add_panel( 'inspiry_properties_search_panel', array(
			'title' 	=> __( 'Properties Search', 'framework' ),
			'priority' 	=> 123,
		) );

	}

	add_action( 'customize_register', 'inspiry_search_customizer' );
endif;


/**
 * Properties Search Page
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/search/properties-search-page.php' );


/**
 * Search Form Basics
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/search/search-form-basics.php' );


/**
 * Search Form Locations
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/search/search-form-locations.php' );


/**
 * Search Form Beds & Baths
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/search/search-form-bed.php' );


/**
 * Search Form Garages
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/search/search-form-garages.php' );


/**
 * Search Form Prices
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/search/search-form-prices.php' );


/**
 * Search Form Areas
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/search/search-form-areas.php' );
