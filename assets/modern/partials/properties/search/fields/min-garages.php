<?php
/**
 * Field: Garages
 *
 * Garages field for advance property search.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

?>

<div class="rh_prop_search__option rh_prop_search__select">
	<label for="select-garages">
		<?php
		$inspiry_min_garages_label = get_option( 'inspiry_min_garages_label' );
		echo $inspiry_min_garages_label ? esc_html( $inspiry_min_garages_label ) : esc_html__( 'Min Garages', 'framework' );
		?>
	</label>
	<span class="rh_prop_search__selectwrap">
		<select name="garages" id="select-garages" class="rh_select2">
			<?php inspiry_min_garages(); ?>
		</select>
	</span>
</div>
