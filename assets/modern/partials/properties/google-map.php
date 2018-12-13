<?php
/**
 * Map: Listing Property Map
 *
 * Map for map based property listing.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

$properties_for_map = array(
	'post_type'         => 'property',
	'posts_per_page'    => -1,
	'meta_query'        => array(
	    array(
	        'key'       => 'REAL_HOMES_property_address',
	        'compare'   => 'EXISTS',
	    ),
	),
);

if ( is_page_template( 'templates/properties-search.php' ) || is_page_template( 'templates/properties-search-left-sidebar.php' ) || is_page_template( 'templates/properties-search-right-sidebar.php' ) ) {

	/* Apply Search Filter */
	$properties_for_map = apply_filters( 'real_homes_search_parameters', $properties_for_map );

} elseif ( is_page_template( 'templates/home.php' ) ) {

	/* Apply Homepage Properties Filter */
	$properties_for_map = apply_filters( 'real_homes_homepage_properties', $properties_for_map );

} elseif ( is_page_template( array(
	    'templates/list-layout.php',
	    'templates/grid-layout.php',
	    'templates/half-map-layout.php',
) ) ) {

	// Apply pagination.
	global $paged;
	if ( is_front_page()  ) {
	    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	}
	$properties_for_map['paged'] = $paged;

	// Apply properties filter settings from properties list templates.
	$properties_for_map = apply_filters( 'inspiry_properties_filter', $properties_for_map );

	// Apply sorting.
	$properties_for_map = sort_properties( $properties_for_map );

} elseif ( is_tax() ) {

	global $wp_query;
	/* Taxonomy Query */
	$properties_for_map['tax_query'] = array(
	    array(
	        'taxonomy'  => $wp_query->query_vars['taxonomy'],
	        'field'     => 'slug',
	        'terms'     => $wp_query->query_vars['term'],
	    ),
	);

} elseif ( is_post_type_archive( 'property' ) ) {

	$number_of_properties = intval( get_option( 'theme_number_of_properties' ) );
	if ( ! $number_of_properties ) {
		$number_of_properties = 6;
	}

	$properties_for_map['posts_per_page'] = $number_of_properties;

	global $paged;
	$properties_for_map['paged'] = $paged;

}

$properties_for_map_query = new WP_Query( $properties_for_map );

$properties_data = array();

if ( $properties_for_map_query->have_posts() ) :

	while ( $properties_for_map_query->have_posts() ) :

	    $properties_for_map_query->the_post();

	    $current_prop_array = array();

	    /* Property Title */
	    $current_prop_array['title'] = get_the_title();

	    /* Property Price */
	    $current_prop_array['price'] = get_property_price();

	    /* Property Location */
	    $property_location = get_post_meta( get_the_ID(), 'REAL_HOMES_property_location', true );
	    if ( ! empty( $property_location ) ) {
	        $lat_lng = explode( ',', $property_location );
	        $current_prop_array['lat'] = $lat_lng[0];
	        $current_prop_array['lng'] = $lat_lng[1];
	    }

	    /* Property Thumbnail */
	    if ( has_post_thumbnail() ) {
	        $image_id = get_post_thumbnail_id();
	        $image_attributes = wp_get_attachment_image_src( $image_id, 'property-thumb-image' );
	        if ( ! empty( $image_attributes[0] ) ) {
	            $current_prop_array['thumb'] = $image_attributes[0];
	        }
	    }

	    /* Property Title */
	    $current_prop_array['url'] = get_permalink();

		/* Property Map Icon Based on Property Type */
		$type_terms = get_the_terms( $post->ID, "property-type" );
		if ( ! empty( $type_terms ) ) {
			foreach ( $type_terms as $typ_trm ) {
				$icon_id = get_term_meta( $typ_trm->term_id, 'inspiry_property_type_icon', true );
				if ( ! empty ( $icon_id ) ) {
					$icon_url = wp_get_attachment_url( $icon_id );
					if ( $icon_url ) {
						$current_prop_array['icon'] = esc_url( $icon_url );
						$retina_icon_id          = get_term_meta( $typ_trm->term_id, 'inspiry_property_type_icon_retina', true );
						if ( ! empty ( $retina_icon_id ) ) {
							$retina_icon_url = wp_get_attachment_url( $retina_icon_id );
							if ( $retina_icon_url ) {
								$current_prop_array['retinaIcon'] = esc_url( $retina_icon_url );
								break;
							}
						} else {
							break;
						}
					}
				} else {
					$current_prop_array['icon']       = INSPIRY_DIR_URI . '/images/map/single-family-home-map-icon.png';// default icon
					$current_prop_array['retinaIcon'] = INSPIRY_DIR_URI . '/images/map/single-family-home-map-icon@2x.png';  // default retina icon
				}
			}
		} else {
			$current_prop_array['icon']       = INSPIRY_DIR_URI . '/images/map/single-family-home-map-icon.png';// default icon
			$current_prop_array['retinaIcon'] = INSPIRY_DIR_URI . '/images/map/single-family-home-map-icon@2x.png';  // default retina icon
		}

	    $properties_data[] = $current_prop_array;

	endwhile;
	wp_reset_postdata();
	?>
	<script type="text/javascript">
	    function initializePropertiesMap() {

	        /* Properties Array */
	        var properties = <?php echo json_encode( $properties_data ); ?>;

	        /* Map Center Location - From Theme Options */
	        var location_center = new google.maps.LatLng(properties[0].lat,properties[0].lng);

	        var mapOptions = {
	            zoom: 12,
	            maxZoom: 16,
	            scrollwheel: false,
				scaleControl:false,
				streetViewControl:true,
				streetViewControlOptions: {
					<?php if ( is_page_template( 'templates/properties-search.php' ) ) { ?>
					position: google.maps.ControlPosition.LEFT_CENTER
					<?php } else { ?>
					position: google.maps.ControlPosition.RIGHT_TOP,
					<?php } ?>
				},
				fullscreenControl:true,
				fullscreenControlOptions: {
					position: google.maps.ControlPosition.TOP_LEFT
				},
				zoomControl:true,
			    zoomControlOptions: {
				    <?php if ( is_page_template( 'templates/properties-search.php' ) ) { ?>
					position: google.maps.ControlPosition.LEFT_CENTER
				    <?php } else { ?>
					position: google.maps.ControlPosition.LEFT_BOTTOM
				    <?php } ?>
			    },
				mapTypeControl:true,
				mapTypeControlOptions: {
					<?php if ( is_page_template( 'templates/properties-search.php' ) ) { ?>
					position: google.maps.ControlPosition.RIGHT_CENTER,
					<?php } else { ?>
					position: google.maps.ControlPosition.RIGHT_BOTTOM,
					<?php } ?>
					style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
				},
	            styles : [
	            	{
		                "featureType": "landscape",
		                "stylers": [
		                    {
		                        "hue": "#FFBB00"
		                    },
		                    {
		                        "saturation": 43.400000000000006
		                    },
		                    {
		                        "lightness": 37.599999999999994
		                    },
		                    {
		                        "gamma": 1
		                    }
		                ]
		            },
	                {
	                    "featureType": "road.highway",
	                    "stylers": [
	                        {
	                            "hue": "#FFC200"
	                        },
	                        {
	                            "saturation": -61.8
	                        },
	                        {
	                            "lightness": 45.599999999999994
	                        },
	                        {
	                            "gamma": 1
	                        }
	                    ]
	                },
	                {
	                    "featureType": "road.arterial",
	                    "stylers": [
	                        {
	                            "hue": "#FF0300"
	                        },
	                        {
	                            "saturation": -100
	                        },
	                        {
	                            "lightness": 51.19999999999999
	                        },
	                        {
	                            "gamma": 1
	                        }
	                    ]
	                },
	                {
	                    "featureType": "road.local",
	                    "stylers": [
	                        {
	                            "hue": "#FF0300"
	                        },
	                        {
	                            "saturation": -100
	                        },
	                        {
	                            "lightness": 52
	                        },
	                        {
	                            "gamma": 1
	                        }
	                    ]
	                },
	                {
	                    "featureType": "water",
	                    "stylers": [
	                        {
	                            "hue": "#0078FF"
	                        },
	                        {
	                            "saturation": -13.200000000000003
	                        },
	                        {
	                            "lightness": 2.4000000000000057
	                        },
	                        {
	                            "gamma": 1
	                        }
	                    ]
	                },
	                {
	                    "featureType": "poi",
	                    "stylers": [
	                        {
	                            "hue": "#00FF6A"
	                        },
	                        {
	                            "saturation": -1.0989010989011234
	                        },
	                        {
	                            "lightness": 11.200000000000017
	                        },
	                        {
	                            "gamma": 1
	                        }
	                    ]
	                }
	            ]
	        };

	        var map = new google.maps.Map(document.getElementById("listing-map"), mapOptions);

	        var oms = new OverlappingMarkerSpiderfier( map, {
	            markersWontMove: true,
	            markersWontHide: true,
	            keepSpiderfied: true,
	            circleSpiralSwitchover: Infinity,
	            nearbyDistance: 50
	        } );

	        var bounds = new google.maps.LatLngBounds();

	        /* Loop to generate marker and infowindow based on properties array */
	        var markers = new Array();

	        for (var i=0; i < properties.length; i++) {

	            var url = properties[i].icon;
	            var size = new google.maps.Size( 42, 57 );
	            if( window.devicePixelRatio > 1.5 ) {
	                if ( properties[i].retinaIcon ) {
	                    url = properties[i].retinaIcon;
	                    size = new google.maps.Size( 83, 113 );
	                }
	            }

	            var image = {
	                url: url,
	                size: size,
	                scaledSize: new google.maps.Size( 42, 57 ),
	                origin: new google.maps.Point( 0, 0 ),
	                anchor: new google.maps.Point( 21, 56 )
	            };

	            markers[i] = new google.maps.Marker({
	                position: new google.maps.LatLng(properties[i].lat,properties[i].lng),
	                map: map,
	                // icon: properties[i].icon,
	                icon: image,
	                title: properties[i].title,
	                animation: google.maps.Animation.DROP,
	                visible: true
	            });

	            bounds.extend(markers[i].getPosition());

	            var boxText = document.createElement("div");
	            boxText.className = 'map-info-window';

	            var innerHTML = "";
	            if ( properties[i].thumb ) {
	                innerHTML += '<a class="thumb-link" href="' + properties[i].url + '">' +
	                            '<img class="prop-thumb" src="' + properties[i].thumb + '" alt="' + properties[i].title + '"/>' +
	                            '</a>';
	            }

	            innerHTML += '<h5 class="prop-title"><a class="title-link" href="' + properties[i].url + '">' + properties[i].title + '</a></h5>';

	            if ( properties[i].price ) {
	                innerHTML += '<p><span class="price">' + properties[i].price + '</span></p>';
	            }

	            innerHTML += '<div class="arrow-down"></div>';

	            boxText.innerHTML = innerHTML;


	            var myOptions = {
	                content: boxText,
	                disableAutoPan: true,
	                maxWidth: 0,
	                alignBottom: true,
	                pixelOffset: new google.maps.Size( -122, -48 ),
	                zIndex: null,
	                closeBoxMargin: "0 0 -16px -16px",
	                closeBoxURL: "<?php echo INSPIRY_DIR_URI . '/images/map/close.png'; ?>",
	                infoBoxClearance: new google.maps.Size( 1, 1 ),
	                isHidden: false,
	                pane: "floatPane",
	                enableEventPropagation: false
	            };

	            var ib = new InfoBox( myOptions );
	            attachInfoBoxToMarker( map, markers[i], ib );

	            oms.addMarker( markers[i] );
	        }

	        map.fitBounds(bounds);

	        /* Marker Clusters */
	        var markerClustererOptions = {
	            ignoreHidden: true,
	            maxZoom: 14,
	            styles: [{
	                textColor: '#ffffff',
	                url: "<?php echo INSPIRY_DIR_URI . '/images/map/cluster-icon.png'; ?>",
	                height: 48,
	                width: 48
	            }]
	        };

	        var markerClusterer = new MarkerClusterer( map, markers, markerClustererOptions );

	        /* Close previously opened infoBox */
	        var openedWindows = new Array();
	        var closeOpenedWindows = function() {
	            while ( 0 < openedWindows.length ) {
	                var windowToClose = openedWindows.pop();
	                windowToClose.close();
	            }
	        };

	        function attachInfoBoxToMarker( map, marker, infoBox ) {
	            google.maps.event.addListener( marker, 'click', function() {
	                closeOpenedWindows();
	                var scale = Math.pow( 2, map.getZoom() );
	                var offsety = ( (100/scale) || 0 );
	                var projection = map.getProjection();
	                var markerPosition = marker.getPosition();
	                var markerScreenPosition = projection.fromLatLngToPoint( markerPosition );
	                var pointHalfScreenAbove = new google.maps.Point( markerScreenPosition.x, markerScreenPosition.y - offsety );
	                var aboveMarkerLatLng = projection.fromPointToLatLng( pointHalfScreenAbove );
	                map.setCenter( aboveMarkerLatLng );
	                infoBox.open( map, marker );
	                openedWindows.push(infoBox);
	            } );
	        }
	    }

	    google.maps.event.addDomListener( window, 'load', initializePropertiesMap );

	</script>

	<div id="map-head">
		<div id="listing-map"></div>
	</div>
	<!-- End Map Head -->
	<?php
endif;
