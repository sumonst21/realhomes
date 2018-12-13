<?php
/**
 * Single Blog Page
 *
 * @package    realhomes
 * @subpackage classic
 */

get_header(); ?>

<!-- Page Head -->
<?php get_template_part( 'assets/classic/partials/banners/blog' ); ?>

<!-- Content -->
<div class="container contents single">
	<div class="row">
		<div class="span9 main-wrap">
			<!-- Main Content -->
			<div class="main">

				<div class="inner-wrapper">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();

							$format = get_post_format();
							if ( false === $format ) {
								$format = 'standard';
							}

							?>
							<article <?php post_class(); ?>>
								<header>
									<h3 class="post-title"><?php the_title(); ?></h3>
									<div class="post-meta <?php echo esc_attr( $format ); ?>-meta thumb-<?php echo has_post_thumbnail() ? 'exist' : 'not-exist'; ?>">
										<span> <?php esc_html_e( 'Posted on', 'framework' ); ?> <span class="date"> <?php the_time( get_option( 'date_format' ) ); ?> </span></span>
										<span> <?php esc_html_e( 'by', 'framework' ); ?> <?php the_author(); ?> <?php esc_html_e( 'in', 'framework' ); ?> <?php the_category( ', ' ); ?></span>
									</div>
								</header>
								<?php
								get_template_part( 'assets/classic/partials/blog/post-formats/' . $format );
								the_content();
								?>
								<div class="post-tags clearfix">
									<?php the_tags( '', ' ' ); ?>
								</div>
							</article>
							<?php
							wp_link_pages( array(
								'before'         => '<div class="pages-nav clearfix">',
								'after'          => '</div>',
								'next_or_number' => 'next',
							) );
						endwhile;

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endif;
					?>
				</div>

			</div><!-- End Main Content -->

		</div> <!-- End span9 -->

		<?php get_sidebar(); ?>

	</div><!-- End contents row -->

</div><!-- End Content -->

<?php get_footer(); ?>
