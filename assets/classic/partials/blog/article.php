<?php
/**
 * Blog Article
 *
 * Article on the main blog loop.
 *
 * @package    realhomes
 * @subpackage classic
 */

global $post;
$format = get_post_format();
if ( false === $format ) {
	$format = 'standard';
}
?>

<article <?php post_class(); ?>>
	<header>
		<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="post-meta <?php echo esc_attr( $format ); ?>-meta thumb-<?php echo has_post_thumbnail() ? 'exist' : 'not-exist'; ?>">
			<span><?php esc_html_e( 'Posted on', 'framework' ); ?> <span class="date"> <?php the_time( get_option( 'date_format' ) ); ?></span></span>
			<span><?php esc_html_e( 'by', 'framework' ); ?> <span class="author-link"><?php the_author() ?></span> <?php esc_html_e( 'in', 'framework' ); ?> <?php the_category( ', ' ); ?> </span>
		</div>
	</header>
	<?php get_template_part( "assets/classic/partials/blog/post-formats/$format" ); ?>
	<p><?php framework_excerpt( 40 ); ?></p>
	<a class="real-btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'framework' ); ?></a>
</article>
