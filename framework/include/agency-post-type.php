<?php
/**
 * Agency Custom Post Type
 *
 * @since   3.5.0
 * @package realhomes
 */
if ( ! function_exists( 'register_agency_post_type' ) ) {

	/**
	 * Register Custom Post Type : Agency
	 */
	function register_agency_post_type() {

		$labels = array(
			'name'                  => esc_html_x( 'Agencies', 'Post Type General Name', 'framework' ),
			'singular_name'         => esc_html_x( 'Agency', 'Post Type Singular Name', 'framework' ),
			'menu_name'             => esc_html__( 'Agencies', 'framework' ),
			'name_admin_bar'        => esc_html__( 'Agency', 'framework' ),
			'archives'              => esc_html__( 'Agency Archives', 'framework' ),
			'attributes'            => esc_html__( 'Agency Attributes', 'framework' ),
			'parent_item_colon'     => esc_html__( 'Parent Agency:', 'framework' ),
			'all_items'             => esc_html__( 'All Agencies', 'framework' ),
			'add_new_item'          => esc_html__( 'Add New Agency', 'framework' ),
			'add_new'               => esc_html__( 'Add New', 'framework' ),
			'new_item'              => esc_html__( 'New Agency', 'framework' ),
			'edit_item'             => esc_html__( 'Edit Agency', 'framework' ),
			'update_item'           => esc_html__( 'Update Agency', 'framework' ),
			'view_item'             => esc_html__( 'View Agency', 'framework' ),
			'view_items'            => esc_html__( 'View Agencies', 'framework' ),
			'search_items'          => esc_html__( 'Search Agency', 'framework' ),
			'not_found'             => esc_html__( 'Not found', 'framework' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'framework' ),
			'featured_image'        => esc_html__( 'Agency Logo Image', 'framework' ),
			'set_featured_image'    => esc_html__( 'Set agency logo image', 'framework' ),
			'remove_featured_image' => esc_html__( 'Remove agency logo image', 'framework' ),
			'use_featured_image'    => esc_html__( 'Use as agency logo image', 'framework' ),
			'insert_into_item'      => esc_html__( 'Insert into agency', 'framework' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this agency', 'framework' ),
			'items_list'            => esc_html__( 'Agencies list', 'framework' ),
			'items_list_navigation' => esc_html__( 'Agencies list navigation', 'framework' ),
			'filter_items_list'     => esc_html__( 'Filter agencies list', 'framework' ),
		);
		$args   = array(
			'label'               => esc_html__( 'Agency', 'framework' ),
			'description'         => esc_html__( 'An agency is a company of realtors.', 'framework' ),
			'labels'              => $labels,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-groups',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'rewrite' => array(
				'slug' => apply_filters( 'inspiry_agency_slug', esc_html__( 'agency', 'framework' ) ),
			),
		);

		// Filter the arguments to register agency post type.
		$args = apply_filters( 'inspiry_agency_post_type_args', $args );
		register_post_type( 'agency', $args );

	}

	add_action( 'init', 'register_agency_post_type', 0 );

}

if ( ! function_exists( 'inspiry_set_agency_slug' ) ) {
	/**
	 * This function set agency's url slug by hooking itself with related filter
	 *
	 * @param string $existing_slug - Existing slug.
	 * @return mixed|void
	 */
	function inspiry_set_agency_slug( $existing_slug ) {
		$new_slug = get_option( 'inspiry_agency_slug' );
		if ( ! empty( $new_slug ) ) {
			return $new_slug;
		}
		return $existing_slug;
	}

	add_filter( 'inspiry_agency_slug', 'inspiry_set_agency_slug' );
}

if ( ! function_exists( 'inspiry_agency_edit_columns' ) ) {
	/**
	 * Custom columns for agencies.
	 *
	 * @param array $columns - Columns array.
	 * @return array
	 *
	 * @since 3.5.0
	 */
	function inspiry_agency_edit_columns( $columns ) {

		$columns = array(
			'cb'               => '<input type="checkbox" />',
			'title'            => esc_html__( 'Agency', 'framework' ),
			'agency-thumbnail'        => esc_html__( 'Thumbnail', 'framework' ),
			'total_properties' => esc_html__( 'Total Properties', 'framework' ),
			'published'        => esc_html__( 'Published Properties', 'framework' ),
			'others'           => esc_html__( 'Other Properties', 'framework' ),
			'date'             => esc_html__( 'Created', 'framework' ),
		);

		/**
		 * WPML Support
		 */
		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			global $sitepress;
			$wpml_columns = new WPML_Custom_Columns( $sitepress );
			$columns      = $wpml_columns->add_posts_management_column( $columns );
		}

		/**
		 * Reverse the array for RTL
		 */
		if ( is_rtl() ) {
			$columns = array_reverse( $columns );
		}

		return $columns;
	}

	add_filter( 'manage_edit-agency_columns', 'inspiry_agency_edit_columns' );
}


if ( ! function_exists( 'inspiry_agency_custom_columns' ) ) {

	/**
	 * Custom column values for agency post type.
	 *
	 * @param string $column - Name of the column.
	 * @param int $agency_id - ID of the current agency.
	 *
	 * @since 3.5.0
	 */
	function inspiry_agency_custom_columns( $column, $agency_id ) {

		// Switch cases against column names.
		switch ( $column ) {
			case 'agency-thumbnail':
				if ( has_post_thumbnail( $agency_id ) ) {
					?>
					<a href="<?php the_permalink(); ?>" target="_blank">
						<?php the_post_thumbnail( array( 130, 130 ) ); ?>
					</a>
					<?php
				} else {
					esc_html_e( 'No Thumbnail', 'framework' );
				}
				break;
			// Total properties.
			case 'total_properties':
				$listed_properties = inspiry_get_listed_properties_by_agency( $agency_id );
				echo ( ! empty( $listed_properties ) ) ? esc_html( $listed_properties ) : 0;
				break;
			// Total published properties.
			case 'published':
				$published_properties = inspiry_get_listed_properties_by_agency( $agency_id, 'publish' );
				echo ( ! empty( $published_properties ) ) ? esc_html( $published_properties ) : 0;
				break;
			// Other properties.
			case 'others':
				$property_status   = array( 'pending', 'draft', 'private', 'future' );
				$others_properties = inspiry_get_listed_properties_by_agency( $agency_id, $property_status );
				echo ( ! empty( $others_properties ) ) ? esc_html( $others_properties ) : 0;
				break;
			default:
				break;
		}

	}

	add_action( 'manage_agency_posts_custom_column', 'inspiry_agency_custom_columns', 10, 2 );
}
