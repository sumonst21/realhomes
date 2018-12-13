<?php
/**
 * Featured properties section of homepage.
 *
 * @package    realhomes
 * @subpackage modern
 */


$inspiry_show_home_properties     = get_option( 'theme_show_home_properties', 'true' ); // Home properties.

$section_margin_top = '';
	if($inspiry_show_home_properties === 'false'){
		$section_margin_top = 'section-margin-top';
	}

// Featured Properties Query Arguments.
$featured_properties_args = array(
	'post_type'      => 'property',
	'posts_per_page' => 12,
	'meta_query'     => array(
		array(
			'key'     => 'REAL_HOMES_featured',
			'value'   => 1,
			'compare' => '=',
			'type'    => 'NUMERIC',
		),
	),
);

$featured_properties_query = new WP_Query( $featured_properties_args );
$border_class = get_option( 'inspiry_home_sections_border', 'diagonal-border' );
?>
	<section class="rh_section rh_section--featured <?php echo $border_class . ' ' . $section_margin_top; ?>">

		<?php
		$featured_prop_subtitle = get_option( 'inspiry_featured_prop_sub_title', 'Featured' );
		$featured_prop_title    = get_option( 'theme_featured_prop_title', 'Properties' );
		$featured_prop_text     = get_option( 'theme_featured_prop_text' );

		inspiry_modern_home_heading( $featured_prop_subtitle, $featured_prop_title, $featured_prop_text );


		if ( $featured_properties_query->have_posts() ) :
			?>
			<div id="rh_section__featured_slider" class="rh_section__featured clearfix">

				<div class="flexslider loading">

					<ul class="slides">

						<?php while ( $featured_properties_query->have_posts() ) : ?>

							<?php $featured_properties_query->the_post(); ?>

							<?php get_template_part( 'assets/modern/partials/home/featured-property' ); ?>

						<?php endwhile; ?>

						<?php wp_reset_postdata(); ?>

					</ul>
					<!-- /.slides -->

				</div>
				<!-- /.flexslider loading -->

				<div class="rh_flexslider__nav">
					<a href="#" class="flex-prev rh_flexslider__prev">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-left.svg'; ?>
					</a>
					<!-- /.rh_flexslider__prev -->
					<a href="#" class="flex-next rh_flexslider__next">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-right.svg'; ?>
					</a>
					<!-- /.rh_flexslider__next -->
				</div>
				<!-- /.rh_flexslider__nav -->

			</div>
			<!-- /.rh_section__properties -->

		<?php endif; ?>

	</section>
	<!-- /.rh_section -->

<?php
