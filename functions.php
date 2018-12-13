<?php
/**
 * The current version of the theme.
 *
 * @package RH
 */

// Theme version.
define( 'INSPIRY_THEME_VERSION', '3.5.2' );

// Framework Path.
define( 'INSPIRY_FRAMEWORK', get_template_directory() . '/framework/' );

// Widgets Path.
define( 'INSPIRY_WIDGETS', get_template_directory() . '/widgets/' );

/**
 * Defined html tags to be used in
 * wp_kses function across the theme.
 */
$inspiry_allowed_tags = array(
	'a' => array(
		'href' => array(),
		'title' => array(),
		'alt' => array(),
	),
	'b' => array(),
	'br' => array(),
	'div' => array(
		'class' => array(),
		'id' => array(),
	),
	'em' => array(),
	'strong' => array(),
);

if ( ! function_exists( 'inspiry_current_design_variation' ) ) {
	/**
	 * Returns the current design variation the
	 * user has selected.
	 *
	 * @since 2.7.0
	 */
	function inspiry_current_design_variation() {
		return get_option( 'inspiry_design_variation', 'classic' );
	}
}

// Theme selected design variation.
define( 'INSPIRY_DESIGN_VARIATION', inspiry_current_design_variation() );

// Theme directory.
define( 'INSPIRY_THEME_DIR', get_template_directory() . '/assets/' . INSPIRY_DESIGN_VARIATION );

// Theme directory URI.
define( 'INSPIRY_DIR_URI', get_template_directory_uri() . '/assets/' . INSPIRY_DESIGN_VARIATION );

// Theme common directory.
define( 'INSPIRY_COMMON_DIR', get_template_directory() . '/common/' );

// Theme common directory URI.
define( 'INSPIRY_COMMON_URI', get_template_directory_uri() . '/common/' );

if ( ! function_exists( 'inspiry_theme_setup' ) ) {
	/**
	 * 1. Load text domain
	 * 2. Add custom background support
	 * 3. Add automatic feed links support
	 * 4. Add specific post formats support
	 * 5. Add custom menu support and register a custom menu
	 * 6. Register required image sizes
	 * 7. Add title tag support
	 */
	function inspiry_theme_setup() {

		/**
		 * Load text domain for translation purposes
		 */
		$languages_dir = get_template_directory() . '/languages';
		if ( file_exists( $languages_dir ) ) {
			load_theme_textdomain( 'framework', $languages_dir );
		} else {
			load_theme_textdomain( 'framework' );   // For backward compatibility.
		}

		/**
		 * Add Theme Support - Custom background
		 */
		add_theme_support( 'custom-background' );

		/**
		 * Add Automatic Feed Links Support
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add Post Formats Support
		 */
		add_theme_support( 'post-formats', array( 'image', 'video', 'gallery' ) );

		/**
		 * Add Menu Support and register a custom menu
		 */
		add_theme_support( 'menus' );
		register_nav_menus(
			array(
				'main-menu' 		=> __( 'Main Menu', 'framework' ),
				'responsive-menu'	=> __( 'Responsive Menu', 'framework' ),
			)
		);

		/**
		 * Add Post Thumbnails Support and Related Image Sizes
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150 );                            // Default Post Thumbnail dimensions.
		add_image_size( 'property-thumb-image', 244, 163, true );        // For Home page posts thumbnails/Featured Properties carousels thumb.
		add_image_size( 'property-detail-video-image', 818, 417, true ); // For Property detail page video image.
		add_image_size( 'agent-image', 210, 210, true );                 // For Agent Picture.

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			/**
			 * Modern Design Image Sizes
			 */
			add_image_size( 'partners-logo', 200, 9999, true );                	// For partner carousel logos
			add_image_size( 'modern-property-detail-slider', 1200, 680, true );	// For Property Slider on Property Details Page.
			add_image_size( 'modern-property-child-slider', 680, 510, true );	// For Gallery, Child Property, Property Card, Property Grid Card, Similar Property.
			add_image_size( 'property-listing-image', 400, 300, true );			// For Property List Card, Property Map List Card.
			add_image_size( 'post-featured-image', 850, 570, true );			// For Blog featured image.
		} elseif ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			/**
			 * Classic Design Image Sizes
			 */
			add_image_size( 'partners-logo', 200, 9999, true );                // For partner carousel logos
			add_image_size( 'post-featured-image', 830, 323, true );         // For Standard Post Thumbnails.
			add_image_size( 'gallery-two-column-image', 536, 269, true );    // For Gallery Two Column property Thumbnails.
			add_image_size( 'property-detail-slider-image', 770, 386, true );// For Property detail page slider image.
			add_image_size( 'property-detail-slider-image-two', 830, 460, true ); // For Property detail page slider image.
			add_image_size( 'property-detail-slider-thumb', 82, 60, true );  // For Property detail page slider thumb.
			add_image_size( 'grid-view-image', 246, 162, true );             // For Property Listing Grid view image.
		}

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add theme support for selective refresh
		 * of widgets in customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

	}

	add_action( 'after_setup_theme', 'inspiry_theme_setup' );

}


/**
 * Custom Post Types
 */
require_once( INSPIRY_FRAMEWORK . 'include/agent-post-type.php' );        // Agent CPT.
require_once( INSPIRY_FRAMEWORK . 'include/agency-post-type.php' );       // Agency CPT.
require_once( INSPIRY_FRAMEWORK . 'include/property-post-type.php' );     // Property CPT.
require_once( INSPIRY_FRAMEWORK . 'include/partners-post-type.php' );     // Partner CPT.
require_once( INSPIRY_FRAMEWORK . 'include/slide-post-type.php' );        // Slide CPT.


/**
 * Google Fonts
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/google-fonts/google-fonts.php' );


/**
 * Customizer
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/customizer.php' );


/**
 * Meta Boxes
 */
require_once( INSPIRY_FRAMEWORK . 'meta-box/inspiry-meta-box.php' );


/**
 * Admin Menu
 *
 * @since 3.3.1
 */
if ( file_exists( INSPIRY_FRAMEWORK . 'include/admin/class-rh-admin-menu.php' ) ) {
	require_once( INSPIRY_FRAMEWORK . 'include/admin/class-rh-admin-menu.php' );
}


/**
 * Design Selector Page.
 *
 * @since 3.0.0
 */
if ( file_exists( INSPIRY_FRAMEWORK . 'include/design-page/design-page-init.php' ) ) {
	require_once( INSPIRY_FRAMEWORK . 'include/design-page/design-page-init.php' );
}


/*
 * TGM plugin activation
 */
if ( file_exists( INSPIRY_FRAMEWORK . 'include/tgm/inspiry-required-plugins.php' ) ) {
	require_once( INSPIRY_FRAMEWORK . 'include/tgm/inspiry-required-plugins.php' );
}


/**
 * Load functions files
 */
require_once( INSPIRY_FRAMEWORK . 'functions/load.php' );


/**
 * Shortcodes
 */
require_once( INSPIRY_FRAMEWORK . 'include/shortcodes/columns.php' );
require_once( INSPIRY_FRAMEWORK . 'include/shortcodes/elements.php' );
// if visual composer is installed then include related mapping code for properties shortcode.
if ( class_exists( 'Vc_Manager' ) ) {
	require_once( get_template_directory() . '/framework/include/shortcodes/vc-map.php' );
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 828;
}


if ( ! function_exists( 'inspiry_theme_sidebars' ) ) {
	/**
	 * Sidebars, Footer and other Widget areas
	 */
	function inspiry_theme_sidebars() {

		// Location: Default Sidebar.
		register_sidebar( array(
			'name' => __( 'Default Sidebar', 'framework' ),
			'id' => 'default-sidebar',
			'description' => __( 'Widget area for default sidebar on news and post pages.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Sidebar Pages.
		register_sidebar( array(
			'name' => __( 'Pages Sidebar', 'framework' ),
			'id' => 'default-page-sidebar',
			'description' => __( 'Widget area for default page template sidebar.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Sidebar for contact page.
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			register_sidebar( array(
				'name' => __( 'Contact Sidebar', 'framework' ),
				'id' => 'contact-sidebar',
				'description' => __( 'Widget area for contact page sidebar.', 'framework' ),
				'before_widget' => '<section class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			) );
		}

		// Location: Sidebar Property.
		register_sidebar( array(
			'name' => __( 'Property Sidebar', 'framework' ),
			'id' => 'property-sidebar',
			'description' => __( 'Widget area for property detail page sidebar.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Sidebar Properties List.
		register_sidebar( array(
			'name' => __( 'Properties List Sidebar', 'framework' ),
			'id' => 'property-listing-sidebar',
			'description' => __( 'Widget area for sidebar in properties list, grid and archive pages.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Sidebar dsIDX.
		register_sidebar( array(
			'name' => __( 'dsIDX Sidebar', 'framework' ),
			'id' => 'dsidx-sidebar',
			'description' => __( 'Widget area for dsIDX related pages.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Footer First Column.
		register_sidebar( array(
			'name' => __( 'Footer First Column', 'framework' ),
			'id' => 'footer-first-column',
			'description' => __( 'Widget area for first column in footer.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Footer Second Column.
		register_sidebar( array(
			'name' => __( 'Footer Second Column', 'framework' ),
			'id' => 'footer-second-column',
			'description' => __( 'Widget area for second column in footer.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Footer Third Column.
		register_sidebar( array(
			'name' => __( 'Footer Third Column', 'framework' ),
			'id' => 'footer-third-column',
			'description' => __( 'Widget area for third column in footer.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Footer Fourth Column.
		register_sidebar( array(
			'name' => __( 'Footer Fourth Column', 'framework' ),
			'id' => 'footer-fourth-column',
			'description' => __( 'Widget area for fourth column in footer.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Sidebar Agent.
		register_sidebar( array(
			'name' => __( 'Agent Sidebar', 'framework' ),
			'id' => 'agent-sidebar',
			'description' => __( 'Sidebar widget area for agent detail page.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Location: Sidebar Agency.
		register_sidebar( array(
			'name'          => esc_html__( 'Agency Sidebar', 'framework' ),
			'id'            => 'agency-sidebar',
			'description'   => esc_html__( 'Sidebar widget area for agency detail page.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="title">',
			'after_title'   => '</h3>',
		) );

		// Location: Home Search Area.
		register_sidebar( array(
			'name' => __( 'Home Search Area', 'framework' ),
			'id' => 'home-search-area',
			'description' => __( 'Widget area for only IDX Search Widget. Using this area means you want to display IDX search form instead of default search form.', 'framework' ),
			'before_widget' => '<section id="home-idx-search" class="clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="home-widget-label">',
			'after_title' => '</h3>',
		) );

		// Location: Property Search Template.
		register_sidebar( array(
			'name' => __( 'Property Search Sidebar', 'framework' ),
			'id' => 'property-search-sidebar',
			'description' => __( 'Widget area for property search template with sidebar.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );

		// Create additional sidebar to use with visual composer if needed.
		if ( class_exists( 'Vc_Manager' ) ) {

			// Additional Sidebars.
			register_sidebars( 4, array(
				'name' => __( 'Additional Sidebar %d', 'framework' ),
				'description' => __( 'An extra sidebar to use with Visual Composer if needed.', 'framework' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			) );

		}

		// Create additional sidebar to use with Optima Express if needed.
		if ( class_exists( 'iHomefinderAdmin' ) ) {

			// Additional Sidebars.
			register_sidebar( array(
				'name' => __( 'Optima Express Sidebar', 'framework' ),
				'id' => 'optima-express-page-sidebar',
				'description' => __( 'An extra sidebar to use with Optima Express if needed.', 'framework' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>',
			) );

		}

	}

	add_action( 'widgets_init', 'inspiry_theme_sidebars' );
}


/**
 * Custom Widgets
 */
include_once( INSPIRY_WIDGETS . 'featured-properties-widget.php' );
//include_once( INSPIRY_WIDGETS . 'auction-property-detials-widget.php' );//custom widget by sumonst21
include_once( INSPIRY_WIDGETS . 'property-types-widget.php' );
include_once( INSPIRY_WIDGETS . 'advance-search-widget.php' );
include_once( INSPIRY_WIDGETS . 'agent-properties-widget.php' );
include_once( INSPIRY_WIDGETS . 'agent-featured-properties-widget.php' );
if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	include_once( INSPIRY_WIDGETS . 'rh-contact-information-widget.php' );
}


if ( ! function_exists( 'register_theme_widgets' ) ) {
	/**
	 * Register custom widgets
	 */
	function register_theme_widgets() {
		register_widget( 'Featured_Properties_Widget' );
		//register_widget( 'Auction_Property_Details_Widget' );//custom widget by sumonst21
		register_widget( 'Property_Types_Widget' );
		register_widget( 'Advance_Search_Widget' );
		register_widget( 'Agent_Properties_Widget' );
		register_widget( 'Agent_Featured_Properties_Widget' );
	}

	add_action( 'widgets_init', 'register_theme_widgets' );
}



if ( ! function_exists( 'inspiry_google_fonts' ) ) :
	/**
	 * Google fonts enqueue url
	 */
	function inspiry_google_fonts() {
		$fonts_url            = '';
		$font_families        = array();
		$inspiry_heading_font = get_option( 'inspiry_heading_font', 'Default' );
		$inspiry_secondary_font = get_option( 'inspiry_secondary_font', 'Default' );
		$inspiry_body_font    = get_option( 'inspiry_body_font', 'Default' );

		/*
		 * Heading Font
		 */
		if ( ! empty( $inspiry_heading_font ) && ( 'Default' !== $inspiry_heading_font ) ) {
			$font_families[] = $inspiry_heading_font;
		} else {
			/* Lato is theme's default heading font */
			$font_families[] = 'Lato:400,400i,700,700i';
		}

		/*
		 * Secondary Font
		 */
		if ( ! empty( $inspiry_secondary_font ) && ( 'Default' !== $inspiry_secondary_font ) ) {
			$font_families[] = $inspiry_secondary_font;
		} else {
			/* Robot is theme's default secondary font */
			$font_families[] = 'Roboto:400,400i,500,500i,700,700i';
		}

		/*
		 * Body Font
		 */
		if ( ! empty( $inspiry_body_font ) && ( 'Default' !== $inspiry_body_font ) ) {
			$font_families[] = $inspiry_body_font;
		}

		if ( ! empty( $font_families ) ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;


if ( ! function_exists( 'inspiry_apply_google_maps_arguments' ) ) :
	/**
	 * This function adds google maps arguments to admins side maps displayed in meta boxes
	 *
	 * @param string $google_maps_url - Google Maps URL.
	 * @since 1.0.0
	 */
	function inspiry_apply_google_maps_arguments( $google_maps_url ) {

		/* default map query arguments */
		$google_map_arguments = array();

		return esc_url_raw(
			add_query_arg(
				apply_filters(
					'inspiry_google_map_arguments',
					$google_map_arguments
				),
				$google_maps_url
			)
		);

	}

	// add_filter( 'rwmb_google_maps_url', 'inspiry_apply_google_maps_arguments' );
endif;


if ( ! function_exists( 'inspiry_google_maps_api_key' ) ) :
	/**
	 * This function adds API key ( if provided in settings ) to google maps arguments
	 *
	 * @param string $google_map_arguments - Google Maps Arguments.
	 * @since 1.0.0
	 */
	function inspiry_google_maps_api_key( $google_map_arguments ) {
		/* Get Google Maps API Key if available */
		$google_maps_api_key = get_option( 'inspiry_google_maps_api_key' );
		if ( ! empty( $google_maps_api_key ) ) {
			$google_map_arguments['key'] = urlencode( $google_maps_api_key );
		}

		return $google_map_arguments;
	}

	add_filter( 'inspiry_google_map_arguments', 'inspiry_google_maps_api_key' );
endif;


if ( ! function_exists( 'inspiry_google_maps_language' ) ) :
	/**
	 * This function add current language to google maps arguments
	 *
	 * @param string $google_map_arguments - Google Maps Arguments.
	 * @since 1.0.
	 */
	function inspiry_google_maps_language( $google_map_arguments ) {
		/* Localise Google Map if related theme options is set */
		if ( 'true' == get_option( 'theme_map_localization' ) ) {
			if ( function_exists( 'wpml_object_id_filter' ) ) {                         // FOR WPML.
				$google_map_arguments['language'] = urlencode( ICL_LANGUAGE_CODE );
			} else {                                                                    // FOR Default.
				$google_map_arguments['language'] = urlencode( get_locale() );
			}
		}

		return $google_map_arguments;
	}

	add_filter( 'inspiry_google_map_arguments', 'inspiry_google_maps_language' );
endif;


if ( ! function_exists( 'inspiry_google_maps_api_notice' ) ) :

	/**
	 * Google Maps API Key notice for dashboard
	 *
	 * @since 2.7.0
	 */
	function inspiry_google_maps_api_notice() {
		$google_maps_api_key = get_option( 'inspiry_google_maps_api_key' );
		if ( empty( $google_maps_api_key ) ) {
			?>
			<div class="notice notice-warning is-dismissible">
				<p>
					<a href="https://realhomes.io/documentation/google-maps-api-key/" target="_blank"><?php esc_html_e( 'Google Maps API key', 'framework' ); ?></a> <?php esc_html_e( 'is missing. It is required to display Google Maps on your website. You have to add it in settings given under', 'framework' ); ?>
					<strong><?php esc_html_e( 'Appearance > Customize > Misc', 'framework' ); ?></strong>
				</p>
			</div>
			<?php
		}
	}

	add_action( 'admin_notices', 'inspiry_google_maps_api_notice' );
endif;


if ( ! function_exists( 'inspiry_update_page_templates' ) ) {

	/**
	 * Function to update page templates.
	 *
	 * @since 3.0.0
	 */
	function inspiry_update_page_templates() {

		if ( ! is_page_template() ) {
			return;
		}

		$page_id = get_queried_object_id();
		if ( ! empty( $page_id ) ) {
			$page_template = get_post_meta( $page_id, '_wp_page_template', true );
		}

		if ( empty( $page_template ) ) {
			return;
		}

		$latest_templates = array(
			/*
			 * Updated properties list template
			 */
			'template-property-listing.php'           => 'templates/list-layout.php',
			'templates/template-property-listing.php' => 'templates/list-layout.php',
			/*
			 * Updated properties grid template
			 */
			'template-property-grid-listing.php'           => 'templates/list-layout.php',
			'templates/template-property-grid-listing.php' => 'templates/grid-layout.php',
			/*
			 * Updated properties with half map template
			 */
			'template-map-based-listing.php'           => 'templates/half-map-layout.php',
			'templates/template-map-based-listing.php' => 'templates/half-map-layout.php',
			/*
			 * Updated favorites template
			 */
			'template-favorites.php'           => 'templates/favorites.php',
			'templates/template-favorites.php' => 'templates/favorites.php',
			/*
			 * Updated my properties template
			 */
			'template-my-properties.php'           => 'templates/my-properties.php',
			'templates/template-my-properties.php' => 'templates/my-properties.php',
			/*
			 * Updated agents list template
			 */
			'template-agent-listing.php'           => 'templates/agents-list.php',
			'templates/template-agent-listing.php' => 'templates/agents-list.php',
			/*
			 * Updated compare properties template
			 */
			'template-compare.php'           => 'templates/compare-properties.php',
			'templates/template-compare.php' => 'templates/compare-properties.php',
			/*
			 * Updated contact template
			 */
			'template-contact.php'           => 'templates/contact.php',
			'templates/template-contact.php' => 'templates/contact.php',
			/*
			 * Updated dsIDXpress template
			 */
			'template-dsIDX.php'           => 'templates/dsIDXpress.php',
			'templates/template-dsIDX.php' => 'templates/dsIDXpress.php',
			/*
			 * Updated edit profile template
			 */
			'template-edit-profile.php'           => 'templates/edit-profile.php',
			'templates/template-edit-profile.php' => 'templates/edit-profile.php',
			/*
			 * Updated full width template
			 */
			'template-fullwidth.php'           => 'templates/full-width.php',
			'templates/template-fullwidth.php' => 'templates/full-width.php',
			/*
			 * Updated 2 Columns Gallery template
			 */
			'template-gallery-2-columns.php'           => 'templates/2-columns-gallery.php',
			'templates/template-gallery-2-columns.php' => 'templates/2-columns-gallery.php',
			/*
			 * Updated 3 Columns Gallery template
			 */
			'template-gallery-3-columns.php'           => 'templates/3-columns-gallery.php',
			'templates/template-gallery-3-columns.php' => 'templates/3-columns-gallery.php',
			/*
			 * Updated 4 Columns Gallery template
			 */
			'template-gallery-4-columns.php'           => 'templates/4-columns-gallery.php',
			'templates/template-gallery-4-columns.php' => 'templates/4-columns-gallery.php',
			/*
			 * Updated home template
			 */
			'template-home.php'           => 'templates/home.php',
			'templates/template-home.php' => 'templates/home.php',
			/*
			 * Updated login template
			 */
			'template-login.php'           => 'templates/login-register.php',
			'templates/template-login.php' => 'templates/login-register.php',
			/*
			 * Updated membership plans template
			 */
			'template-memberships.php'           => 'templates/membership-plans.php',
			'templates/template-memberships.php' => 'templates/membership-plans.php',
			/*
			 * Updated optima express template
			 */
			'template-optima-express.php'           => 'templates/optima-express.php',
			'templates/template-optima-express.php' => 'templates/optima-express.php',
			/*
			 * Updated search template
			 */
			'template-search.php'           => 'templates/properties-search.php',
			'templates/template-search.php' => 'templates/properties-search.php',
			/*
			 * Updated search template with right sidebar
			 */
			'template-search-right-sidebar.php'           => 'templates/properties-search-right-sidebar.php',
			'templates/template-search-right-sidebar.php' => 'templates/properties-search-right-sidebar.php',
			/*
			 * Updated search template with left sidebar
			 */
			'template-search-sidebar.php'           => 'templates/properties-search-left-sidebar.php',
			'templates/template-search-sidebar.php' => 'templates/properties-search-left-sidebar.php',
			/*
			 * Updated submit property template
			 */
			'template-submit-property.php'           => 'templates/submit-property.php',
			'templates/template-submit-property.php' => 'templates/submit-property.php',
			/*
			 * Updated users list template
			 */
			'template-users-listing.php'           => 'templates/users-lists.php',
			'templates/template-users-listing.php' => 'templates/users-lists.php',
		);

		if ( ! empty( $page_template ) && array_key_exists( $page_template, $latest_templates ) && ! defined( 'DSIDXPRESS_PLUGIN_VERSION' )  ) {

			$updated_template = $latest_templates[ $page_template ];
			update_post_meta( $page_id, '_wp_page_template', $updated_template );
			echo '<meta HTTP-EQUIV="Refresh" CONTENT="1">';

		} elseif ( ! empty( $page_template ) &&
				   false !== strpos( $page_template, 'template-' ) &&
				   false === strpos( $page_template, 'templates/' ) &&
				   ! defined( 'DSIDXPRESS_PLUGIN_VERSION' ) ) {

				update_post_meta( $page_id, '_wp_page_template', 'templates/' . $page_template );
				echo '<meta HTTP-EQUIV="Refresh" CONTENT="1">';
		}

	}

	add_action( 'wp_head', 'inspiry_update_page_templates' );
}

// Enable shortcodes in text widgets.
add_filter( 'widget_text','do_shortcode' );

// To remove auto p tags in text widget.
remove_filter( 'widget_text_content', 'wpautop' );

// Auction Property Details - Shortcode - tag: [Auction_Property_Details]
function Auction_Property_Details_shortcode() {

	global $post;
	// Detect if it is a single post with a post author
    if (is_single() && isset($post->post_author)) {
		//the_title();

	$is_auction_property      = get_post_meta($post->ID, 'REAL_HOMES_auction_enabled', true);
	$auction_start_price       = get_post_meta($post->ID, 'REAL_HOMES_auction_start_price', true);
	$auction_price_increase  = get_post_meta($post->ID, 'REAL_HOMES_auction_price_increase', true);
	$auction_time_increase = get_post_meta($post->ID, 'REAL_HOMES_auction_time_increase', true);
	$auction_starting   = get_post_meta($post->ID, 'REAL_HOMES_auction_starting', true);
	$auction_ending        = get_post_meta($post->ID, 'REAL_HOMES_auction_ending', true);
	$is_auction_closed        = get_post_meta($post->ID, 'REAL_HOMES_auction_closed', true);

	?>
	<div class="rh_prop_card rh_prop_card--block">

		<?php if ($is_auction_property) : ?>
			
			<div class="rh_prop_card__wrap">
			
			</div>
			
		<?php endif; ?>

	</div>
	<?php


    // Get author's display name
       // $display_name = get_the_author_meta('display_name', $post->post_author);
    }

}
add_shortcode( 'Auction_Property_Details', 'Auction_Property_Details_shortcode' );



// Register and load Auction_Property_Details widget
function Auction_Property_Details_load_widget()
{
	register_widget('Auction_Property_Details_widget');
}
add_action('widgets_init', 'Auction_Property_Details_load_widget');
 
// Creating the widget 
class Auction_Property_Details_widget extends WP_Widget
{

	function __construct()
	{
		parent::__construct(
 
// Base ID of your widget
			'Auction_Property_Details_widget', 
 
// Widget name will appear in UI
			__('Single Auction Propery Details Widget', 'framework'), 
 
// Widget description
			array('description' => __('widget for single auction property details', 'framework'), )
		);
	}
 
// Creating widget front-end

	public function widget($args, $instance)
	{

		global $post;
		$is_auction_property = get_post_meta($post->ID, 'REAL_HOMES_auction_enabled', true);
		$auction_start_price = get_post_meta($post->ID, 'REAL_HOMES_auction_start_price', true);
		$auction_price_increase = get_post_meta($post->ID, 'REAL_HOMES_auction_price_increase', true);
		$auction_time_increase = get_post_meta($post->ID, 'REAL_HOMES_auction_time_increase', true);
		$auction_starting = get_post_meta($post->ID, 'REAL_HOMES_auction_starting', true);
		$auction_ending = get_post_meta($post->ID, 'REAL_HOMES_auction_ending', true);
		$is_auction_closed = get_post_meta($post->ID, 'REAL_HOMES_auction_closed', true);

		// property price currency
		// get property price
        $price_digits = doubleval(get_post_meta($post->ID, 'REAL_HOMES_auction_start_price', true));

        if ($price_digits) {
            // get price postfix
            $price_post_fix = get_post_meta($post->ID, 'REAL_HOMES_property_price_postfix', true);

            //  go with default approach.
            $currency = get_theme_currency();
            $decimals = intval(get_option('theme_decimals'));
            $decimal_point = get_option('theme_dec_point');
            $thousands_separator = get_option('theme_thousands_sep');
            $currency_position = get_option('theme_currency_position');
            $formatted_price = number_format($price_digits, $decimals, $decimal_point, $thousands_separator);
            if ($currency_position == 'after') {
                $auction_formatted_price = $formatted_price . $currency . ' ' . $price_post_fix;
            } else {
                $auction_formatted_price = $currency . $formatted_price . ' ' . $price_post_fix;
            }
		}
		

		// display widget only if post is a auction property 
		if ($is_auction_property) :

		$title = apply_filters('widget_title', $instance['title']);
 
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if (!empty($title))
			echo $args['before_title'] . $title . $args['after_title'];
 
		// print widget blocks and classes
		echo '<div class="rh_prop_card rh_prop_card--block widget_auction_property_details"><div class="rh_prop_card__wrap"><div class="rh_prop_card__details">';
		//echo __('Hello, World!', 'framework');

			// if user is not logged in and auction details for guest users
			if (!is_user_logged_in()) : ?>
					
			<div class="user-status">
				<div class="bid-status-message">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 12 16">
						<defs>
							<style>
								.cls-1 {
									fill: #bec4cc;
									fill-rule: evenodd;
								}
							</style>
						</defs>
						<path d="M1181,190a1,1,0,0,0,1-1v-4a4,4,0,0,0-4-4h-4a4,4,0,0,0-4,4v4a1,1,0,0,0,1,1h0a1.035,1.035,0,0,0,1-1,46.313,46.313,0,0,1,1-5h0v6h6v-6h0l1,5a0.979,0.979,0,0,0,1,1h0Zm-4.99-16a2.951,2.951,0,0,1,3,2.981,3.115,3.115,0,0,1-3,3.018A3,3,0,1,1,1176.01,174Z"
							transform="translate(-1170 -174)"></path>
					</svg><span>Log in to view your status</span>
				</div>
			</div>

			<?php endif; // end if user is not logged in and auction details for guest users ?>


			

			<div class="bid-stats">	
				<?php
				if ($auction_start_price && !$is_auction_closed) {
					echo 'Minimum Opening Bid '. $auction_formatted_price;
				}
				if (is_user_logged_in() && !$is_auction_closed) {
                    ?>
			<?php
                /*
            global $current_user;
            get_currentuserinfo();
            $uid = $current_user->ID;
            $pid = get_the_ID();
            */
            ?>

			<div class="rh_property_agent__enquiry_form">
				<form id="<?php echo $post->ID; ?>" class="rh_widget_form agent-form auction-bid-form" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
					<p class="rh_widget_form__row">
						<label for="name"><?php esc_html_e('Bid Amount', 'framework'); ?></label>
						<input type="text" name="bid_amount" placeholder="<?php esc_html_e('Enter your bid', 'framework'); ?>" class="required" title="<?php esc_html_e('* USD', 'framework'); ?>" />
					</p>
					<!-- /.rh_widget_form__row -->
					<input type="hidden" name="nonce" value="<?php echo esc_attr(wp_create_nonce('auction_bid_nonce')); ?>"/>
					<input type="hidden" name="action" value="verify_auction_bid"/>
					<input type="hidden" name="auction_property_id" value="<?php echo $post->ID; ?>"/>
					<input type="hidden" name="user_id" value="<?php echo $uid; ?>"/>

					<input type="submit" value="<?php esc_html_e('Bid Now', 'framework'); ?>" name="submit" class="rh_btn rh_btn--primary rh_widget_form__submit">

					<span id="ajax-loader"><?php include INSPIRY_THEME_DIR . '/images/loader.svg'; ?></span>

					<div class="error-container"></div>
					<!-- /.error-container -->
					<div class="message-container"></div>
					<!-- /.message-container -->
				</form>
			</div>

			<?php } ?>
			
				<?php if ($is_auction_closed) : ?>
					<span class="auction-current-status">This auction lot is now closed.</span>
				<?php endif; ?>
			</div>

		<?php echo '</div></div></div>'; // end print widget blocks and classes


		echo $args['after_widget'];

		endif; // end display widget only if post is a auction property 
	}
         
// Widget Backend 
	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('New title', 'framework');
		}
// Widget admin form
		?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update($new_instance, $old_instance)
{
	$instance = array();
	$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
	return $instance;
}
} // Class Auction_Property_Details_widget ends here


// Declaring WooCommerce support
function mytheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

/*
// Disable the default stylesheet WooCommerce
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

//unhook the WooCommerce wrappers:

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// load only the CSS styles and Javascripts only on the WooCommerce product and shop pages
add_action('template_redirect', 'remove_woocommerce_styles_scripts', 999);
function remove_woocommerce_styles_scripts()
{
	if (function_exists('is_woocommerce')) {
		if (!is_woocommerce() && !is_cart() && !is_checkout()) {
			remove_action('wp_enqueue_scripts', [WC_Frontend_Scripts::class, 'load_scripts']);
			remove_action('wp_print_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
			remove_action('wp_print_footer_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
		}
	}
}
*/