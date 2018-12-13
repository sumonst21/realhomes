<?php
/**
 * Get Google Fonts list
 *
 * @return array Google fonts list
 */
function inspiry_get_google_fonts_list() {

	$inspiry_google_fonts_list = array();

	ob_start();
	include INSPIRY_FRAMEWORK . 'customizer/google-fonts/google-web-fonts.json';
	$fonts = ob_get_contents();
	ob_end_clean();

	if ( $fonts ) {
		$fonts = json_decode( $fonts, true );
		foreach ( $fonts[ 'items' ] as $font ) {
			if ( isset( $font[ 'family' ] ) ) {
				$inspiry_google_fonts_list[ $font[ 'family' ] ] = $font[ 'family' ];
			}
		}
		ksort( $inspiry_google_fonts_list, SORT_STRING );
	}

	return array( 'Default' => __( 'Theme Default Font', 'framework' ) ) + $inspiry_google_fonts_list;
}