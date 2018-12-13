<?php
/**
 * Blog Loop File
 *
 * Loop file of blog.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

if ( have_posts() ) : ?>

	<div class="rh_blog rh_blog__listing">

		<?php
		while ( have_posts() ) :
		    the_post();

			$format = get_post_format( get_the_ID() );
	        if ( false === $format ) {
	            $format = 'standard';
	        }

	        // Header margin fix in case of no thumbnail for a blog post.
	        $article_classes = 'rh_blog__post rh_blog--index';
	        if ( ! has_post_thumbnail() ) {
	            $article_classes .= ' entry-header-margin-fix';
	        }
	        ?>
	        <article id="post-<?php the_ID(); ?>" <?php post_class( $article_classes ); ?> >

	            <?php
	            // Image, gallery or video based on format.
	            if ( in_array( $format, array( 'standard', 'image', 'gallery', 'video' ), true ) ) :
	                get_template_part( 'assets/modern/partials/blog/post-formats/' . $format );
	            endif;
	            ?>

	            <div class="entry-header blog-post-entry-header">
	                <?php
	                // Post title.
	                get_template_part( 'assets/modern/partials/blog/post/title' );

	                // Post meta.
	                get_template_part( 'assets/modern/partials/blog/post/meta' );
	                ?>
	            </div>

	            <div class="entry-summary">
	                <?php
	                if ( strpos( get_the_content(), 'more-link' ) === false ) {
	                    the_excerpt();
	                } else {
	                    the_content( '' );
	                }
	                ?>
	                <a href="<?php the_permalink(); ?>" rel="bookmark" class="rh_btn rh_btn--primary read-more"><?php esc_html_e( 'Read More', 'framework' ); ?></a>
	            </div>

	        </article>
	        <?php

		endwhile;
		inspiry_theme_pagination( $wp_query->max_num_pages );
		?>

	</div>
	<!-- /.rh_blog rh_blog__listing -->

	<?php
else :
	?>
	<div class="rh_alert-wrapper">
	    <h4 class="no-results"><?php esc_html_e( 'No Posts Found!', 'framework' ) ?></h4>
	</div>
	<?php
endif;
?>
