<?php
/**
 * Properties Search Page
 *
 * @since 2.7.0
 * @package RH/classic
 */

get_header();

/* Theme Home Page Module */
$theme_search_module = get_option( 'theme_search_module' );

switch ( $theme_search_module ) {
	case 'properties-map':
		get_template_part( 'assets/classic/partials/banners/google-map' );
		break;

	default:
		get_template_part( 'assets/classic/partials/banners/default' );
		break;
}

?>

<!-- Content -->
<div class="container contents">
	<div class="row">
		<div class="span12">
			<!-- Main Content -->
			<div class="main">
				<?php
					/* Advance Search Form */
					get_template_part( 'assets/classic/partials/properties/search/form-wrapper' );
				?>

				<section class="property-items">
					<?php
					/*
					 * number of properties to display on search results page.
					 */
					$number_of_properties = intval( get_option( 'theme_properties_on_search' ) );
					if ( ! $number_of_properties ) {
						$number_of_properties = 4;
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

					global $search_query;
					$search_query = new WP_Query( $search_args );

					?>

					<div class="search-header inner-wrapper clearfix">
						<div class="properties-count">
							<span><strong><?php echo esc_html( $search_query->found_posts ); ?></strong>&nbsp;
								<?php
								if ( 1 < $search_query->found_posts ) {
									esc_html_e( 'Results', 'framework' );
								} else {
									esc_html_e( 'Result', 'framework' );
								}
								?>
							</span>
						</div>
						<?php
						/*
						 * Sort controls.
						 */
						get_template_part( 'assets/classic/partials/properties/sort-controls' );


						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								$content = get_the_content();
								if ( ! empty( $content ) ) {
									?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
										<?php the_content(); ?>
									</article>
									<?php
								}
							}
						}

						/*
						 * Compare Properties.
						 */
						$compare_properties_module = get_option( 'theme_compare_properties_module' );
						$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
						if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
							get_template_part( 'assets/classic/partials/properties/compare/view' );
						}
						?>
					</div>

					<?php
						$search_listing_template = get_option('inspiry_search_template_variation', 'two-columns');

						//search template
						get_template_part( 'assets/classic/partials/properties/search/' . $search_listing_template );
					?>

					<?php theme_pagination( $search_query->max_num_pages ); ?>

				</section>

			</div><!-- End Main Content -->

		</div> <!-- End span12 -->

	</div><!-- End  row -->

</div><!-- End content -->

<?php get_footer(); ?>
