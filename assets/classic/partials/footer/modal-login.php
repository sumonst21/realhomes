<!-- Login Modal -->
<div id="login-modal" class="forms-modal modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<p>&nbsp;</p>
	</div>

	<!-- start of modal body -->
	<div class="modal-body">

		<!-- login section -->
		<div class="login-section modal-section">
			<h4><?php esc_html_e( 'Login', 'framework' ); ?></h4>
			<form id="login-form" class="login-form" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" enctype="multipart/form-data">
				<div class="form-option">
					<input id="username" name="log" type="text" class="focus-class required" placeholder="<?php esc_html_e( 'Username or Email Address', 'framework' ); ?>" title="<?php _e( '* Provide user name!', 'framework' ); ?>" autofocus="autofocus" required/>
				</div>
				<div class="form-option">
					<input id="password" name="pwd" type="password" class="required" placeholder="<?php esc_html_e( 'Password', 'framework' ); ?>" title="<?php _e( '* Provide password!', 'framework' ); ?>" required/>
				</div>
				<?php
				if ( inspiry_is_reCAPTCHA_configured() ) {
					?>
					<div class="form-option">
						<div class="inspiry-recaptcha-wrapper clearfix">
							<div class="inspiry-google-recaptcha"
								 style="transform:scale(0.98);-webkit-transform:scale(0.98);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
						</div>
					</div>
					<?php

				}
				?>
				<input type="hidden" name="action" value="inspiry_ajax_login"/>
				<?php
				// nonce for security
				wp_nonce_field( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );

				if ( is_page() || is_single() ) {
					?><input type="hidden" name="redirect_to" value="<?php wp_reset_postdata();
					global $post;
					the_permalink( $post->ID ); ?>" /><?php

				} else {
					?><input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url() ); ?>" /><?php

				}
				?>
				<input type="hidden" name="user-cookie" value="1"/>
				<input type="submit" id="login-button" name="submit" value="<?php _e( 'Log in', 'framework' ); ?>" class="real-btn login-btn"/>
				<img id="login-loader" class="modal-loader" src="<?php echo INSPIRY_DIR_URI; ?>/images/ajax-loader.gif" alt="Working...">
				<div>
					<div id="login-message" class="modal-message"></div>
					<div id="login-error" class="modal-error"></div>
				</div>
			</form>

			<div class="inspiry-social-login">
				<?php
				/*
				 * For social login
				 */
				do_action( 'wordpress_social_login' );
				?>
			</div>

			<p>
				<?php if ( get_option( 'users_can_register' ) ) : ?>
					<a class="activate-section" data-section="register-section" href="#"><?php _e( 'Register Here', 'framework' ); ?></a>
					<span class="divider">-</span>
				<?php endif; ?>
				<a class="activate-section" data-section="forgot-section" href="#"><?php _e( 'Forgot Password', 'framework' ); ?></a>
			</p>
		</div>

		<!-- forgot section -->
		<div class="forgot-section modal-section">
			<h4><?php _e( 'Reset Password', 'framework' ); ?></h4>
			<form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" id="forgot-form" method="post" enctype="multipart/form-data">
				<div class="form-option">
					<label for="reset_username_or_email"><?php _e( 'Username or Email', 'framework' ); ?><span>*</span></label>
					<input id="reset_username_or_email" name="reset_username_or_email" type="text" class="required" title="<?php _e( '* Provide username or email!', 'framework' ); ?>" required/>
				</div>
				<?php
				if ( inspiry_is_reCAPTCHA_configured() ) {
					?>
					<div class="form-option">
						<div class="inspiry-recaptcha-wrapper clearfix">
							<div class="inspiry-google-recaptcha"
								 style="transform:scale(0.98);-webkit-transform:scale(0.98);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
						</div>
					</div>
					<?php

				}
				?>
				<input type="hidden" name="action" value="inspiry_ajax_forgot"/>
				<input type="hidden" name="user-cookie" value="1"/>
				<input type="submit" id="forgot-button" name="user-submit" value="<?php _e( 'Reset Password', 'framework' ); ?>" class="real-btn register-btn"/>
				<img id="forgot-loader" class="modal-loader" src="<?php echo INSPIRY_DIR_URI; ?>/images/ajax-loader.gif" alt="Working...">
				<?php wp_nonce_field( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' ); ?>
				<div>
					<div id="forgot-message" class="modal-message"></div>
					<div id="forgot-error" class="modal-error"></div>
				</div>
			</form>
			<p>
				<a class="activate-section" data-section="login-section" href="#"><?php _e( 'Login Here', 'framework' ); ?></a>
				<?php if ( get_option( 'users_can_register' ) ) : ?>
					<span class="divider">-</span>
					<a class="activate-section" data-section="register-section" href="#"><?php _e( 'Register Here', 'framework' ); ?></a>
				<?php endif; ?>
			</p>
		</div>

		<?php
		if ( get_option( 'users_can_register' ) ) :
			?>
			<!-- register section -->
			<div class="register-section modal-section">
				<h4><?php _e( 'Register', 'framework' ); ?></h4>
				<form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" id="register-form" method="post" enctype="multipart/form-data">

					<div class="form-option">
						<label for="register_username" class=""><?php _e( 'User Name', 'framework' ); ?>
							<span>*</span></label>
						<input id="register_username" name="register_username" type="text" class="required"
							   title="<?php _e( '* Provide user name!', 'framework' ); ?>" required/>
					</div>

					<div class="form-option">
						<label for="register_email" class=""><?php _e( 'Email', 'framework' ); ?><span>*</span></label>
						<input id="register_email" name="register_email" type="text" class="email required"
							   title="<?php _e( '* Provide valid email address!', 'framework' ); ?>" required/>
					</div>

					<?php
					if ( inspiry_is_reCAPTCHA_configured() ) {
						?>
						<div class="form-option">
							<div class="inspiry-recaptcha-wrapper clearfix">
								<div class="inspiry-google-recaptcha"
									 style="transform:scale(0.98);-webkit-transform:scale(0.98);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</div>
						</div>
						<?php

					}
					?>

					<input type="hidden" name="user-cookie" value="1"/>
					<input type="submit" id="register-button" name="user-submit" value="<?php _e( 'Register', 'framework' ); ?>" class="real-btn register-btn"/>
					<img id="register-loader" class="modal-loader" src="<?php echo INSPIRY_DIR_URI; ?>/images/ajax-loader.gif" alt="Working...">
					<input type="hidden" name="action" value="inspiry_ajax_register"/>
					<?php
					// nonce for security
					wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );

					if ( is_page() || is_single() ) {
						?><input type="hidden" name="redirect_to" value="<?php wp_reset_postdata();
						global $post;
						the_permalink( $post->ID ); ?>" /><?php

					} else {
						?>
						<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" /><?php

					}
					?>

					<div>
						<div id="register-message" class="modal-message"></div>
						<div id="register-error" class="modal-error"></div>
					</div>

				</form>
				<p>
					<a class="activate-section" data-section="login-section" href="#"><?php _e( 'Login Here', 'framework' ); ?></a>
					<span class="divider">-</span>
					<a class="activate-section" data-section="forgot-section" href="#"><?php _e( 'Forgot Password', 'framework' ); ?></a>
				</p>
			</div>
			<?php
		endif;
		?>

	</div>
	<!-- end of modal-body -->

</div>
