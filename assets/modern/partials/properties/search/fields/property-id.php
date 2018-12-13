<?php
/**
 * Field: Property ID
 *
 * Property ID field for advance property search.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

$inspiry_property_id_label 			= get_option( 'inspiry_property_id_label' );
$inspiry_property_id_placeholder 	= get_option( 'inspiry_property_id_placeholder_text' );
?>
<div class="rh_prop_search__option">
	<label for="property-id-txt">
		<?php echo $inspiry_property_id_label ? esc_html( $inspiry_property_id_label ) : esc_html__( 'Property ID', 'framework' ); ?>
	</label>
	<input type="text" name="property-id" id="property-id-txt"
	       value="<?php echo isset( $_GET['property-id'] ) ? $_GET['property-id'] : ''; ?>"
	       placeholder="<?php echo ! empty( $inspiry_property_id_placeholder ) ? esc_attr( $inspiry_property_id_placeholder ) : esc_html( inspiry_any_text() ); ?>" />
</div>
