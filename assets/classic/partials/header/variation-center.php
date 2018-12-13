<?php
/**
 * Header Variation: Center
 *
 * @package realhomes
 * @subpackage classic
 */

?>

<header id="header" class="clearfix">

	<div class="header__top">

		<div class="row">

			<div class="span5 header__switchers">

				<?php
				/* WPML Language Switcher */
				if ( function_exists( 'icl_get_languages' ) ) {
					$wpml_lang_switcher = get_option( 'theme_wpml_lang_switcher' );
					if ( 'true' === $wpml_lang_switcher ) {
						echo '<div class="switcher__lang clearfix">';
						do_action( 'icl_language_selector' );
						echo '</div>';
					}
				}
				?>
				<!-- /.switcher__lang -->

				<?php if ( class_exists( 'WP_Currencies' ) ) : ?>
					<div class="switcher__currency clearfix">
						<?php get_template_part( 'assets/classic/partials/header/currency-switcher' ); // Currency Switcher. ?>
					</div>
					<!-- /.switcher__currency -->
				<?php endif; ?>

				<div class="social_nav clearfix" id="social_nav">
					<!-- User Navigation -->
					<?php get_template_part( 'assets/classic/partials/header/social-nav' ); ?>
				</div>
				<!-- /.social_nav -->

			</div>
			<!-- /.span6 -->

			<div class="span7 header__user_nav">

				<!-- User Navigation -->
				<?php get_template_part( 'assets/classic/partials/header/user-nav' ); ?>

				<?php
				// Header email.
				$header_email = get_option( 'theme_header_email' );
				if ( ! empty( $header_email ) ) {
					?>
					<div id="contact-email">
						<?php include INSPIRY_THEME_DIR . '/images/icon-mail.svg'; ?>
						<a href="mailto:<?php echo esc_attr( antispambot( $header_email ) ); ?>"><?php echo esc_html( antispambot( $header_email ) ); ?></a>
					</div>
					<?php

				}
				?>

			</div>
			<!-- /.span6 -->

		</div>
		<!-- /.row -->

		<div class="row">

			<div class="span12 header__logo" id="logo">
				<?php
				$logo_path = get_option( 'theme_sitelogo' );
				if ( ! empty( $logo_path ) ) {
					?>
					<a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url() ); ?>">
						<img src="<?php echo esc_url( $logo_path ); ?>" alt="<?php bloginfo( 'name' ); ?>">
					</a>
					<h2 class="logo-heading only-for-print">
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h2>
					<?php

				} else {
					?>
					<h2 class="logo-heading">
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h2>
					<?php

				}

				$description = get_bloginfo( 'description' );
				if ( $description ) {
					echo '<div class="tag-line"><span>';
					echo esc_html( $description );
					echo '</span></div>';
				}
				?>
			</div>
			<!-- /.span12 -->

		</div>
		<!-- /.row -->

	</div>
	<!-- /.header__top -->

	<div class="header__navigation clearfix">

		<div class="header__menu">
			<!-- Start Main Menu-->
			<nav class="main-menu">
				<div class="rh_menu__hamburger hamburger hamburger--squeeze">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
					<p><?php esc_html_e( 'Menu', 'framework' ); ?></p>
				</div>
				<?php
				if ( has_nav_menu( 'main-menu' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'main-menu',
						'walker'         => new RH_Walker_Nav_Menu(),
						'menu_class'     => 'rh_menu__main_menu clearfix',
					) );
				}
				if ( has_nav_menu( 'responsive-menu' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'responsive-menu',
						'walker'         => new RH_Walker_Nav_Menu(),
						'menu_class'     => 'rh_menu__responsive clearfix',
					) );
				} else {
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
				}
				?>
			</nav>
			<!-- End Main Menu -->
		</div>
		<!-- /.header__menu -->

		<div class="header__phone_number clearfix">
			<!-- Phone Number -->
			<?php get_template_part( 'assets/classic/partials/header/phone-number' ); ?>
		</div>
		<!-- /.header__phone_number -->

	</div>
	<!-- /.header__navigation -->

</header>
<!-- /#header.clearfix -->
