<?php
/**
 * Layout view buttons.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<div class="view-type clearfix">
	<?php
	$page_url = null;
	// Page url.
	if ( is_post_type_archive( 'property' ) ) {
		$page_url = get_post_type_archive_link( 'property' );
	} elseif ( is_tax() ) {
		$page_url = custom_taxonomy_page_url();
	} else {
		global $post;
		$page_url = get_permalink( $post->ID );
	}

	// Separator.
	$separator = ( null == parse_url( $page_url, PHP_URL_QUERY ) ) ? '?' : '&';

	// View Type.
	$view_type = get_option( 'theme_listing_layout', 'list' );

	if ( isset( $_GET['view'] ) ) {
		if ( 'grid' === $_GET['view'] ) {
			$view_type = 'grid';
		}
	} else {
		if ( is_page_template( 'templates/grid-layout.php' ) ) {
			$view_type = 'grid';
		}
		if ( is_page_template( 'templates/list-layout.php' ) ) {
			$view_type = 'list';
		}
	}
	?>
	<a class="list <?php echo ( 'list' === $view_type ) ? 'active' : ''; ?>" href="<?php echo esc_url( $page_url . $separator . 'view=list' ); ?>">
		<?php include INSPIRY_THEME_DIR . '/images/list-view.svg'; ?>
	</a>
	<a class="grid <?php echo ( 'grid' === $view_type ) ? 'active' : ''; ?>" href="<?php echo esc_url( $page_url . $separator . 'view=grid' ); ?>">
		<?php include INSPIRY_THEME_DIR . '/images/grid-view.svg'; ?>
	</a>
</div>
