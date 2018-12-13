<?php
/**
 * Displays contact template related stuff.
 *
 * @package realhomes
 */

get_header();

$header_variation = get_option( 'inspiry_contact_header_variation' );

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

		<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
			<div class="rh_page__head">

				<h2 class="rh_page__title">
					<?php
						// Page Title.
						$page_title = get_post_meta( get_the_ID(), 'REAL_HOMES_banner_title', true );
						if ( empty( $page_title ) ) {
							$page_title = get_the_title( get_the_ID() );
						}

						if ( ! empty( $page_title ) ) {
							?>
							<p class="title"><?php echo esc_html( $page_title ); ?></p>
							<?php
						}
					?>
				</h2>
				<!-- /.rh_page__title -->

			</div>				<!-- /.rh_page__head -->
		<?php endif; ?>

		<div class="rh_page__contact">

			<?php if ( have_posts() ) : ?>

				<div class="rh_blog rh_blog__single">

					<?php while ( have_posts() ) : ?><?php the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'rh_blog__post' ); ?> >

							<div class="rh_content entry-content">
								<?php the_content(); ?>
							</div>

						</article>

					<?php endwhile; ?>

				</div>
			<?php endif; ?>

			<div class="rh_contact">

				<div class="rh_contact__wrap">

					<div class="rh_contact__form">
						<?php
							/**
							 * Contact Form
							 */
							$inspiry_contact_form_shortcode = get_option( 'inspiry_contact_form_shortcode' );

							if ( ! empty( $inspiry_contact_form_shortcode ) ) {

								/* Contact Form Shortcode */
								echo do_shortcode( $inspiry_contact_form_shortcode );

							} else {

								// Default Contact Form.
								$theme_contact_email = get_option( 'theme_contact_email' );

								if ( ! empty( $theme_contact_email ) ) {
									?>
									<section id="contact-form">
										<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
											<p class="rh_contact__input rh_contact__input_text">
												<label for="name"><?php esc_html_e( 'Name', 'framework' ); ?></label>
												<input type="text" name="name" id="name" class="required" placeholder="<?php esc_attr_e( 'Your Name', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide your name', 'framework' ); ?>">
											</p>

											<p class="rh_contact__input rh_contact__input_text">
												<label for="email"><?php esc_html_e( 'Email', 'framework' ); ?></label>
												<input type="text" name="email" id="email" class="email required" placeholder="<?php esc_attr_e( 'Your Email', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide a valid email address', 'framework' ); ?>">
											</p>

											<p class="rh_contact__input rh_contact__input_text">
												<label for="number"><?php esc_html_e( 'Phone', 'framework' ); ?></label>
												<input type="text" name="number" id="number" placeholder="<?php esc_attr_e( 'Your Phone', 'framework' ); ?>">
											</p>

											<p class="rh_contact__input rh_contact__input_textarea">
												<label for="comment"><?php esc_html_e( 'Message', 'framework' ); ?></label>
												<textarea cols="40" rows="6" name="message" id="comment" class="required" placeholder="<?php esc_attr_e( 'Your Message', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide your message', 'framework' ); ?>"></textarea>
											</p>
											<?php

												$is_gdpr_enabled = inspiry_is_gdpr_enabled();

												if ( $is_gdpr_enabled ) {

													$gdpr_agreement_text = inspiry_gdpr_agreement_content();

													if ( ! empty( $gdpr_agreement_text ) ) {
														?>
														<p id="rh_inspiry_gdpr" class="rh_contact__input clearfix">
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

												/* Display reCAPTCHA if enabled and configured from customizer settings */
												if ( inspiry_is_reCAPTCHA_configured() ) {
													?>
													<div class="rh_contact__input rh_contact__input_recaptcha inspiry-recaptcha-wrapper clearfix">
														<div class="inspiry-google-recaptcha"></div>
													</div>
													<?php
												}
											?>

											<p class="rh_contact__input rh_contact__submit">
												<input type="submit" id="submit-button" value="<?php esc_attr_e( 'Send Message', 'framework' ); ?>" class="rh_btn rh_btn--primary" name="submit">
												<span id="ajax-loader"><?php include INSPIRY_THEME_DIR . '/images/loader.svg'; ?></span>
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
					<!-- /.rh_contact__form -->

					<?php
						$show_details = get_option( 'theme_show_details' );
						if ( 'true' === $show_details ) {
							$contact_address       = stripslashes( get_option( 'theme_contact_address' ) );
							$contact_cell          = get_option( 'theme_contact_cell' );
							$contact_phone         = get_option( 'theme_contact_phone' );
							$contact_fax           = get_option( 'theme_contact_fax' );
							$contact_display_email = get_option( 'theme_contact_display_email' );
							?>

							<div class="rh_contact__details">

								<?php if ( ! empty( $contact_phone ) ) : ?>
									<div class="rh_contact__item">
										<p class="icon"><?php include INSPIRY_THEME_DIR . '/images/icons/icon-phone.svg'; ?></p>
										<p class="content">
											<span class="label"><?php esc_html_e( 'Phone', 'framework' ); ?></span>
											<?php echo esc_html( $contact_phone ); ?>
										</p>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $contact_cell ) ) : ?>
									<div class="rh_contact__item">
										<p class="icon"><?php include INSPIRY_THEME_DIR . '/images/icons/icon-mobile.svg'; ?></p>
										<p class="content">
											<span class="label"><?php esc_html_e( 'Mobile', 'framework' ); ?></span>
											<?php echo esc_html( $contact_cell ); ?>
										</p>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $contact_fax ) ) : ?>
									<div class="rh_contact__item">
										<p class="icon"><?php include INSPIRY_THEME_DIR . '/images/icons/icon-fax.svg'; ?></p>
										<p class="content">
											<span class="label"><?php esc_html_e( 'Fax', 'framework' ); ?></span>
											<?php echo esc_html( $contact_fax ); ?>
										</p>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $contact_display_email ) ) : ?>
									<div class="rh_contact__item">
										<p class="icon"><?php include INSPIRY_THEME_DIR . '/images/icons/icon-mail.svg'; ?></p>
										<p class="content">
											<span class="label"><?php esc_html_e( 'Email', 'framework' ); ?></span>
											<a href="mailto:<?php echo esc_attr( antispambot( $contact_display_email ) ); ?>">
												<?php echo esc_html( antispambot( $contact_display_email ) ); ?>
											</a>
										</p>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $contact_address ) ) : ?>
									<div class="rh_contact__item">
										<p class="icon"><?php include INSPIRY_THEME_DIR . '/images/icons/icon-marker.svg'; ?></p>
										<p class="content">
											<span class="label"><?php esc_html_e( 'Address', 'framework' ); ?></span>
											<?php echo esc_html( $contact_address ); ?>
										</p>
									</div>
								<?php endif; ?>

							</div>							<!-- /.rh_contact__details -->
							<?php
						}
					?>

					<div class="rh_contact__map">

						<div id="map_canvas"></div>

						<?php
							$map_lati  = get_option( 'theme_map_lati' );
							$map_longi = get_option( 'theme_map_longi' );
							$map_zoom  = get_option( 'theme_map_zoom' );

							$contact_address = stripslashes( get_option( 'theme_contact_address' ) );
							$contact_cell    = get_option( 'theme_contact_cell' );
							$contact_phone   = get_option( 'theme_contact_phone' );
						?>

						<script type="text/javascript">
							// Google Map.
							function initializeContactMap() {
								var officeLocation = new google.maps.LatLng(<?php echo esc_attr( $map_lati ); ?>, <?php echo esc_attr( $map_longi ); ?>);
								var contactMapOptions = {
									center: officeLocation,
									zoom: <?php echo esc_attr( $map_zoom ); ?>,
									mapTypeId: google.maps.MapTypeId.ROADMAP,
									scrollwheel: false,
									styles: [{
										"featureType": "administrative",
										"elementType": "labels.text",
										"stylers": [{
											"color": "#000000"
										}]
									}, {
										"featureType": "administrative",
										"elementType": "labels.text.fill",
										"stylers": [{
											"color": "#444444"
										}]
									}, {
										"featureType": "administrative",
										"elementType": "labels.text.stroke",
										"stylers": [{
											"visibility": "off"
										}]
									}, {
										"featureType": "administrative",
										"elementType": "labels.icon",
										"stylers": [{
											"visibility": "on"
										}, {
											"color": "#380d0d"
										}]
									}, {
										"featureType": "landscape", "elementType": "all", "stylers": [{
											"color": "#f2f2f2"
										}]
									}, {
										"featureType": "poi", "elementType": "all", "stylers": [{
											"visibility": "off"
										}]
									}, {
										"featureType": "road", "elementType": "all", "stylers": [{
											"saturation": -100
										}, {
											"lightness": 45
										}]
									}, {
										"featureType": "road", "elementType": "geometry", "stylers": [{
											"visibility": "on"
										}, {
											"color": "#dedddb"
										}]
									}, {
										"featureType": "road", "elementType": "labels.text", "stylers": [{
											"color": "#000000"
										}]
									}, {
										"featureType": "road", "elementType": "labels.text.fill", "stylers": [{
											"color": "#1f1b1b"
										}]
									}, {
										"featureType": "road", "elementType": "labels.text.stroke", "stylers": [{
											"visibility": "off"
										}]
									}, {
										"featureType": "road", "elementType": "labels.icon", "stylers": [{
											"visibility": "on"
										}, {
											"hue": "#ff0000"
										}]
									}, {
										"featureType": "road.highway", "elementType": "all", "stylers": [{
											"visibility": "simplified"
										}]
									}, {
										"featureType": "road.arterial",
										"elementType": "labels.icon",
										"stylers": [{
											"visibility": "off"
										}]
									}, {
										"featureType": "transit", "elementType": "all", "stylers": [{
											"visibility": "off"
										}]
									}, {
										"featureType": "water", "elementType": "all", "stylers": [{
											"color": "#c1c9cc"
										}, {
											"visibility": "on"
										}]
									}]
								};
								var contactMap = new google.maps.Map(document.getElementById("map_canvas"), contactMapOptions);
								var contactMarker = new google.maps.Marker({
									position: officeLocation,
									map: contactMap,
									icon: '<?php echo esc_url( INSPIRY_DIR_URI ); ?>/images/map-marker.png',
								});
							}

							window.onload = initializeContactMap();
						</script>

					</div>
					<!-- /.rh_contact__map -->

				</div>
				<!-- /.rh_contact__wrap -->

			</div>
			<!-- /.rh_contact -->

		</div>
		<!-- /.rh_page__contact -->

	</div>
	<!-- /.rh_page -->


</section>	<!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php
get_footer();
