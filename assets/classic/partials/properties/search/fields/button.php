<?php
/**
 * Search Button
 */
?>
<div class="option-bar">
	<?php  $inspiry_search_button_text = get_option('inspiry_search_button_text'); ?>
	<input type="submit" value="<?php echo ($inspiry_search_button_text) ? $inspiry_search_button_text : __('Search', 'framework'); ?>" class="real-btn btn">
</div>