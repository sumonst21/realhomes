<div class="property-items-container clearfix">
	<?php
		global $search_query;
		if ( $search_query->have_posts() ) :
			$post_count = 0;
			while ( $search_query->have_posts() ) :
				$search_query->the_post();

				/* Display Property for Search Page */
				get_template_part( 'assets/classic/partials/properties/search/search-card' );

				$post_count++;
				if ( 0 === ( $post_count % 2 ) ) {
					echo '<div class="clearfix"></div>';
				}
			endwhile;
			wp_reset_postdata();
		else :
			?>
			<div class="alert-wrapper">
				<h4><?php esc_html_e( 'No Property Found!', 'framework' ); ?></h4>
			</div>
			<?php
		endif;
	?>
</div>