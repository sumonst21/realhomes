<?php
/**
 * Design page class file
 *
 * Class file for design page of plugin.
 *
 * @since 	3.0.0
 * @package RH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'RH_Design_Page' ) ) :

	/**
	 * RH_Design_Page.
	 *
	 * Class for design page for the theme.
	 *
	 * @since 3.0.0
	 */
	class RH_Design_Page {

		/**
		 * Design Page.
		 *
		 * @var 	string
		 * @since 	3.0.0
		 */
		protected static $_design_page;

		/**
		 * Method: Add design page to admin menu.
		 *
		 * @since 3.0.0
		 */
		public static function add_to_admin_menu() {

			$design_sub_menu	= add_submenu_page(
				'edit.php?post_type=property',
				__( 'Real Homes Design', 'framework' ),
				__( 'Real Homes Design', 'framework' ),
				'manage_options',
				'inspiry-real-homes-design',
				array( __CLASS__, 'design_page_content' )
			);
			self::$_design_page = $design_sub_menu;

		}

		/**
		 * Method: Design page content.
		 *
		 * @since 3.0.0
		 */
		public static function design_page_content() {

			if ( file_exists( INSPIRY_FRAMEWORK . 'include/design-page/design-page.php' ) ) {
			    include_once( INSPIRY_FRAMEWORK . 'include/design-page/design-page.php' );
			}

		}

		/**
		 * Method: Enqueue styles for design page.
		 *
		 * @param string $hook - Hook for admin page.
		 * @since 3.0.0
		 */
		public static function enqueue_design_page_styles( $hook ) {

			// Add style to the design page only.
			if ( $hook !== self::$_design_page ) {
				return;
			}

			// Welcome page styles.
			wp_enqueue_style(
				'rh_design_style',
				get_template_directory_uri() . '/framework/include/admin/inspiry-design-page.css',
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

		}

		/**
		 * Method: Enqueue scripts for design page.
		 *
		 * @param string $hook - Hook for admin page.
		 * @since 3.0.0
		 */
		public static function enqueue_design_page_scripts( $hook ) {

			// Add script to the design page only.
			// if ( $hook !== self::$_design_page ) {
			// 	return;
			// }

			// // JS functions file.
	  //       wp_register_script(
	  //           'ims-design-js',
	  //           IMS_BASE_URL . 'resources/js/design.js',
	  //           array( 'jquery' ),
	  //           IMS_VERSION,
	  //           true
	  //       );

	  //       // Data to print in JavaScript format above edit profile script tag in HTML.
	  //       $ims_js_data 	= array(
	  //           'ajaxURL'	=> admin_url( 'admin-ajax.php' ),
	  //       );

	  //       wp_localize_script( 'ims-design-js', 'jsData', $ims_js_data );
	  //       wp_enqueue_script( 'ims-design-js' );

		}

	}

endif;
