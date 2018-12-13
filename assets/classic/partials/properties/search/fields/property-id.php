<?php
/**
 * Property ID Field
 */

$inspiry_property_id_label = get_option('inspiry_property_id_label');
$inspiry_property_id_placeholder = get_option('inspiry_property_id_placeholder_text');
?>
<div class="option-bar large">
	<label for="property-id-txt">
		<?php echo ($inspiry_property_id_label) ? $inspiry_property_id_label : __('Property ID', 'framework'); ?>
	</label>
	<input type="text" name="property-id" id="property-id-txt"
	       value="<?php echo isset($_GET[ 'property-id' ]) ? $_GET[ 'property-id' ] : ''; ?>"
	       placeholder="<?php echo !empty($inspiry_property_id_placeholder) ? esc_attr($inspiry_property_id_placeholder) : inspiry_any_text() ; ?>" />
</div>
