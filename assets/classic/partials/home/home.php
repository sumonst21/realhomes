<?php
/**
 * Homepage
 *
 * @package    realhomes
 * @subpackage classic
 */

get_header();


/* Theme Home Page Module */
$theme_homepage_module = get_option( 'theme_homepage_module' );
$main_border_class     = '';

/* For demo purpose only */
if ( isset( $_GET['module'] ) ) {
	$theme_homepage_module = $_GET['module'];
}

switch ( $theme_homepage_module ) {
	case 'properties-slider':
		get_template_part( 'assets/classic/partials/home/slider/properties' );
		break;

	case 'search-form-over-image':
		get_template_part( 'assets/classic/partials/home/slider/search-form-over-image' );
		break;

	case 'slides-slider':
		get_template_part( 'assets/classic/partials/home/slider/slides' );
		break;

	case 'properties-map':
		get_template_part( 'assets/classic/partials/banners/google-map' );
		break;

	case 'revolution-slider':
		$rev_slider_alias = trim( get_option( 'theme_rev_alias' ) );
		if ( function_exists( 'putRevSlider' ) && ( ! empty( $rev_slider_alias ) ) ) {
			putRevSlider( $rev_slider_alias );
		} else {
			get_template_part( 'assets/classic/partials/banners/default' );
		}
		break;

	default:
		get_template_part( 'assets/classic/partials/banners/default' );
		$main_border_class = 'top-border';
		break;
}
?>

<div class="main-wrapper contents">

	<?php
	/**
	 * Advance Search
	 */
	get_template_part( 'assets/classic/partials/home/sections/advance-search' );

	/**
	 * Get all the sections to be displayed on Homepage
	 */
	$sections                        = array();
	$sections['home-properties']     = get_option( 'theme_show_home_properties' );
	$sections['features-section']    = get_option( 'inspiry_show_features_section' );
	$sections['featured-properties'] = get_option( 'theme_show_featured_properties' );
	$sections['blog-posts']          = get_option( 'theme_show_news_posts' );

	// For demo purpose only.
	if ( isset( $_GET['show-features'] ) ) {
		$show_home_features = $_GET['show-features'];
	}

	/**
	 * Get the order in which sections are to be displayed
	 */
	$home_sections = get_option( 'inspiry_home_sections_order' );
	$home_sections = ( ! empty( $home_sections ) ) ? $home_sections : 'home-properties,features-section,featured-properties,blog-posts';
	$home_sections = explode( ',', $home_sections );

	/**
	 * Display sections according to their order
	 */
	if ( ! empty( $home_sections ) && is_array( $home_sections ) ) {
		foreach ( $home_sections as $home_section ) {
			if ( 'true' === $sections[ $home_section ] ) {
				get_template_part( 'assets/classic/partials/home/sections/' . $home_section );
			}
		}
	}
	?>

</div>
<!-- /.main-wrapper -->

<?php get_footer(); ?>
