<?php
/**
 * Field: Property Status
 *
 * Property Status field for advance property search.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

?>

<div class="rh_prop_search__option rh_prop_search__select">
	<label for="select-status">
		<?php
		$inspiry_property_status_label = get_option( 'inspiry_property_status_label' );
		echo $inspiry_property_status_label ? esc_html( $inspiry_property_status_label ) : esc_html__( 'Property Status', 'framework' );
		?>
	</label>
	<span class="rh_prop_search__selectwrap">
		<select name="status" id="select-status" class="rh_select2">
			<?php advance_search_options( 'property-status' ); ?>
		</select>
	</span>
</div>
