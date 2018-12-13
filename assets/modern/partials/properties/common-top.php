<?php
/**
 * Common top par for grid and list files.
 */

/*
 * Skip sticky properties.
 */
$skip_sticky = get_option( 'inspiry_listing_skip_sticky', false );
if ( $skip_sticky ) {
	remove_filter( 'the_posts', 'inspiry_make_properties_stick_at_top', 10 );
}

/*
 * List page module
 */
/*
$theme_listing_module = get_option( 'theme_listing_module' );

$map_class = ( inspiry_show_header_search_form() ) ? 'rh_map__search' : false;

switch ( $theme_listing_module ) {
	case 'properties-map':
		echo '<div class="rh_map ' . esc_attr( $map_class ) . ' ">';
		get_template_part( 'assets/modern/partials/properties/google-map' );
		echo '</div>';
		break;

	default:
		break;
}
*/