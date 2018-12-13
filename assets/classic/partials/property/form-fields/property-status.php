<div class="form-option property-status-field-wrapper">
	<label for="status"><?php _e('Status', 'framework'); ?></label>
    <span class="selectwrap">
        <select name="status" id="status" class="search-select">
	        <?php
            if (inspiry_is_edit_property()) {
                global $target_property;
                edit_form_taxonomy_options($target_property->ID, 'property-status');
            } else {
                ?>
		        <option selected="selected" value="-1"><?php _e('None', 'framework'); ?></option>
		        <?php
                /*
                 * Property Status Terms
                 */
                $property_status_terms = get_terms(array(
                        'taxonomy'   => "property-status",
                        'orderby'    => 'name',
                        'order'      => 'ASC',
                        'hide_empty' => false
                    )
                );

                if (! empty($property_status_terms)) {
                    foreach ($property_status_terms as $property_status) {
                        echo '<option value="' . $property_status->term_id . '">' . $property_status->name . '</option>';
                    }
                }
            }
            ?>
        </select>
    </span>
</div>
