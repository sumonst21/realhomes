<?php
/**
 * Single Agency
 *
 * Template for single agency.
 *
 * @since    3.5.0
 * @package  RH/modern
 */

get_header();

$header_variation = get_option( 'inspiry_agencies_header_variation', 'none' );

if ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) :
	get_template_part( 'assets/modern/partials/banner/image' );
elseif ( empty( $header_variation ) || ( 'none' === $header_variation ) ) :
	get_template_part( 'assets/modern/partials/banner/header' );
endif;

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}

?>

<section class="rh_section rh_section--flex rh_wrap--padding rh_wrap--topPadding">

	<div class="rh_page rh_page__agents rh_page__main">

		<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
			<div class="rh_page__head">

				<h2 class="rh_page__title">
					<span class="sub"><?php esc_html_e( 'Agency', 'framework' ); ?></span>
					<span class="title"><?php esc_html_e( 'Profile', 'framework' ); ?></span>
				</h2>
				<!-- /.rh_page__title -->

			</div>            <!-- /.rh_page__head -->
		<?php endif; ?>

		<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'assets/modern/partials/agency/single/card' );
				endwhile;
			endif;

			$number_of_properties = intval( get_option( 'inspiry_number_of_agents_agency', 6 ) );

			/**
			 * Agent properties
			 */
			global $paged;
			$agents_query = array(
				'post_type'      => 'agent',
				'posts_per_page' => $number_of_properties,
				'meta_query'     => array(
					array(
						'key'     => 'REAL_HOMES_agency',
						'value'   => get_the_ID(),
						'compare' => '=',
					),
				),
				'paged'          => $paged
			);

			$agent_listing_query = new WP_Query( $agents_query );

			if ( $agent_listing_query->have_posts() ) {

				?>
				<div class="rh_page__head rh_page--single_agent">

					<h2 class="rh_page__title">
						<span class="sub"><?php esc_html_e( 'Our Agents', 'framework' ); ?></span>
					</h2><!-- /.rh_page__title -->

				</div><!-- /.rh_page__head -->

				<div class="rh_page__section">
					<?php
							while ( $agent_listing_query->have_posts() ) :
								$agent_listing_query->the_post();
								get_template_part( 'assets/modern/partials/agent/card' );
							endwhile;
					?>
				</div><!-- /.rh_page__section -->
				<?php
				inspiry_theme_pagination( $agent_listing_query->max_num_pages );
			}
		?>
	</div>
	<!-- /.rh_page rh_page__main -->

	<div class="rh_page rh_page__sidebar">
		<?php get_sidebar( 'agency' ); ?>
	</div>
	<!-- /.rh_page rh_page__sidebar -->

</section><!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php
get_footer();
