<?php
/**
 * Content Section of homepage.
 *
 * @package    realhomes
 * @subpackage modern
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

// Home properties.
$inspiry_show_home_properties = get_option( 'theme_show_home_properties', 'true' );
$section_class                = ( 'false' === $inspiry_show_home_properties ) ? 'rh_section--content_padding' : false;

$border_class = get_option( 'inspiry_home_sections_border' );

$flat_border = '';
if($border_class === 'flat-border'){
	$flat_border = 'flat-border';
}


if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		$get_contents = get_the_content();
		if ( ! empty( $get_contents ) ) {
			?>
			<section class="rh_section rh_section__content <?php echo esc_attr( $section_class . ' ' . $flat_border); ?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'rh_content' ); ?>>
					<?php the_content(); ?>
				</article>
			</section>
			<!-- /.rh_section rh_section--props_padding -->
			<?php
		}
	endwhile;
endif;
