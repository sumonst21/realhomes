<?php
/**
 * Customizer
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_customize_register_init' ) ) {
	/**
	 * Modify default customizer settings
	 */
	function inspiry_customize_register_init( $wp_customize ) {

		$wp_customize->get_section( 'background_image' )->panel = 'inspiry_styles_panel';
	}

	add_action( 'customize_register', 'inspiry_customize_register_init' );
}

if ( ! function_exists( 'inspiry_initialize_defaults' ) ) :
	/**
	 * Helper function to initialize default values for settings as customizer api do not do so by default.
	 *
	 * @param WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @param $inspiry_settings_ids - Settings ID of the theme.
	 *
	 * @since 1.0.0
	 */
	function inspiry_initialize_defaults( WP_Customize_Manager $wp_customize, $inspiry_settings_ids ) {
		if ( is_array( $inspiry_settings_ids ) && ! empty( $inspiry_settings_ids ) ) {
			foreach ( $inspiry_settings_ids as $setting_id ) {
				$setting = $wp_customize->get_setting( $setting_id );
				if ( $setting ) {
					add_option( $setting->id, $setting->default );
				}
			}
		}
	}
endif;


if ( ! function_exists( 'inspiry_enqueue_customizer_js' ) ) :
	/**
	 * Enqueue Customizer JS file.
	 *
	 * @todo Figure out why postMessage method isn't working.
	 * @since 4.6.2
	 */
	function inspiry_enqueue_customizer_js() {
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			wp_enqueue_script(
				'customizer_js',
				get_template_directory_uri() . '/framework/customizer/js/customizer.js',
				array( 'jquery', 'customize-preview' ),
				'',
				true
			);
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			wp_enqueue_script(
				'customizer_js',
				get_template_directory_uri() . '/assets/modern/scripts/js/customizer.js',
				array( 'jquery', 'customize-preview' ),
				'',
				true
			);
		}
	}

	add_action( 'customize_preview_init', 'inspiry_enqueue_customizer_js', 100, 0 );
endif;


/**
 * Load custom controls
 */
if ( ! function_exists( 'inspiry_load_customize_controls' ) ) :

	/**
	 * Custom Controls of Customizer.
	 *
	 * @since  1.0.0
	 */
	function inspiry_load_customize_controls() {
		require_once( INSPIRY_FRAMEWORK . 'customizer/custom/control-multiple-checkbox.php' );
		require_once( INSPIRY_FRAMEWORK . 'customizer/custom/control-heading.php' );
		require_once( INSPIRY_FRAMEWORK . 'customizer/custom/control-intro-text.php' );
		require_once( INSPIRY_FRAMEWORK . 'customizer/custom/control-separator.php' );
		require_once( INSPIRY_FRAMEWORK . 'customizer/custom/control-dragdrop.php' );
	}

	add_action( 'customize_register', 'inspiry_load_customize_controls', 0 );
endif;

/**
 * Remove Default Customizer Panel
 */
if ( ! function_exists( 'inspiry_remove_default_panels' ) ) :

	/**
	 * Remove Default Panel of Customizer.
	 *
	 * @since  1.0.0
	 */
	function inspiry_remove_default_panels( WP_Customize_Manager $wp_customize ) {
		$wp_customize->remove_section( "colors" );
	}

	add_action( 'customize_register', 'inspiry_remove_default_panels' );
endif;


/**
 * Create a pages array named $inspiry_pages, This array can be used at multiple places
 */
$inspiry_pages = array( 0 => __( 'None', 'framework' ) );
$raw_pages     = get_pages();
if ( 0 < count( $raw_pages ) ) {
	foreach ( $raw_pages as $single_page ) {
		$inspiry_pages[ $single_page->ID ] = $single_page->post_title;
	}
}


/**
 * Site Logo
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/site-logo.php' );


/**
 * Header Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/header.php' );


/**
 * Home Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/home.php' );


/**
 * Properties Search Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/search.php' );


/**
 * Price Format Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/price-format.php' );


/**
 * Currency Switcher Settings
 * only if wp-currencies plugins is active
 */
if ( class_exists( 'WP_Currencies' ) ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/currency-switcher.php' );
}


/**
 * Property Detail Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/property.php' );


/**
 * Blog/News Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/news.php' );


/**
 * Gallery Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/gallery.php' );


/**
 * Agents Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/agents.php' );

/**
 * Agencies Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/agencies.php' );


/**
 * Contact Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/contact.php' );


/**
 * Properties List and Taxonomy Archive Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/list-and-taxonomy.php' );


/**
 * Misc Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/misc.php' );

/**
 * GDPR Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/gdpr.php' );

/**
 * Footer Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/footer.php' );


/**
 * Members Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/members.php' );


/**
 * Compare Properties Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/compare-properties.php' );


/**
 * Favorites Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/favorites.php' );


/**
 * Payments Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/payments.php' );


/**
 * URL Slugs Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/url-slugs.php' );


/**
 * Styles Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/styles.php' );
