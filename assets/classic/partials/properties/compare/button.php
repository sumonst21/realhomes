<?php
/**
 * Compare Button.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>
<div class="add-to-compare-span">
	<?php
	$property_id = get_the_ID();
	if ( inspiry_is_added_to_compare( $property_id ) ) {
		?>
		<div class="compare_output show">
			<i class="fa fa-plus-circle dim"></i>
			<span class="compare_target dim"><?php esc_html_e( 'Added to Compare', 'framework' ); ?></span>
		</div>
		<a class="add-to-compare hide" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
			<i class="fa fa-plus-circle"></i>&nbsp;<?php esc_html_e( 'Add to Compare', 'framework' ); ?>
		</a>
		<?php
	} else {
		?>
		<div class="compare_output">
			<i class="fa fa-plus-circle dim"></i>
			<span class="compare_target dim"></span>
		</div>
		<a class="add-to-compare" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
			<i class="fa fa-plus-circle"></i>&nbsp;<?php esc_html_e( 'Add to Compare', 'framework' ); ?>
		</a>
		<?php
	}
	?>
</div>
