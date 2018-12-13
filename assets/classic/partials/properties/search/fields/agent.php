<?php
/**
 * Agents Field
 */
?>
<div class="option-bar large">
	<label for="select-agent">
		<?php
			$inspiry_search_field_label = get_option( 'inspiry_agent_label' );
			echo ( $inspiry_search_field_label ) ? $inspiry_search_field_label : esc_html__( 'Agent', 'framework' );
		?>
	</label>
	<span class="selectwrap">
    <select name="agents" id="select-agent" class="search-select">
        <?php inspiry_agents_in_search(); ?>
    </select>
</span>
</div>