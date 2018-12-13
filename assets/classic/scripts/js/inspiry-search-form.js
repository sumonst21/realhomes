/**
 * JavaScript Related to Search Form
 */
(function($){
    "use strict";

    /**
     * Script for Property search form's location select boxes
     */
    if ( typeof locationData !== "undefined" ) {

        // All locations
        var allLocations        = locationData.all_locations;

        // Number of total locations in all locations array
        var locationsCount      = allLocations.length;

        // Select boxes names that can be used as ids
        var selectIds           = locationData.select_names;

        // number of select boxes to manage
        var selectCount         = parseInt( locationData.select_count );

        // parameters related to location boxes
        var locationsInParams   = locationData.locations_in_params;

        // "Any" text as it could be translated
        var any_text            = locationData.any_text;

        // "any" value
        var any_value           = locationData.any_value;


        /**
         * Add child of given term id in target select box
         * @param parentID      parent term id
         * @param targetSelect  target select box
         * @param prefix        prefix to add before child name
         * @param all_child     add all child or only first level child
         * @returns {Array}     return array of child locations
         */
        var addChildLocations = function( parentID, targetSelect, prefix, all_child ) {
            var childLocations = [];
            var childLocationsCounter = 0;

            // add "any" option to empty select
            if( targetSelect.has('option').length == 0 ){
                targetSelect.append( '<option value="' + any_value + '" selected="selected">'+ any_text +'</option>' );
                targetSelect.val( any_value ).trigger( "change" );
            }

            for( var i=0; i < locationsCount; i++ ) {
                var currentLocation = allLocations[i];
                if( parseInt( currentLocation['parent'] ) == parentID ) {
                    targetSelect.append( '<option value="' + currentLocation['slug'] + '">' + prefix + currentLocation['name'] + '</option>' );
                    childLocations[childLocationsCounter] = currentLocation;
                    childLocationsCounter++;
                    if( all_child ) {
                        var currentLocationID = parseInt( currentLocation['term_id'] );
                        addChildLocations ( currentLocationID, targetSelect, prefix + '- ', all_child );
                    }
                }
            }
            return childLocations;
        };


        /**
         * Get term id related to target location
         * @param selectedLocation  target location
         * @returns {number}    term id
         */
        var getRelatedTermID = function ( selectedLocation ){
            var termID = 0;
            var currentLocation;
            // loop through all locations and match selected slug with each one to find the related term id which will be used as parent id later on
            for( var i=0; i < locationsCount; i++ ){
                currentLocation = allLocations[i];
                if( currentLocation['slug'] == selectedLocation ) {
                    termID = parseInt( currentLocation['term_id'] );
                    break;
                }
            }
            return termID;
        };

        /**
         * Does the following things to a target select box.
         * 1. Make it empty.
         * 2. Add an option with "any" as value and "Any" as it's title/text
         * @param targetSelect
         */
        var resetSelect = function ( targetSelect ){
            targetSelect.empty();
            targetSelect.append( '<option value="' + any_value + '" selected="selected">' + any_text + '</option>' );
            targetSelect.val( any_value ).trigger( "change" );
        };


        /**
         * Disable a select box and next select boxes if exists
         * @param targetSelect
         */
        var disableSelect = function ( targetSelect ) {

            resetSelect( targetSelect );
            targetSelect.closest('.option-bar').addClass('disabled');
            if ( targetSelect.is(':enabled') ) {
                targetSelect.prop("disabled", true);
            }

            var targetSelectID = targetSelect.attr('id');                    // target select box id
            var targetSelectIndex = selectIds.indexOf(targetSelectID);      // target select box index
            var nextSelectBoxesCount = selectCount - ( targetSelectIndex + 1 );

            // disable next select boxes
            if( nextSelectBoxesCount > 0 ) {
                for ( var i = targetSelectIndex + 1; i < selectCount; i++ ) {
                    var tempSelect = $( '#' + selectIds[i] );
                    resetSelect( tempSelect );
                    tempSelect.closest('.option-bar').addClass('disabled');
                    if ( tempSelect.is(':enabled') ) {
                        tempSelect.prop("disabled", true);
                    }
                }
            }
        };


        /**
         * Enable a select box
         * @param targetSelect
         */
        var enableSelect = function ( targetSelect ) {
            if ( targetSelect.is(':disabled') ) {
                targetSelect.prop( 'disabled', false );
            }
            var optionWrapper = targetSelect.closest('.option-bar');
            if( optionWrapper.hasClass('disabled') ){
                optionWrapper.removeClass('disabled');
            }
        };


        /**
         * Update next select box based on change in parent select box
         * @param event
         */
        var updateChildSelect = function ( event ) {

            var selectedLocation = $(this).val();                                               // get selected slug
            var currentSelectIndex = selectIds.indexOf( $(this).attr('id') );                   // current select box index

            /* in case of "any" selection */
            if ( selectedLocation == any_value && currentSelectIndex > -1 && currentSelectIndex < ( selectCount - 1 ) ) {  // no need to run this on last select box

                for( var s = currentSelectIndex; s < ( selectCount - 1 ); s++ ) {

                    var childSelectIsLast = ( selectCount == ( s + 2 ) );
                    var childSelect = $( '#'+selectIds[ s + 1 ] );
                    childSelect.empty();                                                   // make it empty

                    /* loop through select options to find and add child locations into next select */
                    var anyChildLocations = [];
                    $( '#' + selectIds[s] + ' > option').each( function() {
                        var currentOptionVal = this.value;
                        if ( currentOptionVal != any_value ) {
                            var relatedTermID = getRelatedTermID( currentOptionVal );
                            if ( relatedTermID > 0 ){
                                var tempLocations = addChildLocations ( relatedTermID, childSelect, '', childSelectIsLast );
                                if ( tempLocations.length > 0 ){
                                    anyChildLocations = $.merge( anyChildLocations, tempLocations );
                                }
                            }
                        }
                    });

                    /* enable next select if options are added otherwise disable it */
                    if( anyChildLocations.length > 0 ) {
                        enableSelect( childSelect );                                    // enable child select box
                        if( !childSelectIsLast ){
                            childSelect.change( updateChildSelect );
                        }
                    } else {
                        disableSelect( childSelect );
                        break;
                    }

                }

                /* in case of valid location selection */
            } else {
                var parentID = getRelatedTermID( selectedLocation );                        // get related term id that will be used as parent id below
                if( parentID > 0 ) {                                                        // We can only do something if term id is valid
                    var childLocations = [];
                    for( var n = currentSelectIndex + 1; n < selectCount; n++ ) {
                        var childSelect = $( '#'+selectIds[ n ] );                          // selector for next( child locations ) select box
                        var childSelectIsLast = ( selectCount == ( n + 1 ) );
                        childSelect.empty();                                           // make it empty

                        if( childLocations.length == 0 ){    // 1st iteration
                            childLocations = addChildLocations( parentID, childSelect, '', childSelectIsLast );    // add all children
                        } else if( childLocations.length > 0 ) {  // 2nd and later iterations
                            var currentLocations = [];
                            for( var i = 0; i < childLocations.length; i++ ) {
                                var tempLocations = addChildLocations ( parseInt( childLocations[i]['term_id']), childSelect, '', childSelectIsLast );
                                if( tempLocations.length > 0 ) {
                                    currentLocations = $.merge( currentLocations, tempLocations );
                                }
                            }
                            childLocations = currentLocations;
                        }

                        if( childLocations.length > 0 ) {
                            enableSelect( childSelect );                                    // enable child select box
                            if( !childSelectIsLast ){
                                childSelect.change( updateChildSelect );
                            }
                        } else {
                            disableSelect( childSelect );
                            break;
                        }
                    }
                }
            }

        };


        /**
         * Mark the current value in query params as selected
         * @param targetSelect
         */
        var selectRightOption = function ( targetSelect  ) {
            if( Object.keys(locationsInParams).length > 0 ){
                var selectName = targetSelect.attr('name');
                if ( typeof locationsInParams[ selectName ] != 'undefined' ) {
                    targetSelect.find( 'option[value="'+ locationsInParams[ selectName ] +'"]' ).prop('selected', true);
                }
            }
        }


        /**
         * Initialize location boxes in search form
         */
        var initLocations = function () {

            var parentLocations = [];
            for( var s=0; s < selectCount; s++ ){

                var currentSelect = $( '#'+selectIds[s] );
                var currentIsLast = ( selectCount == (s + 1) );

                // 1st iteration
                if( s == 0 ) {
                    parentLocations = addChildLocations ( 0, currentSelect, '', currentIsLast );

                    // later iterations
                } else {
                    if( parentLocations.length > 0 ) {
                        var currentLocations = [];
                        var previousSelect = $( '#'+selectIds[s-1] );

                        // loop through all if value is "any"
                        if ( previousSelect.val() == any_value ) {
                            for (var i = 0; i < parentLocations.length; i++) {
                                var tempLocations = addChildLocations(parseInt(parentLocations[i]['term_id']), currentSelect, '', currentIsLast );
                                if (tempLocations.length > 0) {
                                    currentLocations = $.merge(currentLocations, tempLocations);
                                }
                            }

                            // else display only children of current value
                        } else {
                            var parentID = getRelatedTermID( previousSelect.val() );
                            if( parentID > 0 ) {
                                currentLocations = addChildLocations( parentID, currentSelect, '', currentIsLast );
                            }
                        }
                        previousSelect.change( updateChildSelect );
                        parentLocations = currentLocations;
                    }
                }

                // based on what happens above
                if ( parentLocations.length == 0 ) {
                    disableSelect( currentSelect );
                    break;
                } else {
                    selectRightOption( currentSelect );
                }

            }
        }

        /* Runs on Load */
        initLocations();

    }



    /**
     * Change Min and Max Price fields based on selected status for rent
     */
    if ( typeof localizedSearchParams.rent_slug !== "undefined" ) {

        var property_status_changed = function( new_status ){
            var price_for_others = $('.advance-search-form .price-for-others');
            var price_for_rent = $('.advance-search-form .price-for-rent');
            if( price_for_others.length > 0 && price_for_rent.length > 0){
                if( new_status == localizedSearchParams.rent_slug ){
                    price_for_others.addClass('hide-fields').find('select').prop('disabled', true);
                    price_for_rent.removeClass('hide-fields').find('select').prop('disabled', false);
                }else{
                    price_for_rent.addClass('hide-fields').find('select').prop('disabled', true);
                    price_for_others.removeClass('hide-fields').find('select').prop('disabled', false);
                }
            }
        }
        $('.advance-search-form #select-status').change(function(e){
            var selected_status = $(this).val();
            property_status_changed(selected_status);
        });

        /* On page load ( as on search page ) */
        var selected_status = $('.advance-search-form #select-status').val();
        if( selected_status == localizedSearchParams.rent_slug ){
            property_status_changed(selected_status);
        }
    }


    /**
     * Max and Min Price
     * Shows red outline if min price is bigger than max price
     */

    /* for normal prices */
    $('#select-min-price,#select-max-price').change(function(obj, e){
        var min_text_val = $('#select-min-price').val();
        var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

        var max_text_val = $('#select-max-price').val();
        var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

        if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
            $('#select-min-price,#select-max-price').siblings('.select2-container').css('outline','1px solid red');
        }else{
            $('#select-min-price,#select-max-price').siblings('.select2-container').css('outline','none');
        }
    });

    /* for rent prices */
    $('#select-min-price-for-rent, #select-max-price-for-rent').change(function(obj, e){
        var min_text_val = $('#select-min-price-for-rent').val();
        var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

        var max_text_val = $('#select-max-price-for-rent').val();
        var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

        if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
            $('#select-min-price-for-rent, #select-max-price-for-rent').siblings('.select2-container').css('outline','1px solid red');
        }else{
            $('#select-min-price-for-rent, #select-max-price-for-rent').siblings('.select2-container').css('outline','none');
        }
    });


    /**
     * Max and Min Area
     * To show red outline if min is bigger than max
     */
    $('#min-area,#max-area').change(function(obj, e){
        var min_text_val = $('#min-area').val();
        var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

        var max_text_val = $('#max-area').val();
        var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

        if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
            $('#min-area,#max-area').css('outline','1px solid red');
        }else{
            $('#min-area,#max-area').css('outline','none');
        }
    });


    /**
     * Disable empty values on submission to reduce query string size
     */
    $('.advance-search-form').submit(function(event){
        var searchFormElements = $(this).find(':input');
        $.each( searchFormElements, function( index, element ){
            if ( element.value == '' || element.value == 'any' ) {
                if ( ! element.disabled ) {
                 element.disabled = true;
                }
            }
        });
    });

    /**
     * Add to compare -- Search Page
     */
    var removeBorder = function() {
        var screenWidth         = $( window ).width();
        var isRtl               = $( 'body' ).hasClass( 'rtl' );
        
        if ( ( 979 < screenWidth && 1200 > screenWidth ) || ( 767 >= screenWidth && 500 <= screenWidth )  ) {
            if ( ! isRtl ) {
                var addToCompareSpan    = $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).length;
                if ( addToCompareSpan ) {
                    $( '.page-template-template-search .property-item .compare-meta span' ).css({
                        'border'    : 'none'
                    });

                    $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).css({
                        'margin-right'  : '-20px',
                        'border-left'   : 'none'
                    });
                }
            } else {
                var addToCompareSpan    = $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).length;
                if ( addToCompareSpan ) {
                    $( '.page-template-template-search .property-item .compare-meta span' ).css({
                        'border-left'    : 'none'
                    });

                    $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).css({
                        'margin-left'   : '-20px',
                        'border-right'  : 'none',
                        'float'         : 'left'
                    });
                }
            }
        } else if ( 500 <= screenWidth ) {
            if ( ! isRtl ) {
                var addToCompareSpan    = $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).length;
                if ( addToCompareSpan ) {
                    $( '.page-template-template-search .property-item .compare-meta span:nth-last-child(2)' ).css({
                        'border'    : 'none'
                    });

                    $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).css({
                        'margin-right'  : '-20px',
                        'border-left'   : '1px solid #dedede'
                    });
                }
            } else {
                var addToCompareSpan    = $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).length;
                if ( addToCompareSpan ) {
                    $( '.page-template-template-search .property-item .compare-meta span:nth-last-child(2)' ).css({
                        'border'    : 'none'
                    });

                    $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).css({
                        'margin-left'   : '-20px',
                        'border-right'  : '1px solid #dedede',
                        'float'         : 'left'
                    });
                }
            }
        } else {
            if ( ! isRtl ) {
                var addToCompareSpan    = $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).length;
                if ( addToCompareSpan ) {
                    $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).css({
                        'margin-right'  : '0',
                        'border-left'   : 'none'
                    });
                }
            } else {
                var addToCompareSpan    = $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).length;
                if ( addToCompareSpan ) {
                    $( '.page-template-template-search .property-item .compare-meta span.add-to-compare-span' ).css({
                        'margin-right'  : '0',
                        'border-left'   : 'none',
                        'float'         : 'right'
                    });
                }
            }
        }
    }
    removeBorder();
    // Execute again on resize.
    $( window ).resize( function() {
        removeBorder();
    } );


})(jQuery);