<?php
/**
 * Design Page: Init
 *
 * Init file for design page.
 *
 * @since 	3.0.0
 * @package RH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class for design page.
 *
 * @since 3.0.0
 */
if ( file_exists( INSPIRY_FRAMEWORK . 'include/design-page/class-design-page.php' ) ) {
	require_once( INSPIRY_FRAMEWORK . 'include/design-page/class-design-page.php' );
}

if ( class_exists( 'RH_Design_Page' ) ) {

	add_action( 'admin_menu', array( 'RH_Design_Page', 'add_to_admin_menu' ) );

	add_action( 'admin_enqueue_scripts', array( 'RH_Design_Page', 'enqueue_design_page_styles' ), 10, 1 );

	// add_action( 'admin_enqueue_scripts', array( 'RH_Design_Page', 'enqueue_welcome_page_scripts' ), 10, 1 );

}
