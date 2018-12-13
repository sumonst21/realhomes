<?php
/**
 * Design Page
 *
 * Page to select theme design.
 *
 * @since 	3.0.0
 * @package RH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Version.
$the_version = INSPIRY_THEME_VERSION;

if ( isset( $_POST['rh_design'] ) && isset( $_POST['inpsiry_switch_design_nonce'] ) ) {

	$screen = get_current_screen();
	if ( 'admin_page_inspiry-real-homes-design' !== $screen->id ) {
		return;
	}

	// Verify nonce.
	$nonce = $_REQUEST['inpsiry_switch_design_nonce'];
	if ( wp_verify_nonce( $nonce, 'inspiry_switch_design' ) ) {
		$inspiry_design = ( ! empty( $_POST['rh_design'] ) ) ? esc_html( $_POST['rh_design'] ) : 'classic';
		update_option( 'inspiry_design_variation', $inspiry_design );
		set_theme_mod('inspiry_default_styles','default');
	}
}

?>

<!-- HTML Started! -->
<div class="wrap about-wrap">

	<h1><?php printf( esc_html__( 'Real Homes %s', 'framework' ), esc_html( $the_version ) ); ?></h1>

	<div class="about-text">
		<?php esc_html_e( 'by', 'framework' ); ?> <a href="https://inspirythemes.com" target="_blank"><?php esc_html_e( 'Inspiry Themes', 'framework' ); ?></a>
	</div>

	<p><?php esc_html_e( 'You can play with design variations here! But it is recommended to finalize a design in start and use that for long term.
	As It is possible that a particular feature might not be supported in other variation due to design limitations.', 'framework' ); ?></p>

	<div class="rh_design__wrap">

		<form action="<?php menu_page_url( 'inspiry-real-homes-design' ); ?>" method="POST" id="rh_design__form">

			<div class="feature-section two-col">

				<?php $rh_design_variation = get_option( 'inspiry_design_variation', 'classic' ); ?>

				<div class="col">
					<h3><?php esc_html_e( 'Classic', 'framework' ); ?></h3>
					<label class="rh_design__label" for="rh_design_classic">
						<input id="rh_design_classic" class="rh_design__radio hide" type="radio" value="classic" name="rh_design" <?php echo ( 'classic' === $rh_design_variation ) ? 'checked' : false; ?> />
						<img class="rh_design__img" src="<?php echo esc_url( get_template_directory_uri() . '/framework/include/design-page/images/design-classic.jpg' ); ?>">
					</label>
				</div>
				<!-- /.col -->

				<div class="col">
					<h3><?php esc_html_e( 'Modern', 'framework' ); ?></h3>
					<label class="rh_design__label" for="rh_design_modern">
						<input id="rh_design_modern" class="rh_design__radio hide" type="radio" value="modern" name="rh_design" <?php echo ( 'modern' === $rh_design_variation ) ? 'checked' : false; ?> />
						<img class="rh_design__img" src="<?php echo esc_url( get_template_directory_uri() . '/framework/include/design-page/images/design-modern.jpg' ); ?>">
					</label>
				</div>
				<!-- /.col -->

				<?php wp_nonce_field( 'inspiry_switch_design', 'inpsiry_switch_design_nonce' ); ?>

			</div>
			<!-- /.feature-section two-col -->

			<div class="feature-section one-col rh_design__note">
				<p>
					<strong><?php esc_html_e( 'Important', 'framework' ); ?></strong> : <?php
					printf( esc_html__( 'Please make sure to follow these steps after changing design and reach out %s in case of any issue!', 'framework' ),
							'<a href="https://support.inspirythemes.com/" target="_blank">' . esc_html__( 'our support', 'framework' ) . '</a>' ); ?></p>
				<ul>
					<li><p><?php printf( esc_html__( 'Step 1. Regenerate images on your website using %s plugin.', 'framework' ),
								'<a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">' . esc_html__( 'Regenerate Thumbnails', 'framework' ) . '</a>' ); ?></p></li>
					<li><p><?php esc_html_e( 'Step 2. Test all pages on your website and rearrange widgets where required.', 'framework' ); ?></p></li>
				</ul>

			</div>
			<!-- /.feature-section two-col -->

			<div class="feature-section one-col">
				<button type="submit" id="rh_design__submit" class="button button-primary">
					<?php esc_html_e( 'Save Changes', 'framework' ); ?>
				</button>
			</div>
			<!-- /.feature-section one-col -->

		</form>

	</div>
	<!-- /.rh_design__wrap -->

</div>
