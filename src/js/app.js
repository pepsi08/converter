$(document).ready(function () {

    //Default values
    $('[name=source_currency_val]').val($('#source-currency option:selected').text());
    $('[name=source_currency_amount]').val($('#source-currency option:selected').val());

    $('[name=target_currency_val]').val($('#target-currency option:selected').text());
    $('[name=target_currency_amount]').val($('#target-currency option:selected').val());

    /**
     * Change event
     */
    $('[name=source_currency]').change(function () {
        $('[name=source_currency_val]').val($("option:selected", this).text());
        $('[name=source_currency_amount]').val($(this).val());
    });

    $('[name=target_currency]').change(function () {
        $('[name=target_currency_val]').val($("option:selected", this).text());
        $('[name=target_currency_amount]').val($(this).val());
    });

    //Ajax validation
    $('#covert-form').submit(function () {
        var result = false;
        $.ajax({
            type: 'post',
            url: './validate/currency',
            data: $('#covert-form').serialize(),
            dataType: 'json',
            async: false,
            success: function (response) {
                result = true;
            },
            error: function (response) {
                var errors = JSON.parse(response.responseText);

                if (typeof errors.amount != 'undefined') {
                    $('.error-amount').html(errors.amount[0]);
                }
                if (typeof errors.target_currency != 'undefined') {
                    $('.error-currency').html(errors.target_currency[0]);
                }
            }
        });
        return result;
    });


});