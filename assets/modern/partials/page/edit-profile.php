<?php
/**
 * Page: Edit Profile
 *
 * Edit Profile page of the theme.
 *
 * @since    3.0.0
 * @package  RH/modern
 */

get_header();

// Page Head.
$header_variation = get_option( 'inspiry_member_pages_header_variation' );

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

			<div class="rh_page__head">

				<?php if ( empty( $header_variation ) || ( 'none' === $header_variation ) ) : ?>
					<h2 class="rh_page__title">
						<?php
						// Page Title.
						$page_title = get_post_meta( get_the_ID(), 'REAL_HOMES_banner_title', true );
						if ( empty( $page_title ) ) {
							$page_title = get_the_title( get_the_ID() );
						}
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
						<a href="<?php echo esc_url( $profile_url ); ?>" class="rh_page__nav_item active">
							<?php include INSPIRY_THEME_DIR . '/images/icons/icon-dash-profile.svg'; ?>
							<p><?php esc_html_e( 'Profile', 'framework' ); ?></p>
						</a>
						<?php
					endif;

					$my_properties_url = inspiry_get_my_properties_url();
					if ( ! empty( $my_properties_url ) ) :
						?>
						<a href="<?php echo esc_url( $my_properties_url ); ?>" class="rh_page__nav_item">
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
			<!-- /.rh_page__wrap -->

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

			<?php
			if ( ! is_user_logged_in() ) {
				$enable_user_nav = get_option( 'theme_enable_user_nav' );
				$theme_login_url = inspiry_get_login_register_url(); // Login and Register.

				if ( ! empty( $enable_user_nav ) && 'true' === $enable_user_nav ) {
					if ( empty( $theme_login_url ) ) {
						alert( esc_html__( 'Login Required:', 'framework' ), esc_html__( 'Please login to edit your profile information!', 'framework' ) );
					} elseif ( ! empty( $theme_login_url ) ) {
						alert( esc_html__( 'Login Required:', 'framework' ), sprintf( esc_html__( 'Please %1$s login %2$s to edit your profile information!', 'framework' ), '<a href="' . esc_url( $theme_login_url ) . '">', '</a>' ) );
					}
				} else {
					alert( esc_html__( 'Login Required:', 'framework' ), esc_html__( 'Please login to edit your profile information!', 'framework' ) );
				}
			} elseif ( is_user_logged_in() ) {
				// Get user information.
				$current_user      = wp_get_current_user();
				$current_user_meta = get_user_meta( $current_user->ID );
				?>

				<div class="rh_form">

					<form id="inspiry-edit-user" enctype="multipart/form-data" class="rh_form__form">

						<div class="rh_form__row">

							<div class="rh_form__item rh_form__user_profile user-profile-img-wrapper">

								<div id="user-profile-img">

									<div class="profile-thumb">
										<?php
										if ( isset( $current_user_meta['profile_image_id'] ) ) {
											$profile_image_id = intval( $current_user_meta['profile_image_id'][0] );
											if ( $profile_image_id ) {
												echo wp_get_attachment_image( $profile_image_id, 'agent-image' );
												echo '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' . esc_attr( $profile_image_id ) . '"/>';
											}
										}
										?>
									</div>

								</div><!-- end of user profile image -->

								<div class="profile-img-controls">

									<a id="select-profile-image" class="rh_btn rh_btn--secondary" href="javascript:;"><?php esc_html_e( 'Upload New Picture', 'framework' ); ?></a>
									<a id="remove-profile-image" class="rh_btn rh_btn--profileDelete" href="#remove-profile-image"><?php esc_html_e( 'Delete', 'framework' ); ?></a>

									<p class="field-description">
										<?php esc_html_e( 'Profile image should have minimum width of 128px and minimum height of 128px.', 'framework' ); ?>
										<?php esc_html_e( 'Make sure to save changes after changing the image.', 'framework' ); ?>
									</p>

									<div id="errors-log"></div>

								</div><!-- end of profile image controls -->

							</div>
							<!-- /.rh_form__item -->

						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row">

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="first-name"><?php esc_html_e( 'First Name', 'framework' ); ?></label>
								<input name="first-name" type="text" id="first-name" placeholder="<?php esc_attr_e( 'Enter your first name', 'framework' ); ?>" value="<?php if ( isset( $current_user_meta['first_name'] ) ) {
									echo esc_attr( $current_user_meta['first_name'][0] );
								} ?>" autofocus/>
							</div>
							<!-- /.rh_form__item -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="last-name"><?php esc_html_e( 'Last Name', 'framework' ); ?></label>
								<input name="last-name" type="text" id="last-name" placeholder="<?php esc_attr_e( 'Enter your last name', 'framework' ); ?>" value="<?php if ( isset( $current_user_meta['last_name'] ) ) {
									echo esc_attr( $current_user_meta['last_name'][0] );
								} ?>"/>
							</div>
							<!-- /.rh_form__item -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="display-name"><?php esc_html_e( 'Display Name', 'framework' ); ?> *</label>
								<input class="required" name="display-name" type="text" id="display-name" placeholder="<?php esc_attr_e( 'Enter your display name', 'framework' ); ?>" value="<?php echo esc_attr( $current_user->display_name ); ?>" required/>
							</div>
							<!-- /.rh_form__item -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="email"><?php esc_html_e( 'Email', 'framework' ); ?> *</label>
								<input class="required" name="email" type="email" id="email" placeholder="<?php esc_attr_e( 'Enter your email address', 'framework' ); ?>" value="<?php echo esc_attr( $current_user->user_email ); ?>" required/>
							</div>
							<!-- /.rh_form__item -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="pass1"><?php esc_html_e( 'Password', 'framework' ); ?></label>
								<input name="pass1" type="password" id="pass1"/>
								<p class="note"><?php esc_html_e( 'Note: Fill it only if you want to change your password', 'framework' ); ?></p>
							</div>
							<!-- /.rh_form__item -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="pass2"><?php esc_html_e( 'Confirm Password', 'framework' ); ?></label>
								<input name="pass2" type="password" id="pass2"/>
							</div>
							<!-- /.rh_form__item -->

							<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
								<label for="description"><?php esc_html_e( 'Biographical Information', 'framework' ) ?></label>
								<textarea name="description" id="description" rows="5" cols="30"><?php if ( isset( $current_user_meta['description'] ) ) {
										echo esc_textarea( $current_user_meta['description'][0] );
									} ?></textarea>
							</div>
							<!-- /.rh_form__item rh_form--columnAlign -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="mobile-number"><?php esc_html_e( 'Mobile Number', 'framework' ); ?></label>
								<input name="mobile-number" type="text" id="mobile-number" value="<?php if ( isset( $current_user_meta['mobile_number'] ) ) {
									echo esc_attr( $current_user_meta['mobile_number'][0] );
								} ?>"/>
							</div>
							<!-- /.rh_form__item rh_form--columnAlign -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="office-number"><?php esc_html_e( 'Office Number', 'framework' ); ?></label>
								<input name="office-number" type="text" id="office-number" value="<?php if ( isset( $current_user_meta['office_number'] ) ) {
									echo esc_attr( $current_user_meta['office_number'][0] );
								} ?>"/>
							</div>
							<!-- /.rh_form__item rh_form--columnAlign -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="fax-number"><?php esc_html_e( 'Fax Number', 'framework' ); ?></label>
								<input name="fax-number" type="text" id="fax-number" value="<?php if ( isset( $current_user_meta['fax_number'] ) ) {
									echo esc_attr( $current_user_meta['fax_number'][0] );
								} ?>"/>
							</div>
							<!-- /.rh_form__item rh_form--columnAlign -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="facebook-url"><?php esc_html_e( 'Facebook URL', 'framework' ); ?></label>
								<div class="rh_form__social">
									<span class="fa fa-facebook-official fa-lg"></span>
									<input name="facebook-url" type="text" id="facebook-url" value="<?php echo ( isset( $current_user_meta['facebook_url'] ) ) ? esc_attr( $current_user_meta['facebook_url'][0] ) : esc_attr( 'https://' ); ?>"/>
								</div>
								<!-- /.rh_form__social -->
							</div>
							<!-- /.rh_form__item rh_form--columnAlign -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="twitter-url"><?php esc_html_e( 'Twitter URL', 'framework' ); ?></label>
								<div class="rh_form__social">
									<span class="fa fa-twitter fa-lg"></span>
									<input name="twitter-url" type="text" id="twitter-url" value="<?php echo ( isset( $current_user_meta['twitter_url'] ) ) ? esc_attr( $current_user_meta['twitter_url'][0] ) : esc_attr( 'https://' ); ?>"/>
								</div>
								<!-- /.rh_form__social -->
							</div>
							<!-- /.rh_form__item rh_form--columnAlign -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="google-plus-url"><?php esc_html_e( 'Google Plus URL', 'framework' ); ?></label>
								<div class="rh_form__social">
									<span class="fa fa-google-plus fa-lg"></span>
									<input name="google-plus-url" type="text" id="google-plus-url" value="<?php echo ( isset( $current_user_meta['google_plus_url'] ) ) ? esc_attr( $current_user_meta['google_plus_url'][0] ) : esc_attr( 'https://' ); ?>"/>
								</div>
								<!-- /.rh_form__social -->
							</div>
							<!-- /.rh_form__item rh_form--columnAlign -->

							<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
								<label for="linkedin-url"><?php esc_html_e( 'LinkedIn URL', 'framework' ); ?></label>
								<div class="rh_form__social">
									<span class="fa fa-linkedin-square fa-lg"></span>
									<input name="linkedin-url" type="text" id="linkedin-url" value="<?php echo ( isset( $current_user_meta['linkedin_url'] ) ) ? esc_attr( $current_user_meta['linkedin_url'][0] ) : esc_attr( 'https://' ); ?>"/>
								</div>
								<!-- /.rh_form__social -->
							</div>
							<!-- /.rh_form__item rh_form--columnAlign -->

						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row">
							<?php
							// Action hook for plugin and extra fields.
							do_action( 'edit_user_profile', $current_user );
							// WordPress Nonce for Security Check.
							wp_nonce_field( 'update_user', 'user_profile_nonce' );
							?>
							<input type="hidden" name="action" value="inspiry_update_profile"/>
						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row">

							<div class="rh_form__item rh_form__submit rh_form--3-column">
								<input name="update-user" type="submit" id="update-user" class="rh_btn rh_btn--primary" value="<?php esc_attr_e( 'Save Changes', 'framework' ); ?>"/>
								<span id="form-loader">
									<?php include INSPIRY_THEME_DIR . '/images/loader.svg'; ?>
								</span>
							</div>
							<!-- /.rh_form__form -->

						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row rh_form--columnAlign">
							<p id="form-message"></p>
							<ul id="form-errors"></ul>
						</div>
						<!-- /.rh_form__row -->

					</form>

				</div>
				<!-- /.rh_form -->

				<?php
			}
			?>

		</div>
		<!-- /.rh_page -->

	</section>
	<!-- /.rh_section rh_wrap rh_wrap--padding -->

<?php
get_footer();
