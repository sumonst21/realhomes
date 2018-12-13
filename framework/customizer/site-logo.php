<?php
/**
 * Customizer:	`Site Logo`
 *
 * @since 2.6.3
 */


if ( ! function_exists( 'inspiry_site_logo_customizer' ) ) :
	function inspiry_site_logo_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Site Identity
		 */
		/* Logo */
		$wp_customize->add_setting( 'theme_sitelogo', array(
			'type' 				=> 'option',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_sitelogo', array(
			'label' 	=> __( 'Site Logo', 'framework' ),
			'section' 	=> 'title_tagline',   // id of site identity section - Ref: https://developer.wordpress.org/themes/advanced-topics/customizer-api/.
			'settings' 	=> 'theme_sitelogo',
			'priority'	=> 1,
		) ) );

		/* Site Logo Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'theme_sitelogo', array(
				'selector' 				=> '.rh_logo',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_site_logo_render',
			) );
		}

		// Site Name.
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		/* Site Name Selective Refresh */
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' 				=> '.rh_logo',
				'container_inclusive'	=> false,
				'render_callback' 		=> 'inspiry_site_logo_render',
			) );
		}

		// Site Description.
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		/* Site Description Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
					'selector' 				=> '#logo .tag-line span',
					'container_inclusive'	=> false,
					'render_callback' 		=> 'inspiry_site_desc_render',
				) );
			}
		}

	}

	add_action( 'customize_register', 'inspiry_site_logo_customizer' );
endif;


if ( ! function_exists( 'inspiry_site_logo_render' ) ) {
	function inspiry_site_logo_render() {
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			if ( get_option( 'theme_sitelogo' ) ) {
				echo '<a href="' . esc_url( home_url() ) . '"><img src="' . esc_url( get_option( 'theme_sitelogo' ) ) . '" alt=""></a>';
			} elseif ( get_bloginfo( 'name' ) ) {
				echo '<h2 class="logo-heading"><a href="' . esc_url( home_url() ) . '">';
				bloginfo( 'name' );
				echo '</a></h2>';
			}
			$description 	= get_bloginfo( 'description' );
		    if ( $description ) {
		        echo '<div class="tag-line"><span>';
		        echo esc_html( $description );
		        echo '</span></div>';
		    }
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			if ( get_option( 'theme_sitelogo' ) ) {
				echo '<a href="' . esc_url( home_url() ) . '"><img src="' . esc_url( get_option( 'theme_sitelogo' ) ) . '" alt=""></a>';
			} elseif ( get_bloginfo( 'name' ) ) {
				echo '<h2 class="rh_logo__heading"><a href="' . esc_url( home_url() ) . '">';
				bloginfo( 'name' );
				echo '</a></h2>';
			}
		}
	}
}


if ( ! function_exists( 'inspiry_site_desc_render' ) ) {
	function inspiry_site_desc_render() {
		$description 	= get_bloginfo( 'description' );
	    if ( $description && ( 'classic' === INSPIRY_DESIGN_VARIATION ) ) {
	        echo esc_html( $description );
	    } elseif ( $description && ( 'modern' === INSPIRY_DESIGN_VARIATION ) ) {
	    	echo '<span class="separator">/</span>' . esc_html( $description );
	    }
	}
}
