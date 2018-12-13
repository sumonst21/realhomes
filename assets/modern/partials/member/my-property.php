<?php
/**
 * View: My Property Card
 *
 * Property card for my properties page.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;

/* Get Payment Related Options before while loop */
$payments_enabled   = get_option( 'theme_enable_paypal' );
$paypal_ipn_url     = get_option( 'theme_paypal_ipn_url' );
$paypal_merchant_id = get_option( 'theme_paypal_merchant_id' );
$enable_sandbox     = get_option( 'theme_enable_sandbox' );
$payment_amount     = get_option( 'theme_payment_amount' );
$currency_code      = get_option( 'theme_currency_code' );

?>

<div class="rh_my-property clearfix">

	<div class="rh_my-property__thumb">
		<?php
		if ( has_post_thumbnail( get_the_ID() ) ) {
			the_post_thumbnail( 'property-thumb-image' );
		} else {
			inspiry_image_placeholder( 'property-thumb-image' );
		}
		?>
	</div>
	<!-- /.rh_my-property__thumb -->

	<div class="rh_my-property__title">
		<h5><?php the_title(); ?></h5>
		<div class="rh_my-property__btns">
			<?php
			// Payment Status.
			$payment_status = get_post_meta( get_the_ID(), 'payment_status', true );

			// Memberships enabled?
			if ( function_exists( 'IMS_Functions' ) ) {
				$ims_functions         = IMS_Functions();
				$is_memberships_enable = $ims_functions::is_memberships();
			}

			if ( 'Completed' === $payment_status ) {
				echo '<h5>';
				esc_html_e( 'Payment Completed', 'framework' );
				echo '</h5>';
			} elseif ( class_exists( 'IMS_Functions' ) && ! empty( $is_memberships_enable ) ) {
				/**
				 * Do nothing because individual payments are locked
				 * when memberships plugin is active.
				 */
			} else {

				if ( class_exists( 'AngellEYE_Paypal_Ipn_For_Wordpress' ) ) {

					if ( ( 'true' == $payments_enabled )
					     && ( ! empty( $paypal_ipn_url ) )
					     && ( ! empty( $paypal_merchant_id ) )
					     && ( ! empty( $currency_code ) )
					     && ( ! empty( $payment_amount ) )
					) {

						$paypal_button_script = INSPIRY_DIR_URI . '/scripts/vendors/paypal-button.min.js';
						?>
						<script src="<?php echo esc_url( add_query_arg( array( 'merchant' => $paypal_merchant_id ), $paypal_button_script ) ); ?>"
						        <?php if ( 'true' == $enable_sandbox ) { ?>data-env="sandbox"<?php } ?>
								data-callback="<?php echo esc_url_raw( $paypal_ipn_url ); ?>"
								data-tax="0"
								data-shipping="0"
								data-currency="<?php echo esc_attr( $currency_code ); ?>"
								data-amount="<?php echo esc_attr( $payment_amount ); ?>"
								data-quantity="1"
								data-name="<?php the_title(); ?>"
								data-number="<?php the_ID(); ?>"
								data-button="buynow"
						></script>
						<?php
					}
				}

				/**
				 * This action hook is used to add multiple payment options
				 * for property submission e.g. Stripe etc.
				 *
				 * @since 2.6.4
				 */
				do_action( 'inspiry_property_payments', get_the_ID() );
			}
			?>
		</div>
		<!-- /.rh_my-property__btns -->
	</div>
	<!-- /.rh_my-property__title -->

	<div class="rh_my-property__publish">
		<div class="property-date">
			<h5><i class="fa fa-calendar"></i><?php the_time( get_option( 'date_format' ) ); ?></h5>
		</div>
		<?php $property_status = get_post_status(); ?>
		<span class="property-status <?php echo ( 'publish' === $property_status ) ? 'publish' : 'other'; ?>">
		    <h5>
		    <?php
			    $property_statuses = get_post_statuses();
			    echo esc_html( $property_statuses[ $property_status ] );
		    ?>
		    </h5>
		</span>
	</div>
	<!-- /.rh_my-property__publish -->

	<div class="rh_my-property__controls">
		<?php
		/* Preview Post Link */
		if ( current_user_can( 'edit_posts' ) ) {
			$preview_link = set_url_scheme( get_permalink( get_the_ID() ) );
			$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
			if ( ! empty( $preview_link ) ) {
				?><a class="preview" target="_blank" href="<?php echo esc_url( $preview_link ); ?>">
				<i class="fa fa-eye"></i> <?php esc_html_e( 'Preview', 'framework' ); ?></a><?php
			}
		}

		/* Edit Post Link */
		$submit_url = inspiry_get_submit_property_url();
		if ( ! empty( $submit_url ) ) {
			$edit_link = esc_url( add_query_arg( 'edit_property', get_the_ID(), $submit_url ) );
			?><a class="edit" href="<?php echo esc_url( $edit_link ); ?>">
			<i class="fa fa-pencil"></i> <?php esc_html_e( 'Edit', 'framework' ); ?></a><?php
		}

		/* Delete Post Link Bypassing Trash */
		if ( current_user_can( 'delete_posts' ) ) {
			?><a class="delete" href="#"><i class="fa fa-trash"></i> <?php esc_html_e( 'Delete', 'framework' ); ?>
			</a><?php
		}

		/* Delete Post Link Bypassing Trash */
		if ( current_user_can( 'delete_posts' ) ) {
			$delete_post_link = get_delete_post_link( get_the_ID(), '', true );
			if ( ! empty( $delete_post_link ) ) : ?>
				<span class="confirmation hide">
	        		<a href="<?php echo esc_url( $delete_post_link ); ?>" class="confirm"><i class="fa fa-check"></i> <?php esc_html_e( 'Confirm', 'framework' ); ?></a>
	        		<a href="#" class="cancel"><i class="fa fa-close"></i> <?php esc_html_e( 'Cancel', 'framework' ); ?></a>
	        	</span>
				<?php
			endif;
		}
		?>
	</div>
	<!-- /.rh_my-property__controls -->

</div>
