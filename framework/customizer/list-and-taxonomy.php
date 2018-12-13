<?php
/**
 * Properties List Template and Taxonomy Archive Pages Settings
 *
 * @package RH
 */

if ( ! function_exists( 'inspiry_list_taxonomy_customizer' ) ) :
	function inspiry_list_taxonomy_customizer( WP_Customize_Manager $wp_customize ) {

		global $inspiry_pages;

		/**
		 * Properties List Templates and Taxonomy Archives Section
		 */
		$wp_customize->add_section( 'inspiry_list_and_taxonomy', array(
			'title' => __( 'List Templates & Taxonomy Archives', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/* Header Variation */
			$wp_customize->add_setting( 'inspiry_listing_header_variation', array(
				'type'		=> 'option',
				'default' 	=> 'banner',
			) );

			$wp_customize->add_control( 'inspiry_listing_header_variation', array(
				'label' 	=> __( 'Header Variation', 'framework' ),
				'description' => __( 'Header variation to display on Properties List Templates and Taxonomy Archive pages.', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_list_and_taxonomy',
				'choices' 	=> array(
					'banner'	=> __( 'Banner', 'framework' ),
					'none'		=> __( 'None', 'framework' ),
				),
			) );
		}

		/* Module Below Header  */
		$wp_customize->add_setting( 'theme_listing_module', array(
			'type' => 'option',
			'default' => 'simple-banner',
		) );

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_control( 'theme_listing_module', array(
				'label' => __( 'Module Below Header', 'framework' ),
				'description' => __( 'What to display in area below header on Properties List Templates and Taxonomy Archive pages ?', 'framework' ),
				'type' => 'radio',
				'section' => 'inspiry_list_and_taxonomy',
				'choices' => array(
					'properties-map' => __( 'Google Map With Properties Markers', 'framework' ),
					'simple-banner' => __( 'Image Banner', 'framework' ),
				),
			) );
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_control( 'theme_listing_module', array(
				'label' 	=> __( 'Module Below Header', 'framework' ),
				'description' => __( 'What to display in area below header on Properties List Templates and Taxonomy Archive pages ?', 'framework' ),
				'type' 		=> 'radio',
				'section'	=> 'inspiry_list_and_taxonomy',
				'choices' 	=> array(
					'properties-map'	=> __( 'Google Map With Properties Markers', 'framework' ),
					'simple-banner'		=> __( 'None', 'framework' ),
				),
			) );
		}

		/* Layout  */
		$wp_customize->add_setting( 'theme_listing_layout', array(
			'type' => 'option',
			'default' => 'list',
		) );
		$wp_customize->add_control( 'theme_listing_layout', array(
			'label' => __( 'Default Layout', 'framework' ),
			'description' => __( 'Select the default layout for taxonomy archive pages.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_list_and_taxonomy',
			'choices' => array(
				'list' => __( 'List Layout', 'framework' ),
				'grid' => __( 'Grid Layout', 'framework' ),
			),
		) );

		/* Number of Properties  */
		$wp_customize->add_setting( 'theme_number_of_properties', array(
			'type' => 'option',
			'default' => '3',
		) );
		$wp_customize->add_control( 'theme_number_of_properties', array(
			'label' => __( 'Number of Properties', 'framework' ),
			'description' => __( 'Select the maximum number of properties to display on a page.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_list_and_taxonomy',
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
				'10' => 10,
				'11' => 11,
				'12' => 12,
				'13' => 13,
				'14' => 14,
				'15' => 15,
				'16' => 16,
				'17' => 17,
				'18' => 18,
				'19' => 19,
				'20' => 20,
			),
		) );

		// Skip Sticky Properties Option.
		$wp_customize->add_setting( 'inspiry_listing_skip_sticky', array(
			'type'		=> 'option',
			'default'	=> false,
		) );
		$wp_customize->add_control( 'inspiry_listing_skip_sticky', array(
			'label' 	=> __( 'Skip Sticky Properties','framework' ),
			'description' => __( 'Check to skip sticky properties on listing page.','framework' ),
			'section' 	=> 'inspiry_list_and_taxonomy',
			'type'      => 'checkbox',
		) );

		/* Default Sort Order  */
		$wp_customize->add_setting( 'theme_listing_default_sort', array(
			'type' => 'option',
			'default' => 'date-desc',
		) );
		$wp_customize->add_control( 'theme_listing_default_sort', array(
			'label' => __( 'Default Sort Order', 'framework' ),
			'description' => __( 'Select the default sort order for Search Results, List Templates and Taxonomy Archive pages.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_list_and_taxonomy',
			'choices' => array(
				'price-asc' => __( 'Price - Low to High', 'framework' ),
				'price-desc' => __( 'Price - High to Low', 'framework' ),
				'date-asc' => __( 'Date - Old to New', 'framework' ),
				'date-desc' => __( 'Date - New to Old', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_list_taxonomy_customizer' );
endif;


if ( ! function_exists( 'inspiry_list_taxonomy_defaults' ) ) :
	/**
	 * Set default values for list and taxonomy settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_list_taxonomy_defaults( WP_Customize_Manager $wp_customize ) {
		$list_taxonomy_settings_ids = array(
			'inspiry_listing_header_variation',
			'theme_listing_module',
			'theme_listing_layout',
			'theme_number_of_properties',
			'theme_listing_default_sort',
		);
		inspiry_initialize_defaults( $wp_customize, $list_taxonomy_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_list_taxonomy_defaults' );
endif;
