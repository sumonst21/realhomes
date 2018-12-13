<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="format-detection" content="telephone=no">

<?php
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		$favicon = get_option( 'theme_favicon' );
		if ( ! empty( $favicon ) ) {
			?>
			<link rel="shortcut icon" href="<?php echo esc_url( $favicon ); ?>"/>
			<?php
		}
	}

	if ( is_singular() && pings_open( get_queried_object() ) ) {
		?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}

	wp_head();
?>
  <?php if( is_front_page() ) : ?>
<script type='text/javascript' src='//maps.google.com/maps/api/js?key=AIzaSyDGMXPd8R7pQlx8VaA1kGo2fLXI-7QXYsg&#038;language=en_US&#038;ver=3.21'></script>
<script type='text/javascript' src='http://majella.nukasystem.com/wp-content/themes/realhomes/assets/modern/scripts/vendors/infobox.js?ver=1.1.9'></script>
<script type='text/javascript' src='http://majella.nukasystem.com/wp-content/themes/realhomes/assets/modern/scripts/vendors/markerclusterer.js?ver=2.1.1'></script>
<script type='text/javascript' src='http://majella.nukasystem.com/wp-content/themes/realhomes/assets/modern/scripts/vendors/oms.min.js?ver=0.3.3'></script>
  <?php endif; ?>
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'd7f53137321e867ff8b1f4ab96274a661d4e5970';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
</head>
<body <?php body_class(); ?>>

<?php
get_template_part( 'assets/' . INSPIRY_DESIGN_VARIATION . '/partials/header' );
