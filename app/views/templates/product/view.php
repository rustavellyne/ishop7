<?php
/** @var array $product */ ?>
<pre>
<?= print_r($product, true) ?>
</pre>
<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <?php if (!empty($breadcrumbs)): ?>
                    <?php foreach ($breadcrumbs as $breadcrumb): ?>
                        <?php if ($breadcrumb['alias']): ?>
                            <li>
                                <a href="/category/view/<?= $breadcrumb['alias'] ?>">
                                    <?= $breadcrumb['title'] ?>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="active">
                                <?= $breadcrumb['title'] ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach ?>
                <?php endif ?>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-9 single-main-left">
                <div class="sngl-top">
                    <div class="col-md-5 single-top-left">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="images/s-1.jpg">
                                    <div class="thumb-image"><img src="images/s-1.jpg" data-imagezoom="true"
                                                                  class="img-responsive" alt=""/></div>
                                </li>
                                <li data-thumb="images/s-2.jpg">
                                    <div class="thumb-image"><img src="images/s-2.jpg" data-imagezoom="true"
                                                                  class="img-responsive" alt=""/></div>
                                </li>
                                <li data-thumb="images/s-3.jpg">
                                    <div class="thumb-image"><img src="images/s-3.jpg" data-imagezoom="true"
                                                                  class="img-responsive" alt=""/></div>
                                </li>
                            </ul>
                        </div>
                        <!-- FlexSlider -->
                        <script defer src="js/imagezoom.js"></script>
                        <script defer src="js/jquery.flexslider.js"></script>
                        <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>

                        <script>
                          // Can also be used with $(document).ready()
                          document.addEventListener("DOMContentLoaded", function () {
                            $('.flexslider').flexslider({
                              animation: "slide",
                              controlNav: "thumbnails"
                            });
                          })
                        </script>
                    </div>
                    <div class="col-md-7 single-top-right">
                        <div class="single-para simpleCart_shelfItem">
                            <h2>
                                <?= $product['title'] ?? 'Custom Watch' ?>
                            </h2>
                            <div class="star-on">
                                <ul class="star-footer">
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                </ul>
                                <div class="review">
                                    <a href="#"> 1 customer review </a>

                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <h5 class="item_price">
                                <?= priceCurrency($product['price']) ?>
                            </h5>
                            <?php
                            if ($product['old_price']): ?>
                                <small>
                                    <del> <?= priceCurrency($product['old_price']); ?></del>
                                </small>
                            <?php
                            endif; ?>
                            <p>
                                <?= $product['content'] ?? 'Custom Watch Description' ?>
                            </p>
                            <div class="available">
                                <ul>
                                    <li>Color
                                        <select>
                                            <option>Silver</option>
                                            <option>Black</option>
                                            <option>Dark Black</option>
                                            <option>Red</option>
                                        </select></li>
                                    <li class="size-in">Size<select>
                                            <option>Large</option>
                                            <option>Medium</option>
                                            <option>small</option>
                                            <option>Large</option>
                                            <option>small</option>
                                        </select></li>
                                    <div class="clearfix"></div>
                                </ul>
                            </div>
                            <ul class="tag-men">
                                <li><span>Category</span>
                                    <span>: <a href="<?= '/category/view/' . $product['category_alias'] ?>"><?= $product['category_name'] ?></a></span></li>
                            </ul>
                            <div style="margin-top: 15px">
                                <span class="quantity">
                                    <label>
                                        <input type="number" name="quantity"  size="4" value="1" min="1" style="width: 100px; height: 40px"/>
                                    </label>
                                </span>
                                <a href="cart/add?id=<?= $product['product_id'] ?>" class="add-cart item_add">ADD TO CART</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tabs">
                    <script type="text/javascript">
                      document.addEventListener("DOMContentLoaded", function () {

                        var menu_ul = $('.menu_drop > li > ul'),
                          menu_a = $('.menu_drop > li > a');

                        menu_ul.hide();

                        menu_a.click(function (e) {
                          e.preventDefault();
                          if (!$(this).hasClass('active')) {
                            menu_a.removeClass('active');
                            menu_ul.filter(':visible').slideUp('normal');
                            $(this).addClass('active').next().stop(true, true).slideDown('normal');
                          } else {
                            $(this).removeClass('active');
                            $(this).next().stop(true, true).slideUp('normal');
                          }
                        });

                      });
                    </script>
                    <ul class="menu_drop">
                        <li class="item1"><a href="#"><img src="images/arrow.png" alt="">Description</a>
                            <ul>
                                <li class="subitem1" style="background: white"><?= $product['content'] ?? 'No description' ?></li>
                            </ul>
                        </li>
                        <li class="item2"><a href="#"><img src="images/arrow.png" alt="">Additional information</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item3"><a href="#"><img src="images/arrow.png" alt="">Reviews (10)</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item4"><a href="#"><img src="images/arrow.png" alt="">Helpful Links</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item5"><a href="#"><img src="images/arrow.png" alt="">Make A Gift</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php if (!empty($relatedProducts)): ?>
                <div class="latestproducts">
                    <div class="product-one">
                        <h3>Related Products</h3>
                        <?php foreach($relatedProducts as $product):?>
                        <div class="col-md-4 product-left p-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="/product/view/<?= $product['alias'] ?>" class="mask">
                                    <img class="img-responsive zoom-img" src="images/<?= $product['img'] ?>" alt="<?= $product['title'] ?>"/>
                                </a>
                                <div class="product-bottom">
                                    <h3><?= $product['title'] ?></h3>
                                    <p>Explore Now</p>
                                    <h4>
                                        <a class="item_add" href="cart/add?id=<?= $product['related_id'] ?>"><i></i></a>
                                        <span class=" item_price"> <?= priceCurrency($product['price']) ?></span>
                                    </h4>
                                    <?php
                                    if ($product['old_price']): ?>
                                        <small>
                                            <del> <?= priceCurrency($product['old_price']); ?></del>
                                        </small>
                                    <?php
                                    endif; ?>
                                </div>
                                <div class="srch">
                                    <span>-50%</span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php endif ?>
                <?php if (!empty($alreadyViewedProducts)): ?>
                    <div class="latestproducts">
                        <div class="product-one">
                            <h3>Already Viewed Products</h3>
                            <?php foreach($alreadyViewedProducts as $product):?>
                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="/product/view/<?= $product['alias'] ?>" class="mask">
                                            <img class="img-responsive zoom-img" src="images/<?= $product['img'] ?>" alt="<?= $product['title'] ?>"/>
                                        </a>
                                        <div class="product-bottom">
                                            <h3><?= $product['title'] ?></h3>
                                            <p>Explore Now</p>
                                            <h4>
                                                <a class="item_add" href="cart/add?id=<?= $product['related_id'] ?>"><i></i></a>
                                                <span class=" item_price"> <?= priceCurrency($product['price']) ?></span>
                                            </h4>
                                            <?php
                                            if ($product['old_price']): ?>
                                                <small>
                                                    <del> <?= priceCurrency($product['old_price']); ?></del>
                                                </small>
                                            <?php
                                            endif; ?>
                                        </div>
                                        <div class="srch">
                                            <span>-50%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <div class="col-md-3 single-right">
                <div class="w_sidebar">
                    <section class="sky-form">
                        <h4>Catogories</h4>
                        <div class="row1 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>All
                                    Accessories</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Women
                                    Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kids
                                    Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Men
                                    Watches</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Brand</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>kurtas</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sonata</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Titan</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Casio</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Omax</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fastrack</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sports</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fossil</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Maxima</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Yepme</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Citizen</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Diesel</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Colour</h4>
                        <ul class="w_nav2">
                            <li><a class="color1" href="#"></a></li>
                            <li><a class="color2" href="#"></a></li>
                            <li><a class="color3" href="#"></a></li>
                            <li><a class="color4" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                            <li><a class="color12" href="#"></a></li>
                            <li><a class="color13" href="#"></a></li>
                            <li><a class="color14" href="#"></a></li>
                            <li><a class="color15" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                        </ul>
                    </section>
                    <section class="sky-form">
                        <h4>discount</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio" checked=""><i></i>60 % and
                                    above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>50 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>40 % and above</label>
                            </div>
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio"><i></i>30 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>20 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>10 % and above</label>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>