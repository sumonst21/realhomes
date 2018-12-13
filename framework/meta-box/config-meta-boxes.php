<?php
/**
 * Register Meta Boxes
 *
 * @package RH
 * @since 1.0.0
 */

add_filter( 'rwmb_meta_boxes', 'inspiry_register_meta_boxes' );

if ( ! function_exists( 'inspiry_register_meta_boxes' ) ) {

	/**
	 * Register meta boxes function.
	 *
	 * @param array $meta_boxes - Array of meta boxes of the theme.
	 * @since 1.0.0
	 */
	function inspiry_register_meta_boxes( $meta_boxes ) {

		$prefix = 'woo_auction_';

		// Get design variation.
		$rh_design_variation = INSPIRY_DESIGN_VARIATION;

		/* Get Google Maps API Key if available */
		$google_maps_api_key = get_option( 'inspiry_google_maps_api_key' );
		if ( ! empty( $google_maps_api_key ) ) {
			$google_maps_api_key = urlencode( $google_maps_api_key );
		}

		// Video embed code meta box for video post format.
		$meta_boxes[] = array(
			'id' => 'video-meta-box',
			'title' => esc_html__( 'Video Embed Code', 'framework' ),
			'post_types' => array( 'post' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => esc_html__( 'Video Embed Code', 'framework' ),
					'desc' => esc_html__( 'If you are not using self hosted videos then please provide the video embed code and remove the width and height attributes.', 'framework' ),
					'id' => "{$prefix}embed_code",
					'type' => 'textarea',
					'cols' => '20',
					'rows' => '3',
				),
			),
		);

		// Gallery Meta Box.
		$meta_boxes[] = array(
			'id' => 'gallery-meta-box',
			'title' => esc_html__( 'Gallery Images', 'framework' ),
			'post_types' => array( 'post' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => esc_html__( 'Upload Gallery Images', 'framework' ),
					'id' => "{$prefix}gallery",
					'desc' => esc_html__( 'Images should have minimum width of 830px and minimum height of 323px, Bigger size images will be cropped automatically.', 'framework' ),
					'type' => 'image_advanced',
					'max_file_uploads' => 48,
				),
			),
		);

		// Agents.
		$agents_array = array(
			-1 => esc_html__( 'None', 'framework' ),
		);
		$agents_posts = get_posts(
			array(
				'post_type' => 'agent',
				'posts_per_page' => -1,
				'suppress_filters' => 0,
			)
		);
		if ( count( $agents_posts ) > 0 ) {
			foreach ( $agents_posts as $agent_post ) {
				$agents_array[ $agent_post->ID ] = $agent_post->post_title;
			}
		}

		// Property Details Meta Box.
		$meta_boxes[] = array(
			'id' => 'property-meta-box',
			'title' => esc_html__( 'Property', 'framework' ),
			'post_types' => array( 'property', 'product' ),
			'tabs' => array(
				'details' => array(
					'label' => esc_html__( 'Basic Information', 'framework' ),
					'icon' => 'dashicons-admin-home',
				),
				/*
				'auction' => array(
					'label' => esc_html__( 'Auction Details', 'framework' ),
					'icon' => 'dashicons-hammer',
				),*/
				'gallery' => array(
					'label' => esc_html__( 'Gallery Images', 'framework' ),
					'icon' => 'dashicons-format-gallery',
				),
				'floor-plans' => array(
					'label' => esc_html__( 'Floor Plans', 'framework' ),
					'icon' => 'dashicons-layout',
				),
				'video' => array(
					'label' => esc_html__( 'Property Video', 'framework' ),
					'icon' => 'dashicons-format-video',
				),
				'agent' => array(
					'label' => esc_html__( 'Agent Information', 'framework' ),
					'icon' => 'dashicons-businessman',
				),
				'misc' => array(
					'label' => esc_html__( 'Misc', 'framework' ),
					'icon' => 'dashicons-lightbulb',
				),
				'home-slider' => array(
					'label' => esc_html__( 'Homepage Slider', 'framework' ),
					'icon' => 'dashicons-images-alt',
				),
				'banner' => array(
					'label' => esc_html__( 'Top Banner', 'framework' ),
					'icon' => 'dashicons-format-image',
				),
			),
			'tab_style' => 'left',
			'fields' => array(

				// Details.
				array(
					'id' => "{$prefix}property_price",
					'name' => esc_html__( 'Sale or Rent Price ( Only digits )', 'framework' ),
					'desc' => esc_html__( 'Example Value: 435000', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_price_postfix",
					'name' => esc_html__( 'Price Postfix', 'framework' ),
					'desc' => esc_html__( 'Example Value: Per Month', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_size",
					'name' => esc_html__( 'Area Size ( Only digits )', 'framework' ),
					'desc' => esc_html__( 'Example Value: 2500', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_size_postfix",
					'name' => esc_html__( 'Area Size Postfix', 'framework' ),
					'desc' => esc_html__( 'Example Value: sq ft', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_lot_size",
					'name' => esc_html__( 'Lot Size ( Only digits )', 'framework' ),
					'desc' => esc_html__( 'Example Value: 3000', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_lot_size_postfix",
					'name' => esc_html__( 'Lot Size Postfix', 'framework' ),
					'desc' => esc_html__( 'Example Value: sq ft', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_bedrooms",
					'name' => esc_html__( 'Bedrooms', 'framework' ),
					'desc' => esc_html__( 'Example Value: 4', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_bathrooms",
					'name' => esc_html__( 'Bathrooms', 'framework' ),
					'desc' => esc_html__( 'Example Value: 2', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_garage",
					'name' => esc_html__( 'Garages', 'framework' ),
					'desc' => esc_html__( 'Example Value: 1', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_id",
					'name' => esc_html__( 'Property ID', 'framework' ),
					'desc' => esc_html__( 'It will help you search a property directly.', 'framework' ),
					'type' => 'text',
					'std' => ( 'true' === get_option( 'inspiry_auto_property_id_check' ) ) ? get_option( 'inspiry_auto_property_id_pattern' ) : '',
					'columns' => 6,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_year_built",
					'name' => esc_html__( 'Year Built', 'framework' ),
					'desc' => esc_html__( 'Example Value: 2017', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 12,
					'tab' => 'details',
				),
				// Featured Property.
				array(
					'type' => 'divider',
					'columns' => 12,
					'id' => 'featured_property_divider',
					'tab' => 'details',
				),
				array(
					'name' => esc_html__( 'Mark this property as featured ?', 'framework' ),
					'id' => "{$prefix}featured",
					'type' => 'checkbox',
					'std' => 0,
					'desc' => esc_html__( 'Yes', 'framework' ),
					'columns' => 12,
					'tab' => 'details',
				),

				/** Auction Details  */

				// Enable Auction Property.
				/*
				array(
					'name' => esc_html__( 'Auction this property ?', 'framework' ),
					'id' => "{$prefix}auction_enabled",
					'type' => 'checkbox',
					'std' => 0,
					'desc' => esc_html__( 'Yes', 'framework' ),
					'columns' => 12,
					'tab' => 'auction',
				),
				array(
					'type' => 'divider',
					'columns' => 12,
					'id' => 'auction_property_divider',
					'tab' => 'auction',
				),
				// Auction Start Price
				array(
					'id' => "{$prefix}auction_start_price",
					'name' => esc_html__( 'Start Price: ( Only digits )', 'framework' ),
					'desc' => esc_html__( 'Example Value: 435000', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'auction',
				),
				// Auction Price Increase
				array(
					'id' => "{$prefix}auction_price_increase",
					'name' => esc_html__( 'Bid Increase Price: ( Only digits )', 'framework' ),
					'desc' => esc_html__( 'Example Value: 1000', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'auction',
				),
				// Auction Time Increase
				array(
					'id' => "{$prefix}auction_time_increase",
					'name' => esc_html__( 'Time Increase: ( By seconds )', 'framework' ),
					'desc' => esc_html__( 'Example Value: 60', 'framework' ),
					'type' => 'text',
					'std' => '',
					'columns' => 6,
					'tab' => 'auction',
				),
				// Auction Starting Date Time
				array(
					'id' => "{$prefix}auction_starting",
					'name' => esc_html__( 'Auction Starting On:', 'framework' ),
					'desc' => esc_html__( 'Example Value: 2018-12-20 05:21', 'framework' ),
					'type' => 'datetime',
					'std' => '',
					'columns' => 6,
					'tab' => 'auction',
				),
				// Auction Ending Date Time
				array(
					'id' => "{$prefix}auction_ending",
					'name' => esc_html__( 'Auction Ending On:', 'framework' ),
					'desc' => esc_html__( 'Example Value: 2018-12-20 05:21', 'framework' ),
					'type' => 'datetime',
					'std' => '',
					'columns' => 6,
					'tab' => 'auction',
				),
				array(
					'type' => 'divider',
					'columns' => 12,
					'id' => 'auction_closed_divider',
					'tab' => 'auction',
				),
				// Closed Auction Property.
				array(
					'name' => esc_html__( 'Closed Auction', 'framework' ),
					'id' => "{$prefix}auction_closed",
					'type' => 'checkbox',
					'std' => 0,
					'desc' => esc_html__( 'Yes', 'framework' ),
					'columns' => 12,
					'tab' => 'auction',
				),
				*/

				// Map.
				array(
					'type' => 'divider',
					'columns' => 12,
					'id' => 'google_map_divider',
					'tab' => 'details',
				),
				array(
					'name' => esc_html__( 'Do you want to hide Google map on property detail page ?', 'framework' ),
					'id' => "{$prefix}property_map",
					'type' => 'checkbox',
					'std' => 0,
					'desc' => __( 'Yes', 'framework' ),
					'columns' => 12,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_address",
					'name' => esc_html__( 'Property Address', 'framework' ),
					'desc' => esc_html__( 'Leaving it empty will hide the google map on property detail page.', 'framework' ),
					'type' => 'text',
					'std' => get_option( 'theme_submit_default_address' ),
					'columns' => 12,
					'tab' => 'details',
				),
				array(
					'id' => "{$prefix}property_location",
					'name' => esc_html__( 'Property Location at Google Map*', 'framework' ),
					'desc' => esc_html__( 'Drag the google map marker to point your property location. You can also use the address field above to search for your property.', 'framework' ),
					'type' => 'map',
					'api_key' => $google_maps_api_key,
					'std' => get_option( 'theme_submit_default_location' ),   // 'latitude,longitude[,zoom]' (zoom is optional)
					'style' => 'width: 95%; height: 400px',
					'address_field' => "{$prefix}property_address",
					'columns' => 12,
					'tab' => 'details',
				),

				// Gallery.
				array(
					'name' => esc_html__( 'Gallery Type You Want to Use', 'framework' ),
					'id' => "{$prefix}gallery_slider_type",
					'type' => ( 'modern' === INSPIRY_DESIGN_VARIATION ) ? 'hidden' : 'radio',
					'std' => 'thumb-on-right',
					'options' => array(
						'thumb-on-right' => esc_html__( 'Gallery with thumbnails on right', 'framework' ),
						'thumb-on-bottom' => esc_html__( 'Gallery with thumbnails on bottom', 'framework' ),
					),
					'columns' => 12,
					'tab' => 'gallery',
				),
				array(
					'name' => esc_html__( 'Property Gallery Images', 'framework' ),
					'id' => "{$prefix}property_images",
					'desc' => inspiry_property_gallery_meta_desc(),
					'type' => 'image_advanced',
					'max_file_uploads' => 48,
					'columns' => 12,
					'tab' => 'gallery',
				),

				// Floor Plans.
				array(
					'id'    => 'inspiry_floor_plans',
					'type'  => 'group',
					'columns' => 12,
					'clone' => true,
					'tab'   => 'floor-plans',
					'fields' => array(
						array(
							'name' => esc_html__( 'Floor Name', 'framework' ),
							'id'   => 'inspiry_floor_plan_name',
							'desc' => esc_html__( 'Example: Ground Floor', 'framework' ),
							'type' => 'text',
						),
						array(
							'name' => esc_html__( 'Floor Price ( Only digits )', 'framework' ),
							'id'   => 'inspiry_floor_plan_price',
							'desc' => esc_html__( 'Example: 4000', 'framework' ),
							'type' => 'text',
							'columns' => 6,
						),
						array(
							'name' => esc_html__( 'Price Postfix', 'framework' ),
							'id'   => 'inspiry_floor_plan_price_postfix',
							'desc' => esc_html__( 'Example: Per Month', 'framework' ),
							'type' => 'text',
							'columns' => 6,
						),
						array(
							'name' => esc_html__( 'Floor Size ( Only digits )', 'framework' ),
							'id'   => 'inspiry_floor_plan_size',
							'desc' => esc_html__( 'Example: 2500', 'framework' ),
							'type' => 'text',
							'columns' => 6,
						),
						array(
							'name' => esc_html__( 'Size Postfix', 'framework' ),
							'id'   => 'inspiry_floor_plan_size_postfix',
							'desc' => esc_html__( 'Example: sq ft', 'framework' ),
							'type' => 'text',
							'columns' => 6,
						),
						array(
							'name' => esc_html__( 'Bedrooms', 'framework' ),
							'id'   => 'inspiry_floor_plan_bedrooms',
							'desc' => esc_html__( 'Example: 4', 'framework' ),
							'type' => 'text',
							'columns' => 6,
						),
						array(
							'name' => esc_html__( 'Bathrooms', 'framework' ),
							'id'   => 'inspiry_floor_plan_bathrooms',
							'desc' => esc_html__( 'Example: 2', 'framework' ),
							'type' => 'text',
							'columns' => 6,
						),
						array(
							'name' => esc_html__( 'Description', 'framework' ),
							'id'   => 'inspiry_floor_plan_descr',
							'type' => 'textarea',
						),
						array(
							'name' => esc_html__( 'Floor Plan Image', 'framework' ),
							'id'   => 'inspiry_floor_plan_image',
							'desc' => esc_html__( 'The recommended minimum width is 770px and height is flexible.', 'framework' ),
							'type' => 'file_input',
							'max_file_uploads' => 1,
						),
					),
				),

				// Property Video.
				array(
					'id' => "{$prefix}tour_video_url",
					'name' => esc_html__( 'Virtual Tour Video URL', 'framework' ),
					'desc' => esc_html__( 'Provide virtual tour video URL. YouTube, Vimeo, SWF File and MOV File are supported', 'framework' ),
					'type' => 'text',
					'columns' => 12,
					'tab' => 'video',
				),
				array(
					'name' => esc_html__( 'Virtual Tour Video Image', 'framework' ),
					'id' => "{$prefix}tour_video_image",
					'desc' => esc_html__( 'Provide an image that will be displayed as a place holder and when user will click over it the video will be opened in a lightbox. You must provide this image otherwise the video will not be displayed. Image should have minimum width of 818px and minimum height 417px. Bigger size images will be cropped automatically.', 'framework' ),
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'columns' => 12,
					'tab' => 'video',
				),
				// Virtual Tour.
				array(
					'type' => 'divider',
					'columns' => 12,
					'id' => 'virtual_tour_divider',
					'tab' => 'video',
				),
				array(
					'name' => esc_html__( '360 Virtual Tour', 'framework' ),
					'id' => "{$prefix}360_virtual_tour",
					'desc' => wp_kses(
						__( 'Provide iframe embed code for the 360 virtual tour. For more details please consult <a href="https://realhomes.io/documentation/add-property/#add-video-tour-and-virtual-tour" target="_blank">Add Property</a> in documentation.', 'framework' ),
						array(
							'a' => array(
								'href' => array(),
								'target' => array(),
							),
						)
					),
					'type' => 'textarea',
					'columns' => 12,
					'tab' => 'video',
				),

				// Agents.
				array(
					'name' => esc_html__( 'What to display in agent information box ?', 'framework' ),
					'id' => "{$prefix}agent_display_option",
					'type' => 'radio',
					'std' => 'none',
					'options' => array(
						'my_profile_info' => esc_html__( 'Author information.', 'framework' ),
						'agent_info' => esc_html__( 'Agent Information. ( Select the agent below )', 'framework' ),
						'none' => esc_html__( 'None. ( Hide information box )', 'framework' ),
					),
					'columns' => 12,
					'tab' => 'agent',
				),
				array(
					'name' => esc_html__( 'Agent', 'framework' ),
					'id' => "{$prefix}agents",
					'type' => 'select',
					'options' => $agents_array,
					'multiple' => true,
					'columns' => 12,
					'tab' => 'agent',
				),

				// Misc.
				array(
					'id'    => "{$prefix}sticky",
					'type'  => 'checkbox',
					'name'  => esc_html__( 'Make this property sticky for home and listings pages', 'framework' ),
					'desc'  => esc_html__( 'Yes', 'framework' ),
					'std'   => 0,
					'columns'   => 12,
					'tab'       => 'misc',
				),
				// Property Label Separator.
				array(
					'type' => 'divider',
					'columns' => 12,
					'id' => 'property_label_divider',
					'tab' => 'misc',
				),
				array(
					'name' => esc_html__( 'Property Label Text', 'framework' ),
					'id' => 'inspiry_property_label',
					'desc' => esc_html__( 'You can add a property label to display on property thumbnails. Example Value: Hot Deal', 'framework' ),
					'type' => 'text',
					'columns' => 6,
					'tab' => 'misc',
				),
				array(
					'name' => esc_html__( 'Label Background Color', 'framework' ),
					'id' => 'inspiry_property_label_color',
					'desc' => esc_html__( 'Set a label background color. Otherwise label text will be displayed with transparent background.', 'framework' ),
					'type' => 'color',
					'columns' => 6,
					'tab' => 'misc',
				),
				// Property Attachments Separator.
				array(
					'type' => 'divider',
					'columns' => 12,
					'id' => 'property_attachments_divider',
					'tab' => 'misc',
				),
				array(
					'id' => "{$prefix}attachments",
					'name' => esc_html__( 'Attachments', 'framework' ),
					'desc' => esc_html__( 'You can attach PDF files, Map images OR other documents to provide further details related to property.', 'framework' ),
					'type' => 'file_advanced',
					'mime_type' => '',
					'columns' => 12,
					'tab' => 'misc',
				),
				// Property Owner Separator.
				array(
					'type' => 'divider',
					'columns' => 12,
					'id' => 'property_owner_divider',
					'tab' => 'misc',
				),
				array(
					'name' => esc_html__( 'Property Owner Name', 'framework' ),
					'id' => 'inspiry_property_owner_name',
					'type' => 'text',
					'columns' => 6,
					'tab' => 'misc',
				),
				array(
					'name' => esc_html__( 'Owner Contact', 'framework' ),
					'id' => 'inspiry_property_owner_contact',
					'type' => 'text',
					'columns' => 6,
					'tab' => 'misc',
				),
				array(
					'id' => 'inspiry_property_owner_address',
					'name' => esc_html__( 'Owner Address', 'framework' ),
					'type' => 'text',
					'columns' => 12,
					'tab' => 'misc',
				),
				array(
					'id' => "{$prefix}property_private_note",
					'name' => esc_html__( 'Private Note', 'framework' ),
					'desc' => esc_html__( 'In this textarea, You can write your private note about this property. This field will not be displayed anywhere else.', 'framework' ),
					'type' => 'textarea',
					'std' => '',
					'columns' => 12,
					'tab' => 'misc',
				),
				array(
					'id' => 'inspiry_message_to_reviewer',
					'name' => esc_html__( 'Message to Reviewer', 'framework' ),
					'type' => 'textarea',
					'columns' => 12,
					'tab' => 'misc',
				),

				// Homepage Slider.
				array(
					'name' => esc_html__( 'Do you want to add this property in Homepage Slider ?', 'framework' ),
					'desc' => esc_html__( 'If Yes, Then you need to provide a slider image below.', 'framework' ),
					'id' => "{$prefix}add_in_slider",
					'type' => 'radio',
					'std' => 'no',
					'options' => array(
						'yes' => esc_html__( 'Yes ', 'framework' ),
						'no' => esc_html__( 'No', 'framework' ),
					),
					'columns' => 12,
					'tab' => 'home-slider',
				),
				array(
					'name' => esc_html__( 'Slider Image', 'framework' ),
					'id' => "{$prefix}slider_image",
					'desc' => esc_html__( 'The recommended image size is 2000px by 700px. You can use bigger or smaller image but try to keep the same height to width ratio and use the exactly same size images for all properties that will be added in slider.', 'framework' ),
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'columns' => 12,
					'tab' => 'home-slider',
				),

				// Top Banner.
				array(
					'name' => esc_html__( 'Top Banner Image', 'framework' ),
					'id' => "{$prefix}page_banner_image",
					'desc' => esc_html__( 'Upload the banner image, If you want to change it for this property. Otherwise default banner image uploaded from theme options will be displayed. Image should have minimum width of 2000px and minimum height of 230px.', 'framework' ),
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'columns' => 12,
					'tab' => 'banner',
				),

			),
		);

		// Property Type Meta Box.
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Custom Property Type Map Icon', 'framework' ),
			'taxonomies' => 'property-type',
			'fields' => array(
				array(
					'name' => esc_html__( 'Icon Image', 'framework' ),
					'id'   => 'inspiry_property_type_icon',
					'type' => 'image_advanced',
					'mime_type' => 'image/png',
					'max_file_uploads' => 1,
				),
				array(
					'name' => esc_html__( 'Retina Icon Image', 'framework' ),
					'id'   => 'inspiry_property_type_icon_retina',
					'type' => 'image_advanced',
					'mime_type' => 'image/png',
					'max_file_uploads' => 1,
				),
			),
		);

		// Property Feature Meta Box.
		$meta_boxes[] = array(
			'title'      => 'Property Feature Icon',
			'taxonomies' => 'property-feature',
			'fields' => array(
				array(
					'name'  => esc_html__( 'Icon Image', 'framework' ),
					'desc'  => esc_html__( 'Recommended image size for icon is 64px by 64px.', 'framework' ),
					'id'    => 'inspiry_property_feature_icon',
					'type'  => 'image_advanced',
					'mime_type' => 'image/png',
					'max_file_uploads' => 1,
				),
			),
		);

		// Partners Meta Box.
		$meta_boxes[] = array(
			'id' => 'partners-meta-box',
			'title' => esc_html__( 'Partner Information', 'framework' ),
			'post_types' => array( 'partners' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => esc_html__( 'Website URL', 'framework' ),
					'id' => "{$prefix}partner_url",
					'desc' => esc_html__( 'Provide Website URL', 'framework' ),
					'type' => 'text',
				),
			),
		);

		// Agency meta Box.
		$meta_boxes[] = array(
			'id' => 'agency-meta-box',
			'title' => esc_html__( 'Provide Related Information', 'framework' ),
			'post_types' => array( 'agency' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => esc_html__( 'Email Address', 'framework' ),
					'id' => "{$prefix}agency_email",
					'desc' => esc_html__( 'Provide Agency Email Address. Agency related messages from contact form on property details page, will be sent on this email address.', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Mobile Number', 'framework' ),
					'id' => "{$prefix}mobile_number",
					'desc' => esc_html__( 'Provide Agency mobile number', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'WhatsApp Number', 'framework' ),
					'id' => "{$prefix}whatsapp_number",
					'desc' => esc_html__( 'Provide Agency whatsapp number', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Office Number', 'framework' ),
					'id' => "{$prefix}office_number",
					'desc' => esc_html__( 'Provide Agency office number', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Fax Number', 'framework' ),
					'id' => "{$prefix}fax_number",
					'desc' => esc_html__( 'Provide Agency fax number', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Facebook URL', 'framework' ),
					'id' => "{$prefix}facebook_url",
					'desc' => esc_html__( 'Provide Agency Facebook URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Twitter URL', 'framework' ),
					'id' => "{$prefix}twitter_url",
					'desc' => esc_html__( 'Provide Agency Twitter URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Google Plus URL', 'framework' ),
					'id' => "{$prefix}google_plus_url",
					'desc' => esc_html__( 'Provide Agency Google Plus URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'LinkedIn URL', 'framework' ),
					'id' => "{$prefix}linked_in_url",
					'desc' => esc_html__( 'Provide Agency LinkedIn URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Instagram URL', 'framework' ),
					'id' => 'inspiry_instagram_url',
					'desc' => esc_html__( 'Provide Agency Instagram URL', 'framework' ),
					'type' => 'text',
				),
			),
		);

		// Agency.
		$agency_array = array(
			-1 => esc_html__( 'None', 'framework' ),
		);
		$agency_posts = get_posts(
			array(
				'post_type' => 'agency',
				'posts_per_page' => -1,
				'suppress_filters' => 0,
			)
		);
		if ( count( $agency_posts ) > 0 ) {
			foreach ( $agency_posts as $agency_post ) {
				$agency_array[ $agency_post->ID ] = $agency_post->post_title;
			}
		}

		// Agent Meta Box.
		$meta_boxes[] = array(
			'id' => 'agent-meta-box',
			'title' => esc_html__( 'Provide Related Information', 'framework' ),
			'post_types' => array( 'agent' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => esc_html__( 'Email Address', 'framework' ),
					'id' => "{$prefix}agent_email",
					'desc' => esc_html__( 'Provide Agent Email Address. Agent related messages from contact form on property details page, will be sent on this email address.', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Mobile Number', 'framework' ),
					'id' => "{$prefix}mobile_number",
					'desc' => esc_html__( 'Provide Agent mobile number', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'WhatsApp Number', 'framework' ),
					'id' => "{$prefix}whatsapp_number",
					'desc' => esc_html__( 'Provide Agent whatsapp number', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Office Number', 'framework' ),
					'id' => "{$prefix}office_number",
					'desc' => esc_html__( 'Provide Agent office number', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Fax Number', 'framework' ),
					'id' => "{$prefix}fax_number",
					'desc' => esc_html__( 'Provide Agent fax number', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Facebook URL', 'framework' ),
					'id' => "{$prefix}facebook_url",
					'desc' => esc_html__( 'Provide Agent Facebook URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Twitter URL', 'framework' ),
					'id' => "{$prefix}twitter_url",
					'desc' => esc_html__( 'Provide Agent Twitter URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Google Plus URL', 'framework' ),
					'id' => "{$prefix}google_plus_url",
					'desc' => esc_html__( 'Provide Agent Google Plus URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'LinkedIn URL', 'framework' ),
					'id' => "{$prefix}linked_in_url",
					'desc' => esc_html__( 'Provide Agent LinkedIn URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Instagram URL', 'framework' ),
					'id' => 'inspiry_instagram_url',
					'desc' => esc_html__( 'Provide Agent Instagram URL', 'framework' ),
					'type' => 'text',
				),
				array(
					'type' => 'divider',
					'id' => 'agent_agency_divider',
				),
				array(
					'name' => esc_html__( 'Agency', 'framework' ),
					'id' => "{$prefix}agency",
					'desc' => esc_html__( 'Select Related Agency.', 'framework' ),
					'type' => 'select',
					'options' => $agency_array,
				),
			),
		);

		// Banner Meta Box.
		if ( 'classic' === $rh_design_variation ) {
			$meta_boxes[] = array(
				'id' => 'banner-meta-box',
				'title' => esc_html__( 'Top Banner Area Settings', 'framework' ),
				'post_types' => array( 'page', 'agent', 'agency' ),
				'context' => 'normal',
				'priority' => 'low',
				'fields' => array(
					array(
						'name' => esc_html__( 'Banner Title', 'framework' ),
						'id' => "{$prefix}banner_title",
						'desc' => esc_html__( 'Please provide the Banner Title, Otherwise the Page Title will be displayed in its place.', 'framework' ),
						'type' => 'text',
					),
					array(
						'name' => esc_html__( 'Banner Sub Title', 'framework' ),
						'id' => "{$prefix}banner_sub_title",
						'desc' => esc_html__( 'Please provide the Banner Sub Title.', 'framework' ),
						'type' => 'textarea',
						'cols' => '20',
						'rows' => '2',
					),
					array(
						'name' => esc_html__( 'Banner Image', 'framework' ),
						'id' => "{$prefix}page_banner_image",
						'desc' => esc_html__( 'Please upload the Banner Image. Otherwise the default banner image from theme options will be displayed.', 'framework' ),
						'type' => 'image_advanced',
						'max_file_uploads' => 1,
					),
					array(
						'name' => esc_html__( 'Revolution Slider Alias', 'framework' ),
						'id' => "{$prefix}rev_slider_alias",
						'desc' => esc_html__( 'If you want to replace banner with revolution slider then provide its alias here.', 'framework' ),
						'type' => 'text',
					),
				),
			);
		} elseif ( 'modern' === $rh_design_variation ) {
			$meta_boxes[] = array(
				'id' => 'banner-meta-box',
				'title' => esc_html__( 'Top Banner Area Settings', 'framework' ),
				'post_types' => array( 'page', 'agent', 'agency' ),
				'context' => 'normal',
				'priority' => 'low',
				'fields' => array(
					array(
						'name' => esc_html__( 'Banner Title', 'framework' ),
						'id' => "{$prefix}banner_title",
						'desc' => esc_html__( 'Please provide the Banner Title, Otherwise the Page Title will be displayed in its place.', 'framework' ),
						'type' => 'text',
					),
					array(
						'name' => esc_html__( 'Banner Image', 'framework' ),
						'id' => "{$prefix}page_banner_image",
						'desc' => esc_html__( 'Please upload the Banner Image. Otherwise the default banner image from theme options will be displayed.', 'framework' ),
						'type' => 'image_advanced',
						'max_file_uploads' => 1,
					),
				),
			);
		}

		// Page title show or hide.
		if ( 'classic' === $rh_design_variation ) {
			$meta_boxes[] = array(
				'id' => 'page-title-meta-box',
				'title' => esc_html__( 'Page Title', 'framework' ),
				'post_types' => array( 'page' ),
				'context' => 'normal',
				'priority' => 'low',
				'fields' => array(
					array(
						'name' => esc_html__( 'Page Title Display Status', 'framework' ),
						'id' => "{$prefix}page_title_display",
						'type' => 'radio',
						'std' => 'show',
						'options' => array(
							'show' => esc_html__( 'Show', 'framework' ),
							'hide' => esc_html__( 'Hide', 'framework' ),
						),
					),
				),
			);
		}

		/*
		 * Meta boxes for properties list pages
		 */
		$locations = array();
		inspiry_get_terms_array( 'property-city', $locations );

		$types = array();
		inspiry_get_terms_array( 'property-type', $types );

		$statuses = array();
		inspiry_get_terms_array( 'property-status', $statuses );

		$features = array();
		inspiry_get_terms_array( 'property-feature', $features );

		// removed first element and got the whole remaining array with preserved keys as we do not need 'None' in agents list.
		$agents_for_pages = array_slice( $agents_array, 1, null, true );

		$meta_boxes[] = array(
			'id'        => 'properties-list-meta-box',
			'title'     => __( 'Properties Filter Settings', 'framework' ),
			'post_types'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'show'   => array(
				'template'    => array(
					'templates/list-layout.php',
					'templates/grid-layout.php',
					'templates/half-map-layout.php',
				),
			),
			'fields' => array(
				array(
					'id'    => 'inspiry_posts_per_page',
					'name'  => __( 'Number of Properties Per Page', 'framework' ),
					'type'  => 'number',
					'step'  => '1',
					'min'   => 1,
					'std'   => 6,
					'columns' => 6,
				),
				array(
					'id'          => 'inspiry_properties_order',
					'name'        => __( 'Order Properties By', 'framework' ),
					'type'        => 'select',
					'options'     => array(
						'date-desc'     => __( 'Date New to Old', 'framework' ),
						'date-asc'      => __( 'Date Old to New', 'framework' ),
						'price-asc'     => __( 'Price Low to High', 'framework' ),
						'price-desc'    => __( 'Price High to Low', 'framework' ),
					),
					'multiple'    => false,
					'std'         => 'date-desc',
					'columns' => 6,
				),
				array(
					'id'          => 'inspiry_properties_locations',
					'name'        => __( 'Locations', 'framework' ),
					'type'        => 'select',
					'options'     => $locations,
					'multiple'    => true,
					'select_all_none' => true,
					'columns' => 6,
				),
				array(
					'id'          => 'inspiry_properties_statuses',
					'name'        => __( 'Statuses', 'framework' ),
					'type'        => 'select',
					'options'     => $statuses,
					'multiple'    => true,
					'select_all_none' => true,
					'columns' => 6,
				),
				array(
					'id'          => 'inspiry_properties_types',
					'name'        => __( 'Types', 'framework' ),
					'type'        => 'select',
					'options'     => $types,
					'multiple'    => true,
					'select_all_none' => true,
					'columns' => 6,
				),
				array(
					'id'          => 'inspiry_properties_features',
					'name'        => __( 'Features', 'framework' ),
					'type'        => 'select',
					'options'     => $features,
					'multiple'    => true,
					'select_all_none' => true,
					'columns' => 6,
				),
				array(
					'id'    => 'inspiry_properties_min_beds',
					'name'  => __( 'Minimum Beds', 'framework' ),
					'type'  => 'number',
					'step'  => 'any',
					'min'   => 0,
					'std'   => 0,
					'columns' => 6,
				),
				array(
					'id'    => 'inspiry_properties_min_baths',
					'name'  => __( 'Minimum Baths', 'framework' ),
					'type'  => 'number',
					'step'  => 'any',
					'min'   => 0,
					'std'   => 0,
					'columns' => 6,
				),
				array(
					'id'    => 'inspiry_properties_min_price',
					'name'  => __( 'Minimum Price', 'framework' ),
					'type'  => 'number',
					'step'  => 'any',
					'min'   => 0,
					'std'   => 0,
					'columns' => 6,
				),
				array(
					'id'    => 'inspiry_properties_max_price',
					'name'  => __( 'Maximum Price', 'framework' ),
					'type'  => 'number',
					'step'  => 'any',
					'min'   => 0,
					'std'   => 0,
					'columns' => 6,
				),
				array(
					'name' => esc_html__( 'Properties by Agents', 'framework' ),
					'id' => 'inspiry_properties_by_agents',
					'type' => 'select',
					'options' => $agents_for_pages,
					'multiple' => true,
					'select_all_none' => true,
					'columns' => 12,
				),
			),
		);

		$meta_boxes[] = array(
			'id'        => 'properties-gallery-meta-box',
			'title'     => __( 'Properties Gallery Filter Settings', 'framework' ),
			'post_types'     => array( 'page' ),
			'context'   => 'normal',
			'priority'  => 'high',
			'show'   => array(
				'template'    => array(
					'templates/2-columns-gallery.php',
					'templates/3-columns-gallery.php',
					'templates/4-columns-gallery.php',
				),
			),
			'fields' => array(
				array(
					'id'    => 'inspiry_gallery_posts_per_page',
					'name'  => __( 'Number of Properties Per Page', 'framework' ),
					'type'  => 'number',
					'step'  => '1',
					'min'   => 1,
					'std'   => 6,
				),
				array(
					'id'          => 'inspiry_gallery_properties_locations',
					'name'        => __( 'Locations', 'framework' ),
					'type'        => 'select',
					'options'     => $locations,
					'multiple'    => true,
					'select_all_none' => true,
				),
				array(
					'id'          => 'inspiry_gallery_properties_statuses',
					'name'        => __( 'Statuses', 'framework' ),
					'type'        => 'select',
					'options'     => $statuses,
					'multiple'    => true,
					'select_all_none' => true,
				),
				array(
					'id'          => 'inspiry_gallery_properties_types',
					'name'        => __( 'Types', 'framework' ),
					'type'        => 'select',
					'options'     => $types,
					'multiple'    => true,
					'select_all_none' => true,
				),
				array(
					'id'          => 'inspiry_gallery_properties_features',
					'name'        => __( 'Features', 'framework' ),
					'type'        => 'select',
					'options'     => $features,
					'multiple'    => true,
					'select_all_none' => true,
				),
			),
		);

		if ( 'modern' === $rh_design_variation ) {
			$meta_boxes[] = array(
				'id'    => 'inspiry-home-meta-box',
				'title' => __( 'Home Page Settings', 'framework' ),
				'post_types'    => array( 'page' ),
				'context'   => 'normal',
				'priority'  => 'high',
				'show'      => array(
					'template'  => array(
						'templates/home.php',
					),
				),
				'tabs'      => array(
					'inspiry_features_tab' => array(
						'label' => __( 'Features', 'framework' ),
						'icon'  => 'dashicons-admin-users',
					),
				),
				'tab_style' => 'left',
				'fields'    => array(
					array(
						'id'        => 'inspiry_features',
						'type'      => 'group',
						'columns'   => 12,
						'clone'     => true,
						'tab'       => 'inspiry_features_tab',
						'fields'    => array(
							array(
								'name' => __( 'Feature Name', 'framework' ),
								'id'   => 'inspiry_feature_name',
								'desc' => __( 'Example: Perfect Backend', 'framework' ),
								'type' => 'text',
								'columns'   => 6,
							),
							array(
								'name' => __( 'Feature URL', 'framework' ),
								'id'   => 'inspiry_feature_link',
								'desc' => __( 'Example: https://inspirythemes.com', 'framework' ),
								'type' => 'text',
								'columns'   => 6,
							),
							array(
								'name'  => __( 'Feature Icon', 'framework' ),
								'id'    => 'inspiry_feature_icon',
								'desc'  => __( 'Icon should have minimum width of 150px and minimum height of 150px.', 'framework' ),
								'type'  => 'image_advanced',
								'max_file_uploads' => 1,
								'columns'   => 6,
							),
							array(
								'name' => __( 'Feature Description', 'framework' ),
								'id'   => 'inspiry_feature_desc',
								'type' => 'textarea',
								'rows'  => 7,
								'cols' => 60,
								'columns'   => 6,
							),
						),
					),
				),
			);
		}

		// Apply a filter before returning meta boxes.
		$meta_boxes = apply_filters( 'framework_theme_meta', $meta_boxes );

		return $meta_boxes;

	}
}


if ( ! function_exists( 'inspiry_property_gallery_meta_desc' ) ) :

	/**
	 * Function to return gallery meta description.
	 *
	 * @return string
	 * @author Ashar Irfan
	 * @since  1.0.0
	 */
	function inspiry_property_gallery_meta_desc() {
		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			return esc_html__( 'Images should have minimum size of 1200px by 680px. Bigger size images will be cropped automatically. Minimum 2 images are required to display gallery.', 'framework' );
		}

		// For classic version.
		return esc_html__( 'Images should have minimum size of 770px by 386px for thumbnails on right and 830px by 460px for thumbnails on bottom. Bigger size images will be cropped automatically. Minimum 2 images are required to display gallery.', 'framework' );
	}
endif;
