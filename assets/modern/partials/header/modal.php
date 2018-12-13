<?php
/**
 * Header Modal
 *
 * Header modal for login in the header.
 *
 * @package realhomes
 * @subpackage modern
 */

?>

<div class="rh_modal">

	<div class="rh_modal__corner"></div>
	<!-- /.rh_modal__corner -->

	<div class="rh_modal__wrap">

		<?php if ( ! is_user_logged_in() ) : ?>

			<div class="rh_modal__login_wrap modal">

				<h3><?php esc_html_e( 'Login', 'framework' ); ?></h3>

				<form id="rh_modal__login_form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="POST" enctype="multipart/form-data">
					<input name="log" class="focus-class" id="username" type="text" placeholder="<?php esc_attr_e( 'Username', 'framework' ); ?>" title="<?php esc_attr_e( '* Provide user name!', 'framework' ); ?>" required autofocus />
					<input name="pwd" id="password" type="password" placeholder="<?php esc_attr_e( 'Password', 'framework' ); ?>" title="<?php esc_attr_e( '* Provide password!', 'framework' ); ?>" required />
					<?php
					if ( inspiry_is_reCAPTCHA_configured()
						&& ! is_page_template( 'templates/contact.php' ) ) {
						?>
						<div class="rh_modal__recaptcha">
							<div class="inspiry-recaptcha-wrapper clearfix">
								<div class="inspiry-google-recaptcha"
									 style="transform:scale(0.697);-webkit-transform:scale(0.697);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</div>
						</div>
						<?php
					} elseif ( inspiry_is_reCAPTCHA_configured()
						&& empty( get_option( 'inspiry_contact_form_shortcode' ) ) ) {
						?>
						<div class="rh_modal__recaptcha">
							<div class="inspiry-recaptcha-wrapper clearfix">
								<div class="inspiry-google-recaptcha"
									 style="transform:scale(0.697);-webkit-transform:scale(0.697);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</div>
						</div>
						<?php
					}
					?>
					<input type="hidden" name="action" value="inspiry_ajax_login" />
					<?php
					wp_nonce_field( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );
					if ( is_page() || is_single() ) {
						?>
						<input type="hidden" name="redirect_to" value="
						<?php
						wp_reset_postdata();
						global $post;
						the_permalink( get_the_ID() );
						?>
						" />
						<?php
					} else {
						?>
						<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url() ); ?>" />
						<?php
					}
					?>
					<button id="login-button" type="submit"><?php esc_html_e( 'Login', 'framework' ); ?></button>
				</form>

				<div class="inspiry-social-login">
					<?php
						/*
						 * For social login
						 */
						do_action( 'wordpress_social_login' );
					?>
				</div>

				<div>
					<p id="login-message" class="rh_modal__msg"></p>
					<p id="login-error" class="rh_modal__msg"></p>
				</div>

				<div class="switch">
					<a href="#" data-switch="forgot" class="rh-forgot-password"><?php esc_html_e( 'Forgot Password', 'framework' ); ?></a>
					<?php if ( get_option( 'users_can_register' ) ) : ?>
						<br />
						<a href="#" data-switch="register" class="rh-register"><?php esc_html_e( 'New User? Register Now', 'framework' ); ?></a>
					<?php endif; ?>
				</div>
				<!-- /.switch -->

			</div>
			<!-- /.rh_modal__login_wrap -->

			<?php if ( get_option( 'users_can_register' ) ) : ?>

				<div class="rh_modal__register_wrap modal">

					<h3><?php esc_html_e( 'Register', 'framework' ); ?></h3>

					<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="rh_modal__register_form"  method="post" enctype="multipart/form-data">
						<input id="register_username" name="register_username" type="text" placeholder="<?php esc_attr_e( 'Username', 'framework' ); ?>" title="<?php esc_attr_e( '* Provide user name!', 'framework' ); ?>" required />
						<input id="register_email" name="register_email" type="text" placeholder="<?php esc_attr_e( 'Email', 'framework' ); ?>" title="<?php esc_attr_e( '* Provide valid email address!', 'framework' ); ?>" required />
						<?php
						if ( inspiry_is_reCAPTCHA_configured()
							&& ! is_page_template( 'templates/contact.php' ) ) {
							?>
							<div class="rh_modal__recaptcha">
								<div class="inspiry-recaptcha-wrapper clearfix">
									<div class="inspiry-google-recaptcha"
										 style="transform:scale(0.697);-webkit-transform:scale(0.697);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
								</div>
							</div>
							<?php
						} elseif ( inspiry_is_reCAPTCHA_configured()
							&& empty( get_option( 'inspiry_contact_form_shortcode' ) ) ) {
							?>
							<div class="rh_modal__recaptcha">
								<div class="inspiry-recaptcha-wrapper clearfix">
									<div class="inspiry-google-recaptcha"
										 style="transform:scale(0.697);-webkit-transform:scale(0.697);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
								</div>
							</div>
							<?php
						}
						?>
						<input type="hidden" name="user-cookie" value="1" />
						<input type="hidden" name="action" value="inspiry_ajax_register" />
						<?php
						// Nonce for security.
						wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );

						if ( is_page() || is_single() ) {
							?>
							<input type="hidden" name="redirect_to" value="
							<?php
							wp_reset_postdata();
							global $post;
							the_permalink( get_the_ID() );
							?>
							" />
							<?php

						} else {
							?>
							<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />
							<?php
						}
						?>
						<button type="submit" id="register-button" name="user-submit"><?php esc_html_e( 'Register', 'framework' ); ?></button>
					</form>

					<div>
						<p id="register-message" class="rh_modal__msg"></p>
						<p id="register-error" class="rh_modal__msg"></p>
					</div>

					<div class="switch">
						<a href="#" data-switch="login" class="rh-login"><?php esc_html_e( 'Login', 'framework' ); ?></a><br />
						<a href="#" data-switch="forgot" class="rh-forgot-password"><?php esc_html_e( 'Forgot Password', 'framework' ); ?></a>
					</div>
					<!-- /.switch -->

				</div>
				<!-- /.rh_modal__register_wrap -->

			<?php endif; ?>

			<div class="rh_modal__forgot_wrap modal">

				<h3><?php esc_html_e( 'Reset Password', 'framework' ); ?></h3>

				<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="rh_modal__forgot_form"  method="post" enctype="multipart/form-data">
					<input id="reset_username_or_email" name="reset_username_or_email" type="text" placeholder="<?php esc_attr_e( 'Username or Email', 'framework' ); ?>" class="required" title="<?php esc_attr_e( '* Provide username or email!', 'framework' ); ?>" required/>
					<?php
					if ( inspiry_is_reCAPTCHA_configured()
						&& ! is_page_template( 'templates/contact.php' ) ) {
						?>
						<div class="rh_modal__recaptcha">
							<div class="inspiry-recaptcha-wrapper clearfix">
								<div class="inspiry-google-recaptcha"
									 style="transform:scale(0.697);-webkit-transform:scale(0.697);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</div>
						</div>
						<?php
					} elseif ( inspiry_is_reCAPTCHA_configured()
						&& empty( get_option( 'inspiry_contact_form_shortcode' ) ) ) {
						?>
						<div class="rh_modal__recaptcha">
							<div class="inspiry-recaptcha-wrapper clearfix">
								<div class="inspiry-google-recaptcha"
									 style="transform:scale(0.697);-webkit-transform:scale(0.697);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</div>
						</div>
						<?php
					}
					?>
					<input type="hidden" name="action" value="inspiry_ajax_forgot" />
					<input type="hidden" name="user-cookie" value="1" />
					<?php wp_nonce_field( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' ); ?>
					<button id="forgot-button" name="user-submit"><?php esc_html_e( 'Reset Password', 'framework' ); ?></button>
				</form>

				<div>
					<p id="forgot-message" class="rh_modal__msg"></p>
					<p id="forgot-error" class="rh_modal__msg"></p>
				</div>

				<div class="switch">
					<a href="#" data-switch="login" class="rh-login"><?php esc_html_e( 'Login', 'framework' ); ?></a>
					<?php if ( get_option( 'users_can_register' ) ) : ?>
						<br />
						<a href="#" data-switch="register" class="rh-register"><?php esc_html_e( 'New User? Register Now', 'framework' ); ?></a>
					<?php endif; ?>
				</div>
				<!-- /.switch -->

			</div>
			<!-- /.rh_modal__forgot_wrap -->

		<?php else : ?>

			<div class="rh_user">
				<div class="rh_user__avatar">
					<?php
					// Get user information.
					$current_user  = wp_get_current_user();
					$user_email    = $current_user->user_email;
					$user_gravatar = inspiry_get_gravatar( $user_email, '150' );
					?>
					<img src="<?php echo esc_url( $user_gravatar ); ?>">
				</div>
				<!-- /.rh_user__avatar -->
				<div class="rh_user__details">
					<p class="rh_user__msg"><?php esc_html_e( 'Welcome', 'framework' ); ?></p>
					<!-- /.rh_user__msg -->
					<h3 class="rh_user__name">
						<?php echo esc_html( $current_user->display_name ); ?>
					</h3>
				</div>
				<!-- /.rh_user__details -->
			</div>
			<!-- /.rh_user -->

			<div class="rh_modal__dashboard">

				<?php
				$profile_url = inspiry_get_edit_profile_url();
				if ( ! empty( $profile_url ) ) :
					?>
					<a href="<?php echo esc_url( $profile_url ); ?>" class="rh_modal__dash_link">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-profile.svg'; ?>
						<span><?php esc_html_e( 'Profile', 'framework' ); ?></span>
					</a>
					<?php
				endif;

				$my_properties_url = inspiry_get_my_properties_url();
				if ( ! empty( $my_properties_url ) ) :
					?>
					<a href="<?php echo esc_url( $my_properties_url ); ?>" class="rh_modal__dash_link">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-my-properties.svg'; ?>
						<span><?php esc_html_e( 'My Properties', 'framework' ); ?></span>
					</a>
					<?php
				endif;

				$favorites_url = inspiry_get_favorites_url(); // Favorites page.
				if ( ! empty( $favorites_url ) ) :
					?>
					<a href="<?php echo esc_url( $favorites_url ); ?>" class="rh_modal__dash_link">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-favorite.svg'; ?>
						<span><?php esc_html_e( 'Favorites', 'framework' ); ?></span>
					</a>
				<?php
				endif;

				$compare_properties_module = get_option( 'theme_compare_properties_module' );
				$compare_url               = inspiry_get_compare_url(); // Compare page.
				if ( ( 'enable' === $compare_properties_module ) && ! empty( $compare_url ) ) :
					?>
					<a href="<?php echo esc_url( $compare_url ); ?>" class="rh_modal__dash_link">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg'; ?>
						<span><?php esc_html_e( 'Compare', 'framework' ); ?></span>
					</a>
				<?php
				endif;

				if ( function_exists( 'IMS_Functions' ) ) {
					$ims_functions         = IMS_Functions();
					$is_memberships_enable = $ims_functions::is_memberships();
				}
				$membership_url = inspiry_get_membership_url(); // Memberships page.
				if ( ( ! empty( $is_memberships_enable ) ) && ! empty( $membership_url ) ) :
				?>
					<a href="<?php echo esc_url( $membership_url ); ?>" class="rh_modal__dash_link">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-membership.svg'; ?>
						<span><?php esc_html_e( 'Membership', 'framework' ); ?></span>
					</a>
				<?php endif; ?>

				<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="rh_modal__dash_link">
					<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-logout.svg'; ?>
					<span><?php esc_html_e( 'Log Out', 'framework' ); ?></span>
				</a>

			</div>
			<!-- /.rh_modal__dashboard -->

		<?php endif; ?>

	</div>
	<!-- /.rh_modal__wrap -->

</div>
<!-- /.rh_menu__modal -->
