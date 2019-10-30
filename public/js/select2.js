(function($) {
    'use strict';

    if ($(".js-example-basic-single").length) {
        $(".js-example-basic-single").select2({
            placeholder: "Select",
            allowClear: true,
        });
    }

    if ($(".js-example-basic-multiple").length) {
        $(".js-example-basic-multiple").select2({
            placeholder: "Select",
            allowClear: true,
        });
    }

    if ($(".select-station").length) {
        $(".select-station").select2({
            placeholder: "Select Station",
            allowClear: true,
        });
    }
    if ($(".select-day").length) {
        $(".select-day").select2({
            placeholder: "Day",
            allowClear: true,
        });
    }

    if ($(".select-advert").length) {
        $(".select-advert").select2({
            placeholder: "Select Advert",
            allowClear: true,
        });
    }
    if ($(".select-time").length) {
        $(".select-time").select2({
            placeholder: "Select Time",
            allowClear: true,
        });
    }

    if ($(".filter-items").length) {
        $(".filter-items").select2({
            placeholder: "Filter",
            allowClear: true,
        });
    }

    $('#filter-programs').change(function () {
        $('#filter-programs-form').submit();
    });
})(jQuery);
