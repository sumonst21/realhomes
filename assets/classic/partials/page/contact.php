<?php
/**
 * Displays contact page template's stuff.
 *
 * @package realhomes
 */

get_header();

get_template_part( 'assets/classic/partials/banners/default' ); ?>

<!-- Content -->
<div class="container contents contact-page">
<div class="row">
	<div class="span9 main-wrap">
		<!-- Main Content -->
		<div class="main">

			<div class="inner-wrapper">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();

							$page_content = get_the_content();
							if ( ! empty( $page_content ) ) {
								?>
								<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
									<?php the_content(); ?>
								</article>
								<?php
							}
						endwhile;
					endif;

					$show_contact_map = get_option( 'theme_show_contact_map' );
					if ( 'true' === $show_contact_map ) {
						?>
						<div class="map-container clearfix">
							<?php get_template_part( 'assets/classic/partials/page/contact/map' ); ?>
						</div>
						<?php
					}

					$show_details = get_option( 'theme_show_details' );
					if ( 'true' === $show_details ) {
						$contact_details_title = get_option( 'theme_contact_details_title' );
						$contact_address       = stripslashes( get_option( 'theme_contact_address' ) );
						$contact_cell          = get_option( 'theme_contact_cell' );
						$contact_phone         = get_option( 'theme_contact_phone' );
						$contact_fax           = get_option( 'theme_contact_fax' );
						$contact_display_email = get_option( 'theme_contact_display_email' );
						?>
						<section class="contact-details clearfix">
							<?php
								if ( ! empty( $contact_details_title ) ) {
									?>
									<h3><?php echo esc_html( $contact_details_title ); ?></h3>
									<?php
								}
							?>

							<ul class="contacts-list">
								<?php
									if ( ! empty( $contact_phone ) ) {
										$desktop_version = '<span class="desktop-version">' . $contact_phone . '</span>';
										$mobile_version  = '<a class="mobile-version" href="tel://' . $contact_phone . '" title="Make a Call">' . $contact_phone . '</a>';

										?>
										<li class="phone">
											<?php
												include INSPIRY_THEME_DIR . '/images/icon-phone.svg';
												esc_html_e( 'Phone', 'framework' );
											?>
											: <?php echo $desktop_version . $mobile_version; ?>
										</li>
										<?php
									}

									if ( ! empty( $contact_cell ) ) {
										$desktop_version = '<span class="desktop-version">' . $contact_cell . '</span>';
										$mobile_version  = '<a class="mobile-version" href="tel://' . $contact_cell . '" title="Make a Call">' . $contact_cell . '</a>';

										?>
										<li class="mobile">
											<?php
												include INSPIRY_THEME_DIR . '/images/icon-mobile.svg';
												esc_html_e( 'Mobile', 'framework' );
											?>
											: <?php echo $desktop_version . $mobile_version; ?>
										</li>
										<?php
									}

									if ( ! empty( $contact_fax ) ) {
										?>
										<li class="fax">
											<?php
												include INSPIRY_THEME_DIR . '/images/icon-printer.svg';
												esc_html_e( 'Fax', 'framework' );
											?>
											: <?php echo esc_html( $contact_fax ); ?>
										</li>
										<?php
									}

									if ( ! empty( $contact_display_email ) ) {
										?>
										<li class="email">
											<?php
												include INSPIRY_THEME_DIR . '/images/icon-mail.svg';
												esc_html_e( 'Email', 'framework' );
											?>
											:
											<a href="mailto:<?php echo antispambot( $contact_display_email ); ?>"><?php echo antispambot( $contact_display_email ); ?></a>
										</li>
										<?php
									}

									if ( ! empty( $contact_address ) ) {
										?>
										<li class="address">
											<?php
												include INSPIRY_THEME_DIR . '/images/icon-map.svg';
												esc_html_e( 'Address', 'framework' );
											?>
											: <?php echo esc_html( $contact_address ); ?>
										</li>
										<?php
									}
								?>
							</ul>

						</section>
						<?php
					}


					/**
					 * Contact Form
					 */
					$inspiry_contact_form_shortcode = get_option( 'inspiry_contact_form_shortcode' );

					if ( ! empty( $inspiry_contact_form_shortcode ) ) {

						/* Contact Form Shortcode */
						echo do_shortcode( $inspiry_contact_form_shortcode );

					} else {

						// Default Contact Form.
						$theme_contact_email  = get_option( 'theme_contact_email' );
						$contact_form_heading = get_option( 'theme_contact_form_heading' );

						if ( ! empty( $theme_contact_email ) ) {
							?>
							<section id="contact-form">
								<?php
									if ( ! empty( $contact_form_heading ) ) {
										?>
										<h3 class="form-heading"><?php echo esc_html( $contact_form_heading ); ?></h3>
										<?php
									}
								?>

								<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
									<p>
										<label for="name"><?php esc_html_e( 'Name', 'framework' ); ?></label>
										<input type="text" name="name" id="name" class="required" title="<?php esc_attr_e( '* Please provide your name', 'framework' ); ?>">
									</p>

									<p>
										<label for="email"><?php esc_html_e( 'Email', 'framework' ); ?></label>
										<input type="text" name="email" id="email" class="email required" title="<?php esc_attr_e( '* Please provide a valid email address', 'framework' ); ?>">
									</p>

									<p>
										<label for="number"><?php esc_html_e( 'Phone Number', 'framework' ); ?></label>
										<input type="text" name="number" id="number">
									</p>

									<p>
										<label for="comment"><?php esc_html_e( 'Message', 'framework' ); ?></label>
										<textarea name="message" id="comment" class="required" title="<?php esc_attr_e( '* Please provide your message', 'framework' ); ?>"></textarea>
									</p>

									<?php

										$is_gdpr_enabled = inspiry_is_gdpr_enabled();

										if ( $is_gdpr_enabled ) {

											$gdpr_agreement_text = inspiry_gdpr_agreement_content();

											if ( ! empty( $gdpr_agreement_text ) ) {
												?>
												<p class="gdpr-agreement clearfix">
													<?php

														$gdpr_agreement_label   = inspiry_gdpr_agreement_content( 'label' );
														$gdpr_agreement_val_msg = inspiry_gdpr_agreement_content( 'validation-message' );

														if ( ! empty( $gdpr_agreement_label ) ) {
															?>
															<span class="gdpr-checkbox-label"><?php echo esc_html( $gdpr_agreement_label ); ?>
																<span class="required-label">*</span></span>
															<?php
														}

													?>
													<input type="checkbox" id="inspiry-gdpr" class="required" name="gdpr" title="<?php echo esc_attr( $gdpr_agreement_val_msg ); ?>" value="<?php echo strip_tags( $gdpr_agreement_text ); ?>">
													<label for="inspiry-gdpr"><?php echo $gdpr_agreement_text; ?></label>
												</p>
												<?php
											}
										}
									?>

									<p>
										<?php
											/* Display reCAPTCHA if enabled and configured from customizer settings */
											get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' );
										?>
									</p>

									<p>
										<input type="submit" id="submit-button" value="<?php esc_attr_e( 'Send Message', 'framework' ); ?>" class="real-btn" name="submit">
										<img src="<?php echo esc_attr( INSPIRY_DIR_URI ); ?>/images/ajax-loader.gif" id="ajax-loader" alt="Loading...">
										<input type="hidden" name="action" value="send_message"/>
										<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'send_message_nonce' ) ); ?>"/>
									</p>

									<div id="error-container"></div>
									<div id="message-container"></div>
								</form>
							</section>
							<?php
						}
					}
				?>

			</div>

		</div><!-- End Main Content -->
	</div><!-- End span9 -->

	<?php get_sidebar( 'contact' ); ?>

</div><!-- End contents row -->
</div><!-- End Content -->

<?php get_footer(); ?>
