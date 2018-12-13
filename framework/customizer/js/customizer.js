/**
 * RealHomes Customizer postMessage JS controls
 *
 * @since 2.6.2
 */
( function( $ ) {

    // Header: Facebook Link
    wp.customize( 'theme_facebook_link', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .facebook a' ).attr( "href", to );
        } );
    } );

    // Header: Twitter Link
    wp.customize( 'theme_twitter_link', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .twitter a' ).attr( "href", to );
        } );
    } );

    // Header: LinkedIn Link
    wp.customize( 'theme_linkedin_link', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .linkedin a' ).attr( "href", to );
        } );
    } );

    // Header: Google Link
    wp.customize( 'theme_google_link', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .gplus a' ).attr( "href", to );
        } );
    } );

    // Header: Instagram Link
    wp.customize( 'theme_instagram_link', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .instagram a' ).attr( "href", to );
        } );
    } );

    // Header: YouTube Link
    wp.customize( 'theme_youtube_link', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .youtube a' ).attr( "href", to );
        } );
    } );

    // Header: Skype Link
    wp.customize( 'theme_skype_username', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .skype a' ).attr( "href", "skype:" + to + "?add" );
        } );
    } );

    // Header: Pinterest Link
    wp.customize( 'theme_pinterest_link', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .pinterest a' ).attr( "href", to );
        } );
    } );

    // Header: RSS Link
    wp.customize( 'theme_rss_link', function( value ) {
        value.bind( function( to ) {
            $( '.social_networks .rss a' ).attr( "href", to );
        } );
    } );

    // SFOI Overlay Color
    wp.customize( 'inspiry_SFOI_overlay_color', function( value ) {
        value.bind( function( to ) {
            $( '.SFOI .SFOI__overlay' ).css( 'background-color', to );
        } );
    } );

    // SFOI Title Color
    wp.customize( 'inspiry_SFOI_title_color', function( value ) {
        value.bind( function( to ) {
            $( '.SFOI__content h2.SFOI__title' ).css( 'color', to );
        } );
    } );

    // SFOI Description Color
    wp.customize( 'inspiry_SFOI_description_color', function( value ) {
        value.bind( function( to ) {
            $( '.SFOI__content p.SFOI__description' ).css( 'color', to );
        } );
    } );

    // SFOI Top Margin
    wp.customize( 'inspiry_SFOI_top_margin', function( value ) {
        value.bind( function( to ) {
            $( '.SFOI div.SFOI__content' ).css({ "margin-top" : to });
        } );
    } );

    // Featured Section Text Color
    wp.customize( 'inspiry_features_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.home-features-section .headings h2, .home-features-section .headings p, .home-features-section .features-wrapper .features-single .feature-content h4, .home-features-section .features-wrapper .features-single .feature-content p' ).css( 'color', to );
        } );
    } );

    // Featured Section Background Color
    wp.customize( 'inspiry_features_background_color', function( value ) {
        value.bind( function( to ) {
            $( '.home-features-section .home-features-bg' ).css( 'background-color', to );
        } );
    } );

    // Featured Section Title
    wp.customize( 'inspiry_features_section_title', function( value ) {
        value.bind( function( to ) {
            if ( $( '.home-features-section .headings h2' ).length ) {
                $( '.home-features-section .headings h2' ).text( to );
            } else {
                $( '<h2>' + to + '</h2>' ).prependTo( '.home-features-section .headings' );
            }
        } );
    } );

    // Featured Section Description
    wp.customize( 'inspiry_features_section_desc', function( value ) {
        value.bind( function( to ) {
            if ( $( '#features-desc' ).length ) {
                $( '#features-desc' ).text( to );
            } else {
                $( '<p id="features-desc">' + to + '</p>' ).appendTo( '.home-features-section .headings' );
            }
        } );
    } );

    // Keyword Search Placeholder
    wp.customize( 'inspiry_keyword_placeholder_text', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar #keyword-txt' ).attr( "placeholder", to );
        } );
    } );

    // Property ID Search Placeholder
    wp.customize( 'inspiry_property_id_placeholder_text', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar #property-id-txt' ).attr( "placeholder", to );
        } );
    } );

    // Keyword Label
    wp.customize( 'inspiry_keyword_label', function( value ) {
        value.bind( function( to ) {
            $( '.option-bar label[for="keyword-txt"]' ).text( to );
        } );
    } );

    // Property ID Label
    wp.customize( 'inspiry_property_id_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="property-id-txt"]' ).text( to );
        } );
    } );

    // Property Status Label
    wp.customize( 'inspiry_property_status_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="select-status"]' ).text( to );
        } );
    } );

    // Property Type Label
    wp.customize( 'inspiry_property_type_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="select-property-type"]' ).text( to );
        } );
    } );

    // Agent Label
    wp.customize( 'inspiry_property_agent_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="select-agent"]' ).text( to );
        } );
    } );

    // Search Button Text
    wp.customize( 'inspiry_search_button_text', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar input.real-btn' ).attr( "value", to );
        } );
    } );

    // Location 1 Label
    wp.customize( 'theme_location_title_1', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="location"]' ).text( to );
        } );
    } );

    // Location 2 Label
    wp.customize( 'theme_location_title_2', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="child-location"]' ).text( to );
        } );
    } );

    // Location 3 Label
    wp.customize( 'theme_location_title_3', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="grandchild-location"]' ).text( to );
        } );
    } );

    // Location 4 Label
    wp.customize( 'theme_location_title_4', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="great-grandchild-location"]' ).text( to );
        } );
    } );

    // Beds Label
    wp.customize( 'inspiry_min_beds_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="select-bedrooms"]' ).text( to );
        } );
    } );

    // Baths Label
    wp.customize( 'inspiry_min_baths_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="select-bathrooms"]' ).text( to );
        } );
    } );

    // Garages Label
    wp.customize( 'inspiry_min_garages_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="select-garages"]' ).text( to );
        } );
    } );

    // Minimum Price Label
    wp.customize( 'inspiry_min_price_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="select-min-price"]' ).text( to );
        } );
    } );

    // Maximum Price Label
    wp.customize( 'inspiry_max_price_label', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="select-max-price"]' ).text( to );
        } );
    } );

    // Minimum Area Search Placeholder
    wp.customize( 'inspiry_min_area_placeholder_text', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar #min-area' ).attr( "placeholder", to );
        } );
    } );

    // Maximum Area Search Placeholder
    wp.customize( 'inspiry_max_area_placeholder_text', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar #max-area' ).attr( "placeholder", to );
        } );
    } );

    // Area Unit Placeholder
    wp.customize( 'theme_area_unit', function( value ) {
        value.bind( function( to ) {
            $( '.advance-search .option-bar label[for="min-area"] span, .advance-search .option-bar label[for="max-area"] span' ).text( "(" + to + ")" );
        } );
    } );

    // Footer Partners Text
    wp.customize( 'theme_partners_title', function( value ) {
        value.bind( function( to ) {
            $( '.brands-carousel h3 span' ).text( to );
        } );
    } );

    // Property Additional Details
    wp.customize( 'theme_additional_details_title', function( value ) {
        value.bind( function( to ) {
            $( '.property-item h4.additional-title' ).text( to );
        } );
    } );

    // Property Features
    wp.customize( 'theme_property_features_title', function( value ) {
        value.bind( function( to ) {
            $( '.property-item .features h4.title' ).text( to );
        } );
    } );

    // Property Child Properties
    wp.customize( 'theme_child_properties_title', function( value ) {
        value.bind( function( to ) {
            $( '#overview .child-properties h3' ).text( to );
        } );
    } );

} )( jQuery );
