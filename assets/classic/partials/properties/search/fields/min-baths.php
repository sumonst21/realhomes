<?php
/**
 * Minimum Baths Field
 */
?>
<div class="option-bar small">
	<label for="select-bathrooms">
		<?php
        $inspiry_min_baths_label = get_option('inspiry_min_baths_label');
        echo ($inspiry_min_baths_label) ? $inspiry_min_baths_label : __('Min Baths', 'framework');
        ?>
	</label>
    <span class="selectwrap">
        <select name="bathrooms" id="select-bathrooms" class="search-select">
            <?php inspiry_min_baths(); ?>
        </select>
    </span>
</div>