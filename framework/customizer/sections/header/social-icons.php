<?php
/**
 * Section:	`Social Icons`
 * Panel: 	`Header`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_social_icons_customizer' ) ) :

	/**
	 * inspiry_social_icons_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_social_icons_customizer( WP_Customize_Manager $wp_customize ) {

		// Get design variation.
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$panel = 'inspiry_header_panel';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$panel = 'inspiry_footer_panel';
		}

		/**
		 * Social Icons Section
		 */
		$wp_customize->add_section( 'inspiry_header_social_icons', array(
			'title' => __( 'Social Icons', 'framework' ),
			'panel' => $panel,
		) );

		/* Enable/Disable Social Icons */
		$wp_customize->add_setting( 'theme_show_social_menu', array(
			'type' 		=> 'option',
			'default' 	=> 'true',
		) );
		$wp_customize->add_control( 'theme_show_social_menu', array(
			'label' 	=> __( 'Show or Hide Social Icons', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_header_social_icons', // Required, core or custom.
			'choices' 	=> array(
				'true' 	=> __( 'Show', 'framework' ),
				'false'	=> __( 'Hide', 'framework' ),
			),
		) );

		/* Facebook URL */
		$wp_customize->add_setting( 'theme_facebook_link', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_facebook_link', array(
			'label' 	=> __( 'Facebook URL', 'framework' ),
			'type' 		=> 'url',
			'section' 	=> 'inspiry_header_social_icons',
		) );

		/* Twitter URL */
		$wp_customize->add_setting( 'theme_twitter_link', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_twitter_link', array(
			'label' 	=> __( 'Twitter URL', 'framework' ),
			'type' 		=> 'url',
			'section' 	=> 'inspiry_header_social_icons',
		) );

		/* LinkedIn URL */
		$wp_customize->add_setting( 'theme_linkedin_link', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_linkedin_link', array(
			'label' 	=> __( 'LinkedIn URL', 'framework' ),
			'type' 		=> 'url',
			'section' 	=> 'inspiry_header_social_icons',
		) );

		/* Google Plus URL */
		$wp_customize->add_setting( 'theme_google_link', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_google_link', array(
			'label' 	=> __( 'Google Plus URL', 'framework' ),
			'type' 		=> 'url',
			'section' 	=> 'inspiry_header_social_icons',
		) );

		/* Instagram URL */
		$wp_customize->add_setting( 'theme_instagram_link', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_instagram_link', array(
			'label' 	=> __( 'Instagram URL', 'framework' ),
			'type' 		=> 'url',
			'section' 	=> 'inspiry_header_social_icons',
		) );

		/* YouTube URL */
		$wp_customize->add_setting( 'theme_youtube_link', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_youtube_link', array(
			'label' 	=> __( 'YouTube URL', 'framework' ),
			'type' 		=> 'url',
			'section' 	=> 'inspiry_header_social_icons',
		) );

		/* Skype Username */
		$wp_customize->add_setting( 'theme_skype_username', array(
			'type' 		=> 'option',
			'transport'	=> 'postMessage',
		) );
		$wp_customize->add_control( 'theme_skype_username', array(
			'label' 	=> __( 'Skype Username', 'framework' ),
			'type' 		=> 'text',
			'section' 	=> 'inspiry_header_social_icons',
		) );

		/* Pinterest URL */
		$wp_customize->add_setting( 'theme_pinterest_link', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_pinterest_link', array(
			'label' 	=> __( 'Pinterest URL', 'framework' ),
			'type' 		=> 'url',
			'section' 	=> 'inspiry_header_social_icons',
		) );

		/* RSS URL */
		$wp_customize->add_setting( 'theme_rss_link', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_rss_link', array(
			'label' 	=> __( 'RSS URL', 'framework' ),
			'type' 		=> 'url',
			'section'	=> 'inspiry_header_social_icons',
		) );

	}

	add_action( 'customize_register', 'inspiry_social_icons_customizer' );
endif;


if ( ! function_exists( 'inspiry_social_icons_defaults' ) ) :

	/**
	 * inspiry_social_icons_defaults.
	 *
	 * @since  2.6.3
	 */
	function inspiry_social_icons_defaults( WP_Customize_Manager $wp_customize ) {
		$social_icons_settings_ids = array(
			'theme_show_social_menu'
		);
		inspiry_initialize_defaults( $wp_customize, $social_icons_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_social_icons_defaults' );
endif;
