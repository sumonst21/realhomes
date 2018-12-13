<?php
/**
 * Single Agency
 *
 * Single agency template part.
 *
 * @since    3.5.0
 * @package  RH/classic
 */

get_header(); ?>

<!-- Page Head -->
<?php get_template_part( 'assets/classic/partials/banners/default' ); ?>

<!-- Content -->
<div class="container contents listing-grid-layout">

	<div class="row">

		<div class="span9 main-wrap">

			<!-- Main Content -->
			<div class="main">

				<section class="listing-layout">
					<h3 class="title-heading"><?php the_title(); ?></h3>

					<div class="list-container">
						<?php

							if ( have_posts() ) :
								while ( have_posts() ) :
									the_post();
									?>
									<article class="about-agent agent-single clearfix">

										<div class="detail">

											<div class="row-fluid">

												<div class="span3">
													<?php
														if ( has_post_thumbnail() ) {
															?>
															<figure class="agent-pic">
																<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
																	<?php the_post_thumbnail( 'agent-image' ); ?>
																</a>
															</figure>
															<?php
														}
													?>
												</div>

												<div class="span9">

													<div class="agent-content">
														<?php the_content(); ?>
													</div>

													<?php
														/* Agent Contact Info */
														$agent_mobile       = get_post_meta( get_the_ID(), 'REAL_HOMES_mobile_number', true );
														$agent_whatsapp     = get_post_meta( get_the_ID(), 'REAL_HOMES_whatsapp_number', true );
														$agent_office_phone = get_post_meta( get_the_ID(), 'REAL_HOMES_office_number', true );
														$agent_office_fax   = get_post_meta( get_the_ID(), 'REAL_HOMES_fax_number', true );

														if ( ! empty( $agent_office_phone ) || ! empty( $agent_mobile ) || ! empty( $agent_office_fax ) ) {
															?>
															<hr/>
															<h5><?php esc_html_e( 'Contact Details', 'framework' ); ?></h5>
															<ul class="contacts-list">
																<?php
																	if ( ! empty( $agent_office_phone ) ) {
																		?>
																		<li class="office">
																			<?php
																				include INSPIRY_THEME_DIR . '/images/icon-phone.svg';
																				esc_html_e( 'Office', 'framework' );
																			?>
																			: <?php echo esc_html( $agent_office_phone ); ?>
																		</li>
																		<?php
																	}
																	if ( ! empty( $agent_mobile ) ) {
																		?>
																		<li class="mobile">
																			<?php
																				include INSPIRY_THEME_DIR . '/images/icon-mobile.svg';
																				esc_html_e( 'Mobile', 'framework' );
																			?>
																			: <?php echo esc_html( $agent_mobile ); ?>
																		</li>
																		<?php
																	}
																	if ( ! empty( $agent_office_fax ) ) {
																		?>
																		<li class="fax">
																			<?php
																				include INSPIRY_THEME_DIR . '/images/icon-printer.svg';
																				esc_html_e( 'Fax', 'framework' );
																			?>
																			: <?php echo esc_html( $agent_office_fax ); ?>
																		</li>
																		<?php
																	}
																	if ( ! empty( $agent_whatsapp ) ) {
																		?>
																		<li class="whatsapp">
																			<?php
																				include INSPIRY_THEME_DIR . '/images/icon-whatsapp.svg';
																				esc_html_e( 'WhatsApp', 'framework' );
																			?>
																			: <?php echo esc_html( $agent_whatsapp ); ?>
																		</li>
																		<?php
																	}
																?>
															</ul>
															<?php
														}

														// Agent contact form.
														get_template_part( 'assets/classic/partials/agency/single/contact-form' );
													?>

												</div>

											</div><!-- end of .row-fluid -->

										</div>

										<div class="follow-agent clearfix">
											<?php
												$facebook_url    = get_post_meta( get_the_ID(), 'REAL_HOMES_facebook_url', true );
												$twitter_url     = get_post_meta( get_the_ID(), 'REAL_HOMES_twitter_url', true );
												$google_plus_url = get_post_meta( get_the_ID(), 'REAL_HOMES_google_plus_url', true );
												$linked_in_url   = get_post_meta( get_the_ID(), 'REAL_HOMES_linked_in_url', true );
												$instagram_url   = get_post_meta( get_the_ID(), 'inspiry_instagram_url', true );

												if ( ! empty( $facebook_url ) || ! empty( $twitter_url ) || ! empty( $google_plus_url ) || ! empty( $linked_in_url ) || ! empty( $instagram_url ) ) {
													?>
													<!-- Agent's Social Navigation -->
													<ul class="social_networks clearfix">
														<?php
															if ( ! empty( $facebook_url ) ) {
																?>
																<li class="facebook">
																	<a target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fa fa-facebook fa-lg"></i></a>
																</li>
																<?php
															}

															if ( ! empty( $twitter_url ) ) {
																?>
																<li class="twitter">
																	<a target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><i class="fa fa-twitter fa-lg"></i></a>
																</li>
																<?php
															}

															if ( ! empty( $linked_in_url ) ) {
																?>
																<li class="linkedin">
																	<a target="_blank" href="<?php echo esc_url( $linked_in_url ); ?>"><i class="fa fa-linkedin fa-lg"></i></a>
																</li>
																<?php
															}

															if ( ! empty( $google_plus_url ) ) {
																?>
																<li class="gplus">
																	<a target="_blank" href="<?php echo esc_url( $google_plus_url ); ?>"><i class="fa fa-google-plus fa-lg"></i></a>
																</li>
																<?php
															}

															if ( ! empty( $instagram_url ) ) {
																?>
																<li class="instagram">
																	<a target="_blank" href="<?php echo esc_url( $instagram_url ); ?>"><i class="fa fa-instagram fa-lg"></i></a>
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
								endwhile;
							endif;

							$number_of_posts = intval( get_option( 'inspiry_number_of_agents_agency', 3 ) );

							global $paged;

							$agents_query = array(
								'post_type'      => 'agent',
								'posts_per_page' => $number_of_posts,
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

							if ( $agent_listing_query->have_posts() ) :

								echo '<h4>' . esc_html__( 'Our Agents:', 'framework' ) . '</h4>';

								while ( $agent_listing_query->have_posts() ) :
									$agent_listing_query->the_post();
									?>
									<article class="about-agent clearfix">
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

										<div class="row-fluid">

											<div class="span3">
												<?php
													if ( has_post_thumbnail() ) {
														?>
														<figure class="agent-pic">
															<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
																<?php the_post_thumbnail( 'agent-image' ); ?>
															</a>
														</figure>
														<?php
													}
												?>
											</div>

											<div class="span9">

												<div class="agent-content">
													<p><?php framework_excerpt( 45 ); ?></p>
												</div>

												<?php
													/* Agent Contact Info */
													$agent_mobile       = get_post_meta( get_the_ID(), 'REAL_HOMES_mobile_number', true );
													$agent_whatsapp     = get_post_meta( get_the_ID(), 'REAL_HOMES_whatsapp_number', true );
													$agent_office_phone = get_post_meta( get_the_ID(), 'REAL_HOMES_office_number', true );
													$agent_office_fax   = get_post_meta( get_the_ID(), 'REAL_HOMES_fax_number', true );

													if ( ! empty( $agent_office_phone ) || ! empty( $agent_mobile ) || ! empty( $agent_office_fax ) ) {
														?>
														<ul class="contacts-list">
															<?php
																if ( ! empty( $agent_office_phone ) ) {
																	?>
																	<li class="office"><?php include( INSPIRY_THEME_DIR . '/images/icon-phone.svg' );
																	esc_html_e( 'Office', 'framework' ); ?> : <?php echo esc_html( $agent_office_phone ); ?></li><?php
																}
																if ( ! empty( $agent_mobile ) ) {
																	?>
																	<li class="mobile"><?php include( INSPIRY_THEME_DIR . '/images/icon-mobile.svg' );
																	esc_html_e( 'Mobile', 'framework' ); ?> : <?php echo esc_html( $agent_mobile ); ?></li><?php
																}
																if ( ! empty( $agent_office_fax ) ) {
																	?>
																	<li class="fax"><?php include( INSPIRY_THEME_DIR . '/images/icon-printer.svg' );
																	esc_html_e( 'Fax', 'framework' ); ?>  : <?php echo esc_html( $agent_office_fax ); ?></li><?php
																}
																if ( ! empty( $agent_whatsapp ) ) {
																	?>
																	<li class="fax"><?php include( INSPIRY_THEME_DIR . '/images/icon-whatsapp.svg' );
																	esc_html_e( 'WhatsApp', 'framework' ); ?>  : <?php echo esc_html( $agent_whatsapp ); ?></li><?php
																}
															?>
														</ul>
														<?php
													}
												?>

											</div>

										</div><!-- end of .row-fluid -->

										<div class="follow-agent clearfix">
											<a class="real-btn btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More Details', 'framework' ); ?></a>
											<?php

												$facebook_url    = get_post_meta( get_the_ID(), 'REAL_HOMES_facebook_url', true );
												$twitter_url     = get_post_meta( get_the_ID(), 'REAL_HOMES_twitter_url', true );
												$google_plus_url = get_post_meta( get_the_ID(), 'REAL_HOMES_google_plus_url', true );
												$linked_in_url   = get_post_meta( get_the_ID(), 'REAL_HOMES_linked_in_url', true );
												$instagram_url   = get_post_meta( get_the_ID(), 'inspiry_instagram_url', true );

												if ( ! empty( $facebook_url ) || ! empty( $twitter_url ) || ! empty( $google_plus_url ) || ! empty( $linked_in_url ) || ! empty( $instagram_url ) ) {
													?>
													<!-- Agent's Social Navigation -->
													<ul class="social_networks clearfix">
														<?php
															if ( ! empty( $facebook_url ) ) {
																?>
																<li class="facebook">
																	<a target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fa fa-facebook fa-lg"></i></a>
																</li>
																<?php
															}

															if ( ! empty( $twitter_url ) ) {
																?>
																<li class="twitter">
																	<a target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><i class="fa fa-twitter fa-lg"></i></a>
																</li>
																<?php
															}

															if ( ! empty( $linked_in_url ) ) {
																?>
																<li class="linkedin">
																	<a target="_blank" href="<?php echo esc_url( $linked_in_url ); ?>"><i class="fa fa-linkedin fa-lg"></i></a>
																</li>
																<?php
															}

															if ( ! empty( $google_plus_url ) ) {
																?>
																<li class="gplus">
																	<a target="_blank" href="<?php echo esc_url( $google_plus_url ); ?>"><i class="fa fa-google-plus fa-lg"></i></a>
																</li>
																<?php
															}

															if ( ! empty( $instagram_url ) ) {
																?>
																<li class="instagram">
																	<a target="_blank" href="<?php echo esc_url( $instagram_url ); ?>"><i class="fa fa-instagram fa-lg"></i></a>
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
								endwhile;
								wp_reset_postdata();
							endif;
						?>
					</div>
					<?php theme_pagination( $agent_listing_query->max_num_pages ); ?>
				</section>

			</div><!-- End Main Content -->

		</div> <!-- End span9 -->

		<?php get_sidebar( 'agency' ); ?>

	</div><!-- End contents row -->

</div><!-- End Content -->

<?php get_footer(); ?>