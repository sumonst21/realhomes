<?php

	$availability_table = get_post_meta( get_the_ID(), 'rvr_property_availability_table', true );
	$data_dates = array();

	if ( ! empty( $availability_table ) && is_array( $availability_table ) ) {
		foreach ( $availability_table as $dates ) {

			$begin = new DateTime( $dates[0] );
			$end   = new DateTime( $dates[1] );
			$end   = $end->modify( '+1 day' );

			$interval  = new DateInterval( 'P1D' );
			$daterange = new DatePeriod( $begin, $interval, $end );

			foreach ( $daterange as $date ) {
				$data_dates[] = $date->format( "Y-m-d" );
			}
		}

		$data_dates = implode( $data_dates, ',' );
	}
?>

<div id="property-availability" data-toggle="calendar" data-dates="<?php echo ! empty( $data_dates ) ? $data_dates : ''; ?>"></div>