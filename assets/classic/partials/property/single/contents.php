<?php
/**
 * Single Property Contents
 *
 * @package    realhomes
 * @subpackage classic
 */

?>

<article class="property-item clearfix">
	<div class="wrap clearfix">
		<?php
		$address_display = get_option( 'inspiry_display_property_address', 'true' );
		if ( 'true' === $address_display ) {
			?>
			<address class="title">
				<?php
				/* Property Address if exists */
				$property_address = get_post_meta( $post->ID, 'REAL_HOMES_property_address', true );
				if ( ! empty( $property_address ) ) {
					echo esc_html( $property_address );
				}
				?>
			</address>
			<?php
		}

		$status_terms = get_the_terms( $post->ID, 'property-status' );
		$type_terms = get_the_terms( get_the_ID(), "property-type" );
		$property_price = get_property_price();
		if ( ! empty( $status_terms )||
		     ! empty( $property_price ) ||
		     ( $type_terms )
		) {
			?>
			<h5 class="price">

				<?php
				if ( ! empty( $status_terms ) ) {
					$margin_left_none = '';
				if ( empty( $property_price ) && !( $type_terms ) ) {
					$margin_left_none = 'margin-right-0';
				}
					?>
					<span class="status-label <?php echo $margin_left_none;?>">
				<i class="tag-arrow">
					<?php include INSPIRY_THEME_DIR . '/images/arrow.svg'; ?>
				</i>
						<?php

						/* Property Status. For example: For Sale, For Rent */

						$status_count = 0;
						foreach ( $status_terms as $term ) {
							if ( $status_count > 0 ) {
								echo ', ';
							}
							echo esc_html( $term->name );
							$status_count ++;
						}

						?>
				</span>
					<?php
				}


				if ( ! empty( $property_price ) || ( $type_terms ) ) {

					?>

					<span class="price-and-type">
					<i class="tag-arrow">
						<?php include INSPIRY_THEME_DIR . '/images/arrow.svg'; ?>
					</i>
						<?php
						/* Property Price */
						property_price();


						/* Property Type. For example: Villa, Single Family Home */
						echo inspiry_get_property_types( $post->ID );
						?>
			</span>
					<?php
				}
				?>
			</h5>
			<?php
		}
		?>
	</div>

	<div class="property-meta clearfix">
		<?php
		// Property meta.
		get_template_part( 'assets/classic/partials/property/single/metas' );
		?>
	</div>

	<div class="content clearfix">
		<?php
		// Contents from WordPress editor.
		the_content();

		// Property additional details from meta boxes.
		get_template_part( 'assets/classic/partials/property/single/additional-details' );

		// Common note from theme options.
		get_template_part( 'assets/classic/partials/property/single/common-note' );
		?>
	</div>


	<?php
	/* Property Features */
	$features_terms = get_the_terms( $post->ID, 'property-feature' );
	if ( ! empty( $features_terms ) ) {
		?>
		<div class="features">
			<?php
			$property_features_title = get_option( 'theme_property_features_title' );
			if ( ! empty( $property_features_title ) ) {
				?><h4 class="title"><?php echo esc_html( $property_features_title ); ?></h4><?php
			}
			?>
			<ul class="arrow-bullet-list clearfix">
				<?php
				foreach ( $features_terms as $fet_trms ) {
					echo '<li id="rh_property__feature_' . esc_attr( $fet_trms->term_id ) . '"><a href="' . esc_url( get_term_link( $fet_trms->slug, 'property-feature' ) ) . '">' . esc_html( $fet_trms->name ) . '</a></li>';
				}
				?>
			</ul>
		</div>
		<?php
	}

	if( inspiry_is_rvr_enabled() ) {

		/* Outdoor Features */
		$outdoor_features = get_post_meta( $post->ID, 'rvr_features', true );
		if ( ! empty( $outdoor_features ) ) {
			?>
			<div class="features nolink-list">
				<h4 class="title"><?php esc_html_e( 'Outdoor Features', 'framework' ); ?></h4>
				<ul class="arrow-bullet-list clearfix">
					<?php
						foreach ( $outdoor_features as $outdoor_feature ) {
							echo '<li>' . esc_html( $outdoor_feature ) . '</li>';
						}
					?>
				</ul>
			</div>
			<?php
		}

		/* Optional Services */
		$services_inc = get_post_meta( $post->ID, 'rvr_services_inc', true );
		$services_not_inc = get_post_meta( $post->ID, 'rvr_services_not_inc', true );
		if ( ! empty( $services_inc ) || ! empty( $services_not_inc ) ) {
			?>
			<div class="features nolink-list">
				<h4 class="title"><?php esc_html_e( 'Optional Services', 'framework' ); ?></h4>
				<?php

					if( ! empty( $services_inc ) ) {
						?>
						<h5><?php esc_html_e('Included', 'framework'); ?></h5>
						<ul class="arrow-bullet-list clearfix">
							<?php
								foreach ( $services_inc as $service_inc ) {
									echo '<li>' . esc_html( $service_inc ) . '</li>';
								}
							?>
						</ul>
						<?php
					}

					if( ! empty( $services_not_inc ) ) {
						?>
						<h5><?php esc_html_e('Not Included', 'framework'); ?></h5>
						<ul class="arrow-bullet-list clearfix">
							<?php
								foreach ( $services_not_inc as $service_not_inc ) {
									echo '<li>' . esc_html( $service_not_inc ) . '</li>';
								}
							?>
						</ul>
						<?php
					}
				?>
			</div>
			<?php
		}

	}
	?>
</article>
