$('.currency-select').change(function () {
    let currency = $(this).val();
    window.location = 'currency/change?curr=' + currency;
});

$('.product-modification').change(function () {
    const selectedEl = '.product-modification :selected';
    const basePriceEl = '.base-product-price';
    let price = $(selectedEl).data('price');
    let basePrice = $(basePriceEl).data('price');
    let updatePrice = price ? price : basePrice;
    $(basePriceEl).text(symbolLeft + updatePrice + symbolRight);
});