<?php
/**
 * User Navigation
 */
$enable_user_nav = get_option('theme_enable_user_nav');
if ($enable_user_nav == "true") {
    ?>
	<div class="user-nav clearfix">
		<?php

        /**
         * Favorite properties page
         */
        $favorites_url = inspiry_get_favorites_url();
    if (!empty($favorites_url)) {
        ?>
			<a href="<?php echo esc_url($favorites_url); ?>"><i class="fa fa-star"></i><?php _e('Favorites', 'framework'); ?></a>
			<?php

    }

    if (is_user_logged_in()) {

            /**
             * Property Submit Page
             */
            $submit_url = inspiry_get_submit_property_url();
        if (! empty($submit_url)) {
            ?><a href="<?php echo esc_url($submit_url); ?>"><i class="fa fa-plus-circle"></i><?php _e('Submit', 'framework'); ?></a><?php

        }


            /**
             * My Properties Page
             */
            $my_properties_url = inspiry_get_my_properties_url();
        if (!empty($my_properties_url)) {
            ?><a href="<?php echo esc_url($my_properties_url); ?>"><i class="fa fa-th-list"></i><?php _e('My Properties', 'framework'); ?></a><?php

        }


            /**
             * Edit Profile Page
             */
            $profile_url = inspiry_get_edit_profile_url();
        if (! empty($profile_url)) {
            ?><a href="<?php echo esc_url($profile_url); ?>"><i class="fa fa-user"></i><?php _e('Profile', 'framework'); ?></a><?php

        } else {
            ?><a href="<?php echo network_admin_url('profile.php'); ?>"><i class="fa fa-user"></i><?php _e('Profile', 'framework'); ?></a><?php

        }


            /**
             * Logout
             */
            ?><a class="last" href="<?php echo wp_logout_url(home_url()); ?>"><i class="fa fa-sign-out"></i><?php _e('Logout', 'framework'); ?></a><?php

    } elseif (inspiry_header_login_enabled()) {

            /**
             * Login and Register
             */
            $theme_login_url = inspiry_get_login_register_url();
        if (! empty($theme_login_url)) {
            ?><a class="last" href="<?php echo esc_url($theme_login_url); ?>"><i class="fa fa-sign-in"></i><?php _e('Login / Register', 'framework'); ?></a><?php

        } else {
            ?><a class="last" href="#login-modal" data-toggle="modal"><i class="fa fa-sign-in"></i><?php _e('Login / Register', 'framework'); ?></a><?php

        }
    } ?>
	</div>
	<?php

}
