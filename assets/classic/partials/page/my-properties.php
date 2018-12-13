<?php
/**
 * My Properties Page
 *
 * Page template for my properties page.
 *
 * @since 2.7.0
 * @package RH/classic
 */

get_header(); ?>

<!-- Page Head -->
<?php get_template_part( 'assets/classic/partials/banners/default' ); ?>

<!-- Content -->
<div class="container contents single my-properties">
	<div class="row">
		<div class="span12 main-wrap">

			<?php
			if ( isset( $_GET['deleted'] ) && ( 1 == intval( $_GET['deleted'] ) ) ) {
				alert( __( 'Success:', 'framework' ), __( 'Property removed.', 'framework' ) );
			} elseif ( isset( $_GET['property-added'] ) && ( true == $_GET['property-added'] ) ) {
				alert( __( 'Success:', 'framework' ), __( 'Property Submitted.', 'framework' ) );
			} elseif ( isset( $_GET['property-updated'] ) && ( true == $_GET['property-updated'] ) ) {
				alert( __( 'Success:', 'framework' ), __( 'Property Updated.', 'framework' ) );
			} elseif ( isset( $_GET['payment'] ) && ( 'paid' == $_GET['payment'] ) ) {
				alert( __( 'Success:', 'framework' ), __( 'Payment Submitted.', 'framework' ) );
			} elseif ( isset( $_GET['payment'] ) && ( 'failed' == $_GET['payment'] ) ) {
				alert( __( 'Error:', 'framework' ), __( 'Payment Failed.', 'framework' ) );
			}


			if ( class_exists( 'IMS_Functions' ) && is_user_logged_in() ) {

				// Membership enable option.
				$ims_functions          = IMS_Functions();
				$is_memberships_enable  = $ims_functions::is_memberships();

				if ( ! empty( $is_memberships_enable ) ) {

					// Get current user.
					$ims_user   = wp_get_current_user();

					// Get property numbers.
					$ims_membership = get_user_meta( $ims_user->ID, 'ims_current_membership', true );
					$ims_properties = get_user_meta( $ims_user->ID, 'ims_current_properties', true );
					$ims_featured   = get_user_meta( $ims_user->ID, 'ims_current_featured_props', true );

					$available_properties_heading          = __( 'Number of properties that you can publish:', 'framework' );
					$available_featured_properties_heading = __( 'Number of properties that can be marked as featured:', 'framework' );

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
						alert( __( 'Please subscribe a membership package to start publishing properties.', 'framework' ) );
					}
				}
			}

			global $post;
			$title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
			if ( 'hide' !== $title_display ) {
				?>
				<h3><span><?php the_title(); ?></span></h3>
				<?php
			}
			?>

			<!-- Main Content -->
			<div class="main">

				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();

						$content = get_the_content();
						if ( ! empty( $content ) ) {
							?>
							<div class="inner-wrapper my-properties-wrapper">
								<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
									<?php the_content(); ?>
								</article>
							</div>
							<!-- /.inner-wrapper -->
							<?php
						}
					endwhile;
				endif;

				if ( is_user_logged_in() ) {

					global $paged;

					// Get current user.
					$current_user = wp_get_current_user();

					// My properties arguments.
					$my_props_args = array(
						'post_type' => 'property',
						'posts_per_page' => 10,
						'paged' => $paged,
						'post_status' => array( 'pending', 'draft', 'publish', 'future' ),
						'author' => $current_user->ID,
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

							?>
							<div class="my-property clearfix">

								<div class="property-thumb cell">
									<?php
									if ( has_post_thumbnail( $post->ID ) ) {
										the_post_thumbnail( 'property-thumb-image' );
									} else {
										inspiry_image_placeholder( 'property-thumb-image' );
									}
									?>
								</div>

								<div class="property-title cell">
									<h5><?php the_title(); ?></h5>
								</div>

								<div class="property-date cell">
									<h5><i class="fa fa-calendar"></i>&nbsp;<?php esc_html_e( 'Posted on :','framework' ); ?>&nbsp;<?php the_time( get_option( 'date_format' ) ); ?></h5>
								</div>

								<div class="property-publish-status cell">
									<h5>
										<?php
											$property_statuses = get_post_statuses();
											$property_status   = get_post_status();
											echo esc_html( $property_statuses[ $property_status ] );
										?>
									</h5>
								</div>

								<div class="property-controls">
									<?php
									/* Edit Post Link */
									$submit_url = inspiry_get_submit_property_url();
									if ( ! empty( $submit_url ) ) {
										$edit_link = esc_url( add_query_arg( 'edit_property', $post->ID , $submit_url ) );
										?>
										<a href="<?php echo esc_url( $edit_link ); ?>"><i class="fa fa-pencil"></i></a>
										<?php
									}

									/* Preview Post Link */
									if ( current_user_can( 'edit_posts' ) ) {
										$preview_link = set_url_scheme( get_permalink( $post->ID ) );
										$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
										if ( ! empty( $preview_link ) ) {
											?>
											<a target="_blank" href="<?php echo esc_url( $preview_link ); ?>"><i class="fa fa-eye"></i></a>
											<?php
										}
									}

									/* Delete Post Link Bypassing Trash */
									if ( current_user_can( 'delete_posts' ) ) {
										$delete_post_link = get_delete_post_link( $post->ID, '', true );
										if ( ! empty( $delete_post_link ) ) {
											?>
											<a href="<?php echo esc_url( $delete_post_link ); ?>"><i class="fa fa-times"></i></a>
											<?php
										}
									}
									?>
								</div>

								<div class="property-payment cell">
									<?php

									// Payment Status.
									$payment_status = get_post_meta( $post->ID, 'payment_status', true );

									if ( 'Completed' === $payment_status ) {
										echo '<h5>';
											esc_html_e( 'Payment Completed', 'framework' );
										echo '</h5>';
									} elseif ( class_exists( 'IMS_Functions' ) ) {
										/**
										 * Do nothing because individual payments are locked
										 * when memberships plugin is active.
										 */
									} else {

										if ( class_exists( 'AngellEYE_Paypal_Ipn_For_Wordpress' ) ) {

											if ( ( 'true' == $payments_enabled )
												&& ( ! empty( $paypal_ipn_url ) )
												&& ( ! empty( $paypal_merchant_id ) )
												&& ( ! empty( $currency_code ) )
												&& ( ! empty( $payment_amount ) ) ) {

												$paypal_button_script = INSPIRY_DIR_URI . '/scripts/vendors/paypal-button.min.js';
												?>
												<script src= "<?php echo esc_url( add_query_arg( array( 'merchant' => $paypal_merchant_id ), $paypal_button_script ) ); ?>"
														<?php if ( 'true' == $enable_sandbox ) { ?>data-env="sandbox"<?php } ?>
														data-callback="<?php echo esc_url_raw( $paypal_ipn_url ); ?>"
														data-tax="0"
														data-shipping="0"
														data-currency="<?php echo esc_attr( $currency_code ); ?>"
														data-amount="<?php echo esc_attr( $payment_amount ); ?>"
														data-quantity="1"
														data-name="<?php the_title(); ?>"
														data-number="<?php the_ID(); ?>"
														data-button="buynow"
													></script>
												<?php
											}
										}

										/**
										 * This action hook is used to add multiple payment options
										 * for property submission e.g. Stripe etc.
										 *
										 * @since 2.6.4
										 */
										do_action( 'inspiry_property_payments', $post->ID );
									}
									?>
								</div>

							</div>
							<?php

						endwhile;

						wp_reset_postdata();

					else :
						alert( __( 'Note:', 'framework' ), __( 'No Properties Found!', 'framework' ) );
					endif;

					theme_pagination( $my_properties_query->max_num_pages );

				} else {
					alert( __( 'Login Required:', 'framework' ), __( 'Please, Login to view your properties!', 'framework' ) );
				}

				?>

			</div><!-- End Main Content -->

		</div> <!-- End span12 -->

	</div><!-- End contents row -->

</div><!-- End Content -->

<?php get_footer(); ?>
