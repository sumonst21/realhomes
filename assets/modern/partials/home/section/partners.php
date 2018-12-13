<?php
/**
 * Partners section of the homepage.
 *
 * @package    realhomes
 * @subpackage modern
 */

$number_of_partners = 6;

if ( is_front_page() ) {
	$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
}

$partners_args = array(
	'post_type'      => 'partners',
	'posts_per_page' => $number_of_partners,
	'paged'          => $paged,
);

$home_partners_query = new WP_Query( $partners_args );

$border_class = get_option( 'inspiry_home_sections_border', 'diagonal-border' );
?>

<section class="rh_section rh_section__partners <?php echo $border_class; ?>">

<?php
	$inspiry_home_partners_subtitle = get_option( 'inspiry_home_partners_sub_title', 'Our' );
	$inspiry_home_partners_title    = get_option( 'inspiry_home_partners_title', 'Partners' );
	$inspiry_home_partners_desc     = get_option( 'inspiry_home_partners_desc' );

	inspiry_modern_home_heading( $inspiry_home_partners_subtitle, $inspiry_home_partners_title, $inspiry_home_partners_desc );

	if ( $home_partners_query->have_posts() ) :
		?>
		<div class="rh_section__partners_wrap">

			<?php while ( $home_partners_query->have_posts() ) : ?>

				<?php $home_partners_query->the_post(); ?>

				<div <?php post_class( 'rh_partner' ); ?>>
					<?php $partner_url = get_post_meta( get_the_ID(), 'REAL_HOMES_partner_url', true ); ?>
					<a target="_blank" href="<?php echo esc_url( $partner_url ); ?>" title="<?php the_title(); ?>">
						<?php
							$thumb_title = trim( strip_tags( get_the_title( get_the_ID() ) ) );
							the_post_thumbnail(
								'partners-logo', array(
									'alt'   => $thumb_title,
									'title' => $thumb_title,
								)
							);
						?>
					</a>
				</div>				<!-- /.rh_partner -->

			<?php endwhile; ?>

		</div>		<!-- /.rh_section__partners_wrap -->

	<?php endif; ?>

</section><!-- /.rh_section rh_section__partners -->
