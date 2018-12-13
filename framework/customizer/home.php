<?php
/**
 * Home Customizer
 *
 * @package RH
 * @since 1.0.0
 */

if ( ! function_exists( 'inspiry_home_customizer' ) ) :
	function inspiry_home_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Panel
		 */
		$wp_customize->add_panel( 'inspiry_home_panel', array(
			'title' => __( 'Home Page', 'framework' ),
			'priority' => 122,
		) );

	}

	add_action( 'customize_register', 'inspiry_home_customizer' );
endif;

/**
 * Sections Manager
 */
if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/sections-manager.php' );
}

/**
 * Slider Area
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/slider-area.php' );

/**
 * Search Form
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/search-form.php' );

/**
 * Slogan
 */
if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/slogan.php' );
}

/**
 * Home Properties
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/home-properties.php' );

/**
 * Features Section
 */
if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/features-section.php' );
}

/**
 * Featured Properties
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/featured-properties.php' );

/**
 * News or Blog Posts
 */
if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/news-posts.php' );
}

/**
 * Testimonial Section
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/testimonial.php' );
}

/**
 * CTA Section
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/cta.php' );
}

/**
 * Agents Section
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/home-agents.php' );
}

/**
 * Home Features Section
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/home-features.php' );
}

/**
 * Partners Section
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/partners.php' );
}

/**
 * CTA Contact Section
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/cta-contact.php' );
}

/**
 * Home General Section
 */
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/sections/home/home-general.php' );
}
