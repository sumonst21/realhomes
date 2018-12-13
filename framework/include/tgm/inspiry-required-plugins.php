<?php
/**
 * Required Plugins File
 *
 * Include the TGM_Plugin_Activation class.
 *
 * @since 	1.0.0
 * @package RH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'inspiry_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function inspiry_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(


		// Classic Editor.
		array(
			'name'      => 'Classic Editor',
			'slug'      => 'classic-editor',
			'required'  => true,
		),

	    // One Click Demo Import.
	    array(
	        'name'      => 'One Click Demo Import',
	        'slug'      => 'one-click-demo-import', // The plugin slug (typically the folder name).
	        'required'  => false, // If false, the plugin is only 'recommended' instead of required.
	    ),

		// Mortgage calculator
		array(
			'name'      => 'Mortgage Calculator',
			'slug'      => 'mortgage-calculator',
			'required'  => false,
		),

		// Quick and Easy FAQs
		array(
			'name'      => 'Quick and Easy FAQs',
			'slug'      => 'quick-and-easy-faqs',
			'required'  => false,
		),

		// Quick and Easy FAQs
		array(
			'name'      => 'Quick and Easy Testimonials',
			'slug'      => 'quick-and-easy-testimonials',
			'required'  => false,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
	    'id'           => 'inspiry',               // Unique ID for hashing notices for multiple instances of TGMPA.
	    'default_path' => '',                      // Default absolute path to bundled plugins.
	    'menu'         => 'tgmpa-install-plugins', // Menu slug.
	    'has_notices'  => true,                    // Show admin notices or not.
	    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
	    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
	    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
	    'message'      => '',                      // Message to output right before the plugins table.

	    /*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'inspiry' ),
			'menu_title'                      => __( 'Install Plugins', 'inspiry' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'inspiry' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'inspiry' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'inspiry' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'inspiry'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'inspiry'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'inspiry'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'inspiry'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'inspiry'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'inspiry'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'inspiry'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'inspiry'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'inspiry'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'inspiry' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'inspiry' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'inspiry' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'inspiry' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'inspiry' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'inspiry' ),
			'dismiss'                         => __( 'Dismiss this notice', 'inspiry' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'inspiry' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'inspiry' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );

}
