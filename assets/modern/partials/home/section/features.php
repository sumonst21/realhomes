<?php
/**
 * Features section of the homepage.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;
$inspiry_features = get_post_meta( get_the_ID(), 'inspiry_features', true );
$border_class     = get_option( 'inspiry_home_sections_border', 'diagonal-border' );
?>

<section class="rh_section rh_section__features <?php echo $border_class; ?>">

	<?php
	$inspiry_home_features_subtitle = get_option( 'inspiry_home_features_sub_title' );
	$inspiry_home_features_title    = get_option( 'inspiry_home_features_title' );
	$inspiry_home_features_desc     = get_option( 'inspiry_home_features_desc' );
	inspiry_modern_home_heading( $inspiry_home_features_subtitle, $inspiry_home_features_title, $inspiry_home_features_desc );
	?>

	<?php if ( ! empty( $inspiry_features ) ) : ?>

		<div class="rh_section__features_wrap">

			<?php foreach ( $inspiry_features as $inspiry_feature => $feature ) : ?>
				<div class="rh_feature">
					<?php
					$icon_id       = $feature['inspiry_feature_icon'][0];
					$feature_title = ( isset( $feature['inspiry_feature_name'] ) ) ? $feature['inspiry_feature_name'] : false;
					$feature_url   = ( isset( $feature['inspiry_feature_link'] ) ) ? $feature['inspiry_feature_link'] : false;
					$feature_desc  = ( isset( $feature['inspiry_feature_desc'] ) ) ? $feature['inspiry_feature_desc'] : false;
					if ( $icon_id ) {
						$icon_url = wp_get_attachment_image_url( $icon_id, 'full' );
						if ( $icon_url && ! empty( $feature_url ) ) {
							?>
							<a href="<?php echo esc_url( $feature_url ); ?>" class="rh_feature__icon">
								<img src="<?php echo esc_url( $icon_url ); ?>" alt="">
							</a>
							<!-- /.rh_feature__icon -->
							<?php
						} elseif ( $icon_url && empty( $feature_url ) ) {
							?>
							<div class="rh_feature__icon">
								<img src="<?php echo esc_url( $icon_url ); ?>" alt="">
							</div>
							<!-- /.rh_feature__icon -->
							<?php
						}
					}
					?>
					<?php if ( ! empty( $feature_title ) && ! empty( $feature_url ) ) : ?>
						<h4 class="rh_feature__title">
							<a href="<?php echo esc_url( $feature_url ); ?>">
								<?php echo esc_html( $feature_title ); ?>
							</a>
						</h4>
						<!-- /.rh_feature__title -->
					<?php elseif ( ! empty( $feature_title ) && empty( $feature_url ) ) : ?>
						<h4 class="rh_feature__title"><?php echo esc_html( $feature_title ); ?></h4>
						<!-- /.rh_feature__title -->
					<?php endif; ?>

					<?php if ( ! empty( $feature_desc ) ) : ?>
						<div class="rh_feature__desc">
							<p><?php echo esc_html( $feature_desc ); ?></p>
						</div>
						<!-- /.rh_feature__desc -->
					<?php endif; ?>
				</div>
				<!-- /.rh_feature -->
			<?php endforeach; ?>

		</div>
		<!-- /.rh_section__features_wrap -->

	<?php endif; ?>

</section>
<!-- /.rh_section rh_section__features -->
