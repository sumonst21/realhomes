<?php
/**
 * Section:	`Sections Manager`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_sections_manager_customizer' ) ) :

	/**
	 * inspiry_sections_manager_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */

	function inspiry_sections_manager_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Sections Manager
		 */
		$wp_customize->add_section( 'inspiry_home_sections_manager', array(
			'title' => __( 'Sections Manager', 'framework' ),
			'panel'	=> 'inspiry_home_panel',
		) );

        // Homepage Sections Order
        $wp_customize->add_setting( 'inspiry_home_sections_order', array(
            'type' 				=> 'option',
            'default' 			=> 'home-properties,features-section,featured-properties,blog-posts',
            'sanitize_callback'	=> 'sanitize_text_field'
        ) );
        $wp_customize->add_control( new Inspiry_Dragdrop_Control(
        	$wp_customize,
        	'inspiry_home_sections_order',
        	array(
	            'label' 		=> esc_html__( 'Sections Order', 'framework' ),
	            'section' 		=> 'inspiry_home_sections_manager',
	            'settings'		=> 'inspiry_home_sections_order',
	            'choices' 		=> array(
	                'home-properties'      	=> esc_html__( 'Home Properties', 'framework' ),
	                'features-section'     	=> esc_html__( 'Features Section', 'framework' ),
	                'featured-properties'	=> esc_html__( 'Featured Properties', 'framework' ),
	                'blog-posts'          	=> esc_html__( 'News/Blog Posts', 'framework' )
	            )
        	)
        ) );

	}

	add_action( 'customize_register', 'inspiry_sections_manager_customizer' );
endif;


if ( ! function_exists( 'inspiry_sections_manager_defaults' ) ) :

	/**
	 * inspiry_sections_manager_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_sections_manager_defaults( WP_Customize_Manager $wp_customize ) {
		$sections_manager_settings_ids = array(
			'inspiry_home_sections_order'
		);
		inspiry_initialize_defaults( $wp_customize, $sections_manager_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_sections_manager_defaults' );
endif;
