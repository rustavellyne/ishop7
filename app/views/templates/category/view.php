<?php
/** @var array $categoryCurrent */ ?>
<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">
                    <?= $categoryCurrent->title ?>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- End of breadcrumbs-->

<!--start-single-->
<div class="single category">
    <div class="container">
        <h2> <?=$categoryCurrent->title ?></h2>
        <?php if (!empty($products)): ?>
        <div class="product-top">
            <div class="product-one col-md-9">
                <?php
                foreach ($products as $product): ?>
                    <div class="col-md-4 product-left">
                        <div class="product-main simpleCart_shelfItem">
                            <a href="product/view/<?= $product['alias'] ?>" class="mask">
                                <img class="img-responsive zoom-img" src="images/<?= $product['img'] ?>"
                                     alt="<?= $product['title'] ?>"/>
                            </a>
                            <div class="product-bottom">
                                <h3><?= $product['title'] ?></h3>
                                <p>Explore Now</p>
                                <h4>
                                    <a class="item_add add-to-cart-link" href="cart/add?product_id=<?= $product['id'] ?>">
                                        <i></i>
                                    </a>
                                    <span class=" item_price"><?=
                                        priceCurrency($product['price']); ?></span>
                                    <?php
                                    if ($product['old_price']): ?>
                                        <small>
                                            <del> <?= priceCurrency($product['old_price']); ?></del>
                                        </small>
                                    <?php
                                    endif; ?>
                                </h4>
                            </div>
                            <div class="srch">
                                <span>-50%</span>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach; ?>
                <div class="clearfix"></div>
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
            <?php if (!empty($pagination)): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="<?= $pagination['prev']['state'] ?>">
                            <a href="<?= $pagination['prev']['value'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php foreach ($pagination['numbers'] as $number): ?>
                            <li class="<?= $number['state'] ?>">
                                <a href="<?= $number['value'] ?>">
                                    <?= $number['label'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li class="<?= $pagination['next']['state'] ?>">
                            <a href="<?= $pagination['next']['value'] ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <p> No products in current category</p>
        <?php endif; ?>
    </div>
</div>