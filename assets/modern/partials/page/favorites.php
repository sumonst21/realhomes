<?php
/**
 * Display favorites properties for modern design variation.
 *
 * @since   3.0.0
 * @since   3.2.2 refactored code
 *
 * @package realhomes
 * @subpackage  modern
 */

get_header();

// Page Head.
$header_variation = get_option( 'inspiry_member_pages_header_variation' );

if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/header' );
} elseif ( ! empty( $header_variation ) && ( 'banner' === $header_variation ) ) {
	get_template_part( 'assets/modern/partials/banner/image' );
}

if ( inspiry_show_header_search_form() ) {
	get_template_part( 'assets/modern/partials/properties/search/advance' );
}

?>

<section class="rh_section rh_wrap rh_wrap--padding rh_wrap--topPadding">

	<div class="rh_page">

		<div class="rh_page__head">

			<?php
			// Page Head.
			$header_variation = get_option( 'inspiry_member_pages_header_variation' );

			if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) :
				?>
				<h2 class="rh_page__title">
					<?php
					$page_title = get_the_title( get_the_ID() );
					echo inspiry_get_exploded_heading( $page_title );
					?>
				</h2>
				<!-- /.rh_page__title -->
			<?php endif; ?>

			<div class="rh_page__nav">

				<?php
				$profile_url = inspiry_get_edit_profile_url();
				if ( ! empty( $profile_url ) ) :
					?>
					<a href="<?php echo esc_url( $profile_url ); ?>" class="rh_page__nav_item">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-profile.svg'; ?>
						<p><?php esc_html_e( 'Profile', 'framework' ); ?></p>
					</a>
					<?php
				endif;

				$my_properties_url = inspiry_get_my_properties_url();
				if ( ! empty( $my_properties_url ) ) :
					?>
					<a href="<?php echo esc_url( $my_properties_url ); ?>" class="rh_page__nav_item">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-my-properties.svg'; ?>
						<p><?php esc_html_e( 'My Properties', 'framework' ); ?></p>
					</a>
					<?php
				endif;

				$favorites_url = inspiry_get_favorites_url(); // Favorites page.
				if ( ! empty( $favorites_url ) ) :
					?>
					<a href="<?php echo esc_url( $favorites_url ); ?>" class="rh_page__nav_item active">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-favorite.svg'; ?>
						<p><?php esc_html_e( 'Favorites', 'framework' ); ?></p>
					</a>
				<?php endif; ?>

			</div>
			<!-- /.rh_page__nav -->

		</div>
		<!-- /.rh_page__head -->

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>

				<?php if ( get_the_content() ) : ?>
					<div class="rh_content rh_page__content">
						<?php the_content(); ?>
					</div>
					<!-- /.rh_content -->
				<?php endif; ?>

			<?php endwhile; ?>
		<?php endif; ?>

		<div class="rh_page__favorites">

			<?php
			$favorite_properties = array();

			if ( is_user_logged_in() ) {
				$user_id             = get_current_user_id();
				$favorite_properties = get_user_meta( $user_id, 'favorite_properties' );
			} else {
				if ( isset( $_COOKIE[ 'inspiry_favorites' ] ) ) {
					$favorite_properties = unserialize( $_COOKIE[ 'inspiry_favorites' ] );
				}
			}

			$number_of_properties = count( $favorite_properties );

			if ( $number_of_properties > 0 ) {

				$favorites_properties_args = array(
					'post_type'      => 'property',
					'posts_per_page' => $number_of_properties,
					'post__in'       => $favorite_properties,
					'orderby'        => 'post__in',
				);

				$favorites_query = new WP_Query( $favorites_properties_args );

				if ( $favorites_query->have_posts() ) :
					while ( $favorites_query->have_posts() ) :
						$favorites_query->the_post();

						// Display property in list layout.
						get_template_part( 'assets/modern/partials/properties/favorite-card' );

					endwhile;
					wp_reset_postdata();
				else :
					?>
					<div class="rh_alert-wrapper">
						<h4 class="no-results"><?php esc_html_e( 'No property found!', 'framework' ); ?></h4>
					</div>
					<?php
				endif;
			} else {
				?>
				<div class="rh_alert-wrapper">
					<h4 class="no-results"><?php esc_html_e( 'You have no property in favorites!', 'framework' ); ?></h4>
				</div>
				<?php
			}
			?>
		</div>
		<!-- /.rh_page__favorites -->

		<?php ( $number_of_properties > 0 ) ? inspiry_theme_pagination( $favorites_query->max_num_pages ) : false; ?>

	</div>
	<!-- /.rh_page -->

</section>
<!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php

get_footer();
