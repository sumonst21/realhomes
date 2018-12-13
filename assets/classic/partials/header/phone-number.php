<?php
/**
 * Header Partial: Phone Number
 *
 * @since 2.6.2
 */

$header_phone    = get_option('theme_header_phone');
if (! empty($header_phone)) {
    $desktop_version    = '<span class="desktop-version">' . $header_phone . '</span>';
    $mobile_version    =  '<a class="mobile-version" href="tel://'.$header_phone.'" title="Make a Call">' .$header_phone. '</a>';

    echo '<h2 class="contact-number "><i class="fa fa-phone"></i>'.  $desktop_version . $mobile_version .  '<span class="outer-strip"></span></h2>';
}
