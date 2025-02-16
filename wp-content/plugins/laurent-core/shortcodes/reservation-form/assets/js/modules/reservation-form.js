(function($) {
    'use strict';

    var reservationForm = {};
    eltdf.modules.reservationForm = reservationForm;

    reservationForm.eltdfReservationDatePicker = eltdfReservationDatePicker;
    reservationForm.eltdfInitReservationSelect2 = eltdfInitReservationSelect2;
    reservationForm.eltdfOnDocumentReady = eltdfOnDocumentReady;
    reservationForm.eltdfOnWindowResize = eltdfOnWindowResize;

    $(document).ready(eltdfOnDocumentReady);
    $(window).resize(eltdfOnWindowResize);
    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitReservationSelect2();
        eltdfReservationDatePicker();
        eltdfInitReservationSubmit();
    }

    function eltdfOnWindowResize() {
        eltdfInitReservationSelect2();
    }


    function eltdfOnWindowLoad() {
        eltdfInitReservationSelect2();
        eltdfElementorReservationForm();
        eltdfInitReservationSubmit();
    }

    /**
     * Elementor
     */
    function eltdfElementorReservationForm(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_reservation_form.default', function() {
                eltdfReservationDatePicker();
                eltdfInitReservationSelect2();
                eltdfInitReservationSubmit();
            } );
        });
    }

    function eltdfReservationDatePicker() {
        var datepicker = $('.eltdf-ot-date');

        if(datepicker.length) {
            datepicker.each(function () {

                $( this ).datepicker(
                    {
                        dateFormat: 'mm/dd/yy',
                    }
                );

                $( this ).datepicker().mousedown(function () {
                    var cond = $(this).data('datepicker').dpDiv.is(':visible');
                    $( this ).datepicker(cond ? 'hide' : 'show');
                });

            });
        }
    }

    function eltdfInitReservationSelect2() {
        var reservationSelect = $('.eltdf-ot-people, .eltdf-ot-time');

        if (reservationSelect.length) {
            var select2 = $('select.qodef-select2');

            if (select2.length) {
                reservationSelect.select2();
            }
        }
    }

    function eltdfInitReservationSubmit() {
        var $form = $( '.eltdf-rf' );

        $form.on(
            'submit',
            function ( e ) {
                e.preventDefault();

                var inputValues = $form.serializeArray(),
                    datetime    = '';

                $.each(
                    inputValues,
                    function () {
                        var $input    = $( this )[0],
                            inputName = $input.name;

                        if ( inputName === 'date' || inputName === 'time' ) {
                            datetime += ' ' + $input.value;
                        }
                    }
                );

                if ( datetime.length ) {
                    var date          = new Date( datetime ),
                        hours          = parseInt( date.getHours(), 10 ),
                        formattedHours = hours < 10 ? '0' + hours : hours,
                        formattedDate = date.getFullYear() + '-' + (parseInt( date.getMonth(), 10 ) < 10 ? '0' : '') + (parseInt( date.getMonth(), 10 ) + 1) + '-' + (parseInt( date.getDate(), 10 ) < 10 ? '0' : '') + date.getDate() + 'T' + formattedHours + ':' + date.getMinutes() + (parseInt( date.getMinutes(), 10 ) == 30 ? '' : '0');

                    $form.find( '[name="datetime"]' ).val( formattedDate );
                }

                window.open(
                    $form.attr( 'action' ) + '?' + $form.serialize(),
                    '_blank'
                );
            }
        );
    }

})(jQuery);