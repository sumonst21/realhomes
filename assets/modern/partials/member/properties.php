<?php
/**
 * Member: Properties
 *
 * Inner template for my properties page. This page contains
 * member properties.
 *
 * @package    realhomes
 * @subpackage modern
 */

// Page Head.
$header_variation = get_option( 'inspiry_member_pages_header_variation' );

?>

<section class="rh_section rh_wrap rh_wrap--padding rh_wrap--topPadding">

	<div class="rh_page">

		<div class="rh_page__head">

			<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
				<h2 class="rh_page__title">
					<?php
					global $post;
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
					<a href="<?php echo esc_url( $my_properties_url ); ?>" class="rh_page__nav_item active">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-my-properties.svg'; ?>
						<p><?php esc_html_e( 'My Properties', 'framework' ); ?></p>
					</a>
					<?php
				endif;

				$favorites_url = inspiry_get_favorites_url(); // Favorites page.
				if ( ! empty( $favorites_url ) ) :
					?>
					<a href="<?php echo esc_url( $favorites_url ); ?>" class="rh_page__nav_item">
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

		<div class="rh_properties">

			<?php
			if ( ! is_user_logged_in() ) {
				$enable_user_nav = get_option( 'theme_enable_user_nav' );
				$theme_login_url = inspiry_get_login_register_url(); // Login and Register.

				if ( ! empty( $enable_user_nav ) && 'true' === $enable_user_nav ) {
					if ( empty( $theme_login_url ) ) {
						alert( esc_html__( 'Login Required:', 'framework' ), esc_html__( 'Please login to view your properties!', 'framework' ) );
					} elseif ( ! empty( $theme_login_url ) ) {
						alert( esc_html__( 'Login Required:', 'framework' ), sprintf( esc_html__( 'Please %1$s login %2$s to view your properties!', 'framework' ), '<a href="' . esc_url( $theme_login_url ) . '">', '</a>' ) );
					}
				} else {
					alert( esc_html__( 'Login Required:', 'framework' ), esc_html__( 'Please login to view your properties!', 'framework' ) );
				}
			} elseif ( is_user_logged_in() ) {

				if ( isset( $_GET['deleted'] ) && ( 1 == intval( $_GET['deleted'] ) ) ) {
					alert( esc_html__( 'Success:', 'framework' ), esc_html__( 'Property removed.', 'framework' ) );
				} elseif ( isset( $_GET['property-added'] ) && ( true == $_GET['property-added'] ) ) {
					alert( esc_html__( 'Success:', 'framework' ), esc_html__( 'Property Submitted.', 'framework' ) );
				} elseif ( isset( $_GET['property-updated'] ) && ( true == $_GET['property-updated'] ) ) {
					alert( esc_html__( 'Success:', 'framework' ), esc_html__( 'Property Updated.', 'framework' ) );
				} elseif ( isset( $_GET['payment'] ) && ( 'paid' == $_GET['payment'] ) ) {
					alert( esc_html__( 'Success:', 'framework' ), esc_html__( 'Payment Submitted.', 'framework' ) );
				} elseif ( isset( $_GET['payment'] ) && ( 'failed' == $_GET['payment'] ) ) {
					alert( esc_html__( 'Error:', 'framework' ), esc_html__( 'Payment Failed.', 'framework' ) );
				}

				if ( class_exists( 'IMS_Functions' ) && is_user_logged_in() ) {

					// Membership enable option.
					$ims_functions         = IMS_Functions();
					$is_memberships_enable = $ims_functions::is_memberships();

					if ( ! empty( $is_memberships_enable ) ) {

						// Get current user.
						$ims_user = wp_get_current_user();

						// Get property numbers.
						$ims_membership = get_user_meta( $ims_user->ID, 'ims_current_membership', true );
						$ims_properties = get_user_meta( $ims_user->ID, 'ims_current_properties', true );
						$ims_featured   = get_user_meta( $ims_user->ID, 'ims_current_featured_props', true );

						$available_properties_heading          = esc_html__( 'Number of properties that you can publish:', 'framework' );
						$available_featured_properties_heading = esc_html__( 'Number of properties that can be marked as featured:', 'framework' );

						if ( ! empty( $ims_membership ) && ! empty( $ims_properties ) ) {
							$notices = array(
								'0' => array(
									'heading' => $available_properties_heading,
									'message' => $ims_properties,
								),
								'1' => array(
									'heading' => $available_featured_properties_heading,
									'message' => $ims_featured,
								),
							);
							display_notice( $notices );
						} elseif ( ! empty( $ims_membership ) && empty( $ims_properties ) ) {
							$notices = array(
								'0' => array(
									'heading' => $available_properties_heading,
									'message' => '',
								),
								'1' => array(
									'heading' => $available_featured_properties_heading,
									'message' => $ims_featured,
								),
							);
							display_notice( $notices );
						} elseif ( ! empty( $ims_membership ) && empty( $ims_featured ) ) {
							$notices = array(
								'0' => array(
									'heading' => $available_properties_heading,
									'message' => $ims_properties,
								),
								'1' => array(
									'heading' => $available_featured_properties_heading,
									'message' => '',
								),
							);
							display_notice( $notices );
						} elseif ( ! empty( $ims_membership ) && empty( $ims_properties ) && empty( $ims_featured ) ) {
							$notices = array(
								'0' => array(
									'heading' => $available_properties_heading,
									'message' => '',
								),
								'1' => array(
									'heading' => $available_featured_properties_heading,
									'message' => '',
								),
							);
							display_notice( $notices );
						} elseif ( empty( $ims_membership ) ) {
							alert( esc_html__( 'Please subscribe a membership package to start publishing properties.', 'framework' ) );
						}
					}
				}

				global $paged;

				// Get current user.
				$current_user = wp_get_current_user();

				// My properties arguments.
				$my_props_args = array(
					'post_type'      => 'property',
					'posts_per_page' => 10,
					'paged'          => $paged,
					'post_status'    => array( 'pending', 'draft', 'publish', 'future' ),
					'author'         => $current_user->ID,
				);

				$my_properties_query = new WP_Query( $my_props_args );

				if ( $my_properties_query->have_posts() ) :

					/* Get Payment Related Options before while loop */
					$payments_enabled   = get_option( 'theme_enable_paypal' );
					$paypal_ipn_url     = get_option( 'theme_paypal_ipn_url' );
					$paypal_merchant_id = get_option( 'theme_paypal_merchant_id' );
					$enable_sandbox     = get_option( 'theme_enable_sandbox' );
					$payment_amount     = get_option( 'theme_payment_amount' );
					$currency_code      = get_option( 'theme_currency_code' );

					while ( $my_properties_query->have_posts() ) :

						$my_properties_query->the_post();

						get_template_part( 'assets/modern/partials/member/my-property' );

					endwhile;

					wp_reset_postdata();

				else :
					alert( esc_html__( 'Note:', 'framework' ), esc_html__( 'No Properties Found!', 'framework' ) );
				endif;

				inspiry_theme_pagination( $my_properties_query->max_num_pages );

			}
			?>

		</div>
		<!-- /.rh_properties -->

	</div>
	<!-- /.rh_page -->

</section>
<!-- /.rh_section rh_wrap rh_wrap--padding -->
