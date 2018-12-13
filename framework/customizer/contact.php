<?php
/**
 * Contact Page Customizer Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_contact_customizer' ) ) :
	function inspiry_contact_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Contact Section
		 */
		$wp_customize->add_section( 'inspiry_contact_section', array(
			'title' => __( 'Contact Page', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_contact_header_variation', array(
				'type'    => 'option',
				'default' => 'banner',
			) );

			$wp_customize->add_control( 'inspiry_contact_header_variation', array(
				'label'       => __( 'Header Variation', 'framework' ),
				'description' => __( 'Header variation to display on Contact Page.', 'framework' ),
				'type'        => 'radio',
				'section'     => 'inspiry_contact_section',
				'choices'     => array(
					'banner' => __( 'Banner', 'framework' ),
					'none'   => __( 'None', 'framework' ),
				),
			) );
		}

		/* Show / Hide Google Map */
		$wp_customize->add_setting( 'theme_show_contact_map', array(
			'type'    => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_show_contact_map', array(
			'label'   => __( 'Google Map on Contact Page', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_contact_section',
			'choices' => array(
				'true'  => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* Google Map Latitude */
		$wp_customize->add_setting( 'theme_map_lati', array(
			'type'              => 'option',
			'default'           => '-37.817917',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_map_lati', array(
			'label'       => __( 'Google Map Latitude', 'framework' ),
			'description' => 'You can use <a href="http://www.latlong.net/" target="_blank">latlong.net</a> OR <a href="http://itouchmap.com/latlong.html" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.',
			'type'        => 'text',
			'section'     => 'inspiry_contact_section',
		) );

		/* Google Map Longitude */
		$wp_customize->add_setting( 'theme_map_longi', array(
			'type'              => 'option',
			'default'           => '144.965065',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_map_longi', array(
			'label'   => __( 'Google Map Longitude', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_contact_section',
		) );

		/* Google Map Zoom */
		$wp_customize->add_setting( 'theme_map_zoom', array(
			'type'              => 'option',
			'default'           => '17',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_map_zoom', array(
			'label'       => __( 'Google Map Zoom Level', 'framework' ),
			'description' => __( 'Provide Google Map Zoom Level.', 'framework' ),
			'type'        => 'number',
			'section'     => 'inspiry_contact_section',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_map_zoom_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_map_zoom_separator',
				array(
					'section' => 'inspiry_contact_section',
				)
			)
		);

		/* Show / Hide Contact Details */
		$wp_customize->add_setting( 'theme_show_details', array(
			'type'    => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_show_details', array(
			'label'   => __( 'Contact Details', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_contact_section',
			'choices' => array(
				'true'  => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* Contact Details Title */
		$wp_customize->add_setting( 'theme_contact_details_title', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_details_title', array(
			'label'   => __( 'Contact Details Title', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_contact_section',
		) );

		/* Contact Details Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_contact_details_title', array(
				'selector'            => '.contact-details h3',
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_contact_details_title_render',
			) );
		}

		/* Contact Address */
		$wp_customize->add_setting( 'theme_contact_address', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'theme_contact_address', array(
			'label'   => __( 'Contact Address', 'framework' ),
			'type'    => 'textarea',
			'section' => 'inspiry_contact_section',
		) );

		/* Contact Address Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_contact_address', array(
				'selector'            => '.contact-details .contacts-list li.address',
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_contact_address_render',
			) );
		}

		/* Cell Number */
		$wp_customize->add_setting( 'theme_contact_cell', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_cell', array(
			'label'   => __( 'Cell Number', 'framework' ),
			'type'    => 'tel',
			'section' => 'inspiry_contact_section',
		) );

		/* Cell Number Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_contact_cell', array(
				'selector'            => '.contact-details .contacts-list li.mobile',
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_contact_cell_render',
			) );
		}

		/* Phone Number */
		$wp_customize->add_setting( 'theme_contact_phone', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_phone', array(
			'label'   => __( 'Phone Number', 'framework' ),
			'type'    => 'tel',
			'section' => 'inspiry_contact_section',
		) );

		/* Phone Number Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_contact_phone', array(
				'selector'            => '.contact-details .contacts-list li.phone',
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_contact_phone_render',
			) );
		}

		/* Fax Number */
		$wp_customize->add_setting( 'theme_contact_fax', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_fax', array(
			'label'   => __( 'Fax Number', 'framework' ),
			'type'    => 'tel',
			'section' => 'inspiry_contact_section',
		) );

		/* Fax Number Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_contact_fax', array(
				'selector'            => '.contact-details .contacts-list li.fax',
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_contact_fax_render',
			) );
		}

		/* Display Email */
		$wp_customize->add_setting( 'theme_contact_display_email', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_display_email', array(
			'label'   => __( 'Display Email', 'framework' ),
			'desc'    => __( 'Provide Email that will be displayed in contact details section.', 'framework' ),
			'type'    => 'email',
			'section' => 'inspiry_contact_section',
		) );

		/* Display Email Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_contact_display_email', array(
				'selector'            => '.contact-details .contacts-list li.email',
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_contact_display_email_render',
			) );
		}

		/* Separator */
		$wp_customize->add_setting( 'inspiry_contact_form_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_contact_form_separator',
				array(
					'section' => 'inspiry_contact_section',
				)
			)
		);

		/* Contact Form Heading */
		$wp_customize->add_setting( 'theme_contact_form_heading', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_form_heading', array(
			'label'   => __( 'Contact Form Heading', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_contact_section',
		) );

		/* Contact Form Heading Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_contact_form_heading', array(
				'selector'            => '#contact-form h3.form-heading',
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_contact_form_heading_render',
			) );
		}

		/* Contact Form Email */
		$wp_customize->add_setting( 'theme_contact_email', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => get_option( 'admin_email' ),
		) );
		$wp_customize->add_control( 'theme_contact_email', array(
			'label'       => __( 'Contact Form Email', 'framework' ),
			'description' => __( 'Provide email address that will get messages from contact form.', 'framework' ),
			'type'        => 'email',
			'section'     => 'inspiry_contact_section',
		) );

		/* Contact Form CC Email */
		$wp_customize->add_setting( 'theme_contact_cc_email', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_cc_email', array(
			'label'       => __( 'Contact Form CC Email', 'framework' ),
			'description' => __( 'You can add multiple comma separated cc email addresses, to get a carbon copy of contact form message.', 'framework' ),
			'type'        => 'email',
			'section'     => 'inspiry_contact_section',
		) );

		/* Contact Form BCC Email */
		$wp_customize->add_setting( 'theme_contact_bcc_email', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_bcc_email', array(
			'label'       => __( 'Contact Form BCC Email', 'framework' ),
			'description' => __( 'You can add multiple comma separated bcc email addresses, to get a blind carbon copy of contact form message.', 'framework' ),
			'type'        => 'email',
			'section'     => 'inspiry_contact_section',
		) );

		/* Contact Form Shortcode */
		$wp_customize->add_setting( 'inspiry_contact_form_shortcode', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_contact_form_shortcode', array(
			'label'       => __( 'Contact Form Shortcode ( To Replace Default Form )', 'framework' ),
			'description' => __( 'If you want to replace default contact form with a plugin based form then provide its shortcode here.', 'framework' ),
			'type'        => 'text',
			'section'     => 'inspiry_contact_section',
		) );

	}

	add_action( 'customize_register', 'inspiry_contact_customizer' );
endif;


if ( ! function_exists( 'inspiry_contact_defaults' ) ) :
	/**
	 * Set default values for contact settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_contact_defaults( WP_Customize_Manager $wp_customize ) {
		$contact_settings_ids = array(
			'inspiry_contact_header_variation',
			'theme_show_contact_map',
			'theme_map_lati',
			'theme_map_longi',
			'theme_map_zoom',
			'theme_show_details',
			'theme_contact_email',
		);
		inspiry_initialize_defaults( $wp_customize, $contact_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_contact_defaults' );
endif;


if ( ! function_exists( 'inspiry_contact_details_title_render' ) ) {
	function inspiry_contact_details_title_render() {
		if ( get_option( 'theme_contact_details_title' ) ) {
			echo get_option( 'theme_contact_details_title' );
		}
	}
}


if ( ! function_exists( 'inspiry_contact_address_render' ) ) {
	function inspiry_contact_address_render() {
		if ( get_option( 'theme_contact_address' ) ) {
			include( INSPIRY_THEME_DIR . '/images/icon-map.svg' );
			_e( 'Address', 'framework' );
			echo ': ' . get_option( 'theme_contact_address' );
		}
	}
}


if ( ! function_exists( 'inspiry_contact_cell_render' ) ) {
	function inspiry_contact_cell_render() {
		if ( get_option( 'theme_contact_cell' ) ) {
			$contact_cell    = get_option( 'theme_contact_cell' );
			$desktop_version = '<span class="desktop-version">' . $contact_cell . '</span>';
			$mobile_version  = '<a class="mobile-version" href="tel://' . $contact_cell . '" title="Make a Call">' . $contact_cell . '</a>';
			include( INSPIRY_THEME_DIR . '/images/icon-mobile.svg' );
			_e( 'Mobile', 'framework' );
			echo ': ' . $desktop_version . $mobile_version;
		}
	}
}


if ( ! function_exists( 'inspiry_contact_phone_render' ) ) {
	function inspiry_contact_phone_render() {
		if ( get_option( 'theme_contact_phone' ) ) {
			$contact_phone   = get_option( 'theme_contact_phone' );
			$desktop_version = '<span class="desktop-version">' . $contact_phone . '</span>';
			$mobile_version  = '<a class="mobile-version" href="tel://' . $contact_phone . '" title="Make a Call">' . $contact_phone . '</a>';
			include( INSPIRY_THEME_DIR . '/images/icon-phone.svg' );
			_e( 'Phone', 'framework' );
			echo ': ' . $desktop_version . $mobile_version;
		}
	}
}


if ( ! function_exists( 'inspiry_contact_fax_render' ) ) {
	function inspiry_contact_fax_render() {
		if ( get_option( 'theme_contact_fax' ) ) {
			include( INSPIRY_THEME_DIR . '/images/icon-printer.svg' );
			_e( 'Fax', 'framework' );
			echo ': ' . get_option( 'theme_contact_fax' );
		}
	}
}


if ( ! function_exists( 'inspiry_contact_display_email_render' ) ) {
	function inspiry_contact_display_email_render() {
		if ( get_option( 'theme_contact_email' ) ) {
			include( INSPIRY_THEME_DIR . '/images/icon-mail.svg' );
			_e( 'Email', 'framework' );
			echo ': ' . get_option( 'theme_contact_email' );
		}
	}
}


if ( ! function_exists( 'inspiry_contact_form_heading_render' ) ) {
	function inspiry_contact_form_heading_render() {
		if ( get_option( 'theme_contact_form_heading' ) ) {
			echo get_option( 'theme_contact_form_heading' );
		}
	}
}
