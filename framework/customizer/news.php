<?php
/**
 * Blog/News Customizer
 *
 * @package RH
 */


if ( ! function_exists( 'inspiry_news_customizer' ) ) :
	function inspiry_news_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Pages Panel
		 */
		$wp_customize->add_panel( 'inspiry_various_pages', array(
			'title' => __( 'Various Pages', 'framework' ),
			'priority' => 126,
		) );

		/**
		 * News Section
		 */
		$wp_customize->add_section( 'inspiry_news_section', array(
			'title' => __( 'News/Blog Page', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_news_header_variation', array(
				'type'		=> 'option',
				'default' 	=> 'banner',
			) );

			$wp_customize->add_control( 'inspiry_news_header_variation', array(
				'label' 	=> __( 'Header Variation', 'framework' ),
				'description' => __( 'Header variation to display on News Page.', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_news_section',
				'choices' 	=> array(
					'banner'	=> __( 'Banner', 'framework' ),
					'none'		=> __( 'None', 'framework' ),
				),
			) );
		}

		/* News Banner Title */
		$wp_customize->add_setting( 'theme_news_banner_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'default' 			=> __( 'News', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_news_banner_title', array(
			'label' 	=> __( 'Banner Title', 'framework' ),
			'type' 		=> 'text',
			'section' 	=> 'inspiry_news_section',
		) );

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$theme_news_banner_title_selector = '.blog h1.page-title span';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$theme_news_banner_title_selector = '.blog .rh_banner .rh_banner__title';
		}
		/* News Banner Title Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_news_banner_title', array(
				'selector' 				=> $theme_news_banner_title_selector,
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_news_banner_title_render',
			) );
		}

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/* News Banner Sub Title */
			$wp_customize->add_setting( 'theme_news_banner_sub_title', array(
				'type' 				=> 'option',
				'transport'			=> 'postMessage',
				'default' 			=> __( 'Check out market updates', 'framework' ),
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'theme_news_banner_sub_title', array(
				'label' 	=> __( 'Banner Sub Title', 'framework' ),
				'type' 		=> 'text',
				'section' 	=> 'inspiry_news_section',
			) );

			/* News Banner Sub Title Selective Refresh */
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'theme_news_banner_sub_title', array(
					'selector' 				=> '.blog .page-head p',
					'container_inclusive'	=> false,
					'render_callback' 		=> 'inspiry_news_banner_sub_title_render',
				) );
			}

			/* Link to Previous and Next Post */
			$wp_customize->add_setting( 'inspiry_post_prev_next_link', array(
				'type' => 'option',
				'default' => 'true',
			) );
			$wp_customize->add_control( 'inspiry_post_prev_next_link', array(
				'label' => __( 'Link to Previous and Next Post', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_news_section',
				'choices' => array(
					'true' => __( 'Enable', 'framework' ),
					'false' => __( 'Disable', 'framework' ),
				),
			) );
		}

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/**
			 * Pages Section
			 */
			$wp_customize->add_section( 'inspiry_pages_section', array(
				'title' => __( 'Pages', 'framework' ),
				'panel' => 'inspiry_various_pages',
			) );

			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_pages_header_variation', array(
				'type'		=> 'option',
				'default' 	=> 'banner',
			) );

			$wp_customize->add_control( 'inspiry_pages_header_variation', array(
				'label' 	=> __( 'Header Variation', 'framework' ),
				'description' => __( 'Header variation to display on Pages.', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_pages_section',
				'choices' 	=> array(
					'banner'	=> __( 'Banner', 'framework' ),
					'none'		=> __( 'None', 'framework' ),
				),
			) );

			/* Explode Listing Title */
			$wp_customize->add_setting( 'inspiry_explode_listing_title', array(
				'type'    => 'option',
				'default' => 'yes',
			) );

			$wp_customize->add_control( 'inspiry_explode_listing_title', array(
				'label'       => __( 'Explode Title', 'framework' ),
				'description' => __( 'Explode page title into sub-title and title.', 'framework' ),
				'type'        => 'select',
				'section'     => 'inspiry_pages_section',
				'choices'     => array(
					'yes' => __( 'Yes', 'framework' ),
					'no'  => __( 'No', 'framework' ),
				),
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_news_customizer' );
endif;


if ( ! function_exists( 'inspiry_news_defaults' ) ) :
	/**
	 * Set default values for news settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_news_defaults( WP_Customize_Manager $wp_customize ) {
		$news_settings_ids = array(
			'inspiry_news_header_variation',
			'theme_news_banner_title',
			'theme_news_banner_sub_title',
			'inspiry_post_prev_next_link',
			'inspiry_pages_header_variation',
		);
		inspiry_initialize_defaults( $wp_customize, $news_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_news_defaults' );
endif;


if ( ! function_exists( 'inspiry_news_banner_title_render' ) ) {
	function inspiry_news_banner_title_render() {
		if ( get_option( 'theme_news_banner_title' ) ) {
			echo get_option( 'theme_news_banner_title' );
		}
	}
}


if ( ! function_exists( 'inspiry_news_banner_sub_title_render' ) ) {
	function inspiry_news_banner_sub_title_render() {
		if ( get_option( 'theme_news_banner_sub_title' ) ) {
			echo get_option( 'theme_news_banner_sub_title' );
		}
	}
}
