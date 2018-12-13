<?php
/**
 * Page: Login or Register
 *
 * Page template for login or register.
 *
 * @since 	3.0.0
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

get_template_part( 'assets/modern/partials/properties/search/advance' ); ?>

<section class="rh_section rh_wrap rh_wrap--padding rh_wrap--topPadding">

	<div class="rh_page">

		<div class="rh_page__head">

			<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
				<h2 class="rh_page__title">
					<?php
				    $page_title = get_post_meta( get_the_ID(), 'REAL_HOMES_banner_title', true );
				    if ( empty( $page_title ) ) {
				        $page_title = get_the_title( get_the_ID() );
				    }
					echo inspiry_get_exploded_heading( $page_title );
					?>
				</h2>
				<!-- /.rh_page__title -->
			<?php endif; ?>

		</div>
		<!-- /.rh_page__head -->

		<?php if ( ! is_user_logged_in() ) : ?>

			<div class="rh_form rh_form__login_wrap">

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>

						<?php if ( get_the_content() ) : ?>
							<div class="rh_content">
								<?php the_content(); ?>
							</div>
							<!-- /.rh_content -->
						<?php endif; ?>

					<?php endwhile; ?>
				<?php endif; ?>

				<div class="rh_form__login">

					<form id="rh_modal__login_form" class="rh_form__form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" enctype="multipart/form-data">

						<div class="rh_form__row">
							<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
								<label class="info-text"><?php esc_html_e( 'Already a Member? Log in here.', 'framework' ); ?></label>
							</div>
							<!-- /.rh_form__item -->
						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row">
							<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
								<label for="username"><?php esc_html_e( 'Username', 'framework' ); ?><span>*</span></label>
		                    	<input id="username" name="log" type="text" class="required" title="<?php esc_html_e( '* Provide username!', 'framework' ); ?>" autofocus required/>
							</div>
							<!-- /.rh_form__item -->
						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row">
							<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
								<label for="password"><?php esc_html_e( 'Password', 'framework' ); ?><span>*</span></label>
		                    	<input id="password" name="pwd" type="password" class="required" title="<?php esc_html_e( '* Provide password!', 'framework' ); ?>" required/>
							</div>
							<!-- /.rh_form__item -->
						</div>
						<!-- /.rh_form__row -->

						<?php
		                if ( inspiry_is_reCAPTCHA_configured() ) {
		                    ?>
							<div class="rh_form__row">
								<div class="rh_form__item rh_form--2-column rh_form--columnAlign">
									<?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ) ?>
								</div>
								<!-- /.rh_form__item -->
							</div>
		                    <?php
		                }

		                // nonce for security.
		            	wp_nonce_field( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );
		                ?>

		                <div class="rh_form__row">
							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<input type="hidden" name="action" value="inspiry_ajax_login" />
			                    <input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url() ); ?>" />
			                    <input type="hidden" name="user-cookie" value="1" />
								<button type="submit" id="login-button" class="rh_btn rh_btn--primary"><?php esc_html_e( 'Login', 'framework' ); ?></button>
							</div>
							<!-- /.rh_form__item -->
						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row">
							<div class="rh_form__item rh_form--1-column rh_form--columnAlign rh_form__response">
			                    <p id="login-message" class="rh_form__msg"></p>
		                        <p id="login-error" class="rh_form__error"></p>
							</div>
							<!-- /.rh_form__item -->
						</div>
						<!-- /.rh_form__row -->

					</form>

					<div class="rh_form__row">
						<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
							<p class="forgot-password">
		                        <a class="toggle-forgot-form" href="#"><?php esc_html_e( 'Forgot password!', 'framework' )?></a>
		                    </p>
						</div>
						<!-- /.rh_form__item -->
					</div>
					<!-- /.rh_form__row -->

					<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="rh_modal__forgot_form"  method="post" enctype="multipart/form-data">

						<div class="rh_form__row">
							<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
								<label for="reset_username_or_email"><?php esc_html_e( 'Username or Email', 'framework' ); ?><span>*</span></label>
		                    	<input id="reset_username_or_email" name="reset_username_or_email" type="text" class="required" title="<?php esc_html_e( '* Provide username or email!', 'framework' ); ?>" required/>
							</div>
							<!-- /.rh_form__item -->
						</div>
						<!-- /.rh_form__row -->

		                <?php if ( inspiry_is_reCAPTCHA_configured() ) : ?>
							<div class="rh_form__row">
								<div class="rh_form__item rh_form--2-column rh_form--columnAlign">
									<?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ) ?>
								</div>
								<!-- /.rh_form__item -->
							</div>
		                <?php endif; ?>

		                <?php wp_nonce_field( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' ); ?>

		                <div class="rh_form__row">
							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
			                    <input type="hidden" name="action" value="inspiry_ajax_forgot" />
				                <input type="hidden" name="user-cookie" value="1" />
				                <input type="submit"  id="forgot-button" name="user-submit" value="<?php esc_html_e( 'Reset Password', 'framework' );?>" class="rh_btn rh_btn--secondary" />
							</div>
							<!-- /.rh_form__item -->
						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row">
							<div class="rh_form__item rh_form--1-column rh_form--columnAlign rh_form__response">
			                    <p id="forgot-message" class="rh_form__msg"></p>
		                        <p id="forgot-error" class="rh_form__error"></p>
							</div>
							<!-- /.rh_form__item -->
						</div>
						<!-- /.rh_form__row -->

		            </form>

				</div>
				<!-- /.rh_form__login -->

				<?php if ( get_option( 'users_can_register' ) ) : ?>

					<div class="rh_form__register">

	                    <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="rh_modal__register_form"  method="post" enctype="multipart/form-data">

	                        <div class="rh_form__row">
								<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
									<label class="info-text"><?php esc_html_e( 'Do not have an account? Register here', 'framework' ); ?></label>
								</div>
								<!-- /.rh_form__item -->
							</div>
							<!-- /.rh_form__row -->

							<div class="rh_form__row">
								<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
									<label for="register_username" class="hide"><?php esc_html_e( 'Username','framework' ); ?><span>*</span></label>
		                            <input id="register_username" name="register_username" type="text" class="required"
		                                   title="<?php esc_html_e( '* Provide username!', 'framework' ); ?>"
		                                   placeholder="<?php esc_html_e( 'Username', 'framework' ); ?>" required/>
								</div>
								<!-- /.rh_form__item -->
							</div>
							<!-- /.rh_form__row -->

							<div class="rh_form__row">
								<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
									<label for="register_email" class="hide"><?php esc_html_e( 'Email','framework' ); ?><span>*</span></label>
		                            <input id="register_email" name="register_email" type="text" class="email required"
		                                   title="<?php esc_html_e( '* Provide valid email address!', 'framework' ); ?>"
		                                   placeholder="<?php esc_html_e( 'Email', 'framework' ); ?>" required/>
								</div>
								<!-- /.rh_form__item -->
							</div>
							<!-- /.rh_form__row -->

	                        <?php if ( inspiry_is_reCAPTCHA_configured() ) : ?>
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--2-column rh_form--columnAlign">
										<?php get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ) ?>
									</div>
									<!-- /.rh_form__item -->
								</div>
			                <?php endif; ?>

			                <div class="rh_form__row">
								<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
									<input type="hidden" name="user-cookie" value="1" />
									<input type="hidden" name="action" value="inspiry_ajax_register" />
									<?php
			                        // Nonce for security.
			                        wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );
									?>
			                        <input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />
			                        <input type="submit" id="register-button" name="user-submit" value="<?php esc_html_e( 'Register', 'framework' ); ?>" class="rh_btn rh_btn--secondary" />
								</div>
								<!-- /.rh_form__item -->
							</div>
							<!-- /.rh_form__row -->

							<div class="rh_form__row">
								<div class="rh_form__item rh_form--1-column rh_form--columnAlign rh_form__response">
									<p id="register-message" class="rh_form__msg"></p>
	                        		<p id="register-error" class="rh_form__error"></p>
								</div>
								<!-- /.rh_form__item -->
							</div>
							<!-- /.rh_form__row -->

	                    </form>

					</div>
					<!-- /.rh_form__register -->

				<?php endif; ?>

			</div>
			<!-- /.rh_form -->

		<?php elseif ( is_user_logged_in() ) : ?>

			<?php alert( esc_html__( 'You are already logged in!', 'framework' ) ); ?>

		<?php endif; ?>

	</div>
	<!-- /.rh_page -->

</section>
<!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php
get_footer();
