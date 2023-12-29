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

$('#cart-add-product').on('submit', function (e) {
    e.preventDefault();
    $.get('cart/add', $(this).serialize(), function(data) {
          /**
           * cart handle
           */
          console.log(data)
          $('.simpleCart_total').text(symbolLeft + data.totals_currency + symbolRight)
    },
    'json'
    );
});

$('.simpleCart_empty').on('click', function (e) {
    e.preventDefault();
    $.get('cart/deleteCart', function(data) {
          console.log(data)
        $('.simpleCart_total').text(symbolLeft + '0.00' + symbolRight)
      },
      'json'
    );
});

$('.cart-modal-trigger').on('click', function (e) {
    e.preventDefault();
    console.log('show modal');
})