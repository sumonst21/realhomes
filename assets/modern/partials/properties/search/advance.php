<?php
/**
 * Properties advance search.
 *
 * @package    realhomes
 * @subpackage modern
 */

$show_search = is_page_template( 'templates/home.php' ) ? get_option( 'theme_show_home_search' ) : inspiry_show_header_search_form();

if ( inspiry_is_search_page_configured() && $show_search ) : ?>
	<section class="rh_prop_search rh_wrap--padding">
		<?php get_template_part( 'assets/modern/partials/properties/search/form' ); ?>
	</section>
	<!-- /.rh_prop_search -->
<?php endif; ?>
