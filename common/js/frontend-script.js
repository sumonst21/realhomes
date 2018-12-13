/**
 * @file
 * Adds common scripts for different design variations
 */

(function ($) {

    "use strict";

    /*-----------------------------------------------------------------*/
    /* Currency Switcher
    /*-----------------------------------------------------------------*/
    var currencySwitcherList = $('#currency-switcher-list');
    if (currencySwitcherList.length > 0) {     // if currency switcher exists

        var currencySwitcherForm = $('#currency-switcher-form');
        var currencySwitcherOptions = {
            success: function (ajax_response, statusText, xhr, $form) {
                var response = $.parseJSON(ajax_response);
                if (response.success) {
                    window.location.reload();
                } else {
                    console.log(response);
                }
            }
        };

        $('#currency-switcher-list > li').click(function (event) {
            event.stopPropagation();
            currencySwitcherList.slideUp(200);

            // get selected currency code
            var selectedCurrencyCode = $(this).data('currency-code');

            if (selectedCurrencyCode) {
                $('#selected-currency').html(selectedCurrencyCode);
                $('#switch-to-currency').val(selectedCurrencyCode);           // set new currency code
                currencySwitcherForm.ajaxSubmit(currencySwitcherOptions);    // submit ajax form to update currency code cookie
            }
        });

        $('#currency-switcher').click(function (event) {
            currencySwitcherList.slideToggle(200);
            event.stopPropagation();
        });

        $('html').click(function () {
            currencySwitcherList.slideUp(100);
        });

    }

})(jQuery);