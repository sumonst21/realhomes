<?php
/**
 * Similar property card.
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
$is_featured        = get_post_meta( get_the_ID(), 'REAL_HOMES_featured', true );

?>

<article <?php post_class( 'rh_prop_card rh_prop_card--similar' ); ?>>

	<div class="rh_prop_card__wrap">

		<figure class="rh_prop_card__thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail( get_the_ID() ) ) {
					the_post_thumbnail( 'modern-property-child-slider' );
				} else {
					inspiry_image_placeholder( 'modern-property-child-slider' );
				}
				?>
			</a>

			<div class="rh_overlay"></div>
			<div class="rh_overlay__contents rh_overlay__fadeIn-bottom">
				<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Property', 'framework' ); ?></a>
			</div>
			<!-- /.rh_overlay__contents -->

			<?php inspiry_display_property_label( get_the_ID() ); ?>

			<div class="rh_prop_card__btns">
				<?php
				$property_id = get_the_ID();
				if ( is_added_to_favorite( $property_id ) ) {
					?>
					<span class="favorite-placeholder highlight__red" data-tooltip="<?php esc_attr_e( 'Added to favorites', 'framework' ); ?>">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg'; ?>
					</span>
					<?php
				} else {
					?>
					<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="add-to-favorite-form">
						<input type="hidden" name="property_id" value="<?php echo esc_attr( $property_id ); ?>"/>
						<input type="hidden" name="action" value="add_to_favorite"/>
					</form>
					<span class="favorite-placeholder highlight__red hide" data-tooltip="<?php esc_attr_e( 'Added to favorites', 'framework' ); ?>">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg'; ?>
					</span>
					<a href="#" class="favorite add-to-favorite" data-tooltip="<?php esc_attr_e( 'Add to favorites', 'framework' ); ?>">
						<?php include INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg'; ?>
					</a>
					<?php
				}
				?>
			</div>
			<!-- /.rh_prop_card__btns -->
		</figure>
		<!-- /.rh_prop_card__thumbnail -->

		<div class="rh_prop_card__details">

			<h3>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<p class="rh_prop_card__excerpt"><?php framework_excerpt( 10 ); ?></p>
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

	</div>
	<!-- /.rh_prop_card__wrap -->

</article>
<!-- /.rh_prop_card -->
