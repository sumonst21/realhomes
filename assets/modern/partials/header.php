<?php
/**
 * Header Template
 *
 * @package    realhomes
 * @subpackage modern
 */
?>

<div class="rh_wrap">

<div id="rh_progress"></div>
<!-- /#rh_progress -->

<header class="rh_header <?php echo is_page_template( 'templates/home.php' ) ? esc_attr( 'rh_header--shadow' ) : false; ?>">

	<div class="rh_header__wrap">

		<div class="rh_logo">

			<?php
				$logo_path = get_option( 'theme_sitelogo' );
				if ( ! empty( $logo_path ) ) {
					?>
					<a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url() ); ?>">
						<img src="<?php echo esc_url( $logo_path ); ?>" alt="<?php bloginfo( 'name' ); ?>">
					</a>
					<h2 class="rh_logo__heading only-for-print">
						<?php bloginfo( 'name' ); ?>
					</h2>
					<p class="only-for-print">
						<?php bloginfo( 'description' ); ?>
					</p>					<!-- /.only-for-print -->
					<?php
				} else {
					?>
					<h2 class="rh_logo__heading">
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h2>
					<?php
				}
			?>

		</div>
		<!-- /.rh_logo -->

		<div class="rh_menu">

			<!-- Start Main Menu-->
			<nav class="main-menu">
				<div class="rh_menu__hamburger hamburger hamburger--squeeze">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
				<?php
					// Main Menu.
					if ( has_nav_menu( 'main-menu' ) ) :
						wp_nav_menu( array(
							'theme_location' => 'main-menu',
							'walker'         => new RH_Walker_Nav_Menu(),
							'menu_class'     => 'rh_menu__main clearfix',
						) );
					endif;

					// Reponsive Menu.
					if ( has_nav_menu( 'responsive-menu' ) ) :
						wp_nav_menu( array(
							'theme_location' => 'responsive-menu',
							'walker'         => new RH_Walker_Nav_Menu(),
							'menu_class'     => 'rh_menu__responsive clearfix',
						) );
					else :
						// Assign main menu as fallback.
						$locations = get_theme_mod( 'nav_menu_locations' );
						$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
						if ( ! empty( $main_menu ) ) {
							$locations['responsive-menu'] = $main_menu->term_id;
							set_theme_mod( 'nav_menu_locations', $locations );

							if ( has_nav_menu( 'responsive-menu' ) ) {
								wp_nav_menu( array(
									'theme_location' => 'responsive-menu',
									'walker'         => new RH_Walker_Nav_Menu(),
									'menu_class'     => 'rh_menu__responsive clearfix',
								) );
							}
						}
					endif;
				?>
			</nav>
			<!-- End Main Menu -->

			<div class="rh_menu__user">

				<?php

					// Currency Switcher.
					get_template_part( 'assets/modern/partials/header/currency-switcher' );

					$header_phone = get_option( 'theme_header_phone' );
					if ( ! empty( $header_phone ) ) {
						?>
						<div class="rh_menu__user_phone">
							<?php include INSPIRY_THEME_DIR . '/images/icons/icon-phone.svg'; ?>
							<a href="tel:<?php echo esc_attr( $header_phone ); ?>" class="contact-number"><?php echo esc_html( $header_phone ); ?></a>
						</div>						<!-- /.rh_menu__user_phone -->
						<?php
					}
				?>

				<?php
					$enable_user_nav = get_option( 'theme_enable_user_nav' );
					$theme_login_url = inspiry_get_login_register_url(); // Login and Register.

					if ( ! empty( $enable_user_nav ) && 'true' === $enable_user_nav ) : ?><?php if ( empty( $theme_login_url ) && ! is_user_logged_in() ) : ?>
						<div class="rh_menu__user_profile">
							<?php
								include INSPIRY_THEME_DIR . '/images/icons/icon-profile.svg';
								// modal login.
								get_template_part( 'assets/modern/partials/header/modal' );
							?>
						</div>							<!-- /.rh_menu__user_profile -->
					<?php elseif ( empty( $theme_login_url ) && is_user_logged_in() ) : ?>
						<div class="rh_menu__user_profile">
							<?php
								// Get user information.
								$current_user  = wp_get_current_user();
								$user_email    = $current_user->user_email;
								$user_gravatar = inspiry_get_gravatar( $user_email, '150' );
							?>
							<img class="user-icon" src="<?php echo esc_url( $user_gravatar ); ?>">
							<?php
								// modal login.
								get_template_part( 'assets/modern/partials/header/modal' );
							?>
						</div>							<!-- /.rh_menu__user_profile -->
					<?php elseif ( ! empty( $theme_login_url ) && is_user_logged_in() ) : ?>
						<div class="rh_menu__user_profile">
							<?php
								// Get user information.
								$current_user  = wp_get_current_user();
								$user_email    = $current_user->user_email;
								$user_gravatar = inspiry_get_gravatar( $user_email, '150' );
							?>
							<img class="user-icon" src="<?php echo esc_url( $user_gravatar ); ?>">
							<?php
								// modal login.
								get_template_part( 'assets/modern/partials/header/modal' );
							?>
						</div>							<!-- /.rh_menu__user_profile -->
					<?php elseif ( ! empty( $theme_login_url ) && ! is_user_logged_in() ) : ?>
						<a class="rh_menu__user_profile" href="<?php echo esc_url( $theme_login_url ); ?>">
							<?php include INSPIRY_THEME_DIR . '/images/icons/icon-profile.svg'; ?>
						</a>							<!-- /.rh_menu__user_profile -->
					<?php endif; ?><?php endif; ?>

				<?php
					/**
					 * Property Submit Page
					 */
					$submit_url = inspiry_get_submit_property_url();
					if ( ! empty( $submit_url ) ) {
						?>
						<div class="rh_menu__user_submit">
							<a href="<?php echo esc_url( $submit_url ); ?>"><?php esc_html_e( 'Submit', 'framework' ); ?></a>
						</div>						<!-- /.rh_menu__user_submit -->
						<?php
					}
				?>

			</div>
			<!-- /.rh_menu__user -->

		</div>
		<!-- /.rh_menu -->

	</div>
	<!-- /.rh_header__wrap -->

</header>
<!-- /.rh_header -->
