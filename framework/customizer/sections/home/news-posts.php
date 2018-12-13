<?php
/**
 * Section:	`News or Blog Posts`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_news_posts_customizer' ) ) :

	/**
	 * inspiry_news_posts_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_news_posts_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home News Section
		 */
		$wp_customize->add_section( 'inspiry_home_news', array(
			'title' => __( 'News or Blog Posts', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Show or Hide News on Homepage */
		$wp_customize->add_setting( 'theme_show_news_posts', array(
			'type' 		=> 'option',
			'default' 	=> 'false',
		) );
		$wp_customize->add_control( 'theme_show_news_posts', array(
			'label' 	=> __( 'News Posts on Homepage', 'framework' ),
			'type' 		=> 'radio',
			'section' 	=> 'inspiry_home_news',
			'choices' 	=> array(
				'true' 	=> __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			),
		) );

		/* News Title */
		$wp_customize->add_setting( 'theme_news_posts_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_news_posts_title', array(
			'label' 	=> __( 'Title', 'framework' ),
			'type' 		=> 'text',
			'section' 	=> 'inspiry_home_news',
		) );

		/* Slogan Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_news_posts_title', array(
				'selector' 				=> '.home-recent-posts .section-title h3',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'theme_news_posts_title_render'
			) );
		}

		/* News Text */
		$wp_customize->add_setting( 'theme_news_posts_text', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'theme_news_posts_text', array(
			'label' 	=> __( 'Description Text', 'framework' ),
			'type' 		=> 'textarea',
			'section'	=> 'inspiry_home_news',
		) );

		/* Slogan Description Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_news_posts_text', array(
				'selector' 				=> '.home-recent-posts .section-title p',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'theme_news_posts_text_render'
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_news_posts_customizer' );
endif;


if ( ! function_exists( 'inspiry_news_posts_defaults' ) ) :

	/**
	 * inspiry_news_posts_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_news_posts_defaults( WP_Customize_Manager $wp_customize ) {
		$news_posts_settings_ids = array(
			'theme_show_news_posts'
		);
		inspiry_initialize_defaults( $wp_customize, $news_posts_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_news_posts_defaults' );
endif;


if ( ! function_exists( 'theme_news_posts_title_render' ) ) {
	function theme_news_posts_title_render() {
		if ( get_option( 'theme_news_posts_title' ) ) {
			echo get_option( 'theme_news_posts_title' );
		}
	}
}


if ( ! function_exists( 'theme_news_posts_text_render' ) ) {
	function theme_news_posts_text_render() {
		if ( get_option( 'theme_news_posts_text' ) ) {
			echo get_option( 'theme_news_posts_text' );
		}
	}
}
