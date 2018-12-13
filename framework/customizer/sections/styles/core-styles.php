<?php
/**
 * Section:    `Core Styles`
 * Panel:    `Styles`
 *
 * @package RH
 * @since 3.4.2
 */

if ( ! function_exists( 'inspiry_core_styles_customizer' ) ) :

	function inspiry_core_styles_customizer( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section( 'inspiry_core_colors_section', array(
			'title' => esc_html__( 'Core Colors', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );


		$wp_customize->add_setting( 'inspiry_basic_core_note_two', array() );
		$wp_customize->add_control(
			new Inspiry_Intro_Customize_Control(
				$wp_customize,
				'inspiry_basic_core_note_two',
				array(
					'section'     => 'inspiry_core_colors_section',
					'label'       => esc_html__( 'Important Notes:', 'framework' ),
//					'description' => wp_kses( __( "• These color options replace the core colors <strong>mostly</strong> all over the theme. You can also override these colors for almost each section in <strong> Customizer > Styles</strong>.", 'framework' ), array( 'strong' => array() ) ),
					'description' => sprintf( esc_html__( '• These color options replace the core colors %1$s mostly %2$s all over the theme. You can also override these colors for almost each section in %1$s Customizer > Styles %2$s .', 'framework' ), "<strong>","</strong>" ),
				)
			)
		);


		$wp_customize->add_setting( 'inspiry_basic_core_note_one', array() );
		$wp_customize->add_control(
			new Inspiry_Intro_Customize_Control(
				$wp_customize,
				'inspiry_basic_core_note_one',
				array(
					'section'     => 'inspiry_core_colors_section',
//					'label'       => esc_html__( 'Important Notes:', 'framework' ),
					'description' => sprintf( esc_html__( '• To apply these core colors, make sure %1$s My Own Custom Colors %2$s option is selected in %1$s Customizer > Styles > Default or Custom %2$s. ', 'framework' ), "<strong>","</strong>" ),
				)
			)
		);



						/* Separator */
			$wp_customize->add_setting( 'inspiry_core_note_separator', array() );
			$wp_customize->add_control(
				new Inspiry_Separator_Control(
					$wp_customize,
					'inspiry_core_note_separator',
					array(
						'section' 	=> 'inspiry_core_colors_section',
					)
				)
			);



		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'theme_core_color_orange_light', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_color_orange_light',
					array(
						'label'       => esc_html__( 'Orange Light', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Main Menu %1$s
														• Search Form Button %1$s
														• Property Status Tag %1$s
														• Agent Know More Button %1$s
														• Agent Contact Form Button %1$s
														• Post Read More Button %1$s
														• Post Author Link %1$s
														• Post Tags %1$s
														• Post Reply Button %1$s
														• Gallery Filter %1$s
														• Contact Form Button %1$s
														 Default color is #ec894d ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_color_orange_light',
					)
				)
			);

			$wp_customize->add_setting( 'theme_core_color_orange_dark', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_color_orange_dark',
					array(
						'label'       => esc_html__( 'Orange Dark', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Main Menu Hover %1$s
														• Footer Widgets Links Hover %1$s
														• Sidebar Widgets Links Hover %1$s
														 Default color is #dc7d44 ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_color_orange_dark',
					)
				)
			);

			$wp_customize->add_setting( 'theme_core_color_orange_glow', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_color_orange_glow',
					array(
						'label'       => esc_html__( 'Orange Glow', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Search Form Button Hover %1$s
														• Agent Know More Button Hover %1$s
														• Agent Contact Form Button Hover %1$s
														• Post Read More Button Hover %1$s
														• Post Tags Hover %1$s
														• Post Reply Button Hover %1$s
														• Pagination %1$s
														 Default color is #e3712c ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_color_orange_glow',
					)
				)
			);

			$wp_customize->add_setting( 'theme_core_color_orange_burnt', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_color_orange_burnt',
					array(
						'label'       => esc_html__( 'Orange Burnt', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Home Slider price and Title Hover %1$s
														• Property Title Hover %1$s
														• Property More Details Link Hover %1$s
														• footer Links Hover %1$s
														• Post Title Hover %1$s
														• Agent Title Hover in Listing  %1$s
														• Title Hover of Featured Properties Widget %1$s
														• Contact Page Email Hover %1$s
														• Feature Search Hover in Search Form Widget %1$s
														 Default color is #df5400 ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_color_orange_burnt',
					)
				)
			);

			$wp_customize->add_setting( 'theme_core_color_blue_light', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_color_blue_light',
					array(
						'label'       => esc_html__( 'Blue light', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Header Phone Number Background %1$s
														• Search Form Drop Down Item Background  %1$s
														• Home Slider Know More %1$s
														• Property Price & type color/Background %1$s
														• Scroll To Top Button %1$s
														• Post Format Icon Background %1$s
														• Post Slider Navigation %1$s
														• Gallery Property Overlay %1$s

														 Default color is #4dc7ec ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_color_blue_light',
					)
				)
			);

//			$wp_customize->add_setting( 'theme_core_color_blue_med', array(
//				'sanitize_callback' => 'sanitize_hex_color',
//			) );
//			$wp_customize->add_control(
//				new WP_Customize_Color_Control(
//					$wp_customize,
//					'theme_core_color_blue_med',
//					array(
//						'label'       => esc_html__( 'Blue Medium', 'framework' ),
//						'description' => wp_kses(__( 'Change core colors of <br>
//														• Home Slider Know More Hover <br>
//														 Default color is #2aa6cc ', 'framework' ),array('br' => array())),
//						'section'     => 'inspiry_core_colors_section',
//						'settings'    => 'theme_core_color_blue_med',
//					)
//				)
//			);

			$wp_customize->add_setting( 'theme_core_color_blue_dark', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_color_blue_dark',
					array(
						'label'       => esc_html__( 'Blue Dark', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Header Phone Icon %1$s
														• Home Slider Know More Hover %1$s
														• Scroll To Top Button Hover %1$s
														• Banner Description Background %1$s
														• Banner Breadcrumbs Background %1$s

														 Default color is #37b3d9 ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_color_blue_dark',
					)
				)
			);

		}elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'theme_core_mod_color_orange', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_mod_color_orange',
					array(
						'label'       => esc_html__( 'Orange', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Main Menu Background %1$s
														• Home Slider Direction Nav %1$s
														• Property Featured Tag %1$s
														• Add To Favourite Tag %1$s
														• Featured Properties Slider Direction Nav %1$s
														• Port Gallery Format Slider Direction Nav %1$s
														• CTA Button One Background %1$s
														• Home Agents Arrow %1$s
														• Sidebar widget links %1$s
														• Agent View My Listings Link %1$s
														 Default color is #ea723d ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_mod_color_orange',
					)
				)
			);

			$wp_customize->add_setting( 'theme_core_mod_color_green', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_mod_color_green',
					array(
						'label'       => esc_html__( 'Green', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Property Submit Button %1$s
														• Property Meta Icons Home Slider %1$s
														• Property Price %1$s
														• Property Title Hover %1$s
														• Property Image Overlay %1$s
														• Property Search Form %1$s
														• Property Detail Headings %1$s
														• Property Sidebar Buttons %1$s
														• Home Testimonial Background %1$s
														• Home Section Subtitle %1$s
														• Home CTA-Contact Background %1$s
														• Agents Title and Email Hover %1$s
														• Agents Number and Property count %1$s
														• Agents Contact Form Button %1$s
														• News Title and Meta Background Bar %1$s
														• Comment Submit Button %1$s
														• News Read More %1$s
														• Gallery Item Overlay %1$s
														• Gallery Filter Underline %1$s
														• Contact Page Form Button %1$s
														• Pagination %1$s

														 Default color is #1ea69a ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_mod_color_green',
					)
				)
			);

			$wp_customize->add_setting( 'theme_core_mod_color_green_dark', array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'theme_core_mod_color_green_dark',
					array(
						'label'       => esc_html__( 'Green Dark', 'framework' ),
						'description' => sprintf( esc_html__( 'Change core colors of %1$s
														• Property Submit Button Hover %1$s
														• Property Search Button Hover %1$s
														• Home Testimonial Quote Marks %1$s
														• Property Sidebar Buttons Hovers %1$s
														• Comment Submit Button Hover %1$s
														• News Read More Hover %1$s
														• Agents Contact Form Button Hover %1$s
														• Contact PAge Form Button Hover %1$s
														 Default color is #1c9d92 ', 'framework' ),"<br>"),
						'section'     => 'inspiry_core_colors_section',
						'settings'    => 'theme_core_mod_color_green_dark',
					)
				)
			);


		}

	}

	add_action( 'customize_register', 'inspiry_core_styles_customizer' );
endif;