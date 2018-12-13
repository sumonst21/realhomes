<?php
/**
 * Property Archive
 *
 * @package    realhomes
 * @subpackage classic
 */

get_header();

/* Determine the type header to be used for taxonomy */
$theme_listing_module = get_option( 'theme_listing_module' );

switch ( $theme_listing_module ) {
	case 'properties-map':
		get_template_part( 'assets/classic/partials/banners/google-map' );
		break;
	default:
		get_template_part( 'assets/classic/partials/banners/property-archive' );
		break;
}

/* Check View Type */
if ( isset( $_GET['view'] ) ) {
	$view_type = $_GET['view'];
} else {
	/* Theme Options Listing Layout */
	$view_type = get_option( 'theme_listing_layout' );
}
?>

<div class="container contents listing-grid-layout">
	<div class="row">
		<div class="span9 main-wrap">

			<!-- Main Content -->
			<div class="main">

				<section class="listing-layout <?php if ( 'grid' == $view_type ) {
					echo 'property-grid';
				} ?>">

					<?php
					// Listing view type.
					get_template_part( 'assets/classic/partials/properties/view-buttons' );
					?>

					<div class="list-container clearfix">
						<?php
						get_template_part( 'assets/classic/partials/properties/sort-controls' );

						$compare_properties_module = get_option( 'theme_compare_properties_module' );
						$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
						if ( ( 'enable' == $compare_properties_module ) && ( $inspiry_compare_page ) ) {
							get_template_part( 'assets/classic/partials/properties/compare/view' );
						}

						$sort_query_args = array();
						$sort_query_args = sort_properties( $sort_query_args );

						global $wp_query;
						$args = array_merge( $wp_query->query_vars, $sort_query_args );
						query_posts( $args );

						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();

								if ( 'grid' == $view_type ) {
									/* Display Property for Grid */
									get_template_part( 'assets/classic/partials/properties/grid-card' );
								} else {
									/* Display Property for Listing */
									get_template_part( 'assets/classic/partials/properties/list-card' );
								}

							endwhile;
						else :
							?>
							<div class="alert-wrapper">
								<h4><?php esc_html_e( 'No Property Found', 'framework' ); ?></h4>
							</div>
							<?php
						endif;
						?>
					</div>

					<?php theme_pagination( $wp_query->max_num_pages ); ?>

				</section>

			</div><!-- End Main Content -->

		</div> <!-- End span9 -->

		<?php get_sidebar( 'property-listing' ); ?>

	</div><!-- End contents row -->
</div>

<?php get_footer(); ?>
