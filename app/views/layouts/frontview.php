<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title><?= $head['title'] ?? '' ?></title>
<base href="/">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!--Custom-Theme-files-->
<!--theme-style-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tarekraafat-autocomplete.js/10.2.7/css/autoComplete.min.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Luxury Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />		
</head>
<body> 
	<!--top-header-->
	<div class="top-header">
		<div class="container">
			<div class="top-header-main">
				<div class="col-md-6 top-header-left">
					<div class="drop">
						<div class="box">
							<select tabindex="4" class="dropdown drop currency-select">
                                <?php echo \IShop\widgets\currency\Currency::toHtml()?>
							</select>
						</div>
						<div class="box1">
							<select tabindex="4" class="dropdown">
								<option value="" class="label">English :</option>
								<option value="1">English</option>
								<option value="2">French</option>
								<option value="3">German</option>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6 top-header-left">
					<div class="cart box_1">
                        <div data-toggle="modal" data-target="#cartModal" class="cart-modal-trigger">
                            <a href="checkout.html">
                                <div class="total">
                                <span class="simpleCart_total">
                                    <?php echo moneySymbol($general['cart']['totals_currency'] ?? '0.00') ?>
                                </span>
                                </div>
                                <img src="images/cart-1.png" alt="" />
                            </a>
                        </div>
						<p><a href="cart/deleteCart" class="simpleCart_empty">Empty Cart</a></p>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--top-header-->
	<!--start-logo-->
	<div class="logo">
		<a href="/"><h1>Luxury Watches</h1></a>
	</div>
	<!--start-logo-->
	<!--bottom-header-->
	<div class="header-bottom">
		<div class="container">
			<div class="header">
				<div class="col-md-9 header-left">
				<div class="top-nav">
                    <?php echo (new \IShop\widgets\mainNavigation\MainNavigation())->toHtml()?>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-3 header-right"> 
				<div class="search-bar">
					<input type="text" dir="ltr" id="autoComplete" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off" maxlength="2048" tabindex="1" placeholder="Search">
					<input type="submit" value="" class="search-btn">
				</div>
			</div>
			<div class="clearfix"> </div>
			</div>
		</div>
	</div>
    <!--bottom-header-->

    <!-- content start -->
    <?= $content ?? '' ?>
    <!-- content end -->

	<!--information-starts-->
	<div class="information">
		<div class="container">
			<div class="infor-top">
				<div class="col-md-3 infor-left">
					<h3>Follow Us</h3>
					<ul>
						<li><a href="#"><span class="fb"></span><h6>Facebook</h6></a></li>
						<li><a href="#"><span class="twit"></span><h6>Twitter</h6></a></li>
						<li><a href="#"><span class="google"></span><h6>Google+</h6></a></li>
					</ul>
				</div>
				<div class="col-md-3 infor-left">
					<h3>Information</h3>
					<ul>
						<li><a href="#"><p>Specials</p></a></li>
						<li><a href="#"><p>New Products</p></a></li>
						<li><a href="#"><p>Our Stores</p></a></li>
						<li><a href="contact.html"><p>Contact Us</p></a></li>
						<li><a href="#"><p>Top Sellers</p></a></li>
					</ul>
				</div>
				<div class="col-md-3 infor-left">
					<h3>My Account</h3>
					<ul>
						<li><a href="account.html"><p>My Account</p></a></li>
						<li><a href="#"><p>My Credit slips</p></a></li>
						<li><a href="#"><p>My Merchandise returns</p></a></li>
						<li><a href="#"><p>My Personal info</p></a></li>
						<li><a href="#"><p>My Addresses</p></a></li>
					</ul>
				</div>
				<div class="col-md-3 infor-left">
					<h3>Store Information</h3>
					<h4>The company name,
						<span>Lorem ipsum dolor,</span>
						Glasglow Dr 40 Fe 72.</h4>
					<h5>+955 123 4567</h5>	
					<p><a href="mailto:example@email.com">contact@example.com</a></p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--information-end-->
	<!--footer-starts-->
	<div class="footer">
		<div class="container">
			<div class="footer-top">
				<div class="col-md-6 footer-left">
					<form>
						<input type="text" value="Enter Your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
						<input type="submit" value="Subscribe">
					</form>
				</div>
				<div class="col-md-6 footer-right">					
					<p>© 2015 Luxury Watches. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--footer-end-->

    <!-- Modals-->
    <div class="cart-modal modal fade bs-example-modal-lg" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="row modal-dialog modal-lg" style="width: 800px">
            <div class="col-sm-12 col-md-12 modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myLargeModalLabel">Your cart</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal">
                                                <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-body">
                                <?php
                                $cart = $general['cart'] ?? [];
                                $items = $cart['items'] ?? [];
                                ?>
                                <?php if (empty($items)): ?>
                                <div class="panel-body">
                                    <h2> Empty Cart</h2>
                                </div>
                                <?php else: ?>
                                <div class="panel-body">
                                    <?php foreach ($items as $item): ?>
                                        <div class="row cart-product-item" data-product-id="<?=$item['id']?>">
                                            <div class="col-xs-2">
                                                <img class="img-responsive" src="images/<?=$item['img']?>">
                                            </div>
                                            <div class="col-xs-4">
                                                <h4 class="product-name"><strong><?=$item['title']?></strong></h4>
                                                <h4><small>Product description</small></h4>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="col-xs-6 text-right">
                                                    <h6>
                                                        <strong><?= priceCurrency($item['price'])?> <span class="text-muted">x</span></strong>
                                                    </h6>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control input-sm" value="<?=$item['qty']?>">
                                                </div>
                                                <div class="col-xs-2">
                                                    <button type="button" class="btn btn-link btn-xs remove-item" data-product-id="<?=$item['id']?>">
                                                        <span class="glyphicon glyphicon-trash"> </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php endforeach; ?>
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
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row text-center">
                                        <div class="col-xs-9">
                                            <h4 class="text-right">Total <strong><?= moneySymbol($cart['totals_currency'])?></strong></h4>
                                        </div>
                                        <div class="col-xs-3">
                                            <button type="button" class="btn btn-success btn-block">
                                                Checkout
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Modals-->

<!-- SCRIPTS PLACE START-->
<!--jQuery(necessary for Bootstrap's JavaScript plugins)-->
<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="application/x-javascript"> 
	addEventListener("load", function() { 
		setTimeout(hideURLbar, 0); 
	}, false); 
	function hideURLbar() { 
		window.scrollTo(0,1);
	} 
</script>
<!--start-menu-->
<!--<script src="js/simpleCart.min.js"></script>-->
<script type="text/javascript" src="js/memenu.js"></script>
<script>
	$(document).ready(function(){
		$(".memenu").memenu();
	});
</script>	
<!--dropdown-->
<script src="js/jquery.easydropdown.js"></script>	
<!--Slider-Starts-Here-->
<script src="js/responsiveslides.min.js" defer></script>
<script defer>
document.addEventListener("DOMContentLoaded", function() {
  	// You can also use "$(window).load(function() {"
    $(function () {
      // Slideshow 4
      $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });
    });
});    
</script>
<!--End-slider-script-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tarekraafat-autocomplete.js/10.2.7/autoComplete.min.js"></script>
<script src="js/custom/main.js" defer></script>

<!-- SCRIPTS PLACE END -->
</body>
</html>
