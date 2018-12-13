<?php
/**
 * Advance Search Button
 *
 * Advance property submit search button.
 *
 * @since    3.0.0
 * @package RH/modern
 */

?>

<div class="rh_prop_search__btnWrap clearfix">

	<div class="rh_prop_search__advance">
		<a href="#" id="rh_prop_search__advance">
			<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-search-plus.svg' ); ?>
		</a>

		<?php
		$inspiry_enable_search_label_image = get_option( 'inspiry_enable_search_label_image', 'true' );
		$inspiry_search_label_text         = get_theme_mod( 'inspiry_search_label_text','Advance Search' );

		if ( ( $inspiry_enable_search_label_image == 'true' ) && ( ! empty( $inspiry_search_label_text ) ) ) {
			?>
			<span class="advance-search-arrow">
			<span class="arrow-inner">
				<span><?php esc_html_e( $inspiry_search_label_text ); ?></span>
				<?php include INSPIRY_THEME_DIR . '/images/icons/advance-search-arrow.svg'; ?>
			</span>
		</span>
			<?php
		}
		?>

	</div>
	<div class="rh_prop_search__searchBtn">
		<?php $inspiry_search_button_text = get_option( 'inspiry_search_button_text' ); ?>
		<button class="rh_btn rh_btn__prop_search" type="submit">
			<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-search.svg' ); ?>
			<span>
				<?php echo $inspiry_search_button_text ? esc_html( $inspiry_search_button_text ) : esc_html__( 'Search', 'framework' ); ?>
			</span>
		</button>
	</div>

</div>
<!-- /.rh_prop_search__btnWrap -->
