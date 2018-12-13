<?php
/**
 * Add to favorites for property detail page.
 *
 * @package    realhomes
 * @subpackage classic
 */

$fav_button = get_option( 'theme_enable_fav_button' );
if ( 'true' === $fav_button ) {
	?>
	<span class="add-to-fav">
	<?php
	$property_id = get_the_ID();
	if ( is_added_to_favorite( $property_id ) ) {
		?>
		<span class="btn-fav favorite-placeholder highlight__red" title="<?php esc_attr_e( 'Added to favorites', 'framework' ); ?>">
			<?php include INSPIRY_THEME_DIR . '/images/icon-favorite.svg'; ?>
		</span>
		<?php
	} else {
		?>
		<form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" class="add-to-favorite-form">
			<input type="hidden" name="property_id" value="<?php echo esc_attr( $property_id ); ?>"/>
			<input type="hidden" name="action" value="add_to_favorite"/>
		</form>

		<span class="btn-fav favorite-placeholder highlight__red hide" title="<?php esc_attr_e( 'Added to favorites', 'framework' ); ?>">
					<?php include INSPIRY_THEME_DIR . '/images/icon-favorite.svg'; ?>
				</span>
		<a href="#" class="btn-fav favorite add-to-favorite" title="<?php esc_attr_e( 'Add to favorite', 'framework' ); ?>">
			<?php include INSPIRY_THEME_DIR . '/images/icon-favorite.svg'; ?>
		</a>

		<?php
	}
	?>
    </span>
	<?php
}
