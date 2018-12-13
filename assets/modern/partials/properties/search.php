<?php
/**
 * Template: Property Search
 *
 * Property search template.
 *
 * @package    realhomes
 * @subpackage modern
 */

get_header();

// Page Head.
$header_variation = get_option( 'inspiry_search_header_variation' );

if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} elseif ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/image' );
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}

$number_of_properties = intval( get_option( 'theme_properties_on_search' ) );
if ( ! $number_of_properties ) {
	$number_of_properties = 6;
}

global $paged;
if ( is_front_page() ) {
	$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
}

$search_args = array(
	'post_type'      => 'property',
	'posts_per_page' => $number_of_properties,
	'paged'          => $paged,
);

/* Apply Search Filter */
$search_args = apply_filters( 'real_homes_search_parameters', $search_args );

/* Sort Properties */
$search_args = sort_properties( $search_args );

$search_query = new WP_Query( $search_args ); ?>

<section class="rh_section rh_section--flex <?php echo ( inspiry_show_search_form_widget() ) ? false : 'rh_section__map_listing'; ?>">

	<div class="rh_page rh_page__listing_map">
		<?php get_template_part( 'assets/modern/partials/properties/google-map' ); ?>
	</div>
	<!-- /.rh_page rh_page__listing_map -->

	<div class="rh_page rh_page__map_properties">

		<div class="rh_page__head">

			<h2 class="rh_page__title">
				<?php
					$found_properties = $search_query->found_posts;
					$zero_in_format   = ( 0 == $found_properties ) ? 1 : 2;
					$found_properties = sprintf( '%0' . $zero_in_format . 'd', $found_properties );
				?>
				<span class="sub"><?php echo esc_html( $found_properties ); ?></span>
				<span class="title">
					<?php
						if ( 1 < $search_query->found_posts ) {
							esc_html_e( 'Results', 'framework' );
						} else {
							esc_html_e( 'Result', 'framework' );
						}
					?>
	            </span>
			</h2>
			<!-- /.rh_page__title -->

			<div class="rh_page__controls">
				<?php get_template_part( 'assets/modern/partials/properties/sort-controls' ); ?>
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

		<div class="rh_page__listing">

			<?php
				if ( $search_query->have_posts() ) :
					while ( $search_query->have_posts() ) :
						$search_query->the_post();

						// Display property in list layout.
						get_template_part( 'assets/modern/partials/properties/half-map-card' );

					endwhile;
					wp_reset_postdata();
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

		<?php inspiry_theme_pagination( $search_query->max_num_pages ); ?>

	</div>
	<!-- /.rh_page rh_page__map_properties -->

</section>	<!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php
get_footer();
