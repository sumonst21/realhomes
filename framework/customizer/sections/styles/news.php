<?php
/**
 * Section:	`News`
 * Panel: 	`Styles`
 *
 * @package RH
 * @since 3.0.0
 */

if ( ! function_exists( 'inspiry_styles_news_customizer' ) ) :

	/**
	 * inspiry_styles_news_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  3.0.0
	 */
	function inspiry_styles_news_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Styles News Section
		 */
		$wp_customize->add_section( 'inspiry_news_page_styles', array(
			'title' => esc_html__( 'News', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		/* Single Post Text Color */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$default_text_color = '#8B9293';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$default_text_color = '#808080';
		}
		$wp_customize->add_setting( 'inspiry_post_text_color', array(
			'default' 			=> $default_text_color,
			'type' 				=> 'option',
			'transport'			=> 'refresh',
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'inspiry_post_text_color',
				array(
					'label' 	=> esc_html__( 'Text Color', 'framework' ),
					'section'	=> 'inspiry_news_page_styles',
				)
			)
		);

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* Post Border Color */
			$wp_customize->add_setting( 'inspiry_post_border_color', array(
//				'default' 			=> '#4DC7EC',
				'type' 				=> 'option',
				'transport'			=> 'refresh',
				'sanitize_callback'	=> 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_post_border_color',
					array(
						'label' 	=> esc_html__( 'Post Border, Icon And Slider Nav Colors', 'framework' ),
						'section'	=> 'inspiry_news_page_styles',
						'description' => esc_html__('Default color is #4dc7ec','framework')
					)
				)
			);
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Post Meta Background Color */
			$wp_customize->add_setting( 'inspiry_post_meta_bg', array(
//				'default' 			=> '#1ea69a',
				'type' 				=> 'option',
				'transport'			=> 'refresh',
				'sanitize_callback'	=> 'sanitize_hex_color',
			) );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'inspiry_post_meta_bg',
					array(
						'label' 	=> esc_html__( 'Post Meta Background Color', 'framework' ),
						'section'	=> 'inspiry_news_page_styles',
						'description' => esc_html__('Default color is #1ea69a','framework'),
					)
				)
			);
		}

	}

	add_action( 'customize_register', 'inspiry_styles_news_customizer' );
endif;


if ( ! function_exists( 'inspiry_styles_news_defaults' ) ) :

	/**
	 * inspiry_styles_news_defaults.
	 *
	 * @param  WP_Customize_Manager $wp_customize - Instance of WP_Customize_Manager.
	 * @since  3.0.0
	 */
	function inspiry_styles_news_defaults( WP_Customize_Manager $wp_customize ) {
		$styles_news_settings_ids = array(
			'inspiry_post_text_color',
			'inspiry_post_border_color',
			'inspiry_post_meta_bg',
		);
		inspiry_initialize_defaults( $wp_customize, $styles_news_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_styles_news_defaults' );
endif;
