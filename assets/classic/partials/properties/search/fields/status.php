<?php
/**
 * Property Status Field
 */
?>
<div class="option-bar large">
	<label for="select-status">
		<?php
        $inspiry_property_status_label = get_option('inspiry_property_status_label');
        echo ($inspiry_property_status_label) ? $inspiry_property_status_label : __('Property Status', 'framework');
        ?>
	</label>
    <span class="selectwrap">
        <select name="status" id="select-status" class="search-select">
            <?php advance_search_options('property-status'); ?>
        </select>
    </span>
</div>