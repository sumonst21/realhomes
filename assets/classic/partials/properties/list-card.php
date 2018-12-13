<?php
/**
 * Property card for list layout.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="property-item-wrapper">
	<article <?php post_class( 'property-item clearfix' ); ?>>

		<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>

		<figure>
			<a href="<?php the_permalink() ?>">
				<?php
				global $post;
				if ( has_post_thumbnail( $post->ID ) ) {
					the_post_thumbnail( 'property-thumb-image' );
				} else {
					inspiry_image_placeholder( 'property-thumb-image' );
				}
				?>
			</a>

			<?php
			inspiry_display_property_label( $post->ID );
			display_figcaption( $post->ID );
			?>

		</figure>

		<div class="detail">
			<h5 class="price">
				<?php
				// Price.
				property_price();

				// Property Type. For example: Villa, Single Family Home.
				echo inspiry_get_property_types( $post->ID );
				?>
			</h5>
			<p><?php framework_excerpt( 25 ); ?></p>
			<a class="more-details" href="<?php the_permalink() ?>"><?php esc_html_e( 'More Details ', 'framework' ); ?>
				<i class="fa fa-caret-right"></i></a>
		</div>

		<div class="property-meta">
			<?php
			get_template_part( 'assets/classic/partials/property/single/metas' );

			$compare_properties_module = get_option( 'theme_compare_properties_module' );
			$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
			if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
				get_template_part( 'assets/classic/partials/properties/compare/button' );
			}
			?>
		</div>

	</article>
</div>
