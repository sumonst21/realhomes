<?php
/**
 * Banner: Property Archive
 *
 * Banner for property archive.
 *
 * @package realhomes
 * @subpackage modern
 */

// Banner Image.
$banner_image_path = get_default_banner(); ?>

<section class="rh_banner rh_banner__image" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo esc_url( $banner_image_path ); ?>'); background-size: cover; ">

	<div class="rh_banner__cover"></div>
	<!-- /.rh_banner__cover -->

	<div class="rh_banner__wrap">

		<h2 class="rh_banner__title">
			<?php post_type_archive_title(); ?>
		</h2>
		<!-- /.rh_banner__title -->

		<div class="rh_banner__controls">
			<?php get_template_part( 'assets/modern/partials/properties/view-buttons' ); ?>
		</div>
		<!-- /.rh_banner__controls -->

	</div>
	<!-- /.rh_banner__wrap -->

</section>
<!-- /.rh_banner -->
