<section class="listing-layout">
	<div class="list-container inner-wrapper clearfix">
		<?php
			global $search_query;
			if ( $search_query->have_posts() ) :
				while ( $search_query->have_posts() ) :
					$search_query->the_post();

					get_template_part( 'assets/classic/partials/properties/list-card' );

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
</section>