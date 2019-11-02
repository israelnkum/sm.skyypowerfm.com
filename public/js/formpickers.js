(function($) {

    'use strict';
    /*if ($("#timepicker-example").length) {
        $('#timepicker-example').datetimepicker({
            sideBySide: true
        });
        $("#timepicker-example").on("dp.change", function (e) {
            $('#end-date-time').data("DateTimePicker").minDate(e.date);
        });
    }

    if ($("#end-date-time").length) {
        $('#end-date-time').datetimepicker({
            sideBySide: true,
        });
        $("#end-date-time").on("dp.change", function (e) {
            $('#timepicker-example').data("DateTimePicker").maxDate(e.date);
        });
    }*/

    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
    });
    $('#datetimepicker6').datetimepicker({
        format: 'YYYY-MM-DD',
        // useCurrent: false
    });
    $('#datetimepicker7').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        autoclose: false
    });
    $("#datetimepicker6").on("change.datetimepicker", function (e) {
        $('#datetimepicker7').datetimepicker('minDate', e.date);
    });
    $("#datetimepicker7").on("change.datetimepicker", function (e) {
        $('#datetimepicker6').datetimepicker('maxDate', e.date);
    });




    $('#datetimepicker8').datetimepicker({
        format: 'YYYY-MM-DD',
        // useCurrent: false
    });
    $('#datetimepicker9').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        autoclose: false
    });
    $("#datetimepicker8").on("change.datetimepicker", function (e) {
        $('#datetimepicker9').datetimepicker('minDate', e.date);
    });
    $("#datetimepicker9").on("change.datetimepicker", function (e) {
        $('#datetimepicker8').datetimepicker('maxDate', e.date);
    });

    $('#start-time').datetimepicker({
        format:'LT'
    });
    $('#end-time').datetimepicker({
        format:'LT',
        useCurrent: false
    });
    $("#start-time").on("change.datetimepicker", function (e) {
        $('#end-time').datetimepicker('minDate', e.date);
    });
    $("#end-time").on("change.datetimepicker", function (e) {
        $('#start-time').datetimepicker('maxDate', e.date);
    });



    if ($("#datepicker-popup").length) {
        $('#datepicker-popup').datepicker({
            enableOnReadonly: true,
            todayHighlight: true,
        });
    }
    if ($("#inline-datepicker").length) {
        $('#inline-datepicker').datepicker({
            enableOnReadonly: true,
            todayHighlight: true,
        });
    }
    if ($(".datepicker-autoclose").length) {
        $('.datepicker-autoclose').datepicker({
            autoclose: true
        });
    }
    if($('.input-daterange').length) {
        $('.input-daterange input').each(function() {
            $(this).datetimepicker('clearDate');
        });
        $('.input-daterange').datetimepicker({});
    }




})(jQuery);
