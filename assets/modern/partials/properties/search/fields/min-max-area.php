<?php
/**
 * Field: Property Area
 *
 * Area field for advance property search.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

$area_unit 				= get_option( 'theme_area_unit' );
$min_area_placeholder 	= get_option( 'inspiry_min_area_placeholder_text' );
$max_area_placeholder 	= get_option( 'inspiry_max_area_placeholder_text' );
?>
<div class="rh_prop_search__option">
	<label for="min-area">
		<span class="label">
			<?php
		    $inspiry_min_area_label = get_option( 'inspiry_min_area_label' );
		    echo $inspiry_min_area_label ? esc_html( $inspiry_min_area_label ) : esc_html__( 'Min Area', 'framework' );
		    ?>
	    </span>
		<span class="unit">
			<?php
			if ( $area_unit ) {
		        echo esc_html( "($area_unit)" );
		    }
		    ?>
	    </span>
	</label>
	<input type="text" name="min-area" id="min-area" pattern="[0-9]+"
	       value="<?php echo isset( $_GET['min-area'] ) ? $_GET['min-area'] : ''; ?>"
	       placeholder="<?php echo empty( $min_area_placeholder ) ? esc_attr( inspiry_any_text() ) : esc_attr( $min_area_placeholder ); ?>"
	       title="<?php esc_attr_e( 'Only provide digits!', 'framework' ); ?>" />
</div>

<div class="rh_prop_search__option">
	<label for="max-area">
		<span class="label">
			<?php
		    $inspiry_max_area_label = get_option( 'inspiry_max_area_label' );
		    echo $inspiry_max_area_label ? esc_html( $inspiry_max_area_label ) : esc_html__( 'Max Area', 'framework' );
		    ?>
	    </span>
		<span class="unit">
			<?php
			if ( $area_unit ) {
	            echo esc_html( "($area_unit)" );
	        }
	        ?>
		</span>
	</label>
	<input type="text" name="max-area" id="max-area" pattern="[0-9]+"
	       value="<?php echo isset( $_GET['max-area'] ) ? $_GET['max-area'] : '' ; ?>"
	       placeholder="<?php echo empty( $max_area_placeholder ) ? esc_attr( inspiry_any_text() ) : esc_attr( $max_area_placeholder ); ?>"
	       title="<?php esc_attr_e( 'Only provide digits!', 'framework' ); ?>" />
</div>
