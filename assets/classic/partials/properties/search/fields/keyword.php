<?php
/**
 * Keyword Search Field
 */

$inspiry_keyword_label = get_option('inspiry_keyword_label');
$inspiry_keyword_placeholder = get_option('inspiry_keyword_placeholder_text')
?>
<div class="option-bar large">
	<label for="keyword-txt">
		<?php echo ($inspiry_keyword_label) ? $inspiry_keyword_label : __('Keyword', 'framework'); ?>
	</label>
	<input type="text" name="keyword" id="keyword-txt"
	       value="<?php echo isset($_GET[ 'keyword' ]) ? $_GET[ 'keyword' ] : ''; ?>"
	       placeholder="<?php echo !empty($inspiry_keyword_placeholder) ? esc_attr($inspiry_keyword_placeholder) : inspiry_any_text() ; ?>"/>
</div>