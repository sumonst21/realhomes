<?php
/**
 * Widget: Real Homes Contact Information
 *
 * Contact information widget for Real Homes.
 *
 * @since   3.0.0
 * @package RH/modern
 */

if ( ! class_exists( 'RH_Contact_Information' ) ) :

	/**
	 * RH_Contact_Information.
	 *
	 * Contact Information widget for Real Homes.
	 *
	 * @since 3.0.0
	 */
	class RH_Contact_Information extends WP_Widget {

		/**
		 * Method: Constructor.
		 *
		 * @since 3.0.0
		 */
		function __construct() {
			$widget_ops = array(
				'classname'                   => 'RH_Contact_Information',
				'description'                 => __( 'Displays general contact information.', 'framework' ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'RH_Contact_Information', __( 'RealHomes - Contact Information', 'framework' ), $widget_ops );
		}

		/**
		 * Method: Widget Front-End Display.
		 *
		 * @param array $args - contains the argument of the widget.
		 * @param array $instance - contains the parameters of the widget.
		 *
		 * @since 3.0.0
		 */
		function widget( $args, $instance ) {

			extract( $args );

			$title   = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? esc_html( $instance['title'] ) : false;
			$address = ( isset( $instance['address'] ) && ! empty( $instance['address'] ) ) ? esc_html( $instance['address'] ) : false;
			$number  = ( isset( $instance['number'] ) && ! empty( $instance['number'] ) ) ? esc_html( $instance['number'] ) : false;
			$email   = ( isset( $instance['email'] ) && ! empty( $instance['email'] ) ) ? esc_html( $instance['email'] ) : false;

			echo $before_widget;
			?>
			<div class="rh_contact_widget">
				<?php
					if ( ! empty( $title ) ) {
						echo '<h3 class="title">' . esc_html__( $title ) . '</h3>';
					}
				?>
				<div class="rh_contact_widget__item rh_contact_widget--alignBaseline">
					<p class="icon"><?php include( INSPIRY_THEME_DIR . '/images/icons/icon-marker.svg' ); ?></p>
					<p class="content"><?php echo esc_html( $address ); ?></p>
				</div>
				<div class="rh_contact_widget__item rh_contact_widget--alignBaseline">
					<p class="icon"><?php include( INSPIRY_THEME_DIR . '/images/icons/icon-phone.svg' ); ?></p>
					<p class="content"><?php echo esc_html( $number ); ?></p>
				</div>
				<div class="rh_contact_widget__item rh_contact_widget--alignBaseline">
					<p class="icon"><?php include( INSPIRY_THEME_DIR . '/images/icons/icon-mail.svg' ); ?></p>
					<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" class="content">
						<?php echo esc_html( antispambot( $email ) ); ?>
					</a>
				</div>
			</div>			<!-- /.rh_contact_widget -->
			<?php
			echo $after_widget;
		}

		/**
		 * Method: Widget Form.
		 *
		 * @param array $instance - contains the parameters of the widget.
		 *
		 * @since 3.0.0
		 * @return void
		 */
		function form( $instance ) {
			$instance = wp_parse_args(
				(array) $instance,
				array(
					'title' => '',
					'address' => esc_html__( '3015 Grand Ave, Coconut Grove, Merrick Way, FL 12345', 'framework' ),
					'number'  => esc_html__( '+123-456-789', 'framework' ),
					'email'   => esc_html__( 'robot@inspirythemes.com', 'framework' ),
				)
			);

			$title   = esc_html( $instance['title'] );
			$address = esc_html( $instance['address'] );
			$number  = esc_html( $instance['number'] );
			$email   = ( is_email( $instance['email'] ) ) ? esc_html( $instance['email'] ) : false;
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'framework' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
			</p>			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Contact Address', 'framework' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>"/>
			</p>			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Phone Number', 'framework' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>"/>
			</p>			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email', 'framework' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>"/>
			</p>
			<?php
		}

	}

endif;

if ( ! function_exists( 'register_contact_widget' ) ) {
	/**
	 * Register Contact Widget
	 */
	function register_contact_widget() {
		register_widget( 'RH_Contact_Information' );
	}

	add_action( 'widgets_init', 'register_contact_widget' );
}
