<?php
/**
 * Child Property Card
 *
 * Child property card to be displayed on property detail page under children properties.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;
$property_size      = get_post_meta( get_the_ID(), 'REAL_HOMES_property_size', true );
$size_postfix       = get_post_meta( get_the_ID(), 'REAL_HOMES_property_size_postfix', true );
$property_bedrooms  = get_post_meta( get_the_ID(), 'REAL_HOMES_property_bedrooms', true );
$property_bathrooms = get_post_meta( get_the_ID(), 'REAL_HOMES_property_bathrooms', true );
$property_address   = get_post_meta( get_the_ID(), 'REAL_HOMES_property_address', true );

?>

<li <?php post_class( 'rh_prop_card' ); ?>>

	<figure class="rh_prop_card__thumbnail rh_prop_card__child_thumb">
		<a href="<?php the_permalink(); ?>">
			<?php
			if ( has_post_thumbnail( get_the_ID() ) ) {
				the_post_thumbnail( 'modern-property-child-slider' );
			} else {
				inspiry_image_placeholder( 'modern-property-child-slider' );
			}
			?>
		</a>
	</figure>
	<!-- /.rh_prop_card__thumbnail -->

	<div class="rh_prop_card__details rh_prop_card__child_property">

		<h3>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<p class="rh_prop_card__excerpt"><?php framework_excerpt( 15 ); ?></p>
		<!-- /.rh_prop_card__excerpt -->

		<div class="rh_prop_card__meta_wrap">

			<?php if ( ! empty( $property_bedrooms ) ) : ?>
				<div class="rh_prop_card__meta">
					<h4><?php esc_html_e( 'Bedrooms', 'framework' ); ?></h4>
					<div>
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-bed.svg'; ?>
						<!-- <img src="php" alt="" /> -->
						<span class="figure"><?php echo esc_html( $property_bedrooms ); ?></span>
					</div>
				</div>
				<!-- /.rh_prop_card__meta -->
			<?php endif; ?>

			<?php if ( ! empty( $property_bathrooms ) ) : ?>
				<div class="rh_prop_card__meta">
					<h4><?php esc_html_e( 'Bathrooms', 'framework' ); ?></h4>
					<div>
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-shower.svg'; ?>
						<!-- <img src="php" alt="" /> -->
						<span class="figure"><?php echo esc_html( $property_bathrooms ); ?></span>
					</div>
				</div>
				<!-- /.rh_prop_card__meta -->
			<?php endif; ?>

			<?php if ( ! empty( $property_size ) ) : ?>
				<div class="rh_prop_card__meta">
					<h4><?php esc_html_e( 'Area', 'framework' ); ?></h4>
					<div>
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-area.svg'; ?>
						<!-- <img src="php" alt="" /> -->
						<span class="figure">
							<?php echo esc_html( $property_size ); ?>
						</span>
						<?php if ( ! empty( $size_postfix ) ) : ?>
							<span class="label">
								<?php echo esc_html( $size_postfix ); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>
				<!-- /.rh_prop_card__meta -->
			<?php endif; ?>

		</div>
		<!-- /.rh_prop_card__meta_wrap -->

		<div class="rh_prop_card__priceLabel">

			<h4 class="rh_prop_card__status">
				<?php echo esc_html( display_property_status( get_the_ID() ) ); ?>
			</h4>
			<!-- /.rh_prop_card__type -->
			<p class="rh_prop_card__price">
				<?php property_price(); ?>
			</p>
			<!-- /.rh_prop_card__price -->

		</div>
		<!-- /.rh_prop_card__priceLabel -->

	</div>
	<!-- /.rh_prop_card__details -->

</li>
<!-- /.rh_prop_card -->
