<?php
/**
 * Field: Gallery
 *
 * @since 	3.0.0
 * @package RH/modern
 */

global $column_class;

?>

<div class="rh_form__item <?php echo esc_attr( $column_class ); ?> rh_form--columnAlign images-field-wrapper">
	<?php
	if ( inspiry_is_edit_property() ) {
	    global $target_property; ?>
		<div id="gallery-thumbs-container" class="clearfix">
			<?php
	        $thumbnail_size = 'thumbnail';
		    $properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size=' . $thumbnail_size, $target_property->ID );
		    $featured_image_id = get_post_thumbnail_id( $target_property->ID );
		    if ( ! empty( $properties_images ) ) {
		        foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
		            $is_featured_image 	= ( $featured_image_id == $prop_image_id );
		            $featured_icon 		= ( $is_featured_image ) ? 'fa-star' : 'fa-star-o';
		            echo '<div class="gallery-thumb">';
		            echo '<img src="' . esc_url( $prop_image_meta['url'] ) . '" alt="' . esc_attr( $prop_image_meta['title'] ) . '" />';
		            echo '<a class="remove-image" data-property-id="' . esc_attr( $target_property->ID ) . '" data-attachment-id="' . esc_attr( $prop_image_id ) . '" href="#remove-image" ><i class="fa fa-trash-o"></i></a>';
		            echo '<a class="mark-featured" data-property-id="' . esc_attr( $target_property->ID ) . '" data-attachment-id="' . esc_attr( $prop_image_id ) . '" href="#mark-featured" ><i class="fa ' . esc_attr( $featured_icon ) . '"></i></a>';
		            echo '<span class="loader"><i class="fa fa-spinner fa-spin"></i></span>';
		            echo '<input type="hidden" class="gallery-image-id" name="gallery_image_ids[]" value="' . esc_attr( $prop_image_id ) . '"/>';
		            if ( $is_featured_image ) {
		                echo '<input type="hidden" class="featured-img-id" name="featured_image_id" value="' . esc_attr( $prop_image_id ) . '"/>';
		            }
		            echo '</div>';
		        }
		    } ?>
		</div>
		<?php

	} else {
	    ?>
		<div id="gallery-thumbs-container" class="clearfix"></div>
		<?php

	}
	?>

	<div id="drag-and-drop">
		<div class="drag-drop-msg"><i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;<?php esc_html_e( 'Drag and drop images here', 'framework' ); ?></div>
		<div class="drag-or"><?php esc_html_e( 'or', 'framework' ); ?></div>
		<div class="drag-btn">
			<button id="select-images"  class="rh_btn rh_btn--secondary">
				<?php esc_html_e( 'Browse Images', 'framework' ); ?>
			</button>
		</div>
	</div>
	<div class="field-description">
		<span class="note"><?php esc_html_e( 'Note: ', 'framework' ); ?></span>
		<span>
			<?php esc_html_e( 'An image should have minimum width of 980px and minimum height of 735px (4:3 or 16:9 Aspect Ratio).', 'framework' ); ?><br/>
			<?php esc_html_e( 'You can mark an image as featured by clicking the star icon, otherwise first image will be considered featured image.', 'framework' ); ?>
		</span>
	</div>
	<div id="errors-log"></div>
</div>
<!-- /.rh_form__item -->
