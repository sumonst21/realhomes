<?php
/**
 * Section:	`Styles`
 * Panel: 	`Header`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_header_styles_customizer' ) ) :

	/**
	 * inspiry_header_styles_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_header_styles_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Styles Section
		 */
		$wp_customize->add_section( 'inspiry_header_styles', array(
			'title' => __( 'Header Styles', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		/* Header Background Color */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$default_header_bg = '#252A2B';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$default_header_bg = '#303030';
		}
		$wp_customize->add_setting( 'theme_header_bg_color', array(
			'type' => 'option',
//			'default' => $default_header_bg,
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,              // WP_Customize_Manager.
				'theme_header_bg_color',    // Setting id.
				array(
					'label' => __( 'Header Background Color', 'framework' ),
					'section' => 'inspiry_header_styles',
					'description' => sprintf( esc_html__( 'Default Color is %s', 'framework' ), $default_header_bg ),
				)
			)
		);

		/* Logo Text Color */
		$wp_customize->add_setting( 'theme_logo_text_color', array(
			'type' => 'option',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_logo_text_color',
				array(
					'label' => __( 'Logo Text Color', 'framework' ),
					'section' => 'inspiry_header_styles',
				)
			)
		);

		/* Logo Text Hover Color */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$default_logo_hover = '#4dc7ec';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$default_logo_hover = '#1ea69a';
		}
		$wp_customize->add_setting( 'theme_logo_text_hover_color', array(
			'type' => 'option',
//			'default' => $default_logo_hover,
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_logo_text_hover_color',
				array(
					'label' => __( 'Logo Text Hover Color', 'framework' ),
					'section' => 'inspiry_header_styles',
					'description' => sprintf(esc_html__('Default Color is %s','framework') , $default_logo_hover),
				)
			)
		);

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* Tagline Text Color */
			$wp_customize->add_setting( 'theme_tagline_text_color', array(
				'type' => 'option',
				'default' => '#8b9293',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_tagline_text_color',
					array(
						'label' => __( 'Tagline Text Color', 'framework' ),
						'section' => 'inspiry_header_styles',
					)
				)
			);

			/* Tagline Background Color */
			$wp_customize->add_setting( 'theme_tagline_bg_color', array(
				'type' => 'option',
				'default' => '#343a3b',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_tagline_bg_color',
					array(
						'label' => __( 'Tagline Background Color', 'framework' ),
						'section' => 'inspiry_header_styles',
					)
				)
			);

			/* Header Text Color */
			$wp_customize->add_setting( 'theme_header_text_color', array(
				'type' => 'option',
				'default' => '#929A9B',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_header_text_color',
					array(
						'label' => __( 'Header Text Color', 'framework' ),
						'section' => 'inspiry_header_styles',
					)
				)
			);

			/* Header Links Hover Color */
			$wp_customize->add_setting( 'theme_header_link_hover_color', array(
				'type' => 'option',
				'default' => '#b0b8b9',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_header_link_hover_color',
					array(
						'label' => __( 'Header Links Hover Color', 'framework' ),
						'section' => 'inspiry_header_styles',
					)
				)
			);

			/* Header Borders Color */
			$wp_customize->add_setting( 'theme_header_border_color', array(
				'type' => 'option',
				'default' => '#343A3B',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_header_border_color',
					array(
						'label' => __( 'Header Borders Color', 'framework' ),
						'section' => 'inspiry_header_styles',
					)
				)
			);

			/* Main Menu Text Color */
			$wp_customize->add_setting( 'theme_main_menu_text_color', array(
				'type' => 'option',
//				'default' => '#afb4b5',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_main_menu_text_color',
					array(
						'label' => __( 'Main Menu Text Color', 'framework' ),
						'section' => 'inspiry_header_styles',
						'description' => esc_html__('Default Color is #afb4b5','framework'),
					)
				)
			);
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Main Menu Text Color */
			$wp_customize->add_setting( 'theme_main_menu_text_color', array(
				'type' => 'option',
//				'default' => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_main_menu_text_color',
					array(
						'label' => __( 'Main Menu Text Color', 'framework' ),
						'section' => 'inspiry_header_styles',
						'description' => esc_html__('Default Color is #ffffff','framework'),
					)
				)
			);

			/* Main Menu Text Hover Color */
			$wp_customize->add_setting( 'inspiry_main_menu_hover_bg', array(
				'type' => 'option',
//				'default' => '#ea723d',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_main_menu_hover_bg',
					array(
						'label' => __( 'Main Menu Hover Background', 'framework' ),
						'section' => 'inspiry_header_styles',
						'description' => esc_html__('Default color is #ea723d','framework'),
					)
				)
			);
		}

		/* Drop Down Menu Background Color */
		$default_dd_menu_bg = '';
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$default_dd_menu_bg = '#ec894d';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$default_dd_menu_bg = '#ffffff';
		}
		$wp_customize->add_setting( 'theme_menu_bg_color', array(
			'type' => 'option',
//			'default' => $default_dd_menu_bg,
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_menu_bg_color',
				array(
					'label' => __( 'Drop Down Menu Background Color', 'framework' ),
					'section' => 'inspiry_header_styles',
					'description' => sprintf(esc_html__('Default Color is %s','framework') , $default_dd_menu_bg),
				)
			)
		);

		/* Drop Down Menu Text Color */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$default_dd_menu_text_color = '#ffffff';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$default_dd_menu_text_color = '#808080';
		}
		$wp_customize->add_setting( 'theme_menu_text_color', array(
			'type' => 'option',
//			'default' => $default_dd_menu_text_color,
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_menu_text_color',
				array(
					'label' => __( 'Drop Down Menu Text Color', 'framework' ),
					'section' => 'inspiry_header_styles',
					'description'=> sprintf(esc_html__('Default color is %s','framework') , $default_dd_menu_text_color),
				)
			)
		);

		/* Drop Down Menu Background Color on Mouse Over */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting( 'theme_menu_hover_bg_color', array(
				'type' => 'option',
//				'default' => '#dc7d44',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_menu_hover_bg_color',
					array(
						'label' => __( 'Drop Down Menu Background Color on Mouse Over', 'framework' ),
						'section' => 'inspiry_header_styles',
						'description' => esc_html__('Default Color is #dc7d44.','framework'),
					)
				)
			);

			/* Header Phone Number Background Color */
			$wp_customize->add_setting( 'theme_phone_bg_color', array(
				'type' => 'option',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_phone_bg_color',
					array(
						'label' => __( 'Header Phone Number Background Color', 'framework' ),
						'section' => 'inspiry_header_styles',
						'description' => esc_html__('Default color is #4dc7ec','framework'),
					)
				)
			);
		}

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$default_phone_text_color = '#e7eff7';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$default_phone_text_color = '#ffffff';
		}
		$wp_customize->add_setting( 'theme_phone_text_color', array(
			'type' => 'option',
//			'default' => $default_phone_text_color,
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_phone_text_color',
				array(
					'label' => __( 'Header Phone Number Text Color', 'framework' ),
					'section' => 'inspiry_header_styles',
					'description' => sprintf(esc_html__('Default Color is %s','framework') , $default_phone_text_color),
				)
			)
		);

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting( 'theme_phone_icon_bg_color', array(
				'type' => 'option',
//				'default' => '#37b3d9',
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_phone_icon_bg_color',
					array(
						'label' => __( 'Header Phone Icon Background Color', 'framework' ),
						'section' => 'inspiry_header_styles',
						'description' => esc_html__('Default color is #37b3d9','framework'),
					)
				)
			);
		}

	}

	add_action( 'customize_register', 'inspiry_header_styles_customizer' );
endif;


if ( ! function_exists( 'inspiry_header_styles_defaults' ) ) :

	/**
	 * inspiry_header_styles_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_header_styles_defaults( WP_Customize_Manager $wp_customize ) {
		$header_styles_settings_ids = array(
			'theme_header_bg_color',
			'theme_logo_text_color',
			'theme_logo_text_hover_color',
			'theme_tagline_text_color',
			'theme_tagline_bg_color',
			'theme_header_text_color',
			'theme_header_link_hover_color',
			'theme_header_border_color',
			'theme_main_menu_text_color',
			'inspiry_main_menu_hover_bg',
			'theme_menu_bg_color',
			'theme_menu_text_color',
			'theme_menu_hover_bg_color',
			'theme_phone_bg_color',
			'theme_phone_text_color',
			'theme_phone_icon_bg_color',
		);
		inspiry_initialize_defaults( $wp_customize, $header_styles_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_header_styles_defaults' );
endif;
