<?php
/**
 * Property Card for Homepage Properties.
 *
 * @package    realhomes
 * @subpackage classic
 */
?>
<div class="span6 ">
	<article <?php post_class( 'property-item clearfix' ); ?>>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

		<figure>
			<a href="<?php the_permalink(); ?>">
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
				// price.
				property_price();

				// property types.
				echo inspiry_get_property_types( $post->ID );
				?>
			</h5>
			<p><?php framework_excerpt( 12 ); ?></p>
			<a class="more-details" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More Details ', 'framework' ); ?>
				<i class="fa fa-caret-right"></i></a>
		</div>

		<div class="property-meta">
			<?php get_template_part( 'assets/classic/partials/property/single/metas' ); ?>
		</div>
	</article>
</div>
