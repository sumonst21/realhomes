<?php
/**
 * Agency Contact Form
 *
 * @since 3.5.0
 * @package RH/classic
 */

$agency_email = get_post_meta( get_the_ID(), 'REAL_HOMES_agency_email', true );

$agency_email = is_email( $agency_email );

if ( $agency_email ) {
	?>
	<hr/>
	<h5><?php esc_html_e( 'Send a Message', 'framework' ); ?></h5>
	<form id="agent-single-form" class="" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">

		<div class="row-fluid">
			<div class="span6">
				<input type="text" name="name" id="name" placeholder="<?php esc_attr_e( 'Name', 'framework' ); ?>" class="required" title="<?php esc_attr_e( '* Please provide your name', 'framework' ); ?>">
			</div>

			<div class="span6">
				<input type="text" name="email" id="email" placeholder="<?php esc_attr_e( 'Email', 'framework' ); ?>" class="email required" title="<?php esc_attr_e( '* Please provide valid email address', 'framework' ); ?>">
			</div>
		</div>

		<div class="row-fluid">
			<div class="span6">
				<input type="text" name="phone" id="phone" placeholder="<?php esc_attr_e( 'Phone', 'framework' ); ?>" class="digits required" title="<?php esc_attr_e( '* Please provide valid phone number', 'framework' ); ?>">
			</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				<textarea  name="message" id="comment" class="required" placeholder="<?php esc_attr_e( 'Message', 'framework' ); ?>" title="<?php esc_attr_e( '* Please provide your message', 'framework' ); ?>"></textarea>
			</div>
		</div>
		<?php

			$is_gdpr_enabled = inspiry_is_gdpr_enabled();

			if ( $is_gdpr_enabled ) {

				$gdpr_agreement_text = inspiry_gdpr_agreement_content();

				if ( ! empty( $gdpr_agreement_text ) ) {
					?>
					<p class="gdpr-agreement clearfix">
						<?php

							$gdpr_agreement_label   = inspiry_gdpr_agreement_content( 'label' );
							$gdpr_agreement_val_msg = inspiry_gdpr_agreement_content( 'validation-message' );

							if ( ! empty( $gdpr_agreement_label ) ) {
								?>
								<span class="gdpr-checkbox-label"><?php echo esc_html( $gdpr_agreement_label ); ?>
									<span class="required-label">*</span></span>
								<?php
							}

						?>
						<input type="checkbox" id="inspiry-gdpr" class="required" name="gdpr" title="<?php echo esc_attr( $gdpr_agreement_val_msg ); ?>" value="<?php echo strip_tags( $gdpr_agreement_text ); ?>">
						<label for="inspiry-gdpr"><?php echo $gdpr_agreement_text; ?></label>
					</p>
					<?php
				}
			}
		?>
		<div class="row-fluid">
			<div class="span12 agent-recaptcha">
				<?php
					/* Display reCAPTCHA if enabled and configured from customizer settings */
					get_template_part( 'common/google-reCAPTCHA/google-reCAPTCHA' ); ?>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'agent_message_nonce' ) ); ?>"/>
				<input type="hidden" name="form_of" value="agency"/>
				<input type="hidden" name="target" value="<?php echo esc_attr( antispambot( $agency_email ) ); ?>">
				<input type="hidden" name="action" value="send_message_to_agent" />
				<input type="submit" id="submit-button" value="<?php esc_attr_e( 'Send Message', 'framework' ); ?>"  name="submit" class="real-btn">
				<img src="<?php echo esc_attr( INSPIRY_DIR_URI ); ?>/images/ajax-loader.gif" id="ajax-loader" alt="Loading...">
			</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				<div id="error-container"></div>
				<div id="message-container">&nbsp;</div>
			</div>
		</div>

	</form>
	<?php
}
