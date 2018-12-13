<?php
/**
 * Section:	`Search Form`
 * Panel: 	`Header`
 *
 * @since 3.4.1
 */

if ( ! function_exists( 'inspiry_header_search_form_customizer' ) ) :

	/**
	 * inspiry_header_search_form_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  3.4.1
	 */

	function inspiry_header_search_form_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Header Search Form
		 */
		$wp_customize->add_section( 'inspiry_header_search_form', array(
			'title' => __( 'Search Form', 'framework' ),
			'panel' => 'inspiry_header_panel',
		) );

		/* Search Form Appearance in Header */
		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'inspiry_show_search_in_header', array(
					'type'      => 'option',
					'default'   => 1,
				)
			);
			$wp_customize->add_control(
				'inspiry_show_search_in_header', array(
					'label'     => esc_html__( 'Header Search Form', 'framework' ),
					'type'      => 'radio',
					'section'   => 'inspiry_header_search_form',
					'description'   => esc_html__( 'Enabling the Advance Search Form in header will hide the Advance Search Widget in the sidebar.', 'framework' ),
					'choices'   => array(
						0   => esc_html__( 'Hide', 'framework' ),
						1   => esc_html__( 'Show', 'framework' ),
					),
				)
			);
		}
	}

	add_action( 'customize_register', 'inspiry_header_search_form_customizer' );
endif;
