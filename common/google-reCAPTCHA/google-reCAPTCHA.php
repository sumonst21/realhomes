<?php
/**
 * Output Google reCAPTCHA Divs
 *
 * @since 1.0.0
 * @package RH
 */

if ( inspiry_is_reCAPTCHA_configured() ) {
	?>
	<div class="inspiry-recaptcha-wrapper clearfix">
	    <div class="inspiry-google-recaptcha"></div>
	</div>
	<?php
}
