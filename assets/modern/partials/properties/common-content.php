<?php
/**
 * Contains content part for multiple properties pages
 */

if ( have_posts() ) : ?>
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
/*
 * Compare Properties Stuff.
 */

$compare_properties_module = get_option( 'theme_compare_properties_module' );
$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
	get_template_part( 'assets/modern/partials/properties/compare-view' );
}

?>
