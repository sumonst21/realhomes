<?php
/**
 * Testimonial section of the homepage.
 *
 * @package    realhomes
 * @subpackage modern
 */

$inspiry_testimonial_text = get_option( 'inspiry_testimonial_text' );
$inspiry_testimonial_name = get_option( 'inspiry_testimonial_name' );
$inspiry_testimonial_url  = get_option( 'inspiry_testimonial_url' );
$border_class             = get_option( 'inspiry_home_sections_border', 'diagonal-border' );
global $inspiry_allowed_tags;
?>

<section class="rh_section rh_section__testimonial <?php echo $border_class; ?>">

<!--<div class="rh_testimonial__quote_bg">-->
<!---->
<!--</div>-->

<!-- /.rh_testimonial__quote_left -->

<div class="rh_testimonial">
	<div class="quotes-marks mark-left">
		<?php include INSPIRY_THEME_DIR . '/images/icons/quotes.svg'; ?>
	</div>
	<div class="quotes-marks mark-right">
		<?php include INSPIRY_THEME_DIR . '/images/icons/quotes.svg'; ?>
	</div>
	<h3 class="rh_testimonial__quote">
		<?php echo wp_kses( $inspiry_testimonial_text, $inspiry_allowed_tags ); ?>
	</h3>
	<!-- /.rh_testimonial__quote -->
	<div class="rh_testimonial__author">
		<p class="rh_testimonial__author_name">
			<?php echo esc_html( $inspiry_testimonial_name ); ?>
		</p>
		<!-- /.rh_testimonial__author_name -->
		<p class="rh_testimonial__author__link">
			<a href="<?php echo esc_url( $inspiry_testimonial_url ); ?>">
				<?php echo esc_html( $inspiry_testimonial_url ); ?>
			</a>
		</p>
		<!-- /.rh_testimonial__author__link -->
	</div>
	<!-- /.rh_testimonial__author -->

</div>
<!-- /.rh_testimonial -->

</section><!-- /.rh_section rh_section__testimonial -->
