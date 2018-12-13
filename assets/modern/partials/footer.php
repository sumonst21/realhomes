<?php
/**
 * Footer template
 *
 * @package realhomes
 * @subpackage modern
 */

$border_class     = get_option( 'inspiry_home_sections_border', 'diagonal-border' );
?>
<footer class="rh_footer <?php echo $border_class; echo ( ! is_page_template( 'templates/home.php' ) && 'diagonal-border' == $border_class ) ? 'rh_footer__before_fix' : false; ?>">

	<div class="rh_footer__wrap rh_footer--alignCenter rh_footer--paddingBottom">

		<div class="rh_footer__logo">
			<?php
			$logo_enabled = get_option( 'inspiry_enable_footer_logo', 'true' );
			$logo_path    = get_option( 'inspiry_footer_logo' );
			if ( 'true' === $logo_enabled && ! empty( $logo_path ) ) {
				?>
				<a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url() ); ?>">
					<img src="<?php echo esc_url( $logo_path ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				</a>
				<?php
			} elseif ( 'true' === $logo_enabled ) {
				?>
				<h2 class="rh_footer__heading">
					<a href="<?php echo esc_url( home_url() ); ?>"  title="<?php bloginfo( 'name' ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h2>
				<?php
			}
			$desc_enabled = get_option( 'inspiry_enable_footer_tagline', 'true' );
			$description  = get_option( 'inspiry_footer_tagline' );
			if ( 'true' === $desc_enabled && $description ) {
				echo '<p class="tag-line"><span class="separator">/</span><span class="text">';
					echo esc_html( $description );
				echo '</span></p>';
			}
			?>
		</div>
		<!-- /.rh_footer__logo -->

		<div class="rh_footer__social">
			<?php
			$show_social_menu = get_option( 'theme_show_social_menu' );
			if ( ! empty( $show_social_menu ) && 'true' === $show_social_menu ) {
				get_template_part( 'assets/modern/partials/footer/social-nav' );
			}
			?>
		</div>
		<!-- /.rh_footer__social -->

	</div>
	<!-- /.rh_footer__wrap -->

	<div class="rh_footer__wrap rh_footer--alignTop rh_footer--paddingBottom">
		<?php

			$footer_columns = get_option( 'inspiry_footer_columns', '3' );

			switch ( $footer_columns ) {
				case '1' :
					$column_class = 'column-1';
					break;
				case '2' :
					$column_class = 'columns-2';
					break;
				case '4' :
					$column_class = 'columns-4';
					break;
				default:
					$column_class = 'columns-3';
			}

		?>
		<div class="rh_footer__widgets <?php echo $column_class; ?>">
			<?php get_template_part( 'assets/modern/partials/footer/first-column' ); ?>
		</div>
		<!-- /.rh_footer__widgets -->

		<?php
			if ( intval( $footer_columns ) >= 2 ) {
				?>
				<div class="rh_footer__widgets <?php echo $column_class; ?>">
					<?php get_template_part( 'assets/modern/partials/footer/second-column' ); ?>
				</div>
				<!-- /.rh_footer__widgets -->
				<?php
			}

			if ( intval( $footer_columns ) >= 3 ) {
				?>
				<div class="rh_footer__widgets <?php echo $column_class; ?>">
					<?php get_template_part( 'assets/modern/partials/footer/third-column' ); ?>
				</div>
				<!-- /.rh_footer__widgets -->
				<?php
			}

			if ( intval( $footer_columns ) == 4 ) {
				?>
				<div class="rh_footer__widgets <?php echo $column_class; ?>">
					<?php get_template_part( 'assets/modern/partials/footer/fourth-column' ); ?>
				</div>
				<!-- /.rh_footer__widgets -->
				<?php
			}
		?>
	</div>
	<!-- /.rh_footer__wrap -->

	<div class="rh_footer__wrap rh_footer--space_between">
		<p class="copyrights">
			<?php
			$copyrights = get_option( 'theme_copyright_text' );
			echo ( ! empty( $copyrights ) ) ? $copyrights : false;
			?>
		</p>
		<!-- /.copyrights -->

		<p class="designed-by">
			<?php
			$designed_by = get_option( 'theme_designed_by_text' );
			echo ( ! empty( $designed_by ) ) ? $designed_by : false;
			?>
		</p>
		<!-- /.copyrights -->
	</div>
	<!-- /.rh_footer__wrap -->

</footer>
<!-- /.rh_footer -->

<?php
/**
 * Display link to previous and next entry
 */
inspiry_post_nav();
?>

</div>
<!-- /.rh_wrap -->
