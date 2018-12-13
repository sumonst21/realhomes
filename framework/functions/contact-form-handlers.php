<?php
/**
 * Functions to process contact forms in this theme
 *
 */


if( !function_exists( 'inspiry_mail_from_name' ) ) :
	/**
	 * Override 'WordPress' as from name in emails sent by wp_mail function
	 * @return string
	 */
    function inspiry_mail_from_name() {
	    // The blogname option is escaped with esc_html on the way into the database in sanitize_option
	    // we want to reverse this for the plain text arena of emails.
	    $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

	    return $blogname;
    }
	add_filter( 'wp_mail_from_name', 'inspiry_mail_from_name' );
endif;


if ( ! function_exists( 'inspiry_send_messages' ) ) {
	/**
	 * Handler for Contact form on contact page template
	 */
	function inspiry_send_messages() {

		if ( isset( $_POST[ 'email' ] ) ):

			/*
			 * Verify Nonce
			 */
			if ( ! isset( $_POST[ 'nonce' ] ) || ! wp_verify_nonce( $_POST[ 'nonce' ], 'send_message_nonce' ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Unverified Nonce!', 'framework' )
				) );
				die;
			}

			/* Verify Google reCAPTCHA */
			inspiry_verify_google_recaptcha();

			/*
			 * Sanitize and Validate Target email address that will be configured from theme options
			 */
			$to_email = sanitize_email( get_option( 'theme_contact_email' ) );
			$to_email = is_email( $to_email );
			if ( ! $to_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Target Email address is not properly configured!', 'framework' )
				) );
				die;
			}

			/*
			 * Sanitize and Validate contact form input data
			 */
			$from_name = sanitize_text_field( $_POST[ 'name' ] );
			$phone_number = sanitize_text_field( $_POST[ 'number' ] );
			$message = stripslashes( $_POST[ 'message' ] );

			$from_email = sanitize_email( $_POST[ 'email' ] );
			$from_email = is_email( $from_email );
			if ( ! $from_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Provided Email address is invalid!', 'framework' )
				) );
				die;
			}

			/*
			 * Email Subject
			 */
			$email_subject = __( 'New message sent by', 'framework' ) . ' ' . $from_name . ' ' . __( 'using contact form at', 'framework' ) . ' ' . get_bloginfo( 'name' );

			/*
			 * Email Body
			 */
			$email_body = __( "You have received a message from: ", 'framework' ) . $from_name . " <br/>";
			if ( ! empty( $phone_number ) ) {
				$email_body .= __( "Phone Number : ", 'framework' ) . $phone_number . " <br/>";
			}
			$email_body .= __( "Their additional message is as follows.", 'framework' ) . " <br/>";
			$email_body .= wpautop( $message ) . " <br/>";

			$add_gdpr_in_email = get_option( 'inspiry_gdpr_in_email', '0' );

			if ( '1' == $add_gdpr_in_email ) {
				$GDPR_agreement = $_POST['gdpr'];
				if ( ! empty( $GDPR_agreement ) ) {
					$email_body .= esc_html__( 'GDPR Agreement: ' ) . wpautop( $GDPR_agreement ) . " <br/>";
				}
			}

			$email_body .= __( "You can contact ", 'framework' ) . $from_name . __( " via email, ", 'framework' ) . $from_email;

			/*
			 * Email Headers ( Reply To and Content Type )
			 */
			$headers = array();

			/* Send CC of contact form message if configured */
			$cc_email = get_option( 'theme_contact_cc_email' );
			$cc_email = explode( ',', $cc_email );
			if ( ! empty( $cc_email ) ) {
				foreach ( $cc_email as $ind_email ) {
					$ind_email = sanitize_email( $ind_email );
					$ind_email = is_email( $ind_email );
					if ( $ind_email ) {
						$headers[] = "Cc: $ind_email";
					}
				}
			}

			/* Send BCC of contact form message if configured */
			$bcc_email = get_option( 'theme_contact_bcc_email' );
			$bcc_email = explode( ',', $bcc_email );
			if ( ! empty( $bcc_email ) ) {
				foreach ( $bcc_email as $ind_email ) {
					$ind_email = sanitize_email( $ind_email );
					$ind_email = is_email( $ind_email );
					if ( $ind_email ) {
						$headers[] = "Bcc: $ind_email";
					}
				}
			}

			$headers[] = "Reply-To: $from_name <$from_email>";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters( "inspiry_contact_mail_header", $headers );    // just in case if you want to modify the header in child theme

			if ( wp_mail( $to_email, $email_subject, $email_body, $headers ) ) {
				echo json_encode( array(
					'success' => true,
					'message' => __( "Message Sent Successfully!", 'framework' )
				) );
			} else {
				echo json_encode( array(
						'success' => false,
						'message' => __( "Server Error: WordPress mail function failed!", 'framework' )
					)
				);
			}

		else:
			echo json_encode( array(
					'success' => false,
					'message' => __( "Invalid Request !", 'framework' )
				)
			);
		endif;

		do_action('inspiry_after_contact_form_submit');

		die;

	}

	add_action( 'wp_ajax_nopriv_send_message', 'inspiry_send_messages' );
	add_action( 'wp_ajax_send_message', 'inspiry_send_messages' );

}


if ( ! function_exists( 'send_message_to_agent' ) ) {
	/**
	 * Handler for agent's contact form
	 */
	function send_message_to_agent() {
		if ( isset( $_POST[ 'email' ] ) ):

			/*
			 *  Verify Nonce
			 */
			$nonce = $_POST[ 'nonce' ];
			if ( ! wp_verify_nonce( $nonce, 'agent_message_nonce' ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Unverified Nonce!', 'framework' )
				) );
				die;
			}

			/* Verify Google reCAPTCHA */
			inspiry_verify_google_recaptcha();

			/* Sanitize and Validate Target email address that is coming from agent form */
			$to_email = sanitize_email( $_POST[ 'target' ] );
			$to_email = is_email( $to_email );
			if ( ! $to_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Target Email address is not properly configured!', 'framework' )
				) );
				die;
			}


			/* Sanitize and Validate contact form input data */
			$from_name = sanitize_text_field( $_POST[ 'name' ] );
			$from_phone = sanitize_text_field( $_POST[ 'phone' ] );
			$message = stripslashes( $_POST[ 'message' ] );

			/*
			 * Property title and URL
			 */
			if ( isset( $_POST[ 'property_title' ] ) ) {
				$property_title = sanitize_text_field( $_POST[ 'property_title' ] );
			}
			if ( isset( $_POST[ 'property_permalink' ] ) ) {
				$property_permalink = esc_url( $_POST[ 'property_permalink' ] );
			}

			/*
			 * From email
			 */
			$from_email = sanitize_email( $_POST[ 'email' ] );
			$from_email = is_email( $from_email );
			if ( ! $from_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Provided Email address is invalid!', 'framework' )
				) );
				die;
			}


			/*
			 * Email Subject
			 */
			$form_of = ( isset( $_POST['form_of'] ) && 'agency' == $_POST['form_of'] ) ? esc_html__( 'using agency contact form at', 'framework' ) : esc_html__( 'using agent contact form at', 'framework' );
			$email_subject = __( 'New message sent by', 'framework' ) . ' ' . $from_name . ' ' . $form_of . ' ' . get_bloginfo( 'name' );


			/*
			 * Email body
			 */
			$email_body = __( "You have received a message from: ", 'framework' ) . $from_name . " <br/>";
			if ( ! empty( $property_title ) ) {
				$email_body .= "<br/>" . __( "Property Title : ", 'framework' ) . $property_title . " <br/>";
			}
			if ( ! empty( $property_permalink ) ) {
				$email_body .= __( "Property URL : ", 'framework' ) . '<a href="' . $property_permalink . '">' . $property_permalink . "</a><br/>";
			}
			$email_body .= "<br/>" . __( "Their additional message is as follows.", 'framework' ) . " <br/>";
			$email_body .= wpautop( $message ) . " <br/>";

			$add_gdpr_in_email = get_option( 'inspiry_gdpr_in_email', '0' );

			if ( '1' == $add_gdpr_in_email ) {
				$GDPR_agreement = $_POST['gdpr'];
				if ( ! empty( $GDPR_agreement ) ) {
					$email_body .= esc_html__( 'GDPR Agreement: ' ) . wpautop( $GDPR_agreement ) . " <br/>";
				}
			}

			$email_body .= __( "You can contact ", 'framework' ) . $from_name . __( " via email, ", 'framework' ) . $from_email;
			$email_body .= __( " or via contact number ", 'framework' ) . $from_phone;


			/*
			 * Email Headers ( Reply To and Content Type )
			 */
			$headers = array();
			$headers[] = "Reply-To: $from_name <$from_email>";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters( "inspiry_agent_mail_header", $headers );    // just in case if you want to modify the header in child theme

			/* Send copy of message to admin if configured */
			$theme_send_message_copy = get_option( 'theme_send_message_copy' );
			if ( $theme_send_message_copy == 'true' ) {
				$cc_email = get_option( 'theme_message_copy_email' );
				$cc_email = explode( ',', $cc_email );
				if ( ! empty( $cc_email ) ) {
					foreach ( $cc_email as $ind_email ) {
						$ind_email = sanitize_email( $ind_email );
						$ind_email = is_email( $ind_email );
						if ( $ind_email ) {
							$headers[] = "Cc: $ind_email";
						}
					}
				}
			}

			if ( wp_mail( $to_email, $email_subject, $email_body, $headers ) ) {
				echo json_encode( array(
					'success' => true,
					'message' => __( "Message Sent Successfully!", 'framework' )
				) );
			} else {
				echo json_encode( array(
						'success' => false,
						'message' => __( "Server Error: WordPress mail function failed!", 'framework' )
					)
				);
			}

		else:
			echo json_encode( array(
					'success' => false,
					'message' => __( "Invalid Request !", 'framework' )
				)
			);
		endif;

		do_action('inspiry_after_agent_form_submit');

		die;
	}

	add_action( 'wp_ajax_nopriv_send_message_to_agent', 'send_message_to_agent' );
	add_action( 'wp_ajax_send_message_to_agent', 'send_message_to_agent' );
}


if ( ! function_exists( 'inspiry_is_reCAPTCHA_configured' ) ) :
	/**
	 * Check if Google reCAPTCHA is properly configured and enabled or not
	 *
	 * @return bool
	 */
	function inspiry_is_reCAPTCHA_configured() {

		$show_reCAPTCHA = get_option( 'theme_show_reCAPTCHA' );
		if ( $show_reCAPTCHA == 'true' ) {
			$reCAPTCHA_public_key  = get_option( 'theme_recaptcha_public_key' );
			$reCAPTCHA_private_key = get_option( 'theme_recaptcha_private_key' );
			if ( ! empty( $reCAPTCHA_public_key ) && ! empty( $reCAPTCHA_private_key ) ) {
				return true;
			}
		}

		return false;
	}
endif;


if ( ! function_exists( 'inspiry_recaptcha_callback_generator' ) ) :
	/**
	 * Generates a call back JavaScript function for reCAPTCHA
	 */
	function inspiry_recaptcha_callback_generator() {
		if ( inspiry_is_reCAPTCHA_configured() ) {
			$reCAPTCHA_public_key = get_option( 'theme_recaptcha_public_key' );
			?>
			<script type="text/javascript">
				var reCAPTCHAWidgetIDs = [];
				var inspirySiteKey = '<?php echo $reCAPTCHA_public_key; ?>';

				/**
				 * Render Google reCAPTCHA and store their widget IDs in an array
				 */
				var loadInspiryReCAPTCHA = function() {
					jQuery( '.inspiry-google-recaptcha' ).each( function( index, el ) {
						var tempWidgetID = grecaptcha.render( el, {
							'sitekey' : inspirySiteKey
						} );
						reCAPTCHAWidgetIDs.push( tempWidgetID );
					} );
				};

				/**
				 * For Google reCAPTCHA reset
				 */
				var inspiryResetReCAPTCHA = function() {
					if( typeof reCAPTCHAWidgetIDs != 'undefined' ) {
						var arrayLength = reCAPTCHAWidgetIDs.length;
						for( var i = 0; i < arrayLength; i++ ) {
							grecaptcha.reset( reCAPTCHAWidgetIDs[i] );
						}
					}
				};
			</script>
			<?php
		}
	}

	add_action( 'wp_footer', 'inspiry_recaptcha_callback_generator' );
endif;


if ( ! function_exists( 'inspiry_verify_google_recaptcha' ) ) {
	/**
	 * This function verifies google recaptcha and echo a json array if fails
	 */
	function inspiry_verify_google_recaptcha() {

		/**
		 * If Google reCAPTCHA Enabled
		 */
		$show_reCAPTCHA = get_option( 'theme_show_reCAPTCHA' );
		if ( 'true' == $show_reCAPTCHA ) {

			/**
			 * Then, Verify Google reCAPTCHA
			 */
			$reCAPTCHA_public_key  = get_option( 'theme_recaptcha_public_key' );
			$reCAPTCHA_private_key = get_option( 'theme_recaptcha_private_key' );

			if ( ! empty( $reCAPTCHA_public_key ) && ! empty( $reCAPTCHA_private_key ) ) {

				// include reCAPTCHA library - https://github.com/google/recaptcha
				include_once( INSPIRY_FRAMEWORK . 'include/recaptcha/autoload.php' );

				// If the form submission includes the "g-captcha-response" field
				// Create an instance of the service using your secret
				$reCAPTCHA = new \ReCaptcha\ReCaptcha( $reCAPTCHA_private_key, new \ReCaptcha\RequestMethod\CurlPost() );

				// Make the call to verify the response and also pass the user's IP address
				$resp = $reCAPTCHA->verify( $_POST[ 'g-recaptcha-response' ], $_SERVER[ 'REMOTE_ADDR' ] );

				if ( $resp->isSuccess() ) {
					// If the response is a success, Then all is good =)
				} else {
					// reference for error codes - https://developers.google.com/recaptcha/docs/verify
					$error_messages      = array(
						'missing-input-secret'   => 'The secret parameter is missing.',
						'invalid-input-secret'   => 'The secret parameter is invalid or malformed.',
						'missing-input-response' => 'The response parameter is missing.',
						'invalid-input-response' => 'The response parameter is invalid or malformed.',
					);
					$error_codes         = $resp->getErrorCodes();
					$final_error_message = $error_messages[ $error_codes[ 0 ] ];
					echo json_encode( array(
						'success' => false,
						'message' => __( 'reCAPTCHA Failed:', 'framework' ) . ' ' . $final_error_message
					) );
					die;
				}
			}
		}
	}
}
