<?php
/**
 * Minimum and Maximum Area Fields
 */
$area_unit = get_option("theme_area_unit");
$min_area_placeholder = get_option('inspiry_min_area_placeholder_text');
$max_area_placeholder = get_option('inspiry_max_area_placeholder_text');
?>
<div class="option-bar small">
	<label for="min-area">
		<?php
        $inspiry_min_area_label = get_option("inspiry_min_area_label");
        echo ($inspiry_min_area_label) ? $inspiry_min_area_label : __('Min Area', 'framework');
        ?>
		<span><?php if ($area_unit) {
            echo esc_html("($area_unit)");
        } ?></span>
	</label>
	<input type="text" name="min-area" id="min-area" pattern="[0-9]+"
	       value="<?php echo isset($_GET[ 'min-area' ]) ? $_GET[ 'min-area' ] : ''; ?>"
	       placeholder="<?php echo empty($min_area_placeholder) ? inspiry_any_text() : esc_attr($min_area_placeholder); ?>"
	       title="<?php _e('Only provide digits!', 'framework'); ?>" />
</div>

<div class="option-bar small">
	<label for="max-area">
		<?php
        $inspiry_max_area_label = get_option("inspiry_max_area_label");
        echo ($inspiry_max_area_label) ? $inspiry_max_area_label : __('Max Area', 'framework');
        ?>
		<span><?php if ($area_unit) {
            echo esc_html("($area_unit)");
        } ?></span>
	</label>
	<input type="text" name="max-area" id="max-area" pattern="[0-9]+"
	       value="<?php echo isset($_GET['max-area']) ? $_GET['max-area'] : '' ; ?>"
	       placeholder="<?php echo empty($max_area_placeholder) ? inspiry_any_text() : esc_attr($max_area_placeholder); ?>"
	       title="<?php _e('Only provide digits!', 'framework'); ?>" />
</div>