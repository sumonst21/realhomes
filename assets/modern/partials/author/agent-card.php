<?php
/**
 * Author Head Card
 *
 * Head card for author template.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

// Get Author Information.
$current_author	= $wp_query->get_queried_object();
$current_author_meta 	= get_user_meta( $current_author->ID );

$facebook_url 		= ( isset( $current_author_meta['facebook_url'] ) ) ? $current_author_meta['facebook_url'][0] : false;
$twitter_url 		= ( isset( $current_author_meta['twitter_url'] ) ) ? $current_author_meta['twitter_url'][0] : false;
$google_plus_url 	= ( isset( $current_author_meta['google_plus_url'] ) ) ? $current_author_meta['google_plus_url'][0] : false;
$linked_in_url 		= ( isset( $current_author_meta['linkedin_url'] ) ) ? $current_author_meta['linkedin_url'][0] : false;

/* Agent Contact Info */
$agent_mobile 		= ( isset( $current_author_meta['mobile_number'] ) ) ? $current_author_meta['mobile_number'][0] : false;
$agent_office_phone = ( isset( $current_author_meta['office_number'] ) ) ? $current_author_meta['office_number'][0] : false;
$agent_office_fax 	= ( isset( $current_author_meta['fax_number'] ) ) ? $current_author_meta['fax_number'][0] : false;
$agent_email		= $current_author->user_email;

?>

<div class="rh_agent_profile">

	<div class="rh_agent_profile__wrap">

		<div class="rh_agent_profile__head">

			<div class="rh_agent_profile__dp">

				<figure class="picture">
					<?php
					// Author profile image.
	                if ( isset( $current_author_meta['profile_image_id'] ) ) {
	                    $profile_image_id = intval( $current_author_meta['profile_image_id'][0] );
	                    if ( $profile_image_id ) {
	                        echo wp_get_attachment_image( $profile_image_id, 'agent-image' );
	                    }
	                } elseif ( function_exists( 'get_avatar' ) ) {
	                    echo get_avatar( $current_author->user_email, '210' );
	                }
					?>
				</figure>
				<!-- /.picture -->

			</div>
			<!-- /.rh_agent_profile__dp -->

			<div class="rh_agent_profile__details">

				<div class="rh_agent_profile__name">

					<?php if ( ! empty( $current_author->display_name ) ) : ?>
					    <h3 class="name"><?php echo esc_html( $current_author->display_name ); ?></h3>
					    <!-- /.name -->
					<?php endif; ?>

					<div class="rh_agent_profile__social">
						<?php
						if ( ! empty( $facebook_url ) ) {
			                ?>
			                <a target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fa fa-facebook-official fa-lg"></i></a>
			                <?php
			            }

			            if ( ! empty( $twitter_url ) ) {
			                ?>
			                <a target="_blank" href="<?php echo esc_url( $twitter_url ); ?>" ><i class="fa fa-twitter fa-lg"></i></a>
			                <?php
			            }

			            if ( ! empty( $linked_in_url ) ) {
			                ?>
			                <a target="_blank" href="<?php echo esc_url( $linked_in_url ); ?>"><i class="fa fa-linkedin-square fa-lg"></i></a>
			                <?php
			            }

			            if ( ! empty( $google_plus_url ) ) {
			                ?>
			                <a target="_blank" href="<?php echo esc_url( $google_plus_url ); ?>"><i class="fa fa-google-plus fa-lg"></i></a>
			                <?php
			            }
						?>
					</div>
					<!-- /.rh_agent_profile__social -->

				</div>
				<!-- /.rh_agent_profile__name -->

				<div class="rh_agent_profile__contact">

					<?php if ( ! empty( $agent_mobile ) ) : ?>
						<p class="detail office">
							<?php esc_html_e( 'Office', 'framework' ); ?>: <span><?php echo esc_html( $agent_mobile ); ?></span>
						</p>
						<!-- /.detail -->
					<?php endif; ?>

					<?php if ( ! empty( $agent_office_phone ) ) : ?>
						<p class="detail mobile">
							<?php esc_html_e( 'Mobile', 'framework' ); ?>: <span><?php echo esc_html( $agent_office_phone ); ?></span>
						</p>
						<!-- /.detail -->
					<?php endif; ?>

					<?php if ( ! empty( $agent_office_fax ) ) : ?>
						<p class="detail fax">
							<?php esc_html_e( 'Fax', 'framework' ); ?>: <span><?php echo esc_html( $agent_office_fax ); ?></span>
						</p>
						<!-- /.detail -->
					<?php endif; ?>

					<p class="detail email"><?php esc_html_e( 'Email', 'framework' ); ?>: <a href="mailto:<?php echo esc_attr( antispambot( $agent_email ) ); ?>"><?php echo esc_html( antispambot( $agent_email ) ); ?></a></p>
					<!-- /.detail -->

				</div>
				<!-- /.rh_agent_profile__contact -->

			</div>
			<!-- /.rh_agent_profile__details -->

		</div>
		<!-- /.rh_agent_profile__head -->

		<div class="rh_content rh_agent_profile__excerpt">
			<?php if ( isset( $current_author_meta['description'] ) ) : ?>
				<p>
					<?php echo esc_html( $current_author_meta['description'][0] ); ?>
				</p>
			<?php endif; ?>
		</div>
		<!-- /.rh_agent_profile__excerpt -->

		<div class="rh_agent_profile__contact_form">
			<?php if ( ! empty( $agent_email ) ) : ?>
				<div class="rh_agent_form">

					<form id="agent-single-form" class="" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">

						<div class="rh_agent_form__field rh_agent_form__text">
							<label for="name"><?php esc_html_e( 'Name', 'framework' ); ?></label>
							<input type="text" name="name" id="name" placeholder="<?php esc_attr_e( 'Your Name', 'framework' ); ?>" class="required" title="<?php esc_attr_e( '* Please provide your name', 'framework' ); ?>">
						</div>
						<!-- /.rh_agent_form__field rh_agent_form__text -->

						<div class="rh_agent_form__field rh_agent_form__text">
							<label for="email"><?php esc_html_e( 'Email', 'framework' ); ?></label>
							<input type="text" name="email" id="email" placeholder="<?php esc_attr_e( 'Your Email', 'framework' ); ?>" class="email required" title="<?php esc_attr_e( '* Please provide valid email address', 'framework' ); ?>">
						</div>
						<!-- /.rh_agent_form__field rh_agent_form__text -->

						<div class="rh_agent_form__field rh_agent_form__text">
							<label for="phone"><?php esc_html_e( 'Phone', 'framework' ); ?></label>
							<input type="text" name="phone" id="phone" placeholder="<?php esc_attr_e( 'Your Phone', 'framework' ); ?>" class="digits required" title="<?php esc_attr_e( '* Please provide valid phone number', 'framework' ); ?>">
						</div>
						<!-- /.rh_agent_form__field rh_agent_form__text -->

						<div class="rh_agent_form__field rh_agent_form__textarea">
							<label for="comment"><?php esc_html_e( 'Message', 'framework' ); ?></label>
							<textarea rows="6" name="message" id="comment" class="required" placeholder="<?php esc_attr_e( 'Your Message', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide your message', 'framework' ); ?>"></textarea>
						</div>
						<!-- /.rh_agent_form__field rh_agent_form__textarea -->

						<div class="rh_agent_form__row">
							<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'agent_message_nonce' ) ); ?>"/>
				            <input type="hidden" name="target" value="<?php echo esc_attr( antispambot( $agent_email ) ); ?>">
				            <input type="hidden" name="action" value="send_message_to_agent" />
				            <input type="submit" id="submit-button" value="<?php esc_attr_e( 'Send Message', 'framework' ); ?>"  name="submit" class="rh_btn rh_btn--primary">
				            <span id="ajax-loader">
				            	<?php include( INSPIRY_THEME_DIR . '/images/loader.svg' ); ?>
				            </span>
						</div>
						<!-- /.rh_agent_form__row -->

						<div class="rh_agent_form__row">
							<div id="error-container"></div>
							<div id="message-container"></div>
						</div>
						<!-- /.rh_agent_form__row -->

					</form>

				</div>
				<!-- /.rh_agent_form -->
			<?php endif; ?>
		</div>
		<!-- /.rh_agent_profile__contact_form -->

	</div>
	<!-- /.rh_agent_profile__wrap -->

</div>
<!-- /.rh_agent_profile -->
