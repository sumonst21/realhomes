<?php
/**
 * Members Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_members_customizer' ) ) :
	function inspiry_members_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Members Panel
		 */
		global $inspiry_pages;

		// Get design variation.
		$rh_design_variation = INSPIRY_DESIGN_VARIATION;

		$wp_customize->add_panel( 'inspiry_members_panel', array(
			'title'    => __( 'Members', 'framework' ),
			'priority' => 127,
		) );

		/**
		 * Members Basic
		 */
		$wp_customize->add_section( 'inspiry_members_basic', array(
			'title' => __( 'Basic', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Restrict Access */
		$wp_customize->add_setting( 'theme_restricted_level', array(
			'type'      => 'option',
			'default'   => '0',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_restricted_level', array(
			'label'       => __( 'Restrict Admin Side Access', 'framework' ),
			'description' => __( 'Restrict admin side access to any user level equal to or below the selected user level.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_members_basic',
			'choices'     => array(
				'0' => __( 'Subscriber ( Level 0 )', 'framework' ),
				'1' => __( 'Contributor ( Level 1 )', 'framework' ),
				'2' => __( 'Author ( Level 2 )', 'framework' ),
				// '7' => __( 'Editor ( Level 7 )','framework'),
			),
		) );

		if ( 'modern' === $rh_design_variation ) {
			/* Membership Page */
			$wp_customize->add_setting( 'inspiry_membership_page', array(
				'type' => 'option',
			) );
			$wp_customize->add_control( 'inspiry_membership_page', array(
				'label'       => __( 'Select Memberships Page', 'framework' ),
				'description' => __( 'Selected page should have Memberships Template assigned to it.', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_members_basic',
				'choices'     => $inspiry_pages,
			) );
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_member_pages_header_variation', array(
				'type'    => 'option',
				'default' => 'banner',
			) );

			$wp_customize->add_control( 'inspiry_member_pages_header_variation', array(
				'label'       => __( 'Header Variation', 'framework' ),
				'description' => __( 'Header variation to display on member pages.', 'framework' ),
				'type'        => 'radio',
				'section'     => 'inspiry_members_basic',
				'choices'     => array(
					'banner' => __( 'Banner', 'framework' ),
					'none'   => __( 'None', 'framework' ),
				),
			) );
		}

		/**
		 * Members Login and Register
		 */
		$wp_customize->add_section( 'inspiry_members_login', array(
			'title' => __( 'Login & Register', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Enable/Disable Login in Header */
		$wp_customize->add_setting( 'inspiry_header_login', array(
			'type'    => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'inspiry_header_login', array(
			'label'   => __( 'Login in Header', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_login',
			'choices' => array(
				'true'  => __( 'Enable', 'framework' ),
				'false' => __( 'Disable', 'framework' ),
			),
		) );

		/* Login Page */
		$wp_customize->add_setting( 'inspiry_login_register_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_login_register_page', array(
			'label'       => __( 'Select Login and Register Page (Optional)', 'framework' ),
			'description' => __( 'Selected page should have Login & Register Template assigned to it. By default the login modal box will appear and you do not need to configure this option.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_members_login',
			'choices'     => $inspiry_pages,
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_login_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_login_url_separator',
				array(
					'section' => 'inspiry_members_login',
				)
			)
		);

		/**
		 * Members Edit Profile
		 */
		$wp_customize->add_section( 'inspiry_members_profile', array(
			'title' => __( 'Edit Profile', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Inspiry Edit Profile Page */
		$wp_customize->add_setting( 'inspiry_edit_profile_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_edit_profile_page', array(
			'label'       => __( 'Select Edit Profile Page', 'framework' ),
			'description' => __( 'Selected page should have Edit Profile Template assigned to it.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_members_profile',
			'choices'     => $inspiry_pages,
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_profile_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_profile_url_separator',
				array(
					'section' => 'inspiry_members_profile',
				)
			)
		);

		/**
		 * Members Submit
		 */
		$wp_customize->add_section( 'inspiry_members_submit', array(
			'title' => __( 'Submit Property', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Inspiry Submit Property Page */
		$wp_customize->add_setting( 'inspiry_submit_property_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_submit_property_page', array(
			'label'       => __( 'Select Submit Property Page', 'framework' ),
			'description' => __( 'Selected page should have Submit Property Template assigned to it.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_members_submit',
			'choices'     => $inspiry_pages,
		) );

		/* Submit Property Fields */
		$wp_customize->add_setting( 'inspiry_submit_property_fields', array(
			'type'              => 'option',
			'default'           => array(
				'title',
				'description',
				'property-type',
				'property-status',
				'locations',
				'bedrooms',
				'bathrooms',
				'garages',
				'property-id',
				'price',
				'price-postfix',
				'area',
				'area-postfix',
				'video',
				'images',
				'address-and-map',
				'additional-details',
				'featured',
				'features',
				'agent',
				'parent',
				'reviewer-message',
			),
			'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes',
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'inspiry_submit_property_fields',
				array(
					'section' => 'inspiry_members_submit',
					'label'   => __( 'Which fields you want to display in submit form ?', 'framework' ),
					'choices' => array(
						'title'              => __( 'Property Title', 'framework' ),
						'description'        => __( 'Property Description', 'framework' ),
						'property-type'      => __( 'Type', 'framework' ),
						'property-status'    => __( 'Status', 'framework' ),
						'locations'          => __( 'Location', 'framework' ),
						'bedrooms'           => __( 'Bedrooms', 'framework' ),
						'bathrooms'          => __( 'Bathrooms', 'framework' ),
						'garages'            => __( 'Garages', 'framework' ),
						'property-id'        => __( 'Property ID', 'framework' ),
						'price'              => __( 'Price', 'framework' ),
						'price-postfix'      => __( 'Price Postfix', 'framework' ),
						'area'               => __( 'Area', 'framework' ),
						'area-postfix'       => __( 'Area Postfix', 'framework' ),
						'video'              => __( 'Video', 'framework' ),
						'images'             => __( 'Property Images', 'framework' ),
						'address-and-map'    => __( 'Address and Google Map', 'framework' ),
						'additional-details' => __( 'Additional Details', 'framework' ),
						'featured'           => __( 'Mark as Featured Checkbox', 'framework' ),
						'features'           => __( 'Features', 'framework' ),
						'agent'              => __( 'Agent', 'framework' ),
						'parent'             => __( 'Parent Property', 'framework' ),
						'reviewer-message'   => __( 'Message to Reviewer', 'framework' ),
						'terms-conditions'   => __( 'Terms & Conditions', 'framework' ),
						'year-built'         => __( 'Year Built', 'framework' ),
					),
				)
			)
		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_submit_property_fields_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_submit_property_fields_separator',
				array(
					'section' => 'inspiry_members_submit',
				)
			)
		);

		// terms & conditions field note
		$wp_customize->add_setting( 'inspiry_submit_property_terms_text', array(
			'type'              => 'option',
			'default'           => __( 'Accept Terms & Conditions before property submission.', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'inspiry_submit_property_terms_text', array(
			'label'           => __( 'Terms & Conditions Note', 'framework' ),
			'description'     => '<strong>' . esc_html__( 'Important:', 'framework' ) . ' </strong>' . esc_html__( 'Please use {link text} pattern in your note text as it will be linked to the Terms & Conditions page.', 'framework' ),
			'type'            => 'text',
			'section'         => 'inspiry_members_submit',
			'active_callback' => 'inspiry_is_submit_property_field_terms'
		) );

		// terms and conditions detail page
		$wp_customize->add_setting( 'inspiry_submit_property_terms_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_submit_property_terms_page', array(
			'label'           => __( 'Select Terms & Conditions Page', 'framework' ),
			'description'     => __( 'Selected page should have terms & conditions details.', 'framework' ),
			'type'            => 'select',
			'section'         => 'inspiry_members_submit',
			'choices'         => $inspiry_pages,
			'active_callback' => 'inspiry_is_submit_property_field_terms'
		) );

		// require to access the terms and conditions
		$wp_customize->add_setting( 'inspiry_submit_property_terms_require', array(
			'type'    => 'option',
			'default' => true,
		) );

		$wp_customize->add_control(
			'inspiry_submit_property_terms_require',
			array(
				'label'           => __( 'Require Terms & Conditions.', 'framework' ),
				'section'         => 'inspiry_members_submit',
				'type'            => 'checkbox',
				'active_callback' => 'inspiry_is_submit_property_field_terms'
			)
		);

		/* Submitted Property Status */
		$wp_customize->add_setting( 'theme_submitted_status', array(
			'type'      => 'option',
			'default'   => 'pending',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_submitted_status', array(
			'label'       => __( 'Submitted Property Status', 'framework' ),
			'description' => __( 'Select the default status for submitted property.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_members_submit',
			'choices'     => array(
				'pending' => __( 'Pending ( Recommended )', 'framework' ),
				'publish' => __( 'Publish', 'framework' ),
			),
		) );

		/* Default Address in Submit Form */
		$wp_customize->add_setting( 'theme_submit_default_address', array(
			'type'              => 'option',
			'default'           => '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_submit_default_address', array(
			'label'   => __( 'Default Address in Submit Form', 'framework' ),
			'type'    => 'textarea',
			'section' => 'inspiry_members_submit',
		) );

		/* Default Map Location */
		$wp_customize->add_setting( 'theme_submit_default_location', array(
			'type'              => 'option',
			'default'           => '25.7308309,-80.44414899999998',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_submit_default_location', array(
			'label'       => __( 'Default Map Location in Submit Form (Latitude,Longitude)', 'framework' ),
			'description' => 'You can use <a href="http://www.latlong.net/" target="_blank">latlong.net</a> OR <a href="http://itouchmap.com/latlong.html" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.',
			'type'        => 'text',
			'section'     => 'inspiry_members_submit',
		) );

		/* Enable Auto-Generated Property ID */
		$wp_customize->add_setting( 'inspiry_auto_property_id_check', array(
			'type'              => 'option',
			'default'           => 'false',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_auto_property_id_check', array(
			'label'   => __( 'Enable Auto-Generated Property ID', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_submit',
			'choices' => array(
				'true'  => __( 'Enable', 'framework' ),
				'false' => __( 'Disable', 'framework' ),
			),
		) );

		/* Enable Auto-Generated Property ID */
		$wp_customize->add_setting( 'inspiry_auto_property_id_pattern', array(
			'type'              => 'option',
			'default'           => 'RH-{ID}-property',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_auto_property_id_pattern', array(
			'label'           => __( 'Auto-Generated Property ID Pattern', 'framework' ),
			'description'     => '<strong>Important: </strong>' . __( 'Please use {ID} in your pattern as it will be replaced by the Property ID.', 'framework' ),
			'type'            => 'text',
			'section'         => 'inspiry_members_submit',
			'active_callback' => 'inspiry_is_auto_property_id_pattern',
		) );

		/*  Property default additional details */
		$wp_customize->add_setting( 'inspiry_property_additional_details', array(
			'type'              => 'option',
			'sanitize_callback' => 'esc_html',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'inspiry_property_additional_details', array(
			'label'       => esc_html__( 'Default Additional Details', 'framework' ),
			'description' => __( "Add title and value 'colon' separated and fields 'comma' separated. <br><br><strong>For Example</strong>: <pre>Plot Size:300,Built Year:2017</pre>", 'framework' ),
			'type'        => 'textarea',
			'section'     => 'inspiry_members_submit',
		) );

		/* Message after Submit */
		$wp_customize->add_setting( 'theme_submit_message', array(
			'type'              => 'option',
			'default'           => __( 'Thanks for Submitting Property!', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_submit_message', array(
			'label'   => __( 'Message After Successful Submit', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_members_submit',
		) );

		/* Submit Notice */
		$wp_customize->add_setting( 'theme_submit_notice_email', array(
			'type'              => 'option',
			'default'           => get_option( 'admin_email' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_submit_notice_email', array(
			'label'   => __( 'Submit Notice Email', 'framework' ),
			'type'    => 'email',
			'section' => 'inspiry_members_submit',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_submit_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_submit_url_separator',
				array(
					'section' => 'inspiry_members_submit',
				)
			)
		);

		/**
		 * Members My Properties
		 */
		$wp_customize->add_section( 'inspiry_members_properties', array(
			'title' => __( 'My Properties', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* My Properties Page */
		$wp_customize->add_setting( 'inspiry_my_properties_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_my_properties_page', array(
			'label'       => __( 'Select My Properties Page', 'framework' ),
			'description' => __( 'Selected page should have My Properties Template assigned to it.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_members_properties',
			'choices'     => $inspiry_pages,
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_my_properties_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_my_properties_url_separator',
				array(
					'section' => 'inspiry_members_properties',
				)
			)
		);

	}

	add_action( 'customize_register', 'inspiry_members_customizer' );
endif;


if ( ! function_exists( 'inspiry_members_defaults' ) ) :
	/**
	 * Set default values for members settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_members_defaults( WP_Customize_Manager $wp_customize ) {
		$members_settings_ids = array(
			'inspiry_member_pages_header_variation',
			'theme_restricted_level',
			'inspiry_header_login',
			'theme_submitted_status',
			'theme_submit_default_address',
			'theme_submit_default_location',
			'inspiry_auto_property_id_check',
			'inspiry_auto_property_id_pattern',
			'theme_submit_message',
			'theme_submit_notice_email',
			'inspiry_submit_property_fields',
			'inspiry_submit_property_terms_text',
		);
		inspiry_initialize_defaults( $wp_customize, $members_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_members_defaults' );
endif;

if ( ! function_exists( 'inspiry_is_auto_property_id_pattern' ) ) {
	/**
	 * Check if property auto id is enabled
	 *
	 * @return bool
	 */
	function inspiry_is_auto_property_id_pattern() {

		$auto_id_check = get_option( 'inspiry_auto_property_id_check' );

		if ( 'true' == $auto_id_check ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'inspiry_is_submit_property_field_terms' ) ) {
	/**
	 * Check if terms and condidtions field is enabled on the property submit page.
	 *
	 * @return bool|int
	 */
	function inspiry_is_submit_property_field_terms() {

		$term_field_check = get_option( 'inspiry_submit_property_fields' );

		return ( false != strpos( implode( ' ', $term_field_check ), 'terms-conditions' ) ) ? true : false;;
	}
}
