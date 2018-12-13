<?php
/**
 * Property detail page.
 *
 * @package    realhomes
 * @subpackage classic
 */

get_header();

$theme_property_detail_variation = get_option( 'theme_property_detail_variation' );

// Banner Image.
$banner_image_path = '';
$banner_image_id   = get_post_meta( $post->ID, 'REAL_HOMES_page_banner_image', true );
if ( $banner_image_id ) {
	$banner_image_path = wp_get_attachment_url( $banner_image_id );
} else {
	$banner_image_path = get_default_banner();
}
?>

<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo esc_url( $banner_image_path ); ?>'); background-size: cover;">
	<?php if ( ! ( 'true' == get_option( 'theme_banner_titles' ) ) ) : ?>
		<div class="container">
			<div class="wrap clearfix">
				<h1 class="page-title"><span><?php the_title(); ?></span></h1>
				<?php
				$display_property_breadcrumbs = get_option( 'theme_display_property_breadcrumbs' );
				if ( 'true' == $display_property_breadcrumbs ) {
				 get_template_part( 'common/partials/breadcrumbs' );
				}
				?>
			</div>
		</div>
	<?php endif; ?>
</div><!-- End Page Head -->

<!-- Content -->
<div class="container contents detail">
	<div class="row">
		<div class="span9 main-wrap">

			<!-- Main Content -->
			<div class="main">

				<div id="overview">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();

							if ( ! post_password_required() ) {

								/**
								 * Property Images Slider
								 */
								?>
								<div class="slider-main-wrapper">
									<?php
									$gallery_slider_type = get_post_meta( $post->ID, 'REAL_HOMES_gallery_slider_type', true );

									/*
									 * For demo purpose only.
									 */
									if ( isset( $_GET['slider-type'] ) ) {
										$gallery_slider_type = $_GET['slider-type'];
									}

									if ( 'thumb-on-bottom' == $gallery_slider_type ) {
										/*
										 * Slider with thumbs on bottom.
										 */
										get_template_part( 'assets/classic/partials/property/single/slider-two' );
									} else {
										/*
										 * Slider with thumbs on right.
										 */
										get_template_part( 'assets/classic/partials/property/single/slider' );
									}
									?>
									<div class="slider-socket <?php echo $gallery_slider_type; ?>">
										<?php
										/*
										 * Add to favorites.
										 */
										get_template_part( 'assets/classic/partials/property/single/add-to-favorites' );
										?>
										<!-- Print link -->
										<span class="printer-icon"><a href="javascript:window.print()"><i class="fa fa-print"></i></a></span>
									</div>
								</div>
								<?php

								/**
								 * Property Information Bar, Icons Bar, Text Contents and Features
								 */
								get_template_part( 'assets/classic/partials/property/single/contents' );

								/**
								 * Property Floor Plans
								 */
								get_template_part( 'assets/classic/partials/property/single/floor-plans' );

								/**
								 * Property Video
								 */
								get_template_part( 'assets/classic/partials/property/single/video' );

								/**
								 * Virtual Tour
								 */
								get_template_part( 'assets/classic/partials/property/single/virtual-tour' );

								/**
								 * Google Map
								 */
								get_template_part( 'assets/classic/partials/property/single/google-map' );

								/**
								 * Property Attachments
								 */
								get_template_part( 'assets/classic/partials/property/single/attachments' );


								/**
								 * Realhomes Vacation Rentals Sections
								 */
								if( inspiry_is_rvr_enabled() ) {
									get_template_part( 'assets/classic/partials/property/single/rvr/availability-calendar' );
								}

								/**
								 * Child Properties
								 */
								get_template_part( 'assets/classic/partials/property/single/children' );

								/**
								 * Property Agent
								 */
								// For demo purpose only.
								if ( isset( $_GET['variation'] ) ) {
									$theme_property_detail_variation = $_GET['variation'];
								}

								if ( 'agent-in-sidebar' !== $theme_property_detail_variation ) {
									get_template_part( 'assets/classic/partials/property/single/agent' );
								}

							} else {
								echo get_the_password_form();
							}

						endwhile;
					endif;
					?>
				</div>

			</div><!-- End Main Content -->

			<?php
			/**
			 * Similar Properties
			 */
			get_template_part( 'assets/classic/partials/property/single/similar-properties' );

			/*
			 * 9. Comments
			 * If comments are open or we have at least one comment, load up the comment template.
			 */
			if ( comments_open() || get_comments_number() ) {
				?>
				<div class="property-comments">
					<?php comments_template(); ?>
				</div>
				<?php
			}
			?>

		</div> <!-- End span9 -->

		<?php
		if ( 'agent-in-sidebar' == $theme_property_detail_variation ) {
			?>
			<div class="span3 sidebar-wrap">
				<!-- Sidebar -->
				<aside class="sidebar property-sidebar">
					<?php
					get_template_part( 'assets/classic/partials/property/single/sidebar-agent' );

					if ( ! dynamic_sidebar( 'property-sidebar' ) ) :
					endif;
					?>
				</aside>
				<!-- End Sidebar -->
			</div>
			<?php
		} else {
			get_sidebar( 'property' );
		}
		?>

	</div><!-- End contents row -->
</div><!-- End Content -->

<?php get_footer(); ?>
