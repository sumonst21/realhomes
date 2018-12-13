<?php
/**
 * Page: Memberships
 *
 * Page template for memberships.
 *
 * @since   3.0.0
 * @package RH/modern
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

	<section class="rh_section rh_section--flex rh_wrap--padding rh_wrap--topPadding">
		<div class="rh_page rh_page__listing_page rh_page__main">
			<?php
			/*
			 * Page Title
			 */
			if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) {
				?>
				<div class="rh_page__head">
					<h2 class="rh_page__title">
						<?php
						$page_title = get_the_title( get_the_ID() );
						echo inspiry_get_exploded_heading( $page_title );
						?>
					</h2>
				</div>
				<!-- /.rh_page__head -->
				<?php
			}

			/*
			 * Display message if user not logged in.
			 */
			if ( ! is_user_logged_in() ) {
				$enable_user_nav = get_option( 'theme_enable_user_nav' );
				$theme_login_url = inspiry_get_login_register_url(); // Login and Register.
				?>
				<div class="rh_content rh_page__content">
					<?php
					if ( ! empty( $enable_user_nav ) && 'true' === $enable_user_nav ) {
						if ( empty( $theme_login_url ) ) {
							alert( esc_html__( 'Login Required:', 'framework' ), esc_html__( 'Please login to access page content!', 'framework' ) );
						} else {
							alert( esc_html__( 'Login Required:', 'framework' ), sprintf( esc_html__( 'Please %1$s login %2$s to access page content!', 'framework' ), '<a href="' . esc_url( $theme_login_url ) . '">', '</a>' ) );
						}
					} else {
						alert( esc_html__( 'Login Required:', 'framework' ), esc_html__( 'Please login to access page content!', 'framework' ) );
					}
					?>
				</div>
				<!-- /.rh_content -->
				<?php

			} else {

				/*
				 * Page's contents.
				 */
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						if ( get_the_content() ) :
							?>
							<div class="rh_content rh_page__content">
								<?php the_content(); ?>
							</div>
							<!-- /.rh_content -->
							<?php
						endif;
					endwhile;
				endif;


				/*
				 * Memberships plans/packages.
				 */
				?>
				<div class="rh_memberships">
					<?php
					// If inspiry-memberships plugin is not active then show error message.
					if ( ! class_exists( 'IMS_Functions' ) ) :
						?>
						<div class="rh_alert-wrapper">
							<h4 class="no-results"><?php esc_html_e( 'Inspiry Memberships plugin is not active!', 'framework' ); ?></h4>
						</div>
						<?php
					else :
						$ims_functions = IMS_Functions();
						$is_memberships_enable = $ims_functions::is_memberships();

						// If module is not enabled, show error.
						if ( empty( $is_memberships_enable ) ) :
							?>
							<div class="rh_alert-wrapper">
								<h4 class="no-results"><?php esc_html_e( 'Membership is not enabled!', 'framework' ); ?></h4>
							</div>
							<?php
						else :

							$inspiry_memberships = $ims_functions::ims_get_all_memberships();

							if ( is_array( $inspiry_memberships ) && ! empty( $inspiry_memberships ) ) :
								foreach ( $inspiry_memberships as $inspiry_membership ) :
									?>
									<div class="rh_membership">

										<div class="rh_membership__wrap">

											<div class="rh_membership__title">

												<?php if ( isset( $inspiry_membership[ 'title' ] ) && ! empty( $inspiry_membership[ 'title' ] ) ) : ?>
													<h4 class="title">
														<?php echo esc_html( $inspiry_membership[ 'title' ] ); ?>
													</h4>
													<!-- /.title -->
												<?php endif; ?>

												<?php if ( isset( $inspiry_membership[ 'format_price' ] ) && ! empty( $inspiry_membership[ 'format_price' ] ) && ( 0 < $inspiry_membership[ 'price' ] ) ) : ?>
													<p class="price">
														<?php echo esc_html( $inspiry_membership[ 'format_price' ] ); ?>
													</p>
													<!-- /.price -->
												<?php else : ?>
													<p class="price">
														<?php esc_html_e( 'Free', 'framework' ); ?>
													</p>
													<!-- /.price -->
												<?php endif; ?>

											</div>
											<!-- /.rh_membership__title -->

											<div class="rh_membership__details">
												<?php if ( isset( $inspiry_membership[ 'properties' ] ) && ! empty( $inspiry_membership[ 'properties' ] ) ) : ?>
													<p><?php echo esc_html( $inspiry_membership[ 'properties' ] ) . ' ' . esc_html__( 'Properties Allowed', 'framework' ); ?></p><!-- Properties Allowed -->
												<?php endif; ?>

												<?php if ( isset( $inspiry_membership[ 'featured_prop' ] ) && ! empty( $inspiry_membership[ 'featured_prop' ] ) ) : ?>
													<p><?php echo esc_html( $inspiry_membership[ 'featured_prop' ] ) . ' ' . esc_html__( 'Featured Properties', 'framework' ); ?></p><!-- Featured Properties -->
												<?php endif; ?>

												<?php if ( isset( $inspiry_membership[ 'duration' ] ) && ! empty( $inspiry_membership[ 'duration' ] ) ) : ?>
													<p>
														<?php
														if ( $inspiry_membership[ 'duration' ] > 1 ) {
															$duration_unit = ( isset( $inspiry_membership[ 'duration_unit' ] ) ) ? $inspiry_membership[ 'duration_unit' ] : false;
															if ( 'days' === $duration_unit ) {
																$duration_unit = esc_html__( 'days', 'framework' );
															} elseif ( 'weeks' === $duration_unit ) {
																$duration_unit = esc_html__( 'weeks', 'framework' );
															} elseif ( 'months' === $duration_unit ) {
																$duration_unit = esc_html__( 'months', 'framework' );
															} else {
																$duration_unit = esc_html__( 'years', 'framework' );
															}
															echo esc_html( $inspiry_membership[ 'duration' ] . ' ' . $duration_unit ) . ' ' . esc_html__( 'Time Duration', 'framework' );
														} else {
															$duration_unit = rtrim( $inspiry_membership[ 'duration_unit' ], 's' );
															if ( 'day' === $duration_unit ) {
																$duration_unit = esc_html__( 'day', 'framework' );
															} elseif ( 'week' === $duration_unit ) {
																$duration_unit = esc_html__( 'week', 'framework' );
															} elseif ( 'month' === $duration_unit ) {
																$duration_unit = esc_html__( 'month', 'framework' );
															} else {
																$duration_unit = esc_html__( 'year', 'framework' );
															}
															echo esc_html( $inspiry_membership[ 'duration' ] . ' ' . $duration_unit ) . ' ' . esc_html__( 'Time Duration', 'framework' );
														}
														?>
													</p><!-- Time Duration -->
												<?php endif; ?>
											</div>
											<!-- /.rh_membership__details -->

										</div>
										<!-- /.rh_membership__wrap -->

									</div>
									<!-- /.rh_membership -->

									<?php
								endforeach;
							endif;

						endif;
					endif;
					?>
				</div>
				<!-- /.rh_memberships -->
				<?php
			}
			?>

		</div>
		<!-- /.rh_page .rh_page__main -->

		<div class="rh_page rh_page__sidebar">

			<?php
			if ( is_user_logged_in() ) {

				if ( class_exists( 'IMS_Functions' ) ) {

					$ims_functions         = IMS_Functions();
					$is_memberships_enable = $ims_functions::is_memberships();

					// If module is not enabled, show error.
					if ( ! empty( $is_memberships_enable ) ) {
						?>
						<div class="rh_memberships__sidebar">
							<h4 class="title"><?php esc_html_e( 'Current Membership', 'framework' ); ?></h4>
							<!-- /.title -->
							<?php
							// Get current user data.
							$current_user = wp_get_current_user();

							// Get current membership of user.
							$current_membership = $ims_functions::ims_get_membership_by_user( $current_user );
							if ( is_array( $current_membership ) && ! empty( $current_membership ) ) {
								?>
								<div class="details">
									<p class="membership"><?php echo esc_html( $current_membership[ 'title' ] ); ?></p>
									<!-- /.membership -->
									<div class="cancel">
										<?php $ims_functions::cancel_user_membership_form( $current_user ); ?>
									</div>
									<!-- /.cancel -->
								</div>
								<!-- /.details -->
								<?php
							} else {
								?>
								<p class="message"><?php esc_html_e( 'You have no current membership.', 'framework' ); ?></p><?php
							}
							?>
						</div>
						<!-- /.rh_memberships__sidebar -->

						<div class="rh_memberships__sidebar">
							<h4 class="title"><?php esc_html_e( 'Update Membership', 'framework' ); ?></h4>
							<div class="rh_memberships__selection">
								<?php
								if ( class_exists( 'IMS_Functions' ) ) {
									$ims_functions = IMS_Functions();
									$ims_functions::ims_display_membership_form();
								}
								?>
							</div>
							<!-- /.rh_memberships__selection -->
						</div>
						<!-- /.rh_memberships__sidebar -->
						<?php

					}
				}
			}
			?>

		</div>
		<!-- /.rh_page rh_page__sidebar -->

	</section>
	<!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php
get_footer();
