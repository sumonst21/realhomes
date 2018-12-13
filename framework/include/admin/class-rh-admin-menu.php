<?php
/**
 * Admin Menu Class
 *
 * Class file for admin menu of Real Homes.
 *
 * @since 3.3.1
 * @package RH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'RH_Admin_Menu' ) ) :

	/**
	 * RH_Admin_Menu.
	 *
	 * Class for creating admin menu of Real Homes.
	 *
	 * @since 3.3.1
	 */
	class RH_Admin_Menu {

		/**
		 * Class instance.
		 *
		 * @var object
		 * @since 3.3.1
		 */
		public static $_instance;

		/**
		 * Cap for admin menu.
		 *
		 * @var string
		 * @since 3.3.1
		 */
		public $menu_capability = 'manage_categories';

		/**
		 * Method: Contructor.
		 *
		 * @since 3.3.1
		 */
		public function __construct() {

			// Admin menu.
			add_action( 'admin_menu', array( $this, 'real_homes_menu' ), 10 );

			// Current menu when clicked on a tab.
			add_action( 'admin_footer', array( $this, 'open_menu' ) );

			if ( class_exists( 'OCDI_Plugin' ) ) {
				// Add demo import page to Real Homes Menu.
				add_filter( 'pt-ocdi/plugin_page_setup', array( $this, 'move_import_demo_data' ), 10, 1 );
			}

		}

		/**
		 * Method: Return instance.
		 *
		 * @since 3.3.1
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Register Real Homes Menu.
		 *
		 * Custom menu for Real Homes.
		 *
		 * @since 3.3.1
		 */
		public function real_homes_menu() {

			/**
			 * Add menu page.
			 *
			 * @param string   $page_title Menu data attribute.
			 * @param string   $menu_title Menu data attribute.
			 * @param string   $capability Menu data attribute.
			 * @param string   $menu_slug Menu data attribute.
			 * @param callable $function = '' Menu data attribute.
			 * @param string   $icon_url = '' Menu data attribute.
			 * @param int      $position = null Menu data attribute.
			 */
			add_menu_page(
				__( 'Real Homes', 'framework' ),
				__( 'Real Homes', 'framework' ),
				'edit_posts',
				'real_homes',
				'',
				'dashicons-admin-multisite',
				'5'
			);

			// Filter $_SERVER array.
			$server_array = filter_input_array( INPUT_SERVER );

			// Add all sub menus.
			$sub_menus = array(
				'addnew' => array(
					'real_homes',
					__( 'Add New Property', 'framework' ),
					__( 'New Property', 'framework' ),
					'edit_posts',
					'post-new.php?post_type=property',
				),
				'propertyfeatures' => array(
					'real_homes',
					__( 'Add New Property Features', 'framework' ),
					__( 'Property Features', 'framework' ),
					$this->menu_capability,
					'edit-tags.php?taxonomy=property-feature&post_type=property',
				),
				'propertytypes' => array(
					'real_homes',
					__( 'Add New Property Types', 'framework' ),
					__( 'Property Types', 'framework' ),
					$this->menu_capability,
					'edit-tags.php?taxonomy=property-type&post_type=property',
				),
				'propertycities' => array(
					'real_homes',
					__( 'Add New Property Cities', 'framework' ),
					__( 'Property Cities', 'framework' ),
					$this->menu_capability,
					'edit-tags.php?taxonomy=property-city&post_type=property',
				),
				'propertystatus' => array(
					'real_homes',
					__( 'Add New Property Status', 'framework' ),
					__( 'Property Status', 'framework' ),
					$this->menu_capability,
					'edit-tags.php?taxonomy=property-status&post_type=property',
				),
				'auctionpropertybids' => array(
					'real_homes',
					__( 'Auction Bids', 'framework' ),
					__( 'Auction Bids', 'framework' ),
					$this->menu_capability,
					'edit.php?post_type=auction_bids',
				),
				// 'propertypayments' => array(
				// 	'real_homes',
				// 	__( 'Property Payments', 'framework' ),
				// 	__( 'Property Payments', 'framework' ),
				// 	$this->menu_capability,
				// 	'admin.php?page=properties-payments',
				// ),
				'agencies' => array(
					'real_homes',
					esc_html__( 'Agencies', 'framework' ),
					esc_html__( 'Agencies', 'framework' ),
					$this->menu_capability,
					'edit.php?post_type=agency',
				),
				'agents' => array(
					'real_homes',
					__( 'Agents', 'framework' ),
					__( 'Agents', 'framework' ),
					$this->menu_capability,
					'edit.php?post_type=agent',
				),
				'partners' => array(
					'real_homes',
					__( 'Partners', 'framework' ),
					__( 'Partners', 'framework' ),
					$this->menu_capability,
					'edit.php?post_type=partners',
				),
				'slides' => array(
					'real_homes',
					__( 'Slides', 'framework' ),
					__( 'Slides', 'framework' ),
					$this->menu_capability,
					'edit.php?post_type=slide',
				),
				'settings' => array(
					'real_homes',
					__( 'Customize Settings', 'framework' ),
					__( 'Customize Settings', 'framework' ),
					'manage_options',
					add_query_arg( 'return', rawurlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $server_array['REQUEST_URI'] ) ) ), 'customize.php' ),
				),
				'design' => array(
					'real_homes',
					__( 'Design', 'framework' ),
					__( 'Design', 'framework' ),
					'manage_options',
					'admin.php?page=inspiry-real-homes-design',
				),
			);

			// Add demo page if one click demo import plugin exists.
			if ( class_exists( 'OCDI_Plugin' ) ) {
				// Add demo import page.
				$sub_menus['demoimport'] = array(
					'real_homes',
					__( 'Demo Import', 'framework' ),
					__( 'Demo Import', 'framework' ),
					$this->menu_capability,
					'admin.php?page=pt-one-click-demo-import',
				);
			}

			// Third-party can add more sub_menus.
			$sub_menus = apply_filters( 'real_homes_sub_menus', $sub_menus, 20 );

			/**
			 * Add Submenu.
			 *
			 * @param string $parent_slug
			 * @param string $page_title
			 * @param string $menu_title
			 * @param string $capability
			 * @param string $menu_slug
			 * @param callable $function = ''
			 * @since  1.0.0
			 */
			if ( $sub_menus ) {
				foreach ( $sub_menus as $sub_menu ) {
					call_user_func_array( 'add_submenu_page', $sub_menu );
				}
			}

		}

		/**
		 * Method: Move Import Demo Data page to Real Homes menu.
		 *
		 * @param array $args - Array of arguments from OneClickDemoImport filter.
		 * @since 3.3.1
		 * @return array
		 */
		public function move_import_demo_data( $args ) {

			// Check the args.
			if ( empty( $args ) || ! is_array( $args ) ) {
				return $args;
			}

			$args = array(
				'parent_slug' => 'edit.php?post_type=property',
				'page_title'  => esc_html__( 'One Click Demo Import' , 'pt-ocdi' ),
				'menu_title'  => esc_html__( 'Demo Import' , 'pt-ocdi' ),
				'capability'  => 'import',
				'menu_slug'   => 'pt-one-click-demo-import',
			);
			return $args;

		}

		/**
		 * WP menu open.
		 *
		 * Open Real Homes menu when clicked on a tab.
		 *
		 * @since 1.0.0
		 */
		public function open_menu() {
			// Get Current Screen.
			$screen = get_current_screen();
			$menu_arr = apply_filters( 'real_homes_open_menus_slugs', array(
				'property',
				'edit-property',
				'edit-property-feature',
				'edit-property-type',
				'edit-property-city',
				'edit-property-status',
				'admin_page_properties-payments',
				'agent',
				'partners',
				'slide',
				'admin_page_pt-one-click-demo-import',
				'admin_page_inspiry-real-homes-design',
			) );

			// Check if the current screen's ID has any of the above menu array items.
			if ( in_array( $screen->id, $menu_arr ) ) { ?>
				<script type="text/javascript">
					jQuery( "body" ).removeClass( "sticky-menu" );
					jQuery( "#toplevel_page_real_homes" ).addClass( 'wp-has-current-submenu wp-menu-open' ).removeClass( 'wp-not-current-submenu' );
					jQuery( "#toplevel_page_real_homes > a" ).addClass( 'wp-has-current-submenu wp-menu-open' ).removeClass( 'wp-not-current-submenu' );
					<?php
					// Filter $_GET array for security.
					$get_array = filter_input_array( INPUT_GET );
					$current_menu = '';

					if ( isset( $get_array['taxonomy'] ) && ( 'property-feature' === $get_array['taxonomy'] ) ) {
						$current_menu = 'taxonomy=property-feature';
					}
					if ( isset( $get_array['taxonomy'] ) && ( 'property-type' === $get_array['taxonomy'] ) ) {
						$current_menu = 'taxonomy=property-type';
					}
					if ( isset( $get_array['taxonomy'] ) && ( 'property-city' === $get_array['taxonomy'] ) ) {
						$current_menu = 'taxonomy=property-city';
					}
					if ( isset( $get_array['taxonomy'] ) && ( 'property-status' === $get_array['taxonomy'] ) ) {
						$current_menu = 'taxonomy=property-status';
					}
					if ( isset( $get_array['page'] ) && ( 'inspiry-real-homes-design' === $get_array['page'] ) ) {
						$current_menu = 'page=inspiry-real-homes-design';
					}
					if ( isset( $get_array['page'] ) && ( 'pt-one-click-demo-import' === $get_array['page'] ) ) {
						$current_menu = 'page=pt-one-click-demo-import';
					}

					if ( isset( $get_array['page'] ) && ( 'rvr-settings' === $get_array['page'] ) ) {
						$current_menu = 'page=rvr-settings';
					}
					?>

					$(document).ready(function(){
						if( '<?php echo esc_html( $current_menu ); ?>' ) {
							const anchors = $('#toplevel_page_real_homes ul').find('li').children('a');
							anchors.each(function(){
								if(this.href.indexOf('<?php echo esc_html( $current_menu ); ?>') >= 0) {
									$(this).parent('li').addClass("current");
								}
							});
						}
					});
				</script>
				<?php
			}
		}

	}

endif;


/**
 * Initialize admin menu class.
 *
 * @since 3.3.1
 */
function inspiry_admin_menu() {
	return RH_Admin_Menu::instance();
}
inspiry_admin_menu();
