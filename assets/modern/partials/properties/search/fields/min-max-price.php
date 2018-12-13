<?php
/**
 * Field: Price
 *
 * Price field for advance property search.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

$inspiry_min_price_label = get_option( 'inspiry_min_price_label' );
$inspiry_max_price_label = get_option( 'inspiry_max_price_label' );
?>
<div class="rh_prop_search__option rh_prop_search__select price-for-others">
	<label for="select-min-price">
		<?php echo $inspiry_min_price_label ? esc_html( $inspiry_min_price_label ) : esc_html__( 'Min Price', 'framework' ); ?>
	</label>
	<span class="rh_prop_search__selectwrap">
		<select name="min-price" id="select-min-price" class="rh_select2">
			<?php min_prices_list(); ?>
		</select>
	</span>
</div>

<div class="rh_prop_search__option rh_prop_search__select price-for-others">
	<label for="select-max-price">
		<?php echo $inspiry_max_price_label ? esc_html( $inspiry_max_price_label ) : esc_html__( 'Max Price', 'framework' ); ?>
	</label>
	<span class="rh_prop_search__selectwrap">
		<select name="max-price" id="select-max-price" class="rh_select2">
			<?php max_prices_list(); ?>
		</select>
	</span>
</div>

<?php
/**
 * Prices for Rent
 */
?>
<div class="rh_prop_search__option rh_prop_search__select price-for-rent hide-fields">
	<label for="select-min-price-for-rent">
		<?php echo $inspiry_min_price_label ? esc_html( $inspiry_min_price_label ) : esc_html__( 'Min Price', 'framework' ); ?>
	</label>
	<span class="rh_prop_search__selectwrap">
	    <select name="min-price" id="select-min-price-for-rent" class="rh_select2" disabled="disabled">
	        <?php min_prices_for_rent_list(); ?>
	    </select>
	</span>
</div>

<div class="rh_prop_search__option rh_prop_search__select price-for-rent hide-fields">
	<label for="select-max-price-for-rent">
		<?php echo $inspiry_max_price_label ? esc_html( $inspiry_max_price_label ) : esc_html__( 'Max Price', 'framework' ); ?>
	</label>
	<span class="rh_prop_search__selectwrap">
	    <select name="max-price" id="select-max-price-for-rent" class="rh_select2" disabled="disabled">
	        <?php max_prices_for_rent_list(); ?>
	    </select>
	</span>
</div>
