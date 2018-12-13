<?php
/**
 * Archive: Property Grid Container
 *
 * Grid properties container for archive template.
 *
 * @package  realhomes
 * @subpackage modern
 */

// Page Head.
$header_variation = get_option( 'inspiry_listing_header_variation', 'none' );

/* Theme Listing Page Module */
$theme_listing_module = get_option( 'theme_listing_module' );

switch ( $theme_listing_module ) {
	case 'properties-map':
		echo '<div class="rh_map rh_map__search">';
		get_template_part( 'assets/modern/partials/properties/google-map' );
		echo '</div>';
		break;

	default:
		break;
}

?>

<section class="rh_section rh_section--flex rh_wrap--padding rh_wrap--topPadding">

	<div class="rh_page rh_page__listing_page rh_page__main">

		<div class="rh_page__head">

			<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
				<h2 class="rh_page__title">
					<p class="title"><?php post_type_archive_title(); ?></p>
				</h2>
				<!-- /.rh_page__title -->
			<?php endif; ?>

			<div class="rh_page__controls">
				<?php get_template_part( 'assets/modern/partials/properties/sort-controls' ); ?>
				<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
					<?php get_template_part( 'assets/modern/partials/properties/view-buttons' ); ?>
				<?php endif; ?>
			</div>
			<!-- /.rh_page__controls -->

		</div>
		<!-- /.rh_page__head -->

		<?php
		$compare_properties_module = get_option( 'theme_compare_properties_module' );
		$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
		if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
			get_template_part( 'assets/modern/partials/properties/compare-view' );
		}
		?>

		<div class="rh_page__listing rh_page__listing_grid">

			<?php
			$sort_query_args = array();
			$sort_query_args = sort_properties( $sort_query_args );

			global $wp_query;
			$args = array_merge( $wp_query->query_vars, $sort_query_args );
			query_posts( $args );

			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();

					// Display property in list layout.
					get_template_part( 'assets/modern/partials/properties/grid-card' );

				endwhile;
			else :
				?>
				<div class="rh_alert-wrapper">
					<h4 class="no-results"><?php esc_html_e( 'Sorry No Results Found', 'framework' ); ?></h4>
				</div>
				<?php
			endif;
			?>
		</div>
		<!-- /.rh_page__listing -->

		<?php inspiry_theme_pagination( $wp_query->max_num_pages ); ?>

	</div>
	<!-- /.rh_page rh_page__main -->

	<div class="rh_page rh_page__sidebar">
		<?php get_sidebar( 'property-listing' ); ?>
	</div>
	<!-- /.rh_page rh_page__sidebar -->

</section>
<!-- /.rh_section rh_wrap rh_wrap--padding -->
