<?php
/**
 * Single Property: Additional Details
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;

$additional_details = get_post_meta( get_the_ID(), 'REAL_HOMES_additional_details', true );

if ( ! empty( $additional_details ) ) {
	$additional_details = array_filter( $additional_details ); // Remove empty values.
}

if ( ! empty( $additional_details ) ) {    // Re-check.

	$additional_details_title = get_option( 'theme_additional_details_title' );
	if ( ! empty( $additional_details_title ) ) {
		echo '<h4 class="rh_property__heading rh_property__additional_details">' . esc_html( $additional_details_title ) . '</h4>';
	}

	echo '<ul class="rh_property__additional clearfix">';
	foreach ( $additional_details as $title => $value ) {
		?>
		<li>
			<span class="title"><?php echo esc_html( $title ); ?>:</span>
			<span class="value"><?php echo esc_html( $value ); ?></span>
		</li>
		<?php
	}
	echo '</ul>';

} else {
	// Support for old approach.
	$detail_titles = get_post_meta( get_the_ID(), 'REAL_HOMES_detail_titles', true );

	if ( ! empty( $detail_titles ) ) {

		$detail_values = get_post_meta( get_the_ID(), 'REAL_HOMES_detail_values', true );

		if ( ! empty( $detail_values ) ) {

			$details = array_combine( $detail_titles, $detail_values );

			$additional_details_title = get_option( 'theme_additional_details_title' );
			if ( ! empty( $additional_details_title ) ) {
				echo '<h4 class="rh_property__heading">' . esc_html( $additional_details_title ) . '</h4>';
			}

			echo '<ul class="rh_property__additional clearfix">';
			foreach ( $details as $title => $value ) {
				?>
				<li>
					<span class="title"><?php echo esc_html( $title ); ?>:</span>
					<span class="value"><?php echo esc_html( $value ); ?></span>
				</li>
				<?php
			}
			echo '</ul>';

		}
	}
}
