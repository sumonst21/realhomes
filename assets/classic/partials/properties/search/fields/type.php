<?php
/**
 * Property Types Field
 */
?>
<div class="option-bar large">
	<label for="select-property-type">
		<?php
        $inspiry_property_type_label = get_option('inspiry_property_type_label');
        echo ($inspiry_property_type_label) ? $inspiry_property_type_label : __('Property Type', 'framework');
        ?>
	</label>
    <span class="selectwrap">
        <select name="type" id="select-property-type" class="search-select">
	        <?php advance_hierarchical_options('property-type'); ?>
        </select>
    </span>
</div>