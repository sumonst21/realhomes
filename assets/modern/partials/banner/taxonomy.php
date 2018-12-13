<?php
/**
 * Banner: Taxonomy
 *
 * Banner for taxonomy templates.
 *
 * @package realhomes
 * @subpackage modern
 */

// Banner Image.
$banner_image_path = get_default_banner();

// Banner Title.
$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$banner_title = $current_term->name;

?>

<section class="rh_banner rh_banner__image" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo esc_url( $banner_image_path ); ?>'); background-size: cover; ">

	<div class="rh_banner__cover"></div>
	<!-- /.rh_banner__cover -->

	<div class="rh_banner__wrap">

		<h2 class="rh_banner__title">
			<?php echo esc_html( $banner_title ); ?>
		</h2>
		<!-- /.rh_banner__title -->

		<?php if ( is_page_template( 'templates/list-layout.php' ) || is_page_template( 'templates/grid-layout.php' ) || is_tax() ) : ?>
			<div class="rh_banner__controls">
				<?php get_template_part( 'assets/modern/partials/properties/view-buttons' ); ?>
			</div>
			<!-- /.rh_banner__controls -->
		<?php endif; ?>

	</div>
	<!-- /.rh_banner__wrap -->

</section>
<!-- /.rh_banner -->
