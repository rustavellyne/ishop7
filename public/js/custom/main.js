const Cart = function(el, data) {
  this.el = el;
  this.cart = data;
  this.itemsRender = function () {
    let itemsTemplate = `<h2> Empty Cart</h2>`;
    if (!$.isEmptyObject(this.cart.items)) {
      itemsTemplate = '';
    }
    $.each(this.cart.items, (key, item) => {
      itemsTemplate += `
        <div class="row cart-product-item" data-product-id="${item.id}">
            <div class="col-xs-2">
                <img class="img-responsive" src="images/${item.img}">
            </div>
            <div class="col-xs-4">
                <h4 class="product-name"><strong>${item.title}</strong></h4>
                <h4><small>Product description</small></h4>
            </div>
            <div class="col-xs-6">
                <div class="col-xs-6 text-right">
                    <h6>
                        <strong>${symbolLeft + item.price + symbolRight}<span class="text-muted">x</span></strong>
                    </h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="form-control input-sm" value="${item.qty}">
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-link btn-xs remove-item" data-product-id="${item.id}">
                        <span class="glyphicon glyphicon-trash"> </span>
                    </button>
                </div>
            </div>
        </div>`
    });
    const updateTemplate = `
    <div class="row">
        <div class="text-center">
            <div class="col-xs-9">
                <h6 class="text-right">Added items?</h6>
            </div>
            <div class="col-xs-3">
                <button type="button" class="btn btn-default btn-sm btn-block">
                    Update cart
                </button>
            </div>
        </div>
    </div>`;
    if (!$.isEmptyObject(this.cart.items)) {
      itemsTemplate += updateTemplate
    }
    return `<div class="panel-body">${itemsTemplate}</div>`;
  };
  this.totalRender = function() {
    const totals = this.cart.totals_currency;
    return `
    <div class="panel-footer">
        <div class="row text-center">
            <div class="col-xs-9">
                <h4 class="text-right">Total <strong>${ symbolLeft + totals + symbolRight }</strong></h4>
            </div>
            <div class="col-xs-3">
                <button type="button" class="btn btn-success btn-block">
                    Checkout
                </button>
            </div>
        </div>
    </div>`
  };
  this.render = function () {
    let items = this.itemsRender();
    if (!$.isEmptyObject(this.cart.items)) {
      items += this.totalRender()
    }
    this.el.html(items);
  }
}

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
    $.get('cart/view', $(this).serialize(), function(data) {
      console.log(data)
      const cart = new Cart($('#cartModal .cart-body'), data);
      cart.render()
    },
      'json'
    );
})

$('#cartModal').on('click', '.remove-item', function () {
  const productId = $(this).closest('.cart-product-item').data('product-id');
  $.get('cart/deleteCartItem', { productId },(data) => {
    const cart = new Cart($('#cartModal .cart-body'), data);
    cart.render()
  }, 'json');
})

const goToSearchPage = function (query) {
  if (!query.length) return;
  window.location = `/search/page?q=${query}`
}

const autoCompleteJS = new autoComplete({
  placeHolder: "Search for Food...",
  data: {
    src: async (query) => {
      try {
        // Fetch Data from external Source
        const source = await fetch(`search?q=${query}`);
        // Data should be an array of `Objects` or `Strings`
        const data = await source.json();

        return data;
      } catch (error) {
        return error;
      }
    },
  },
  resultItem: {
    highlight: true,
  },
  events: {
    input: {
      selection: (event) => {
        const selection = event.detail.selection.value;
        console.log({ selection })
        goToSearchPage(selection)
      },
      keydown: (event) => {
        if (event.keyCode === 13) {
          goToSearchPage(event.target.value)
        }
      }
    }
  }
});

$('.search-btn').on('click', () => goToSearchPage($('#autoComplete').val()))
