<?php
/**
 * Image post format.
 *
 * @package    realhomes
 * @subpackage modern
 */

if ( has_post_thumbnail() ) { ?>
	<figure>
		<?php
		if ( is_single() ) {
			$image_id  = get_post_thumbnail_id();
			$image_url = wp_get_attachment_url( $image_id );
			?>
			<a href="<?php echo esc_url( $image_url ); ?>" class="<?php echo esc_attr( get_lightbox_plugin_class() ); ?>" title="<?php the_title(); ?>">
			<?php
		} else {
			?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php
		}
		the_post_thumbnail( 'post-featured-image' );
		?>
		</a>
	</figure>
	<?php
} else {
	?>
	<p></p>
	<?php
}
