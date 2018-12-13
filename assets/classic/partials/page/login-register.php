<?php
/**
 * Login & Register Template
 *
 * Page template for login & register.
 *
 * @since 2.7.0
 * @package RH/class
 */

get_header();

// Page Head.
get_template_part( 'assets/classic/partials/banners/default' ); ?>

<!-- Content -->
<div class="container contents single login-register">
	<div class="row">
		<div class="span12 main-wrap">

			<?php
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

				<div class="inner-wrapper">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();

							$content = get_the_content();
							if ( ! empty( $content ) ) {
								?>
								<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
									<?php the_content(); ?>
								</article>
								<?php
							}
						endwhile;
					endif;

					if ( ! is_user_logged_in() ) {
						?>
						<div class="forms-simple">

						<div class="row-fluid">

							<div class="span6">

								<!-- LOGIN -->
								<p class="info-text"><?php esc_html_e( 'Already a Member? Log in here.','framework' ); ?></p>
								<form id="login-form" class="login-form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" enctype="multipart/form-data">
									<div class="form-option">
										<label for="username"><?php esc_html_e( 'Username','framework' ); ?><span>*</span></label>
										<input id="username" name="log" type="text" class="required" title="<?php esc_html_e( '* Provide username!', 'framework' ); ?>" autofocus required/>
									</div>
									<div class="form-option">
										<label for="password"><?php esc_html_e( 'Password','framework' ); ?><span>*</span></label>
										<input id="password" name="pwd" type="password" class="required" title="<?php esc_html_e( '* Provide password!', 'framework' ); ?>" required/>
									</div>
									<?php
									if ( inspiry_is_reCAPTCHA_configured() ) {
										?>
										<div class="form-option">
											<?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ); ?>
										</div>
										<?php
									}

									// nonce for security.
									wp_nonce_field( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );
									?>
									<input type="hidden" name="action" value="inspiry_ajax_login" />
									<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url() ); ?>" />
									<input type="hidden" name="user-cookie" value="1" />
									<input type="submit" id="login-button" name="submit" value="<?php esc_attr_e( 'Log in', 'framework' ); ?>" class="real-btn login-btn" />
									<img id="login-loader" class="modal-loader" src="<?php echo esc_attr( INSPIRY_DIR_URI ); ?>/images/ajax-loader.gif" alt="Working...">
									<div>
										<div id="login-message" class="modal-message"></div>
										<div id="login-error" class="modal-error"></div>
									</div>
								</form>


								<div class="inspiry-social-login">
									<?php
									/**
									 * For social login
									 */
									do_action( 'wordpress_social_login' );
									?>
								</div>

								<!-- FORGOT PASSWORD -->
								<p class="forgot-password">
									<a class="toggle-forgot-form" href="#"><?php esc_html_e( 'Forgot password!','framework' ); ?></a>
								</p>

								<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="forgot-form"  method="post" enctype="multipart/form-data">
									<div class="form-option">
										<label for="reset_username_or_email"><?php esc_html_e( 'Username or Email','framework' ); ?><span>*</span></label>
										<input id="reset_username_or_email" name="reset_username_or_email" type="text" class="required" title="<?php esc_html_e( '* Provide username or email!', 'framework' ); ?>" required/>
									</div>
									<?php
									if ( inspiry_is_reCAPTCHA_configured() ) {
										?>
										<div class="form-option">
											<?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ); ?>
										</div>
										<?php
									}
									?>
									<input type="hidden" name="action" value="inspiry_ajax_forgot" />
									<input type="hidden" name="user-cookie" value="1" />
									<input type="submit"  id="forgot-button" name="user-submit" value="<?php esc_html_e( 'Reset Password', 'framework' ); ?>" class="real-btn register-btn" />
									<img id="forgot-loader" class="modal-loader" src="<?php echo esc_attr( INSPIRY_DIR_URI ); ?>/images/ajax-loader.gif" alt="Working...">
									<?php wp_nonce_field( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' ); ?>
									<div>
										<div id="forgot-message" class="modal-message"></div>
										<div id="forgot-error" class="modal-error"></div>
									</div>
								</form>

							</div>

							<div class="span6">
								<?php
								if ( get_option( 'users_can_register' ) ) {
									?>
									<p class="info-text"><?php esc_html_e( 'Do not have an account? Register here','framework' ); ?></p>
									<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="register-form"  method="post" enctype="multipart/form-data">

										<div class="form-option">
											<label for="register_username" class="hide"><?php esc_html_e( 'Username','framework' ); ?><span>*</span></label>
											<input id="register_username" name="register_username" type="text" class="required"
												   title="<?php esc_html_e( '* Provide username!', 'framework' ); ?>"
												   placeholder="<?php esc_html_e( 'Username', 'framework' ); ?>" required/>
										</div>

										<div class="form-option">
											<label for="register_email" class="hide"><?php esc_html_e( 'Email','framework' ); ?><span>*</span></label>
											<input id="register_email" name="register_email" type="text" class="email required"
												   title="<?php esc_html_e( '* Provide valid email address!', 'framework' ); ?>"
												   placeholder="<?php esc_html_e( 'Email', 'framework' ); ?>" required/>
										</div>
										<?php
										if ( inspiry_is_reCAPTCHA_configured() ) {
											?>
											<div class="form-option">
												<?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ); ?>
											</div>
											<?php
										}
										?>
										<input type="hidden" name="user-cookie" value="1" />
										<input type="submit" id="register-button" name="user-submit" value="<?php esc_html_e( 'Register','framework' ); ?>" class="real-btn register-btn" />
										<img id="register-loader" class="modal-loader" src="<?php echo esc_attr( INSPIRY_DIR_URI ); ?>/images/ajax-loader.gif" alt="Working...">
										<input type="hidden" name="action" value="inspiry_ajax_register" />
										<?php
										// Nonce for security.
										wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );
										?>
										<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />

										<div>
											<div id="register-message" class="modal-message"></div>
											<div id="register-error" class="modal-error"></div>
										</div>
									</form>
									<?php
								}
								?>
							</div><!-- end of .span6 -->

						</div><!-- end of .row-fluid -->

						</div><!-- end of .forms-simple -->
						<?php
					} else {
						echo '<h5>';
						esc_html_e( 'You are already logged in!', 'framework' );
						echo '</h5>';
						echo '<br>';
					}
					?>
				</div>

			</div><!-- End Main Content -->

		</div> <!-- End span12 -->

	</div><!-- End contents row -->

</div><!-- End Content -->

<?php get_footer(); ?>
