<?php
/**
 * Template Name: Membership Plans
 *
 * @since   3.0.0
 * @package realhomes
 */

if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
	wp_safe_redirect( home_url() );
	exit();
} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
	get_template_part( 'assets/' . INSPIRY_DESIGN_VARIATION . '/partials/page/membership' );
}
