<div class="form-option features-fields-wrapper">
	<label><?php _e('Features', 'framework'); ?></label>
	<ul class="features-checkboxes clearfix">
		<?php
        /*
         * Existing features of a property
         */
        $property_features_ids = array();
        if (inspiry_is_edit_property()) {
            global $target_property;
            $features_terms = get_the_terms($target_property->ID, "property-feature");
            if (! empty($features_terms)) {
                foreach ($features_terms as $fet_trms) {
                    $property_features_ids[] = $fet_trms->term_id;
                }
            }
        }

        /* Property Features Query */
        $features_terms = get_terms(array(
                'taxonomy'   => "property-feature",
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => false
            )
        );

        if (! empty($features_terms)) {
            $feature_count = 1;
            foreach ($features_terms as $feature) {
                echo '<li>';
                if (inspiry_is_edit_property() && in_array($feature->term_id, $property_features_ids)) {
                    echo '<input type="checkbox" name="features[]" id="feature-' . $feature_count . '" value="' . $feature->term_id . '" checked />';
                } else {
                    echo '<input type="checkbox" name="features[]" id="feature-' . $feature_count . '" value="' . $feature->term_id . '" />';
                }
                echo '<label for="feature-' . $feature_count . '">' . $feature->name . '</label>';
                echo '</li>';
                $feature_count ++;
            }
        }
        ?>
	</ul>
</div>

