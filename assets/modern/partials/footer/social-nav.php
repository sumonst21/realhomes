<?php
/**
 * Social navigation of the footer.
 *
 * @package    realhomes
 * @subpackage modern
 */

$show_social = get_option( 'theme_show_social_menu' );

if ( 'true' === $show_social ) {
	$rh_facebook  = get_option( 'theme_facebook_link' );
	$rh_twitter   = get_option( 'theme_twitter_link' );
	$rh_linkedin  = get_option( 'theme_linkedin_link' );
	$rh_google    = get_option( 'theme_google_link' );
	$rh_instagram = get_option( 'theme_instagram_link' );
	$rh_skype     = get_option( 'theme_skype_username' );
	$rh_youtube   = get_option( 'theme_youtube_link' );
	$rh_pinterest = get_option( 'theme_pinterest_link' );
	$rh_rss       = get_option( 'theme_rss_link' );

	if ( ! empty( $rh_facebook ) ) {
		?>
		<a class="facebook" target="_blank" href="<?php echo esc_url( $rh_facebook ); ?>">
			<i class="fa fa-facebook-official fa-lg"></i>
		</a>
		<?php
	}

	if ( ! empty( $rh_twitter ) ) {
		?>
		<a class="twitter" target="_blank" href="<?php echo esc_url( $rh_twitter ); ?>">
			<i class="fa fa-twitter fa-lg"></i>
		</a>
		<?php
	}

	if ( ! empty( $rh_linkedin ) ) {
		?>
		<a class="linkedin" target="_blank" href="<?php echo esc_url( $rh_linkedin ); ?>">
			<i class="fa fa-linkedin-square fa-lg"></i>
		</a>
		<?php
	}

	if ( ! empty( $rh_google ) ) {
		?>
		<a class="google-plus" target="_blank" href="<?php echo esc_url( $rh_google ); ?>">
			<i class="fa fa-google-plus fa-lg"></i>
		</a>
		<?php
	}

	if ( ! empty( $rh_instagram ) ) {
		?>
		<a class="instagram" target="_blank" href="<?php echo esc_url( $rh_instagram ); ?>">
			<i class="fa fa-instagram fa-lg"></i>
		</a>
		<?php
	}

	if ( ! empty( $rh_skype ) ) {
		?>
		<a class="skype" target="_blank" href="skype:<?php echo esc_attr( $rh_skype ); ?>?add">
			<i class="fa fa-skype fa-lg"></i>
		</a>
		<?php
	}

	if ( ! empty( $rh_youtube ) ) {
		?>
		<a class="youtube" target="_blank" href="<?php echo esc_url( $rh_youtube ); ?>">
			<i class="fa fa-youtube-play fa-lg"></i>
		</a>
		<?php
	}

	if ( ! empty( $rh_pinterest ) ) {
		?>
		<a class="pinterest" target="_blank" href="<?php echo esc_url( $rh_pinterest ); ?>">
			<i class="fa fa-pinterest fa-lg"></i>
		</a>
		<?php
	}

	if ( ! empty( $rh_rss ) ) {
		?>
		<a class="rss" target="_blank" href="<?php echo esc_url( $rh_rss ); ?>">
			<i class="fa fa-rss fa-lg"></i>
		</a>
		<?php
	}
}
