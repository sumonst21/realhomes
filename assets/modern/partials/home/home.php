<?php
/**
 * Homepage Template
 *
 * @package realhomes
 * @subpackage modern
 */

get_header();

/* Theme Home Page Module */
$theme_homepage_module = get_option( 'theme_homepage_module' );

switch ( $theme_homepage_module ) {
	case 'properties-slider':
		get_template_part( 'assets/modern/partials/home/slider/property' );
		break;

	case 'properties-map':
		get_template_part( 'assets/modern/partials/home/slider/map' );
		break;

	case 'slides-slider':
		get_template_part( 'assets/modern/partials/home/slider/slides' );
		break;

	case 'revolution-slider':
		$rev_slider_alias = trim( get_option( 'theme_rev_alias' ) );
		if ( function_exists( 'putRevSlider' ) && ( ! empty( $rev_slider_alias ) ) ) {
			putRevSlider( $rev_slider_alias );
		} else {
			get_template_part( 'assets/modern/partials/banner/header' );
		}
		break;

	default:
		get_template_part( 'assets/modern/partials/banner/header' );
		break;
}

// Show sections options.
$inspiry_show_home_search         = get_option( 'theme_show_home_search' );            // Advance Search.
$inspiry_show_home_properties     = get_option( 'theme_show_home_properties', 'true' ); // Home properties.
$inspiry_show_featured_properties = get_option( 'theme_show_featured_properties' );    // Featured Properties.
$inspiry_show_testimonial         = get_option( 'inspiry_show_testimonial' );            // Testimonial.
$inspiry_show_cta                 = get_option( 'inspiry_show_cta' );                    // Call to Action.
$inspiry_show_agents              = get_option( 'inspiry_show_agents' );                // Agents.
$inspiry_show_home_features       = get_option( 'inspiry_show_home_features' );        // Features.
$inspiry_show_home_partners       = get_option( 'inspiry_show_home_partners' );        // Partners.
$inspiry_show_home_cta_contact    = get_option( 'inspiry_show_home_cta_contact' );    // CTA Contact.

if ( is_active_sidebar( 'home-search-area' ) ) : ?>
	<section class="rh_prop_search rh_wrap--padding">
		<?php dynamic_sidebar( 'home-search-area' ); ?>
	</section>
	<!-- /.rh_prop_search -->
	<?php
elseif ( ! empty( $inspiry_show_home_search ) && 'true' === $inspiry_show_home_search ) :
	get_template_part( 'assets/modern/partials/properties/search/advance' );
endif;

get_template_part( 'assets/modern/partials/home/section/content' );

if ( ! empty( $inspiry_show_home_properties ) && 'true' === $inspiry_show_home_properties ) {
	get_template_part( 'assets/modern/partials/home/section/latest-properties' );
}

if ( ! empty( $inspiry_show_featured_properties ) && 'true' === $inspiry_show_featured_properties ) {
	get_template_part( 'assets/modern/partials/home/section/featured-properties' );
}

if ( ! empty( $inspiry_show_testimonial ) && 'true' === $inspiry_show_testimonial ) {
	get_template_part( 'assets/modern/partials/home/section/testimonial' );
}

if ( ! empty( $inspiry_show_cta ) && 'true' === $inspiry_show_cta ) {
	get_template_part( 'assets/modern/partials/home/section/cta' );
}

if ( ! empty( $inspiry_show_agents ) && 'true' === $inspiry_show_agents ) {
	get_template_part( 'assets/modern/partials/home/section/agents' );
}

if ( ! empty( $inspiry_show_home_features ) && 'true' === $inspiry_show_home_features ) {
	get_template_part( 'assets/modern/partials/home/section/features' );
}

if ( ! empty( $inspiry_show_home_partners ) && 'true' === $inspiry_show_home_partners ) {
	get_template_part( 'assets/modern/partials/home/section/partners' );
}

if ( ! empty( $inspiry_show_home_cta_contact ) && 'true' === $inspiry_show_home_cta_contact ) {
	get_template_part( 'assets/modern/partials/home/section/cta-contact' );
}

// Customized by Sumonst21

echo '<section class="rh_section rh_section--featured rh_map rh_map_home">';
echo '<div class="rh_section__head"><h2 class="rh_section__title"> Map of our Properties </h2>';
echo '<p class="rh_section__desc"> Check out these shortlisted properties. </p> </div>';
	get_template_part( 'assets/modern/partials/properties/google-map' );
echo '</section><!-- /.rh_map -->';

get_footer();
