$('.currency-select').change(function () {
    let currency = $(this).val();
    window.location = 'currency/change?curr=' + currency;
})