<?php
/**
 * Author Template
 *
 * @package realhomes
 * @subpackage classic
 */

if ( is_singular( 'agent' ) ) {
	global $post;
} elseif ( is_author() ) {
	global $current_author;
}

get_header(); ?>

<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo get_default_banner(); ?>'); ">
	<div class="container">
		<div class="wrap clearfix">
			<h1 class="page-title"><span><?php esc_html_e( 'All Properties By', 'framework' ); ?></span></h1>
		</div>
	</div>
</div><!-- End Page Head -->

<!-- Content -->
<div class="container contents listing-grid-layout">

	<div class="row">

		<div class="span9 main-wrap">

			<!-- Main Content -->
			<div class="main">

				<section class="listing-layout">

					<?php
					// Get Author Information.
					global $wp_query;
					$current_author      = $wp_query->get_queried_object();
					$current_author_meta = get_user_meta( $current_author->ID );

					// Display Author Name.
					if ( ! empty( $current_author->display_name ) ) {
						?><h3 class="title-heading"><?php echo esc_html( $current_author->display_name ); ?></h3><?php
					}
					?>

					<div class="list-container">

						<article class="about-agent agent-single clearfix">

							<div class="detail">

								<div class="row-fluid">

									<div class="span3">
										<?php
										// Author profile image.
										if ( isset( $current_author_meta['profile_image_id'] ) ) {
											$profile_image_id = intval( $current_author_meta['profile_image_id'][0] );
											if ( $profile_image_id ) {
												echo '<figure class="agent-pic">';
												echo wp_get_attachment_image( $profile_image_id, 'agent-image' );
												echo '</figure>';
											}
										} elseif ( function_exists( 'get_avatar' ) ) {
											echo '<figure class="agent-pic">';
											echo get_avatar( $current_author->user_email, '210' );
											echo '</figure>';
										}
										?>
									</div>

									<div class="span9">

										<div class="agent-content">
											<?php
											// Author description.
											if ( isset( $current_author_meta['description'] ) ) {
												echo '<p>';
												echo esc_html( $current_author_meta['description'][0] );
												echo '</p>';

											}
											?>
										</div>

										<?php

										// Author Contact Info.
										if ( isset( $current_author_meta['mobile_number'] ) || isset( $current_author_meta['office_number'] ) || isset( $current_author_meta['fax_number'] ) ) {
											?>
											<hr/>
											<h5><?php esc_html_e( 'Contact Details', 'framework' ); ?></h5>
											<ul class="contacts-list">
												<?php
												if ( ! empty( $current_author_meta['office_number'][0] ) ) {
													?>
													<li class="office">
														<?php
														include INSPIRY_THEME_DIR . '/images/icon-phone.svg';
														esc_html_e( 'Office', 'framework' );
													?>
													: <?php echo esc_html( $current_author_meta['office_number'][0] ); ?></li>
													<?php
												}

												if ( ! empty( $current_author_meta['mobile_number'][0] ) ) {
													?>
													<li class="mobile">
														<?php
														include INSPIRY_THEME_DIR . '/images/icon-mobile.svg';
														esc_html_e( 'Mobile', 'framework' );
														?>
													: <?php echo esc_html( $current_author_meta['mobile_number'][0] ); ?></li>
													<?php
												}

												if ( ! empty( $current_author_meta['fax_number'][0] ) ) {
													?>
													<li class="fax">
													<?php
													include INSPIRY_THEME_DIR . '/images/icon-printer.svg';
													esc_html_e( 'Fax', 'framework' );
													?>
													: <?php echo esc_html( $current_author_meta['fax_number'][0] ); ?></li><?php
												}
												?>
											</ul>
											<?php
										}

										// Agent contact form.
										get_template_part( 'assets/classic/partials/agent/single/contact-form' );
										?>

									</div>

								</div><!-- end of .row-fluid -->

							</div>

							<div class="follow-agent clearfix">
								<?php

								// Author social links.
								if ( isset( $current_author_meta['facebook_url'] ) || isset( $current_author_meta['twitter_url'] ) || isset( $current_author_meta['google_plus_url'] ) || isset( $current_author_meta['linkedin_url'] ) ) {
									?>
									<!-- Agent's Social Navigation -->
									<ul class="social_networks clearfix">
										<?php
										if ( ! empty( $current_author_meta['facebook_url'][0] ) ) {
											?>
											<li class="facebook">
												<a target="_blank" href="<?php echo esc_url( $current_author_meta['facebook_url'][0] ); ?>"><i class="fa fa-facebook fa-lg"></i></a>
											</li>
											<?php
										}

										if ( ! empty( $current_author_meta['twitter_url'][0] ) ) {
											?>
											<li class="twitter">
												<a target="_blank" href="<?php echo esc_url( $current_author_meta['twitter_url'][0] ); ?>"><i class="fa fa-twitter fa-lg"></i></a>
											</li>
											<?php
										}

										if ( ! empty( $current_author_meta['linkedin_url'][0] ) ) {
											?>
											<li class="linkedin">
												<a target="_blank" href="<?php echo esc_url( $current_author_meta['linkedin_url'][0] ); ?>"><i class="fa fa-linkedin fa-lg"></i></a>
											</li>
											<?php
										}

										if ( ! empty( $current_author_meta['google_plus_url'][0] ) ) {
											?>
											<li class="gplus">
												<a target="_blank" href="<?php echo esc_url( $current_author_meta['google_plus_url'][0] ); ?>"><i class="fa fa-google-plus fa-lg"></i></a>
											</li>
											<?php
										}
										?>
									</ul>
									<?php
								}
								?>
							</div>
						</article>

						<?php
						/**
						 * Properties related to author
						 */

						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();

								/* Display Property */
								get_template_part( 'assets/classic/partials/agent/single/property-card' );

							endwhile;
							wp_reset_postdata();
						else :
							alert( '', __( 'No Properties Found!', 'framework' ) );
						endif;
						?>

					</div>

					<?php theme_pagination( $wp_query->max_num_pages ); ?>

				</section>

			</div><!-- End Main Content -->

		</div> <!-- End span9 -->

		<?php get_sidebar( 'agent' ); ?>

	</div><!-- End contents row -->

</div><!-- End Content -->

<?php get_footer(); ?>
