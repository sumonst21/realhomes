<?php
/**
 * Properties Gallery
 *
 * @package    realhomes
 * @subpackage classic
 */

get_header();

// Page Head.
get_template_part( 'assets/classic/partials/banners/gallery' ); ?>

<!-- Content -->
<div class="container contents listing-grid-layout">

	<div class="row">

		<div class="span12 main-wrap">

			<!-- Main Content -->
			<div class="main">

				<section class="listing-layout">

					<?php
					$title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
					if ( 'hide' !== $title_display ) {
						?>
						<h3 class="title-heading"><?php the_title(); ?></h3>
						<?php
					}
					?>

					<!-- Gallery Filter -->
					<div id="filter-by" class="clearfix">
						<a href="#" data-filter="gallery-item" class="active"><?php esc_html_e( 'All', 'framework' ); ?></a><?php
						$status_terms = get_terms( array( 'taxonomy' => 'property-status' ) );
						if ( ! empty( $status_terms ) && is_array( $status_terms ) ) {
							foreach ( $status_terms as $status_term ) {
								echo '<a href="' . get_term_link( $status_term->slug, $status_term->taxonomy ) . '" data-filter="' . $status_term->slug . '" title="' . sprintf( __( 'View all Properties having %s status', 'framework' ), $status_term->name ) . '">' . $status_term->name . '</a>';
							}
						}
						?>
					</div>

					<!-- Gallery Container -->
					<div id="gallery-container" class="inner-wrapper">

						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();

								$content = get_the_content();
								if ( ! empty( $content ) ) {
									?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
										<?php the_content(); ?>
									</article>
									<?php
								}
							endwhile;
						endif;
						?>

						<div class="<?php global $gallery_name; echo esc_attr( $gallery_name ); ?> isotope clearfix">
							<?php
							global $paged;
							if ( is_front_page() ) {
								$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
							}

							// Gallery Query.
							$gallery_listing_args = array(
								'post_type' => 'property',
								'paged'     => $paged,
							);

							/**
							 * Gallery Property Arguments Filter.
							 *
							 * @var array
							 */
							$gallery_listing_args = apply_filters( 'inspiry_gallery_properties_filter', $gallery_listing_args );

							// Gallery Query and Start of Loop.
							$gallery_query = new WP_Query( $gallery_listing_args );
							while ( $gallery_query->have_posts() ) :
								$gallery_query->the_post();

								// Getting list of property status terms.
								$term_list = '';
								$terms     = get_the_terms( $post->ID, 'property-status' );
								if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
									foreach ( $terms as $term ) {
										$term_list .= $term->slug;
										$term_list .= ' ';
									}
								endif;

								if ( has_post_thumbnail() ) : ?>
									<div <?php post_class( "gallery-item isotope-item $term_list" ); ?> >
										<?php
										$image_id       = get_post_thumbnail_id();
										$full_image_url = wp_get_attachment_url( $image_id );
										global $gallery_image_size;
										$featured_image = wp_get_attachment_image_src( $image_id, $gallery_image_size );
										?>
										<figure>
											<div class="media_container">
												<a class="<?php echo get_lightbox_plugin_class(); ?> zoom" <?php echo generate_gallery_attribute(); ?> href="<?php echo esc_url( $full_image_url ); ?>" title="<?php the_title(); ?>">
													<?php include INSPIRY_THEME_DIR . '/images/icon-zoom.svg'; ?>
												</a>
												<a class="link" href="<?php the_permalink(); ?>">
													<?php include INSPIRY_THEME_DIR . '/images/icon-link.svg'; ?>
												</a>
											</div>
											<?php echo '<img class="img-border" src="' . esc_attr( $featured_image[0] ) . '" alt="' . get_the_title() . '">'; ?>
										</figure>
										<h5 class="item-title entry-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
										<time class="updated hide" datetime="<?php the_modified_time( 'c' ); ?>"><?php the_modified_time( 'M d, Y' ); ?></time>
										<span class="vcard hide">
											<?php
											printf(
												'<a class="url fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
												esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
												esc_attr( sprintf( __( 'View all posts by %s', 'framework' ), get_the_author() ) ),
												get_the_author()
											);
											?>
										</span>
									</div>
									<?php
								endif;

							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
					<!-- end of gallery container -->

					<?php theme_pagination( $gallery_query->max_num_pages ); ?>

				</section>

			</div><!-- End Main Content -->

		</div> <!-- End span12 -->

	</div><!-- End contents row -->

</div><!-- End Content -->

<?php get_footer(); ?>
