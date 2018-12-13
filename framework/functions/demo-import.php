<?php
/**
 * Functions related to demo import
 */

if ( ! function_exists( 'inspiry_demo_import_files' ) ) {

	/**
	 * Files for importing demo.
	 *
	 * @return array
	 * @since  3.0.0
	 */
	function inspiry_demo_import_files() {
		return array(
			array(
				'import_file_name'             => 'Classic',
				'local_import_file'            => trailingslashit( get_template_directory() ) . 'framework/demos/classic/contents.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'framework/demos/classic/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'framework/demos/classic/customizer.dat',
				'import_preview_image_url'     => get_template_directory_uri() . '/framework/demos/classic/demo.jpg',
				'preview_url'                  => 'http://classic.realhomes.io/',
			),
			array(
				'import_file_name'             => 'Modern',
				'local_import_file'            => trailingslashit( get_template_directory() )  . 'framework/demos/modern/contents.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() )  . 'framework/demos/modern/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() )  . 'framework/demos/modern/customizer.dat',
				'import_preview_image_url'     => get_template_directory_uri() . '/framework/demos/modern/demo.jpg',
				'preview_url'                  => 'http://modern.realhomes.io/',
			),
		);
	}
	add_filter( 'pt-ocdi/import_files', 'inspiry_demo_import_files' );
}


if ( ! function_exists( 'inspiry_settings_after_content_import' ) ) {
	/**
	 * Required settings after demo import.
	 */
	function inspiry_settings_after_content_import( $selected_import ) {

		// Update design setting
		if ( 'Classic' === $selected_import[ 'import_file_name' ] ) {

			update_option( 'inspiry_design_variation', 'classic' );

		} elseif ( 'Modern' === $selected_import[ 'import_file_name' ] ) {

			update_option( 'inspiry_design_variation', 'modern' );

		}

		// Assign menu to right location
		$locations = get_theme_mod( 'nav_menu_locations' );
		if ( ! empty( $locations ) and is_array( $locations ) ) {
			foreach ( $locations as $locationId => $menuValue ) {
				$menu = null;
				switch ( $locationId ) {
					case 'main-menu':
						$menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
						break;

					case 'responsive-menu':
						$menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
						break;
				}
				if ( !empty( $menu ) ) {
					$locations[ $locationId ] = $menu->term_id;
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );
		}

		// Set homepage as front page and blog page as posts page
		$home_page = get_page_by_title( 'Home' );
		$blog_page = get_page_by_title( 'News' );
		if ( $home_page || $blog_page ) {
			update_option( 'show_on_front', 'page' );
		}
		if ( $home_page ) {
			update_option( 'page_on_front', $home_page->ID );
		}
		if ( $blog_page ) {
			update_option( 'page_for_posts', $blog_page->ID );
			update_option( 'posts_per_page', 4 );
		}

		/*
		// basic theme options configuration
		$admin_email = get_option( 'admin_email' );
		$demo_theme_options = array(
			'theme_show_social_menu' => 'true',
			'theme_twitter_link' => '#',
			'theme_facebook_link' => '#',
			'theme_google_link' => '#',
			'theme_header_email' => $admin_email,
			'theme_header_phone' => '0-123-456-789',
			'theme_homepage_module' => 'properties-slider',
			'theme_number_of_slides' => 3,
			'theme_show_home_search' => 'true',
			'theme_search_module' => 'properties-map',
			'theme_home_advance_search_title' => 'Find Your Home',
			'theme_search_fields' => array(
				'keyword-search', 'location', 'status', 'type', 'min-beds', 'min-baths', 'min-max-price', 'min-max-area', 'features'
			),
			'theme_show_home_properties' => 'true',
			'theme_slogan_title' => 'Slogan title  will appear on Homepage below slider.',
			'theme_slogan_text' => 'Slogan text  will appear on Homepage below slider.',
			'theme_home_properties' => 'recent',
			'theme_sorty_by' => 'recent',
			'theme_show_featured_properties' => 'true',
			'theme_featured_prop_title' => 'Featured Properties',
			'theme_featured_prop_text' => 'Check out these amazing properties.',
			'theme_show_news_posts' => 'true',
			'theme_news_posts_title' => 'Blog Posts',
			'theme_news_posts_text' => 'Our recent blog posts.',
			'theme_property_detail_variation' => 'default',
			'theme_additional_details_title' => 'Additional Details',
			'theme_property_features_title' => 'Features',
			'theme_display_video' => 'true',
			'theme_display_google_map' => 'true',
			'theme_property_map_title' => 'Property Map',
			'theme_display_social_share' => 'true',
			'theme_display_attachments' => 'true',
			'theme_property_attachments_title' => 'Property Attachments',
			'theme_child_properties_title' => 'Sub Properties',
			'theme_display_agent_info' => 'true',
			'theme_display_similar_properties' => 'true',
			'theme_similar_properties_title' => 'Similar Properties',
			'theme_news_banner_title' => 'News',
			'theme_news_banner_sub_title' => 'Know about market updates',
			'theme_gallery_banner_title' => 'Gallery',
			'theme_gallery_banner_sub_title' => 'Look for your desired property more efficiently',
			'theme_currency_sign' => '$',
			'theme_currency_position' => 'before',
			'theme_decimals' => 2,
			'theme_dec_point' => '.',
			'theme_thousands_sep' => ',',
			'theme_no_price_text' => '',
			'theme_minimum_price_values' => '1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000',
			'theme_maximum_price_values' => '5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000',
			'theme_status_for_rent' => 'for-rent',
			'theme_minimum_price_values_for_rent' => '500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000',
			'theme_maximum_price_values_for_rent' => '1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000',
			'theme_listing_module' => 'simple-banner',
			'theme_listing_layout' => 'list',
			'theme_number_of_properties' => 6,
			'theme_listing_default_sort' => 'date-desc',
			'theme_number_posts_agent' => 3,
			'theme_lightbox_plugin' => 'swipebox',
			'theme_show_contact_map' => 'true',
			'theme_map_lati' => '-37.817917',
			'theme_map_longi' => '144.965065',
			'theme_map_zoom' => 17,
			'theme_contact_form_heading' => 'Send us a message',
			'theme_contact_email' => $admin_email,
			'theme_show_partners' => 'true',
			'theme_partners_title' => 'Partners',
			'theme_enable_user_nav' => 'true',
			'theme_submitted_status' => 'pending',
			'theme_submit_default_address' => '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
			'theme_submit_default_location' => '25.7308309,-80.44414899999998',
			'theme_submit_message' => 'Thanks for Submitting Property!',
			'theme_submit_notice_email' => $admin_email,
			'theme_enable_fav_button' => 'true',
			'theme_enable_paypal' => 'false',
			'inspiry_heading_font' => 'Default',
			'inspiry_secondary_font' => 'Default',
			'inspiry_body_font' => 'Default',
		);


		// search page
		$search_page = get_page_by_title( 'Property Search' );
		if ( $search_page ) {
			$demo_theme_options[ 'inspiry_search_page' ] = $search_page->ID;
		}

		// profile page
		$edit_profile = get_page_by_title( 'Edit Profile' );
		if ( $edit_profile ) {
			$demo_theme_options[ 'inspiry_edit_profile_page' ] = $edit_profile->ID;
		}

		// submit page
		$submit_page = get_page_by_title( 'Submit Property' );
		if ( $submit_page ) {
			$demo_theme_options[ 'inspiry_submit_property_page' ] = $submit_page->ID;
		}

		// my properties page
		$my_properties_page = get_page_by_title( 'My Properties' );
		if ( $search_page ) {
			$demo_theme_options[ 'inspiry_my_properties_page' ] = $my_properties_page->ID;
		}

		// favorites page
		$favorites_page = get_page_by_title( 'Favorites' );
		if ( $search_page ) {
			$demo_theme_options[ 'inspiry_favorites_page' ] = $favorites_page->ID;
		}

		// loop over all options in array and update the options table in database.
		foreach ( $demo_theme_options as $key => $value ) {
			$existing_value = get_option( $key );
			if ( empty( $existing_value ) ) {
				update_option( $key, $value );
			}
		}
		*/
	}

	add_action( 'pt-ocdi/after_import', 'inspiry_settings_after_content_import' );

}


// Disable branding notice at the end of import.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
