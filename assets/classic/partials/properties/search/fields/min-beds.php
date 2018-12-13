<?php
/**
 * Minimum Beds Field
 */
?>
<div class="option-bar small">
	<label for="select-bedrooms">
		<?php
        $inspiry_min_beds_label = get_option('inspiry_min_beds_label');
        echo ($inspiry_min_beds_label) ? $inspiry_min_beds_label :__('Min Beds', 'framework');
        ?>
	</label>
    <span class="selectwrap">
        <select name="bedrooms" id="select-bedrooms" class="search-select">
            <?php inspiry_min_beds(); ?>
        </select>
    </span>
</div>