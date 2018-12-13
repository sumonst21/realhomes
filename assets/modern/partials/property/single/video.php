<?php
/**
 * Video of the single property.
 *
 * @package    realhomes
 * @subpackage modern
 */

$display_video = get_option( 'theme_display_video' );
if ( 'true' === $display_video ) {
	$tour_video_url       = get_post_meta( get_the_ID(), 'REAL_HOMES_tour_video_url', true );
	$tour_video_image_id  = get_post_meta( get_the_ID(), 'REAL_HOMES_tour_video_image', true );
	$tour_video_image_src = wp_get_attachment_image_src( $tour_video_image_id, 'property-detail-video-image' );
	$tour_video_image     = $tour_video_image_src[0];

	if ( ! empty( $tour_video_image ) && ! empty( $tour_video_url ) ) {
		?>
		<div class="rh_property__video">
			<?php
			$property_video_title = get_option( 'theme_property_video_title' );
			if ( ! empty( $property_video_title ) ) {
				?><h4 class="rh_property__heading"><?php echo esc_html( $property_video_title ); ?></h4><?php
			}
			?>
			<a href="<?php echo esc_url( $tour_video_url ); ?>" class="pretty-photo">
				<div class="play-btn"></div>
				<?php echo '<img src="' . esc_url( $tour_video_image ) . '" alt="' . get_the_title( get_the_ID() ) . '">'; ?>
			</a>
		</div>
		<?php
	}
}
