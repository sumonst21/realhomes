<?php
/**
 * Section:	`Slogan`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_slogan_customizer' ) ) :

	/**
	 * inspiry_slogan_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */
	function inspiry_slogan_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Slogan Section
		 */
		$wp_customize->add_section( 'inspiry_home_slogan', array(
			'title' => __( 'Slogan', 'framework' ),
			'panel' => 'inspiry_home_panel',
		) );

		/* Slogan */
		$wp_customize->add_setting( 'theme_slogan_title', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_slogan_title', array(
			'label' 	=> __( 'Slogan Title', 'framework' ),
			'type' 		=> 'text',
			'section'	=> 'inspiry_home_slogan',
		) );

		/* Slogan Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$slogan_selector = '#home-properties-section .narrative h2';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_slogan_title', array(
				'selector' 				=> $slogan_selector,
				'container_inclusive'	=> false,
				'render_callback' 		=> 'theme_slogan_title_render',
			) );
		}

		/* Slogan text description */
		$wp_customize->add_setting( 'theme_slogan_text', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			//'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'theme_slogan_text', array(
			'label' 	=> __( 'Description Text Below Slogan', 'framework' ),
			'type' 		=> 'textarea',
			'section' 	=> 'inspiry_home_slogan',
		) );

		/* Slogan Description Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$desc_selector = '#home-properties-section .narrative .home-slogan-text';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_slogan_text', array(
				'selector' 				=> $desc_selector,
				'container_inclusive'	=> false,
				'render_callback' 		=> 'theme_slogan_text_render',
			) );
		}

	}

	add_action( 'customize_register', 'inspiry_slogan_customizer' );
endif;


if ( ! function_exists( 'inspiry_slogan_defaults' ) ) :

	/**
	 * inspiry_slogan_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_slogan_defaults( WP_Customize_Manager $wp_customize ) {
		$slogan_settings_ids = array(

		);
		inspiry_initialize_defaults( $wp_customize, $slogan_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_slogan_defaults' );
endif;


if ( ! function_exists( 'theme_slogan_title_render' ) ) {
	function theme_slogan_title_render() {
		if ( get_option( 'theme_slogan_title' ) && ( 'classic' === INSPIRY_DESIGN_VARIATION ) ) {
			echo esc_html( get_option( 'theme_slogan_title' ) );
		}
	}
}


if ( ! function_exists( 'theme_slogan_text_render' ) ) {
	function theme_slogan_text_render() {
		$theme_slogan_text = get_option( 'theme_slogan_text' );
		if ( $theme_slogan_text ) {
			echo wpautop( $theme_slogan_text );
		}
	}
}
