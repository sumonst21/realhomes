<?php
/**
 * Section:	`Search Form`
 * Panel: 	`Home`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_search_form_customizer' ) ) :

	/**
	 * inspiry_search_form_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 * @since  2.6.3
	 */

	function inspiry_search_form_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Home Search Section
		 */
		$wp_customize->add_section( 'inspiry_home_search', array(
			'title' 			=> __( 'Search Form', 'framework' ),
			'panel' 			=> 'inspiry_home_panel',
			'active_callback'	=> 'inspiry_no_search_form_over_image',
		) );

		/* Show/Hide Properties Search Form on Homepage */
		$wp_customize->add_setting( 'theme_show_home_search', array(
			'type' 		=> 'option',
			'default'	=> 'true',
		) );
		$wp_customize->add_control( 'theme_show_home_search', array(
			'label' 			=> __( 'Properties Search Form on Homepage', 'framework' ),
			'description' 		=> __( 'You can configure properties search form using related section.', 'framework' ),
			'type' 				=> 'radio',
			'section' 			=> 'inspiry_home_search',
			'active_callback'	=> 'inspiry_no_search_form_over_image',
			'choices' 	=> array(
				'true' 	=> __( 'Show', 'framework' ),
				'false'	=> __( 'Hide', 'framework' ),
			),
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/**
			 * Enable Search Label Image
			 */
			$wp_customize->add_setting( 'inspiry_enable_search_label_image', array(
				'type' => 'option',
				'transport' => 'postMessage',
				'default' => 'true',
			) );
			$wp_customize->add_control( 'inspiry_enable_search_label_image', array(
				'label' => esc_html__( 'Enable Advance Search Label', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_home_search',
				'choices' => array(
					'true' => esc_html__( 'Show', 'framework' ),
					'false' => esc_html__( 'Hide', 'framework' ),
				),
			) );
			// Selective refresh for Enable Search Label Image.
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'inspiry_enable_search_label_image', array(
					'selector' => '.home .rh_prop_search__buttons:after',
					'container_inclusive' => false,
					'render_callback' => 'inspiry_enable_search_label_image_render',
				) );
			}

//			/**
//			 * Advance Search Label Image
//			 */
//			$wp_customize->add_setting( 'inspiry_search_label_image', array(
//				'type' => 'option',
//				'transport' => 'postMessage',
//				'default' => INSPIRY_DIR_URI . '/images/advance-search-arrow.png',
//				'sanitize_callback' => 'esc_url_raw',
//			) );
//			$wp_customize->add_control(
//				new WP_Customize_Image_Control(
//					$wp_customize,
//					'inspiry_search_label_image',
//					array(
//						'label' => esc_html__( 'Advance Search Label Image', 'framework' ),
//						'section' => 'inspiry_home_search',
//					)
//				)
//			);


//			$wp_customize->add_setting( 'inspiry_advance_search_label_or', array() );
//			$wp_customize->add_control(
//				new Inspiry_Intro_Customize_Control(
//					$wp_customize,
//					'inspiry_advance_search_label_or',
//					array(
//						'section' => 'inspiry_home_search',
//						'label' => __( 'OR', 'framework' ),
//					)
//				)
//			);


			/**
			 * Advance Search Label Text
			 */
			$wp_customize->add_setting( 'inspiry_search_label_text', array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => 'Advance Search'
			) );

			$wp_customize->add_control( 'inspiry_search_label_text', array(
				'label'       => __( 'Advance Search Label Text', 'framework' ),
				'description' => __( 'This text will be replaced with Advance Search Label Image', 'framework' ),
				'type'     => 'text',
				'section'  => 'inspiry_home_search',
				'settings' => 'inspiry_search_label_text',
			) );



			// Selective refresh for Advance Search Label Image.
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial( 'inspiry_search_label_image', array(
					'selector' => '.home .rh_prop_search__buttons:after',
					'container_inclusive' => false,
					'render_callback' => 'inspiry_enable_search_label_image_render',
				) );
			}
		}

	}

	add_action( 'customize_register', 'inspiry_search_form_customizer' );
endif;


if ( ! function_exists( 'inspiry_search_form_defaults' ) ) :

	/**
	 * inspiry_search_form_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_search_form_defaults( WP_Customize_Manager $wp_customize ) {
		$search_form_settings_ids = array(
			'theme_show_home_search'
		);
		inspiry_initialize_defaults( $wp_customize, $search_form_settings_ids );
	}
	add_action( 'customize_save_after', 'inspiry_search_form_defaults' );
endif;


if ( ! function_exists( 'inspiry_no_search_form_over_image' ) ) {
	/**
	 * Checks if there is no search form over image
	 * @return true|false
	 */
	function inspiry_no_search_form_over_image(){
		$theme_homepage_module = get_option( 'theme_homepage_module');
		if( $theme_homepage_module == 'search-form-over-image' ) {
			return false;
		}
		return true;
	}
}


if ( ! function_exists( 'inspiry_enable_search_label_image_render' ) ) {

	/**
	 * Selective refresh callback for enable
	 * search label image.
	 *
	 * @author Ashar Irfan
	 * @since  3.3.1
	 */
	function inspiry_enable_search_label_image_render() {
		if ( 'true' === get_option( 'inspiry_enable_search_label_image' ) ) :
			?>
			<style type="text/css">
				.home .rh_prop_search__buttons:after {
					background-image: url('<?php echo esc_attr( get_option( 'inspiry_search_label_image' ) ); ?>');
				}
			</style>
			<?php
		endif;
	}
}
