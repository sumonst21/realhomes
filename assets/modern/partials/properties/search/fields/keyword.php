<?php
/**
 * Field: Keyword
 *
 * Keyword field for advance property search.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

$inspiry_keyword_label 			= get_option( 'inspiry_keyword_label' );
$inspiry_keyword_placeholder 	= get_option( 'inspiry_keyword_placeholder_text' )
?>
<div class="rh_prop_search__option">
	<label for="keyword-txt">
		<?php echo $inspiry_keyword_label ? esc_html( $inspiry_keyword_label ) : esc_html__( 'Keyword', 'framework' ); ?>
	</label>
	<input type="text" name="keyword" id="keyword-txt"
	       value="<?php echo isset( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>"
	       placeholder="<?php echo ! empty( $inspiry_keyword_placeholder ) ? esc_attr( $inspiry_keyword_placeholder ) : esc_attr( inspiry_any_text() ); ?>"/>
</div>
