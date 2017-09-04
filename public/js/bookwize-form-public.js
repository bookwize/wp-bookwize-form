jQuery(document).ready(function () {
    if (jQuery('[data-reservation-form]').length) {
        var $reservationForm = jQuery('[data-reservation-form]');
        var checkInDate = jQuery('[data-date="check-in"]');
        var checkOutDate = jQuery('[data-date="check-out"]');
        var $guests = jQuery('[data-guests]');
        var $adults = jQuery('#adults');
        var infants = jQuery('#infants');
        var $minusButton = jQuery('[data-button="minus"]');
        var $plusButton = jQuery('[data-button="plus"]');
        var $lang = jQuery('html').attr('lang');
        var $apikey = $reservationForm.attr('data-key');
        var $id = $reservationForm.attr('data-id');

//api call
        jQuery.ajax({
            type: 'GET',
            url: "https://app.bookwize.com/api/v1.3/hotels/info/" + $id + "/?apikey=" + $apikey + "&lang=" + $lang,
            success: function (data) {
                if (data.id !== undefined) {
                    var apiData = getApiData(data);
                    setInitialData(apiData);
                    createFormInputs(apiData);
                    jQuery('.field__item').each(function () {
                        jQuery(this).find('.value').text(jQuery(this).children('input').val());
                    });
                }
            }
        });
//get data from api call
        function getApiData(data) {
            var ciDate = data['conditions'].minCheckInDate;
            if (ciDate.length > 0) {
                var coDate;
                ciDate = new Date(ciDate);
                coDate = ciDate.setDate(ciDate.getDate() + 1);
                coDate = new Date(coDate);
                coDate = coDate.toISOString().substr(0, 10);

                var maxGuests = data['conditions'].maxGuests;
                if (maxGuests.length === 0) {
                    maxGuests = 2;
                }
                var maxStay = data['conditions'].maxStay;
                if (maxStay.length === 0) {
                    maxStay = 1;
                }
                var defaultAdults = data['conditions'].defaultAdults;
                if (defaultAdults.length === 0) {
                    defaultAdults = 1;
                }
                var guestTypes = data['info']['guestTypes'];
                if (guestTypes.length === 0) {
                    guestTypes = [];
                }
                var boardTypes = data['info']['boardTypes'];
                if (boardTypes.length === 0) {
                    boardTypes = [];
                }
                return ({
                    first: data['conditions'].minCheckInDate,
                    second: coDate,
                    maxGuests: maxGuests,
                    adults: defaultAdults,
                    guestArray: guestTypes,
                    boardArray: boardTypes,
                    maxStay: maxStay
                });
            }
        }

//create from inputs
        function createFormInputs(input) {
            var y = 0;
            jQuery.each(input.guestArray, function (i, val) {
                if (val.ageCategory === 'Adult') {
                    var inputs = ' <input type="text" name="adults" id="adults" class="field__item-input" value="' + input.adults + '" disabled min="' + val.min + '" max="' + val.max + '" data-age="' + val.toAge + '">';
                    jQuery('#adult').append(inputs).show();
                }
                if (val.ageCategory === 'Infant') {
                    var inputs = ' <input type="text" name="infant" id="infant" class="field__item-input" value="0" disabled min="' + val.min + '" max="' + val.max + '" data-age="' + val.toAge + '" >';
                    jQuery('#infants').append(inputs).show();
                    jQuery('#infants .field__item-side-label').prepend(val.fromAge + ' - ' + val.toAge)
                }
                if (val.ageCategory === 'Children') {
                    var inputs = ' <input type="text" name="children" id="children-' + y + '" class="children field__item-input" value="0" disabled min="' + val.min + '" max="' + val.max + '" data-age="' + val.toAge + '">';
                    jQuery("#children-" + y).append(inputs).show();
                    jQuery("#children-" + y + " .field__item-side-label").prepend(val.fromAge + ' - ' + val.toAge);
                    y++;
                }
            });

            jQuery.each(input.boardArray, function (i, val) {
                var inputs = ' <option value="' + val.boardType + '" >' + val.name + '</option>';
                jQuery(".board").append(inputs);
            });
            if (jQuery('#couponCode').attr('data-enable') === 'true') {
                jQuery('#couponCode').show();
            }
            if (jQuery('#board').attr('data-enable') === 'true') {
                jQuery('#board').show();
            }
        }

//create datepicker
        function setInitialData(availableDates) {

            $adults.attr('value', availableDates.adults);
            checkInDate.attr('value', availableDates.first);
            checkOutDate.attr('value', availableDates.second);
            $reservationForm.attr('max-guests', availableDates.maxGuests);
            if (availableDates.adults > 0) {
                jQuery('#guests').show();
                jQuery('.guests__value').append(availableDates.adults);
            }
            $reservationForm.attr('max-stay', availableDates.maxStay);
            if ($lang.length > 0) {
				 jQuery('.lang').val($lang);
                jQuery.datepicker.setDefaults(jQuery.datepicker.regional[$lang]);
            } else {
                jQuery.datepicker.setDefaults(jQuery.datepicker.regional['en']);
            }
            //  ^ first set a default locale
            checkInDate.datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: availableDates.first,
                onSelect: function ff() {
                    var dateCheckin = checkInDate.datepicker('getDate');
                    dateCheckin.setDate(dateCheckin.getDate() + 1);
                    checkOutDate.datepicker('setDate', dateCheckin);
                    checkOutDate.datepicker('option', 'minDate', dateCheckin);
                },
                beforeShow: function (input, inst) {
                    jQuery(input).after(jQuery(input).datepicker('widget'));
                    setTimeout(function () {
                        inst.dpDiv.css({top: 50, left: -15});
                    }, 0);
                }
            });
            checkOutDate.datepicker({
                dateFormat: 'yy-mm-dd',
                onClose: function uu() {
                    var dtCheckin = checkInDate.datepicker('getDate');
                    var dtCheckout = checkOutDate.datepicker('getDate');
                    if (dtCheckout <= dtCheckin) {
                        var minDate = checkOutDate.datepicker('option', 'minDate');
                        checkOutDate.datepicker('setDate', minDate);
                    }
                },
                beforeShow: function (input, inst) {
                    jQuery(input).after(jQuery(input).datepicker('widget'));
                    setTimeout(function () {
                        inst.dpDiv.css({top: 50, left: -15});
                    }, 0);
                }
            });
            jQuery.extend(jQuery.datepicker.regional["fr"], {dateFormat: "d MM, y"})
        }

//remove quests
        $minusButton.click(function () {
            var input = jQuery(this).parent().siblings('input');
            var minVal = parseInt(input.attr('min'), 10);
            var currentValue = input.val();
            var children = 0;
            jQuery('.children').each(function () {
                if (jQuery(this).val() > 0) {
                    children = children + jQuery(this).val();
                }
            });

            if (parseInt(currentValue) > parseInt(minVal)) {
                currentValue--;
                input.val(currentValue);
                jQuery(this).siblings('.value').text(currentValue);
                jQuery('.guests__value').text(parseInt(jQuery('.guests__value').text()) - 1);
            }
        });
// add quests
        $plusButton.click(function () {
            var input = jQuery(this).parent().siblings('input');
            var currentValue = input.val();
            var adults = jQuery('#adults').val();
            var children = 0;
            jQuery('.children').each(function () {
                ;
                if (jQuery(this).val() > 0) {
                    children = children + parseInt(jQuery(this).val(), 10);
                }
            });
            var totalGuestsVal = parseInt($reservationForm.attr('max-guests'), 10);
            var guests = parseInt(adults, 10) + parseInt(children, 10);
            if (guests < totalGuestsVal && input.attr('name') !== 'infants' && parseInt(currentValue) < parseInt(input.attr('max'))) {
                ++currentValue;
                input.val(currentValue);
                jQuery(this).siblings('.value').text(currentValue);
                jQuery('.guests__value').text(parseInt(jQuery('.guests__value').text()) + 1);
            }
            if (input.attr('name') === 'infants' && parseInt(currentValue) < parseInt(input.attr('max'))) {
                ++currentValue;
                input.val(currentValue);
                jQuery(this).siblings('.value').text(currentValue);
                jQuery('.guests__value').text(parseInt(jQuery('.guests__value').text()) + 1);

            }
        });
//update form data and submit from
        $reservationForm.submit(function () {
            var chl = 0;
            var childrenVal = '';
            var infantsVal = '';
            jQuery('.children').each(function () {
                if (jQuery(this).val() > 0) {
                    chl = parseInt(jQuery(this).val(), 10);
                    childrenVal = ('/' + jQuery(this).attr('data-age')).repeat(chl);
                }
            });
            var inf = parseInt(jQuery('#infant').val(), 10);
            if (inf) {
                infantsVal = ('/' + jQuery('#infant').attr('data-age')).repeat(inf);
            }
            $guests.attr('value', jQuery('#adults').val() + childrenVal + infantsVal);
            var diff = (checkOutDate.datepicker("getDate") - checkInDate.datepicker("getDate")) /
                1000 / 60 / 60 / 24; // days

            if (diff > $reservationForm.attr('max-stay')) {
                var checkoutDate = new Date(jQuery('[name="ci"]').val());
                var numberOfDaysToAdd = $reservationForm.attr('max-stay');
                checkoutDate.setDate(checkoutDate.getDate() + numberOfDaysToAdd);
                checkoutDate = checkoutDate.toISOString().substr(0, 10);
                jQuery('[name="co"]').val(checkoutDate);

            }
        });
        //cross domain tacking
        function HP_UpdateUrl() {
            ga(function (tracker) {
                var linkerParam = tracker.get('linkerParam');
                jQuery('.linkerParam').val(linkerParam);
            });

        }

        //count  visible section for horizontal version
        jQuery(window).load(function () {
            var visible = 0;
            jQuery('.fields__wrapper').children(':visible').each(function () {
                visible = visible + 1;
            });
            var $width = jQuery('.reservation-form').width() / visible - 5 + 'px';
            if (jQuery('.reservation-form').attr('data-vertical') === '1') {
                jQuery('.fields__wrapper').children(':visible').each(function () {

                    jQuery(this).width($width);
                });
            }
        });


        jQuery(document).click(function () {
            jQuery('.guests__wrapper').removeClass('opened');
            jQuery('.guests__value').removeClass('opened');
        });

        jQuery("#guests").click(function (event) {
            event.stopPropagation();
            jQuery('.guests__wrapper').addClass('opened');
            jQuery('.guests__value').addClass('opened');
        });

    }
});
