<?php
/**
 * Compare: Compare Button
 *
 * Add to compare button for properties.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

?>

<span class="add-to-compare-span">
	<?php
	$property_id = get_the_ID();
	if ( inspiry_is_added_to_compare( $property_id ) ) {
		?>
		<span class="compare-placeholder highlight" data-tooltip="<?php esc_attr_e( 'Added to compare', 'framework' ); ?>">
			<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg' ); ?>
		</span>
		<a class="add-to-compare hide" data-tooltip="<?php esc_attr_e( 'Add to compare', 'framework' ); ?>" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
			<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg' ); ?>
		</a>
		<?php
	} else {
		?>
		<span class="compare-placeholder highlight hide" data-tooltip="<?php esc_attr_e( 'Added to compare', 'framework' ); ?>">
			<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg' ); ?>
		</span>
		<a class="add-to-compare" data-tooltip="<?php esc_attr_e( 'Add to compare', 'framework' ); ?>" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
			<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-compare.svg' ); ?>
		</a>
		<?php
	}
	?>
</span>
