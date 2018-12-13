<?php
/**
 * Membership Functions
 *
 * Inspiry Memberships related functions file.
 *
 * @since 	2.6.4
 * @package RealHomes
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'inspiry_add_membership_module' ) ) {

	/**
	 * inspiry_add_membership_module.
	 *
	 * @since 2.6.4
	 */
	function inspiry_add_membership_module( $current_user ) {

		// If inspiry-memberships plugin is not active then return.
		if ( ! class_exists( 'IMS_Functions' ) ) {
			return;
		}

		$ims_functions 			= IMS_Functions();
		$is_memberships_enable 	= $ims_functions::is_memberships();

		// Return if module is not enabled.
		if ( empty( $is_memberships_enable ) ) {
			return;
		}

		?>

		<div class="row-fluid">
			<div class="span12">
				<hr/>
			</div>
		</div>

		<div class="row-fluid">

			<div class="span4">
				<h3><?php _e( 'Available Memberships', 'framework' ); ?></h3>
				<?php inspiry_show_all_memberships(); ?>
			</div>
			<!-- /.span4 available-memberships -->

			<div class="span4">
				<h3><?php _e( 'Your Current Membership', 'framework' ); ?></h3>
				<?php inspiry_current_membership(); ?>
			</div>
			<!-- /.span4 current-membership -->

			<div class="span4">
				<h3><?php _e( 'Update Membership', 'framework' ); ?></h3>
				<?php inspiry_membership_selection_form(); ?>
			</div>
			<!-- /.span4 update-membership -->

		</div>
		<!-- /.row-fluid -->

		<?php
	}

	add_action( 'inspiry_extend_user_profile', 'inspiry_add_membership_module' );
}


if ( ! function_exists( 'inspiry_show_all_memberships' ) ) {

	/**
	 * inspiry_show_all_memberships.
	 *
	 * This functions shows all the available memberships
	 * packages.
	 *
	 * @since 2.6.4
	 */
	function inspiry_show_all_memberships() {

		// If inspiry-memberships plugin is not active then return.
		if ( ! class_exists( 'IMS_Functions' ) ) {
			return;
		}

		$ims_functions 			= IMS_Functions();
		$inspiry_memberships 	= $ims_functions::ims_get_all_memberships();

		if ( is_array( $inspiry_memberships ) && ! empty( $inspiry_memberships ) ) {

			?>

			<div class="rh_memberships">

				<?php foreach ( $inspiry_memberships as $inspiry_membership ) : ?>
					<div class="rh_memberships__wrap">
						<?php if ( isset( $inspiry_membership[ 'title' ] ) && ! empty( $inspiry_membership[ 'title' ] ) ) : ?>
							<h4 class="title"><?php echo esc_html( $inspiry_membership[ 'title' ] ); ?></h4><!-- /.h4 -->
						<?php endif; ?>

						<ul class="details">
							<?php if ( isset( $inspiry_membership[ 'format_price' ] ) && ! empty( $inspiry_membership[ 'format_price' ] ) ) : ?>
								<li><?php echo esc_html__( 'Price: ', 'framework' ) . esc_html( $inspiry_membership[ 'format_price' ] ) ; ?></li><!-- Price -->
							<?php endif; ?>

							<?php if ( isset( $inspiry_membership[ 'properties' ] ) && ! empty( $inspiry_membership[ 'properties' ] ) ) : ?>
								<li><?php echo esc_html__( 'Properties Allowed: ', 'framework' ) . esc_html( $inspiry_membership[ 'properties' ] ); ?></li><!-- Properties Allowed -->
							<?php endif; ?>

							<?php if ( isset( $inspiry_membership[ 'featured_prop' ] ) && ! empty( $inspiry_membership[ 'featured_prop' ] ) ) : ?>
								<li><?php echo esc_html__( 'Featured Properties: ', 'framework' ) . esc_html( $inspiry_membership[ 'featured_prop' ] ); ?></li><!-- Featured Properties -->
							<?php endif; ?>

							<?php if ( isset( $inspiry_membership[ 'duration' ] ) && ! empty( $inspiry_membership[ 'duration' ] ) ) : ?>
								<li><?php
									if ( $inspiry_membership[ 'duration' ] > 1 ) {
										$duration_unit = ( isset( $inspiry_membership[ 'duration_unit' ] ) && ! empty( $inspiry_membership[ 'duration_unit' ] ) ) ? $inspiry_membership[ 'duration_unit' ] : false;
										$readable_duration_unit = $ims_functions::get_readable_duration_unit( $duration_unit );
										echo esc_html__( 'Time Duration: ', 'framework' ) . esc_html( $inspiry_membership[ 'duration' ] . ' ' . $readable_duration_unit );
									} else {
										$duration_unit = rtrim( $inspiry_membership[ 'duration_unit' ], "s" );
										$readable_duration_unit = $ims_functions::get_readable_duration_unit( $duration_unit );
										echo esc_html__( 'Time Duration: ', 'framework' ) . esc_html( $inspiry_membership[ 'duration' ] . ' ' . $readable_duration_unit );
									}
									?></li><!-- Time Duration -->
							<?php endif; ?>
						</ul>
					</div><!-- /.rh_memberships__wrap -->
				<?php endforeach; ?>

			</div>
			<!-- /.rh_memberships -->
			<?php
		}

	}
}


if ( ! function_exists( 'inspiry_current_membership' ) ) {

	/**
	 * inspiry_current_membership.
	 *
	 * Shows the membership of the current user.
	 *
	 * @since 2.6.4
	 */
	function inspiry_current_membership() {

		// If inspiry-memberships plugin is not active then return.
		if ( ! class_exists( 'IMS_Functions' ) ) {
			return;
		}

		// Get current user data.
		$current_user 			= wp_get_current_user();

		// Get current membership of user.
		$ims_functions 			= IMS_Functions();
		$current_membership 	= $ims_functions::ims_get_membership_by_user( $current_user );

		if ( is_array( $current_membership ) && ! empty( $current_membership ) ) : ?>

			<div class="rh_memberships__wrap">

				<?php if ( isset( $current_membership[ 'title' ] ) && ! empty( $current_membership[ 'title' ] ) ) : ?>
					<h4 class="title"><?php echo esc_html( $current_membership[ 'title' ] ); ?></h4><!-- /.h4 -->
				<?php endif; ?>

				<ul class="details">

					<?php if ( isset( $current_membership[ 'format_price' ] ) && ! empty( $current_membership[ 'format_price' ] ) ) : ?>
						<li><?php echo esc_html( sprintf( __( "Price: %s", 'framework' ), $current_membership[ 'format_price' ] ) ); ?></li><!-- Price -->
					<?php endif; ?>

					<?php if ( isset( $current_membership[ 'properties' ] ) ) : ?>
						<li><?php echo esc_html( sprintf( __( "Properties Allowed: %s", 'framework' ), $current_membership[ 'properties' ] ) ); ?></li><!-- Properties Allowed -->
					<?php endif; ?>

					<?php if ( isset( $current_membership[ 'current_props' ] ) ) : ?>
						<li><?php echo esc_html( sprintf( __( "Properties Left: %s", 'framework' ), $current_membership[ 'current_props' ] ) ); ?></li><!-- Properties Left -->
					<?php endif; ?>

					<?php if ( isset( $current_membership[ 'featured_prop' ] ) ) : ?>
						<li><?php echo esc_html( sprintf( __( "Featured Properties: %s", 'framework' ), $current_membership[ 'featured_prop' ] ) ); ?></li><!-- Featured Properties -->
					<?php endif; ?>

					<?php if ( isset( $current_membership[ 'current_featured' ] ) ) : ?>
						<li><?php echo esc_html( sprintf( __( "Featured Properties Left: %s", 'framework' ), $current_membership[ 'current_featured' ] ) ); ?></li><!-- Featured Properties Left -->
					<?php endif; ?>

					<?php if ( isset( $current_membership[ 'duration' ] ) && ! empty( $current_membership[ 'duration' ] ) ) : ?>
						<li><?php
							if ( $current_membership[ 'duration' ] > 1 ) {
								$duration_unit = ( isset( $current_membership[ 'duration_unit' ] ) && ! empty( $current_membership[ 'duration_unit' ] ) ) ? $current_membership[ 'duration_unit' ] : false;
								$readable_duration_unit = $ims_functions::get_readable_duration_unit( $duration_unit );
								echo esc_html( sprintf( __( "Time Duration: %s %s", 'framework' ), $current_membership[ 'duration' ], $readable_duration_unit ) );
							} else {
								$duration_unit = rtrim( $current_membership[ 'duration_unit' ], "s" );
								$readable_duration_unit = $ims_functions::get_readable_duration_unit( $duration_unit );
								echo esc_html( sprintf( __( "Time Duration: %s %s", 'framework' ), $current_membership[ 'duration' ], $readable_duration_unit ) );
							}
							?></li><!-- Time Duration -->
					<?php endif; ?>

					<?php if ( isset( $current_membership[ 'due_date' ] ) && ! empty( $current_membership[ 'due_date' ] ) ) : ?>
						<li><?php
							$format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
							$date   = date_create( $current_membership[ 'due_date' ] );
							$date   = date_format( $date, $format );
							echo esc_html( sprintf( __( "Due Date: %s", 'framework' ), $date ) );
							?></li><!-- Due Date -->
					<?php endif; ?>

				</ul>
			</div>
			<!-- /.rh_memberships__wrap -->

			<a href="#rh-cancel-modal" class="btn real-btn" data-toggle="modal">
				<?php esc_html_e( 'Cancel Membership', 'framework' ); ?>
			</a>

			<!-- Login Modal -->
			<div id="rh-cancel-modal" class="forms-modal modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4><?php esc_html_e( 'Cancel Membership', 'framework' ); ?></h4>
				</div>

				<!-- start of modal body -->
				<div class="modal-body">
					<!-- login section -->
					<div class="login-section modal-section">
						<?php $ims_functions::cancel_user_membership_form( $current_user ); ?>
					</div>
				</div>
				<!-- end of modal-body -->
			</div>
			<?php

		else:

			echo '<h4>' . __( 'You have no current membership.', 'framework' ) . '</h4>';

		endif;

	}

}


if ( ! function_exists( 'inspiry_membership_selection_form' ) ) {

	/**
	 * inspiry_membership_selection_form.
	 *
	 * Render the membership selection form.
	 *
	 * @since 2.6.4
	 */
	function inspiry_membership_selection_form() {

		// If inspiry-memberships plugin is not active then return.
		if ( ! class_exists( 'IMS_Functions' ) ) {
			return;
		}

		$ims_functions	= IMS_Functions();
		$ims_functions::ims_display_membership_form();

	}

}


if ( ! function_exists( 'inspiry_add_membership_hooks' ) ) {
	/**
	 * Add hooks of membership related functions.
	 *
	 * @since 1.0.0
	 */
	function inspiry_add_membership_hooks() {

		// If inspiry-memberships plugin is not active then return.
		if ( ! class_exists( 'IMS_Functions' ) ) {
			return;
		}

		$ims_functions 			= IMS_Functions();
		$is_memberships_enable 	= $ims_functions::is_memberships();

		// Return if module is not enabled.
		if ( empty( $is_memberships_enable ) ) {
			return;
		}

		add_action( 'pre_post_update', 'inspiry_store_previous_featured_state', 10, 2 );

		add_filter( 'inspiry_before_property_submit', 'inspiry_filter_property_before_submit', 10, 1 );

		add_filter( 'inspiry_before_property_update', 'inspiry_filter_property_before_update', 10, 1 );

		add_action( 'transition_post_status', 'inspiry_update_properties_number', 10, 3 );

		add_action( 'inspiry_after_property_submit', 'inspiry_save_featured_props_number', 10, 1 );

		add_action( 'inspiry_after_property_update', 'inspiry_update_featured_props_number', 10, 1 );

		add_filter( 'pre_delete_post', 'inspiry_delete_properties_number', 10, 3 );

	}

	add_action( 'init', 'inspiry_add_membership_hooks' );
}


if ( ! function_exists( 'inspiry_store_previous_featured_state' ) ) {

	/**
	 * This function is used to store the previous value
	 * featured meta of a property for memberships.
	 *
	 * @param int $property_id
	 * @since 2.6.4
	 */
	function inspiry_store_previous_featured_state( $property_id ) {

		// Get post.
		$property	= get_post( $property_id );

		// Check if the post type is property.
		if ( ! empty( $property ) && 'property' === $property->post_type ) {

			// Get post meta data.
			$post_meta_data 	= get_post_custom( $property_id );

			// Get property featured meta variable.
			$pre_feature_state 	= ( isset( $post_meta_data[ 'REAL_HOMES_featured' ][0] ) ) ? $post_meta_data[ 'REAL_HOMES_featured' ][0] : false;

			// If the property is featured then store 1 otherwise nothing.
			if ( ! empty( $pre_feature_state ) ) {
				update_post_meta( $property_id, 'pre_feature_state', 1 );
			} else {
				update_post_meta( $property_id, 'pre_feature_state', false );
			}

		}

	}

}


if ( ! function_exists( 'inspiry_filter_property_before_submit' ) ) {

	/**
	 * Filter property arguments before submitting it on
	 * the frontend.
	 *
	 * @since 2.6.4
	 */
	function inspiry_filter_property_before_submit( $property ) {

		// Get current user.
		$current_user 		= wp_get_current_user();
		$current_user_id	= $current_user->ID;

		// Get current user membership.
		$current_membership = get_user_meta( $current_user_id, 'ims_current_membership', true );

		// Add appropriate post status to property before publishing it.
		if ( ! empty( $current_membership ) ) {

			// Get current number of properties
			$current_properties = get_user_meta( $current_user_id, 'ims_current_properties', true );

			if ( ! empty( $current_properties ) && $current_properties >= 1 ) {
				$property[ 'post_status' ]	= 'publish';
			} elseif ( empty( $current_properties ) || ( 0 == $current_properties ) ) {
				$property[ 'post_status' ]	= 'pending';
			}

		} elseif ( empty( $current_membership ) ) {
			$property[ 'post_status' ]	= 'pending';
		}
		return $property;

	}

}


if ( ! function_exists( 'inspiry_filter_property_before_update' ) ) {

	/**
	 * Filter property arguments before updating it on
	 * the frontend.
	 *
	 * @since 2.6.4
	 */
	function inspiry_filter_property_before_update( $property ) {

		// Get current user.
		$current_user 		= wp_get_current_user();
		$current_user_id	= $current_user->ID;

		// Get current user membership.
		$current_membership = get_user_meta( $current_user_id, 'ims_current_membership', true );

		// Add appropriate post status to property before publishing it.
		if ( ! empty( $current_membership ) ) {

			// Get property status
			$property_status	= get_post_status( $property[ 'ID' ] );

			// Get current number of properties
			$current_properties = get_user_meta( $current_user_id, 'ims_current_properties', true );

			if ( ! empty( $current_properties ) && $current_properties >= 1 ) {
				$property[ 'post_status' ]	= 'publish';
			} elseif ( ( 'publish' !== $property_status ) && ( empty( $current_properties ) || ( 0 == $current_properties ) ) ) {
				$property[ 'post_status' ]	= 'pending';
			} elseif ( ( 'publish' === $property_status ) && ( empty( $current_properties ) || ( 0 == $current_properties ) ) ) {
				$property[ 'post_status' ]	= 'publish';
			}

		} elseif ( empty( $current_membership ) ) {
			$property[ 'post_status' ]	= 'pending';
		}
		return $property;

	}

}


if ( ! function_exists( 'inspiry_update_properties_number' ) ) {

	/**
	 * Update number of properties in user meta for memberhips
	 * when property is posted.
	 *
	 * @since 2.6.4
	 */
	function inspiry_update_properties_number( $new, $old, $post ) {

		if ( ( 'publish' === $new ) && ( 'publish' !== $old ) && ( 'property' === $post->post_type ) ) {

			// Get current user id.
			$user_id	= $post->post_author;

			if ( ! empty( $user_id ) ) {
				// Get current number of properties
				$current_properties	= get_user_meta( $user_id, 'ims_current_properties', true );
			}

			if ( ( $current_properties - 1 ) >= 0 ) {

				update_user_meta( $user_id, 'ims_current_properties', $current_properties - 1 );

			} elseif ( empty( $current_properties ) || ( $current_properties < 0 ) ) {

				update_user_meta( $user_id, 'ims_current_properties', 0 );

			}

		}

		if ( ( 'publish' === $new ) && ( 'pending' === $old ) && ( 'property' === $post->post_type ) ) {
			update_post_meta( $post->ID, 'pre_feature_state', false );
		}

	}

}


if ( ! function_exists( 'inspiry_save_featured_props_number' ) ) {

	/**
	 * Save number of featured properties in user meta for
	 * memberhips when property is posted.
	 *
	 * @param int $property_id
	 * @since 2.6.4
	 */
	function inspiry_save_featured_props_number( $property_id ) {

		// Get property.
		$property 	= get_post( $property_id );

		if ( ! empty( $property ) ) {

			// Set Custom Post Type Variable.
		    $property_slug	= 'property';

		    // Get post author id.
		    $user_id		= $property->post_author;

			if ( ( 'trash' !== $property->post_status ) && ( 'publish' === $property->post_status ) && ( 'pending' !== $property->post_status ) && ( $property_slug === $property->post_type ) ) {

				// Get allowed number of featured properties.
		    	$featured_properties 	= get_user_meta( $user_id, 'ims_current_featured_props', true );

		    	// Get Post Meta.
	        	$post_meta_data	= get_post_custom( $property->ID );

	        	// Get featured property check.
	        	$is_featured	= ( isset( $post_meta_data[ 'REAL_HOMES_featured' ][0] ) ) ? $post_meta_data[ 'REAL_HOMES_featured' ][0] : false;

	        	if ( ! empty( $is_featured ) ) {

	        		if ( $featured_properties <= -1 ) {

						// Do nothing

					} elseif ( ( $featured_properties - 1 ) >= 0 ) {

						update_user_meta( $user_id, 'ims_current_featured_props', $featured_properties - 1 );

					} elseif ( empty( $featured_properties ) ) {

						update_user_meta( $user_id, 'ims_current_featured_props', false );
						update_post_meta( $property_id, 'REAL_HOMES_featured', false );

					}

	        	}

			}

		}

	}

}


if ( ! function_exists( 'inspiry_update_featured_props_number' ) ) {

	/**
	 * Update number of featured properties in user meta for
	 * memberhips when property is editied.
	 *
	 * @param int $property_id
	 * @since 2.6.4
	 */
	function inspiry_update_featured_props_number( $property_id ) {

		// Get property.
		$property	= get_post( $property_id );

		if ( ! empty( $property ) ) {

			// Set Custom Post Type Variable.
		    $property_slug 	= 'property';

		    // Get post author id.
		    $user_id 		= $property->post_author;

			if ( ( 'publish' === $property->post_status ) && ( 'pending' !== $property->post_status ) && ( $property_slug === $property->post_type ) ) {

				// Get allowed number of featured properties.
		    	$featured_properties	= get_user_meta( $user_id, 'ims_current_featured_props', true );

		    	// Get Post Meta.
	        	$post_meta_data	= get_post_custom( $property->ID );

	        	// Get featured property check.
	        	$is_featured	= ( isset( $post_meta_data[ 'REAL_HOMES_featured' ][0] ) ) ? $post_meta_data[ 'REAL_HOMES_featured' ][0] : false;

	        	if ( ! empty( $is_featured ) ) {

	        		$pre_feature_state 	= get_post_meta( $property_id, 'pre_feature_state', true );

	        		if ( empty( $pre_feature_state ) ) {

	        			// update_user_meta( $user_id, 'ims_current_featured_props', $featured_properties - 1  );
	        			update_post_meta( $property_id, 'pre_feature_state', 1 );

	        			if ( $featured_properties <= -1 ) {

							// Do nothing

						} elseif ( ( $featured_properties - 1 ) >= 0 ) {

							update_user_meta( $user_id, 'ims_current_featured_props', $featured_properties - 1 );

						} elseif ( ! is_admin() && ( $featured_properties == 0 || empty( $featured_properties ) ) ) {

							update_post_meta( $property->ID, 'REAL_HOMES_featured', 0 );
							update_user_meta( $user_id, 'ims_current_featured_props', 0 );

						}

	        		} elseif ( $pre_feature_state ) {

		        		// Do nothing because the property was already featured.

	        		}

	        	} else {

	        		$pre_feature_state 	= get_post_meta( $property_id, 'pre_feature_state', true );

					if ( $pre_feature_state ) {

						// If $pre_feature_state is set, then update it and update the featured properties.
						update_post_meta( $property_id, 'pre_feature_state', '' );

						$package_featured	= get_user_meta( $user_id, 'ims_package_featured_props', true );

						if ( $package_featured >= ( $featured_properties + 1 ) ) {
							update_user_meta( $user_id, 'ims_current_featured_props', $featured_properties + 1 );
						}

					} else {
						// Do nothing if the $pre_feature_state of property is not set because it was not featured before.
					}

	        	}

			}

		}

	}

}


if ( ! function_exists( 'inspiry_delete_properties_number' ) ) {

	/**
	 * Update: Properties number when property is deleted.
	 *
	 * @since 2.6.4
	 */
	function inspiry_delete_properties_number( $null, $property, $force_delete ) {

		// Get property object.
		$property_id 	= $property->ID;

		// Check if the post type is property.
		if ( ! empty( $property_id ) && 'property' === $property->post_type && 'publish' === $property->post_status ) {

			// Get property author id.
			$user_id	= $property->post_author;

			// Get current number of properties
			$current_properties = get_user_meta( $user_id, 'ims_current_properties', true );
			$package_properties = get_user_meta( $user_id, 'ims_package_properties', true );

			if ( $current_properties < $package_properties ) {
				update_user_meta( $user_id, 'ims_current_properties', $current_properties + 1 );
			}

			// Check if the post was featured or not.
			$post_meta_data 	= get_post_custom( $property_id );
			if ( isset( $post_meta_data[ 'REAL_HOMES_featured' ][0] ) && ! empty( $post_meta_data[ 'REAL_HOMES_featured' ][0] ) ) {
				$is_featured 	= $post_meta_data[ 'REAL_HOMES_featured' ][0];
			}

			$featured_properties	= get_user_meta( $user_id, 'ims_current_featured_props', true );
			$package_featured 		= get_user_meta( $user_id, 'ims_package_featured_props', true );

			if ( ! empty( $is_featured ) && ( $featured_properties < $package_featured ) ) {
				update_user_meta( $user_id, 'ims_current_featured_props', $featured_properties + 1 );
			}

		}

	}

}


if ( ! function_exists( 'inspiry_delete_membership' ) ) {

	/**
	 * Handle membership deletion event.
	 *
	 * @since 1.0.0
	 */
	function inspiry_delete_membership( $user_id = 0, $membership_id = 0 ) {

		// Bail if parameters are empty.
		if ( empty( $user_id ) || empty( $membership_id ) ) {
			return;
		}

		/**
		 * The WordPress Query class.
		 * @link http://codex.wordpress.org/Function_Reference/WP_Query
		 *
		 */
		$properties_args	= array(
			'author'      		=> $user_id, // Author Parameters
			'post_type'   		=> 'property', // Type & Status Parameters
			'post_status' 		=> array( 'publish', 'pending', 'draft' ),
			'posts_per_page'	=> -1 // Pagination Parameters
		);

		/**
		 * Get all published properties and convert them to draft
		 * either on deleting the membership.
		 */
		$properties	= get_posts( $properties_args );
		if ( ! empty( $properties ) ) {
			foreach ( $properties as $property ) {
				$property_args	= array(
					'ID' 			=> $property->ID,
					'post_status'	=> 'pending'
				);
				wp_update_post( $property_args );
			}
		}

	}

	add_action( 'ims_delete_user_membership', 'inspiry_delete_membership', 10, 2 );
}


if ( ! function_exists( 'inspiry_update_membership' ) ) {

	/**
	 * Update user membership on buying another membership.
	 *
	 * @since 1.0.0
	 */
	function inspiry_update_membership( $user_id, $prev_membership, $current_membership ) {

		// Bail if parameters are empty.
		if ( empty( $user_id ) || empty( $prev_membership ) || empty( $current_membership ) ) {
			return false;
		}

		if ( ! function_exists( 'ims_get_membership_object' ) ) {
			return false;
		}

		$prev_membership_obj    = ims_get_membership_object( $prev_membership );
		$current_membership_obj = ims_get_membership_object( $current_membership );

		// Get package properties.
		$prev_package_properties    = $prev_membership_obj->get_properties();
		$current_package_properties = $current_membership_obj->get_properties();

		if ( $prev_package_properties <= $current_package_properties ) {

			/*
			 * Upgrade Membership
			 *
			 * Only update user's currently allowed properties.
			 */
			$upgrade_args	= array(
				'user_id'			 => $user_id,
				'prev_membership'	 => $prev_membership_obj,
				'current_membership' => $current_membership_obj,
			);
			inspiry_upgrade_user_membership( $upgrade_args );

		} elseif ( $prev_package_properties > $current_package_properties ) {

			/*
			 * Downgrade Membership
			 */
			$downgrade_args	= array(
				'user_id'			 => $user_id,
				'prev_membership'	 => $prev_membership_obj,
				'current_membership' => $current_membership_obj,
			);
			inspiry_downgrade_user_membership( $downgrade_args );

		}

	}

	add_action( 'ims_update_user_membership', 'inspiry_update_membership', 10, 3 );
}


if ( ! function_exists( 'inspiry_upgrade_user_membership' ) ) {

	/**
	 * Upgrade user membership.
	 *
	 * @since 2.6.4
	 */
	function inspiry_upgrade_user_membership( $args ) {

		if ( empty( $args ) || ! is_array( $args ) ) {
			return false;
		}

		$user_id 			= $args[ 'user_id' ];
		$prev_membership 	= $args[ 'prev_membership' ];
		$current_membership = $args[ 'current_membership' ];

		if ( empty( $user_id ) || empty( $prev_membership ) || empty( $current_membership ) ) {
			return false;
		}

		/**
		 * Updating Package Properties
		 */
		$current_package_properties	= $current_membership->get_properties();

		$user_existing_properties       = inspiry_get_properties_by_user( $user_id );
		$user_existing_properties_count = 0;
		if ( ! empty( $user_existing_properties ) ) {
			$user_existing_properties_count = count( $user_existing_properties );
		}

		// Remaining available count of properties in current package.
		$user_remaining_properties_count = $current_package_properties - $user_existing_properties_count;

		// Get pending properties that can be published on upgrading membership.
		$user_modifiable_properties = inspiry_get_properties_by_user( $user_id, 'pending', $user_remaining_properties_count );
		$user_modifiable_properties_count = 0;

		if ( ! empty( $user_modifiable_properties ) ) {
			$user_modifiable_properties_count = count( $user_modifiable_properties );
			foreach ( $user_modifiable_properties as $property ) {
				$property_args = array(
					'ID'          => $property->ID,
					'post_status' => 'publish'
				);
				wp_update_post( $property_args );
			}
		}

		// Deduct the number of properties already present.
		update_user_meta( $user_id, 'ims_current_properties', $current_package_properties - ( $user_existing_properties_count + $user_modifiable_properties_count ) );

		/**
		 * Updating Package Featured Properties
		 */
		$prev_featured_properties		= $prev_membership->get_featured_properties();
		$current_featured_properties	= $current_membership->get_featured_properties();

		if ( $prev_featured_properties <= $current_featured_properties ) {

			/**
			 * Get count for published featured properties and then count
			 * remaining available featured properties in the package.
			 */
			$user_existing_featured_properties	= inspiry_get_featured_properties_by_user( $user_id );
			$user_existing_featured_count 		= 0;
			if ( ! empty( $user_existing_featured_properties ) ) {
				$user_existing_featured_count = count( $user_existing_featured_properties );
			}

			// Remaining available count of properties in current package.
			$user_remaining_featured_count = $current_featured_properties - $user_existing_featured_count;

			// Get pending properties that can be published on upgrading membership.
			$user_modifiable_featured_properties	= inspiry_get_featured_properties_by_user( $user_id, array( 'pending' ), $user_remaining_featured_count );
			$user_modifiable_featured_count 		= 0;

			if ( ! empty( $user_modifiable_featured_properties ) ) {
				$user_modifiable_featured_count	= count( $user_modifiable_featured_properties );
			}

			// Deduct the number of properties already present.
			update_user_meta( $user_id, 'ims_current_featured_props', $current_featured_properties - ( $user_existing_featured_count + $user_modifiable_featured_count ) );

		} elseif ( $prev_featured_properties > $current_featured_properties ) {

			/**
			 * Only update required ( Total - Allowed ) properties to pending status
			 */
			$user_total_featured_properties       = inspiry_get_featured_properties_by_user( $user_id );
			$user_total_featured_properties_count = 0;
			if ( ! empty( $user_total_featured_properties ) ) {
				$user_total_featured_properties_count = count( $user_total_featured_properties );
			}

			if ( $user_total_featured_properties_count > $current_featured_properties ) {

				// Get number of properties to update ( Total - Allowed )
				$number_of_properties_to_update 		= $user_total_featured_properties_count - $current_featured_properties;
				$user_modifiable_featured_properties	= inspiry_get_featured_properties_by_user( $user_id, array( 'publish' ), $number_of_properties_to_update, 'ASC' );

				if ( ! empty( $user_modifiable_featured_properties ) ) {
					foreach ( $user_modifiable_featured_properties as $property ) {
						update_post_meta( $property->ID, 'REAL_HOMES_featured', false );
						update_post_meta( $property->ID, 'pre_feature_state', false );
					}
				}

				// Update user's current properties number
				update_user_meta( $user_id, 'ims_current_featured_props', 0 );

			} else {
				// if $user_total_properties_count <= $current_properties then we do not need to do anything
				update_user_meta( $user_id, 'ims_current_featured_props', $current_featured_properties - $user_total_featured_properties_count );
			}

		}

	}

}


if ( ! function_exists( 'inspiry_downgrade_user_membership' ) ) {

	/**
	 * Downgrade User Membership.
	 *
	 * @since 2.6.4
	 */
	function inspiry_downgrade_user_membership( $args ) {

		if ( empty( $args ) || ! is_array( $args ) ) {
			return false;
		}

		$user_id 			= $args[ 'user_id' ];
		$prev_membership 	= $args[ 'prev_membership' ];
		$current_membership = $args[ 'current_membership' ];

		if ( empty( $user_id ) || empty( $prev_membership ) || empty( $current_membership ) ) {
			return false;
		}

		/**
		 * Update Package Properties.
		 */
		remove_action( 'init', 'inspiry_add_membership_hooks' );

		$current_package_properties	= $current_membership->get_properties();

		/**
		 * Only update required ( Total - Allowed ) properties to pending status
		 */
		$user_total_properties       = inspiry_get_properties_by_user( $user_id );
		$user_total_properties_count = 0;
		if ( ! empty( $user_total_properties ) ) {
			$user_total_properties_count = count( $user_total_properties );
		}

		if ( $user_total_properties_count > $current_package_properties ) {

			// Get number of properties to update ( Total - Allowed )
			$number_of_properties_to_update = $user_total_properties_count - $current_package_properties;
			$user_modifiable_properties     = inspiry_get_properties_by_user( $user_id, 'publish', $number_of_properties_to_update, 'ASC' );

			if ( ! empty( $user_modifiable_properties ) ) {
				foreach ( $user_modifiable_properties as $property ) {
					$property_args = array(
						'ID'          => $property->ID,
						'post_status' => 'pending'
					);
					wp_update_post( $property_args );
				}
			}

			// Update user's current properties number
			update_user_meta( $user_id, 'ims_current_properties', 0 );

		} else {
			// if $user_total_properties_count <= $current_properties then we do not need to do anything
			update_user_meta( $user_id, 'ims_current_properties', $current_package_properties - $user_total_properties_count );
		}

		/**
		 * Update Package Featured Properties
		 */
		$prev_featured_properties		= $prev_membership->get_featured_properties();
		$current_featured_properties	= $current_membership->get_featured_properties();

		if ( $prev_featured_properties <= $current_featured_properties ) {

			/**
			 * Get count for published featured properties and then count
			 * remaining available featured properties in the package.
			 */
			$user_existing_featured_properties	= inspiry_get_featured_properties_by_user( $user_id );
			$user_existing_featured_count 		= 0;
			if ( ! empty( $user_existing_featured_properties ) ) {
				$user_existing_featured_count = count( $user_existing_featured_properties );
			}

			// Remaining available count of properties in current package.
			$user_remaining_featured_count = $current_featured_properties - $user_existing_featured_count;

			// Get pending properties that can be published on upgrading membership.
			$user_modifiable_featured_properties	= inspiry_get_featured_properties_by_user( $user_id, array( 'pending' ), $user_remaining_featured_count );
			$user_modifiable_featured_count 		= 0;

			if ( ! empty( $user_modifiable_featured_properties ) ) {
				$user_modifiable_featured_count	= count( $user_modifiable_featured_properties );
			}

			// Deduct the number of properties already present.
			update_user_meta( $user_id, 'ims_current_featured_props', $current_featured_properties - ( $user_existing_featured_count + $user_modifiable_featured_count ) );

		} elseif ( $prev_featured_properties > $current_featured_properties ) {

			/**
			 * Only update required ( Total - Allowed ) properties to pending status
			 */
			$user_total_featured_properties       = inspiry_get_featured_properties_by_user( $user_id );
			$user_total_featured_properties_count = 0;
			if ( ! empty( $user_total_featured_properties ) ) {
				$user_total_featured_properties_count = count( $user_total_featured_properties );
			}

			if ( $user_total_featured_properties_count > $current_featured_properties ) {

				// Get number of properties to update ( Total - Allowed )
				$number_of_properties_to_update 		= $user_total_featured_properties_count - $current_featured_properties;
				$user_modifiable_featured_properties	= inspiry_get_featured_properties_by_user( $user_id, array( 'publish' ), $number_of_properties_to_update, 'ASC' );

				if ( ! empty( $user_modifiable_featured_properties ) ) {
					foreach ( $user_modifiable_featured_properties as $property ) {
						update_post_meta( $property->ID, 'REAL_HOMES_featured', false );
						update_post_meta( $property->ID, 'pre_feature_state', false );
					}
				}

				// Update user's current properties number
				update_user_meta( $user_id, 'ims_current_featured_props', 0 );

			} else {
				// if $user_total_properties_count <= $current_properties then we do not need to do anything
				update_user_meta( $user_id, 'ims_current_featured_props', $current_featured_properties - $user_total_featured_properties_count );
			}

		}

	}

}


if ( ! function_exists( 'inspiry_get_properties_by_user' ) ) :
	function inspiry_get_properties_by_user( $user_id, $post_status = 'publish', $posts_per_page = - 1, $order = 'DESC' ) {

		if ( empty( $user_id ) || 0 >= $user_id ) {
			return false;
		}

		return get_posts( array(
			'author'         => $user_id,
			'post_type'      => 'property',
			'post_status'    => $post_status,
			'posts_per_page' => $posts_per_page,
			'order'          => $order,
		) );
	}
endif;


if ( ! function_exists( 'inspiry_get_featured_properties_by_user' ) ) :
	function inspiry_get_featured_properties_by_user( $user_id, $post_status = array( 'publish' ), $posts_per_page = - 1, $order = 'DESC' ) {

		if ( empty( $user_id ) || 0 >= $user_id ) {
			return false;
		}

		return get_posts( array(
			'author'         	=> $user_id,
			'post_type'      	=> 'property',
			'post_status'    	=> $post_status,
			'posts_per_page'	=> $posts_per_page,
			'order'          	=> $order,
			'meta_compare'		=> '=',
			'meta_key'			=> 'REAL_HOMES_featured',
			'meta_value'		=> '1',
		) );
	}
endif;


if ( ! function_exists( 'inspiry_add_membership' ) ) {

	/**
	 * Manage properties while buying a membership.
	 *
	 * @since 1.0.0
	 */
	function inspiry_add_membership( $user_id, $membership_id ) {

		// If inspiry-memberships plugin is not active then return.
		if ( ! function_exists( 'ims_get_membership_object' ) ) {
			return false;
		}

		// Bail if paramters are empty.
		if ( empty( $user_id ) || empty( $membership_id ) ) {
			return false;
		}

		$membership_obj 	= ims_get_membership_object( $membership_id );
		$properties_number 	= $membership_obj->get_properties();
		$featured_properties_number	= $membership_obj->get_featured_properties();

		/**
		 * The WordPress Query class.
		 * @link http://codex.wordpress.org/Function_Reference/WP_Query
		 *
		 */
		$properties_args	= array(
			'author'      		=> $user_id, // Author Parameters
			'post_type'   		=> 'property', // Type & Status Parameters
			'post_status' 		=> array( 'pending' ),
			'posts_per_page'	=> -1 // Pagination Parameters
		);

		// Get properties of the user.
		$properties = get_posts( $properties_args );
		$count 		= count( $properties );
		$featured_count	= 0;

		if ( $count <= $properties_number ) {

			if ( ! empty( $properties ) ) {

				foreach ( $properties as $property ) {

					// Update the property status to publish.
					$property_args	= array(
						'ID' 			=> $property->ID,
						'post_status'	=> 'publish'
					);
					wp_update_post( $property_args );

					/**
					 * Get featured meta of property and update
					 * the number of featured properties
					 * accordingly.
					 */
					$is_featured	= get_post_meta( $property->ID, 'REAL_HOMES_featured', true );

					if ( ! empty( $is_featured ) && ( $featured_count < $featured_properties_number ) ) {
						$featured_count++;
					} elseif ( ! empty( $is_featured ) && ( $featured_count >= $featured_properties_number ) ) {
						update_post_meta( $property->ID, 'REAL_HOMES_featured', false );
						update_post_meta( $property->ID, 'pre_feature_state', false );
					}

				}

				$featured_difference	= $featured_properties_number - $featured_count;
				update_user_meta( $user_id, 'ims_current_featured_props', $featured_difference );

			}

			// Deduct the number of properties already present.
			$difference	= $properties_number - $count;
			update_user_meta( $user_id, 'ims_current_properties', $difference );

		} elseif ( $count > $properties_number ) {

			if ( ! empty( $properties ) ) {

				foreach ( $properties as $property ) {

					/**
					 * When properties count reaches zero,
					 * turn the remaining properties to pending.
					 */
					if ( $properties_number > 0 ) {

						$property_args	= array(
							'ID' 			=> $property->ID,
							'post_status'	=> 'publish'
						);
						wp_update_post( $property_args );
						$properties_number--;

					} elseif ( $properties_number <= 0 ) {

						$property_args	= array(
							'ID' 			=> $property->ID,
							'post_status'	=> 'pending'
						);
						wp_update_post( $property_args );

					}

					/**
					 * Get featured meta of property and update
					 * the number of featured properties
					 * accordingly.
					 */
					$is_featured	= get_post_meta( $property->ID, 'REAL_HOMES_featured', true );

					if ( ! empty( $is_featured ) && ( $featured_count < $featured_properties_number ) ) {
						$featured_count++;
					} elseif ( ! empty( $is_featured ) && ( $featured_count >= $featured_properties_number ) ) {
						update_post_meta( $property->ID, 'REAL_HOMES_featured', false );
						update_post_meta( $property->ID, 'pre_feature_state', false );
					}

				}

				update_user_meta( $user_id, 'ims_current_properties', $properties_number );
				$featured_difference	= $featured_properties_number - $featured_count;
				update_user_meta( $user_id, 'ims_current_featured_props', $featured_difference );

			}

		}

	}

	add_action( 'ims_add_user_membership', 'inspiry_add_membership', 10, 2 );
}


if ( ! function_exists( 'inspiry_membership_success_redirect' ) ) {

	/**
	 * Filter the redirect URL upon successful membership
	 * purchase.
	 *
	 * @param string $redirect_url - Redirect URL.
	 * @since 2.6.4
	 */
	function inspiry_membership_success_redirect( $redirect_url ) {

		$rh_design_variation = INSPIRY_DESIGN_VARIATION;

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$edit_profile_url 	= inspiry_get_edit_profile_url();
			$redirect_url		= add_query_arg( array( 'membership' => 'purchased' ), $edit_profile_url );
			return $redirect_url;
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$membership_url 	= inspiry_get_membership_url();
			$redirect_url		= add_query_arg( array( 'membership' => 'purchased' ), $membership_url );
			return $redirect_url;
		}

	}

	add_filter( 'ims_membership_success_redirect', 'inspiry_membership_success_redirect', 10, 1 );
}


if ( ! function_exists( 'inspiry_membership_failed_redirect' ) ) {

	/**
	 * Filter the redirect URL upon failed membership
	 * purchase.
	 *
	 * @param string $redirect_url - Redirect URL.
	 * @since 2.6.4
	 */
	function inspiry_membership_failed_redirect( $redirect_url ) {

		$rh_design_variation = INSPIRY_DESIGN_VARIATION;

		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$edit_profile_url 	= inspiry_get_edit_profile_url();
			$redirect_url		= add_query_arg( array( 'membership' => 'failed' ), $edit_profile_url );
			return $redirect_url;
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$membership_url 	= inspiry_get_membership_url();
			$redirect_url		= add_query_arg( array( 'membership' => 'failed' ), $membership_url );
			return $redirect_url;
		}

	}

	add_filter( 'ims_membership_failed_redirect', 'inspiry_membership_failed_redirect', 10, 1 );
}


if ( ! function_exists( 'inspiry_user_membership_update_routine' ) ) {

	/**
	 * This method updates the number of properties after modification
	 * of the membership from admin panel.
	 *
	 * @since 2.6.4
	 */
	function inspiry_user_membership_update_routine( $user_id, $membership_id, $prev_membership_details ) {

		// Bail if parameters are empty.
		if ( empty( $user_id ) || empty( $membership_id ) || empty( $prev_membership_details ) ) {
			return false;
		}

		if ( ! function_exists( 'ims_get_membership_object' ) ) {
			return false;
		}

		// Sanitize the parameters.
		$user_id		= intval( $user_id );
		$membership_id	= intval( $membership_id );

		// Extracting previous membership details.
		$prev_package_properties	= ( isset( $prev_membership_details[ 'package_properties' ] ) ) ? $prev_membership_details[	'package_properties' ] : false;
		$prev_current_properties	= ( isset( $prev_membership_details[ 'current_properties' ] ) ) ? $prev_membership_details[	'current_properties' ] : false;
		$prev_package_featured		= ( isset( $prev_membership_details[ 'package_featured' ] ) ) ? $prev_membership_details[	'package_featured' ] : false;
		$prev_current_featured		= ( isset( $prev_membership_details[ 'current_featured' ] ) ) ? $prev_membership_details[	'current_featured' ] : false;

		// Getting new membership details.
		$membership_obj	= ims_get_membership_object( $membership_id );
		$properties 	= $membership_obj->get_properties();
		$featured_props = $membership_obj->get_featured_properties();

		// Package properties use cases checks.
		if ( $properties == $prev_package_properties ) {
			// Do nothing.
		} elseif ( $properties > $prev_package_properties ) {

			$user_properties = $prev_package_properties - $prev_current_properties;
			update_user_meta( $user_id, 'ims_current_properties', $properties - $user_properties );


		} elseif ( $properties < $prev_package_properties ) {

			$user_properties = $prev_package_properties - $prev_current_properties;

			if ( $properties >= $user_properties ) {
				update_user_meta( $user_id, 'ims_current_properties', $properties - $user_properties );
			} elseif ( $properties < $user_properties ) {

				$number_of_properties_to_update	= $user_properties - $properties;
				$properties_to_update 	= inspiry_get_properties_by_user( $user_id, 'publish', $number_of_properties_to_update, 'ASC' );

				if ( ! empty( $properties_to_update ) ) {
					foreach ( $properties_to_update as $property ) {
						$property_args	= array(
							'ID'		  => $property->ID,
							'post_status' => 'pending',
						);
						wp_update_post( $property_args );
					}
				}
				update_user_meta( $user_id, 'ims_current_properties', 0 );
			}
		}

		// Package featured properties use cases checks.
		if ( $featured_props == $prev_package_featured ) {
			// Do nothing.
		} elseif ( $featured_props > $prev_package_featured ) {

			$user_featured_properties = $prev_package_featured - $prev_current_featured;
			update_user_meta( $user_id, 'ims_current_featured_props', $featured_props - $user_featured_properties );

		} elseif ( $featured_props < $prev_package_featured ) {

			$user_featured_properties = $prev_package_featured - $prev_current_featured;

			if ( $featured_props >= $user_featured_properties ) {
				update_user_meta( $user_id, 'ims_current_featured_props', $featured_props - $user_featured_properties );
			} elseif ( $featured_props < $user_featured_properties ) {

				$number_of_properties_to_update	= $user_featured_properties - $featured_props;
				$properties_to_update 	= inspiry_get_featured_properties_by_user( $user_id, array( 'publish' ), $number_of_properties_to_update, 'ASC' );

				if ( ! empty( $properties_to_update ) ) {
					foreach ( $properties_to_update as $property ) {
						update_post_meta( $property->ID, 'REAL_HOMES_featured', false );
						update_post_meta( $property->ID, 'pre_feature_state', false );
					}
				}
				update_user_meta( $user_id, 'ims_current_featured_props', 0 );
			}
		}

	}

	add_action( 'ims_update_user_recurring_membership', 'inspiry_user_membership_update_routine', 10, 3 );
}
