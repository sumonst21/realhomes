(function ($) {
    "use strict";

    $(document).ready(function () {

        var $window = $(window),
            $body = $('body'),
            isRtl = $body.hasClass('rtl');

        /*-----------------------------------------------------------------------------------*/
        /* For RTL Languages
         /*-----------------------------------------------------------------------------------*/
        if ($('body').hasClass('rtl')) {
            $('.contact-number .fa-phone,' +
                '.more-details .fa-caret-right').addClass('fa-flip-horizontal');
        }

        /*-----------------------------------------------------------------------------------*/
        /* Cross Browser
         /*-----------------------------------------------------------------------------------*/
        $('.property-item .features span:last-child').css('border', 'none');
        $('.dsidx-prop-title').css('margin', '0 0 15px 0');
        $('.dsidx-prop-summary a img').css('border', 'none');


        /*-----------------------------------------------------------------------------------*/
        /* Main Menu Dropdown Control
         /*-----------------------------------------------------------------------------------*/
        $('ul.rh_menu__main_menu li').hover(function () {
            $(this).children('ul').stop(true, true).slideDown(200);
        }, function () {
            $(this).children('ul').stop(true, true).delay(50).slideUp(750);
        });

        // Responsive Menu.
        $('.rh_menu__hamburger').click(function () {
            $('ul.rh_menu__responsive').slideToggle();
        });

        var sub_menu_parent = $('.rh_menu__responsive ul.sub-menu').parent();
        sub_menu_parent.prepend('<i class="fa fa-caret-down rh_menu__indicator"></i>');

        // Second Level
        $('ul.rh_menu__responsive > li .rh_menu__indicator').click(function (e) {
            e.preventDefault();
            $(this).parent().children('ul.sub-menu').slideToggle();
            $(this).toggleClass('rh_menu__indicator_up');
        });

        /*-----------------------------------------------------------------------------------*/
        /*	Autofocus user login
        /*-----------------------------------------------------------------------------------*/

        //$(function(){

           $('.user-nav .last').on('click',function(){
               setTimeout(function(){
               if($('#username').hasClass('focus-class')){
                   $('.focus-class').focus();

               }
               },500);
           }) ;

        //});

        /*-----------------------------------------------------------------------------------*/
        /*	Hamburger
         /*-----------------------------------------------------------------------------------*/
        /**
         * forEach implementation for Objects/NodeLists/Arrays, automatic type loops and context options
         *
         * @private
         * @author Todd Motto
         * @link https://github.com/toddmotto/foreach
         * @param {Array|Object|NodeList} collection - Collection of items to iterate, could be an Array, Object or NodeList
         * @callback requestCallback      callback   - Callback function for each iteration.
         * @param {Array|Object|NodeList} scope=null - Object/NodeList/Array that forEach is iterating over, to use as the this value when executing callback.
         * @returns {}
         */
        var forEach = function (t, o, r) {
            if ("[object Object]" === Object.prototype.toString.call(t))for (var c in t)Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t); else for (var e = 0, l = t.length; l > e; e++)o.call(r, t[e], e, t)
        };

        var hamburgers = document.querySelectorAll(".hamburger");
        if (hamburgers.length > 0) {
            forEach(hamburgers, function (hamburger) {
                hamburger.addEventListener("click", function () {
                    this.classList.toggle("is-active");
                }, false);
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /*	Flex Slider
         /*-----------------------------------------------------------------------------------*/
        if (jQuery().flexslider) {
            // Flex Slider for Homepage
            $('#home-flexslider .flexslider').flexslider({
                animation: "fade",
                slideshowSpeed: 7000,
                animationSpeed: 1500,
                directionNav: true,
                controlNav: false,
                keyboardNav: true,
                start: function (slider) {
                    slider.removeClass('loading');
                }
            });

            // Flex Slider for Featured Properties - Homepage
            var featured_properties = $('#rh_featured_properties .rh_featured_properties__slider').flexslider({
                animation: "slide",
                slideshowSpeed: 5000,
                animationSpeed: 1000,
                directionNav: false,
                slideshow: false,
                // pauseOnHover: true,
                controlNav: true,
                keyboardNav: true,
                prevText: "",
                nextText: "",
                start: function (slider) {
                    slider.removeClass('loading');
                }
            });

            // Remove Flex Slider Navigation for Smaller Screens Like IPhone Portrait
            $('.slider-wrapper , .listing-slider').hover(function () {
                var mobile = $('body').hasClass('probably-mobile');
                if (!mobile) {
                    $('.flex-direction-nav').stop(true, true).fadeIn('slow');
                }
            }, function () {
                $('.flex-direction-nav').stop(true, true).fadeOut('slow');
            });

            // Flex Slider for Detail Page
            $('#property-detail-flexslider .flexslider').flexslider({
                animation: "slide",
                directionNav: true,
                controlNav: "thumbnails",
                start: function (slider) {
                    slider.resize();
                }
            });

            // Flex Slider Gallery Post
            $('.listing-slider').flexslider({
                animation: "slide"
            });

            /* Property detail page slider variation two */
            $('#property-carousel-two').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 113,
                itemMargin: 10,
                // move: 1,
                asNavFor: '#property-slider-two'
            });
            $('#property-slider-two').flexslider({
                animation: "slide",
                directionNav: true,
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#property-carousel-two",
                start: function (slider) {
                    slider.removeClass('loading');
                }
            });

        }


        /*-----------------------------------------------------------------------------------*/
        /*	jCarousel
         /*-----------------------------------------------------------------------------------*/
        if (jQuery().jcarousel) {
            // Jcarousel for Detail Page
            jQuery('#property-detail-flexslider .flex-control-nav').jcarousel({
                vertical: true,
                scroll: 1
            });

            // Jcarousel for partners
            jQuery('.brands-carousel .brands-carousel-list ').jcarousel({
                scroll: 1
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /*	Carousel - Elastislide
         /*-----------------------------------------------------------------------------------*/
        var param = {
            speed: 500,
            imageW: 245,
            minItems: 1,
            margin: 30,
            onClick: function ($object) {
                window.location = $object.find('a').first().attr('href');
                return true;
            }
        };

        function cstatus(a, b, c) {
            var temp = a.children("li");
            temp.last().attr('style', 'margin-right: 0px !important');
            if (temp.length > c) {
                b.elastislide(param);
            }
        };

        if (jQuery().elastislide) {
            var fp = $('.featured-properties-carousel .es-carousel-wrapper ul'),
                fpCarousel = $('.featured-properties-carousel .carousel');
            cstatus(fp, fpCarousel, 4);
        }


        /*-------------------------------------------------------*/
        /*	 Focus and Blur events with input elements
         /* -----------------------------------------------------*/
        var addFocusAndBlur = function ($input, $val) {
            $input.focus(function () {
                if ($(this).value == $val) {
                    $(this).value = '';
                }
            });

            $input.blur(function () {
                if ($(this).value == '') {
                    $(this).value = $val;
                }
            });
        };

        // Attach the events
        addFocusAndBlur(jQuery('#principal'), 'Principal');
        addFocusAndBlur(jQuery('#interest'), 'Interest');
        addFocusAndBlur(jQuery('#payment'), 'Payment');
        addFocusAndBlur(jQuery('#texes'), 'Texes');
        addFocusAndBlur(jQuery('#insurance'), 'Insurance');
        addFocusAndBlur(jQuery('#pmi'), 'PMI');
        addFocusAndBlur(jQuery('#extra'), 'Extra');


        /*-----------------------------------------------------------------------------------*/
        /*	Apply Bootstrap Classes on Comment Form Fields to Make it Responsive
         /*-----------------------------------------------------------------------------------*/
        $('#respond #submit, #dsidx-contact-form-submit').addClass('real-btn');
        $('.lidd_mc_form input[type=submit]').addClass('real-btn');
        $('.pages-nav > a').addClass('real-btn');
        $('.dsidx-search-button .submit').addClass('real-btn');
        $('.wpcf7-submit').addClass('real-btn');

        /*----------------------------------------------------------------------------------*/
        /* Contact Form AJAX validation and submission
         /* Validation Plugin : http://bassistance.de/jquery-plugins/jquery-plugin-validation/
         /* Form Ajax Plugin : http://www.malsup.com/jquery/form/
         /*---------------------------------------------------------------------------------- */
        if (jQuery().validate && jQuery().ajaxSubmit) {

            var submitButton = $('#submit-button'),
                ajaxLoader = $('#ajax-loader'),
                messageContainer = $('#message-container'),
                errorContainer = $("#error-container");

            var formOptions = {
                beforeSubmit: function () {
                    submitButton.attr('disabled', 'disabled');
                    ajaxLoader.fadeIn('fast');
                    messageContainer.fadeOut('fast');
                    errorContainer.fadeOut('fast');
                },
                success: function (ajax_response, statusText, xhr, $form) {
                    var response = $.parseJSON(ajax_response);
                    ajaxLoader.fadeOut('fast');
                    submitButton.removeAttr('disabled');
                    if (response.success) {
                        $form.resetForm();
                        messageContainer.html(response.message).fadeIn('fast');

                        // call reset function if it exists
                        if (typeof inspiryResetReCAPTCHA == 'function') {
                            inspiryResetReCAPTCHA();
                        }

                    } else {
                        errorContainer.html(response.message).fadeIn('fast');
                    }
                }
            };

            // Contact page form
            $('#contact-form .contact-form').validate({
                errorLabelContainer: errorContainer,
                submitHandler: function (form) {
                    $(form).ajaxSubmit(formOptions);
                }
            });

            // Agent single page form
            $('#agent-single-form').validate({
                errorLabelContainer: errorContainer,
                submitHandler: function (form) {
                    $(form).ajaxSubmit(formOptions);
                }
            });

        }


        /*-----------------------------------------------------------------------------------*/
        /* Swipe Box Lightbox
         /*-----------------------------------------------------------------------------------*/
        if (jQuery().swipebox) {
            $('.clone .swipebox').removeClass('swipebox');
            $(".swipebox").swipebox();
        }


        /*-----------------------------------------------------------------------------------*/
        /* Pretty Photo Lightbox
         /*-----------------------------------------------------------------------------------*/
        if (typeof customData !== "undefined" && jQuery().prettyPhoto) {
            $(".pretty-photo").prettyPhoto({
                allow_resize: true,
                default_width: customData.video_width,
                default_height: customData.video_height,
                animation_speed: 'normal',
                deeplinking: false,
                social_tools: false,
                theme: 'default',
                show_title: false,
                iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no" allowfullscreen="true"></iframe>'
            });

            $('a[data-rel]').each(function () {
                $(this).attr('rel', $(this).data('rel'));
            });

            $("a[rel^='prettyPhoto']").prettyPhoto({
                overlay_gallery: false, social_tools: false, theme: 'dark_square', show_title: false
            });
        }


        /*-------------------------------------------------------*/
        /*	Isotope
         /*------------------------------------------------------*/
        $(window).load(function () {
            if (jQuery().isotope) {
                $(function () {

                    var container = $('.isotope'),
                        filterLinks = $('#filter-by a');

                    /* to fix floating bugs due to variation in height */
                    setTimeout(function () {
                        container.isotope({
                            filter: "*",
                            layoutMode: 'fitRows',
                            itemSelector: '.isotope-item',
                            animationEngine: 'best-available'
                        });
                    }, 1000);

                    filterLinks.click(function (e) {
                        var selector = $(this).attr('data-filter');
                        container.isotope({filter: '.' + selector});
                        filterLinks.removeClass('active');
                        $('#filter-by li').removeClass('current-cat');
                        $(this).addClass('active');
                        e.preventDefault();
                    });

                });
            }
        });


        /* ---------------------------------------------------- */
        /*	Gallery Hover Effect
         /* ---------------------------------------------------- */
        $(function () {
            $('.gallery-item figure').hover(function () {
                    var $currentFigure = $(this);
                    var $mediaContainer = $currentFigure.find('.media_container');
                    var $media = $mediaContainer.find('a');
                    var $margin = -( $media.first().height() / 2 );
                    $media.css('margin-top', $margin);
                    var linkWidth = $media.first().width();
                    var targetPosition = ( $mediaContainer.width() / 2 ) - ( linkWidth + 2 );
                    $mediaContainer.stop().fadeIn(300);
                    $mediaContainer.find('a.link').stop().animate({'right': targetPosition}, 300);
                    $mediaContainer.find('a.zoom').stop().animate({'left': targetPosition}, 300);
                },
                function () {
                    var $currentFigure = $(this);
                    var $mediaContainer = $currentFigure.find('.media_container');
                    $mediaContainer.stop().fadeOut(300);
                    $mediaContainer.find('a.link').stop().animate({'right': '0'}, 300);
                    $mediaContainer.find('a.zoom').stop().animate({'left': '0'}, 300);
                }
            );
        });


        /* ---------------------------------------------------- */
        /*  Sizing Header Outer Strip
         /* ---------------------------------------------------- */
        function outer_strip() {
            var $item = $('.outer-strip'),
                $c_width = $('.header-wrapper .container').width(),
                $w_width = $(window).width(),
                $i_width = ($w_width - $c_width) / 2;

            if ($('body').hasClass('rtl')) {
                $item.css({
                    left: -$i_width,
                    width: $i_width
                });
            } else {
                $item.css({
                    right: -$i_width,
                    width: $i_width
                });
            }
        }

        outer_strip();
        $(window).resize(function () {
            outer_strip();
        });


        /* ---------------------------------------------------- */
        /*	Notification Hide Function
         /* ---------------------------------------------------- */
        $(".icon-remove").click(function () {
            $(this).parent().fadeOut(300);
        });


        /*-----------------------------------------------------------------------------------*/
        /*	Image Hover Effect
         /*-----------------------------------------------------------------------------------*/
        if (jQuery().transition) {
            $('.zoom_img_box img').hover(function () {
                $(this).stop(true, true).transition({
                    scale: 1.1
                }, 300);
            }, function () {
                $(this).stop(true, true).transition({
                    scale: 1
                }, 150);
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /*	Grid and Listing Toggle View
         /*-----------------------------------------------------------------------------------*/
        if ($('.listing-grid-layout').hasClass('property-toggle')) {
            $('.listing-layout  .property-item-grid').hide();
            $('a.grid').on('click', function () {
                $('.listing-layout').addClass('property-grid');
                $('.property-item-grid').show();
                $('.property-item-list').hide();
                $('a.grid').addClass('active');
                $('a.list').removeClass('active');
            });
            $('a.list').on('click', function () {
                $('.listing-layout').removeClass('property-grid');
                $('.property-item-grid').hide();
                $('.property-item-list').show();
                $('a.grid').removeClass('active');
                $('a.list').addClass('active');
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /* Calendar Widget Border Fix
         /*-----------------------------------------------------------------------------------*/
        var $calendar = $('.sidebar .widget #wp-calendar');
        if ($calendar.length > 0) {
            $calendar.each(function () {
                $(this).closest('.widget').css('border', 'none').css('background', 'transparent');
            });
        }

        var $single_listing = $('.sidebar .widget .dsidx-widget-single-listing');
        if ($single_listing.length > 0) {
            $single_listing.each(function () {
                $(this).closest('.widget').css('border', 'none').css('background', 'transparent');
            });
        }

        /*-----------------------------------------------------------------------------------*/
        /*	Tags Cloud
         /*-----------------------------------------------------------------------------------*/
        $('.tagcloud').addClass('clearfix');
        $('.tagcloud a').removeAttr('style');


        /* dsIDXpress */
        $('#dsidx-top-search #dsidx-search-form table td').removeClass('label');
        $('.dsidx-tag-pre-foreclosure br').replaceWith(' ');


        /*-----------------------------------------------------------------------------------*/
        /* Properties Sorting
         /*-----------------------------------------------------------------------------------*/
        function insertParam(key, value) {
            key = encodeURI(key);
            value = encodeURI(value);

            var kvp = document.location.search.substr(1).split('&');

            var i = kvp.length;
            var x;
            while (i--) {
                x = kvp[i].split('=');

                if (x[0] == key) {
                    x[1] = value;
                    kvp[i] = x.join('=');
                    break;
                }
            }

            if (i < 0) {
                kvp[kvp.length] = [key, value].join('=');
            }

            //this will reload the page, it's likely better to store this until finished
            document.location.search = kvp.join('&');
        }

        $('#sort-properties').on('change', function () {
            var key = 'sortby';
            var value = $(this).val();
            insertParam(key, value);
        });


        /*-----------------------------------------------------------------------------------*/
        /* Add to favorites
         /*-----------------------------------------------------------------------------------*/
        $('a.add-to-favorite').click(function (e) {

            e.preventDefault();
            var favorite_link = $(this);
            var span_favorite = $(this).parent().find('span.favorite-placeholder');
            var favorite_form = $(this).parent().find('.add-to-favorite-form');

            var add_to_fav_opptions = {

                beforeSubmit: function () {

                },  // pre-submit callback
                success: function () {
                    $(favorite_link).addClass('hide');
                    $(span_favorite).delay(200).removeClass('hide');
                }
            };

            favorite_form.ajaxSubmit(add_to_fav_opptions);
        });

        /*-----------------------------------------------------------------------------------*/
        /* Remove from favorites
         /*-----------------------------------------------------------------------------------*/
        $('a.remove-from-favorite').click(function (event) {
            event.preventDefault();
            var $this = $(this);
            var property_item = $this.closest('.property-item');
            var loader = $this.siblings('.loader');
            var ajax_response = property_item.find('.ajax-response');

            $this.hide();
            loader.show();

            var remove_favorite_request = $.ajax({
                url: $this.attr('href'),
                type: "POST",
                data: {
                    property_id: $this.data('property-id'),
                    action: "remove_from_favorites"
                },
                dataType: "json"
            });

            remove_favorite_request.done(function (response) {
                loader.hide();
                if (response.success) {
                    property_item.remove();
                } else {
                    ajax_response.text(response.message);
                }
            });

            remove_favorite_request.fail(function (jqXHR, textStatus) {
                ajax_response.text("Request failed: " + textStatus);
            });
        });

        /*-----------------------------------------------------------------------------------*/
        /* Compare Properties
         /*-----------------------------------------------------------------------------------*/
        var compare_properties_number = $('.compare-properties .compare-carousel > div').length;

        if (compare_properties_number != 0) {
            $('.compare-properties').slideDown(500);
        }

        /*-----------------------------------------------------------------------------------*/
        /* Add to compare
         /*-----------------------------------------------------------------------------------*/
        $(document).on('click', 'a.add-to-compare', function (e) {
            e.preventDefault();

            var slides_number = $('.compare-carousel .compare-carousel-slide').length;
            if (slides_number > 3) {
                var remove_last_check = 1;
                $('.compare-carousel .compare-carousel-slide:nth-child(1) a.compare-remove').trigger("click", [$(this), remove_last_check]);
            } else {
                var plus = $(this).find('i');
                var compare_target = $(this).parents('.add-to-compare-span').find('.compare_target');
                var compare_link = $(this);
                var compare_output = $(this).parents('.add-to-compare-span').find('.compare_output');

                plus.addClass('fa-spin');

                var add_compare_request = $.ajax({
                    url: $(compare_link).attr('href'),
                    type: "POST",
                    data: {
                        property_id: $(compare_link).data('property-id'),
                        action: "inspiry_add_to_compare"
                    },
                    dataType: "json"
                });

                add_compare_request.done(function (response) {
                    plus.removeClass('fa-spin');
                    if (response.success) {
                        $(compare_link).hide(0, function () {
                            $(compare_target).html(response.message);
                            $(compare_output).delay(200).show();
                        });
                        $('.compare-carousel').append(
                            '<div class="compare-carousel-slide"><div class="compare-slide-img"><img src="' + response.img + '"></div><a class="compare-remove" data-property-id="' + response.property_id + '" href="' + response.ajaxURL + '" width="' + response.img_width + '" height="' + response.img_height + '"><i class="fa fa-close"></i></a></div>'
                        );
                        var compare_properties_number = $('.compare-properties .compare-carousel > div').length;
                        if (compare_properties_number == 1) {
                            $('.compare-properties').slideDown();
                        }
                    } else {
                        compare_output.text(response.message);
                    }
                });

                add_compare_request.fail(function (jqXHR, textStatus) {
                    compare_output.text("Request failed: " + textStatus);
                });
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Remove from compare
         /*-----------------------------------------------------------------------------------*/
        $(document).on('click', 'a.compare-remove', function (event, add_compare_target, remove_last) {
            event.preventDefault();
            var current_link = $(this);
            var cross = $(this).find('i');
            var plus = $(add_compare_target).find('i');

            cross.addClass('fa-spin');
            plus.addClass('fa-spin');

            $.when(
                $.ajax({
                    url: current_link.attr('href'),
                    type: "POST",
                    data: {
                        property_id: current_link.data('property-id'),
                        action: "inspiry_remove_from_compare"
                    },
                    dataType: "json"
                })

                    .done(function (response) {
                        cross.removeClass('fa-spin');
                        if (response.success) {
                            current_link.parents('div.compare-carousel-slide').remove();
                            var property_item = $('.add-to-compare-span *[data-property-id="' + response.property_id + '"]').parents('.add-to-compare-span');
                            property_item.find('div.compare_output').hide();
                            $('.add-to-compare-span *[data-property-id="' + response.property_id + '"]').removeClass('hide').delay(200).show();
                            var compare_properties_number = $('.compare-properties .compare-carousel > div').length;
                            if (compare_properties_number == 0) {
                                $('.compare-properties').slideUp();
                            }
                        } else {
                            console.log(response.message);
                        }
                    })

                    .fail(function (jqXHR, textStatus) {
                        compare_output.text("Request failed: " + textStatus);
                    })
            )

                .then(function (response) {
                    if (remove_last) {
                        var compare_target = $(add_compare_target).parents('.add-to-compare-span').find('.compare_target');
                        var compare_link = $(add_compare_target);
                        var compare_output = $(add_compare_target).parents('.add-to-compare-span').find('.compare_output');

                        var add_compare_request = $.ajax({
                            url: $(compare_link).attr('href'),
                            type: "POST",
                            data: {
                                property_id: $(compare_link).data('property-id'),
                                action: "inspiry_add_to_compare"
                            },
                            dataType: "json"
                        });

                        add_compare_request.done(function (response) {
                            plus.removeClass('fa-spin');
                            if (response.success) {
                                $(compare_link).hide(0, function () {
                                    $(compare_target).html(response.message);
                                    $(compare_output).delay(200).show();
                                });
                                $('.compare-carousel').append(
                                    '<div class="compare-carousel-slide"><div class="compare-slide-img"><img src="' + response.img + '"></div><a class="compare-remove" data-property-id="' + response.property_id + '" href="' + response.ajaxURL + '" width="' + response.img_width + '" height="' + response.img_height + '"><i class="fa fa-close"></i></a></div>'
                                );
                            } else {
                                compare_output.text(response.message);
                            }
                        });
                    }
                    ;
                });
        });


        /*-----------------------------------------------------------------------------------*/
        /* Sticky-kit
         /* URL: https://github.com/leafo/sticky-kit
         /*-----------------------------------------------------------------------------------*/
        var makeSticky = function () {
            var screenWidth = $(window).width();
            if (768 <= screenWidth) {
                $('.compare-properties-column .property-thumbnail').stick_in_parent()
                    .on("sticky_kit:stick", function (e) {
                        // console.log("has stuck!", e.target);
                        $('.compare-template .compare-properties-column > p:nth-child(odd)').css({
                            'background': '#eeeeee'
                        });
                        $('.compare-template .compare-properties-column > p:nth-child(even)').css({
                            'background': '#ffffff'
                        });
                        var heightThumbnail = $('.compare-properties-column .property-thumbnail').height();
                        $('.compare-properties-column > div:nth-child(2)').css({
                            'height': heightThumbnail
                        });
                    })
                    .on("sticky_kit:unstick", function (e) {
                        // console.log("has unstuck!", e.target);
                    });
                $('.compare-feature-column .property-thumbnail').stick_in_parent()
                    .on("sticky_kit:stick", function (e) {
                        // console.log("has stuck!", e.target);
                        $('.compare-template .compare-feature-column > p:nth-child(odd)').css({
                            'background': '#eeeeee'
                        });
                        $('.compare-template .compare-feature-column > p:nth-child(even)').css({
                            'background': '#ffffff'
                        });
                        var heightEmptyThumbnail = $('.compare-properties-column .property-thumbnail').height();
                        $('.compare-feature-column > div:nth-child(2)').css({
                            'height': heightEmptyThumbnail
                        });
                    })
                    .on("sticky_kit:unstick", function (e) {
                        // console.log("has unstuck!", e.target);
                    });
            } else {
                $('.compare-properties-column .property-thumbnail').trigger("sticky_kit:detach");
                $('.compare-feature-column .property-thumbnail').trigger("sticky_kit:detach");
            }
        }
        makeSticky();
        // Execute again when browser resizes.
        $(window).resize(function () {
            makeSticky();
        });


        /*-----------------------------------------------------------------------------------*/
        /* Select2
         /* URL: http://select2.github.io/select2/
         /*-----------------------------------------------------------------------------------*/
        if (jQuery().select2) {
            var selectOptions = {
                width: 'off'
            };

            if (isRtl) {
                selectOptions.dir = "rtl";
            }

            $('.search-select').select2(selectOptions);

            // Parent Properties Select box on Submit & Edit Property Pages
            $('#property_parent_id').select2(selectOptions);

            // Property Agents Select box on Submit & Edit Property Pages
            $('#agent-selectbox').select2(selectOptions);

            if ($('#ims-membership-select')) {
                $('#ims-membership-select').select2(selectOptions);
            }

            if ($('.dsidx-resp-search-form')) {
                $('.dsidx-resp-search-form select').select2(selectOptions);

                if ($('.dsidx-sorting-control')) {
                    $('.dsidx-sorting-control select').select2(selectOptions);
                }

                if ($('#dsidx-search-form-main')) {
                    $('#dsidx-search-form-main select').select2(selectOptions);
                }
            }
        }


        /*-----------------------------------------------------------------------------------*/
        /* Optima Express IDX Support
         /*-----------------------------------------------------------------------------------*/
        $(".ihf-grid-result-container .ihf-grid-result-photocount")
            .contents()
            .filter(function () {
                return this.nodeType !== 1;
            })
            .wrap("<span></span>");

        $('.ihf-grid-result-mlsnum-proptype').parent().parent().find('.col-xs-3').hide();
        $('.ihf-grid-result-mlsnum-proptype').parent().parent().find('.col-xs-9').toggleClass('col-xs-12');

        $('#ihf-main-container .ihf-detail-back-to-results a').html('<span class="fa fa-angle-left"></span><span class="rh_back-link"> Back to Results</span>');


        /*-------------------------------------------------------*/
        /*	Advanced Search Button - Search Form Over Image Variation
         /* -----------------------------------------------------*/
        $('.SFOI__advanced-expander').on('click', function (e) {

            var upDownArrow = $(this).find('i');
            var advancedFieldsWrapper = $(this).parent('.SFOI__form-wrapper').find('.SFOI__advanced-fields-wrapper');

            if (upDownArrow.hasClass('fa-angle-down')) {
                advancedFieldsWrapper.slideDown();
                upDownArrow.removeClass('fa-angle-down').addClass('fa-angle-up');
            } else {
                advancedFieldsWrapper.slideUp();
                upDownArrow.removeClass('fa-angle-up').addClass('fa-angle-down');
            }

        });

        /*-------------------------------------------------------*/
        /*	More Options in Search Form
         /* -----------------------------------------------------*/
        $('.more-option-trigger > a').click(function (e) {
            e.preventDefault();
            var triggerIcon = $(this).find('i');
            var moreOptionsWrapper = $('.more-options-wrapper');
            if (triggerIcon.hasClass('fa-plus-square-o')) {
                triggerIcon.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
                moreOptionsWrapper.removeClass('collapsed');
            } else if (triggerIcon.hasClass('fa-minus-square-o')) {
                triggerIcon.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
                moreOptionsWrapper.addClass('collapsed');
            }
        });

        /*-------------------------------------------------------*/
        /*	More Fields in Search Form
         /* -----------------------------------------------------*/
        $('.more-fields-trigger > a').click(function (e) {
            e.preventDefault();
            var triggerIcon = $(this).find('i');
            var triggerSpan = $(this).find('span');
            var moreFieldsWrapper = $('.more-fields-wrapper');
            if (triggerIcon.hasClass('fa-plus-square-o')) {
                triggerIcon.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
                moreFieldsWrapper.removeClass('collapsed');
                triggerSpan.text(localized.less_search_fields);
            } else if (triggerIcon.hasClass('fa-minus-square-o')) {
                triggerIcon.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
                moreFieldsWrapper.addClass('collapsed');
                triggerSpan.text(localized.more_search_fields);
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /*	Scroll to Top
         /*-----------------------------------------------------------------------------------*/
        $(function () {
            var scroll_anchor = $('#scroll-top'),
                post_nav = $('.inspiry-post-nav');
            $(window).scroll(function () {
                if ($(window).width() > 980) {
                    if ($(this).scrollTop() > 250) {
                        scroll_anchor.fadeIn('fast');
                        post_nav.fadeIn('fast');
                        return;
                    }
                }
                scroll_anchor.fadeOut('fast');
                post_nav.fadeOut('fast');
            });

            scroll_anchor.on('click', function (event) {
                event.preventDefault();
                $('html, body').animate({scrollTop: 0}, 'slow');
            });
        });


        /*-----------------------------------------------------------------------------------*/
        /* Home page properties pagination
         /*-----------------------------------------------------------------------------------*/
        var homePropertiesSection = $('#home-properties-section');

        // if homepage
        if (homePropertiesSection.length && homePropertiesSection.hasClass('ajax-pagination')) {


            $(document).on('click', '#home-properties-section-wrapper .pagination > a', function (e) {
                e.preventDefault();
                var homePropertiesContainer = $('#home-properties-section-wrapper', homePropertiesSection);
                var paginationLinks = $('.pagination > a', homePropertiesSection);
                var svgLoader = $('.svg-loader', homePropertiesSection);
                var currentButton = $(this);
                svgLoader.slideDown('fast');
                homePropertiesContainer.fadeTo('slow', 0.5);
                paginationLinks.removeClass('current');
                //  currentButton.addClass('current');
                homePropertiesContainer.load(
                    currentButton.attr('href') + ' ' + '#home-properties-section-inner',
                    function (response, status, xhr) {
                        if (status == 'success') {
                            homePropertiesContainer.fadeTo('slow', 1);
                            svgLoader.slideUp('fast');

                            // $('html, body').animate( { scrollTop: homePropertiesContainer.offset().top - 60 }, 'slow' );
                        } else {
                            homePropertiesContainer.fadeTo('slow', 1);
                            console.log(status + ' ' + xhr.statusText);
                        }
                    }
                );
            });
        }


        /*-----------------------------------------------------------------*/
        /* Sticky Header
         /*-----------------------------------------------------------------*/

        if ($('body').hasClass('sticky-header')) {


            $(window).scroll(function () {

                var $window = $(this);

                if ($window.width() > 979) {    // work only above 600px screen size
                    var body = $('body');
                    var header = $('.header-wrapper');
                    var headerTop = $('#header-top');

                    // get the admin bar height
                    var adminBarHeight = 0;
                    if (body.hasClass('admin-bar')) {
                        adminBarHeight = $('#wpadminbar').outerHeight();
                    }

                    // header header top bar and header height
                    // var headerTopBarHeight = headerTop.outerHeight();
                    var headerHeight = header.outerHeight();

                    if ($window.scrollTop() > 0) {
                        headerTop.css('marginBottom', '5px');
                        header.addClass('stick').css('top', adminBarHeight);
                        body.css('padding-top', headerHeight);
                    } else {
                        headerTop.css('marginBottom', '30px');
                        header.removeClass('stick').css('top', 'auto');
                        body.css('padding-top', 0);
                    }
                }

            });

        }

        /*-----------------------------------------------------------------*/
        /* Property Floor Plans
         /*-----------------------------------------------------------------*/
        $('.floor-plans-accordions .floor-plan:first-child').addClass('current')
            .children('.floor-plan-content').css('display', 'block').end()
            .find('i.fa').removeClass('fa-plus').addClass('fa-minus');

        $('.floor-plan-title').on('click', function () {
            var parent_accordion = $(this).closest('.floor-plan');
            if (parent_accordion.hasClass('current')) {
                $(this).find('i.fa').removeClass('fa-minus').addClass('fa-plus');
                parent_accordion.removeClass('current').children('.floor-plan-content').slideUp(300);
            } else {
                $(this).find('i.fa').removeClass('fa-plus').addClass('fa-minus');
                parent_accordion.addClass('current').children('.floor-plan-content').slideDown(300);
            }
            var siblings = parent_accordion.siblings('.floor-plan');
            siblings.find('i.fa').removeClass('fa-minus').addClass('fa-plus');
            siblings.removeClass('current').children('.floor-plan-content').slideUp(300);
        });

        /*-----------------------------------------------------------------*/
        /* Support for Mortgage Calculator - https://wordpress.org/plugins/mortgage-calculator/
         /*-----------------------------------------------------------------*/
        $('#mc-submit').addClass('real-btn');

        // Featured Properties Variation
        $('.rh_featured_properties__slider').fadeTo("slow", 1);

        /*-----------------------------------------------------------------*/
        /* Support for Inspiry Memberships
         /*-----------------------------------------------------------------*/
        if ($('#ims-btn-close')) {
            $('#ims-btn-close').attr('data-dismiss', 'modal');
        }

        /*-----------------------------------------------------------------------------------*/
        /*  Property Ratings
         /*-----------------------------------------------------------------------------------*/
        if (jQuery().barrating) {
            $('#rate-it').barrating({
                theme: 'fontawesome-stars',
                initialRating: 5,
            });
        }

    });

    $(window).load(function () {

        /*-----------------------------------------------------------------------------------*/
        /* Compare Listings
         /*-----------------------------------------------------------------------------------*/

        var assignHeights = function () {
            // Add heights to the first column elements.
            var columnHeight = -1;
            var headingHeight = -1;
            var priceHeight = -1;

            $('.compare-template .span2 .property-thumbnail img').each(function () {
                if ($(this).prop("complete", "complete")) {
                    headingHeight = headingHeight > $(this).parents('.property-thumbnail').find('.property-title').height() ? headingHeight : $(this).parents('.property-thumbnail').find('.property-title').height();
                    priceHeight = priceHeight > $(this).parents('.property-thumbnail').find('.property-price').height() ? priceHeight : $(this).parents('.property-thumbnail').find('.property-price').height();
                } else {
                    $(this).load(function () {
                        headingHeight = headingHeight > $(this).parents('.property-thumbnail').find('.property-title').height() ? headingHeight : $(this).parents('.property-thumbnail').find('.property-title').height();
                        priceHeight = priceHeight > $(this).parents('.property-thumbnail').find('.property-price').height() ? priceHeight : $(this).parents('.property-thumbnail').find('.property-price').height();
                    });
                }
            });

            $('.compare-template .property-thumbnail .property-title').css({
                height: headingHeight
            });

            $('.compare-template .property-thumbnail .property-price').css({
                height: priceHeight
            });

            $('.compare-template .span2 .property-thumbnail img').each(function () {
                if ($(this).prop("complete", "complete")) {
                    columnHeight = columnHeight > $(this).parents('.property-thumbnail').outerHeight() ? columnHeight : $(this).parents('.property-thumbnail').outerHeight();
                } else {
                    $(this).load(function () {
                        columnHeight = columnHeight > $(this).parents('.property-thumbnail').outerHeight() ? columnHeight : $(this).parents('.property-thumbnail').outerHeight();
                    });
                }
            });

            $('.compare-template .span2 .property-thumbnail').css({
                height: columnHeight
            });

        }
        assignHeights();

        var screenWidth = $(window).width();

        $('.compare-template .compare-feature-column').fadeTo(600, 1);
        $('.compare-template .compare-properties-column').fadeTo(600, 1);

        // Add equal heights to all the rows of all the columns
        var rowHeight = -1;

        $('.compare-template .span2 p').each(function () {
            rowHeight = rowHeight > $(this).height() ? rowHeight : $(this).height();
        });

        if (768 <= screenWidth) {
            $('.compare-template .span2 > p').css({
                height: rowHeight
            });
        }

        var imageHeight = -1;
        $('.home-features-section .span3 .feature-img').each(function () {
            if ($(this).prop("complete", "complete")) {
                imageHeight = imageHeight > $(this).outerHeight() ? imageHeight : $(this).outerHeight();
            } else {
                $(this).load(function () {
                    imageHeight = imageHeight > $(this).outerHeight() ? imageHeight : $(this).outerHeight();
                });
            }
        });
        $('.home-features-section .span3 .feature-img').css({
            height: imageHeight
        });

    });


    /*-----------------------------------------------------------------------------------*/
    /* SFOI Overlay height
     /*-----------------------------------------------------------------------------------*/
    function set_sfoi_overlay_height() {

        var width = window.innerWidth;
        var SFOI = $('.SFOI');

        SFOI.children('.SFOI__overlay').css('min-height', '0');

        if (width < 768) {
            return;
        }

        var SFOI_Height = SFOI.height();
        SFOI.children('.SFOI__overlay').css('min-height', SFOI_Height);
    }

    $(document).ready(set_sfoi_overlay_height);
    $(window).resize(set_sfoi_overlay_height);

    /*-----------------------------------------------------------------------------------*/
    /* Fixes - Advance Search form fields disabling issue on hitting browser back button.
     /*-----------------------------------------------------------------------------------*/
    $(window).bind("pageshow", function (event) {
        if (event.originalEvent.persisted) {
            window.location.reload()
        }
    });
    
})(jQuery);
