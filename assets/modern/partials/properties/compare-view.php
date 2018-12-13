<?php
/**
 * Compare Properties: Container.
 *
 * @since 3.0.0
 * @package RH/modern
 */

$inspiry_compare_page 	= get_option( 'inspiry_compare_page' );
$inspiry_compare_page	= ( ! empty( $inspiry_compare_page ) ) ? $inspiry_compare_page : false;

$compare_page_url		= get_permalink( $inspiry_compare_page );
$compare_page_url		= ( ! empty( $compare_page_url ) ) ? $compare_page_url : false;

if ( isset( $_COOKIE['inspiry_compare'] ) ) {
	$compare_list_items = unserialize( $_COOKIE['inspiry_compare'] );
}

if ( ! empty( $compare_list_items ) ) {
	foreach ( $compare_list_items as $compare_list_item ) {
		$compare_property	= get_post( $compare_list_item );

		if ( ! empty( $compare_property ) ) {
			$thumbnail_id	= get_post_thumbnail_id( $compare_property->ID );
			if ( ! empty( $thumbnail_id ) ) {
				$compare_property_img	= wp_get_attachment_image_src(
					$thumbnail_id, 'property-thumb-image'
				);
				$placeholder = false;
			} else {
				$compare_property_img 	= get_inspiry_image_placeholder( 'property-thumb-image' );
				$placeholder = true;
			}

			$compare_properties[]	= array(
				'ID'	=> $compare_property->ID,
				'title'	=> $compare_property->post_title,
				'img'	=> $compare_property_img,
				'placeholder' => $placeholder,
			);
		}
	}
}

?>

<section class="rh_compare rh_compare__section <?php echo ( is_page_template( 'templates/half-map-layout.php' ) || is_page_template( 'templates/properties-search.php' ) ) ? 'rh_compare--map_variation' : false; ?>">

	<h4 class="title"><?php esc_html_e( 'Compare Properties', 'framework' ); ?></h4>

	<div class="rh_compare__carousel">

		<?php if ( ! empty( $compare_properties ) ) : ?>
			<?php foreach ( $compare_properties as $compare_single_property ) : ?>
				<div class="rh_compare__slide">
					<div class="rh_compare__slide_img">
						<?php if ( isset( $compare_single_property['img'] ) && empty( $compare_single_property['placeholder'] ) ) : ?>
							<img
								src="<?php echo esc_attr( $compare_single_property['img'][0] ); ?>"
								alt="<?php echo esc_attr( $compare_single_property['title'] ); ?>"
								width="<?php echo esc_attr( $compare_single_property['img'][1] ); ?>"
								height="<?php echo esc_attr( $compare_single_property['img'][2] ); ?>"
							>
						<?php else : ?>
							<?php echo $compare_single_property['img']; ?>
						<?php endif; ?>
					</div>
					<a class="rh_compare__remove" data-property-id="<?php echo esc_attr( $compare_single_property['ID'] ); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"><i class="fa fa-close"></i></a>
				</div>
			<?php endforeach; ?>
			<!-- .compare-carousel-slide -->
		<?php endif; ?>

	</div>

	<a href="<?php echo esc_attr( $compare_page_url ); ?>" class="rh_compare__submit rh_btn rh_btn--primary"><?php esc_html_e( 'Compare', 'framework' ); ?></a>
	<!-- .compare-submit -->

</section>
<!-- .rh_compare_section -->
