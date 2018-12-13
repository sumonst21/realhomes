<?php
/**
 * Property Card for Grid Layout.
 *
 * @package    realhomes
 * @subpackage classic
 */

global $post;
?>

<article <?php post_class( 'property-item clearfix' ); ?>>

	<figure>
		<a href="<?php the_permalink(); ?>"><?php
			if ( has_post_thumbnail( $post->ID ) ) {
				// Featured image.
				the_post_thumbnail( 'grid-view-image' );
			} else {
				// OR: Placeholder.
				inspiry_image_placeholder( 'grid-view-image' );
			}
			?></a><?php

		// Property Label.
		inspiry_display_property_label( $post->ID );

		// Property Status.
		display_figcaption( $post->ID );
		?>
	</figure>

	<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
	<p><?php framework_excerpt( 9 ); ?>
		<a class="more-details" href="<?php the_permalink() ?>"><?php esc_html_e( 'More Details ', 'framework' ); ?>
			<i class="fa fa-caret-right"></i></a></p>
	<?php

	/*
	 * Property Price.
	 */
	$price = get_property_price();
	if ( $price ) {
		echo '<span>' . esc_html( $price ) . '</span>';
	}

	/*
	 * Compare Button.
	 */
	$compare_properties_module = get_option( 'theme_compare_properties_module' );
	$inspiry_compare_page      = get_option( 'inspiry_compare_page' );
	if ( ( 'enable' === $compare_properties_module ) && ( $inspiry_compare_page ) ) {
		get_template_part( 'assets/classic/partials/properties/compare/button' );
	}
	?>
</article>
