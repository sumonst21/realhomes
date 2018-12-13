<?php
/**
 * Gallery post format.
 *
 * @package    realhomes
 * @subpackage modern
 */

?>
<div class="rh_slider_mod">
	<div class="listing-slider ">
		<ul class="slides">
			<?php list_gallery_images(); ?>
		</ul>
	</div>
	<div class="rh_flexslider__nav_main">
		<a href="#" class="flex-prev rh_flexslider__prev">
			<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-arrow-right.svg' ); ?>
		</a>
		<!-- /.rh_flexslider__prev -->
		<a href="#" class="flex-next rh_flexslider__next">
			<?php include( INSPIRY_THEME_DIR . '/images/icons/icon-arrow-right.svg' ); ?>
		</a>
		<!-- /.rh_flexslider__next -->
	</div>
</div>
