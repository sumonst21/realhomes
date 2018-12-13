<?php
/**
 * Map based Property Listing
 *
 * Page template for map based property listing.
 *
 * @package    realhomes
 * @subpackage classic
 */

get_header();

// Page Head.
get_template_part( 'assets/classic/partials/banners/google-map' ); ?>

<!-- Content -->
<?php
if ( isset( $_GET['view'] ) ) {
	$view_type = $_GET['view'];
} else {
	/* Theme Options Listing Layout */
	$view_type = get_option( 'theme_listing_layout' );
}

if ( 'grid' === $view_type ) {
	get_template_part( 'assets/classic/partials/properties/grid' );
} else {
	get_template_part( 'assets/classic/partials/properties/list' );
}
?>
<!-- End Content -->

<?php get_footer(); ?>
