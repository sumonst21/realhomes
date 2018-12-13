<?php
/**
 * Sort Controls
 *
 * Properties sort controls.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

?>

<div class="rh_sort_controls">
	<?php
	if ( isset( $_GET['sortby'] ) ) {
	    $sort_by = sanitize_text_field( $_GET['sortby'] );
	} else {
	    if ( is_page_template( array(
		        'templates/list-layout.php',
		        'templates/grid-layout.php',
		        'templates/half-map-layout.php',
		) ) ) {
	        $sort_by = get_post_meta( get_the_ID(), 'inspiry_properties_order', true );
	    } else {
	        $sort_by = get_option( 'theme_listing_default_sort' );
	    }
	}
	?>
	<select name="sort-properties" id="sort-properties" class="rh_select2">
	    <option value="default"><?php esc_html_e( 'Default Order', 'framework' );?></option>
	    <option value="price-asc" <?php echo ( 'price-asc' == $sort_by ) ? 'selected' : '' ; ?>><?php esc_html_e( 'Price Low to High', 'framework' );?></option>
	    <option value="price-desc" <?php echo ( 'price-desc' == $sort_by ) ? 'selected' : '' ; ?>><?php esc_html_e( 'Price High to Low', 'framework' );?></option>
	    <option value="date-asc" <?php echo ( 'date-asc' == $sort_by ) ? 'selected' : '' ; ?>><?php esc_html_e( 'Date Old to New', 'framework' );?></option>
	    <option value="date-desc" <?php echo ( 'date-desc' == $sort_by ) ? 'selected' : '' ; ?>><?php esc_html_e( 'Date New to Old', 'framework' );?></option>
	</select>
</div>
<!-- /.rh_sort_controls -->
